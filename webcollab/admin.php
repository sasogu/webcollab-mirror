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

  Admin config

*/

require_once("includes/security.php" );
include_once("includes/screen.php" );

if($admin != 1 )
  return;

//
// The action handler
//
if( ! isset($_REQUEST["action"] ) || strlen($_REQUEST["action"] ) == 0  )
  error("Admin action handler", "No request given" );

switch ($_REQUEST["action"] ) {

  case "admin":
    create_top($lang["admin_config"] );
    include("includes/mainmenu.php" );
    goto_main();
    include("admin/admin_config_edit.php" );
    create_bottom();
    break;

  //error case
  default:
    error("Admin action handler", "Invalid request given") ;
    break;

}

?>
