<?php
/*
  $Id$

  WebCollab
  ---------------------------------------

  This file written in 2003 by Andrew Simpson <andrew.simpson@paradise.net.nz>

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

  Database creation

*/

require_once("../config.php" );
require_once("./security_setup.php" );
include_once("./screen_setup.php" );

$content = "";

create_top_setup("Setup Screen" );

//warn if config file cannot be written
if( ! is_writable("../config.php" ) ) {
  $content .=  "<p><b>The webserver does not have permissions to write to the config file (config.php).".
                "You can make a new database, but you cannot write to the config file.<br /><br />\n".
                "To alter the config file you can either:<ul>\n".
                "<li>Change the file permissions to allow the webserver to write to the file 'config.php'</li>\n".
                "<li>Do a manual configuration by editing the file directly.</li>\n</ul></b></p>\n";
}

//input form
$content .=    "<form method=\"POST\" action=\"setup_setup2.php\">\n".
                "<input type=\"hidden\" name=\"x\" value=\"$x\" />\n".
                "<input type=\"hidden\" name=\"new_db\" value=\"Y\" />\n";

if(isset($DATABASE_NAME) && $DATABASE_NAME != "" ) {
  $content .= "<p>A database is already specified in the configuration file.  Do you wish to create a new database?</p>\n";
}
else{
  $content .= "<p>A database is required to be created for WebCollab to operate.  Do you wish to create a database now?</p>\n";
}

$content .=   "<div align=\"center\"><input type=\"submit\" value=\"Yes\" /></div>\n".
               "</form>\n".
               "<form method=\"POST\" action=\"setup_setup3.php\">\n".
               "<input type=\"hidden\" name=\"x\" value=\"$x\" />\n".
               "<input type=\"hidden\" name=\"new_db\" value=\"N\" />\n".
               "<br /><div align=\"center\"><input type=\"submit\" value=\"No\" /></div>\n".
               "</form>\n";

new_box_setup( "Setup - Stage 1 of 5 : Database Configuration Option", $content, "boxdata2", "singlebox" );
create_bottom_setup();

?>