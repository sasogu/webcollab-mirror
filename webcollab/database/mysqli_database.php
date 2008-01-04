<?php
/*
  $Id$

  (c) 2005 - 2008 Andrew Simpson <andrew.simpson at paradise.net.nz>

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

  Creates a singular interface for mysqli database access.

*/

require_once('path.php' );

//set some base variables
$database_connection = '';
$delim = '';
$epoch = 'UNIX_TIMESTAMP( ';
$day_part  = 'DAYOFMONTH( ';
$date_type = '';

//
// connect to database
//
function db_connection() {

  global $database_connection, $db_error_message;

  //make connection
  if( ! ($database_connection = @mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME ) ) ) {
    $db_error_message = mysqli_connect_error();
    error('No database connection',  'Sorry but there seems to be a problem in connecting to the database server');
  }

  //set transaction mode for innodb
  @mysqli_autocommit($database_connection, true );

  //set timezone
  if(! mysqli_query($database_connection, "SET time_zone='".sprintf('%+d:%02d', (int)TZ, (TZ - floor(TZ) )*60 )."'" ) ) {
    $db_error_message = mysqli_error($database_connection);
    error("Database error", "Not able to set timezone. <br />Check that your version of MySQL is 4.1.3, or higher" );
  }

  return;
}

//
// Provides a safe way to do a query
//
function db_query($query, $die_on_error=1 ) {

  global $database_connection, $db_error_message ;

  if(! $database_connection ) db_connection();

  //do it
  if( ! ($result = @mysqli_query($database_connection, $query, MYSQLI_STORE_RESULT ) ) ) {
    $db_error_message = mysqli_error($database_connection);

    if($die_on_error ) {
      error('Database query error', 'The following query :<br /><br /><b>'.$query.' </b><br /><br />Had the following error:<br /><b>'.mysqli_error($database_connection).'</b>' );
    }
  }

  //all was okay return resultset
  return $result;
}

//
// escapes special characters in a string for use in a SQL statement
//
function db_escape_string($string ) {

  global $database_connection;

  if(! $database_connection ) db_connection();

  return mysqli_real_escape_string($database_connection, $string );
}

//
// number of rows in result
//
function db_numrows($q ) {

  return mysqli_num_rows($q );
}

//
// get single result set
//
function db_result($q, $row=0, $field=0 ) {

  if($row > 0 ) mysqli_data_seek($q, $row );

  $result_row = mysqli_fetch_array($q, MYSQLI_NUM );

  return $result_row[$field];
}

//
// fetch array result set
//
function db_fetch_array($q, $row=0 ) {

  $result_row = mysqli_fetch_array($q, MYSQLI_ASSOC );

  if($result_row === NULL ) return false;

return $result_row;
}

//
// fetch enumerated array result set
//
function db_fetch_num($q, $row=0 ) {

  $result_row = mysqli_fetch_array($q, MYSQLI_NUM );

  if($result_row === NULL ) return false;

return $result_row;
}

//
// last oid
//
function db_lastoid($seq ) {

  global $database_connection;

  return mysqli_insert_id($database_connection );
}

//
// return data pointer to begining of data set
//
function db_data_seek($q ) {

  if(mysqli_num_rows($q ) == 0 ) return true;

  return mysqli_data_seek($q, 0 );
}

//
//free memory
//
function db_free_result($q ) {

  return mysqli_free_result($q );
}

//
//begin transaction
//
function db_begin() {

  global $database_connection;

  return @mysqli_query($database_connection, 'START TRANSACTION' );
}

//
//rollback transaction
//
function db_rollback() {

  global $database_connection;

  return @mysqli_rollback($database_connection );
}

//
//commit transaction
//
function db_commit() {

  global $database_connection;

  return @mysqli_commit($database_connection );
}

//
//sets the required session client encoding
//
function db_user_locale($encoding ) {

  global $database_connection, $db_error_message;

  if(! $database_connection ) db_connection();

  switch(strtoupper($encoding ) ) {

    case 'ISO-8859-1':
      $my_encoding = 'latin1';
      break;

    case 'UTF-8':
      $my_encoding = 'utf8';
      break; 

    case 'ISO-8859-2':
      $my_encoding = 'latin2';
      break;

    case 'ISO-8859-7':
      $my_encoding = 'greek';
      break;

    case 'ISO-8859-9':
      //ISO-8859-9 === latin5 in MySQL!!
      $my_encoding = 'latin5';
      break;

     case 'KOI8-R':
      $my_encoding = 'koi8r';
      break;

    case 'WINDOWS-1251':
      $my_encoding = 'cp1251';
      break;

   default:
      $my_encoding = 'latin1';
      break;
  }

  //set character set -- 1
  if(! @mysqli_query($database_connection, "SET NAMES '".$my_encoding."'" ) ) {
    $db_error_message = mysqli_error($database_connection);
    error("Database error", "Not able to set ".$my_encoding." client encoding" );
  }

  //set character set -- 2
  if(! @mysqli_query($database_connection, "SET CHARACTER SET ".$my_encoding ) ) {
    $db_error_message = mysqli_error($database_connection);
    error("Database error", "Not able to set CHARACTER SET : ".$my_encoding );
  }

  return true;
}

?>