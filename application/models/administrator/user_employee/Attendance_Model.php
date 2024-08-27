<?php
class Attendance_Model extends CI_Model
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
   * getting attendances with search ,pagination  and sorting using params ,if your using this method to find single attendance data with its attendance_id then it will be present int the 0th index of the resultant array
   */
  function get_attendance($params = array())
  {
    $result = '';
    if (!empty($params['search_for'])) {
      $this->db->select("count(urm.attendance_id) as counts");
    } else {
      $this->db->select("urm.* , uemp.name,uemp.user_employee_custom_id,uemp.profile_image,uemp.contactno");
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.added_by) as added_by_name ");
      $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.updated_by) as updated_by_name ");
    }

    $this->db->from("attendance as urm");
    $this->db->join("user_employee as  uemp", "uemp.user_employee_id = urm.user_employee_id");
    $this->db->order_by("urm.attendance_id desc");


    if (!empty($params['attendance_id'])) {
      $this->db->where("urm.attendance_id", $params['attendance_id']);
    }
    if (!empty($params['user_employee_id'])) {
      $this->db->where("urm.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("uemp.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['branch_id'])) {
      $this->db->where("uemp.branch_id", $params['branch_id']);
    }

    if (!empty($params['department_id'])) {
      $this->db->where("uemp.department_id", $params['department_id']);
    }

    if (!empty($params['designation_id'])) {
      $this->db->where("uemp.designation_id", $params['designation_id']);
    }


    if (!empty($params['login_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['login_date']));
      $this->db->where("DATE_FORMAT(urm.login_time, '%Y%m%d') = DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['logout_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['logout_date']));
      $this->db->where("DATE_FORMAT(urm.logout_time, '%Y%m%d') = DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
    }

    if (!empty($params['user_employee_record_status'])) {
      if ($params['user_employee_record_status'] == 'zero') {
        $this->db->where("uemp.status = 0");
      } elseif ($params['user_employee_record_status'] == "1and2") {
        $this->db->where_in("uemp.status", [1, 2]);
      } else {
        $this->db->where("uemp.status", $params['user_employee_record_status']);
      }
    }

    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where("urm.status = 0"); // Status zero condition
      } else {
        $this->db->where("urm.status", $params['attendance_record_status']); // Specific status condition
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

    return $result;
  }



  function get_attendance_report1($params = array())
  {
    $result = '';

    $this->db->select("urm.* , ue.name,ue.user_employee_custom_id,ue.profile_image,ue.contactno");
    $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.added_by) as added_by_name ");
    $this->db->select("(select au.name from admin_user as  au where au.admin_user_id = urm.updated_by) as updated_by_name ");

    $this->db->from("attendance as urm");
    $this->db->join("user_employee as  ue", "ue.user_employee_id = urm.user_employee_id");
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    $this->db->group_by('ue.user_employee_id');
    $this->db->order_by("urm.user_employee_id desc");


    if (!empty($params['attendance_id'])) {
      $this->db->where("urm.attendance_id", $params['attendance_id']);
    }

    if (!empty($params['user_employee_id'])) {
      $this->db->where("urm.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['branch_id'])) {
      $this->db->where("ue.branch_id", $params['branch_id']);
    }

    if (!empty($params['department_id'])) {
      $this->db->where("ue.department_id", $params['department_id']);
    }

    if (!empty($params['designation_id'])) {
      $this->db->where("ue.designation_id", $params['designation_id']);
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
      } else {
        $this->db->where("urm.status", $params['record_status']);
      }
    }

    if (!empty($params['employee_record_status'])) {
      if ($params['employee_record_status'] == 'zero') {
        $this->db->where("ue.status = 0");
      } else {
        $this->db->where("ue.status", $params['employee_record_status']);
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

    return $result;
  }


  public function get_attendance_report($start_date, $end_date)
  {
    $query = $this->db->query("
        SELECT 
            ue.user_employee_id,
            ue.name,
            ue.user_employee_custom_id,
            ue.branch_id,
            ue.department_id,
            ue.designation_id,
            ue.contactno,
            ue.company_email,
            ue.name,
            DATE_FORMAT('$start_date', '%d/%m/%Y') AS from_date,
            DATE_FORMAT('$end_date', '%d/%m/%Y') AS to_date,
            SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, a.actual_login_time, a.actual_logout_time))) AS total_work_time,
            COUNT(DISTINCT DATE(st.added_on)) - COUNT(DISTINCT DATE(a.actual_login_time)) AS absent_days,
            SUM(CASE WHEN a.actual_login_time > CONCAT(DATE(a.actual_login_time), ' ', st.ideal_login_time) THEN 1 ELSE 0 END) AS late_logins,
            SUM(CASE WHEN a.actual_logout_time < CONCAT(DATE(a.actual_logout_time), ' ', st.ideal_logout_time) THEN 1 ELSE 0 END) AS early_logouts
        FROM 
            user_employee ue
        LEFT JOIN 
            attendance a ON ue.user_employee_id = a.user_employee_id AND a.actual_login_time BETWEEN '$start_date' AND '$end_date'
        LEFT JOIN 
            shift_timing st ON ue.user_employee_id = st.user_employee_id AND DAYOFWEEK(a.actual_login_time) = st.day_number
        WHERE 
            st.is_working_day = '1'
        GROUP BY 
            ue.user_employee_id
    ");
    return $query->result();
  }

  public function get_total_working_time_by_month1($params = array())
  {
    $this->db->select('ft.user_employee_id, ft.name, 
                       YEAR(attendance.login_time) AS year, 
                       MONTH(attendance.login_time) AS month, 
                       SEC_TO_TIME(SUM(TIME_TO_SEC(attendance.total_time))) AS total_working_time');

    $this->db->from('user_employee as ft');
    $this->db->join('attendance', 'ft.user_employee_id = attendance.user_employee_id');
    // $this->db->where('ft.user_employee_id', $user_employee_id);

    if (!empty($params['user_employee_id'])) {
      $this->db->where('ft.user_employee_id', $params['user_employee_id']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(attendance.login_time)', $params['year']);
    }


    $this->db->group_by('ft.user_employee_id, year, month');
    $this->db->order_by('year desc');
    $this->db->order_by('month desc');
    $query = $this->db->get();
    return $query->result();
  }




  public function get_total_working_time_by_month($params = array())
  {
    $this->db->select('ft.user_employee_id, ft.name, 
                       YEAR(attendance.login_time) AS year, 
                       MONTH(attendance.login_time) AS month, 
                       SEC_TO_TIME(SUM(TIME_TO_SEC(attendance.total_time))) AS total_working_time,
                       COUNT(CASE WHEN attendance.logout_time IS NOT NULL AND attendance.status=1 THEN 1 END) AS successful_attendance_days');
    $this->db->from('user_employee as ft');
    $this->db->join('attendance', 'ft.user_employee_id = attendance.user_employee_id', 'left');

    if (!empty($params['user_employee_id'])) {
      $this->db->where('ft.user_employee_id', $params['user_employee_id']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(attendance.login_time)', $params['year']);
    }

    $this->db->group_by('ft.user_employee_id, year, month');
    $this->db->order_by('year DESC, month DESC');
    $query = $this->db->get();
    return $query->result();
  }



  public function get_late_logins_group_by_employee($params = array())
  {
    $this->db->select(' ue.*');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }

    if (!empty($params['current_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE(CURDATE())');
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month'] && !empty($params['day']))) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }



    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    $this->db->where('ft.login_time IS NOT NULL');
    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day+1)');
    $this->db->where('TIME(ft.login_time) > ADDTIME(shift_timing.login_time, "00:15:00")');
    $this->db->where('shift_timing.is_working_day', 1);
    $this->db->group_by('ue.user_employee_id');

    $query = $this->db->get();
    // return $query->result();
    $results = $query->result();

    // Loop through results to fetch attendance data
    foreach ($results as $result) {
      $this->db->select('ft.*');
      $this->db->from('attendance as ft');
      $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
      $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

      $this->db->where('ft.user_employee_id', $result->user_employee_id);

      if (!empty($params['attendance_record_status'])) {
        $this->db->where("ft.status", $params['attendance_record_status']);
      }

      if (!empty($params['current_day'])) {
        $this->db->where('DATE(ft.login_time) = DATE(CURDATE())');
      }

      if (!empty($params['last_day'])) {
        $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
      }

      if (!empty($params['last_month'])) {
        $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
        $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
      }

      if (!empty($params['last_year'])) {
        $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
      }

      if (!empty($params['date_in_ymd'])) {
        $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
      }

      if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
        $this->db->where('YEAR(ft.login_time)', $params['year']);
        $this->db->where('MONTH(ft.login_time)', $params['month']);
        $this->db->where('DAY(ft.login_time)', $params['day']);
      }



      if (!empty($params['year']) && !empty($params['month'])) {
        $this->db->where('YEAR(ft.login_time)', $params['year']);
        $this->db->where('MONTH(ft.login_time)', $params['month']);
      }

      if (!empty($params['year'])) {
        $this->db->where('YEAR(ft.login_time)', $params['year']);
      }

      $this->db->where('ft.login_time IS NOT NULL');
      $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day+1)');
      $this->db->where('TIME(ft.login_time) > ADDTIME(shift_timing.login_time, "00:15:00")');
      $this->db->where('shift_timing.is_working_day', 1);

      $attendance_query = $this->db->get();
      $result->attendance_data = $attendance_query->result();
    }

    return $results;
  }

  public function get_late_logins($params = array())
  {

    if (!empty($params['search_for'])) {
      $this->db->select("count(ft.attendance_id) as counts");
    } else {

      $this->db->select('ft.*, ue.user_employee_id,ue.name,ue.profile_image,ue.contactno,ue.personal_email,ue.user_employee_custom_id');

    }
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    $this->db->where('ft.login_time IS NOT NULL');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }



    if (!empty($params['user_employee_record_status'])) {
      if ($params['user_employee_record_status'] == 'zero') {
        $this->db->where("ue.status = 0");
      } elseif ($params['user_employee_record_status'] == "1and2") {
        $this->db->where_in("ue.status", [1, 2]);
      } else {
        $this->db->where("ue.status", $params['user_employee_record_status']);
      }
    }

    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where("ft.status = 0"); // Status zero condition
      } else {
        $this->db->where("ft.status", $params['attendance_record_status']); // Specific status condition
      }
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }





    if (!empty($params['current_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE(CURDATE())');
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month'] && !empty($params['day']))) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }



    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day+1)');
    $this->db->where('TIME(ft.login_time) > ADDTIME(shift_timing.login_time, "00:15:00")');
    $this->db->where('shift_timing.is_working_day', 1);

    $query = $this->db->get();
    // return $query->result();
    $results = $query->result();



    return $results;
  }

  public function get_late_logins_between_2dates($params = array())
  {
    if (!empty($params['search_for'])) {
      $this->db->select("count(ft.attendance_id) as counts");
    } else {
      $this->db->select('
            ue.user_employee_id,
            ue.name,
            ue.profile_image,
            ue.contactno,
            ue.personal_email,
            ue.user_employee_custom_id,
            COUNT(ft.attendance_id) as late_logins_count
        ');
    }

    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    $this->db->where('ft.login_time IS NOT NULL');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }

    if (!empty($params['start_date']) && !empty($params['end_date'])) {
      $this->db->where('ft.login_time >=', $params['start_date']);
      $this->db->where('ft.login_time <=', $params['end_date']);
    }

    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)');
    $this->db->where('TIME(ft.login_time) > ADDTIME(shift_timing.login_time, "00:15:00")');
    $this->db->where('shift_timing.is_working_day', 1);

    if (empty($params['search_for'])) {
      $this->db->group_by('ue.user_employee_id');
    }

    $query = $this->db->get();
    $results = $query->result();

    return $results;
  }




  public function get_attendance_report11($params = array())
  {
    $start_date = $params["start_date"];
    $end_date = $params["end_date"];
    // $this->db->select(` DATE_FORMAT('$start_date', '%d/%m/%Y') AS from_date,
    //             DATE_FORMAT('$end_date', '%d/%m/%Y') AS to_date`);
    $this->db->select("
     DATE_FORMAT('$start_date', '%d/%m/%Y') AS from_date,
             DATE_FORMAT('$end_date', '%d/%m/%Y') AS to_date,
              ue.user_employee_id,
              ue.name,
              ue.profile_image,
              ue.contactno,
              ue.personal_email,
              ue.user_employee_custom_id,
           COUNT(CASE WHEN  TIME(ft.login_time) > ADDTIME(shift_timing.login_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) as late_logins_count,
   COUNT(CASE WHEN TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) as early_logouts_count,
     SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, ft.login_time, ft.logout_time))) as total_work_time ,
 
   ");




    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');





    $this->db->where('ft.login_time IS NOT NULL');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }
    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where("ft.status = 0");
      } else {
        $this->db->where("ft.status", $params['attendance_record_status']);
      }
    }

    if (!empty($params['user_employee_record_status'])) {
      if ($params['user_employee_record_status'] == 'zero') {
        $this->db->where("ue.status = 0");
      } else {
        $this->db->where("ue.status", $params['user_employee_record_status']);
      }
    }
    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }



    if (!empty($params['start_date']) && !empty($params['end_date'])) {
      $this->db->where('ft.login_time >=', $params['start_date']);
      $this->db->where('ft.login_time <=', $params['end_date']);
    }

    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)');
    $this->db->where('shift_timing.is_working_day', 1);

    $this->db->group_by('ue.user_employee_id');

    $query = $this->db->get();
    $results = $query->result();

    return $results;
  }

  public function get_single_user_employee_attendance_report($params = array())
  {
    $start_date = $params["start_date"];
    $end_date = $params["end_date"];
    $user_employee_id = $params["user_employee_id"];

    // Select columns and format dates
    $this->db->select("
          DATE_FORMAT('$start_date', '%d/%m/%Y') AS from_date,
          DATE_FORMAT('$end_date', '%d/%m/%Y') AS to_date,
          COUNT(CASE WHEN ft.login_time IS NOT NULL AND  ft.login_time IS NOT NULL THEN ft.attendance_id ELSE NULL END) AS total_attendance_count,
          COUNT(CASE WHEN TIME(ft.login_time) > ADDTIME(shift_timing.login_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) AS late_logins_count,
          COUNT(CASE WHEN TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) AS early_logouts_count,
          SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, ft.login_time, ft.logout_time))) AS total_work_time
      ");

    // From tables and joins
    $this->db->from('attendance AS ft');
    $this->db->join('shift_timing', 'ft.user_employee_id = shift_timing.user_employee_id AND DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)', 'left');

    // Apply where conditions
    $this->db->where('ft.login_time IS NOT NULL');
    if (!empty($user_employee_id)) {
      $this->db->where('ft.user_employee_id', $user_employee_id);
    }
    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] === 'zero') {
        $this->db->where('ft.status', 0);
      } else {
        $this->db->where('ft.status', $params['attendance_record_status']);
      }
    }
    if (!empty($start_date) && !empty($end_date)) {
      $this->db->where('ft.login_time >=', $start_date);
      $this->db->where('ft.login_time <=', $end_date);
    }
    $this->db->where('shift_timing.is_working_day', 1);

    // Group by employee ID
    $this->db->group_by('ft.user_employee_id');

    // Execute the query
    $query = $this->db->get();
    return $query->result();
  }

  public function get_single_user_employee_attendance_report_0($params = array())
  {
    $start_date = new DateTime($params["start_date"]);
    $start_date->modify('-1 day');
    $start_date = $start_date->format("Y-m-d");
    $end_date = new DateTime($params["start_date"]);
    $end_date->modify('+1 day');
    $end_date = $end_date->format("Y-m-d");

    $start_date = date("Y-m-d", strtotime($params["start_date"]));
    $end_date = date("Y-m-d", strtotime($params["end_date"]));
    // $start_date = $params["start_date"];
    // $end_date = $params["end_date"];
    $user_employee_id = $params["user_employee_id"];

    // Select columns and format dates
    $this->db->select("
          COUNT(CASE WHEN ft.login_time IS NOT NULL AND  ft.login_time IS NOT NULL THEN ft.attendance_id ELSE NULL END) AS total_attendance_count,
          COUNT(CASE WHEN TIME(ft.login_time) > ADDTIME(shift_timing.login_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) AS late_logins_count,
          COUNT(CASE WHEN TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) AS early_logouts_count,
          SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, ft.login_time, ft.logout_time))) AS total_work_time
      ");

    // From tables and joins
    $this->db->from('attendance AS ft');
    $this->db->join('shift_timing', 'ft.user_employee_id = shift_timing.user_employee_id AND DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)', 'left');

    // Apply where conditions
    $this->db->where('ft.login_time IS NOT NULL');
    $this->db->where('ft.logout_time IS NOT NULL');
    if (!empty($user_employee_id)) {
      $this->db->where('ft.user_employee_id', $user_employee_id);
    }
    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] === 'zero') {
        $this->db->where('ft.status', 0);
      } else {
        $this->db->where('ft.status', $params['attendance_record_status']);
      }
    }
    if (!empty($start_date) && !empty($end_date)) {
      $this->db->where('ft.login_time >=', $start_date);
      $this->db->where('ft.login_time <=', $end_date);
    }
    $this->db->where('shift_timing.is_working_day', 1);

    // Group by employee ID
    $this->db->group_by('ft.user_employee_id');

    // Execute the query
    $query = $this->db->get();
    return $query->result();
  }

  public function get_single_user_employee_attendance_report_list($params = array())
  {
    $start_date = date("Y-m-d", strtotime($params["start_date"]));
    $end_date = date("Y-m-d", strtotime($params["end_date"]));
    $user_employee_id = $params["user_employee_id"];

    // Select columns and format dates
    $this->db->select("
          ft.*
      ");

    // From tables and joins
    $this->db->from('attendance AS ft');
    $this->db->join('shift_timing', 'ft.user_employee_id = shift_timing.user_employee_id AND DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)', 'left');


    if (!empty($user_employee_id)) {
      $this->db->where('ft.user_employee_id', $user_employee_id);
    }

    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] === 'zero') {
        $this->db->where('ft.status', 0);
      } else {
        $this->db->where('ft.status', $params['attendance_record_status']);
      }
    }
    if (!empty($start_date) && !empty($end_date)) {
      $this->db->where('ft.login_time >=', $start_date);
      $this->db->where('ft.login_time <=', $end_date);
    }

    // Execute the query
    $query = $this->db->get();
    return $query->result();
  }

  public function get_single_user_employee_attendance_report_list_0($params = array())
  {
    // Format the start and end dates
    $start_date = date("Y-m-d", strtotime($params["start_date"]));
    $end_date = date("Y-m-d", strtotime($params["end_date"]));
    $user_employee_id = $params["user_employee_id"];

    // Step 1: Get all dates between start and end dates
    $dates = [];
    $current_date = strtotime($start_date);
    $end_date = strtotime($end_date);

    while ($current_date <= $end_date) {
      $dates[] = date("Y-m-d", $current_date);
      $current_date = strtotime("+1 day", $current_date);
    }

    // Step 2: Get attendance records for the employee for the given dates
    $this->db->select("ft.*");
    $this->db->from('attendance AS ft');
    $this->db->where('ft.user_employee_id', $user_employee_id);
    $this->db->where('ft.login_time >=', $start_date);
    $this->db->where('ft.login_time <=', date("Y-m-d", $end_date));
    $attendance_records = $this->db->get()->result_array();

    // Step 3: Get shift timings for the employee
    $this->db->select("shift_timing.*");
    $this->db->from('shift_timing');
    $this->db->where('shift_timing.user_employee_id', $user_employee_id);
    $shift_timings = $this->db->get()->result_array();

    // Create a lookup for shift timings based on day number
    $shift_timing_lookup = [];
    foreach ($shift_timings as $shift_timing) {
      $shift_timing_lookup[$shift_timing['day']] = $shift_timing;
    }

    // Step 4: Combine the data to generate the desired output
    $result = [];
    foreach ($dates as $date) {
      $day_number = date('w', strtotime($date));
      $shift_timing = $shift_timing_lookup[$day_number];
      $attendance_found = false;

      foreach ($attendance_records as $attendance) {
        if (strpos($attendance['login_time'], $date) === 0) {
          $result[] = $attendance;
          $attendance_found = true;
          break;
        }
      }

      if (!$attendance_found) {
        if ($shift_timing['is_working_day'] == 1) {
          $result[] = (object) [
            'type' => 'on_leave',
            'date' => $date
          ];
        } else {
          $result[] = (object) [
            'type' => 'on_holiday',
            'date' => $date
          ];
        }
      }
    }

    return $result;
  }
  public function get_single_user_employee_attendance_report_list_2($params = array())
  {
    $result = [];
    // Format the start and end dates
    $start_date = date("Y-m-d", strtotime($params["start_date"]));
    $end_date = date("Y-m-d", strtotime($params["end_date"]));
    // $start_date = $params["start_date"];
    // $end_date = $params["end_date"];
    $user_employee_id = $params["user_employee_id"];

    $dates = $this->generate_dates_list($start_date, $end_date, $user_employee_id);
    foreach ($dates as $item) {
      $this->db->select("ft.*");
      $this->db->from('attendance AS ft');
      $this->db->where('ft.user_employee_id', $user_employee_id);
      $this->db->where('DATE(ft.login_time) =', $item->date);
      if (!empty($params['attendance_record_status'])) {
        if ($params['attendance_record_status'] == 'zero') {
          $this->db->where("ft.status = 0"); // Status zero condition
        } else {
          $this->db->where("ft.status", $params['attendance_record_status']); // Specific status condition
        }
      }

      $attendance = $this->db->get()->result();
      if (!empty($attendance)) {
        $attendance[0]->data_present = 1;
        $attendance[0]->date = $item->date;
        $attendance[0]->is_working_day = $item->is_working_day;
        $attendance[0]->expected_login_time = $item->login_time;
        $attendance[0]->expected_logout_time = $item->logout_time;
        $result[] = $attendance[0];
      } else {
        $x = (object) array(
          "data_present" => 0,
          "date" => $item->date,
          "is_working_day" => $item->is_working_day,
          "expected_login_time" => $item->login_time,
          "expected_logout_time" => $item->logout_time
        );
        $result[] = $x;
      }
    }

    return $result;
  }
  public function generate_dates_list($start_date, $end_date, $user_employee_id = 4)
  {
    $dates = [];


    // Get all dates between start and end dates
    $current_date = strtotime($start_date);
    $end_date = strtotime($end_date);

    while ($current_date <= $end_date) {
      $date = date("Y-m-d", $current_date);
      $day_number = date('w', $current_date); // Get day number (0 for Sunday, 1 for Monday, etc.)

      // Query shift timing for the current date
      $this->db->select("st.*");
      $this->db->from('shift_timing as st');
      $this->db->where('st.user_employee_id', $user_employee_id);
      $this->db->where('st.day', $day_number); // Adjusted field name to 'day_number'

      $query = $this->db->get();
      $result = $query->row();

      // Add date and shift timing result to the list
      $result->date = $date;
      $dates[] = $result;

      // Move to the next date
      $current_date = strtotime("+1 day", $current_date);
    }

    return $dates;
  }


  public function generate_dates_list0($start_date, $end_date, $user_employee_id = 4)
  {
    $dates = [];
    $start_date = date("Y-m-d", strtotime($start_date));
    $end_date = date("Y-m-d", strtotime($end_date));

    // Get all dates between start and end dates
    $current_date = strtotime($start_date);
    $end_date = strtotime($end_date);

    while ($current_date <= $end_date) {
      $date = date("Y-m-d", $current_date);
      $day_number = date('w', $current_date); // Get day number (0 for Sunday, 1 for Monday, etc.)

      // Query shift timing for the current date
      $this->db->select("st.*");
      $this->db->from('shift_timing as st');
      $this->db->where('st.user_employee_id', $user_employee_id);
      $this->db->where('st.day', $day_number); // Adjusted field name to 'day_number'

      $query = $this->db->get();
      $result = $query->row();

      // Add date and shift timing result to the list
      $dates[] = [
        'date' => $date,
        'shift_timing' => $result
      ];

      // Move to the next date
      $current_date = strtotime("+1 day", $current_date);
    }

    return $dates;
  }
  public function generate_dates_list1($start_date, $end_date, $user_employee_id = 4)
  {
    $dates = [];
    $start_date = date("Y-m-d", strtotime($start_date));
    $end_date = date("Y-m-d", strtotime($end_date));

    // Step 1: Get all dates between start and end dates
    $current_date = strtotime($start_date);
    $end_date = strtotime($end_date);

    while ($current_date <= $end_date) {
      $dates[]['date'] = $date = date("Y-m-d", $current_date);

      $this->db->select("st.*
     
  ");
      $this->db->from('shift_timing as st');
      $this->db->where('st.user_employee_id', $user_employee_id);
      $this->db->where("st.day =", "DAYOFWEEK('$date') - 1");

      $query = $this->db->get();
      $result = $query->row();
      $dates[]['result'] = $result;

      $current_date = strtotime("+1 day", $current_date);
    }



    return $dates;
  }
  public function get_attendance_report11_0($params = array())
  {
    // Validate and sanitize input parameters
    $start_date = isset($params["start_date"]) ? $params["start_date"] : null;
    $end_date = isset($params["end_date"]) ? $params["end_date"] : null;

    // Begin building the query
    $this->db->select("
        DATE_FORMAT('$start_date', '%d/%m/%Y') AS from_date,
        DATE_FORMAT('$end_date', '%d/%m/%Y') AS to_date,
        ue.user_employee_id,
        ue.name,
        ue.profile_image,
        ue.contactno,
        ue.personal_email,
        ue.user_employee_custom_id,
        DATEDIFF('$end_date', '$start_date')-1 AS total_days,
        (
            SELECT COUNT(*)
            FROM shift_timing st
            WHERE st.user_employee_id = ue.user_employee_id
            AND st.is_working_day = 1
            AND st.day + 1 BETWEEN DAYOFWEEK('$start_date') AND DAYOFWEEK('$end_date')
        ) as working_days_count,
        COUNT(CASE WHEN ft.login_time IS NOT NULL AND ft.logout_time IS NOT NULL THEN ft.attendance_id ELSE NULL END) as total_attendance_count,
        COUNT(CASE WHEN TIME(ft.login_time) > ADDTIME(shift_timing.login_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) as late_logins_count,
        COUNT(CASE WHEN TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) as early_logouts_count,
        SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, ft.login_time, ft.logout_time))) as total_work_time,
        (
            SELECT COUNT(*)
            FROM shift_timing st
            WHERE st.user_employee_id = ue.user_employee_id
            AND st.is_working_day = 1
            AND st.day + 1 BETWEEN DAYOFWEEK('$start_date') AND DAYOFWEEK('$end_date')
        ) - COUNT(DISTINCT DATE(ft.login_time)) as missed_logins_on_working_day_count
    ");

    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    // Filter for records with non-null login times
    // $this->db->where('ft.login_time IS NOT NULL');

    // Apply filters based on input parameters
    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }
    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }
    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where("ft.status = 0");
      } else {
        $this->db->where("ft.status", $params['attendance_record_status']);
      }
    }
    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }
    if (!empty($start_date) && !empty($end_date)) {
      $this->db->where('ft.login_time >=', $start_date);
      $this->db->where('ft.login_time <=', $end_date);
    }

    // Filter to include only working days as per shift_timing
    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)');
    $this->db->where('shift_timing.is_working_day', 1);

    // Group by employee to aggregate results
    $this->db->group_by('ue.user_employee_id');

    // Execute the query and fetch the results
    $query = $this->db->get();
    $results = $query->result();

    return $results;
  }

  public function get_shift_summary($start_date, $end_date, $user_employee_id)
  {
    // Calculate total days between the two dates
    $total_days = (new DateTime($end_date))->diff(new DateTime($start_date))->days + 1;

    // Get total working and non-working days
    $this->db->select("
          SUM(CASE WHEN is_working_day = 1 THEN 1 ELSE 0 END) as total_working_days,
          SUM(CASE WHEN is_working_day = 0 THEN 1 ELSE 0 END) as total_non_working_days,
          SEC_TO_TIME(SUM(CASE WHEN is_working_day = 1 THEN 
              TIME_TO_SEC(TIMEDIFF(logout_time, login_time)) ELSE 0 END)) as total_ideal_work_time
      ");
    $this->db->from('shift_timing');
    $this->db->where('user_employee_id', $user_employee_id);
    $this->db->where('day >=', 'DAYOFWEEK(DATE_SUB("' . $start_date . '", INTERVAL 1 DAY)) - 1', false);
    $this->db->where('day <=', 'DAYOFWEEK(DATE_SUB("' . $end_date . '", INTERVAL 1 DAY)) - 1', false);

    $query = $this->db->get();
    $result = $query->row();

    return [
      'total_days' => $total_days,
      'total_working_days' => $result->total_working_days,
      'total_non_working_days' => $result->total_non_working_days,
      'total_ideal_work_time' => $result->total_ideal_work_time
    ];
  }

  public function get_late_logins_only_count($params = array())
  {
    $this->db->select(' COUNT(*) as count');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }

    if (!empty($params['current_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE(CURDATE())');
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month'] && !empty($params['day']))) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }



    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    $this->db->where('ft.login_time IS NOT NULL');
    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day+1)');
    $this->db->where('TIME(ft.login_time) > ADDTIME(shift_timing.login_time, "00:15:00")');
    $this->db->where('shift_timing.is_working_day', 1);

    $query = $this->db->get();
    return $query->result();
  }



  public function get_early_logouts_group_by_employee($params = array())
  {
    $this->db->select(' ue.*');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("BINARY ue.user_employee_custom_id", $params['user_employee_custom_id']); // Ensure case sensitivity
    }






    $this->db->group_by('ue.user_employee_id');

    $query = $this->db->get();
    // return $query->result();
    $results = $query->result();

    // Loop through results to fetch attendance data
    foreach ($results as $result) {
      $this->db->select('ft.*');
      $this->db->from('attendance as ft');
      $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
      $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

      $this->db->where('ft.user_employee_id', $result->user_employee_id);

      if (!empty($params['attendance_record_status'])) {
        $this->db->where("ft.status", $params['attendance_record_status']);
      }

      if (!empty($params['current_day'])) {
        $this->db->where('DATE(ft.logout_time) = DATE(CURDATE())');
      }

      if (!empty($params['last_day'])) {
        $this->db->where('DATE(ft.logout_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
      }

      if (!empty($params['last_month'])) {
        $this->db->where('MONTH(ft.logout_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
        $this->db->where('YEAR(ft.logout_time) = YEAR(CURDATE())');
      }

      if (!empty($params['last_year'])) {
        $this->db->where('YEAR(ft.logout_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
      }

      if (!empty($params['date_in_ymd'])) {
        $this->db->where('DATE(ft.logout_time)', $params['date_in_ymd']);
      }

      if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
        $this->db->where('YEAR(ft.logout_time)', $params['year']);
        $this->db->where('MONTH(ft.logout_time)', $params['month']);
        $this->db->where('DAY(ft.logout_time)', $params['day']);
      }



      if (!empty($params['year']) && !empty($params['month'])) {
        $this->db->where('YEAR(ft.logout_time)', $params['year']);
        $this->db->where('MONTH(ft.logout_time)', $params['month']);
      }

      if (!empty($params['year'])) {
        $this->db->where('YEAR(ft.logout_time)', $params['year']);
      }

      $this->db->where('ft.login_time IS NOT NULL');
      $this->db->where('ft.logout_time IS NOT NULL');
      $this->db->where('DAYOFWEEK(ft.logout_time) = (shift_timing.day+1)');
      $this->db->where('TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, "00:15:00")');
      $this->db->where('shift_timing.is_working_day', 1);

      $attendance_query = $this->db->get();
      $result->attendance_data = $attendance_query->result();
    }

    return $results;
  }

  public function get_early_logouts($params = array())
  {

    if (!empty($params['search_for'])) {
      $this->db->select("count(ft.attendance_id) as counts");
    } else {

      $this->db->select('ft.*, ue.user_employee_id,ue.name,ue.profile_image,ue.contactno,ue.personal_email,ue.user_employee_custom_id');

    }
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    $this->db->where('ft.login_time IS NOT NULL');
    $this->db->where('ft.logout_time IS NOT NULL');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      if ($params['user_employee_record_status'] == 'zero') {
        $this->db->where("ue.status = 0");
      } elseif ($params['user_employee_record_status'] == "1and2") {
        $this->db->where_in("ue.status", [1, 2]);
      } else {
        $this->db->where("ue.status", $params['user_employee_record_status']);
      }
    }

    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where("ft.status = 0"); // Status zero condition
      } else {
        $this->db->where("ft.status", $params['attendance_record_status']); // Specific status condition
      }
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }



    if (!empty($params['current_day'])) {
      $this->db->where('DATE(ft.logout_time) = DATE(CURDATE())');
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.logout_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.logout_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.logout_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.logout_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.logout_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month'] && !empty($params['day']))) {
      $this->db->where('YEAR(ft.logout_time)', $params['year']);
      $this->db->where('MONTH(ft.logout_time)', $params['month']);
      $this->db->where('DAY(ft.logout_time)', $params['day']);
    }



    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.logout_time)', $params['year']);
      $this->db->where('MONTH(ft.logout_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.logout_time)', $params['year']);
    }

    $this->db->where('DAYOFWEEK(ft.logout_time) = (shift_timing.day+1)');
    $this->db->where('TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, "00:15:00")');
    $this->db->where('shift_timing.is_working_day', 1);

    $query = $this->db->get();
    // return $query->result();
    $results = $query->result();



    return $results;
  }

  public function get_early_logouts_only_count($params = array())
  {
    $this->db->select('COUNT(*) as count');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("BINARY ue.user_employee_custom_id", $params['user_employee_custom_id']); // Ensure case sensitivity
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }




    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.logout_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['current_day'])) {
      $this->db->where('DATE(ft.logout_time) = DATE(CURDATE())');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.logout_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.logout_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.logout_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.logout_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
      $this->db->where('YEAR(ft.logout_time)', $params['year']);
      $this->db->where('MONTH(ft.logout_time)', $params['month']);
      $this->db->where('DAY(ft.logout_time)', $params['day']);
    }

    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.logout_time)', $params['year']);
      $this->db->where('MONTH(ft.logout_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.logout_time)', $params['year']);
    }

    $this->db->where('ft.logout_time IS NOT NULL');
    $this->db->where('DAYOFWEEK(ft.logout_time) = (shift_timing.day + 1)');
    $this->db->where('TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, "00:15:00")');
    $this->db->where('shift_timing.is_working_day', 1);

    $query = $this->db->get();
    return $query->result();
  }


  public function get_incomplete_logouts($params = array())
  {
    $this->db->select('ue.*');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing as st', 'ue.user_employee_id = st.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("BINARY ue.user_employee_custom_id", $params['user_employee_custom_id']); // Ensure case sensitivity
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }

    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    // Check for empty logout_time
    $this->db->where('ft.logout_time IS NULL');
    $this->db->group_by('ue.user_employee_id');

    $query = $this->db->get();
    $results = $query->result();

    // Loop through results to fetch attendance data
    foreach ($results as $result) {
      $this->db->select('*');
      $this->db->from('attendance');
      $this->db->where('user_employee_id', $result->user_employee_id);
      $this->db->where('logout_time IS NULL');

      if (!empty($params['last_day'])) {
        $this->db->where('DATE(login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
      }
      if (!empty($params['last_month'])) {
        $this->db->where('MONTH(login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
        $this->db->where('YEAR(login_time) = YEAR(CURDATE())');
      }
      if (!empty($params['last_year'])) {
        $this->db->where('YEAR(login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
      }
      if (!empty($params['date_in_ymd'])) {
        $this->db->where('DATE(login_time)', $params['date_in_ymd']);
      }
      if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
        $this->db->where('YEAR(login_time)', $params['year']);
        $this->db->where('MONTH(login_time)', $params['month']);
        $this->db->where('DAY(login_time)', $params['day']);
      }
      if (!empty($params['year']) && !empty($params['month'])) {
        $this->db->where('YEAR(login_time)', $params['year']);
        $this->db->where('MONTH(login_time)', $params['month']);
      }
      if (!empty($params['year'])) {
        $this->db->where('YEAR(login_time)', $params['year']);
      }

      $attendance_query = $this->db->get();
      $result->attendance_data = $attendance_query->result();
    }

    return $results;
  }

  public function get_missed_logouts($params = array())
  {

    if (!empty($params['search_for'])) {
      $this->db->select("count(ft.attendance_id) as counts");
    } else {

      $this->db->select('ft.*, ue.user_employee_id,ue.name,ue.profile_image,ue.contactno,ue.personal_email,ue.user_employee_custom_id');

    }
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    $this->db->where('ft.login_time IS NOT NULL');
    $this->db->where('ft.logout_time IS NULL');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      if ($params['user_employee_record_status'] == 'zero') {
        $this->db->where("ue.status = 0");
      } elseif ($params['user_employee_record_status'] == "1and2") {
        $this->db->where_in("ue.status", [1, 2]);
      } else {
        $this->db->where("ue.status", $params['user_employee_record_status']);
      }
    }

    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where("ft.status = 0"); // Status zero condition
      } else {
        $this->db->where("ft.status", $params['attendance_record_status']); // Specific status condition
      }
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("ue.user_employee_custom_id", $params['user_employee_custom_id']);
    }






    if (!empty($params['current_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE(CURDATE())');
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month'] && !empty($params['day']))) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }



    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day+1)');
    // $this->db->where('shift_timing.is_working_day', 1);

    $query = $this->db->get();
    // return $query->result();
    $results = $query->result();



    return $results;
  }

  public function get_incomplete_logouts_only_count($params = array())
  {
    $this->db->select('COUNT(*) as count');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("BINARY ue.user_employee_custom_id", $params['user_employee_custom_id']); // Ensure case sensitivity
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }

    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    // Check for empty logout_time
    $this->db->where('ft.logout_time IS NULL');

    $query = $this->db->get();
    return $query->result();
  }







  public function get_employees_absent_days_between_dates($params = array())
  {
    $start_date = $params['start_date'];
    $end_date = $params['end_date'];
    $user_employee_id = isset($params['user_employee_id']) ? $params['user_employee_id'] : null;

    // Get all working days between the start and end dates
    $this->db->select('ue.user_employee_id, ue.name, ue.user_employee_custom_id, DATE(st.ideal_login_time) as working_date');
    $this->db->from('user_employee as ue');
    $this->db->join('shift_timing as st', 'ue.user_employee_id = st.user_employee_id');
    $this->db->where('st.is_working_day', 1);
    $this->db->where('DATE(st.l) >=', $start_date);
    $this->db->where('DATE(st.ideal_login_time) <=', $end_date);

    if ($user_employee_id) {
      $this->db->where('ue.user_employee_id', $user_employee_id);
    }

    $working_days = $this->db->get()->result_array();

    // Get all attendance records between the start and end dates
    $this->db->select('user_employee_id, DATE(login_time) as attendance_date');
    $this->db->from('attendance');
    $this->db->where('DATE(login_time) >=', $start_date);
    $this->db->where('DATE(login_time) <=', $end_date);

    if ($user_employee_id) {
      $this->db->where('user_employee_id', $user_employee_id);
    }

    $attendance_records = $this->db->get()->result_array();

    // Create a lookup array for quick access
    $attendance_lookup = [];
    foreach ($attendance_records as $record) {
      $attendance_lookup[$record['user_employee_id']][$record['attendance_date']] = true;
    }

    // Calculate absent days
    $absent_days = [];
    foreach ($working_days as $day) {
      $employee_id = $day['user_employee_id'];
      $working_date = $day['working_date'];

      if (!isset($attendance_lookup[$employee_id][$working_date])) {
        if (!isset($absent_days[$employee_id])) {
          $absent_days[$employee_id] = [
            'user_employee_id' => $employee_id,
            'name' => $day['name'],
            'user_employee_custom_id' => $day['user_employee_custom_id'],
            'absent_count' => 0,
            'absent_dates' => []
          ];
        }
        $absent_days[$employee_id]['absent_count']++;
        $absent_days[$employee_id]['absent_dates'][] = $working_date;
      }
    }

    return array_values($absent_days);
  }

  public function get_employees_absent_on_date($params = array())
  {
    $day_number_from_0 = date('w', strtotime($params['date_dash_ymd']));


    // Step 1: Get all employees who had a working day on the specified date

    $this->db->select('ue.*');


    $this->db->from('user_employee as ue');

    if (!empty($params['user_employee_record_status'])) {
      if ($params['user_employee_record_status'] == 'zero') {
        $this->db->where("ue.status = 0");
      } elseif ($params['user_employee_record_status'] == "1and2") {
        $this->db->where_in("ue.status", [1, 2]);
      } else {
        $this->db->where("ue.status", $params['user_employee_record_status']);
      }
    }


    $this->db->join('shift_timing as st', 'ue.user_employee_id = st.user_employee_id');
    $this->db->where('st.is_working_day', 1);
    $this->db->where('st.day', $day_number_from_0); // DAYOFWEEK returns 1 for Sunday, so subtract 1 for consistency
    $working_day_employees = $this->db->get()->result();

    // Step 2: Get all employees who logged in on the specified date
    $this->db->select('ft.user_employee_id');
    $this->db->from('attendance as ft');
    $this->db->where('DATE(ft.login_time)', $params['date_dash_ymd']);
    $this->db->where('DATE(ft.login_time)', $params['date_dash_ymd']);
    $logged_in_employees = $this->db->get()->result_array();



    // Extract user_employee_id of logged in employees
    $logged_in_employee_ids = array_column($logged_in_employees, 'user_employee_id');


    // Step 3: Filter out employees who did not log in on the specified date
    $absent_employees = array_filter($working_day_employees, function ($employee) use ($logged_in_employee_ids) {
      return !in_array($employee->user_employee_id, $logged_in_employee_ids);
    });

    return $absent_employees;
  }

  public function get_employees_absent_between_dates11($params = array())
  {
    // Ensure dates are in the correct format
    $start_date = $params['start_date'];
    $end_date = $params['end_date'];

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = new DateInterval('P1D'); // 1 day interval
    $period = new DatePeriod($start, $interval, $end->modify('+0 day')); // Include end date

    $missed_logins = [];

    foreach ($period as $date) {
      $date_str = $date->format('Y-m-d');
      $day_number_from_0 = date('w', strtotime($date_str)); // Get the day of the week (0 for Sunday, 6 for Saturday)

      // Step 1: Get all employees who had a working day on the specified date
      $this->db->select('ue.user_employee_id');
      $this->db->from('user_employee as ue');
      $this->db->join('shift_timing as st', 'ue.user_employee_id = st.user_employee_id');
      $this->db->where('st.is_working_day', 1);
      $this->db->where('st.day', $day_number_from_0);
      $working_day_employees = $this->db->get()->result_array();

      $working_employee_ids = array_column($working_day_employees, 'user_employee_id');

      // Step 2: Get all employees who logged in on the specified date
      $this->db->select('user_employee_id');
      $this->db->from('attendance');
      $this->db->where('DATE(login_time)', $date_str);
      $logged_in_employees = $this->db->get()->result_array();

      $logged_in_employee_ids = array_column($logged_in_employees, 'user_employee_id');

      // Step 3: Filter out employees who did not log in on the specified date
      $missed_on_date = array_diff($working_employee_ids, $logged_in_employee_ids);

      foreach ($missed_on_date as $employee_id) {
        if (!isset($missed_logins[$employee_id])) {
          $missed_logins[$employee_id] = 0;
        }
        $missed_logins[$employee_id]++;
      }
    }

    return $missed_logins;

  }

  // public function get_employees_absent_on_date($params = array())
  // {
  //   $day_number_from_0 = date('w', strtotime($params['date_dash_ymd']));

  //   // Step 1: Get all employees who had a working day on the specified date
  //   if (!empty($params['search_for'])) {
  //     $this->db->select("count(ue.user_employee_id) as counts");
  //   } else {
  //     $this->db->select('ue.*');
  //   }

  //   $this->db->from('user_employee as ue');
  //   $this->db->join('shift_timing as st', 'ue.user_employee_id = st.user_employee_id');
  //   $this->db->where('st.is_working_day', 1);
  //   $this->db->where('st.day', $day_number_from_0); // DAYOFWEEK returns 1 for Sunday, so subtract 1 for consistency
  //   $query = $this->db->get();

  //   if (!empty($params['search_for'])) {
  //     $result = $query->row();
  //     return $result->counts; // Return the count if we're only looking for the count
  //   } else {
  //     $working_day_employees = $query->result();
  //   }

  //   // Step 2: Get all employees who logged in on the specified date
  //   $this->db->select('ft.user_employee_id');
  //   $this->db->from('attendance as ft');
  //   $this->db->where('DATE(ft.login_time)', $params['date_dash_ymd']);
  //   $logged_in_employees = $this->db->get()->result_array();

  //   // Extract user_employee_id of logged in employees
  //   $logged_in_employee_ids = array_column($logged_in_employees, 'user_employee_id');

  //   // Step 3: Filter out employees who did not log in on the specified date
  //   $absent_employees = array_filter($working_day_employees, function ($employee) use ($logged_in_employee_ids) {
  //     return !in_array($employee->user_employee_id, $logged_in_employee_ids);
  //   });

  //   return $absent_employees;
  // }

  public function get_missed_attendance_only_count($params = array())
  {
    $this->db->select('COUNT(*) as count');
    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');

    if (!empty($params['user_employee_id'])) {
      $this->db->where("ft.user_employee_id", $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where("ue.status", $params['user_employee_record_status']);
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where("BINARY ue.user_employee_custom_id", $params['user_employee_custom_id']); // Ensure case sensitivity
    }

    if (!empty($params['attendance_record_status'])) {
      $this->db->where("ft.status", $params['attendance_record_status']);
    }

    if (!empty($params['last_day'])) {
      $this->db->where('DATE(ft.login_time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
    }

    if (!empty($params['last_month'])) {
      $this->db->where('MONTH(ft.login_time) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))');
      $this->db->where('YEAR(ft.login_time) = YEAR(CURDATE())');
    }

    if (!empty($params['last_year'])) {
      $this->db->where('YEAR(ft.login_time) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
    }

    if (!empty($params['date_in_ymd'])) {
      $this->db->where('DATE(ft.login_time)', $params['date_in_ymd']);
    }

    if (!empty($params['year']) && !empty($params['month']) && !empty($params['day'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
      $this->db->where('DAY(ft.login_time)', $params['day']);
    }

    if (!empty($params['year']) && !empty($params['month'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
      $this->db->where('MONTH(ft.login_time)', $params['month']);
    }

    if (!empty($params['year'])) {
      $this->db->where('YEAR(ft.login_time)', $params['year']);
    }

    // Check for empty logout_time
    $this->db->where('ft.logout_time IS NULL');

    $query = $this->db->get();
    return $query->result();
  }

  public function get_employees_absent_between_dates($start_date, $end_date)
  {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = new DateInterval('P1D'); // 1 day interval
    $period = new DatePeriod($start, $interval, $end->modify('+1 day')); // Include end date

    $missed_logins = [];

    foreach ($period as $date) {
      $date_str = $date->format('Y-m-d');
      $day_number_from_0 = date('w', strtotime($date_str)); // Get the day of the week (0 for Sunday, 6 for Saturday)

      // Step 1: Get all employees who had a working day on the specified date
      $this->db->select('ue.user_employee_id');
      $this->db->from('user_employee as ue');
      $this->db->join('shift_timing as st', 'ue.user_employee_id = st.user_employee_id');
      $this->db->where('st.is_working_day', 1);
      $this->db->where('st.day', $day_number_from_0);
      $working_day_employees = $this->db->get()->result_array();

      $working_employee_ids = array_column($working_day_employees, 'user_employee_id');

      // Step 2: Get all employees who logged in on the specified date
      $this->db->select('user_employee_id');
      $this->db->from('attendance');
      $this->db->where('DATE(actual_login_time)', $date_str);
      $logged_in_employees = $this->db->get()->result_array();

      $logged_in_employee_ids = array_column($logged_in_employees, 'user_employee_id');

      // Step 3: Filter out employees who did not log in on the specified date
      $missed_on_date = array_diff($working_employee_ids, $logged_in_employee_ids);

      foreach ($missed_on_date as $employee_id) {
        if (!isset($missed_logins[$employee_id])) {
          $missed_logins[$employee_id] = 0;
        }
        $missed_logins[$employee_id]++;
      }
    }

    return $missed_logins;
  }

  public function get_attendance_report111($params = array())
  {
    $start_date = $params['start_date'];
    $end_date = $params['end_date'];

    // Get missed logins data
    $missed_logins = $this->get_employees_absent_between_dates($start_date, $end_date);

    $this->db->select("
        DATE_FORMAT('$start_date', '%d/%m/%Y') AS from_date,
        DATE_FORMAT('$end_date', '%d/%m/%Y') AS to_date,
        ue.user_employee_id,
        ue.name,
        ue.profile_image,
        ue.contactno,
        ue.personal_email,
        ue.user_employee_custom_id,
        COUNT(CASE WHEN TIME(ft.login_time) > ADDTIME(shift_timing.login_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) as late_logins_count,
        COUNT(CASE WHEN TIME(ft.logout_time) < SUBTIME(shift_timing.logout_time, '00:15:00') THEN ft.attendance_id ELSE NULL END) as early_logouts_count,
        SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, ft.login_time, ft.logout_time))) as total_work_time,
        IFNULL(missed_logins_count.missed_logins, 0) AS missed_logins_count
    ");

    $this->db->from('attendance as ft');
    $this->db->join('user_employee as ue', 'ft.user_employee_id = ue.user_employee_id');
    $this->db->join('shift_timing', 'ue.user_employee_id = shift_timing.user_employee_id');

    $this->db->join("(SELECT user_employee_id, COUNT(*) AS missed_logins 
                      FROM (
                          SELECT ue.user_employee_id
                          FROM user_employee AS ue
                          JOIN shift_timing AS st ON ue.user_employee_id = st.user_employee_id
                          WHERE st.is_working_day = 1
                          AND DATE_FORMAT(CONCAT('2023-', st.day, '-01'), '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                      ) AS missed_days
                      LEFT JOIN attendance AS a ON missed_days.user_employee_id = a.user_employee_id
                      AND DATE(a.login_time) = DATE_FORMAT(CONCAT('2023-', st.day, '-01'), '%Y-%m-%d')
                      WHERE a.user_employee_id IS NULL
                      GROUP BY user_employee_id
                      ) AS missed_logins_count", 'ue.user_employee_id = missed_logins_count.user_employee_id', 'left');

    $this->db->where('ft.login_time IS NOT NULL');

    if (!empty($params['user_employee_id'])) {
      $this->db->where('ft.user_employee_id', $params['user_employee_id']);
    }

    if (!empty($params['user_employee_record_status'])) {
      $this->db->where('ue.status', $params['user_employee_record_status']);
    }

    if (!empty($params['attendance_record_status'])) {
      if ($params['attendance_record_status'] == 'zero') {
        $this->db->where('ft.status', 0);
      } else {
        $this->db->where('ft.status', $params['attendance_record_status']);
      }
    }

    if (!empty($params['user_employee_custom_id'])) {
      $this->db->where('ue.user_employee_custom_id', $params['user_employee_custom_id']);
    }

    if (!empty($params['start_date']) && !empty($params['end_date'])) {
      $this->db->where('ft.login_time >=', $params['start_date']);
      $this->db->where('ft.login_time <=', $params['end_date']);
    }

    $this->db->where('DAYOFWEEK(ft.login_time) = (shift_timing.day + 1)');
    $this->db->where('shift_timing.is_working_day', 1);

    $this->db->group_by('ue.user_employee_id');

    $query = $this->db->get();
    $results = $query->result();

    return $results;
  }





}

?>