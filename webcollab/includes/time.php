<?php
/*
  $Id$
  
  (c) 2002 - 2004 Andrew Simpson <andrew.simpson at paradise.net.nz>

  WebCollab
  ---------------------------------------
  Based on original file written for Core APM by Dennis Fleurbaaij, Andrew Simpson &
  Marshall Rose 2001/2002
  
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

  Some functions to get db <-> user and user <-> code time.

*/

//
// Create a pgsql/mysql datetime stamp
//
function date_to_datetime($day, $month, $year ) {
  global $lang, $month_array;

  //check for valid calendar date
  if( ! checkdate($month, $day, $year ) ) {
    warning($lang["invalid_date"], sprintf($lang["invalid_date_sprt"], $year."-".$month_array[$month ]."-".$day ) );
  }
  
  //format is 2004-08-02 00:00:00
  //(security note: formatted string here prevents SQL injection attacks)
  return sprintf("%04d-%02d-%02d 00:00:00", $year, $month, $day );
}

//
// Strip the UTC offset from a date variable and make it look nice
//
function nicedate($timestamp ) {
  global $month_array;
  if($timestamp == "" ) {
    $nicedate = "";
    return $nicedate;
  }
  $date_array = explode("-", substr($timestamp, 0, 10) );
  
  //format is 2004-Aug-02
  return sprintf("%s-%s-%02d", $date_array[0], $month_array[(int)($date_array[1])], (int)$date_array[2]);
}

//
// Strip the UTC offset from a date *and time* variable and make it look nice
//
function nicetime($timestamp ) {
  global $month_array, $DATABASE_TYPE;

  if($timestamp == "" ) {
    $nicetime = "";
    return $nicetime;
  }
  $date_array = explode("-", substr($timestamp, 0, 10 ) );
  $time_array = explode(":", substr($timestamp, 11, 5 ) );
  
  if($DATABASE_TYPE == "postgresql"){ 
  
    //postgres' has timezone information in the data output
    $timezone = substr($timestamp, -3 );
        
    //format is 2004-Aug-02 18:06 +1200 
    return sprintf("%d-%s-%02d %02d:%02d %s00", $date_array[0], $month_array[(int)($date_array[1])], $date_array[2], $time_array[0], $time_array[1], $timezone );
  }
    
  //MySQL with manually set timezone
  //format is 2004-Aug-02 18:06 +1200  
  return sprintf("%d-%s-%02d %02d:%02d %s", $date_array[0], $month_array[(int)($date_array[1])], $date_array[2], $time_array[0], $time_array[1], date("O") );
}
  
//
// Give back a row that holds the date which comes from a pg/my timestamp
//
function date_select_from_timestamp($timestamp="" ) {

  if($timestamp == "" )
    return date_select(-1, -1, -1 );
    
  //deparse the line
  $date_array = explode("-", substr($timestamp, 0, 10 ) );
  
  //show line
  return date_select($date_array[2], $date_array[1], $date_array[0] );
}

//
//show a date-time selection row
//
function date_select($day=-1, $month=-1, $year=-1 ) {
  global $month_array, $DATABASE_TYPE, $TZ;

  //filter for no date set
  if($day == -1 || $month == -1 || $year == -1 ) {
   if($DATABASE_TYPE == "postgresql" && $TZ != NULL )
     $epoch = date("U") - date("Z") + ($TZ * 3600);
   else
     $epoch = date("U");
   
    $day = date("d", $epoch );
    $month = date("m", $epoch );
    $year = date("Y", $epoch );
  }

  //day
  $content = "<select id=\"day\" name=\"day\">\n";
  for($i=1 ; $i<32 ; $i++ ) {
    $content .= "<option value=\"$i\"";

    if($day == $i )
      $content .= " selected=\"selected\"";

    $content .= ">$i</option>\n";
  }
  $content .=  "</select>\n";

  //month (must be in decimal, 'cause that's what postgres uses!)
  $content .= "<select id=\"month\" name=\"month\">\n";
  for( $i=1; $i<13 ; $i++) {
    $content .= "<option value=\"$i\"";

    if($month == $i )
      $content .= " selected=\"selected\"";

    $content .= ">".$month_array[($i)]."</option>\n";
  }
  $content .=  "</select>\n";

  //year
  $content .= "<select id=\"year\" name=\"year\">\n";
  for($i=2001; $i<2015 ; $i++ ) {
    $content .= "<option value=\"$i\"";

    if($year == $i )
      $content .= " selected=\"selected\"";

    $content .= ">".$i."</option>\n";
  }
  $content .=  "</select>\n";

 return $content;
}

?>