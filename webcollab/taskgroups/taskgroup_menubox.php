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

  This is the administrative interface to the task-groups.

*/

require_once("path.php" );
require_once(BASE."includes/security.php" );

//only for admins
if($admin != 1 )
  return;

$content = "<a href=\"taskgroups.php?x=$x&amp;action=add\">".$lang["add"]."</a><br />\n".
           "<a href=\"taskgroups.php?x=$x&amp;action=manage\">".$lang["manage"]."</a><br />\n";

new_box( $lang["taskgroups"], $content, "boxmenu" );

?>
