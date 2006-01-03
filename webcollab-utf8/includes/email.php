<?php
/*
  $Id$

  (c) 2005 - 2006 Andrew Simpson <andrew.simpson at paradise.net.nz>

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

  Creates a singular interface for email access.

*/

//get our location
require_once("path.php" );

include_once(BASE."config/config.php" );

if(USE_EMAIL == "N" ) {
    //email is turned off in config file
    return;
}

switch(MAIL_TRANSPORT ) {

  case "spool":
    include(BASE."mail/email_spool.php" );
    break;

  default:
  case "SMTP":
    include(BASE."mail/email_smtp.php" );
    break;
}

?>