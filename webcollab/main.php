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

  This builds up the main entrance.

*/


//main includes
include( "includes/database.php" );
include_once( "includes/security.php" );
include_once( "includes/screen.php" );

//start of page
create_top();

  include( "includes/mainmenu.php");
  include( "tasks/task_menubox.php" );
  include( "users/user_menubox.php" );

  if( $admin == 1 ) {
    include( "taskgroups/taskgroup_menubox.php" );
    include( "usergroups/usergroup_menubox.php" );
    include( "admin/admin_config_menubox.php" );
    $taskid = -1;
    include( "files/file_menubox.php" );
  }
  include( "contacts/contact_menubox.php" );

//flip over to other frame
goto_main();
  include( "tasks/task_project_list.php" );

//finish page
create_bottom();


?>
