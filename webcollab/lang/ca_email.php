<?php
/*
  $Id$

  WebCollab
  ---------------------------------------
  This file created 2003 by Andrew Simpson

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

  Email text language files for 'ca' (Catalan)

  Translation: Daniel Hernandez (dhernan2@pie.xtec.es)

  Maintainer:

*/

$title_takeover     = $ABBR_MANAGER_NAME.": El seu item ha estat reassignat";
$email_takeover     = "Hola,\n\nAquest &eacute;e %s lloc informant-li que un %s al seu c&agrave;rreg ha estat reassignada per l'administrador el %s.\n\n".
			"Projecte: %s\n".
			"Tasca:    %s\n".
                        "A c&agrave;rreg:  %s ( %s )\n".
			"Text:\n%s\n\n".
			"Dirigir-se al lloc web per a mes detalls.\n\n%s\n";

$title_new_owner    = $ABBR_MANAGER_NAME.": Nou %s per a vost&eacute;";
$email_new_owner    = "Hola,\n\nAquest es el %s lloc informant-li que un %s seu (ara al seu c&agrave;rreg) va ser canviat el %s.\n\nAqu&iacute; els detalls:\n\n".
			"Projecte: %s\n".
			"Tasca:    %s\n".
			"Estat:   %s\n\n".
			"Text:\n%s\n\n".
                        "Dirigir-se al lloc web per a m&eacute; detalls.\n\n%s\n";


$title_new_group    = $ABBR_MANAGER_NAME.": Nou %s: ";
$email_new_group    = "Hola,\n\nAquest &eacute;s el %s lloc informant-li que un nou %s ha estat creat el %s\n\nAqu&iacute; els detalls:".
			"Projecte: %s\n".
			"Tasca:    %s\n".
                        "A c&agrave;rreg:  %s\n".
			"Estat:   %s\n\n".
			"Text:\n%s\n\n".
                        "Dirigir-se al lloc web per a m&eacute;s detall.\n\n%s\n";

$title_edit_owner   = $ABBR_MANAGER_NAME.": La seva %s actualitzada";
$email_edit_owner   ="Hola,\n\nAquest &eacute;s el %s lloc informant-li que un %s al seu c&agrave;rreg va canviar el %s.\n\nAqu&iacute; els detalls:\n\n".
                        "Projecte: %s\n".
                        "Tasca:    %s\n".
                        "Estat:   %s\n\n".
                        "Text:\n%s\n\n".
                        "Dirigir-se al lloc web per a m&eacute;s detalls.\n\n%s\n";


$title_edit_group   = $ABBR_MANAGER_NAME.": %s actualitzada";
$email_edit_group   = "Hola,\n\nAquest &eacute;s el %s lloc informant-li que un %s a c&agrave;rreg de %s ha canviat el %s.\n\nAqu� els detalls:\n\n".
			"Projecte: %s\n".
			"Tasca:    %s\n".
			"Estat:   %s\n\n".
			"Text:\n%s\n\n".
			"Dirigir-se al lloc web per a m�s detalls.\n\n%s\n";


$title_delete_task  = $ABBR_MANAGER_NAME.": %s eliminada";
$email_delete_task  = "Hola,\n\n".
			"Aquest &eacute;s el %s lloc informant-li que un %s al seu c&agrave;rreg ha estat eliminat el %s\n\n".
			"Projecte: %s\n".
			"Tasca:    %s\n".
			"Estat:   %s\n\n".
			"Text:\n%s\n\n".
			"Gr&agrave;cies per dirigir la tasca al seu moment.";


$title_welcome      = "Benvinguda a ".$ABBR_MANAGER_NAME;
$email_welcome      = "Hola,\n\nAquest &eacute;s el lloc %s donant-li la benvinguda ;) el  %s.\n\n".
			"Com que vost&eacute; &eacute;s nou aqui li explicar&eacute; un parell de cosetes per a que r&aagrave;pidament pugui comen&ccedil;ar a treballar\n\n".
			"Abans de res, est&agrave; l'eina de manegament de projectes, la pantalla principal li mostrar&agrave; els projectes actualment disponibles.. ".
			"Si fa click a un dels nom, es trobar&agrave; en la zona de tasques. Aqu&iacute; &eacute;s on la feina comen&ccedil;a..\n\n".
			"Cada &iacute;tem que vost&egrave; envia o tasca que editar ser&agrave; mostrada als altres usuaris com 'nova' o 'actualitzada'. Aix&ograve; tamb&eacute; funciona a la inversa i ".
			"el permet r&agrave;pidamentlo enfocar on est&agrave; l'activitat.\n\n".
			"Vost&eacute; pot tamb&eacute; fer-se c&agrave;rreg o prendre propietat de tasques i es trobar&agrave; habilitat per editar i tots els enviaments al f&ograve;rum seran rebuts. ".
			"A mesura que avan�a en la seva feina, per favor editi el text de les seves tasques i l'estat de tal forma que tothom pugui mantenir un seguiment del seu progr&eagrave;s. ".
			"\n\nNo em resta m&eacute;s que desijar-li &egrave;xits i informar-li que pot enviar un correu a %s si es troba amb alguna dificultat.\n\n --Bona sort !\n\n".
			"Usuari:      %s\n".
			"Clau:   %s\n\n".
			"Usergroups: %s".
			"Nom:    %s\n".
			"Website:    %s\n\n".
			"%s";

$title_user_change1 = $ABBR_MANAGER_NAME.": Edici&oacute; del seu compte per un administrador";
$email_user_change1 = "Hola,\n\nAquest &eacute;s el %s lloc informant-li que el seu compte ha estat modificat el %s per %s ( %s ) \n\n".
			"Usuari:      %s\n".
			"Clau:   %s\n\n".
			"Usergroups: %s".
			"Nom:     %s\n\n".
			"%s";

$title_user_change2 = $ABBR_MANAGER_NAME.": Edici&oacute; del seu compte";
$email_user_change2 = "Hola,\n\nAquest &eacute;s el %s lloc confirmant-li que ha modificat amb &egrave;xit el seu compte el %s\n\n".
			"Usuari:    %s\n".
			"Clau: %s\n\n".
			"Nom:   %s\n";

$title_user_change3 = $ABBR_MANAGER_NAME.": Edici&oacute; del seu compte";
$email_user_change3 = "Hola,\n\nAquest &eacute;s el %s lloc confirmant-li que ha modificat amb &egrave;xit el seu compte el %s\n\n".
			"Usuari:    %s\n".
			"La seva clau NO ha estat modificada.\n\n".
			"Nom:   %s\n";


$title_revive       = $ABBR_MANAGER_NAME.": Compte reactivtat";
$email_revive       = "Hola,\n\nAquest &eacute;s el %s lloc informant-li que el seu compte ha estat reactivat el  %s.\n\n".
			"Usuari: %s\n".
			"Clau:  %s\n\n".
			"No podem enviar-li la seva clau perqu&egrave; est&agrave; encriptada. \n\n".
			"Si ha perdut la seva clau, envii un correu per %s per a sol&middot;licitar una nova clau.";



$title_delete_user  = $ABBR_MANAGER_NAME.": Compte desactivat.";
$email_delete_user  = "Hola,\n\nAquest &eacute;s el %s lloc informant-li que el seu compte ha estat desactivat el %s\n\n".
			"Ens sap greu la seva desactivaci&oacute; i li estem agraits per la seva feina!\n\n".
			"Si desitja objectar la seva desactivaci&oacute;, o pensa que ha estat un error, envii un correu a %s.";

?>