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

  Easy user manager

*/

require_once("path.php" );
require_once(BASE."includes/security.php" );

$content = "";

//get some stupid errors
if( ! isset($_GET["userid"]) || ! is_numeric($_GET["userid"]) || $_GET["userid"] == 0 )
  error("User show", "No userid was given" );

$userid = $_GET["userid"];

//select
$q = db_query("SELECT * FROM users WHERE id=$userid" );

//get info
if( ! ($row = db_fetch_array($q, 0 ) ) )
  error("Database error", "Error in fetching result" );

if($row["deleted"] == 't' )
  $content .= "<br /><b><centrt><font color=\"red\">".$lang["user_deleted"]."</font></center></b><br />";

$content .= "<br /><table border=\"0\">".
              "<tr><td>".$lang["login"].":</td><td>".$row["name"]."</td></tr>\n".
              "<tr><td>".$lang["full_name"].":</td><td>".$row["fullname"]."</td></tr>\n".
              "<tr><td>".$lang["email"].":</td><td><A href=\"mailto:".$row["email"]."\">".$row["email"]."</A></td></tr>\n";

if($row["admin"] == "t" )
  $content .= "<tr><td>".$lang["admin"].":</td><td>".$lang["yes"]."</td></tr>\n";
else
  $content .= "<tr><td>".$lang["admin"].":</td><td>".$lang["no"]."</td></tr>\n";

//create a list of all the groups the user is in
$q = db_query("SELECT usergroups.name
                      FROM usergroups
                      LEFT JOIN usergroups_users ON (usergroups_users.usergroupid=usergroups.id)
                      WHERE usergroups_users.userid=".$row["id"] );

if(db_numrows($q) < 1 ) {
  $content .= "<tr><td>".$lang["usergroups"].":</td><td>".$lang["no_usergroup"]."</td></tr>\n";
}
else{
  $content .= "<tr><td>".$lang["usergroups"].": </td><td>";
  for($i=0 ; $row = @db_fetch_array($q, $i ) ; $i++ ){
    $content .= $row["name"]." ";
  }
  $content .= "</td></tr>\n";
}

//get the last login time of a user
$q = db_query("SELECT lastaccess FROM logins WHERE user_id=$userid" );
$content .=   "<tr><td>".$lang["last_time_here"]."</td><td>".nicetime(@db_result( $q, 0, 0 ))."</td></tr>\n";

//Get the number of tasks created
$q = db_query("SELECT COUNT(*) FROM tasks WHERE creator=$userid" );
$content .=   "<tr><td>".$lang["number_items_created"]."</td><td>".db_result( $q, 0, 0 )."</td></tr>\n";

//Get the number of projects owned
$q = db_query("SELECT COUNT(*) FROM tasks WHERE owner=$userid AND parent=0" );
$content .=   "<tr><td>".$lang["number_projects_owned"]."</td><td>".($numberofprojectsowned = db_result( $q, 0, 0 ) )."</td></tr>\n";

//Get the number of tasks owned
$q = db_query("SELECT COUNT(*) FROM tasks WHERE owner=$userid AND parent<>0" );
$content .=   "<tr><td>".$lang["number_tasks_owned"]."</td><td>".($numberoftasksowned = db_result( $q, 0, 0 ) )."</td></tr>\n";

//Get the number of tasks completed that are owned
$q = db_query("SELECT COUNT(*) FROM tasks WHERE owner=$userid AND status='done' AND parent<>0" );
$content .=   "<tr><td>".$lang["number_tasks_completed"]."</td><td>".db_result( $q, 0, 0 )."</td></tr>\n";

//Get the number of forum posts
$q = db_query("SELECT COUNT(*) FROM forum WHERE userid=$userid" );
$content .=   "<tr><td>".$lang["number_forum"]."</td><td>".db_result( $q, 0, 0 )."</td></tr>\n";

//Get the number of files uploaded and the size
$q = db_query("SELECT SUM(size), COUNT(size) FROM files WHERE uploader=$userid" );
$content .=   "<tr><td>".$lang["number_files"]."</td><td>".db_result( $q, 0, 1 )."</td></tr>\n";
$size = db_result( $q, 0, 0 );

if($size == "") {
  $size = 0;
}
$content .=   "<tr><td>".$lang["size_all_files"]."</td><td>".$size.$lang["bytes"]."</td></tr>\n".
            "</table>";

new_box($lang["user_info"], $content );


//shows quick links to the tasks that the user owns

if( $numberoftasksowned + $numberofprojectsowned > 0 ) {
  $content = "<ul>";

  //Get the number of tasks
  $q = db_query("SELECT id, name, parent, status, finished_time FROM tasks WHERE owner=$userid" );

  //show them
  for($i=0 ; $row = @db_fetch_array($q, $i ) ; $i++ ) {

    $status_content = "";

    //status
    switch( $row["status"] ) {
      case "done":
        $status_content="<font color=\"#006400\">(".$task_state["done"]."&nbsp;".nicedate($row["finished_time"]).")</font>";
        break;

      case "active":
        $status_content="<font color=\"#FFA500\">(".$task_state["active"].")</font>";
        break;

      case "notactive":
        $status_content="<font color=\"#006400\">(".$task_state["planned"].")</font>";
        break;

      case "cantcomplete":
        $status_content="<font color=\"#0000FF\">(".$task_state["cantcomplete"]."&nbsp;".nicedate($row["finished_time"]).")</font>";
        break;
    }

    if($row["parent"] == 0 )
      //project
      $status_content ="(".$lang["pproject"].")";

    //show the task
    $content .= "<li><a href=\"tasks.php?x=$x&amp;action=show&amp;taskid=".$row["id"]."\">".$row["name"]."</a> ".$status_content."</li>\n";
  }

  $content .= "</ul>";
  new_box($lang["owned_tasks"], $content );

}

?>
