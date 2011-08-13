<?php
/*
  $Id$

  (c) 2002 - 2010 Andrew Simpson <andrew.simpson at paradise.net.nz>

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

  A main menu

*/

//security check
if(! defined('UID' ) ) {
  die('Direct file access not permitted' );
}

//secure values
$content = '';

//create content
$content .= "<ul class=\"menu\">\n".
            "<li><a href=\"main.php?x=".X."\">".$lang['home_page']."</a></li>\n".
            "<li><a href=\"tasks.php?x=".X."&amp;action=summary\">".$lang['summary_page']."</a></li>\n".
            "<li><a href=\"tasks.php?x=".X."&amp;action=todo\">".$lang['todo_list']."</a></li>\n".
            "<li><a href=\"calendar.php?x=".X."&amp;action=show\">".$lang['calendar']."</a></li>\n".
            "<li><a href=\"forum.php?x=".X."&amp;action=search_box\">".$lang['forum_search']."</a></li>\n".
            "<li><a href=\"archive.php?x=".X."&amp;action=list\">".$lang['archive']."</a></li>\n".
            "<li><a href=\"logout.php?x=".X."\">".$lang['log_out']."</a></li>\n".
            "</ul>";

//show
new_box( $lang['main_menu'], $content, 'boxdata-menu', 'head-menu head-menu-top', 'boxstyle-menu' );

?>
