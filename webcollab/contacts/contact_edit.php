<?php
/*
  $Id: contact_edit.php 2213 2009-05-08 20:37:07Z andrewsimpson $

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

  Edit the contacts database.

*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

if(GUEST ) {
  error('Contact edit', 'Guest not authorised' );
}

//we need a valid contactid
if(! @safe_integer($_POST['contactid']) ){
  error('Contact edit', 'Not a valid value for contactid');
}

$contactid = $_POST['contactid'];

//get contact information
$q = db_prepare('SELECT * FROM '.PRE.'contacts WHERE id=? LIMIT 1' );
db_execute($q, array($contactid ) );

if( ! ($row = db_fetch_array($q, 0 ) ) ){
  error('Contact edit', 'There is no information for that contact');
}

//check usergroups
if($row['taskid'] ) {
  require_once(BASE.'includes/usergroup_security.php' );
  usergroup_check($row['taskid']);
}

$content =
    "<form method=\"post\" action=\"contacts.php\" onsubmit=\"return fieldCheck('lastname', 'firstname' )\" >\n".
    "<fieldset><input type=\"hidden\" name=\"action\" value=\"submit_edit\" />\n".
    "<input type=\"hidden\" name=\"contactid\" value=\"".$contactid."\" />\n".
    "<input type=\"hidden\" name=\"x\" value=\"".X."\" />\n".
    "<input type=\"hidden\" id=\"alert_field\" name=\"alert\" value=\"".$lang['missing_field_javascript']."\" />\n".
    "<input type=\"hidden\" id=\"url\" name=\"url\" value=\"".$lang['url_javascript']."\" />\n".
    "<input type=\"hidden\" id=\"image_url\" name=\"image_url\" value=\"".$lang['image_url_javascript']."\" /></fieldset>\n".
    "<table class=\"celldata\">\n".
    "<tr><td><i>".$lang['firstname']."</i></td><td><input id=\"firstname\" type=\"text\" name=\"firstname\" value=\"".$row['firstname']."\"class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['lastname']."</i></td><td><input id=\"lastname\" type=\"text\" name=\"lastname\" value=\"".$row['lastname']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['company']."</i></td><td><input type=\"text\" name=\"company\" value=\"".$row['company']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['home_phone']."</i></td><td><input type=\"text\" name=\"tel_home\" value=\"".$row['tel_home']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['mobile']."</i></td><td><input type=\"text\" name=\"gsm\" value=\"".$row['gsm']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['fax']."</i></td><td><input type=\"text\" name=\"fax\" value=\"".$row['fax']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['bus_phone']."</i></td><td><input type=\"text\" name=\"tel_business\" value=\"".$row['tel_business']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['address']."</i></td><td><input type=\"text\" name=\"address\" value=\"".$row['address']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['postal']."</i></td><td><input type=\"text\" name=\"postal\" value=\"".$row['postal']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['city']."</i></td><td><input type=\"text\" name=\"city\" value=\"".$row['city']."\" class=\"size\" /></td></tr>\n".
    "<tr><td><i>".$lang['email_contact']."</i></td><td><input type=\"text\" name=\"email\" value=\"".$row['email']."\" class=\"size\" /></td></tr>\n".
    "</table>\n".
    "<p><i>".$lang['notes']."</i><br />".
    "<script type=\"text/javascript\"> edToolbar('notes');</script>".
    "<textarea  name=\"notes\" id=\"notes\" rows=\"6\" cols=\"50\">".$row['notes']."</textarea></p>\n";

//edit options
$content .=
    "<p><input type=\"submit\" value=\"".$lang['submit_changes']."\" /></p>".
    "</form>";

//delete options
$content .=
    "<form method=\"post\" action=\"contacts.php\" onsubmit=\"return confirm('".$lang['confirm_del_javascript']."')\">\n".
    "<fieldset><input type=\"hidden\" name=\"x\" value=\"".X."\" />\n".
    "<input type=\"hidden\" name=\"action\" value=\"submit_delete\" />\n".
    "<input type=\"hidden\" name=\"contactid\" value=\"".$contactid."\" /></fieldset>\n".
    "<p><input type=\"submit\" value=\"".$lang['del_contact']."\"/>\n".
    "</p></form>";

new_box( $lang['contact_info'], $content );

?>