<?php
/*
  $Id$

  WebCollab
  ---------------------------------------
  Thi file created 2003 by Andrew Simpson

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

  Email text language files for 'bg' (Bulgarian)

  Maintainer: Stoyan Dimitrov <stoyan at adiumdesign dot com>

  
  NOTE: This file is written in ISO-8859-5 character set
  
*/

// Get current date/time for emails in a preferred format eg: 01 Apr 2004 9:18 am NZDT

$email_date                 = date("d" ) . ". " . $month_array[(date("n" ) )] . " " . date('Y � H:i T' );

$email_commom_header       =   "    ���������,\n\n    ���� ����� � �� ���������� �� " . $MANAGER_NAME . ", ����������� �� �� ����, �� �� " . $email_date;

$title_file_post            = $ABBR_MANAGER_NAME . ": ������� �� ��� ����: %s";
$email_file_post            = $email_commom_header . " �� %1\$s �� ����� ��� ����.\n\n".
                                "����:        %2\$s\n".
                                "��������:    %3\$s";


$title_forum_post           = $ABBR_MANAGER_NAME . ": ���� �������� �� ��������: %s";
$email_forum_post           = $email_commom_header . " �� %1\$s:\n%2\$s �� ������� ���� ��������� ��� ��������. ";
$email_forum_reply          = $email_commom_header . " �� %1\$s �� ������� ���� ��������� ��� ��������. ";
                                "�� � ������� �� ���������� ��������� �� %2\$s.\n\n".
                                "���������� ���������t:\n %3\$s\n\n".
                                "�������:\n%4\$s\n";


$email_list                 = "������:  %1\$s\n".
                                "������:     %2\$s\n".
                                "���������:   %3\$s\n".
                                "����������:    %4\$s ( %5\$s )\n".
                                "�����:\n%6\$s\n\n".
                                "���� �������� web-���������� �� ������ ����������.\n\n" . $BASE_URL . "\n";


$title_takeover_project     = $ABBR_MANAGER_NAME . ": ������ ������ �� �������";
$title_takeover_task        = $ABBR_MANAGER_NAME . ": ������ ������ �� ��������";

$email_takeover_task        = $email_commom_header . " ������ ������ �� �������.\n\n";
$email_takeover_project     = $email_commom_header . " ������ ������ �� ��������.\n\n";


$title_new_owner_project    = $ABBR_MANAGER_NAME . ": ��� ������ �� ���";
$title_new_owner_task       = $ABBR_MANAGER_NAME . ": ���� ������ �� ���";

$email_new_owner_project    = $email_commom_header . " �� �������� ��� ������ � ��� ��� ����� ����������.\n\n��� ���������:\n\n";
$email_new_owner_task       = $email_commom_header . " �� ��������� ���� ������ � ��� ��� ���� ����������.\n\n��� ���������:\n\n";


$title_new_group_project    = $ABBR_MANAGER_NAME . ": ��� ������: %s";
$title_new_group_task       = $ABBR_MANAGER_NAME . ": ���� ������: %s";

$email_new_group_project    = $email_commom_header . " �� �������� ��� ������.\n\n��� ���������:\n\n";
$email_new_group_task       = $email_commom_header . " �� ��������� ���� ������.\n\n��� ���������:\n\n";


$title_edit_owner_project   = $ABBR_MANAGER_NAME . ": ������� �� ��� ������";
$title_edit_owner_task      = $ABBR_MANAGER_NAME . ": ������� �� ���� ������";

$email_edit_owner_project   = $email_commom_header . " ��� ������ �� ��������.\n\n��� ���������:\n\n";
$email_edit_owner_task      = $email_commom_header . " ���� ������ �� ���������.\n\n��� ���������:\n\n";


$title_edit_group_project   = $ABBR_MANAGER_NAME . ": ���������� �� ������";
$title_edit_group_task      = $ABBR_MANAGER_NAME . ": ���������� �� ������";

$email_edit_group_project   = $email_commom_header . " �� �������� ������ ����������� �� %s.\n\n��� ���������:\n\n";
$email_edit_group_task      = $email_commom_header . " �� ��������� ������ ������������ �� %s.\n\n��� ���������:\n\n";


$title_delete_project       = $ABBR_MANAGER_NAME . ": ������ ������";
$title_delete_task          = $ABBR_MANAGER_NAME . ": ������� ������";

$email_delete_project       = "    ���������,\n\n".
                                $email_commom_header . " ������, ����� ������������ �� ������.\n\n".
                                "    ���������� �� �� ������������ �� �������.\n\n";
$email_delete_task          = "    ���������,\n\n".
                                $email_commom_header . " ������, ����� ������������ �� �������.\n\n".
                                "    ���������� �� �� ������������ �� ��������.\n\n";

$delete_list                = "������:      %1\$s\n".
                                "������:    %2\$s\n".
                                "���������: %3\$s\n\n".
                                "�����:     \n%4\$s\n\n";

$title_welcome              = "    ������ �� " . $ABBR_MANAGER_NAME;
$email_welcome              = "    ���������,\n\n    ���� ����� � �� ���������� �� " . $MANAGER_NAME . ", ������������ �� � ����� ����� �� " . $email_date . ".\n\n".
                                "��� ���� ��� ��� ���� ���, �� �� �� ������ ������� ����, ���� �� �� ������ ����� �� ��������� ������.\n\n".
                                "���-������, ���� � ���������� �� ���������� �� �������, �������� �������� �� �� ������ ���������, ����� � ������� �� �������. ".
                                "��� �������� �� ����� �� ������� �� ������ ���������� � ������ �� ��������. ���� � �������, ������ �� ������.\n\n".
                                "����� �������, ����� ��� ��������� ��� ������ ����� ������������ �� ���� ��������� �� ������� ����������� ���� \"����\" ��� \"��������\". ������ ���� � �� �������� �� ������� ����������� � ���� ��� �� ������ ����� �� �� ����������� ���� �� ������ �������. ".
                                "���� ���� ��� ������ �� ��������� ��� �� ���������� ����������� ����� ������ � �� ������ �� �� �����������, � ���� � �������� ��� ��� � ������������� �����. ".
                                "������ ������������ ������ ������, ����, ������������ ������ � � ������ ������, ���� �� ����� �� ���� �� �������� ������� �� ������.\n\n".
                                "���� �� �� ������� ���� ����� � ������ �� " . $EMAIL_ADMIN. " ��� ����� �����������.\n\n--\n������!\n\n".
                                "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n".
                                "����:                  %1\$s\n".
                                "������:                %2\$s\n\n".
                                "������������� �����:   %3\$s".
                                "���:                   %4\$s\n".
                                "��������:              " . $BASE_URL . "\n\n".
                                "%5\$s";

$title_user_change1         = $ABBR_MANAGER_NAME . ": ������� �� ����� ������";
$email_user_change1         = $email_commom_header . " �� �������������� (%1\$s - %2\$s) �� �������� ������ ������.\n\n".
                                "����:                  %3\$s\n".
                                "������:                %4\$s\n\n".
                                "������������� �����:   %5\$s".
                                "���:                   %6\$s\n\n".
                                "%7\$s";

$title_user_change2         = $ABBR_MANAGER_NAME . ": ������� �� ����� ������";
                              "    ���������,\n\n    ���� ����� � �� ���������� �� " . $MANAGER_NAME . ", ������������� �� ���������, ����� �� ��������� �� " . $email_date . " �� ������� �� �� �������.\n\n";
                                "����:      %1\$s\n".
                                "������:    %2\$s\n\n".
                                "���:       %3\$s\n";

$title_user_change3         = $ABBR_MANAGER_NAME . ": ������� �� ����� ������";
$email_user_change3         = "    ���������,\n\n    ���� ����� � �� ���������� �� " . $MANAGER_NAME . ", ������������� �� ���������, ����� �� ��������� �� " . $email_date . " �� ������� �� �� �������.\n\n";
                                "����:      %1\$s\n".
                                "�������� �� ������ �� � �������.\n\n".
                                "���:       %2\$s\n";


$title_revive               = $ABBR_MANAGER_NAME . ": ����������� ������";
$email_revive               = $email_commom_header . " ������ ������ �� �����������.\n\n".
                                "����:  %1\$s\n".
                                "���:   %2\$s\n\n".
                                "�� ��������� �������� ��, ������ � ��������. \n\n".
                                "��� ��� ��������� �������� �� ������ �� " . $EMAIL_ADMIN . " �� ���� ������.";



$title_delete_user          = $ABBR_MANAGER_NAME . ": ����� ������";
$email_delete_user          = $email_commom_header . " ������ ������ �� �����.\n\n".
                                "����������, �� �� ��������� � ������ �� �� ���������� �� ���������� ������!\n\n".
                                "��� �������, �� ���� � ������, ����, ������ �� " . $EMAIL_ADMIN . ".";

?>