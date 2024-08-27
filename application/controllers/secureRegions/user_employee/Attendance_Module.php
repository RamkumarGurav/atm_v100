<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . "controllers/secureRegions/Main.php");
class Attendance_Module extends Main
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');


    $this->load->model('Common_Model');
    $this->load->model('administrator/Admin_Common_Model');
    $this->load->model('administrator/Admin_model');
    $this->load->model('administrator/user_employee/Attendance_Model');
    $this->load->model('administrator/user_employee/User_Employee_Model');


    $this->load->library('pagination');
    $this->load->library('User_auth');

    $session_uid = $this->data['session_uid'] = $this->session->userdata('sess_psts_uid');
    $this->data['session_name'] = $this->session->userdata('sess_psts_name');
    $this->data['session_email'] = $this->session->userdata('sess_psts_email');

    $this->load->helper('url');

    $this->data['User_auth_obj'] = new User_auth();
    $this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();

    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");

  }

  /****************************************************************
   *HELPERS
   ****************************************************************/

  function unset_only()
  {
    $user_data = $this->session->all_userdata();
    foreach ($user_data as $key => $value) {
      if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
        $this->session->unset_userdata($key);
      }
    }
  }

  /****************************************************************
   ****************************************************************/

  function index()
  {

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/attendance/list', $this->data);
    parent::get_footer();
  }



  /**
   * Displays the list of countries in the admin panel.
   */
  function attendance_list()
  {





    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $login_date = '';
    $logout_date = '';
    $end_date = '';
    $start_date = '';
    $user_employee_custom_id = "";
    $branch_id = 0;
    $user_employee_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $attendance_record_status = "";
    $user_employee_record_status = "1and2";

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];
    if (!empty($_POST['login_date']))
      $login_date = $_POST['login_date'];

    if (!empty($_POST['logout_date']))
      $logout_date = $_POST['logout_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['attendance_record_status']))
      $attendance_record_status = $_POST['attendance_record_status'];

    if (!empty($_POST['user_employee_record_status']))
      $user_employee_record_status = $_POST['user_employee_record_status'];

    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['login_date'] = $login_date;
    $this->data['logout_date'] = $logout_date;
    $this->data['start_date'] = $start_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['user_employee_record_status'] = $user_employee_record_status;
    $this->data['attendance_record_status'] = $attendance_record_status;

    // Setting search parameters
    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['login_date'] = $login_date;
    $search['logout_date'] = $logout_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['attendance_record_status'] = $attendance_record_status;
    $search['user_employee_record_status'] = $user_employee_record_status;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->Attendance_Model->get_attendance($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['attendance_data'] = $this->Attendance_Model->get_attendance($search);
    $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/attendance_list', $this->data);
    parent::get_footer();
  }




  function attendance_report_list()
  {



    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $end_date = new DateTime();
    $end_date->modify('-1 day');
    $end_date = $end_date->format("d-m-Y");
    $start_date = new DateTime();
    $start_date->modify('-31 days');
    $start_date = $start_date->format("d-m-Y");

    $user_employee_custom_id = "";
    $user_employee_id = 0;
    $branch_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $attendance_record_status = "";
    $record_status = "1and2";
    $attendance_report = 1;

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date'])) {
      $end_date = date("d-m-Y", strtotime($_POST['end_date']));
      // $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    }


    if (!empty($_POST['start_date'])) {
      $start_date = date("d-m-Y", strtotime($_POST['start_date']));
      // $start_date = date("Y-m-d", strtotime($_POST['start_date']));

    }

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['attendance_record_status']))
      $attendance_record_status = $_POST['attendance_record_status'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];


    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['start_date'] = $start_date;
    $this->data['end_date'] = $end_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['attendance_record_status'] = $attendance_record_status;
    $this->data['record_status'] = $record_status;

    // Setting search parameters
    $start_date = new DateTime($start_date);
    // $start_date->modify('-1 day');
    $start_date = $start_date->format("Y-m-d");
    $end_date = new DateTime($end_date);
    // $end_date->modify('+1 day');
    $end_date = $end_date->format("Y-m-d");

    $attendance_search['start_date'] = $start_date;
    $attendance_search['end_date'] = $end_date;
    $search['attendance_report'] = $attendance_report;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['attendance_record_status'] = $attendance_record_status;
    $search['record_status'] = $record_status;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->User_Employee_Model->get_user_employee($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    // $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['user_employee_data'] = $this->User_Employee_Model->get_user_employee($search);

    foreach ($this->data['user_employee_data'] as $item) {
      $attendance_search['user_employee_id'] = $item->user_employee_id;
      $attendance_search['attendance_record_status'] = "1";
      $attendance_data = $this->Attendance_Model->get_single_user_employee_attendance_report_0($attendance_search);

      // $attendance_data_list = $this->Attendance_Model->get_single_user_employee_attendance_report_list_0($attendance_search);
      $attendance_data_list = $this->Attendance_Model->get_single_user_employee_attendance_report_list_2($attendance_search);
      $item->attendance_data = $attendance_data ? $attendance_data[0] : (object) array(
        'total_attendance_count' => 0,
        'late_logins_count' => 0,
        'early_logouts_count' => 0,
        'total_work_time' => "00:00:00",
      );
      $item->attendance_data_list = $attendance_data_list;

    }

    $this->data['user_employee_data'] = $this->generate_report($this->data['user_employee_data']);




    $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    $this->session->set_userdata("user_employee_data", $this->data['user_employee_data']);
    $this->session->set_userdata("start_date", $start_date);
    $this->session->set_userdata("end_date", $end_date);


    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/attendance_report_list', $this->data);
    // $this->load->view('admin/user_employee/Attendance_Module/today_attendance_report_list', $this->data);
    parent::get_footer();


  }


  function today_attendance_report_list()
  {



    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $end_date = new DateTime();
    // $end_date->modify('-1 day');
    $end_date = $end_date->format("d-m-Y");
    $start_date = new DateTime();
    // $start_date->modify('-31 days');
    $start_date = $start_date->format("d-m-Y");

    $user_employee_custom_id = "";
    $user_employee_id = 0;
    $branch_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $attendance_record_status = "";
    $record_status = "1and2";
    $attendance_report = 1;

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date'])) {
      $end_date = date("d-m-Y", strtotime($_POST['end_date']));
      // $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    }


    if (!empty($_POST['start_date'])) {
      $start_date = date("d-m-Y", strtotime($_POST['start_date']));
      // $start_date = date("Y-m-d", strtotime($_POST['start_date']));

    }

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['attendance_record_status']))
      $attendance_record_status = $_POST['attendance_record_status'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];


    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['start_date'] = $start_date;
    $this->data['end_date'] = $end_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['attendance_record_status'] = $attendance_record_status;
    $this->data['record_status'] = $record_status;

    // Setting search parameters
    $start_date = new DateTime($start_date);
    // $start_date->modify('-1 day');
    $start_date = $start_date->format("Y-m-d");
    $end_date = new DateTime($end_date);
    // $end_date->modify('+1 day');
    $end_date = $end_date->format("Y-m-d");

    $attendance_search['start_date'] = $start_date;
    $attendance_search['end_date'] = $end_date;
    $search['attendance_report'] = $attendance_report;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['attendance_record_status'] = $attendance_record_status;
    $search['record_status'] = $record_status;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->User_Employee_Model->get_user_employee($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    // $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['user_employee_data'] = $this->User_Employee_Model->get_user_employee($search);

    foreach ($this->data['user_employee_data'] as $item) {
      $attendance_search['user_employee_id'] = $item->user_employee_id;
      $attendance_search['attendance_record_status'] = "1";
      $attendance_data = $this->Attendance_Model->get_single_user_employee_attendance_report_0($attendance_search);

      // $attendance_data_list = $this->Attendance_Model->get_single_user_employee_attendance_report_list_0($attendance_search);
      $attendance_data_list = $this->Attendance_Model->get_single_user_employee_attendance_report_list_2($attendance_search);
      $item->attendance_data = $attendance_data ? $attendance_data[0] : (object) array(
        'total_attendance_count' => 0,
        'late_logins_count' => 0,
        'early_logouts_count' => 0,
        'total_work_time' => "00:00:00",
      );
      $item->attendance_data_list = $attendance_data_list;

    }

    $this->data['user_employee_data'] = $this->generate_report($this->data['user_employee_data']);




    $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    $this->session->set_userdata("today_user_employee_data", $this->data['user_employee_data']);
    $this->session->set_userdata("today_start_date", $start_date);
    $this->session->set_userdata("today_end_date", $end_date);

    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    // $this->load->view('admin/user_employee/Attendance_Module/attendance_report_list', $this->data);
    $this->load->view('admin/user_employee/Attendance_Module/today_attendance_report_list', $this->data);
    parent::get_footer();


  }


  function today_attendance_report_list_export()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));



    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if ($this->data['user_access']->export_data != 1) {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }





    $this->data["user_employee_data"] = $this->session->userdata("today_user_employee_data");
    $this->data["start_date"] = $this->session->userdata("today_start_date");
    $this->data["end_date"] = $this->session->userdata("today_end_date");



    $this->load->view('admin/user_employee/Attendance_Module/today_attendance_report_list_export', $this->data);
  }

  function yesterday_attendance_report_list()
  {



    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $end_date = new DateTime();
    $end_date->modify('-1 day');
    $end_date = $end_date->format("d-m-Y");
    $start_date = new DateTime();
    $start_date->modify('-1 day');
    $start_date = $start_date->format("d-m-Y");

    $user_employee_custom_id = "";
    $user_employee_id = 0;
    $branch_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $attendance_record_status = "";
    $record_status = "1and2";
    $attendance_report = 1;

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date'])) {
      $end_date = date("d-m-Y", strtotime($_POST['end_date']));
      // $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    }


    if (!empty($_POST['start_date'])) {
      $start_date = date("d-m-Y", strtotime($_POST['start_date']));
      // $start_date = date("Y-m-d", strtotime($_POST['start_date']));

    }

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['attendance_record_status']))
      $attendance_record_status = $_POST['attendance_record_status'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];


    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['start_date'] = $start_date;
    $this->data['end_date'] = $end_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['attendance_record_status'] = $attendance_record_status;
    $this->data['record_status'] = $record_status;

    // Setting search parameters
    $start_date = new DateTime($start_date);
    // $start_date->modify('-1 day');
    $start_date = $start_date->format("Y-m-d");
    $end_date = new DateTime($end_date);
    // $end_date->modify('+1 day');
    $end_date = $end_date->format("Y-m-d");

    $attendance_search['start_date'] = $start_date;
    $attendance_search['end_date'] = $end_date;
    $search['attendance_report'] = $attendance_report;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['attendance_record_status'] = $attendance_record_status;
    $search['record_status'] = $record_status;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->User_Employee_Model->get_user_employee($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    // $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['user_employee_data'] = $this->User_Employee_Model->get_user_employee($search);

    foreach ($this->data['user_employee_data'] as $item) {
      $attendance_search['user_employee_id'] = $item->user_employee_id;
      $attendance_search['attendance_record_status'] = "1";
      $attendance_data = $this->Attendance_Model->get_single_user_employee_attendance_report_0($attendance_search);

      // $attendance_data_list = $this->Attendance_Model->get_single_user_employee_attendance_report_list_0($attendance_search);
      $attendance_data_list = $this->Attendance_Model->get_single_user_employee_attendance_report_list_2($attendance_search);
      $item->attendance_data = $attendance_data ? $attendance_data[0] : (object) array(
        'total_attendance_count' => 0,
        'late_logins_count' => 0,
        'early_logouts_count' => 0,
        'total_work_time' => "00:00:00",
      );
      $item->attendance_data_list = $attendance_data_list;

    }

    $this->data['user_employee_data'] = $this->generate_report($this->data['user_employee_data']);




    $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    $this->session->set_userdata("yesterday_user_employee_data", $this->data['user_employee_data']);
    $this->session->set_userdata("yesterday_start_date", $start_date);
    $this->session->set_userdata("yesterday_end_date", $end_date);


    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    // $this->load->view('admin/user_employee/Attendance_Module/attendance_report_list', $this->data);
    $this->load->view('admin/user_employee/Attendance_Module/yesterday_attendance_report_list', $this->data);
    parent::get_footer();


  }


  function yesterday_attendance_report_list_export()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));



    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if ($this->data['user_access']->export_data != 1) {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }





    $this->data["user_employee_data"] = $this->session->userdata("yesterday_user_employee_data");
    $this->data["start_date"] = $this->session->userdata("yesterday_start_date");
    $this->data["end_date"] = $this->session->userdata("yesterday_end_date");



    $this->load->view('admin/user_employee/Attendance_Module/yesterday_attendance_report_list_export', $this->data);
  }
  function generate_report($ue_data)
  {
    $result = [];
    foreach ($ue_data as $item) {


      $report = (object) array();
      $total_days = 0;
      $total_actual_worked_days = 0;
      $total_expected_worked_days = 0;
      $total_extra_worked_days = 0;
      $total_absent_days = 0;
      $total_holidays = 0;
      $total_expected_worked_time = "00:00:00";
      $total_actual_worked_time = "00:00:00";
      $total_late_logins = 0;
      $total_early_logouts = 0;

      $attendance_list = [];
      foreach ($item->attendance_data_list as $attendance_item) {
        $total_days++;


        $individual_total_expected_worked_time = $this->calculateExpectedTotalTime($attendance_item->expected_login_time, $attendance_item->expected_logout_time);
        $attendance_item->total_expected_worked_time = $individual_total_expected_worked_time;

        $total_expected_worked_time = $this->addTimes($total_expected_worked_time, $individual_total_expected_worked_time);

        if (!empty($attendance_item->is_working_day)) {
          $total_expected_worked_days++;
        }

        if (!empty($attendance_item->data_present)) {
          $attendance_item->late_login_by = "";
          $attendance_item->early_logout_by = "";
          $late_login_by = $this->is_login_late1($attendance_item->login_time, $attendance_item->expected_login_time);
          if (!empty($late_login_by)) {
            $total_late_logins++;
            $attendance_item->late_login_by = $late_login_by;
          }



          if (!empty($attendance_item->logout_time)) {
            $individual_total_worked_time = $this->calculateExpectedTotalTime($attendance_item->login_time, $attendance_item->logout_time);
            $total_actual_worked_time = $this->addTimes($total_actual_worked_time, $individual_total_worked_time);
            $attendance_item->total_actual_worked_time = $individual_total_worked_time;
            $early_logout_by = $this->is_logout_early1($attendance_item->logout_time, $attendance_item->expected_logout_time);
            if (!empty($early_logout_by)) {
              $total_early_logouts++;
              $attendance_item->early_logout_by = $early_logout_by;
            }
          }





          $total_actual_worked_days++;

          // $attendance_list[] = $attendance_item;
          if (!empty($attendance_item->is_working_day)) {

          } else {
            $total_extra_worked_days++;
          }
        } else {
          if (!empty($attendance_item->is_working_day)) {
            $total_absent_days++;
          } else {
            $total_holidays++;
          }
        }


        $attendance_item->date = date("d-m-Y", strtotime($attendance_item->date));

        $attendance_list[] = $attendance_item;
      }



      $result[] = (object) array(
        "name" => $item->name,
        "user_employee_id" => $item->user_employee_id,
        "user_employee_custom_id" => $item->user_employee_custom_id,
        "profile_image" => $item->profile_image,
        "branch_name" => $item->branch_name,
        "department_name" => $item->department_name,
        "designation_name" => $item->designation_name,
        "contactno" => $item->contactno,
        "personal_email" => $item->personal_email,
        "birthday" => $item->birthday,
        "joining_date" => $item->joining_date,
        "address" => $item->address,
        "status" => $item->status,

        "attendance_data" => (object) array(
          "total_days" => $total_days,
          "total_actual_worked_days" => $total_actual_worked_days,
          "total_expected_worked_days" => $total_expected_worked_days,
          "total_extra_worked_days" => $total_extra_worked_days,
          "total_absent_days" => $total_absent_days,
          "total_holidays" => $total_holidays,
          "total_expected_worked_time" => $total_expected_worked_time,
          "total_actual_worked_time" => $total_actual_worked_time,
          "total_late_logins" => $total_late_logins,
          "total_early_logouts" => $total_early_logouts,
        ),
        "attendance_data_list" => $attendance_list,
      );

    }

    return $result;

  }

  function is_login_late($logged_time, $expected_login_time)
  {
    // Parse the logged time
    $logged_datetime = new DateTime($logged_time);

    // Get the date part from logged time
    $date = $logged_datetime->format('Y-m-d');

    // Combine the date with expected login time
    $expected_datetime = new DateTime($date . ' ' . $expected_login_time);

    // Add 15 minutes grace period
    $expected_datetime->add(new DateInterval('PT15M'));

    // Compare the times
    return $logged_datetime > $expected_datetime;
  }

  function is_login_late1($logged_time, $expected_login_time)
  {
    // $result = (object) [];
    // Parse the logged time
    $logged_datetime = new DateTime($logged_time);

    // Get the date part from logged time
    $date = $logged_datetime->format('Y-m-d');

    // Combine the date with expected login time
    $expected_datetime_1 = new DateTime($date . ' ' . $expected_login_time);
    $expected_datetime = new DateTime($date . ' ' . $expected_login_time);

    // Add 15 minutes grace period
    $expected_datetime->add(new DateInterval('PT15M'));

    // Calculate the difference
    if ($logged_datetime > $expected_datetime) {
      $interval = $logged_datetime->diff($expected_datetime_1);
      $time = $interval->format('%H:%I:%S');
      return $time;

    } else {
      return ""; // Not late
    }
  }
  function is_logout_early1($logged_out_time, $expected_logout_time)
  {
    // Parse the logged time
    $logged_out_datetime = new DateTime($logged_out_time);

    // Get the date part from logged time
    $date = $logged_out_datetime->format('Y-m-d');

    // Combine the date with expected login time
    $expected_datetime_1 = new DateTime($date . ' ' . $expected_logout_time);
    $expected_datetime = new DateTime($date . ' ' . $expected_logout_time);

    // Add 15 minutes grace period
    $expected_datetime->sub(new DateInterval('PT15M'));


    // Calculate the difference
    if ($logged_out_datetime < $expected_datetime) {
      $interval = $logged_out_datetime->diff($expected_datetime_1);
      $time = $interval->format('%H:%I:%S');
      return $time;

    } else {
      return ""; // Not late
    }
  }
  function is_logout_early($logged_out_time, $expected_logout_time)
  {
    // Parse the logged time
    $logged_out_datetime = new DateTime($logged_out_time);

    // Get the date part from logged time
    $date = $logged_out_datetime->format('Y-m-d');

    // Combine the date with expected login time
    $expected_datetime = new DateTime($date . ' ' . $expected_logout_time);

    // Add 15 minutes grace period
    $expected_datetime->sub(new DateInterval('PT15M'));

    // Compare the times
    return $logged_out_datetime < $expected_datetime;
  }
  function calculateExpectedTotalTime($expectedLoginTime, $expectedLogoutTime)
  {
    // Convert the times to DateTime objects
    $loginTime = new DateTime($expectedLoginTime);
    $logoutTime = new DateTime($expectedLogoutTime);

    // Calculate the difference between the two times
    $interval = $loginTime->diff($logoutTime);

    // Format the interval as HH:MM:SS
    $expectedTotalTime = $interval->format('%H:%I:%S');

    return $expectedTotalTime;
  }

  function addTimes($time1, $time2)
  {
    // Split times into hours, minutes, and seconds
    list($h1, $m1, $s1) = explode(':', $time1);
    list($h2, $m2, $s2) = explode(':', $time2);

    // Convert hours, minutes, and seconds to total seconds
    $totalSeconds1 = $h1 * 3600 + $m1 * 60 + $s1;
    $totalSeconds2 = $h2 * 3600 + $m2 * 60 + $s2;

    // Sum the total seconds
    $totalSeconds = $totalSeconds1 + $totalSeconds2;

    // Convert back to hours, minutes, and seconds
    $hours = floor($totalSeconds / 3600);
    $minutes = floor(($totalSeconds % 3600) / 60);
    $seconds = $totalSeconds % 60;

    // Format the result as H:i:s
    $result = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    return $result;
  }

  function attendance_report_list_export()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));



    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if ($this->data['user_access']->export_data != 1) {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }




    $this->data["user_employee_data"] = $this->session->userdata("user_employee_data");
    $this->data["start_date"] = $this->session->userdata("start_date");
    $this->data["end_date"] = $this->session->userdata("end_date");



    $this->load->view('admin/user_employee/Attendance_Module/attendance_report_list_export', $this->data);
  }

  // function attendance_report_list_export()
  // {

  //   echo "<pre> <br>";
  //   print_r("hi");
  //   exit;

  //   $this->data['page_type'] = "list";
  //   $this->data['page_module_id'] = 12;
  //   $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
  //   //print_r($this->data['user_access']);
  //   if (empty($this->data['user_access'])) {
  //     REDIRECT(MAINSITE_Admin . "wam/access-denied");
  //   }

  //   if ($this->data['user_access']->export_data != 1) {
  //     $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->module_name);
  //     REDIRECT(MAINSITE_Admin . "wam/access-denied");
  //   }
  //   $search = array();
  //   $field_name = '';
  //   $field_value = '';
  //   $end_date = '';
  //   $start_date = '';
  //   $record_status = "";
  //   $country_id = "";
  //   $state_id = "";

  //   if (!empty($_REQUEST['field_name']))
  //     $field_name = $_POST['field_name'];
  //   else if (!empty($field_name))
  //     $field_name = $field_name;

  //   if (!empty($_REQUEST['field_value']))
  //     $field_value = $_POST['field_value'];
  //   else if (!empty($field_value))
  //     $field_value = $field_value;

  //   if (!empty($_POST['end_date']))
  //     $end_date = $_POST['end_date'];

  //   if (!empty($_POST['start_date']))
  //     $start_date = $_POST['start_date'];

  //   if (!empty($_POST['record_status']))
  //     $record_status = $_POST['record_status'];

  //   if (!empty($_POST['country_id']))
  //     $country_id = $_POST['country_id'];

  //   if (!empty($_POST['state_id']))
  //     $state_id = $_POST['state_id'];


  //   $this->data['field_name'] = $field_name;
  //   $this->data['field_value'] = $field_value;
  //   $this->data['end_date'] = $end_date;
  //   $this->data['start_date'] = $start_date;
  //   $this->data['record_status'] = $record_status;
  //   $this->data['country_id'] = $country_id;
  //   $this->data['state_id'] = $state_id;

  //   $search['end_date'] = $end_date;
  //   $search['start_date'] = $start_date;
  //   $search['field_value'] = $field_value;
  //   $search['field_name'] = $field_name;
  //   $search['record_status'] = $record_status;
  //   $search['country_id'] = $country_id;
  //   $search['state_id'] = $state_id;
  //   $search['details'] = 1;

  //   $this->data['employee_data'] = $this->Employee_Model->get_employee($search);


  //   $this->load->view('admin/human_resource/Employee_Module/attendance_report_list_export', $this->data);
  // }

  function attendance_list_export()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 2;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if ($this->data['user_access']->export_data != 1) {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $search = array();
    $field_name = '';
    $field_value = '';
    $end_date = '';
    $start_date = '';
    $record_status = "";

    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];


    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['start_date'] = $start_date;
    $this->data['record_status'] = $record_status;

    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['record_status'] = $record_status;

    $this->data['attendance_data'] = $this->Attendance_Model->get_attendance($search);


    $this->load->view('admin/user_employee/Attendance_Module/attendance_list_export', $this->data);
  }

  function attendance_view($attendance_id = "")
  {

    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($attendance_id)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    $this->data['attendance_data'] = $this->Attendance_Model->get_attendance(array("attendance_id" => $attendance_id));
    if (empty($attendance_id)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }





    $this->data['attendance_data'] = $this->data['attendance_data'][0];
    $this->data['user_employee_data'] = $this->User_Employee_Model->get_user_employee(array("user_employee_id" => $this->data['attendance_data']->user_employee_id, "details" => 1));
    $this->data['user_employee_data'] = $this->data['user_employee_data'][0];
    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/attendance_view', $this->data);
    parent::get_footer();
  }

  function attendance_edit($attendance_id = "")
  {


    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    if (empty($attendance_id)) {
      if ($user_access->add_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }
    if (!empty($attendance_id)) {
      if ($user_access->update_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;



    if (!empty($attendance_id)) {
      $this->data['attendance_data'] = $this->Attendance_Model->get_attendance(array("attendance_id" => $attendance_id));

      if (empty($this->data['attendance_data'])) {
        $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Record Not Found. 
				  </div>');
        REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
      }
      $this->data['attendance_data'] = $this->data['attendance_data'][0];
      $user_employee_id = $this->data['attendance_data']->user_employee_id;
      $this->data['user_employee_data'] = $this->User_Employee_Model->get_user_employee(array("user_employee_id" => $user_employee_id, "details" => 1));
      if (empty($this->data['user_employee_data'])) {
        $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> User Employee Not Found. 
				  </div>');
        REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
      }
      $this->data['user_employee_data'] = $this->data['user_employee_data'][0];

    }



    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/attendance_edit', $this->data);
    parent::get_footer();
  }

  function attendance_doEdit()
  {





    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    if (empty($_POST['login_time']) && empty($_POST['user_employee_custom_id'])) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" 
      data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }

    $attendance_id = $_POST['attendance_id'];
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if (empty($attendance_id)) {
      if ($user_access->add_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }

    if (!empty($attendance_id)) {
      if ($user_access->update_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }
    $user_employee_custom_id = trim($_POST['user_employee_custom_id']);
    $login_time = trim($_POST['login_time']);
    if (!empty($login_time)) {
      $login_time = date("Y-m-d H:i:s", strtotime($login_time));
    } else {
      $login_time = null;
    }
    $logout_time = trim($_POST['logout_time']);
    if (!empty($logout_time)) {
      $logout_time = date("Y-m-d H:i:s", strtotime($logout_time));
    } else {
      $logout_time = null;
    }


    $total_time = "";
    if (!empty($logout_time) && !(empty($login_time))) {
      $total_time = $this->total_time_between_login_and_logout($login_time, $logout_time);
      $invalid_logout = $this->is_time1_greater_than_time2($total_time, 12);
      if (!empty($invalid_logout)) {
        $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" 
        data-dismiss="alert" 
        aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Invalid Logout Time .Time Difference between login and logout must not be more than 12 hours</div>';

        $this->session->set_flashdata('alert_message', $alert_message);

        REDIRECT(MAINSITE_Admin . $user_access->class_name . "/attendance-edit/" . $attendance_id);
        exit;
      }
    }


    $status = $_POST['status'];


    $this->data['user_employee_data'] = $this->User_Employee_Model->get_user_employee(array("user_employee_custom_id" => $user_employee_custom_id));




    if (empty($this->data['user_employee_data'])) {

      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" 
      data-dismiss="alert" 
			aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Invalid Employee ID .</div>';

      $this->session->set_flashdata('alert_message', $alert_message);

      if (!empty($attendance_id)) {
        REDIRECT(MAINSITE_Admin . $user_access->class_name . "/attendance-edit/" . $attendance_id);
        exit;
      } else {
        REDIRECT(MAINSITE_Admin . $user_access->class_name . "/attendance-edit");
        exit;
      }

    }

    $this->data["user_employee_data"] = $this->data["user_employee_data"][0];
    $user_employee_data = $this->data["user_employee_data"];


    $user_employee_id = $enter_data['user_employee_id'] = $user_employee_data->user_employee_id;
    $enter_data['login_time'] = $login_time;
    $enter_data['logout_time'] = $logout_time;
    $enter_data['total_time'] = $total_time;
    $enter_data['status'] = $_POST['status'];

    /**********1**************** */
    $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"
     aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. </div>';

    if (!empty($attendance_id)) {



      $enter_data['updated_on'] = date("Y-m-d H:i:s");
      $enter_data['updated_by'] = $this->data['session_uid'];

      $insertStatus = $this->Common_Model->update_operation(array('table' => 'attendance', 'data' => $enter_data, 'condition' => "attendance_id = $attendance_id"));
      if (!empty($insertStatus)) {
        $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Admin updated the Employee attendance record";
        $attendance_log_enter_data["attendance_log"] = $attendance_log;

        $update_status = $this->Common_Model->update_operation(
          array(
            'table' => 'user_employee',
            'data' => $attendance_log_enter_data,
            'condition' => "user_employee_id = $user_employee_id"
          )
        );
        $this->upload_any_image("attendance", "attendance_id", $attendance_id, "attendance_login_image", "attendance_login_image", "attendance_login_image_", "attendance_login_image");
        $this->upload_any_image("attendance", "attendance_id", $attendance_id, "attendance_logout_image", "attendance_logout_image", "attendance_logout_image_", "attendance_logout_image");
        $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Record Updated Successfully </div>';
      }

    } else {
      $enter_data['added_on'] = date("Y-m-d H:i:s");
      $enter_data['added_by'] = $this->data['session_uid'];

      $attendance_id = $insertStatus = $this->Common_Model->add_operation(array('table' => 'attendance', 'data' => $enter_data));
      if (!empty($insertStatus)) {
        $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Admin created new Employee attendance record";
        $attendance_log_enter_data["attendance_log"] = $attendance_log;
        $update_status = $this->Common_Model->update_operation(
          array(
            'table' => 'user_employee',
            'data' => $attendance_log_enter_data,
            'condition' => "user_employee_id = $user_employee_id"
          )
        );
        $this->upload_any_image("attendance", "attendance_id", $attendance_id, "attendance_login_image", "attendance_login_image", "attendance_login_image_", "attendance_login_image");
        $this->upload_any_image("attendance", "attendance_id", $attendance_id, "attendance_logout_image", "attendance_logout_image", "attendance_logout_image_", "attendance_logout_image");
        $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" 
        data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> New Record Added Successfully </div>';
      }


    }
    /********1****************** */



    $this->session->set_flashdata('alert_message', $alert_message);

    if (!empty($_POST['redirect_type'])) {
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/shift-timing-edit");
    }

    REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
  }

  function attendance_doUpdateStatus()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    $task = $_POST['task'];
    $id_arr = $_POST['sel_recds'];
    if (empty($user_access)) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    if ($user_access->update_module == 1) {
      $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. 
				  </div>');
      $update_data = array();
      if (!empty($id_arr)) {
        $action_taken = "";
        $ids = implode(',', $id_arr);
        if ($task == "active") {
          $update_data['status'] = 1;
          $action_taken = "Activate";
        }
        if ($task == "block") {
          $update_data['status'] = 0;
          $action_taken = "Blocked";
        }
        $update_data['updated_on'] = date("Y-m-d H:i:s");
        $update_data['updated_by'] = $this->data['session_uid'];
        $response = $this->Common_Model->update_operation(array('table' => "attendance", 'data' => $update_data, 'condition' => "attendance_id in ($ids)"));
        if ($response) {
          $this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Records Successfully ' . $action_taken . ' 
						</div>');
        }
      }
      REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
    } else {
      $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
  }


  function yesterday_late_logins_attendance_list()
  {



    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $login_date = '';
    $logout_date = '';
    $end_date = '';
    $start_date = '';
    $user_employee_custom_id = "";
    $branch_id = 0;
    $user_employee_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $record_status = "";
    $employee_record_status = "";

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];
    if (!empty($_POST['login_date']))
      $login_date = $_POST['login_date'];

    if (!empty($_POST['logout_date']))
      $logout_date = $_POST['logout_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];

    if (!empty($_POST['employee_record_status']))
      $employee_record_status = $_POST['employee_record_status'];

    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['login_date'] = $login_date;
    $this->data['logout_date'] = $logout_date;
    $this->data['start_date'] = $start_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['record_status'] = $record_status;
    $this->data['employee_record_status'] = $employee_record_status;
    $this->data['last_day'] = 1;
    $this->data['attendance_record_status'] = 1;

    // Setting search parameters
    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['login_date'] = $login_date;
    $search['logout_date'] = $logout_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['record_status'] = $record_status;
    $search['employee_record_status'] = $employee_record_status;
    $search['last_day'] = 1;
    $search['attendance_record_status'] = 1;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->Attendance_Model->get_late_logins($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['attendance_data'] = $this->Attendance_Model->get_late_logins($search);
    // $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    // $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    // $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    // $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/yesterday_late_logins_attendance_list', $this->data);
    parent::get_footer();
  }
  function yesterday_early_logouts_attendance_list()
  {





    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $login_date = '';
    $logout_date = '';
    $end_date = '';
    $start_date = '';
    $user_employee_custom_id = "";
    $branch_id = 0;
    $user_employee_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $record_status = "";
    $employee_record_status = "";

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];
    if (!empty($_POST['login_date']))
      $login_date = $_POST['login_date'];

    if (!empty($_POST['logout_date']))
      $logout_date = $_POST['logout_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];

    if (!empty($_POST['employee_record_status']))
      $employee_record_status = $_POST['employee_record_status'];

    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['login_date'] = $login_date;
    $this->data['logout_date'] = $logout_date;
    $this->data['start_date'] = $start_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['record_status'] = $record_status;
    $this->data['employee_record_status'] = $employee_record_status;
    $this->data['last_day'] = 1;
    $this->data['attendance_record_status'] = 1;

    // Setting search parameters
    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['login_date'] = $login_date;
    $search['logout_date'] = $logout_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['record_status'] = $record_status;
    $search['employee_record_status'] = $employee_record_status;
    $search['last_day'] = 1;
    $search['attendance_record_status'] = 1;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->Attendance_Model->get_early_logouts($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['attendance_data'] = $this->Attendance_Model->get_early_logouts($search);
    // $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    // $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    // $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    // $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/yesterday_early_logouts_attendance_list', $this->data);
    parent::get_footer();
  }


  function yesterday_missed_logouts_attendance_list()
  {


    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    // Initializing variables for search and filtering
    $search = array();
    $field_name = '';
    $field_value = '';
    $login_date = '';
    $logout_date = '';
    $end_date = '';
    $start_date = '';
    $user_employee_custom_id = "";
    $branch_id = 0;
    $user_employee_id = 0;
    $department_id = 0;
    $designation_id = 0;
    $record_status = "";
    $employee_record_status = "";

    // Fetching data from request or using default values
    if (!empty($_REQUEST['field_name']))
      $field_name = $_POST['field_name'];
    else if (!empty($field_name))
      $field_name = $field_name;

    if (!empty($_REQUEST['field_value']))
      $field_value = $_POST['field_value'];
    else if (!empty($field_value))
      $field_value = $field_value;

    if (!empty($_POST['end_date']))
      $end_date = $_POST['end_date'];
    if (!empty($_POST['login_date']))
      $login_date = $_POST['login_date'];

    if (!empty($_POST['logout_date']))
      $logout_date = $_POST['logout_date'];

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['user_employee_id']))
      $user_employee_id = $_POST['user_employee_id'];

    if (!empty($_POST['user_employee_custom_id']))
      $user_employee_custom_id = $_POST['user_employee_custom_id'];

    if (!empty($_POST['branch_id']))
      $branch_id = $_POST['branch_id'];

    if (!empty($_POST['designation_id']))
      $designation_id = $_POST['designation_id'];

    if (!empty($_POST['department_id']))
      $department_id = $_POST['department_id'];


    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];

    if (!empty($_POST['employee_record_status']))
      $employee_record_status = $_POST['employee_record_status'];

    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['login_date'] = $login_date;
    $this->data['logout_date'] = $logout_date;
    $this->data['start_date'] = $start_date;
    $this->data['user_employee_id'] = $user_employee_id;
    $this->data['user_employee_custom_id'] = $user_employee_custom_id;
    $this->data['branch_id'] = $branch_id;
    $this->data['department_id'] = $department_id;
    $this->data['designation_id'] = $designation_id;
    $this->data['record_status'] = $record_status;
    $this->data['employee_record_status'] = $employee_record_status;
    $this->data['last_day'] = 1;
    $this->data['attendance_record_status'] = 1;

    // Setting search parameters
    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['login_date'] = $login_date;
    $search['logout_date'] = $logout_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['user_employee_id'] = $user_employee_id;
    $search['user_employee_custom_id'] = $user_employee_custom_id;
    $search['branch_id'] = $branch_id;
    $search['department_id'] = $department_id;
    $search['designation_id'] = $designation_id;
    $search['record_status'] = $record_status;
    $search['employee_record_status'] = $employee_record_status;
    $search['last_day'] = 1;
    $search['attendance_record_status'] = 1;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->Attendance_Model->get_missed_logouts($search);
    $r_count = $this->data['row_count'] = $data_count[0]->counts;

    // Removing 'search_for' parameter for further processing
    unset($search['search_for']);

    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['attendance_data'] = $this->Attendance_Model->get_missed_logouts($search);


    // $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    // $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    // $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    // $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/yesterday_missed_logouts_attendance_list', $this->data);
    parent::get_footer();
  }

  function yesterday_absent_user_employee_list()
  {


    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 205; // Module ID for countries
    // Checking user access for this module
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    // If user doesn't have access, redirect to access denied page
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }







    $search['date_dash_ymd'] = date('Y-m-d', strtotime('-1 day'));

    // Getting total count of countries based on search parameters
    $data_count = $this->Attendance_Model->get_employees_absent_on_date($search);
    $r_count = $this->data['row_count'] = count($data_count);



    // Pagination setup
    $offset = (int) $this->uri->segment(5); // Get page offset

    if ($offset == "") {
      $offset = '0';
    }
    $per_page = _all_pagination_; // Number of records per page

    $this->load->library('pagination');
    $config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
    $config['total_rows'] = $r_count; // Total number of records
    $config['uri_segment'] = '5'; // URI segment for pagination
    $config['per_page'] = $per_page; // Number of records per page
    $config['num_links'] = 4; // Number of links to show
    $config['first_link'] = '&lsaquo; First'; // Text for first link
    $config['last_link'] = 'Last &rsaquo;'; // Text for last link
    $config['prev_link'] = 'Prev'; // Text for previous link
    $config['full_tag_open'] = '<p>'; // Opening tag for pagination
    $config['full_tag_close'] = '</p>'; // Closing tag for pagination
    $config['attributes'] = array('class' => 'paginationClass'); // CSS class for pagination links

    // Initializing pagination with config
    $this->pagination->initialize($config);

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    $search['details'] = 1;


    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting attendance data based on search parameters
    $this->data['user_employee_data'] = $this->Attendance_Model->get_employees_absent_on_date($search);



    // $this->data['user_employee_data_for_dropdown'] = $this->User_Employee_Model->get_user_employee();
    // $this->data['branch_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'branch', 'where' => "branch_id > 0", "order_by" => "branch_name ASC"));
    // $this->data['department_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'department_master', 'where' => "department_id > 0", "order_by" => "department_name ASC"));
    // $this->data['designation_data'] = $this->Common_Model->getData(array('select' => '*', 'from' => 'designation_master', 'where' => "designation_id > 0", "order_by" => "designation_name ASC"));

    // Loading header, left navigation, and view for attendance list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/user_employee/Attendance_Module/yesterday_absent_user_employee_list', $this->data);
    parent::get_footer();
  }




  public function total_time_between_login_and_logout($login_time, $logout_time = "")
  {




    // Create DateTime objects
    $datetime1 = new DateTime($login_time);
    $datetime2 = new DateTime($logout_time);

    // Calculate the difference
    $interval = $datetime2->diff($datetime1);

    // Format the difference
    $hours = $interval->days * 24 + $interval->h;
    $minutes = $interval->i;
    $seconds = $interval->s;

    $formattedDifference = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    return $formattedDifference;
  }
  public function is_time1_greater_than_time2($time1, $time2 = 12)
  {
    // Split the time string into hours, minutes, and seconds
    list($hours, $minutes, $seconds) = explode(':', $time1);

    // Convert the time to total hours
    $total_hours = $hours + ($minutes / 60) + ($seconds / 3600);

    // Check if the total hours are greater than 12
    return $total_hours > $time2;
  }
  public function upload_any_image($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
  {


    $file_name = "";
    if (isset($_FILES[$input_name]['name'])) {
      $timg_name = $_FILES[$input_name]['name'];


      if (!empty($timg_name)) {
        $temp_var = explode(".", strtolower($timg_name));
        $timage_ext = end($temp_var);
        $timage_name_new = $prefix . $id . "." . $timage_ext;
        $image_enter_data[$target_column] = $timage_name_new;
        $imginsertStatus = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $image_enter_data, 'condition' => "$id_column = $id"));
        if ($imginsertStatus == 1) {
          if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
            mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

          }
          move_uploaded_file($_FILES["$input_name"]['tmp_name'], _uploaded_temp_files_ . $target_folder_name . "/" . $timage_name_new);
          $file_name = $timage_name_new;
        }

      }
    }
  }
  function logout()
  {
    $this->unset_only();
    $this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fas fa-check"></i> You Are Successfully Logout.
		</div>');
    $this->session->unset_userdata('sess_psts_uid');
    REDIRECT(MAINSITE_Admin . 'login');
  }



  public function index1()
  {
    $this->load->view('welcome_message');
  }

  function mypdf()
  {


    $this->load->library('pdf');


    $this->pdf->load_view('mypdf');
    $this->pdf->render();


    $this->pdf->stream("welcome.pdf");
  }






}



