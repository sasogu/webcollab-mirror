<?php
/*
  $Id: usergroup_submit.php 2179 2009-04-07 09:31:13Z andrewsimpson $

  (c) 2002 - 2011 Andrew Simpson <andrew.simpson at paradise.net.nz>

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

  Add a usergroup to the database

*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

//admins only
if( ! ADMIN ) {
  error('Unauthorised access', 'This function is for admins only.' );
}

if(empty($_POST['action'] ) ) {
  error('Usergroups submit', 'No action given' );
}

//check for valid form token
$token = (isset($_POST['token'])) ? (safe_data($_POST['token'])) : null;
token_check($token );

//if user aborts, let the script carry onto the end
ignore_user_abort(TRUE);

switch($_POST['action'] ) {

  //delete a usergroup
  case 'submit_del':


    if(! @safe_integer($_POST['usergroupid']) ) {
      error('Usergroup submit', 'Not a valid value for usergroupid' );
    }

    $usergroupid = $_POST['usergroupid'];

    db_begin();

    //delete the private forum posts for this usergroup
    $q = db_prepare('DELETE FROM '.PRE.'forum WHERE usergroupid=?' );
    db_execute($q, array($usergroupid ) );

    //delete the user entries out of usergroups_users
    $q = db_prepare('DELETE FROM '.PRE.'usergroups_users WHERE usergroupid=?' );
    db_execute($q, array($usergroupid ) );

    //delete the usergroup
    $q = db_prepare('DELETE FROM '.PRE.'usergroups WHERE id=?' );
    db_execute($q, array($usergroupid ) );

    //update the tasks table by resetting the deleted usergroup id to zero
    $q = db_prepare('UPDATE '.PRE.'tasks SET usergroupid=0 WHERE usergroupid=?' );
    @db_execute($q, array($usergroupid ) );

    db_commit();
    break;

  //insert a new usergroup
  case 'submit_insert':

    //check for valid form token
    $token = (isset($_POST['token'])) ? (safe_data($_POST['token'])) : null;
    token_check($token );

    if(empty($_POST['name'] ) ) {
      warning($lang['value_missing'], sprintf($lang['field_sprt'], $lang['usergroup_name'] ) );
    }
    $name        = safe_data($_POST['name']);
    $description = safe_data($_POST['description']);

    if( isset($_POST['private_group']) && ( $_POST['private_group'] === 'on' ) ) {
      $private_group = 1;
    }
    else {
      $private_group = 0;
    }

    //check for duplicates
    $q = db_prepare('SELECT COUNT(*) FROM '.PRE.'usergroups WHERE name=?' );
    db_execute($q, array($name ) );

    if(db_result($q, 0, 0 ) > 0 ) {
      warning($lang['add_usergroup'], sprintf($lang['usergroup_dup_sprt'], $name ) );
    }

    //begin transaction
    db_begin();

    $q = db_prepare('INSERT INTO '.PRE.'usergroups(name, description, private ) VALUES (?, ?, ?)' );
    db_execute($q, array($name, $description, $private_group ) );

    if(isset($_POST['member'] ) ) {

      // get the usergroupid
      $usergroupid = db_lastoid('usergroups_id_seq' );

      $q = db_prepare('INSERT INTO '.PRE.'usergroups_users(userid, usergroupid) VALUES(?, ?)' );

      (array)$member = $_POST['member'];
      $max = sizeof($member);
      for($i=0 ; $i < $max ; ++$i ) {
        if(isset($member[$i]) && safe_integer($member[$i] ) ) {
          db_execute($q, array($member[$i], $usergroupid ) );
        }
      }
    }
    //transaction complete
    db_commit();
    break;

  //edit a usergroup
  case 'submit_edit':

    //check for valid form token
    $token = (isset($_POST['token'])) ? (safe_data($_POST['token'])) : null;
    token_check($token );

    if(! @safe_integer($_POST['usergroupid'] ) ){
      error('Usergroup submit', 'Not a valid value for usergroupid' );
    }
    if(empty($_POST['name'] ) ){
      warning($lang['value_missing'], sprintf( $lang['field_sprt'], $lang['usergroup_name'] ) );
    }
    $name        = safe_data($_POST['name'] );
    $description = safe_data($_POST['description'] );
    $usergroupid = $_POST['usergroupid'];

    if( isset($_POST['private_group']) && ( $_POST['private_group'] === 'on' ) ) {
      $private_group = 1;
    }
    else {
      $private_group = 0;
    }
    //begin transaction
    db_begin();

    //do the update
    $q = db_prepare('UPDATE '.PRE.'usergroups SET name=?, description=?, private=? WHERE id=?' );
    db_execute($q, array($name, $description, $private_group, $usergroupid ) );

    //clean out existing usergroups_users then update with the new
    $q = db_prepare('DELETE FROM '.PRE.'usergroups_users WHERE usergroupid=?' );
    db_execute($q, array($usergroupid ) );

    if(isset($_POST['member'] ) ) {

      $q = db_prepare('INSERT INTO '.PRE.'usergroups_users(userid, usergroupid) VALUES(?, ?)' );

      (array)$member = $_POST['member'];
      $max = sizeof($member);
      for( $i=0 ; $i < $max ; ++$i ) {
	if(isset($member[$i]) && safe_integer( $member[$i] ) ) {
	  db_execute($q, array($member[$i], $usergroupid ) );
	}
      }
    }
    //transaction complete
    db_commit();
    break;

  //error case
  default:
    error('Usergroup submit', 'Invalid request given' );
    break;
}

header('Location: '.BASE_URL.'usergroups.php?x='.X.'&action=manage');

?>
