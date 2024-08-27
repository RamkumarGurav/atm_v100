<?php
class User_Employee_Model extends CI_Model
{
  public $session_uid = '';
  public $session_name = '';
  public $session_email = '';

  function __construct()
  {
    $this->load->database();
    $this->model_data = array();
    $this->db->query("SET sql_mode = ''");
    $this->session_uid = $this->session->userdata('sess_psts_uid');
    $this->session_name = $this->session->userdata('sess_psts_name');
    $this->session_email = $this->session->userdata('sess_psts_email');

  }

  /**
   * getting user_employees with search ,pagination  and sorting using params ,if your using this method to find single user_employee data with its user_employee_id then it will be present int the 0th index of the resultant array
   */
  function get_user_employee($params = array())
  {
    $result = '';
    if (!empty($params['search_for'])) {
      $this->db->select("count(urm.user_employee_id) as counts");
    } else {
      $this->db->select("urm.* , b.branch_id , b.branch_name , b.branch_address,dp.department_id,dp.department_name,ds.designation_id,
      ds.designation_name, 
 
      ");
      // ci.city_name, s.state_name, c.country_name, c.country_short_name, c.dial_code

      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.added_by) as added_by_name ");
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.updated_by) as updated_by_name ");
    }

    $this->db->from("user_employee as urm");
    $this->db->join("branch as  b", "b.branch_id = urm.branch_id");
    $this->db->join("department_master as  dp", "dp.department_id = urm.department_id");
    $this->db->join("designation_master as  ds", "ds.designation_id = urm.designation_id");
    // $this->db->join("shift_timing as  st", "st.shift_timing_id = urm.shift_timing_id");
    // $this->db->join("country as c", "c.country_id = urm.country_id"); // Join country table
    // $this->db->join("state as s", "s.state_id = urm.state_id"); // Join state table
    // $this->db->join("city as ci", "ci.city_id = urm.city_id"); // Join city table
    // $this->db->order_by("user_employee_id desc");

    if (!empty($params['attendance_report'])) {
      $this->db->order_by("urm.name ASC, b.branch_name ASC, dp.department_name ASC, ds.designation_name ASC ");
    } else {
      $this->db->order_by("user_employee_id desc");
    }

    if (!empty($params['user_employee_id'])) {
      $this->db->where("urm.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("urm.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['branch_id'])) {
      $this->db->where("urm.branch_id", $params['branch_id']);
    }
    if (!empty($params['department_id'])) {
      $this->db->where("urm.department_id", $params['department_id']);
    }
    if (!empty($params['designation_id'])) {
      $this->db->where("urm.designation_id", $params['designation_id']);
    }

    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['record_status'])) {
      if ($params['record_status'] == 'zero') {
        $this->db->where("urm.status = 0");
      } elseif ($params['record_status'] == "1and2") {
        $this->db->where_in("urm.status", [1, 2]);
      } else {
        $this->db->where("urm.status", $params['record_status']);
      }
    }



    if (!empty($params['field_value']) && !empty($params['field_name'])) {
      $this->db->where("$params[field_name] like ('%$params[field_value]%')");
    }

    if (!empty($params['limit']) && !empty($params['offset'])) {
      $this->db->limit($params['limit'], $params['offset']);
    } else if (!empty($params['limit'])) {
      $this->db->limit($params['limit']);
    }

    $query_get_list = $this->db->get();
    $result = $query_get_list->result();

    // If details parameter is provided, fetch additional details
    if (!empty($result) && !empty($params['details'])) {
      foreach ($result as $utd) {

        $this->db->select("uekf.*");
        $this->db->from("user_employee_kyc_file as uekf");
        $this->db->where("uekf.user_employee_id", $utd->user_employee_id);
        $utd->user_employee_kyc_file = $this->db->get()->result();

        $this->db->select("st.*");
        $this->db->from("shift_timing as st");
        $this->db->where("st.user_employee_id", $utd->user_employee_id);
        $this->db->order_by("st.day asc");
        $utd->shift_timing = $this->db->get()->result();


      }
    }

    return $result;
  }


  function get_user_employee_for_attendance($params = array())
  {
    $result = '';
    if (!empty($params['search_for'])) {
      $this->db->select("count(urm.user_employee_id) as counts");
    } else {
      $this->db->select("urm.* , b.branch_id , b.branch_name , b.branch_address,dp.department_id,dp.department_name,ds.designation_id,
      ds.designation_name, 
 
      ");
      // ci.city_name, s.state_name, c.country_name, c.country_short_name, c.dial_code

      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.added_by) as added_by_name ");
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.updated_by) as updated_by_name ");
    }

    $this->db->from("user_employee as urm");
    $this->db->join("branch as  b", "b.branch_id = urm.branch_id");
    $this->db->join("department_master as  dp", "dp.department_id = urm.department_id");
    $this->db->join("designation_master as  ds", "ds.designation_id = urm.designation_id");
    // $this->db->join("shift_timing as  st", "st.shift_timing_id = urm.shift_timing_id");
    // $this->db->join("country as c", "c.country_id = urm.country_id"); // Join country table
    // $this->db->join("state as s", "s.state_id = urm.state_id"); // Join state table
    // $this->db->join("city as ci", "ci.city_id = urm.city_id"); // Join city table
    // $this->db->order_by("user_employee_id desc");

    if (!empty($params['attendance_report'])) {
      $this->db->order_by("urm.name ASC, b.branch_name ASC, dp.department_name ASC, ds.designation_name ASC ");
    } else {
      $this->db->order_by("user_employee_id desc");
    }

    if (!empty($params['user_employee_id'])) {
      $this->db->where("urm.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("urm.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['branch_id'])) {
      $this->db->where("urm.branch_id", $params['branch_id']);
    }
    if (!empty($params['department_id'])) {
      $this->db->where("urm.department_id", $params['department_id']);
    }
    if (!empty($params['designation_id'])) {
      $this->db->where("urm.designation_id", $params['designation_id']);
    }

    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['record_status'])) {
      if ($params['record_status'] == 'zero') {
        $this->db->where("urm.status = 0");
      } elseif ($params['record_status'] == "1and2") {
        $this->db->where_in("urm.status", [1, 2]);
      } else {
        $this->db->where("urm.status", $params['record_status']);
      }
    }



    if (!empty($params['field_value']) && !empty($params['field_name'])) {
      $this->db->where("$params[field_name] like ('%$params[field_value]%')");
    }

    if (!empty($params['limit']) && !empty($params['offset'])) {
      $this->db->limit($params['limit'], $params['offset']);
    } else if (!empty($params['limit'])) {
      $this->db->limit($params['limit']);
    }

    $query_get_list = $this->db->get();
    $result = $query_get_list->result();

    // If details parameter is provided, fetch additional details
    if (!empty($result) && !empty($params['details'])) {
      foreach ($result as $utd) {

        $this->db->select("uekf.*");
        $this->db->from("user_employee_kyc_file as uekf");
        $this->db->where("uekf.user_employee_id", $utd->user_employee_id);
        $utd->user_employee_kyc_file = $this->db->get()->result();

        $this->db->select("st.*");
        $this->db->from("shift_timing as st");
        $this->db->where("st.user_employee_id", $utd->user_employee_id);
        $this->db->order_by("st.day asc");
        $utd->shift_timing = $this->db->get()->result();


      }
    }

    return $result;
  }




}

?>