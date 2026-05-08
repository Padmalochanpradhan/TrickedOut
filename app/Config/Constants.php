<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);


// Custom Added ///
define("APIURL", "https://dmkras3n1k.execute-api.us-east-1.amazonaws.com/Dev/");
define("PAGETITLE", "TRICKED OUT");
define("PAGE_TITLE_VEHICLE", "MANAGE VEHICLE");
define("MODULE_VEHICLE", "vehicle");
define("MODULE_COMPANY", "company");
define("MODULE_USER", "user");
define("MODULE_ROLE", "role");
define("PAGE_TITLE_COMPANY", "MANAGE COMPANY");
define("PAGE_TITLE_COMPANY_DETAILS", "COMPANY DETAILS");
define("PAGE_TITLE_USER", "MANAGE USERS");
define("PAGE_TITLE_ROLE", "MANAGE ROLES");
define("PAGE_TITLE_ROLE_SECURITY", "Manage Security Role");
define("PAGE_TITLE_APP_UPLOAD", "MANAGE APP DOCUMENT");

define("PAGE_TITLE_COMPLIANCE", "COMPLIANCE");
define("PAGE_TITLE_PL", "P/L REPORT");
define("PAGE_INVOICE_LIST", "INVOICE LIST");
define("PAGE_TRUCK_LIST", "TRUCK LIST");
define("PAGE_KEY_LIST", "KEY LIST");
define("PAGE_TITLE_FUEL", "FUEL DASHBOARD");
define("PAGE_TITLE_FUELMANG", "FUEL MANAGEMENT");
//define("UPLOADPATH", $_SERVER['DOCUMENT_ROOT']."/AlltradeSales/writable/uploads/");
/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */

/**
 * table Define 
 */
define('TABLE_DOCUMENT', "document");
define('TABLE_VEHICLE', "vehicle");
define('TABLE_COMPANY', "company");
define('TABLE_COMPANY_DETAILS', "company_details");
define('TABLE_USERS', "users");
define('TABLE_ROLE', "user_role");
define('TABLE_ROLE_SECURITY', "role_security");
 /**
 * Function Access Security code
 */
define('ADD_DRIVER_CODE', 101);
define('UPDATE_DRIVER_CODE', 102);
define('MANAGE_DRIVER_CODE', 103);
define('DRIVER_DOCUMENT_CODE', 104);
define('DRIVER_LEAVE_CODE', 105);

define('DAILY_ROSTER_CODE', 110);
define('DAILY_ROSTER_IMPORT_CODE', 111);

define('MANAGE_VEHICLE_CODE', 120);
define('VEHICLE_ADD_CODE', 121);
define('VEHICLE_EDIT_CODE', 122);
define('VEHICLE_DOCUMENT_CODE', 123);

define('MANAGE_COMPANY_CODE', 130);

define('MANAGE_ROLE_CODE', 140);
define('ROLE_ADD_CODE', 141);
define('ROLE_EDIT_CODE', 142);
define('ROLE_SECURITY_CODE', 143);

define('MANAGE_USER_CODE', 150);
define('USER_ADD_CODE', 151);
define('USER_EDIT_CODE', 152);

 /**
 * Common API 
 */
 define('API_INSERT_DATA', "insertdata");
 define('API_UPDATE_DATA', "TrickedOutUpdateTableFields");
 define('API_INSERT_MULTIPLE_DATA', "TrickedOutInsertMultipleRows");
 define('API_GET_ACTION_DROPDOWN_DETAILS_BY_MODULE', "getactiondropdowndetailsbymodule");

/**
 * API for vehicle 
 */
 define('API_VEHICLE_LIST', "dspgetvehiclelist");
 define('API_VEHICLE_CATEGORY_LIST', "dspgetvehiclecategorylist");
 define('API_VEHICLE_MAKER_LIST', "dspgetvehiclemakerlist");
 define('API_VEHICLE_TYPE_LIST', "dspgetvehicletypelist");
 define('API_VEHICLE_DETAILS', "dspgetvehicledetailsbyid");
 define('API_VEHICLE_DUPLICATE_CHECK', "dspgetvehicleduplicatecheck");
 
 /**
 * API for document 
 */
 define('API_DOCUMENT_LIST', "dspgetdocumentlistbytypeandtypeid");
  /**
 * API for company 
 */
define('API_COMPANY_ALL_LIST', "dspgetallcompanylist");
define('API_COMPANY_LIST', "dspgetcompanylist");
define('API_COMPANY_DUPLICATE_CHECK', "dspgetcompanyduplicatecheck");
define('API_COMPANY_BRANCH_HEAD_USER_LIST', "dspgetuserlist");
define('API_COMPANY_ADDRESS_DETAILS', "dspgetcompanydetails");

 define('VEHICLE_DOCUMENT_TYPE', "vehicle");
  /**
 * API for User & Role
 */
define('API_USER_LIST', "dspgetuserlist");
define('API_USER_ROLE_LIST', "dspgetuserrolelist");
define('API_CHILD_COMPANY_LIST', "dspgetchildcompanylist");
define('API_USER_DUPLICATE_CHECK', "dspgetuserduplicatecheck");
define('API_ROLE_DUPLICATE_CHECK', "dspgetroleduplicatecheck");
define('API_GET_ROLE_SECURITY_LIST', "getrolesecuritylist");
define('API_GET_FUNCTION_SECURITY_BY_ROLE_ID', "getfunctionsecuritybyroleid");

/* API for App uploaded document list */
define('API_APP_UPLOADED_DOCUMENT_LIST', "DSPGetAppUploadedPhotoList");

/* API for darly roster import */
define('API_DELETE_DAILY_ROSTER_TEMP_RECORD', "dspdeletedailyrostertemprecord");
define('API_UPDATE_ASSOCIATE_NAME_DARLY_ROSTER_TEMP_RECORD', "dspupdateassociatenamedailyrostertemprecord");
define('API_MOVE_DAILY_ROSTER_TEMP_TO_DAILY_ROSTER', "dspmovedailyrostertemptodailyroster");
define('API_CANCEL_DARLY_ROSTER_TEMP_PROCESS', "dspcanceldailyrostertempprocess");
define('API_GET_DARLY_ROSTER_TEMP_RECORD', "dspgetdailyrostertemprecord");
/* API for darly roster import*/
define('API_GET_DAILY_ROSTER_RECORDS', "dspgetdailyrosterrecords");

/* API for driver */
define('API_GET_DRIVER_LIST', "dspgetdriverlist");
define('API_GET_DRIVER_LIST_FOR_SELECT', "dspgetdriverlistforselect");

define('API_GET_WEEKLY_SERVICE_WORKSHEET', "dspgetweeklyserviceworksheetrecords");

/* API for leave manage */
define('API_GET_EMPLOYEE_LEAVE_LIST', "dspgetemployeeleavelist");
 /**
 * Global Messages
 */
 define('INSERT_SUCESS_MSG', "Successfully data saved.");
 define('UPDATE_SUCESS_MSG', "Successfully data updated.");
 define('API_ERROR_MSG', "Error: Error occoured.");
 define('DELETE_SUCESS_MSG', "Data deleted successfully.");
 define('UPLOAD_SUCESS_MSG', "Document uploaded successfully.");
 define('UPLOAD_DELETE_MSG', "Document deleted successfully.");
 define('UPLOAD_ERROR_MSG', "ERROR: Error in file upload.");
 define('COMPANY_ERROR_MSG', "Company already exist with the same name.");
 define('GET_DOCUMENT_LIST_FAILED', "Error: Document list not loaded.");
 define('VEHICLE_ERROR_MSG', "Error:Vehicle already exist with the same license plate number.");
 define('ROLE_ERROR_MSG', "Error:Role already exist.");
 define('USER_ERROR_MSG', "Error:User already exist with same phone no.");
 /* Daily Roaster Import Message */
define("DRI_TEMP_ROW_DELETE_SUCCESS_MSG", "Selected row successfully deleted.");
define("DRI_TEMP_ROW_DELETE_FALL_MSG", "Error: Selected row not deleted.");
define("DRI_TEMP_DRIVER_CHANGE_SUCCESS_MSG", "Associate successfully updated.");
define("DRI_TEMP_DRIVER_CHANGE_FALL_MSG", "Error: Associate not updated.");
define("DRI_TEMP_DATA_PROCESS_SUCCESS_MSG", "Import process successfully.");
define("DRI_TEMP_DATA_PROCESS_FALL_MSG", "Error: Data not process.");
define("DRI_TEMP_CANCEL_PROCESS_SUCCESS_MSG", "Import process successfully cancel.");
define("DRI_TEMP_CANCEL_PROCESS_FALL_MSG", "Error: Cancel process failed.");
define("DRI_TEMP_GET_TEMP_DATA_FALL_MSG", "Error: Temp record fetch failed.");
define("DRI_TEMP_IMPORT_PROCESS_CONFIRM_MSG", "Are you sure to process?");
define("DRI_TEMP_IMPORT_CANCEL_CONFIRM_MSG", "Are you sure to cancel this import? In this action your display data has been deleted.");
define("DRI_TEMP_IMPORT_PROCESS_DATA_UPDATE_HINT_MSG", "Duplicate records are shown in orange colour if processed old data of the master table will be updated.");
define("DRI_TEMP_IMPORT_PROCESS_DATA_NOT_PROCESS_HINT_MSG", "Red colour records, can't be processed.");
define("DRI_TEMP_IMPORT_FILE_HINT_MSG", "Maximun file size 12MB csv file only. Sample File");
define("DRI_TEMP_ROW_DELETE_CONFIRM_MSG", "Are you sure to delete this row?");
/* Driver Manage Message */ 
define("DOCUMENT_UPLOAD_SUCCESS_MSG", "Document successfully uploaded.");
define("DRIVER_ADD_SUCCESS_MSG", "Driver successfully added.");
define("DRIVER_ADD_FALL_MSG", "Error: Driver  add failed.");
define("DRIVER_UPDATE_SUCCESS_MSG", "Driver successfully updated.");
define("DRIVER_UPDATE_FALL_MSG", "Error: Driver  update failed.");

define("FUEL_ADD_SUCCESS_MSG", "Fuel successfully added.");
 

/* Leave Manage Message */ 
define("LEAVE_ADD_SUCCESS_MSG", "Leave successfully added.");
define("LEAVE_ADD_FALL_MSG", "Error: Leave  add failed.");
define("LEAVE_UPDATE_SUCCESS_MSG", "Leave successfully updated.");
define("LEAVE_UPDATE_FALL_MSG", "Error: Leave  update failed.");

/* Permission Denied  Message */ 
define("PERMISSION_DENIED_MSG", "Permission denied for this action.");

define("WEEKLY_SERVICE_WORKSHEET_IMPORT_SUCCESS_MSG", "Import process successfully.");

 /**
 * Global Variables
 */
 define('STATUS_ACTIVE', "Active");
 define('STATUS_INACTIVE', "In-Active");
 define('MODAL_TITLE_NEW', "New");
 define('MODAL_TITLE_EDIT', "Edit");
 define('UPLOAD_PATH', "uploads/logo/");
 define('FOLDER_UPLOAD', "trick_files/");
 define('ATTACHMENT_FOLDER', "attachment/");
 define('STATE_NAME', "Aspen");
 define('UPLOAD_LABEL', "(Only .jpeg/.jpg/.gif/.png are allow. Upload file size upto 8MB)");
define('EVENT_PRIORITY_HIGH', 10);

 /**
 * Global HTMl Patterns
 */

 define('PATTERN_LETTER_ONLY', "^[A-Za-z -]+$");
/* Page Title */

 define('PAGE_TITLE_MANAGE_DRIVER', "MANAGE DRIVER");
 define('PAGE_TITLE_DRIVER_DETAILS', "DRIVER DETAILS");
 define('PAGE_TITLE_VEHICLE_DETAILS', "VEHICLE DETAILS");
 define('PAGE_TITLE_MANAGE_LEAVE', "MANAGE LEAVE");
 define('PAGE_TITLE_DAYLY_ROSTER', "DAILY ROASTER");
 define('PAGE_TITLE_DAYLY_ROSTER_IMPORT', "DAILY ROASTER IMPORT");
 define('PAGE_TITLE_WEEKLY_SERVICE_WORKSHEET', "WEEKLY SERVICE WORKSHEET");
 define('PAGE_TITLE_VEHICLE_INSPECTION', "VEHICLE INSPECTION");
 define('PAGE_TITLE_VEHICLE_MAINTENANCE', "VEHICLE MAINTENANCE");
 define('PAGE_TITLE_TASKMANG', "MANAGE TASK"); 
 

/*  */
 define('DATE_FORMAT', "mm/dd/yy");
 define('DB_DATE_FORMAT', "YYYY-MM-DD");
