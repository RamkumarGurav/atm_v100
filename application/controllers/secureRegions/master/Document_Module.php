<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "controllers/secureRegions/Main.php");
class Document_Module extends Main
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');


    $this->load->model('Common_Model');
    $this->load->model('administrator/Admin_Common_Model');
    $this->load->model('administrator/Admin_model');
    $this->load->model('administrator/master/Document_Model');


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
    $this->load->view('admin/master/Document_Module/list', $this->data);
    parent::get_footer();
  }

  /**
   * Displays the list of countries in the admin panel.
   */
  function document_list()
  {
    // Setting data for the view
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 207; // Module ID for countries
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
    $end_date = '';
    $start_date = '';
    $record_status = "";

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

    if (!empty($_POST['start_date']))
      $start_date = $_POST['start_date'];

    if (!empty($_POST['record_status']))
      $record_status = $_POST['record_status'];

    // Assigning fetched values to data variables
    $this->data['field_name'] = $field_name;
    $this->data['field_value'] = $field_value;
    $this->data['end_date'] = $end_date;
    $this->data['start_date'] = $start_date;
    $this->data['record_status'] = $record_status;

    // Setting search parameters
    $search['end_date'] = $end_date;
    $search['start_date'] = $start_date;
    $search['field_value'] = $field_value;
    $search['field_name'] = $field_name;
    $search['record_status'] = $record_status;
    $search['search_for'] = "count";

    // Getting total count of countries based on search parameters
    $data_count = $this->Document_Model->get_document($search);
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
    $this->data['page_is_master'] = $this->data['user_access']->is_master;
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

    // Setting limit and offset for data retrieval
    $search['limit'] = $per_page;
    $search['offset'] = $offset;

    // Getting document data based on search parameters
    $this->data['document_data'] = $this->Document_Model->get_document($search);

    // Loading header, left navigation, and view for document list
    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/master/Document_Module/document_list', $this->data);
    parent::get_footer();
  }

  function document_list_export()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 207;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
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

    $this->data['document_data'] = $this->Document_Model->get_document($search);


    $this->load->view('admin/master/Document_Module/document_list_export', $this->data);
  }

  function document_view($document_id = "")
  {

    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 207;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($document_id)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }


    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


    $this->data['document_data'] = $this->Document_Model->get_document(array("document_id" => $document_id));
    if (empty($document_id)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }

    $this->data['document_data'] = $this->data['document_data'][0];

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/master/Document_Module/document_view', $this->data);
    parent::get_footer();
  }

  function document_edit($document_id = "")
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 207;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));
    //print_r($this->data['user_access']);
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }
    if (empty($document_id)) {
      if ($user_access->add_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }
    if (!empty($document_id)) {
      if ($user_access->update_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }

    // Assigning additional data for the view
    $this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
    $this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;



    if (!empty($document_id)) {
      $this->data['document_data'] = $this->Document_Model->get_document(array("document_id" => $document_id));
      if (empty($this->data['document_data'])) {
        $this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Record Not Found. 
				  </div>');
        REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
      }
      $this->data['document_data'] = $this->data['document_data'][0];
    }

    parent::get_header();
    parent::get_left_nav();
    $this->load->view('admin/master/Document_Module/document_edit', $this->data);
    parent::get_footer();
  }

  function documentDoEdit()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 207;
    $user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

    if (empty($_POST['document_name'])) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
      exit;
    }
    $document_id = $_POST['document_id'];
    if (empty($this->data['user_access'])) {
      REDIRECT(MAINSITE_Admin . "wam/access-denied");
    }

    if (empty($document_id)) {
      if ($user_access->add_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }

    if (!empty($document_id)) {
      if ($user_access->update_module != 1) {
        $this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->module_name);
        REDIRECT(MAINSITE_Admin . "wam/access-denied");
      }
    }
    $document_name = trim($_POST['document_name']);
    $status = $_POST['status'];
    $is_exist = $this->Common_Model->getData(array('select' => '*', 'from' => 'document', 'where' => "document_name = '$document_name' and document_id != $document_id"));
    //	echo $this->db->last_query();
    //	print_r($is_exist);
    if (!empty($is_exist)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Document already exist in database.</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      //echo $this->session->flashdata('alert_message' );
      //echo "anubhav";
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/document-edit/" . $document_id);
      exit;
    }

    $enter_data['document_name'] = $document_name;
    $enter_data['status'] = $_POST['status'];

    $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. </div>';
    if (!empty($document_id)) {
      $enter_data['updated_on'] = date("Y-m-d H:i:s");
      $enter_data['updated_by'] = $this->data['session_uid'];
      $insertStatus = $this->Common_Model->update_operation(array('table' => 'document', 'data' => $enter_data, 'condition' => "document_id = $document_id"));
      if (!empty($insertStatus)) {
        $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Record Updated Successfully </div>';
      }

    } else {
      $enter_data['added_on'] = date("Y-m-d H:i:s");
      $enter_data['added_by'] = $this->data['session_uid'];
      $insertStatus = $this->Common_Model->add_operation(array('table' => 'document', 'data' => $enter_data));
      if (!empty($insertStatus)) {
        $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> New Record Added Successfully </div>';
      }


    }
    $this->session->set_flashdata('alert_message', $alert_message);

    if (!empty($_POST['redirect_type'])) {
      REDIRECT(MAINSITE_Admin . $user_access->class_name . "/document-edit");
    }

    REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
  }

  function document_doUpdateStatus()
  {
    $this->data['page_type'] = "list";
    $this->data['page_module_id'] = 207;
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
        $response = $this->Common_Model->update_operation(array('table' => "document", 'data' => $update_data, 'condition' => "document_id in ($ids)"));
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
