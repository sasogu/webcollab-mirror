<?php
/*

  WebCollab
  ---------------------------------------

  Function:
  ---------

  Language files for 'ru' (Russian)

  Translation by Eugene N. Shilaev
  
  NOTE: This file is written in koi8-r character set

*/


//required language encodings
define('CHARACTER_SET', "koi8-r" );

//this is the regex for input validation filter used in common.php 
$validation_regex = '/([^\x09\x0a\x0d\x20-\xff])/s'; //koi8-r

//dates
$month_array = array (NULL, '���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���' );
$week_array = array('��', '��', '��', '��', '��', '��', '��' );

//task states
 
 //priorities
    $task_state['dontdo']               = '����� ���� �����-������...';
    $task_state['low']                  = '�������� ��';
    $task_state['normal']               = '����������';
    $task_state['high']                 = '�����';
    $task_state['yesterday']            = '����� ���� ����!';
 //status
    $task_state['new']                  = '�����';
    $task_state['planned']              = '����������� (������ �����)';
    $task_state['active']               = '� ������';
    $task_state['cantcomplete']         = '����';
    $task_state['completed']            = '��������';
    $task_state['done']                 = '��������';
    $task_state['task_planned']         = ' �����������';
    $task_state['task_active']          = ' � ������';
 //project states
    $task_state['planned_project']      = '����������� ������ (������ �����)';
    $task_state['no_deadline_project']  = '�� ����������� ���� ����������';
    $task_state['active_project']       = '������ � ������';
    
//common items
    $lang['description']                = '��������';
    $lang['name']                       = '��������';
    $lang['add']                        = '��������';
    $lang['update']                     = '��������';
    $lang['submit_changes']             = '��������� ���������';
    $lang['continue']                   = '����������';
    $lang['reset']                      = '������';
    $lang['manage']                     = '����������';
    $lang['edit']                       = '�������������';
    $lang['delete']                     = '�������';
    $lang['del']                        = '�������';
    $lang['confirm_del_javascript']     = ' ����������� ��������!';
    $lang['yes']                        = '��';
    $lang['no']                         = '���';
    $lang['action']                     = '��������';
    $lang['task']                       = '�������';
    $lang['tasks']                      = '�������';
    $lang['project']                    = '������';
    $lang['info']                       = '����';
    $lang['bytes']                      = ' ����';
    $lang['select_instruct']            = '(������� ctrl ��� ������ ������ ������)';
    $lang['member_groups']              = '������������ �������� ������ ���������� ����� ����� (���� ��������)';
    $lang['login']                      = '����';
    $lang['error']                      = '������';
    $lang['no_login']                   = '������ ��������; �������� ��� ��� ������';
//**    
    $lang['redirect_sprt']              = '�� ������������� ��������� �� �������� ����� ����� %d ������';
//**
    $lang['login_now']                  = '������� ����� ��� �������� � �����������';   
    $lang['please_login']               = '�����������������';
    $lang['go']                         = '����!';
    
//graphic items
    $lang['late_g']                     = '&nbsp;��������&nbsp;';
    $lang['new_g']                      = '&nbsp;�����&nbsp;';
    $lang['updated_g']                  = '&nbsp;��������&nbsp;';

//admin config
    $lang['admin_config']               = 'Admin config';
    $lang['email_settings']             = '��������� ���������� Email';
    $lang['admin_email']                = 'Admin email';
    $lang['email_reply']                = 'Email \'reply to\'';
    $lang['email_from']                 = 'Email \'from\'';
    $lang['mailing_list']               = '���� ��������';
    $lang['default_checkbox']           = 'Default checkbox settings for Project/Tasks';
    $lang['allow_globalaccess']         = '��������� ����� ������?';
    $lang['allow_group_edit']           = '��������� ���� ������ ������ �������������?';
    $lang['set_email_owner']            = 'Always email owner with changes?';
    $lang['set_email_group']            = 'Always email usergroup with changes?';
//**    
    $lang['project_listing_order']      = '������� ���������� ��������';
//**    
    $lang['task_listing_order']         = '������� ���������� �������'; 
    $lang['configuration']              = '������������';

//archive
//**
    $lang['archived_projects']          = '�������� �������';    

//contacts
    $lang['firstname']                  = '���:';
    $lang['lastname']                   = '�������:';
    $lang['company']                    = '��������:';
    $lang['home_phone']                 = '�������� �������:';
    $lang['mobile']                     = '���������:';
    $lang['fax']                        = 'Fax:';
    $lang['bus_phone']                  = '������� �������:';
    $lang['address']                    = '�����:';
    $lang['postal']                     = '������:';
    $lang['city']                       = '�����:';
    $lang['email']                      = 'Email:';
    $lang['notes']                      = '����:';
    $lang['add_contact']                = '�������� �������';
    $lang['del_contact']                = '������� �������';
    $lang['contact_info']               = '���������� � ��������';
    $lang['contacts']                   = '��������';
    $lang['contact_add_info']           = '���� �� �������� �������� ��������, ����� ��� ����� ���������� ������ ����� ������������.';
    $lang['show_contact']               = '�������� ��������';
    $lang['edit_contact']               = '������������� ��������';
    $lang['contact_submit']             = '�������: �������������';
    $lang['contact_warn']               = '������������ ������ ��� ���������� ��������; �������� ����� � ������� ��� � �������';

 //files
    $lang['manage_files']               = '���������� �������';
    $lang['no_files']                   = '��� ����������� ������';
    $lang['no_file_uploads']            = '������������ ������� �� ��������� ������������ �������� ������';
    $lang['file']                       = '����:';
    $lang['uploader']                   = '��������:';
    $lang['files_assoc_project']        = '���� ���������� � �������:';
    $lang['files_assoc_task']           = '���� ���������� � �������';
    $lang['file_admin']                 = 'File admin';
    $lang['add_file']                   = '�������� ����';
    $lang['files']                      = '�����';
    $lang['file_choose']                = '���� ��� ��������:';
    $lang['upload']                     = '��������';
    $lang['file_email_owner']           = '�������� �� Email � ����� ������ ���������?';
    $lang['file_email_usergroup']       = '�������� �� Email � ����� ������ ������?';
    $lang['max_file_sprt']              = '���� ��� �������� ������ ���� ������ %s kb.';
    $lang['file_submit']                = '�������� �����';
    $lang['no_upload']                  = '������ �� ���������.  ��������� ����� � ��������� ��� ���.';
    $lang['file_too_big_sprt']          = '������������ ������ ����� - %s ����.  �� ��������� ������� ������� � �� ��� ���������.';
    $lang['del_file_javascript_sprt']   = '�� ������������� ������ ������� %s ?';


 //forum
    $lang['orig_message']               = '�������� ���������:';
    $lang['post']                       = '�������!';
    $lang['message']                    = '���������:';
    $lang['post_reply_sprt']            = '����� �� ��������� ������ \'%1$s\', ����� - \'%2$s\'';
    $lang['post_message_sprt']          = '��������� � �����: \'%s\'';
    $lang['forum_email_owner']          = '�������� �� Email � ���������� ���������?';
    $lang['forum_email_usergroup']      = '�������� �� Email � ���������� ������?';
    $lang['reply']                      = '��������';
    $lang['new_post']                   = '����� ����';
    $lang['public_user_forum']          = '��������� ���� �����';
    $lang['private_forum_sprt']         = '�������� ����� ��� ������ \'%s\'';
    $lang['forum_submit']               = '�����: �������������';
    $lang['no_message']                 = '������ ���, �����! ��������� ����� � ��������� ��� ���';
    $lang['add_reply']                  = '�������� �����';
//**  
    $lang['last_post_sprt']             = '��������� ��������� �� %s'; //Note to translators: context is 'Last post 2004-Dec-22'
//**   
    $lang['recent_posts']               = '����� ��������� � ������';      
    
 //includes
    $lang['report']                     = '�����';
    $lang['warning']                    = '<h1>��������!</h1><p>�� �� ����� ��������� ��� ������ ����� ������. ��������� �����.</p>';
    $lang['home_page']                  = '�������';
    $lang['summary_page']               = '�����';
    $lang['todo_list']                  = '��� ���� �������';
    $lang['calendar']                   = '���������';
    $lang['log_out']                    = '�����';
    $lang['main_menu']                  = '������� ����';
//**
    $lang['archive']                    = '�����';   
    $lang['user_homepage_sprt']         = '%s - ���������� ���������';
    $lang['missing_field_javascript']   = '��������� ����������� ����';
    $lang['invalid_date_javascript']    = '����������, ��������� ���������� ���� �� ���������';
    $lang['finish_date_javascript']     = '��������� ���� ����� ���� ��������� �������!';
    $lang['security_manager']           = '���������� ������������';
    $lang['session_timeout_sprt']       = '������ ��������; ��������� �������� ���� %1$d ����� �����, ����-��� �������� %2$d �����; ���������� <a href="%3$sindex.php">�����������������</a>';
    $lang['access_denied']              = '������ ��������';
    $lang['private_usergroup']          = '��������; ���� ������ ���������� � �� �� ������ ���� �� ������ � ����.';
    $lang['invalid_date']               = '�������� ����';
    $lang['invalid_date_sprt']          = '���� %s, �������, ������� (��������� ���������� ���� � ������).<br />����������, ��������� ����� � ������� ����.';


 //taskgroups
    $lang['taskgroup_name']             = '�������� ������� ������:';
    $lang['taskgroup_description']      = '������� �������� ������� ������:';
    $lang['add_taskgroup']              = '�������� ������� ������';
    $lang['add_new_taskgroup']          = '�������� ����� ������� ������';
    $lang['edit_taskgroup']             = '������������� ������� ������';
    $lang['taskgroup_manage']           = '���������� �������� ��������';
    $lang['no_taskgroups']              = '�� ����� ������ ���';
    $lang['manage_taskgroups']          = '������� ������: ����������';
    $lang['taskgroups']                 = '������� ������';
    $lang['taskgroup_dup_sprt']         = '��� ���� ����� ������ \'%s\'.  ��������� ����� � �������� ������ ���.';
    $lang['info_taskgroup_manage']      = '������� ������: ����������';

 //usergroups
    $lang['usergroup_name']             = '�������� ������ �������������:';
    $lang['usergroup_description']      = '������� �������� ������ �������������:';
    $lang['members']                    = '�����:';
    $lang['private_usergroup']          = '������������ ������';
    $lang['add_usergroup']              = '�������� ������';
    $lang['add_new_usergroup']          = '�������� ����� ������';
    $lang['edit_usergroup']             = '������������� ������';
    $lang['usergroup_manage']           = '���������� �������� �������������';
    $lang['no_usergroups']              = '�� ����� ������ ���';
    $lang['manage_usergroups']          = '������ �������������: ����������';
    $lang['usergroups']                 = '������ �������������';
    $lang['usergroup_dup_sprt']         = '��� ���� ����� ������ \'%s\'.  ��������� ����� � �������� ������ ���.';
    $lang['info_usergroup_manage']      = '���������� �������� �������������: ����������';

 //users
    $lang['login_name']                 = '��� ��� �����';
    $lang['full_name']                  = '������ ���';
    $lang['password']                   = '������';
    $lang['blank_for_current_password'] = '(�� �������� ��� ����, ��� �� ��������� ������������ ������)';
    $lang['email']                      = 'E-mail';
    $lang['admin']                      = '�������������';
    $lang['private_user']               = '����������';
 //**
    $lang['normal_user']                = '������� ������������'; 
    $lang['is_admin']                   = '����� ���������������?';
 //**
    $lang['is_guest']                   = '����� ������?';
 //**
    $lang['guest']                      = '�����';
    $lang['user_info']                  = '������������: ����������';
    $lang['deleted_users']              = '��������� ������������';
    $lang['no_deleted_users']           = '��� ��������� �������������.';
    $lang['revive']                     = '������������';
    $lang['permdel']                    = '������� ��������';
    $lang['permdel_javascript_sprt']    = '��� ����� ������ ��� ������ ������������ � ������� ��������� � %s. �� ������������� ������  ��� �������?';
    $lang['add_user']                   = '�������� ������������';
    $lang['edit_user']                  = '��������';
    $lang['no_users']                   = '������� ���������� �� ������ ������������';
    $lang['users']                      = '������������';
    $lang['existing_users']             = '������������ �������';
    $lang['private_profile']            = '���� ������������ ���������� � �� �� ������ ������������� ���������� � ���.';
    $lang['private_usergroup_profile']  = '(���� ������������ ���������� � �� �� ������ ������������� ���������� � ���)';
    $lang['email_users']                = '������ ������������';
    $lang['select_usergroup']           = '������ ������������� ��������� �����:';
    $lang['subject']                    = '����:';
    $lang['message_sent_maillist']      = 'In all cases the message is also copied to the mailing list.';
    $lang['who_online']                 = '��� � �������?';
    $lang['edit_details']               = '�������� ��������� ����������';
    $lang['show_details']               = '�������� ��������� ����������';
    $lang['user_deleted']               = '���� ������������ ��� ������!';
    $lang['no_usergroup']               = '������������ �� �������� ������ �� ����� ������';
    $lang['not_usergroup']              = '(�� �������� ������ �� ����� ������)';
    $lang['no_password_change']         = '(��� ������ �� ��� �������)';
    $lang['last_time_here']             = '��������� ��� ��� �����:';
    $lang['number_items_created']       = '���������� ��������� ��������:';
    $lang['number_projects_owned']      = '���������� �������������� ��������:';
    $lang['number_tasks_owned']         = '���������� �������������� �������:';
    $lang['number_tasks_completed']     = '���������� ����������� �������:';
    $lang['number_forum']               = '���������� ��������� � ������:';
    $lang['number_files']               = '���������� ����������� ������:';
    $lang['size_all_files']             = '����� ������ ����������� ������:';
    $lang['owned_tasks']                = '�������������� �������';
    $lang['invalid_email']              = '�������� ����� email';
    $lang['invalid_email_given_sprt']   = '����� email \'%s\' ��������. ��������� ����� � ��������� ��� ���.';
    $lang['duplicate_user']             = '����������� ������������';
    $lang['duplicate_change_user_sprt'] = '������������ \'%s\' ��� ���������������.  ��������� ����� � �������� ������ ���.';
    $lang['value_missing']              = '������ �����������';
    $lang['field_sprt']                 = '���� \'%s\' ���������. ��������� ����� � ��������� ���.';
    $lang['admin_priv']                 = '��������: � ��������� ���� ����� ��������������.';
    $lang['manage_users']               = '������������: ����������';
    $lang['users_online']               = '������������ � �������';
    $lang['online']                     = '����������� (����� 60 ����� �����)';
    $lang['not_online']                 = '����������';
    $lang['user_activity']              = '���������� �������������';

  //tasks
    $lang['add_new_task']               = '�������� ����� �������';
    $lang['priority']                   = '���������';
    $lang['parent_task']                = '�����������';
    $lang['creation_time']              = '���� ��������';
    $lang['by_sprt']                    = '%1$s �����: %2$s'; //Note to translators: context is 'Creation time: <date> by <user>'
    $lang['project_name']               = '�������� �������';
    $lang['task_name']                  = '�������� �������';
    $lang['deadline']                   = '���� ����������';
    $lang['taken_from_parent']          = '(Taken from parent)';
    $lang['status']                     = '������';
    $lang['task_owner']                 = '����������� �������';
    $lang['project_owner']              = '����������� �������';
    $lang['taskgroup']                  = '������� ������';
    $lang['usergroup']                  = '������ �������������';
    $lang['nobody']                     = '�����';
    $lang['none']                       = '������';
    $lang['no_group']                   = '��� ������';
    $lang['all_groups']                 = '��� ������';
    $lang['all_users']                  = '��� ������������';
    $lang['all_users_view']             = '��� ������������ ����� ������ ���?';
    $lang['group_edit']                 = '��� ������������ ������ ����� �������������?';
    $lang['project_description']        = '�������� �������';
    $lang['task_description']           = '�������� �������';
    $lang['email_owner']                = '��������� email ������������ ��� ���������?';
    $lang['email_new_owner']            = '��������� email ������ ������������ ��� ���������?';
    $lang['email_group']                = '��������� email ������ ������������� ��� ���������?';
    $lang['add_new_project']            = '�������� ����� ������';
    $lang['uncategorised']              = 'Uncategorised';
    $lang['due_sprt']                   = '%d ���� �� ������������';
    $lang['tomorrow']                   = '������';
    $lang['due_today']                  = '� ������� ���';
    $lang['overdue_1']                  = '�������� 1 ����';
    $lang['overdue_sprt']               = '�������� %d ����';
    $lang['edit_task']                  = '������������� �������';
    $lang['edit_project']               = '������������� ������';
    $lang['no_reparent']                = '������ (������ �������� ������)';
    $lang['del_javascript_project_sprt']= '�� �������� �������  ������ %s. �� �������?';
    $lang['del_javascript_task_sprt']   = '�� �������� ������� ������� %s. �� �������?';
    $lang['add_task']                   = '�������� �������';
    $lang['add_subtask']                = '�������� ���-�������';
    $lang['add_project']                = '������ ������';
    $lang['clone_project']              = '����������� ������';
    $lang['clone_task']                 = '����������� �������';
//**
    $lang['quick_jump']                 = '������� �������';
    $lang['no_edit']                    = '�� �� ������ �������� ��������� � �����, � ������ � ������������� �� ������';
    $lang['uncategorised']              = 'Uncategorised';
    $lang['admin']                      = 'Admin';
    $lang['global']                     = '�����';
    $lang['delete_project']             = '������� ������';
    $lang['delete_task']                = '������� �������';
    $lang['project_options']            = '������: �����';
    $lang['task_options']               = '�������: �����';
//**    
    $lang['javascript_archive_project'] = '�� ����������� ��������� ������ %s � �����.  �� �������?';
//**    
    $lang['archive_project']            = '������������ ������';
    $lang['task_navigation']            = '�������: ���������';
//**
    $lang['new_task']                   = '����� �������';    
    $lang['no_projects']                = '��� �� ������ ������� ��� �� ��������';
    $lang['show_all_projects']          = '�������� ��� �������';
    $lang['show_active_projects']       = '�������� ������ ������� � ������';
    $lang['project_hold_sprt']          = '������ ���� � %s';
    $lang['project_planned']            = '����������� �������';
    $lang['percent_sprt']               = '%d%% ������� ���������';
    $lang['project_no_deadline']        = '�� ���������� ���� ���������� �������';
    $lang['no_allowed_projects']        = '��� �������� ��� �� ��� ��������';
    $lang['projects']                   = '�������';
    $lang['percent_project_sprt']       = '���������� ����� �� ������� %d%%';
    $lang['owned_by']                   = '�����������:';
    $lang['created_on']                 = '�������';
    $lang['completed_on']               = '���������';
    $lang['modified_on']                = '��������';
    $lang['project_on_hold']            = '������ �������';
    $lang['project_accessible']         = '(���� ������ �������� �������� ���� �������������)';
    $lang['task_accessible']            = '(��� ������� �������� �������� ���� �������������)';
    $lang['project_not_accessible']     = '(���� ������ �������� ������ ������ ������)';
    $lang['task_not_accessible']        = '(��� ������� �������� ������ ������ ������)';
    $lang['project_not_in_usergroup']   = '���� ������ �� ����������� �����-���� ������ � �������� ���� �������������.';
    $lang['task_not_in_usergroup']      = '��� ������� �� ����������� �����-���� ������ � �������� ���� �������������.';
    $lang['usergroup_can_edit_project'] = '���� ������ ����� ���� ������� ������ ������� ������.';
    $lang['usergroup_can_edit_task']    = '��� ������� ����� ���� �������� ������ ������� ������.';
    $lang['i_take_it']                  = '�����, ������� �� ���';
    $lang['i_finished']                 = '� ������ ���!';
    $lang['i_dont_want']                = '�� ���� ������ ����� � ���� ����';
    $lang['take_over_project']          = '����� ������ ��� ��������';
    $lang['take_over_task']             = '����� ������� ��� ��������';
    $lang['task_info']                  = '�������: ����������';
    $lang['project_details']            = '������: ������';
    $lang['todo_list_for']              = '��� ����� ������� ���: ';
    $lang['due_in_sprt']                = ' (� ������� %d ����)';
    $lang['due_tomorrow']               = ' (������)';
    $lang['no_assigned']                = '��� ������������� ������� ��� ����� ������������.';
    $lang['todo_list']                  = '��� ����� �������';
    $lang['summary_list']               = '����� ��������';
    $lang['task_submit']                = '�������: �������������';
    $lang['not_owner']                  = '������ ��������. ���� �� �� ����������� ��� � ��� ������������ ���� ��� �������';
    $lang['missing_values']             = '�� ��� ���� ���������; ��������� ����� � ���������� ��� ���';
    $lang['future']                     = 'Future';
    $lang['flags']                      = '�����';
    $lang['owner']                      = '�����������';
    $lang['group']                      = '������';
    $lang['by_usergroup']               = ' (�� ������� �������������)';
    $lang['by_taskgroup']               = ' (�� ������� �������)';
    $lang['by_deadline']                = ' (�� ����� ����������)';
    $lang['by_status']                  = ' (�� �������)';
    $lang['by_owner']                   = ' (�� ������������)';
    $lang['project_cloned']             = '������ ��� ������������ :';
    $lang['task_cloned']                = '������� ��� ������������ :';
    $lang['note_clone']                 = '��������: ������� ����� ����������� ��� ����� ������';

//bits 'n' pieces
    $lang['calendar']                   = '���������';
    $lang['normal_version']             = '���������� ���';
    $lang['print_version']              = '������ ��� ������';
//**    
    $lang['condensed_view']             = '��������';
//**    
    $lang['full_view']                  = '����������';

?>