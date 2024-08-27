<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');


include_once ('Main.php');
class User extends Main
{

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Kolkata");
    //models
    $this->load->library('session');
    $this->load->model('Common_Model');
    $this->load->model('User_Model');


    //headers
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");

  }


  // HELPERS   
  public function total_time_between_login_and_now($login_time)
  {
    $today_time = date("Y-m-d H:i:s");

    // Create DateTime objects
    $datetime1 = new DateTime($login_time);
    $datetime2 = new DateTime($today_time);

    // Calculate the difference
    $interval = $datetime2->diff($datetime1);

    // Format the difference
    $hours = $interval->days * 24 + $interval->h;
    $minutes = $interval->i;
    $seconds = $interval->s;

    $formattedDifference = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    return $formattedDifference;
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


  public function is_time1_and_time2_same($datetime1, $datetime2 = "")
  {
    // Create DateTime objects from the given datetime strings
    $date1 = new DateTime($datetime1);
    $date2 = new DateTime($datetime2);

    // Format the dates to 'Y-m-d'
    $date1_formatted = $date1->format('Y-m-d');
    $date2_formatted = $date2->format('Y-m-d');

    // Compare the formatted dates
    if ($date1_formatted === $date2_formatted) {
      return $date1_formatted;
    } else {
      0;
    }
  }

  public function is_time1_and_now_same($datetime1)
  {

    // Create DateTime objects from the given datetime strings
    $date1 = new DateTime($datetime1);
    $date2 = new DateTime();

    // Format the dates to 'Y-m-d'
    $date1_formatted = $date1->format('Y-m-d');
    $date2_formatted = $date2->format('Y-m-d');

    // Compare the formatted dates
    if ($date1_formatted === $date2_formatted) {
      return $date1_formatted;
    } else {
      0;
    }
  }


  public function access_denied()
  {

    $this->data['meta_title'] = "Access Denied";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";



    parent::getHeader('header', $this->data);
    $this->load->view('access_denied', $this->data);
    parent::getFooter('footer', $this->data);


  }
  //  HELPERS ////////

  public function index()
  {


    $this->data['meta_title'] = _project_name_;
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";



    /*** checking ip address {*/
    // $ip_address = $this->Common_Model->get_client_ip();

    // $ip_address_exist = $this->User_Model->get_ip_address_data([
    //   "ip_address" => $ip_address,
    //   "details" => 1
    // ]);



    // if (empty($ip_address_exist)) {
    if (empty(true)) {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
          class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
          Sorry this service is unavailable in your computer.</div>';
      $this->session->set_flashdata('login_alert_message', $alert_message);
      REDIRECT(MAINSITE . "access-denied");
      exit;
    } else {

      if (!empty($_POST["user_employee_custom_id"])) {
        $user_employee_custom_id = trim($_POST["user_employee_custom_id"]);


        /*** checking valid user_employee {*/
        $this->data['user_employee_data'] = $this->User_Model->get_user_employee_data_any([
          "user_employee_custom_id" => $user_employee_custom_id,
          "details" => 1
        ]);



        if (empty($this->data['user_employee_data'])) {

          $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
			class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
			Invalid Employee ID.</div>';
          $this->session->set_flashdata('alert_message', $alert_message);
          REDIRECT(MAINSITE);
          exit;
        } else {

          $this->data['user_employee_data'] = $this->data['user_employee_data'][0];
          $user_employee_id = $this->data['user_employee_data']->user_employee_id;
          $this->session->set_userdata('user_employee_id', $user_employee_id);
          REDIRECT(MAINSITE . "employee-attendance");
          exit;
          // REDIRECT(MAINSITE . "employee-login-success");
        }


        /*** checking valid user_employee } */

      } else {

        $today = date('m-d'); // Assuming birth_date is stored as MM-DD format

        $this->data['user_employee_with_birthday'] = $this->User_Model->get_user_employee_data([
          "find_birthday_by_today" => $today,
          "details" => 1
        ]);



        parent::getHeader('header', $this->data);
        $this->load->view('home', $this->data);
        parent::getFooter('footer', $this->data);

      }


    }



  }





  public function employee_attendance()
  {

    $this->data['meta_title'] = "Employee Attendance";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";

    // $employee_status = "blocked";
    // $employee_login_status = "blocked";
    $employee_status = "";
    $employee_login_status = "";

    $last_screen = $this->Common_Model->checkScreen();



    /*** checking ip address {*/
    $ip_address = $this->Common_Model->get_client_ip();

    $ip_address_exist = $this->User_Model->get_ip_address_data([
      "ip_address" => $ip_address,
      "record_status" => 1,
      "details" => 1
    ]);



    //IF THERE IS VALID IP ADDRESS
    // if (empty($ip_address_exist)) {
    if (empty(true)) {

      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
			class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
			Sorry this service is unavailable in your computer</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      // REDIRECT(MAINSITE . "access-denied");
      REDIRECT(MAINSITE);
      // exit;
    } else {
      $user_employee_id = $this->session->userdata('user_employee_id');
      //IF THERE IS VALID EMPLOYEE
      if (!empty($user_employee_id)) {
        /*** checking valid user_employee <*/
        $this->data['user_employee_data'] = $this->User_Model->get_user_employee_data_any([
          "user_employee_id" => $user_employee_id,
          "details" => 1
        ]);


        //IF THERE IS EMPLOYEE IN DB
        if (empty($this->data['user_employee_data'])) {
          $employee_status = "not_found";
          $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
		                            class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
		                             Employee with this ID Not Found.Please contact the office </div>';
          $this->session->set_flashdata('alert_message', $alert_message);
          REDIRECT(MAINSITE);
          exit;
        } else {

          $this->data['user_employee_data'] = $this->data['user_employee_data'][0];
          $status = $this->data['user_employee_data']->status;


          //IF THERE IS ACTIVE EMPLOYEE IN DB
          if ($status == 1) {


            $employee_status = "active";

            $this->data['attendance_data'] = $this->User_Model->get_attendance_data_any([
              "user_employee_id" => $user_employee_id,
              "get_recent_attendance_of_employee" => 1,
              // "get_today_logout_attendance" => 1,
              "record_status" => 1,
              "details" => 1
            ]);



            // echo "<pre> <br>";
            // print_r($this->data['attendance_data']);
            // exit;


            if (!empty($this->data['attendance_data'])) {
              $attendance_data = $this->data['attendance_data'][0];


              //HERE employee is trying to logout
              //if the employee is already logged_in and not yet logged_out then
              if (!empty($attendance_data->login_time) && empty(($attendance_data->logout_time))) {

                $total_hours_from_login = $this->total_time_between_login_and_now($attendance_data->login_time);
                $is_time1_greater_than_time2 = $this->is_time1_greater_than_time2($total_hours_from_login, 12);


                //if the employee is forgot to logout before 12hours and try to logout now then block him ELSE allow him to login
                if (!empty($is_time1_greater_than_time2)) {
                  $enter_data["status"] = 2;
                  $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Employee ID is blocked because employee tryied to late logout";
                  $enter_data["attendance_log"] = $attendance_log;
                  $update_status = $this->Common_Model->update_operation(array('table' => 'user_employee', 'data' => $enter_data, 'condition' => "user_employee_id = $user_employee_id"));
                  $employee_status = "blocked";
                  $employee_login_status = "blocked";
                  $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
                  class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
           Emloyee ID is blocked because you are trying  Late logout so ,please contact admin  </div>';
                  $this->session->set_flashdata('alert_message', $alert_message);
                } else {
                  //this is a normal logout
                  $this->session->set_userdata("attendance_id", $attendance_data->attendance_id);
                  $employee_login_status = "allowed_for_logout";

                }

                //when employee is already logged_in and logged_out then
              } elseif (!empty($attendance_data->login_time) && !empty(($attendance_data->logout_time))) {

                //if the last logout date falls in  same as today 
                $is_time1_and_time2_same = $this->is_time1_and_time2_same($attendance_data->logout_time);

                if (!empty($is_time1_and_time2_same)) {
                  // $alert_message = '<div class="alert alert-info alert-dismissible"><button type="button" 
                  //   class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-info"></i>
                  // Multiple Attendance in same day?? </div>';
                  // $this->session->set_flashdata('alert_message', $alert_message);

                  //Here if you want to restrict the multiple attendances in single day then change belelow status to "blocked"
                  // $employee_login_status = "allowed_for_login";
                  $employee_login_status = "blocked";
                  $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
                  class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
              Sorry , No multiple attendances are allowed in the same day! </div>';
                  $this->session->set_flashdata('alert_message', $alert_message);
                  $this->session->sess_destroy();
                  $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Employee trying to make another attendance login in same day";
                  $enter_data["attendance_log"] = $attendance_log;
                  $update_status = $this->Common_Model->update_operation(array('table' => 'user_employee', 'data' => $enter_data, 'condition' => "user_employee_id = $user_employee_id"));

                } else {
                  //noraml login in when last logout doesn't fall in today
                  $employee_login_status = "allowed_for_login";
                }


                //if in any case if the employee is somehow logged_in but his logged_in time is not regestered in the database ,but his logout 
                //time is there or if the a recored is created for attendance but don't have login and logout time then also block the employee
              } else {
                //if there is attendace record with empty login and logut times or only has logout_time then block the employee
                $employee_status = "blocked";
                $employee_login_status = "blocked";

                $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
                class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
            Employee ID is blocked.  Your last attendance was not successful ,please contact the office  </div>';
                $this->session->set_flashdata('alert_message', $alert_message);

                $enter_data["status"] = 2;
                $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Employee ID is blocked becuase employee tried to make new attendance login or logout with last unsuccessfull attendance";
                $enter_data["attendance_log"] = $attendance_log;
                $update_status = $this->Common_Model->update_operation(array('table' => 'user_employee', 'data' => $enter_data, 'condition' => "user_employee_id = $user_employee_id"));
              }

            } else {
              //allow first login of fresh employee
              $employee_login_status = "allowed_for_login";

            }




          } else {


            $employee_status = "blocked";
            $this->data['employee_status'] = $employee_status;
            $employee_login_status = "blocked";
            $this->data['employee_login_status'] = $employee_login_status;

            $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
                                          class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
                                        Employee with this ID is Blocked.Please contact the office1 </div>';
            $this->session->set_flashdata('alert_message', $alert_message);
            $this->session->sess_destroy();

          }

          $this->data['employee_status'] = $employee_status;
          $this->data['employee_login_status'] = $employee_login_status;


          parent::getHeader('header', $this->data);
          $this->load->view('employee_attendance', $this->data);
          parent::getFooter('footer', $this->data);


        }

      } else {

        $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
        class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
      Session Out, Try again! </div>';
        $this->session->set_flashdata('alert_message', $alert_message);
        REDIRECT(MAINSITE);
        exit;
      }

    }

  }


  public function ajax_user_employee_do_login()
  {





    if (!empty($_POST['task']) && !empty($_POST['capturedImage']) && $_POST['task'] == "user_employee_login") {

      /*** checking ip address {*/
      $ip_address = $this->Common_Model->get_client_ip();
      $ip_address_exist = $this->User_Model->get_ip_address_data([
        "ip_address" => $ip_address,
        "details" => 1
      ]);



      //IF THERE IS VALID IP ADDRESS
      // if (empty($ip_address_exist)) {
      if (empty(true)) {

        $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
       class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
       Sorry this service is unavailable in your computer.' . $ip_address . '</div>';
        $this->session->set_flashdata('alert_message', $alert_message);
        REDIRECT(MAINSITE . "access-denied");
        exit;
      } else {

        $user_employee_id = $this->session->userdata('user_employee_id');

        $this->data['user_employee_data'] = $this->User_Model->get_user_employee_data_any([
          "user_employee_id" => $user_employee_id,
          "record_status" => 1,
          "details" => 1
        ]);


        //IF THERE IS EMPLOYEE IN DB
        if (empty($this->data['user_employee_data'])) {
          $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
                              class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
                               Something Went Wrong.try again</div>';
          $this->session->set_flashdata('alert_message', $alert_message);
          REDIRECT(MAINSITE);
          exit;
        } else {
          $user_employee_data = $this->data['user_employee_data'][0];
          if ($user_employee_id >= 1) {

            $enter_data["user_employee_id"] = $user_employee_id;
            $enter_data["login_time"] = date("Y-m-d H:i:s");
            $enter_data["status"] = 1;

            $attendance_id = $insertStatus = $this->Common_Model->add_operation(array('table' => 'attendance', 'data' => $enter_data));

            if ($attendance_id >= 1) {
              $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Employee logged in";
              $attendance_log_enter_data["attendance_log"] = $attendance_log;
              $update_status = $this->Common_Model->update_operation(array('table' => 'user_employee', 'data' => $attendance_log_enter_data, 'condition' => "user_employee_id = $user_employee_id"));
              $this->upload_webcam_image("attendance", "attendance_id", $attendance_id, "capturedImage", "attendance_login_image", "attendance_login_image_", "attendance_login_image");
              $this->session->set_userdata('attendance_id', $attendance_id);
            } else {
              $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
            class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
          Failed to login try again.</div>';
              $this->session->set_flashdata('alert_message', $alert_message);
              REDIRECT(MAINSITE);
            }
            $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" 
            class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>
         Login Successful!.</div>';
            $this->session->set_flashdata('alert_message', $alert_message);
            REDIRECT(MAINSITE . "employee-login-success");
          } else {
            $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
          class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
        Login Failed Try again</div>';
            $this->session->set_flashdata('alert_message', $alert_message);
            REDIRECT(MAINSITE);
          }
        }




      }

    } else {
      REDIRECT(MAINSITE);
    }



  }


  public function user_employee_login_success()
  {

    $this->data['meta_title'] = "Employee Login Success";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";

    $attendance_id = $this->session->userdata('attendance_id');
    $user_employee_id = $this->session->userdata('user_employee_id');


    if (!empty($attendance_id)) {

      $this->data['attendance_data'] = $this->User_Model->get_attendance_data_any([
        "attendance_id" => $attendance_id,
        "details" => 1
      ]);

      if (!empty($this->data['attendance_data'])) {
        $this->data['attendance_data'] = $this->data['attendance_data'][0];
        $this->data['user_employee_data'] = $this->User_Model->get_user_employee_data_any([
          "user_employee_id" => $user_employee_id,
          "details" => 1
        ])[0];

        $this->session->sess_destroy();



        parent::getHeader('header', $this->data);
        $this->load->view('user_employee_login_success', $this->data);
        parent::getFooter('footer', $this->data);
      } else {
        $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
        class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
       Attendance Data not found ,Please contact the office' . '</div>';
        $this->session->set_flashdata('alert_message', $alert_message);
        REDIRECT(MAINSITE);
        exit;
      }



    } else {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
        class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
     Session Out, Try again!' . '</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE);
      exit;
    }


  }


  public function ajax_user_employee_do_logout()
  {



    if (!empty($_POST['task']) && !empty($_POST['capturedImage']) && $_POST['task'] == "user_employee_logout") {



      /*** checking ip address {*/
      $ip_address = $this->Common_Model->get_client_ip();
      $ip_address_exist = $this->User_Model->get_ip_address_data([
        "ip_address" => $ip_address,
        "details" => 1
      ]);



      //IF THERE IS VALID IP ADDRESS
      // if (empty($ip_address_exist)) {
      if (empty(true)) {

        $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
       class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
       Sorry this service is unavailable in your computer.' . $ip_address . '</div>';
        $this->session->set_flashdata('alert_message', $alert_message);
        REDIRECT(MAINSITE . "access-denied");
        exit;
      } else {
        $user_employee_id = $this->session->userdata('user_employee_id');
        $attendance_id = $this->session->userdata('attendance_id');

        $this->data['attendance_data'] = $this->User_Model->get_attendance_data_any([
          "attendance_id" => $attendance_id,
          "record_status" => 1,
          "details" => 1
        ]);


        //IF THERE IS EMPLOYEE IN DB
        if (empty($this->data['attendance_data'])) {
          $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
                              class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
                               Something Went Wrong.Please contact the office </div>';
          $this->session->set_flashdata('alert_message', $alert_message);
          REDIRECT(MAINSITE);
          exit;
        } else {
          $attendance_data = $this->data['attendance_data'][0];

          if ($attendance_id >= 1) {
            $enter_data["logout_time"] = date("Y-m-d H:i:s");
            $enter_data["total_time"] = $this->total_time_between_login_and_logout($attendance_data->login_time, $enter_data["logout_time"]);


            $insertStatus = $this->Common_Model->update_operation(array('table' => 'attendance', 'data' => $enter_data, 'condition' => "attendance_id = $attendance_id"));
            if (!empty($insertStatus)) {
              $attendance_log = "On " . date("d-F-Y \a\\t h:i A") . " Employee logged out";
              $attendance_log_enter_data["attendance_log"] = $attendance_log;
              $update_status = $this->Common_Model->update_operation(array('table' => 'user_employee', 'data' => $attendance_log_enter_data, 'condition' => "user_employee_id = $user_employee_id"));
              $this->upload_webcam_image("attendance", "attendance_id", $attendance_id, "capturedImage", "attendance_logout_image", "attendance_logout_image_", "attendance_logout_image");
            } else {
              $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
            class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
          Failed to logout try again.</div>';
              $this->session->set_flashdata('alert_message', $alert_message);
              REDIRECT(MAINSITE);
            }
            $alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" 
            class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>
         Logout Successful!.</div>';
            $this->session->set_flashdata('alert_message', $alert_message);
            REDIRECT(MAINSITE . "employee-logout-success");
          } else {
            $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
          class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
        Failed to logout try again.</div>';
            $this->session->set_flashdata('alert_message', $alert_message);
            REDIRECT(MAINSITE);
          }

        }




      }

    } else {
      REDIRECT(MAINSITE);
    }


  }


  public function user_employee_logout_success()
  {

    $this->data['meta_title'] = "Employee Logout Success";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";

    $attendance_id = $this->session->userdata('attendance_id');
    $user_employee_id = $this->session->userdata('user_employee_id');


    if (!empty($attendance_id)) {

      $this->data['attendance_data'] = $this->User_Model->get_attendance_data_any([
        "attendance_id" => $attendance_id,
        "details" => 1
      ]);

      if (!empty($this->data['attendance_data'])) {
        $this->data['attendance_data'] = $this->data['attendance_data'][0];
        $this->data['user_employee_data'] = $this->User_Model->get_user_employee_data_any([
          "user_employee_id" => $user_employee_id,
          "details" => 1
        ])[0];

        $this->session->sess_destroy();



        parent::getHeader('header', $this->data);
        $this->load->view('user_employee_logout_success', $this->data);
        parent::getFooter('footer', $this->data);
      } else {
        $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
        class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
       Attendance Data not found ,Please contact the admin' . '</div>';
        $this->session->set_flashdata('alert_message', $alert_message);
        REDIRECT(MAINSITE);
        exit;
      }



    } else {
      $alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
        class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban" style="font-size:14px;"></i>
     Session Out, Try again!' . '</div>';
      $this->session->set_flashdata('alert_message', $alert_message);
      REDIRECT(MAINSITE);
      exit;
    }



  }



  public function test_home()
  {
    $this->data['meta_title'] = "Employee Attendance";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";
    parent::getHeader('header', $this->data);
    $this->load->view('test_home', $this->data);
    parent::getFooter('footer', $this->data);
  }
  public function test_employee_attendance()
  {
    $this->data['meta_title'] = "Employee Attendance";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";
    parent::getHeader('header', $this->data);
    $this->load->view('test_employee_attendance', $this->data);
    parent::getFooter('footer', $this->data);
  }
  public function test_login_success()
  {
    $this->data['meta_title'] = "Employee Attendance";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";
    parent::getHeader('header', $this->data);
    $this->load->view('test_login_success', $this->data);
    parent::getFooter('footer', $this->data);
  }
  public function test_logout_success()
  {
    $this->data['meta_title'] = "Employee Attendance";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";
    parent::getHeader('header', $this->data);
    $this->load->view('test_logout_success', $this->data);
    parent::getFooter('footer', $this->data);
  }

  public function test_access_denied()
  {
    $this->data['meta_title'] = "Employee Attendance";
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";
    parent::getHeader('header', $this->data);
    $this->load->view('test_access_denied', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function upload_webcam_image($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
  {



    if (!empty($_POST[$input_name])) {
      $image_path = $_POST[$input_name];

      list($type, $data) = explode(';', $image_path);
      list(, $data) = explode(',', $data);
      $imageData = base64_decode($data);

      if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
        mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

      }
      $image_name = $prefix . "_" . $id . ".png";
      file_put_contents(_uploaded_temp_files_ . $target_folder_name . "/" . $image_name, $imageData);
      $image_enter_data[$target_column] = $image_name;
      $imginsertStatus = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $image_enter_data, 'condition' => "$id_column = $id"));

    }

  }
  public function upload_webcam_image2($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
  {



    // if (!empty($_POST['ref_img_link'])) {
    //   $image_path = $_POST['ref_img_link'];
    if (!empty($_POST[$input_name])) {
      $image_path = $_POST[$input_name];
      $result = $this->file_get_contents_curl($image_path);
      if ($result['status'] != 'OK') {
        //echo "Error : $result[status]<br>Product Code : $product_code<br>image : $image";
        //return false;
      } else {
        $image_arr = explode('/', $image_path);
        $image_name = end($image_arr);
        file_put_contents(_uploaded_temp_files_ . $target_folder_name . "/" . $prefix . "_" . $id . "_" . $image_name, $result['data']);
        if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
          mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

        }
        $image_enter_data[$target_column] = $image_name;
        $imginsertStatus = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $image_enter_data, 'condition' => "$id_column = $id"));
      }

    }

  }


  public function upload_webcam_image1($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
  {



    if (!empty($_POST[$input_name])) {
      $image_path = $_POST[$input_name];
      $image_arr = explode('/', $image_path);
      $image_name = end($image_arr);
      $base64String = explode(',', $image_path)[1];
      $imageData = base64_decode($base64String);
      if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
        mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

      }
      file_put_contents(_uploaded_temp_files_ . $target_folder_name . "/" . $prefix . "_" . $id . "_" . $image_name, $imageData);
      $image_enter_data[$target_column] = $image_name;
      $imginsertStatus = $this->Common_Model->update_operation(array('table' => $table_name, 'data' => $image_enter_data, 'condition' => "$id_column = $id"));

    }

  }
  function upload_image($tbl_name, $col_name, $col_value, $post_file, $path)
  {
    $img_name = "";
    if (isset($_FILES[$post_file]['name']) && !empty($_FILES[$post_file]['name']) && !empty($_FILES[$post_file]['tmp_name'])) {
      $what = getimagesize($_FILES[$post_file]['tmp_name']);
      if ($what['mime'] == 'image/png' || $what['mime'] == 'image/jpeg') {
        $timg_name = $_FILES[$post_file]['name'];
        if (!empty($timg_name)) {
          $temp_var = explode(".", strtolower($timg_name));
          $timage_ext = end($temp_var);
          $main_img = $this->Common_Model->n_digit_random(5) . '-' . $col_value . "." . $timage_ext;
          $image_enter_data[$post_file] = $main_img;
          $imginsertStatus = $this->Common_Model->update_operation(array('table' => $tbl_name, 'data' => $image_enter_data, 'condition' => $col_name . " = " . $col_value));
          if ($imginsertStatus == 1) {
            move_uploaded_file($_FILES[$post_file]['tmp_name'], $path . $main_img);
            $img_name = $main_img;
          }
        }
      }
    }
    return $img_name;
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

  function file_get_contents_curl($url)
  {
    $url = str_replace(' ', '%20', $url);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, false);
    //curl_setopt($ch , CURLOPT_ENCODING , '');

    $data = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //echo $httpCode;
    if ($httpCode != 200) {
      // echo $url;
      $data = '';
      // echo $httpCode . 'test2';
    }
    //echo $data;
    //echo $httpCode;
    curl_close($ch);

    $http_codes = array(
      100 => 'Continue',
      101 => 'Switching Protocols',
      102 => 'Processing',
      103 => 'Checkpoint',
      200 => 'OK',
      201 => 'Created',
      202 => 'Accepted',
      203 => 'Non-Authoritative Information',
      204 => 'No Content',
      205 => 'Reset Content',
      206 => 'Partial Content',
      207 => 'Multi-Status',
      300 => 'Multiple Choices',
      301 => 'Moved Permanently',
      302 => 'Found',
      303 => 'See Other',
      304 => 'Not Modified',
      305 => 'Use Proxy',
      306 => 'Switch Proxy',
      307 => 'Temporary Redirect',
      400 => 'Bad Request',
      401 => 'Unauthorized',
      402 => 'Payment Required',
      403 => 'Forbidden',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      406 => 'Not Acceptable',
      407 => 'Proxy Authentication Required',
      408 => 'Request Timeout',
      409 => 'Conflict',
      410 => 'Gone',
      411 => 'Length Required',
      412 => 'Precondition Failed',
      413 => 'Request Entity Too Large',
      414 => 'Request-URI Too Long',
      415 => 'Unsupported Media Type',
      416 => 'Requested Range Not Satisfiable',
      417 => 'Expectation Failed',
      418 => 'I\'m a teapot',
      422 => 'Unprocessable Entity',
      423 => 'Locked',
      424 => 'Failed Dependency',
      425 => 'Unordered Collection',
      426 => 'Upgrade Required',
      449 => 'Retry With',
      450 => 'Blocked by Windows Parental Controls',
      500 => 'Internal Server Error',
      501 => 'Not Implemented',
      502 => 'Bad Gateway',
      503 => 'Service Unavailable',
      504 => 'Gateway Timeout',
      505 => 'HTTP Version Not Supported',
      506 => 'Variant Also Negotiates',
      507 => 'Insufficient Storage',
      509 => 'Bandwidth Limit Exceeded',
      510 => 'Not Extended'
    );

    $status = 'Bad Request';
    foreach ($http_codes as $key => $value) {
      if ($key == $httpCode) {
        $status = $value;
      }
    }



    return array("data" => $data, "status" => $status);
  }
  function ajax_insert_enquiry()
  {
    $page = trim($_POST['page']);

    ini_set('display_errors', 'Off');
    ini_set('error_reporting', E_ALL);
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");

    //echo '<pre>'; print_r($_POST); echo '</pre>'; exit; 

    if (true) {
      if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
        $link = $_SERVER['HTTP_REFERER'];
        $link_array = explode('/', $link);
        $page_action = end($link_array);
        $parts = parse_url($link);
        $page_host = $parts['host'];
        if (strpos($parts["host"], 'www.') !== false) { //echo 'yes<br>';
          $parts1 = explode('www.', $parts["host"]);
          $page_host = $parts1[1];
        }


        if ($page_host != _mainsite_hostname_) {

          echo '<script language="javascript">';
          echo 'alert("Host validation failed! try again.")';
          echo '</script>';
          die();
        }
      } else {
        echo '<script language="javascript">';
        echo 'alert("Error: HTTP_REFERER failed! try again.")';
        echo '</script>';
        die();
      }

      $request = '';
      if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $param['secret'] = _google_recaptcha_secret_key_;
        $param['response'] = $_POST['g-recaptcha-response'];
        $param['remoteip'] = $_SERVER['REMOTE_ADDR'];
        foreach ($param as $key => $val) {
          $request .= $key . "=" . $val;
          $request .= "&";
        }
        $request = substr($request, 0, strlen($request) - 1);
        $url = "https://www.google.com/recaptcha/api/siteverify?" . $request;
        //echo $url; exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result_data = curl_exec($ch);
        if (curl_exec($ch) === false) {
          $error_info = curl_error($ch);
        }
        curl_close($ch);

        $response = json_decode($result_data);
        if ($response->success != 1) {
          REDIRECT(MAINSITE . $page);
          echo '<script language="javascript">';
          echo 'alert("google recaptcha validation failed! try again.")';
          echo '</script>';

          die();
        }
      } else {
        REDIRECT(MAINSITE . $page);
        echo '<script language="javascript">';
        echo 'alert("Error: google recaptcha post validation failed! try again.")';
        echo '</script>';
        die();
      }
    }


    $enter_data['name'] = trim($_POST['name']);
    $enter_data['contactno'] = trim($_POST['contactno']);
    $enter_data['email'] = trim($_POST['email']);
    $enter_data['subject'] = trim($_POST['subject']);
    $enter_data['description'] = trim($_POST['description']);
    $enter_data['status'] = 1;

    $enter_data['added_on'] = date("Y-m-d H:i:s");

    $enquiry_result = $insertStatus = $this->Common_Model->add_operation(array('table' => 'enquiry', 'data' => $enter_data));

    if (!empty($enquiry_result)) {
      //redirect to thank you page
      REDIRECT(MAINSITE . "/thank-you");
    } else {
      //redirect to the same page
      REDIRECT(MAINSITE . $page);
    }


  }


  public function thank_you()
  {
    $this->data['meta_title'] = _project_name_ . " - Thank You";
    $this->data['meta_description'] = _project_name_ . " - Thank You";
    $this->data['meta_keywords'] = _project_name_ . " - Thank You";
    $this->data['meta_others'] = "";






    parent::getHeader('header', $this->data);
    $this->load->view('thank-you', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function test1p()
  {
    $this->data['meta_title'] = _project_name_ . " - Testing";
    $this->data['meta_description'] = _project_name_ . " - Testing";
    $this->data['meta_keywords'] = _project_name_ . " - Testing";
    $this->data['meta_others'] = "";






    parent::getHeader('header', $this->data);
    $this->load->view('test1p', $this->data);
    parent::getFooter('footer', $this->data);
  }


  public function pageNotFound()
  {
    $this->data['meta_title'] = _project_name_ . " - Page Not Found";
    $this->data['meta_description'] = _project_name_ . " - Page Not Found";
    $this->data['meta_keywords'] = _project_name_ . " - Page Not Found";
    $this->data['meta_others'] = "";

    $this->load->view('pageNotFound', $this->data);
  }

  public function found404()
  {
    $this->data['meta_title'] = _project_name_ . " - 404 found";
    $this->data['meta_description'] = _project_name_ . " - 404 found";
    $this->data['meta_keywords'] = _project_name_ . " - 404 found";
    $this->data['meta_others'] = "";

    parent::getHeader('header', $this->data);
    $this->load->view('404found', $this->data);
    parent::getFooter('footer', $this->data);
  }



}
