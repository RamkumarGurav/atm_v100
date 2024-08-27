<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// $this->load->database();

		//libraries
		$this->load->library('session');
		$this->load->library('form_validation');

		//helpers
		$this->load->helper('url');
		$this->load->helper('form');

		//models
		$this->load->model('Common_Model');
		$this->load->model('administrator/Login_model');

		// storing data from session in data
		$this->data['session_uid'] = $this->session->userdata('sess_psts_uid');
		$this->data['session_name'] = $this->session->userdata('sess_psts_name');
		$this->data['session_email'] = $this->session->userdata('sess_psts_email');

		//initilizing message and alert_message data
		$this->data['message'] = '';
		$this->data['alert_message'] = '';

		$this->data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);



	}


	/**
	 * The method checks if the user is already logged in based on session data and redirects to "controllers/secureRegions/ Wam.php"'s index() method which loads the dashboard, if they are.If the login form is submitted with valid credentials it runs "doSignInUser()" from "admininistrator/Login_model.php" and sets appropriate session data and messages based on the response.If the user is successfully logged in, they are redirected to the admin page.if validation fails or the login attempt fails, it sets the appropriate error messages.Finally, it loads the login view, passing along any alert messages to be displayed
	 */
	function index()
	{
		// Check if the session variables for user ID, name, and email are set
		if (!empty($this->data['session_uid']) && !empty($this->data['session_name']) && !empty($this->data['session_email'])) {
			// If session variables are set, redirect to the main site admin 'wam' page
			REDIRECT(MAINSITE_Admin . "wam");
		}

		// Check if the login form has been submitted
		if (isset($_POST['login_btn'])) {
			// Set validation rules for the username and password fields
			$this->form_validation->set_rules('username', "Username", 'required');
			$this->form_validation->set_rules('password', "Password", 'required');

			// Set custom error delimiters for form validation errors
			$this->form_validation->set_error_delimiters(
				'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
				aria-hidden="true">×</button><i class="icon fas fa-ban"></i>',
				'</div>'
			);

			// Run form validation
			if ($this->form_validation->run() == true) {
				// Set alert message with validation errors or session flash message
				$this->data['alert_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				// Attempt to sign in the user using the Login_model
				$response = $this->Login_model->doSignInUser();

				// Check if the sign-in was successful
				if ($response) {
					// Check if the user status is active (1)
					if ($response->status == 1) {
						// Set a success message in the session flash data
						$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
											<div type="button" class="close" data-dismiss="alert" aria-hidden="true">×</div>
											<i class="icon fas fa-check"></i> You Are Login Successfully 
											</div>');

						// Set user session data
						$this->session->set_userdata('sess_psts_uid', $response->admin_user_id);
						$this->session->set_userdata('sess_psts_name', $response->name);
						$this->session->set_userdata('sess_psts_email', $response->email);
						$this->session->set_userdata('sess_company_profile_id', $response->roles[0]->company_profile_id);

						// Load the fiscalYear library and set the fiscal year
						$this->load->library('fiscalYear');
						$fy = new fiscalYear();
						$result = $fy->setFiscalYear();
						$this->session->set_userdata('sess_fiscal_year_id', $result->fiscal_year_id);


						// Redirect to the main site admin 'wam' page
						REDIRECT(MAINSITE_Admin . "wam");
					} else {
						// If the user is blocked, set an error message in the session flash data
						$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
											<div type="button" class="close" data-dismiss="alert" aria-hidden="true">×</div>
											<i class="icon fas fa-ban"></i> You are blocked by Management.
											</div>');
					}
				} else if (!$response) {
					// If the sign-in failed due to incorrect credentials, set an error message in the session flash data
					$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
									<div type="button" class="close" data-dismiss="alert" aria-hidden="true">×</div>
									<i class="icon fas fa-ban"></i> Wrong Email/Username Or Password
									</div>');
				} else {
					// If the sign-in failed due to some other reason, set a generic error message in the session flash data
					$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
									<div type="button" class="close" data-dismiss="alert" aria-hidden="true">×</div>
									<i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. 
									</div>');
				}
			} else {
				// If form validation fails, set the alert message with validation errors or session flash message
				$this->data['alert_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('alert_message');
			}
		}

		// Retrieve any alert message stored in the session flash data loaded in the logout method of "secureRegions/Wam.php"
		$temp_alert_message = $this->session->flashdata('alert_message');
		if (!empty($temp_alert_message)) {
			$this->data['alert_message'] = $temp_alert_message;
		}

		// Load the login view and pass the data to it
		$this->load->view('admin/login', $this->data);
	}

	public function index1()
	{
		$this->load->view('welcome_message');
	}

	public function forgot_password()
	{
		$this->load->view('admin/forgot_password', $this->data);
	}


	function getRandomString($length)
	{
		$validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
		$validCharNumber = strlen($validCharacters);
		$result = "";

		for ($i = 0; $i < $length; $i++) {
			$index = mt_rand(0, $validCharNumber - 1);
			$result .= $validCharacters[$index];
		}
		return $result;
	}
	public function save_new_password()
	{
		$user_id = $_POST['user_id'];
		$token = $_POST['token'];
		$mp_data['show_password'] = $_POST['password'];
		$mp_data['password'] = md5($_POST['password']);

		$this->Common_Model->update_operation(array('table' => 'admin_user', 'data' => $mp_data, 'condition' => "admin_user_id = $user_id"));
		$this->Common_Model->update_operation(array('table' => 'th_admin_resetpwd_token', 'data' => array('used' => 1), 'condition' => "token = '$token'"));
		echo json_encode(array('status' => 1, 'message' => "Your password is changed successfully&nbsp;<a href='" . MAINSITE_Admin . "' style='color:blue;'>Click Here To Login</a>"));
		die;
	}
	public function reset_password()
	{


		$username = $_POST['username'];


		$this->db
			->select('u.*')
			->from('admin_user as u ')
			->where("(email = '$username' or username = '$username')")
			->limit(1);
		$result = $this->db->get();

		//echo $this->db->last_query(); exit;
		if ($result->num_rows() > 0) {
			$result = $result->result();
			$result = $result[0];
			$status = true;
			$token = $this->getRandomString(12);
			$email = $result->email;
			$resetpwd_data['token'] = $token;
			$resetpwd_data['email'] = $email;
			$resetpwd_data['user_fk'] = $result->admin_user_id;
			$resetpwd_data['used'] = 0;
			$this->Common_Model->add_operation(array('table' => 'th_admin_resetpwd_token', 'data' => $resetpwd_data));

			//send Email
			$head_title = 'BSNL, POSTAL & IT EMPLOYEES HBCS Ltd';
			$mail_message = "<strong>User Forgot Password on ATM.";
			$mailMessage = file_get_contents(APPPATH . 'mailer/reset_password_admin_side.html');
			$mailMessage = str_replace("#head_title#", stripslashes($head_title), $mailMessage);
			$mailMessage = str_replace("#token#", stripslashes($token), $mailMessage);
			$mailMessage = str_replace("#uri#", MAINSITE_Admin, $mailMessage);

			$subject = "User Forgot Password on ATM";
			//	$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>strtolower($b_email) , "name"=>$name ));
			//	$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>__adminemail__ , "name"=>"BSNL" ));
			$mailStatus = $this->Common_Model->send_mail_api(array("template" => $mailMessage, "subject" => $subject, "to" => "$email", "name" => "BSNL"));
			//$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"anil@marswebsolutions.com" , "name"=>"Login Reset" ));
			//$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"viswa69@gmail.com" , "name"=>"Booking" ));
			//	$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"anilkumarbora14310@gmail.com" , "name"=>"Login Reset" ));
			$message = 'We have sent the password reset link to your email id ' . $email;
		} else {
			$status = false;
			$message = 'Email Id doesnot exist';
		}
		echo json_encode(array('status' => $status, 'message' => $message));
		die;
	}
	public function admin_reset_password($token)
	{
		$this->data['th_user_resetpwd_details'] = $th_user_resetpwd_details = $this->Common_Model->getData_bsnl(array('select' => '*', 'from' => 'th_admin_resetpwd_token', 'where' => "token = '" . $token . "'"));
		$user_id = $th_user_resetpwd_details[0]->user_fk;
		$used = $th_user_resetpwd_details[0]->used;

		if ($used) {
			$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-bs-dismissible">

			<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>

			<i class="icon fas fa-ban"></i> Link Used.Please Reset Again.

			</div>');

			$temp_alert_message = $this->session->flashdata('alert_message');

			if (!empty($temp_alert_message)) {

				$this->data['alert_message'] = $temp_alert_message;

			}
			//REDIRECT('secureRegions/');
			$this->load->view('admin/login', $this->data);
			//die;
		} else {
			$this->data['token'] = $token;
			$this->data['user_details'] = $user_details = $this->Common_Model->getData(array('select' => '*', 'from' => 'admin_user', 'where' => "admin_user_id = '" . $user_id . "'"));

			$this->load->view('admin/reset_password', $this->data);
			$this->data['token'] = $token;
		}

	}

}
