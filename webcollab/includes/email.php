<?php
/*
  $Id$

  (c) 2003 - 2006 Andrew Simpson <andrew.simpson at paradise.net.nz>

  WebCollab
  ---------------------------------------
  This program is free software; you can redistribute it and/or modify it under the
  terms of the GNU General Public License as published by the Free Software Foundation;
  either version 2 of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful, but WITHOUT ANY
  WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
  PARTICULAR PURPOSE. See the GNU General Public License for more details.

  You should have received a copy of the GNU General Public License along with this
  program; if not, write to the Free Software Foundation, Inc., 675 Mass Ave,
  Cambridge, MA 02139, USA.

  Function:
  ---------

  Sends emails and preformatted emails

  Refer to RFC 821 (RFC 2821), RFC 822 (RFC 2822) for basic SMTP.
  Refer to RFC 1652 for 8BITMIME
  Refer to RFC 1869 for extended hello (EHLO)
  Refer to RFC 2045 for mime types
  Refer to RFC 2047 for handling 8bit headers
  Refer to RFC 2076 for a useful summary of common headers
  Refer to RFC 2920 for command pipelining
*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

//includes
require_once(BASE.'includes/admin_config.php' );

if( (SMTP_AUTH === 'Y') || (TLS === 'Y') ){
  include_once(BASE.'includes/smtp_auth.php' );
}

//
// Email sending function
//

function email($to, $subject, $message ) {

  global $connection, $log;

  $email_encode = '';
  $message_charset = '';
  $body = '';
  $bit8 = false;
  $pipelining = false;

  if(USE_EMAIL === 'N' ) {
    //email is turned off in config file
    return;
  }
  if(sizeof($to) == 0  ) {
    //no email address specified - end function
    return;
  }

  //remove duplicate addresses
  $to = array_unique((array)$to );

  //open an SMTP connection at the mail host
  $connection = @fsockopen(SMTP_HOST, SMTP_PORT, $errno, $errstr, 10 );
  $log = "Opening connection to ".SMTP_HOST." on port ".SMTP_PORT."\n";
  if (!$connection )
    debug("Unable to open TCP/IP connection.\n\nReported socket error: ".$errno." ".$errstr."\n");

  //sometimes the SMTP server takes a little longer to respond
  stream_set_timeout($connection, 10, 0 );

  if(strncmp('220', response(), 3 ) ) {
    debug();
  }

  //do extended hello (EHLO)
  fputs($connection, 'EHLO '.$_SERVER['SERVER_NAME']."\r\n" );
  $log .= "C: EHLO ".$_SERVER['SERVER_NAME']."\n";
  $capability = response();

  //if EHLO (RFC 1869) not working, try the older HELO (RFC 821)...
  if(strncmp('250', $capability, 3 ) ) {
    fputs($connection, "HELO ".$_SERVER['SERVER_NAME']."\r\n" );
    $log .= "C: HELO ".$_SERVER['SERVER_NAME']."\n";
    $capability = '';
    if(strncmp('250', response(), 3 ) )
      debug();
  }

  //do TLS if required
  if(TLS === 'Y' ) {
    $capability = starttls($connection, $capability );
  }

  //do SMTP_AUTH if required
  if(SMTP_AUTH === 'Y' ) {
    smtp_auth($connection, $capability );
  }

  //see if server is offering 8bit mime capability & pipelining
  if( ! strpos($capability, '8BITMIME' ) === false ) {
    $bit8 = true;
  }

  if( ! strpos($capability, 'PIPELINING' ) === false ) {
    $pipelining = true;
  }

  //arrange message - and set email encoding to 8BITMIME if we need to
  //(we *must* do this before 'MAIL FROM:' in case we need to set encoding to suit the message body)
  $message_lines  =& message($message, $email_encode, $message_charset, $body, $bit8 );
  $header_lines   = headers($to, $subject, $email_encode, $message_charset );
  $count_commands = 0;

  //envelope from
  fputs($connection, 'MAIL FROM: <'.clean(EMAIL_FROM).'>'.$body."\r\n" );
  $log .= 'C: MAIL FROM: '.EMAIL_FROM." $body \n";
  ++$count_commands;

  if(! $pipelining ) {
    if(strncmp('250', response(), 3 ) ) {
      debug();
    }
  }

  //envelope to
  foreach((array)$to as $address ) {
    fputs($connection, 'RCPT TO: <'.trim(clean($address ) ).">\r\n" );
    $log .= 'C: RCPT TO: '.$address."\n";
    ++$count_commands;

    if(! $pipelining ) {
      if(strncmp('25', response(), 2 ) ){
        debug();
      }
    }
  }

  //start data transmission
  fputs($connection, "DATA\r\n" );
  $log .= "C: DATA\n";
  ++$count_commands;

  if(! $pipelining ) {
    if(strncmp('354', response(), 3 ) ) {
      debug();
    }
  }
  else {
    //we have been pipelining ==> roll back & check the server responses
    for($i=0 ; $i<$count_commands ; ++$i ) {

      switch(substr(response(), 0, 3 ) ) {
        case '250':
        case '251':
          //correct response for most commands
          break;

        case '354':
          //correct response for final DATA command
          if($i == ($count_commands - 1 ) ){
            break(2);
          }
          else {
            debug('Pipelining: Bad response to DATA' );
          }
          break;

        default:
          //anything else is no good
          debug('Pipelining: Bad response to MAIL FROM or RCPT TO');
      }
    }
  }

  //send headers & message to server (with correct end-of-line \r\n)
  foreach(array('header_lines', 'message_lines' ) as $var ) {
    $log .= "C: Sending $var...\n";
    foreach(${$var} as $line_out ) {
      fputs($connection, "$line_out\r\n" );
    }
  }

  //ok all the message data has been sent - finish with a period on it's own line
  fputs($connection, ".\r\n" );
  $log .= "C: End of message\n";

  if(! $pipelining) {
    if(strncmp('250', response(), 3 ) ) {
      debug();
    }
  }

  //say bye bye
  fputs($connection, "QUIT\r\n" );
  $log .= "C: QUIT\n";

  if(! $pipelining) {
    if(strncmp('221', response(), 3 ) ) {
      debug();
    }
  }
  else {
    if(strncmp('250', response(), 3 ) ) {
      debug('Pipelining: Bad response to end of message');
    }
    if(strncmp('221', response(), 3 ) ) {
      debug('Pipelining: Bad response to QUIT');
    }
  }

  fclose($connection );

  return;
}

/*
Function List
=============
clean		Reinstate encoded html back to original text.
message		Prepare message body, and if necessary, 'quoted-printable' encode for SMTP transmission.
headers		Assemble message headers to RFC 822.
header_encoding	Check header line and 'quoted printable' encode if required for SMTP transmission.
response	Get response to client command from the connected SMTP server.
debug		Debug!
*/

//
//function to reinstate html in text and remove any dangerous html scripting tags
//

function & clean($text ) {

  //characters previously escaped/encoded to avoid SQL injection/CSS attacks are reinstated.
  $trans = array('\;'=>';', '\('=>'(', '\)'=>')', '\+'=>'+', '\-'=>'-', '\='=>'=', '&apos;'=>"'" );
  $text  = strtr($text, $trans );

  $text  = @html_entity_decode($text, ENT_QUOTES , CHARACTER_SET );

  //remove any dangerous tags that exist
  $text = preg_replace("/(<\/?\s*)(APPLET|SCRIPT|EMBED|FORM|\?|%)(\w*|\s*)([^>]*>)/i", "\\1****\\3\\4", $text );


  return $text;
}

//
//function to prepare and encode message body for transmission
//

function & message($message, & $email_encode, & $message_charset, & $body, $bit8 ) {

  //clean up message
  $message = clean($message );

  //normalise end-of-lines (\r\n, \r ) in message body to \n - and change back to \r\n later
  $message = str_replace("\r\n", "\n", $message );
  $message = str_replace("\r", "\n", $message );

  //make sure message ends in a new line \n
  $message = $message."\n";

  //check if message contains high bit ascii characters and set encoding to match mailer capabilities
  switch(preg_match('/([\177-\377])/', $message ) ) {
    case true:
      //we have special characters
      switch($bit8 ) {
        case true:
          //mail server has said it can do 8bit
          $email_encode = '8bit';
          $body = ' BODY=8BITMIME';
          $message_charset = CHARACTER_SET;

          //break up any lines longer than 998 bytes (RFC 821)
          $message = wordwrap($message, 998, "\n", 1 );
          break;

        case false:
          //old mail server - can only do 7bit mail
          $body = '';
          $message_charset = CHARACTER_SET;

          switch(UNICODE_VERSION) {
            case 'Y':
              $email_encode = 'base64';
              $message = base64_encode($message );
              //break into chunks of 76 characters per line (RFC 2045)
              $message = chunk_split($message, 76, "\n" );
              break;

            case 'N':
            default:
              $email_encode = 'quoted-printable';
              //replace high ascii, control and = characters (RFC 2045)
              $message = preg_replace('/([\000-\010\013\014\016-\037\075\177-\377])/e', "'='.sprintf('%02X', ord('\\1'))", $message);
              //replace spaces and tabs when it's the last character on a line (RFC 2045)
              $message = preg_replace('/([\011\040])\n/e', "'='.sprintf('%02X', ord('\\1')).'\n'", $message);
              //break up any lines longer than 76 characters with soft line breaks " =\r\n" (RFC 2045)
              //(end of line \n gets changed to \r\n after explode)
              $message = wordwrap($message, 73, " =\n", 1 );
              break;
          }
          break;
      }
      break;

    case false:
      //no special characters ==> use 7bit
      $email_encode = '7bit';
      $message_charset = 'us-ascii';
      $body = '';
      //break up any lines longer than 998 bytes (RFC 821)
      $message = wordwrap($message, 998, "\n", 1 );
      break;
  }

  //lines starting with "." get an additional "." added. (RFC 2821 - 4.5.2)
  $message = preg_replace("/^[\.]/m", '..', $message );
  //explode message body into separate lines
  $message_lines = explode("\n", $message );

return $message_lines;
}


//
//function to assemble mail headers
//

function headers($to, $subject, $email_encode, $message_charset ) {

  //set the date - in RFC 822 format
  $headers  = array('Date: '.date('r') );
  //clean return addresses
  $from     = clean(EMAIL_FROM);
  $reply_to = clean(EMAIL_REPLY_TO);

  //get rid of any line breaks (\r\n, \n, \r) in subject line
  $subject = str_replace(array("\r\n", "\r", "\n"), ' ', $subject );
  //reinstate any HTML in subject back to text
  $subject =& clean($subject );

  //now the prepare the 'to' header
  $line   = 'To:'.join(', ', (array)$to );
  //lines longer than 998 characters are broken up to separate lines (RFC 821)
  // (end long line with \r\n, and begin new line with \t)
  while(strlen($line ) > 998 ) {
    $pos = strrpos(substr($line, 0, 998 ), ' ' );
    $headers[] = substr($line, 0, $pos );
    $line = "\t".substr($line, $pos + 1 );
  }
  $headers[] = $line;
  //'from' header
  $headers = array_merge($headers, header_encoding('From:', ABBR_MANAGER_NAME, '<'.$from.'>' ) );
  //reply to
  $headers[] = 'Reply-To: '.$reply_to;
  //'subject' header
  $headers = array_merge($headers, header_encoding('Subject:', $subject, '' ) );
  //assemble remaining message headers (RFC 821 / RFC 2045)
  $headers[] = 'Message-Id: <'.md5(mt_rand()).'@'.$_SERVER['SERVER_NAME'].'>';
  $headers[] = 'X-Mailer: WebCollab (PHP/'.phpversion().')';
  $headers[] = 'X-Priority: 3';
  $headers[] = 'X-Sender: '.$reply_to;
  $headers[] = 'Return-Path: <'.$reply_to.'>';
  $headers[] = 'Mime-Version: 1.0';
  $headers[] = 'Content-Type: text/plain; charset='.$message_charset;
  $headers[] = 'Content-Transfer-Encoding: '.$email_encode;
  $headers[] = '';

return $headers;
}

//
//function to encode mail headers with 'quoted printable'
//

function header_encoding($header_type, $header, $header_suffix='' ) {

  //encode subject with 'printed-quotable' if high ASCII characters are present
  switch(preg_match('/([\177-\377])/', $header ) ) {
    case false:
      //no encoding required
      $header_lines = array(substr($header_type .$header .$header_suffix, 0, 985 ) );
      break;

    case true:
      switch(UNICODE_VERSION) {
        case 'Y':
          //base64 encoding to RFC 2047
          $line = base64_encode($header );
          $s = $header_type;
          //lines are no longer than 76 characters including '?' and '=' (RFC 2047)
          //  - each encoded line portion is rounded to multiple of 4 octets
          $max_len = floor((76 - (strlen(CHARACTER_SET) + 5 ) - 2) / 4 ) * 4;

          while(strlen($line) > $max_len ) {
            $header_lines[] = $s."=?".CHARACTER_SET."?B?".substr($line, 0, $max_len )."?=";
            $line = substr($line, $max_len );
            //start additional lines with <space> (RFC 2047)
            $s = ' ';
          }

          //output any remaining line (will be less than $max_len characters long)
          $header_lines[] = $s."=?".CHARACTER_SET."?B?".$line."?= ".$header_suffix;
          break;

        case 'N':
        default:
          //encode line with 'quoted-printable' (RFC 2045 / RFC 2047)
          // replace high ascii, control, =, ?, <tab> and <space> characters (RFC 2045)
          $line = preg_replace('/([\000-\010\011\013\014\016-\037\040\075\077\177-\377])/e', "'='.sprintf('%02X', ord('\\1'))", $header);
          $s = $header_type;
          //break into lines no longer than 76 characters including '?' and '=' (RFC 2047)
          $max_len = 76 - strlen(CHARACTER_SET ) - 8;

          while(strlen($line ) > $max_len ) {
            //don't split line around coded character (eg. '=20' == <space>)
            $pos = strrpos(substr($line, ($max_len - 3 ), 3 ), '=' );

            if($pos === false ) {
              //no coded characters in split zone - safe to split here
              $split = $max_len;
            }
            else {
              //encoded characters within split zone - adjust to avoid splitting encoded word
              $split = ($max_len - 3 ) + $pos;
            }

            $header_lines[] = $s.'=?'.CHARACTER_SET.'?Q?'.substr($line, 0, $split).'?=';
            $line = substr($line, $split );
            //start additional lines with <space> (RFC 2047)
            $s = ' ';
          }
          //output any remaining line (will be less than $max_len characters long)
          $header_lines[] = $s.'=?'.CHARACTER_SET.'?Q?'.$line.'?= '.$header_suffix;
          break;
        }
      break;
  }
  return $header_lines;
}

//
//function to get a response from a SMTP command to the server
//

function response() {

  global $connection, $log;

  $res = '';

  while($str = fgets($connection, 256 ) ) {
    $res .= $str;
    $log .= 'S : '.$str;

    //<space> after three digit code indicates this is last line of data ("-" for more lines)
    if(strpos($str, ' ' ) == 3 ) {
      break;
    }
  }

  return $res;
}


 function debug($message='Bad response received'){

   global $connection, $log;

   if(DEBUG === 'Y' ) {
     $time_out = '';

     if($connection ) {
       $meta = stream_get_meta_data($connection);

       if($meta['timed_out'] ) {
         $time_out = '<br /><br />Socket timeout has occurred';
       }
     }
     //we don't use error() because email may not work!
     warning('Email error debug', nl2br($log).$message.$time_out );
   }
   else {
     warning('Internal email fault', "Not able to send your email.<br /><br />\n".
             "Please contact your administrator for more information.<br /><br />\n".
             "(Enable debugging in config.php for more detail)" );
   }
   return;
 }
?>