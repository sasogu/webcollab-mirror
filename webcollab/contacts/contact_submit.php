<?php
/*
  $Id$

  WebCollab
  ---------------------------------------
  Created as CoreAPM 2001/2002 by Dennis Fleurbaaij
  with much help from the people noted in the README

  Rewritten as WebCollab 2002/2003 (from CoreAPM Ver 1.11)
  by Andrew Simpson <andrew.simpson@paradise.net.nz>

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

  Management for contacts

*/

//get our location
if( ! @require( "path.php" ) )
  die( "No valid path found, not able to continue" );

include_once( BASE."includes/security.php" );

if( isset($_POST["contactid"]) )
  $contactid = $_POST["contactid"];

//edit, insert, delete ?
if( valid_string( $_REQUEST["action"] ) ) {

  switch( $_REQUEST["action"] ) {

    //insert a new contact
    case "insert":
          if( valid_string( $_POST["lastname"] ) && valid_string($_POST["firstname"] ) ){

        db_query( "INSERT INTO contacts(  firstname,
                                          lastname,
	  			          company,
				          tel_home,
				          gsm,
				          fax,
				          tel_business,
				          address,
				          postal,
				          city,
				          email,
					  notes,
				          added_by,
					  date )
                             values( '".safe_data($_POST["firstname"])."',
			             '".safe_data($_POST["lastname"])."',
				     '".safe_data($_POST["company"])."',
				     '".safe_data($_POST["tel_home"])."',
				     '".safe_data($_POST["gsm"])."',
				     '".safe_data($_POST["fax"])."',
				     '".safe_data($_POST["tel_business"])."',
				     '".safe_data($_POST["address"])."',
				     '".safe_data($_POST["postal"])."',
				     '".safe_data($_POST["city"])."',
				     '".safe_data($_POST["email"])."',
				     '".safe_data($_POST["notes"])."',
				     ".$uid.",
				     current_timestamp(0) )" );
      }else
        warning( $lang["contact_submit"], $lang["contact_warn"] );

      break;

    case "edit":
     //edit an existing entry
         if( valid_string( $_POST["lastname"]) && valid_string( $_POST["firstname"] ) && is_numeric( $contactid ) ) {

        db_query( "UPDATE contacts SET
					firstname='".safe_data($_POST["firstname"])."',
					lastname='".safe_data($_POST["lastname"])."',
					company='".safe_data($_POST["company"])."',
					tel_home='".safe_data($_POST["tel_home"])."',
					gsm='".safe_data($_POST["gsm"])."',
					fax='".safe_data($_POST["fax"])."',
					tel_business='".safe_data($_POST["tel_business"])."',
					address='".safe_data($_POST["address"])."',
					postal='".safe_data($_POST["postal"])."',
					city='".safe_data($_POST["city"])."',
					email='".safe_data($_POST["email"])."',
					notes='".safe_data($_POST["notes"])."',
					added_by=".$uid.",
					date=current_timestamp(0)
       					WHERE id = '".$contactid."'");

     }else
        warning( $lang["contact_submit"], $lang["contact_warn"] );

    break;

    case "delete":
      if( is_numeric( $contactid ) ) {
        //delete the contact
        db_query("DELETE FROM contacts WHERE id=".$contactid );
        } else {
        error( "Contact submission handler", "Invalid value specified for contactid" );
      }

      break;

    //default error
    default:
      error("Contacts submission handler", "I don't know what to do with your request. Please try again.");
      break;
  }

}
else
  error("Contacts submission engine", "You did not specify an action, request not handled. Please try again." );


//this is quite crappy but it works ;)
header("location: ".BASE."main.php?x=".$x );

?>
