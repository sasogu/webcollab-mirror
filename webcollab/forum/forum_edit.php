<?php
/*
  $Id: forum_add.php 1704 2008-01-01 06:09:52Z andrewsimpson $

  (c) 2002 - 2008 Andrew Simpson <andrew.simpson at paradise.net.nz>

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

  Give the user an interface to edit a forum-reply

*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

//includes
include_once(BASE.'includes/admin_config.php' );

//secure vars
$content = '';

if(! @safe_integer($_REQUEST['postid']) ) {
  error('Forum edit', 'Not a valid value for postid');
}
$postid = $_REQUEST['postid'];

//find out the tasks' name
$q = db_query('SELECT '.PRE.'forum.text AS text,
                      '.PRE.'tasks.name AS name
                      FROM '.PRE.'forum
                      LEFT JOIN '.PRE.'tasks ON ('.PRE.'tasks.id='.PRE.'forum.taskid)
                      WHERE '.PRE.'forum.userid='.UID.' AND '.PRE.'forum.id='.$postid );

if(db_numrows($q) == 0 ) {
  error('Forum edit', 'You are not authorised to edit that post.');
}

$row = db_fetch_array($q, 0 );

$content .= "<form method=\"post\" action=\"forum.php\">\n";
//set some hidden values
$content .=  "<fieldset><input type=\"hidden\" name=\"x\" value=\"".$x."\" />".
             "<input type=\"hidden\" name=\"action\" value=\"submit_edit\" />\n".
             "<input type=\"hidden\" name=\"postid\" value=\"".$postid."\" /></fieldset>\n";

//build up the text-entry part
$content .=   "<table>\n".
              "<tr><td>".$lang['message']."</td><td><textarea id=\"text\" name=\"text\" rows=\"10\" cols=\"60\">".$row['text']."</textarea></td></tr>\n".
              "</table>\n".
              "<table class=\"celldata\">\n".
              "<tr><td><label for=\"owner\">".$lang['forum_email_owner']."</label></td><td><input type=\"checkbox\" name=\"mail_owner\" id=\"owner\" ".DEFAULT_OWNER." /></td></tr>\n".
              "<tr><td><label for=\"usergroup\">".$lang['forum_email_usergroup']."</label></td><td><input type=\"checkbox\" name=\"mail_group\" id=\"usergroup\" ".DEFAULT_GROUP." /></td></tr>\n".
              "</table>\n".
              "<p><input type=\"submit\" value=\"".$lang['post']."\" onclick=\"return fieldCheck()\" /></p>".
              "</form>\n";

new_box(sprintf($lang['post_message_sprt'], $row['name'] ), $content );

?>