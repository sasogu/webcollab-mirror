<?php
/*
  $Id$
  
  (c) 2002 - 2004 Andrew Simpson <andrew.simpson at paradise.net.nz>

  WebCollab
  ---------------------------------------
  
  Based on original file written for Core APM by Dennis Fleurbaaij 2001/2002

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

  Lists files assigned to a task

*/

require_once("path.php" );
require_once(BASE."includes/security.php" );

include_once(BASE."includes/details.php" );

$content = "";

if( ! isset($_REQUEST["taskid"]) || ! is_numeric($_REQUEST["taskid"]) )
  error("File list", "The taskid input is not valid" ); 

$taskid = intval($_REQUEST["taskid"]);

//check usergroup security
require_once( BASE."includes/usergroup_security.php" );

//get the files from this task
$q = db_query("SELECT files.oid AS oid,
                        files.id AS id,
                        files.filename AS filename,
                        files.uploaded AS uploaded,
                        files.size AS size,
                        files.mime AS mime,
                        files.description AS description,
                        files.uploader AS uploader,
                        users.id AS userid,
                        users.fullname AS username
                        FROM files
                        LEFT JOIN users ON (users.id=files.uploader)
                        WHERE files.taskid=$taskid
                        ORDER BY uploaded" );

if(db_numrows($q ) != 0 ) {

  $content .= "<table border=\"0\">\n";

  //show them
  for($i=0 ; $row = @db_fetch_array($q, $i) ; $i++ ) {

    //file part
    $content .= "<tr><td><a href=\"files.php?x=$x&amp;action=download&amp;fileid=".$row["id"]."\" target=\"filewindow\">".$row["filename"]."</a> <small>(".$row["size"].$lang["bytes"].") </small>";

    //owners of the file and admins have a "delete" option
    if( ($admin == 1) || ($uid == $taskid_row["owner"] ) || ($uid == $row["uploader"] ) ) {
      $content .= "&nbsp;<font class=\"textlink\">[<a href=\"files.php?x=$x&amp;action=submit_del&amp;fileid=".$row["id"]."&amp;taskid=$taskid\" onclick=\"return confirm('".sprintf( $lang["del_file_javascript_sprt"], $row["filename"] )."' )\">".$lang["del"]."</a>]</font></td></tr>\n";
    } else
      $content .= "</td></tr>\n";

    //user part
    $content .= "<tr><td>".$lang["uploader"]." <a href=\"users.php?x=$x&amp;action=show&amp;userid=".$row["userid"]."\">".$row["username"]."</a> (".nicetime( $row["uploaded"] ).")</td></tr>\n";

    //show description
    if( $row["description"] != "" )
      $content .= "<tr><td><small><i>".$row["description"]."</i></small></td></tr>\n";

    //padding for next entry
    $content .= "<tr><td>&nbsp;</td></tr>\n";
  }
  $content .= "</table>";
}

$content .= "<font class=\"textlink\">[<a href=\"files.php?x=$x&amp;taskid=$taskid&amp;action=upload\">".$lang["add_file"]."</a>]</font>";

new_box($lang["files_assoc_".$type], $content, "boxdata2" );

?>