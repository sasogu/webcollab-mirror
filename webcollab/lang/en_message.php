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

  Language files for 'en' (English)
  
  Maintainer: Andrew Simpson <andrew.simpson@paradise.net.nz>

*/

//dates
$month_array = array ( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" );
$week_array = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

//task states
$task_state = array(
 //priorities
 "dontdo" => "Don't do",
 "low" => "Low",
 "normal" => "Normal",
 "high" => "High",
 "yesterday" => "Yesterday!",
 //status
 "new" => "New",
 "planned" => "Planned (not active)",
 "active" => "Active (working on it)",
 "cantcomplete" => "On Hold",
 "completed" => "Completed",
 "done" => "Done",
 //project states
 "planned_project" => "Planned project (not active)",
 "active_project" => "Active project" );

//common items
$lang = array(
 "description" => "Description",
 "name" => "Name",
 "add" => "Add",
 "update" => "Update",
 "submit_changes" => "Submit changes",
 "manage" => "Manage",
 "edit" => "Edit",
 "delete" => "Delete",
 "del" => "Del",
 "confirm_del" => "Confirm delete!",
 "yes" => "Yes",
 "no" => "No",
 "action" => "Action",
 "task" => "task",
 "ttask" => "Task",
 "tasks" => "Tasks",
 "project" => "project",
 "pproject" => "Project",
 "info" => "Info",
 "bytes" => " bytes",
 "select_instruct" => "(Use ctrl to select more, or to select none)",
 "member_groups" => "The user is a member of the highlighted groups below (if any)",
 "login" => "Login",
 "error" => "Error",
 "no_login" => "Access denied, incorrect login or password",
 "please_login" => "Please log in",
 
//admin config
 "admin_config" => "Admin config",
 "email_settings" => "Email header settings", 
 "admin_email" => "Admin email",
 "email_reply" => "Email 'reply to'",
 "email_from" => "Email 'from'",
 "mailing_list" => "Mailing list",
 "default_checkbox" => "Default checkbox settings for Project/Tasks",
 "allow_globalaccess" => "Allow global access?",
 "set_email_owner" => "Always email owner with changes?",
 "set_email_group" => "Always email usergroup with changes?",
 "configuration" => "Configuration",


//contacts
 "firstname" => "Firstname:",
 "lastname" => "Lastname:",
 "company" => "Company:",
 "home_phone" => "Home phone:",
 "mobile" => "Mobile:",
 "fax" => "Fax:",
 "bus_phone" => "Business phone:",
 "address" => "Address:",
 "postal" => "Postal code:",
 "city" => "City:",
 "email" => "Email:",
 "notes" => "Notes:",
 "add_contact" => "Add contact",
 "del_contact" => "Delete contact",
 "del_javascript" => "This will delete this contact.  Are you sure?",
 "contact_info" => "Contact information",
 "contacts" => "Contacts",
 "contact_add_info" => "If you add a company name then that will be displayed instead of the user's name.",
 "show_contact" => "Show contacts",
 "edit_contact" => "Edit contacts",
 "contact_submit" => "Contact submit",
 "contact_warn" => "There are not enough values to add a contact, please go back and add at least first name and last name",

 //files
 "manage_files" => "Manage files",
 "no_files" => "There are no uploaded files to manage",
 "file" => "File:",
 "uploader" => "Uploader:",
 "files_assoc_sprt" => "Files associated with this %s",
 "file_admin" => "File admin",
 "add_file" => "Add file",
 "files" => "Files",
 "file_choose" => "File to upload:",
 "upload" => "Upload",
 "max_file_sprt" => "File to upload must be less than %s kb.",
 "file_submit" => "File submit",
 "no_upload" => "No file was uploaded.  Please go back and try again.",
 "file_too_big_sprt" => "The maximum upload size is %s bytes.  Your upload was too big and has been deleted.",
 "del_file_javascript_sprt" => "Are you sure you want to delete %s ?",


 //forum
 "orig_message" => "Original message:",
 "post" => "Post it!",
 "message" => "Message:",
 "post_reply_sprt" => "Post a reply to a message from '%s' about '%s'",
 "post_message_sprt" => "Post message to: '%s'",
 "reply" => "Reply",

 "new_post" => "New post",
 "public_user_forum" => "Public user forum",
 "private_forum_sprt" => "Private forum for '%s' usergroup",
 "forum_submit" => "Forum submit",
 "no_message" => "No message! Please go back and try again",
 "add_reply" => "Add reply",

 //includes
 "report" => "Report",
 "warning" => "<H1>Sorry!</H1><P>We are unable to process your request right now. Please try again later.</P>",
 "home_page" => "Home page",
 "summary_page" => "Summary page",
 "todo_list" => "ToDo list",
 "calendar" => "Calendar",
 "log_out" => "Log out",
 "main_menu" => "Main menu",
 "user_homepage_sprt" => "%s's homepage",
 "load_time_sprt" => "This page took %.3f seconds to load.  Of that %.3f seconds were used for %d transactions with the database",
 "security_manager" => "Security manager",
 "session_timeout_sprt" => "Access denied, last action was %d minutes ago and the timeout is 60 minutes, please <A href=\"%sindex.php\">re-login</A>",
 "ip_spoof_sprt" =>"Spoofed ip address detected from your ip (%s) this session has been deleted as a precaution, please <A href=\"%sindex.php\">re-login</A>",
 "access_denied" => "Access denied",
 "private_usergroup" => "Sorry, this area is in a private usergroup and you do not have access rights.",
 "invalid_date" => "Invalid date",
 "invalid_date_sprt" => "The date of %s is not a valid calendar date (Check the number of days in month).  Please go back and re-enter a valid date.",


 //taskgroups
 "taskgroup_name" => "Taskgroup name:",
 "taskgroup_description" => "Taskgroup simple description",
 "add_taskgroup" => "Add taskgroup",
 "add_new_taskgroup" => "Add a new taskgroup",
 "edit_taskgroup" => "Edit taskgroup",
 "taskgroup_manage" => "Taskgroups management",
 "no_taskgroups" => "No taskgroups are defined",
 "manage_taskgroups" => "Manage taskgroups",
 "taskgroups" => "Taskgroups",
 "taskgroup_dup_sprt" => "There is already a taskgroup '%s'.  Please choose a new name.",
 "info_taskgroup_manage" => "Info for taskgroup management",

 //usergroups
 "usergroup_name" => "Usergroup name:",
 "usergroup_description" => "Usergroup simple description:",
 "members" => "Members:",
 "add_usergroup" => "Add usergroup",
 "add_new_usergroup" => "Add a new usergroup",
 "edit_usergroup" => "Edit usergroup",
 "usergroup_manage" => "Usergroups management",
 "no_usergroups" => "No usergroups are defined",
 "manage_usergroups" => "Manage usergroups",
 "usergroups" => "Usergroups",
 "usergroup_dup_sprt" => "There is already a usergroup '%s'.  Please choose a new name.",
 "info_usergroup_manage" => "Info for usergroup management",

 //users
 "login_name" => "Login name",
 "full_name" => "Full name",
 "password" => "Password",
 "email" => "E-mail",
 "admin" => "Admin",
 "is_admin" => "Is an admin?",
 "user_info" => "User information",
 "deleted_users" => "Deleted users",
 "no_deleted_users" => "There are no deleted users.",
 "revive" => "Revive",
 "permdel" => "Permdel",
 "permdel_javascript_sprt" => "This will permanently delete all user records and associated tasks for %s. Do you really want to do this?",
 "add_user" => "Add a user",
 "edit_user" => "Edit a user",
 "no_users" => "No users are known to the system",
 "users" => "Users",
 "existing_users" => "Existing users",
 "who_online" => "Who is online?",
 "edit_details" => "Edit user details",
 "show_details" => "Show user details",
 "user_deleted" => "This user has been deleted!",
 "no_usergroup" => "The user is not a member of any usergroups",
 "not_usergroup"=> "(Not a member of any usergroup)",
 "no_password_change" => "(Your existing password has not changed)",
 "last_time_here" => "Last time seen here:",
 "number_tasks_created" => "Number of tasks created:",
 "number_tasks_owned" => "Number of tasks owned:",
 "number_tasks_completed" => "Number of tasks completed:",
 "number_forum" => "Number of forum posts:",
 "number_files" => "Number of uploaded files:",
 "size_all_files" => "Total size of all owned files:",
 "owned_tasks" => "Owned tasks",
 "invalid_email" => "Invalid email address",
 "invalid_email_given_sprt" => "The email address '%s' is invalid.  Please go back and try again.",
 "duplicate_user" => "Duplicate user",
 "duplicate_change_user_sprt" => "The user '%s' already exists.  Please change one name.",
 "value_missing" => "Value missing",
 "field_sprt" => "The field for '%s' is missing. Please go back and fill it in.",
 "admin_priv" => "NOTE: You have been granted administrator privileges.",
 "manage_users" => "Manage users",
 "users_online" => "Users online",
 "online" => "Die hard surfers (online less than 60 mins ago)",
 "not_online" => "The rest",
 "user_activity" => "User activity",

  //tasks
 "add_new_task" => "Add a new task",
 "priority" => "Priority",
 "parent_task" => "Parent task",
 "creation_time" => "Creation time",
 "project_name" => "Project name",
 "task_name" => "Task name",
 "deadline" => "Deadline",
 "taken_from_parent" => "(Taken from parent)",
 "status" => "Status",
 "task_owner" => "Task owner",
 "project_owner" => "Project owner",
 "taskgroup" => "Taskgroup",
 "usergroup" => "Usergroup",
 "nobody" => "Nobody",
 "none" => "None",
 "no_group" => "No group",
 "all_groups" => "All groups",
 "all_users" => "All users can view this task?",
 "project_description" => "Project description",
 "task_description" => "Task description",
 "email_owner" => "Send an email to the owner with the changes?",
 "email_new_owner" => "Send an email to the (new) owner with the changes?",
 "email_group" => "Send an email to the usergroup with the changes?",
 "add_new_project" =>"Add a new project",
 "uncategorised" => "Uncategorised",
 "due_sprt" => "%d days from now",
 "tomorrow" => "Tomorrow",
 "due_today" => "Due today",
 "overdue_1" => "1 day overdue",
 "overdue_sprt" => "%d days overdue",
 "edit_task" => "Edit the task",
 "edit_project" => "Edit the project",
 "del_javascript_sprt" => "This will delete %s %s. Are you sure?",
 "add_task" => "Add task",
 "add_subtask" => "Add subtask",
 "add_project" => "Add project",
 "uncategorised" => "Uncategorised",
 "admin" => "Admin",
 "global" => "Global",
 "options" => " options",
 "task_navigation" => "Task navigation",
 "task_planned" => " Planned",
 "no_projects" => "There are no projects to view",
 "ccompleted" => "Completed",
 "project_hold" => "Project On Hold from ",
 "project_planned" => "Planned Project",
 "percent" => "% of the tasks are done",
 "no_allowed_projects" => "There are no projects that you are allowed to view",
 "projects" => "Projects",
 "percent_project_sprt" => "This project is %d%% completed",
 "owned_by" => "Owned by",
 "created_on" => "Created on",
 "completed_on" => "Completed on",
 "modified_on" => "Modified on",
 "project_on_hold" => "Project is on hold",
 "task_accessible" => "(This task is publicly accessible)",
 "task_not_accessible" => "(This task is only accessible by members of the group)",
 "task_not_in_usergroup" => "This task is not part of a usergroup and is accessible by all groups.",
 "i_take_it" => "I'll take it :)",
 "i_finished" => "I finished it!",
 "i_dont_want" => "I don't want it anymore",
 "take_over" => "Take over task",
 "task_info" => "Task information",
 "project_details" => "Project details",
 "todo_list_for" => "ToDo list for: ",
 "no_assigned" => "There are no uncompleted tasks assigned to this user.",
 "todo_list" => "ToDo list",
 "summary_list" => "Summary list",
 "task_submit" => "Task submit",
 "missing_values" => "There are not enough field values provided, please go back and try again",
 "future" => "Future",
 "flags" => "Flags",
 "owner" => "Owner",
 "usergroupid" => "usergroupid",
 "taskgroupid" => "taskgroupid",
 "group" => "Group",
 "by_usergroup" => " (by usergroup)",
 "by_taskgroup" => " (by taskgroup)",


//bits 'n' pieces
  "calendar" => "Calendar" );

?>
