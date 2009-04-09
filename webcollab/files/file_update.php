<?php
/*
  $Id: file_upload.php 1747 2008-02-03 08:14:34Z andrewsimpson $

  (c) 2002 - 2009 Andrew Simpson <andrew.simpson at paradise.net.nz>

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

  Gives users the ability to add files.

*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

//includes
require_once(BASE.'includes/admin_config.php' );
require_once(BASE.'includes/usergroup_security.php' );

//deny guest users
if(GUEST ){
 warning($lang['access_denied'], $lang['not_owner'] );
}

//check if file uploads are allowed in php.ini file
if( ! (bool)ini_get('file_uploads' ) ) {
  warning($lang['error'], $lang['no_file_uploads'] );
}

if( ! @safe_integer($_GET['taskid']) ) {
  error('File upload', 'Not a valid taskid');
}
$taskid = $_GET['taskid'];

if( ! @safe_integer($_GET['fileid']) ) {
  error('File upload', 'Not a valid fileid');
}
$fileid = $_GET['fileid'];

$return = 0;
if(isset($_GET['admin']) && $_GET['admin'] == 1 ) {
  $return = 1;
}

//check usergroup security
$taskid = usergroup_check($taskid );

//get filename
$filename = db_result(db_query('SELECT filename FROM '.PRE.'files WHERE id='.$fileid ), 0, 0 );

//update file
$content =  "<form method=\"post\" enctype=\"multipart/form-data\"  action=\"files.php\">\n".
            "<fieldset><input type=\"hidden\" name=\"x\" value=\"".X."\" />\n".
            "<input type=\"hidden\" name=\"action\" value=\"submit_update\" />\n".
            "<input type=\"hidden\" name=\"token\" value=\"".TOKEN."\" />\n".
            "<input type=\"hidden\" name=\"taskid\" value=\"".$taskid."\" />\n".
            "<input type=\"hidden\" name=\"old_fileid\" value=\"".$fileid."\" />\n".
            "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".FILE_MAXSIZE."\" /></fieldset>\n".
            "<table class=\"celldata\">\n".
            "<tr><td>".$lang['file']."</td><th>".$filename."</th></tr>\n".
            "<tr><td>".$lang['file_choose']."</td><td><input id=\"userfile\" type=\"file\" name=\"userfile[]\" size=\"60\"  /></td></tr>\n".
            "<tr><td>".$lang['description'].":</td> <td><textarea name=\"description\" rows=\"25\" cols=\"88\"></textarea></td></tr>\n".
            "<tr><td></td><td>".sprintf( $lang['max_file_sprt'], FILE_MAXSIZE/1000 )."</td></tr>\n".
            "</table>\n".
            "<table class=\"celldata\">\n".
            "<tr><td><label for=\"owner\">".$lang['file_email_owner']."</label></td><td><input type=\"checkbox\" name=\"mail_owner\" id=\"owner\" ".DEFAULT_OWNER." /></td></tr>\n".
            "<tr><td><label for=\"usergroup\">".$lang['file_email_usergroup']."</label></td><td><input type=\"checkbox\" name=\"mail_group\" id=\"usergroup\" ".DEFAULT_GROUP." /></td></tr>\n".
            "</table>\n".
            "<p><input type=\"submit\" value=\"".$lang['upload']."\" onclick=\"return fieldCheck('userfile')\" /></p>\n".
            "</form>\n";

//delete file
$content .= "<form id=\"delete_file\" method=\"post\" action=\"files.php\"".
            "onclick=\"return confirm( '".sprintf( $lang['del_file_javascript_sprt'], javascript_escape($row['filename']) )."' )\" >\n".
            "<fieldset><input type=\"hidden\" name=\"x\" value=\"".X."\" />\n".
            "<input type=\"hidden\" name=\"action\" value=\"submit_del\" />\n".
            "<input type=\"hidden\" name=\"fileid\" value=\"".$fileid."\" />\n".
            "<input type=\"hidden\" name=\"taskid\" value=\"".$taskid."\" />\n".
            "<input type=\"hidden\" name=\"return\" value=\"".$return."\" />\n".
            "<input type=\"hidden\" name=\"token\" value=\"".TOKEN."\" /></fieldset>\n".
            "<p><input type=\"submit\" value=\"".$lang['delete']."\" /></p>\n".
            "</form>\n";

new_box($lang['add_file'], $content );

?>