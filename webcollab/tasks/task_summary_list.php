<?php
/*

  $Id$

  (c) 2002 Marshall Rose (attributed)
  (c) 2002 - 2007 Andrew Simpson

  WebCollab
  ---------------------------------------

  Based on file originally written as part of Core Lan Org by Marshall Rose 2002.

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

  Lists all tasks in a quick summary fashion

*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

//includes
include_once(BASE.'tasks/task_common.php' );
include_once(BASE.'includes/time.php' );

//initialise variables
$no_access_project = array();

//
// MAIN FUNCTION
//


function project_summary( $tail, $depth=0, $equiv='' ) {
  global $x, $GID, $lang, $task_state, $task_priority;
  global $no_access_project;
  global $sortby;
  global $epoch;

  $q = db_query( 'SELECT '.PRE.'tasks.id AS id,
                         '.PRE.'tasks.parent AS parent,
                         '.PRE.'tasks.name AS taskname,
                         '.PRE.'tasks.deadline AS deadline,
                         '.PRE.'tasks.status AS status,
                         '.PRE.'tasks.priority AS priority,
                         '.PRE.'tasks.owner AS owner,
                         '.PRE.'tasks.taskgroupid AS taskgroupid,
                         '.PRE.'tasks.usergroupid AS usergroupid,
                         '.PRE.'tasks.projectid AS projectid,
                         '.PRE.'tasks.completed AS completed,
                         '.$epoch.' deadline) AS due,
                         '.$epoch.' '.PRE.'tasks.edited) AS edited,
                         '.$epoch.' '.PRE.'tasks.lastforumpost) AS lastpost,
                         '.$epoch.' '.PRE.'tasks.lastfileupload) AS lastfileupload
                         '.$equiv.'
                         FROM '.PRE.'tasks
                         '.$tail );

  // if no result, then do nothing
  if(db_numrows($q) < 1 ) {
    return '';
  }

  //reset variables
  $result = '';

  for( $i=0 ; $row = @db_fetch_array($q, $i ) ; ++$i) {

    //don't show tasks in closed usergroup projects
    if( (! ADMIN ) && isset($no_access_project[($row['projectid'])] ) ) {

      //$no_access_project[($row['projectid'])] == 'usergroupid' of project
      if(! isset($GID[ ($no_access_project[($row['projectid'])] ) ] ) ) {
        continue;
      }
    }

    $due = round( ($row['due'] - TIME_NOW )/86400 );

    $seenq = db_query( 'SELECT '.$epoch.' time) FROM '.PRE.'seen WHERE taskid='.$row['id'].' AND userid='.UID.' LIMIT 1' );

    if(db_numrows($seenq ) > 0 ) {
      $seen = db_result($seenq, 0, 0 );
    }
    else {
      $seen = 0;
    }

    //flags column
    $alink = "<a href=\"tasks.php?x=".$x."&amp;action=show&amp;taskid=".$row['id']."\">";

    if( (db_numrows($seenq ) ) < 1 ) {
      $f1 = $alink.'C</a>';
    }
    else if( ($seen - $row['edited'] ) < 0 ) {
      $f1 = $alink.'M</a>';
    }
    else {
      $f1 = '';
    }
    if( ($seen - $row['lastpost'] ) < 0 ) {
      $f2 = $alink.'P</a>';
    }
    else {
      $f2 = '';
    }
    if( ($seen - $row['lastfileupload'] ) < 0 ) {
      $f3 = $alink.'F</a>';
    }
    else {
      $f3 = '';
    }

    if( $due < 0 ) {
      $color = 'red';
    }
    else if( $due == 0 ) {
      $color = 'green';
    }
    else {
      $color = '';
    }

    //status column
    if( ($row['parent'] == 0 ) ) {

      switch($row['status'] ) {
        case 'notactive':
          $color = '';
          $date = '';
          $status =  $task_state['task_planned'];
          break;

        case 'nolimit':
          $color = '';
          $date = '';
          $status = '';
          break;

        case 'cantcomplete':
          $color = '';
          $date = '';
          $status =  "<span class=\"blue\">".$task_state['cantcomplete']."</span>";
          break;

        default:
          $date = nicedate($row['deadline'] );
          if(db_result(db_query('SELECT COUNT(*) FROM '.PRE.'tasks WHERE projectid='.$row['id'].' AND status<>\'done\' AND parent<>0 LIMIT 1' ), 0, 0 ) == 0 ) {
            $color = 'green';
            $status = $task_state['done'];
          }
          else {
            $status = $lang['project'] ;
          }
          break;
      }
    }
    else {

      switch( $row['status'] ) {
        case 'done':
          $color = '';
          $date = nicedate($row['deadline'] );
          $status =  "<span class=\"green\">".$task_state['done']."</span>";
          break;

        case 'created':
          $date = nicedate($row['deadline'] );
          $status =  $task_state['new'];
          break;

        case 'active':
          $date = nicedate($row['deadline'] );
          $color = 'orange';
          $status =  $task_state['task_active'];
          break;

        case 'notactive':
          $color = 'grey';
          $date = '';
          $status =  $task_state['task_planned'];
          break;

        case 'cantcomplete':
          $color = '';
          $date = '';
          $status =  "<span class=\"blue\">".$task_state['cantcomplete']."</span>";
          break;

        default:
          $date = nicedate($row['deadline'] );
          $status =  "<span class=\"orange\">".$row['status']."</span>";
          break;
      }
    }

    //priority column
    if( ($row['parent'] == 0 ) ) {

      switch($row['priority'] ) {
        case 0:
          $date = '';
          $priority =  $task_state['dontdo'];
          break;

        case 1:
          $date = '';
          $priority =  $task_state['low'];
          break;

        case 2:
          $date = '';
          $priority =  "<span class=\"blue\">".$task_state['normal']."</span>";
          break;

        case 3:
          $date = '';
          $priority =  "<span class=\"orange\">".$task_state['high']."</span>";
          break;

        case 4:
          $date = '';
          $priority =  "<span class=\"red\">".$task_state['yesterday']."</span>";
          break;

        default:
          $date = nicedate($row['normal'] );
          if(db_result(db_query('SELECT COUNT(*) FROM '.PRE.'tasks WHERE projectid='.$row['id'].' AND priority<>2 AND parent<>0 LIMIT 1' ), 0, 0 ) == 0 ) {
            $color = 'green';
            $priority = $task_state['normal'];
          }
          else {
            $priority = $lang['project'] ;
          }
          break;
      }
    }
    else {

      switch( $row['priority'] ) {
        case 0:
          $date = nicedate($row['deadline'] );
          $priority =  $task_state['dontdo'];
          break;

        case 1:
          $date = nicedate($row['deadline'] );
          $priority =  $task_state['low'];
          break;

        case 2:
          $date = nicedate($row['deadline'] );
          $priority =  "<span class=\"green\">".$task_state['normal']."</span>";
          break;

        case 3:
          $date = '';
          $priority =  "<span class=\"orange\">".$task_state['high']."</span>";
          break;

        case 4:
          $date = '';
          $priority =  "<span class=\"red\">".$task_state['yesterday']."</span>";
          break;

        default:
          $date = nicedate($row['deadline'] );
          $priority =  "<span class=\"orange\">".$row['priority']."</span>";
          break;
      }
    }

    //owner column
    if( $row['owner'] == 0 ) {
      switch( $row['status'] ) {
        case 'created':
        case 'notactive':
        case 'nolimit':
           $owner = $lang['nobody'];
           break;

        default:
           $owner = "<span class=\"red\">".$lang['nobody']."</span>";
           break;
      }
    }
    else {
      $owner = db_result(db_query('SELECT fullname FROM '.PRE.'users WHERE id='.$row['owner'],' LIMIT 1' ), 0, 0  );
      $owner = "<a href=\"users.php?x=".$x."&amp;action=show&amp;userid=".$row['owner']."\">".$owner."</a>";
    }

    //group column
    switch($sortby ) {
      case 'taskgroupid':
        $grouptable = 'taskgroups';
        $groupid = 'taskgroupid';
        $groupname = 'taskgroupname';
        break;

      case 'usergroupid':
      default:
        $grouptable = 'usergroups';
        $groupid = 'usergroupid';
        $groupname = 'usergroupname';
        break;
    }

    if( ($row[$groupid]== 0 ) || ($row[$groupid]=='' ) ) {
      $group = $lang['none'];
    }
    else {
      if(array_key_exists($groupname, $row ) ) {
        $group = $row[$groupname];
      }
      else
        $group = db_result(db_query('SELECT name FROM '.PRE.$grouptable.' WHERE id='.$row[$groupid].' LIMIT 1' ), 0, 0 );
    }

    if( ($row['parent'] == 0 ) && ($depth >= 0 ) ) {
      $projectrow = " class=\"projectrow\"";
    }
    else {
      $projectrow = "";
    }

    //Build up the page columns for display.  Starting with the flags
    $result .= "<tr".$projectrow."><td>".$f1."</td><td>".$f2."</td><td>".$f3."</td><td><small>";

    if($color != '' ) {
      $result .= "<span class=\"".$color."\">";
    }

    //Add deadline column
    if ($due <= 360) {
      $result .= $date;
    }
    else {
      $result .= $lang['future'];
    }

    if($color != '' ) {
      $result .= "</span>";
    }

    //Then add the status, owner and group columns
    $result .= "</small></td><td>".$status."</td><td>".$priority."</td><td>".$owner."</td><td>".$group."</td><td>";

    //Tab out children tasks
    for($j=1; $j < $depth; ++$j ) $result .= "&nbsp;&nbsp;&nbsp;";

    //task column
    $result .= $alink;
    if( $row['parent'] == 0) {
      $result .= "<b>".$row['taskname']."</b>";
    }
    else {
      $result .= $row['taskname'];
    }
    $result .= "</a>";

    //show graphical taskbar
    if( ($row['parent'] == 0 ) && ($depth >= 0 ) ) {
      if($row['completed'] > 0 ) {
       $result .= "<table width=\"200px\"><tr><td class=\"greenbar\" style=\"height: 2px; width :".($row['completed']*2)."px\"></td><td class=\"redbar\" style=\"height: 2px; width :".(200-($row['completed']*2))."px\"></td></tr></table>\n";

      }
      else {
        $result .= "<table width=\"200px\"><tr><td class=\"redbar\" style=\"height: 2px; width : 200px\"></td></tr></table>\n";

      }
    }

    $result .= "</td></tr>\n";
    if( $depth >= 0 ) {
      $result .= project_summary( 'WHERE '.PRE.'tasks.parent=\''.$row['id'].'\''.usergroup_tail().' ORDER BY taskname', $depth+1 );
    }
  }

  return $result;
}

//
// MAIN PROGRAM starts here
//
if(isset($_GET['sortby']) ) {
  $sortby = $_GET['sortby'];
}
else {
  $sortby = '';
}

//text link for 'printer friendly' page

if(isset($_GET['action']) && $_GET['action'] == 'summary_print' ) {
  $content  = "<p><span class=\"textlink\">[<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=".$sortby."\">".$lang['normal_version']."</a>]</span></p>";
}
else {
  $content  = "<div style=\"text-align: right\"><span class=\"textlink\"><a href=\"tasks.php?x=".$x."&amp;action=summary_print&amp;sortby=".$sortby."\" title=\"".$lang['print_version']."\">".
              "<img src=\"images/printer.png\" alt=\"".$lang['print_version']."\" width=\"16\" height=\"16\" /></a></span></div>";
}

$content .= "<table>\n";
$content .= "<tr><td colspan=\"3\"><small><a href=\"help/help_language.php?item=summarypage&amp;type=help&amp;lang=".LOCALE_USER."\" onclick=\"window.open('help/help_language.php?item=summarypage&amp;type=help&amp;lang=".LOCALE_USER."'); return false\"><b>".$lang['flags']."</b></a></small></td><td><small>";
$content .= "<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=deadline\">";
$content .= "<b>".$lang['deadline']."</b></a></small></td><td><small>";
$content .= "<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=status\">";
$content .= "<b>".$lang['status']."</b></a></small></td><td><small>";
$content .= "<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=priority\">";
$content .= "<b>".$lang['priority']."</b></a></small></td><td><small>";
$content .= "<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=owner\">";
$content .= "<b>".$lang['owner']."</b></a></small></td><td><small>";
$content .= "<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=";

switch($sortby ) {
  case 'taskgroupid':
    $content .= 'usergroupid';
    break;

  case 'usergroupid':
  default:
    $content .= 'taskgroupid';
    break;
}

$content .= "\">";
$content .= "<b>".$lang['group']."</b></a></small></td><td><small>";
$content .= "<a href=\"tasks.php?x=".$x."&amp;action=summary&amp;sortby=taskname\">";
$content .= "<b>".$lang['task']."</b></a></small></td></tr>";

//get list of private projects and put them in an array for later use
$q = db_query('SELECT id, usergroupid FROM '.PRE.'tasks WHERE parent=0 AND globalaccess=\'f\'' );

for( $i=0 ; $row = @db_fetch_num($q, $i ) ; ++$i) {
  //array key is projectid, array variable is usergroupid
  $no_access_project[($row[0])] = $row[1];
}

$group_tail = 'WHERE archive=0'.usergroup_tail();

// tail end of SQL query
switch($sortby ) {
  case 'deadline':
    $content .= project_summary($group_tail.' ORDER BY deadline,taskname', -1 );
    $suffix = $lang['by_deadline'];
    break;

  case 'status':
    $content .= project_summary($group_tail.' ORDER BY status,deadline,taskname', -1 );
    $suffix = $lang['by_status'];
    break;

  case 'priority':
    $content .= project_summary($group_tail.' ORDER BY priority,status,deadline,taskname', -1 );
    $suffix = $lang['by_priority'];
    break;

  case 'owner':
    $content .= project_summary('LEFT JOIN '.PRE.'users ON ('.PRE.'users.id='.PRE.'tasks.owner) '.$group_tail.' ORDER BY username,deadline,taskname', -1, ', '.PRE.'users.fullname AS username' );
    $suffix = $lang['by_owner'];
    break;

  case 'usergroupid':
    $content .= project_summary('LEFT JOIN '.PRE.'usergroups ON ('.PRE.'usergroups.id='.PRE.'tasks.usergroupid) '.$group_tail.' ORDER BY usergroupname,deadline,taskname', -1, ', '.PRE.'usergroups.name AS usergroupname' );
    $suffix = $lang['by_usergroup'];
    break;

  case 'taskgroupid':
    $content .= project_summary('LEFT JOIN '.PRE.'taskgroups ON ('.PRE.'taskgroups.id='.PRE.'tasks.taskgroupid) '.$group_tail.' ORDER BY taskgroupname,deadline,taskname', -1, ', '.PRE.'taskgroups.name AS taskgroupname' );
    $suffix = $lang['by_taskgroup'];
    break;

  case 'taskname':
    $content .= project_summary($group_tail.' ORDER BY taskname,deadline', -1 );
    $suffix = '';
    break;

  default:
    $content .= project_summary($group_tail.'AND parent=0 ORDER BY taskname', 0 );
    $suffix = '';
    break;
}

$content .= "</table><br /><br />\n";

new_box( $lang['projects'].$suffix, $content );

?>