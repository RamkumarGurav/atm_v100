<?php


$filename = "Todays-Employee-Atendance-Report-" . date('d-m-Y') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");

header("Content-Type: application/vnd.ms-excel");
//print_r($user_employee_data);

?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Employee Attendance Report</title>

</head>



<body>
  <?php
  $colspan = 8;
  ?>
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <thead>



    </thead>
    <tbody>
      <tr>
        <th style="background-color:#999" width="*">Sl. No.</th>
        <th style="background-color:#999" width="*">Date</th>
        <th style="background-color:#999" width="*">Employee Name</th>
        <th style="background-color:#999" width="*">Employee ID</th>
        <th style="background-color:#999777" width="*">Day Type</th>
        <th style="background-color:#999" width="*">Is Present?</th>
        <th style="background-color:#999" width="*">Logged in Time</th>
        <th style="background-color:#999" width="*">Late Login By</th>
        <th style="background-color:#999" width="*">Logged Out Time</th>
        <th style="background-color:#999" width="*">Early Logout By</th>
        <th style="background-color:#999777" width="*">Expected Work Time</th>
        <th style="background-color:#999" width="*">Total Worked Time</th>
        <th style="background-color:#999" width="*">Branch</th>
        <th style="background-color:#999" width="*">Department</th>
        <th style="background-color:#999" width="*">Designation</th>
        <th style="background-color:#999" width="*">Email Id</th>
        <th style="background-color:#999" width="*">Mobile No</th>
        <th style="background-color:#999" width="*">Employee Status</th>
      </tr>
      <?php
      $count = 0;
      // echo "count : ".count($ptype_list)." <br>";
      if (!empty($user_employee_data)) { //print_r($ptype_list);
        foreach ($user_employee_data as $row) {
          //if($row->in_hand > 0 || $row->total_purchase > 0 || $row->total_sold > 0 || $row->total_returned > 0 || $row->to_receive > 0 )
          {
            $count++;


            ?>

            <tr>
              <td width="*"><?php echo $count; ?></td>

              <td width="*" style="mso-number-format:'\@'"><?= date("d/m/Y", strtotime($start_date)) ?></td>
              <td width="*"><?php echo $row->name; ?></td>

              <td width="*"><?php echo $row->user_employee_custom_id; ?></td>
              <td width="*">
                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>
                  <?php if (!empty($row->attendance_data_list[0]->is_working_day)): ?>
                    Working Day
                  <?php else: ?>
                    Extra Working Day
                  <?php endif; ?>
                <?php else: ?>
                  <?php if (!empty($row->attendance_data_list[0]->is_working_day)): ?>
                    Leave Day
                  <?php else: ?>
                    Holiday
                  <?php endif; ?>
                <?php endif; ?>

              </td>
              <td width="*">

                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>
                  Yes
                <?php else: ?>
                  No
                <?php endif; ?>
              </td>
              <td>
                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>

                  <?= (new DateTime($row->attendance_data_list[0]->login_time))->format("\A\\t h:i A \O\\n d-F-Y"); ?>


                <?php else: ?>
                  N/A
                <?php endif; ?>

              </td>
              <td>
                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>
                  <?php if (!empty($row->attendance_data_list[0]->late_login_by)): ?>
                    <?php

                    list($hours, $minutes, $seconds) = explode(':', $row->attendance_data_list[0]->late_login_by);


                    $formatted_time = "{$hours}Hr:{$minutes}Min";

                    echo $formatted_time;
                    ?>
                  <?php else: ?>
                    N/A
                  <?php endif; ?>

                <?php else: ?>
                  N/A
                <?php endif; ?>

              </td>
              <td>
                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>
                  <?php if (!empty($row->attendance_data_list[0]->logout_time)): ?>
                    <?= (new DateTime($row->attendance_data_list[0]->logout_time))->format("\A\\t h:i A \O\\n d-F-Y"); ?>
                  <?php else: ?>
                    Waiting..
                  <?php endif; ?>
                <?php else: ?>
                  N/A
                <?php endif; ?>

              </td>
              <td>
                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>
                  <?php if (!empty($row->attendance_data_list[0]->early_logout_by)): ?>
                    <?php

                    list($hours, $minutes, $seconds) = explode(':', $row->attendance_data_list[0]->early_logout_by);


                    $formatted_time = "{$hours}Hr:{$minutes}Min";

                    echo $formatted_time;
                    ?>
                  <?php else: ?>
                    N/A
                  <?php endif; ?>

                <?php else: ?>
                  N/A
                <?php endif; ?>

              </td>
              <td>
                <?php if (!empty($row->data_present)): ?>
                  <?php

                  list($hours, $minutes, $seconds) = explode(':', $row->total_expected_worked_time);


                  $formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

                  echo $formatted_time;
                  ?>
                <?php else: ?>
                  N/A
                <?php endif; ?>
              </td>
              <td>
                <?php if (!empty($row->attendance_data_list[0]->data_present)): ?>
                  <?php if (!empty($row->attendance_data_list[0]->logout_time)): ?>
                    <?php

                    list($hours, $minutes, $seconds) = explode(':', $row->attendance_data_list[0]->total_actual_worked_time);


                    $formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

                    echo $formatted_time;
                    ?>
                  <?php else: ?>
                    N/A
                  <?php endif; ?>
                <?php else: ?>
                  N/A
                <?php endif; ?>

              </td>


              <td width="*"><?php echo $row->branch_name; ?></td>
              <td width="*"><?php echo $row->department_name; ?></td>
              <td width="*"><?php echo $row->designation_name; ?></td>
              <td width="*"><?php echo $row->personal_email; ?></td>
              <td width="*"><?php echo $row->contactno; ?></td>


              <td width="*">
                <?php if ($row->status == 1) { ?> Active
                <?php } else { ?>Block
                <?php } ?>
              </td>

            </tr>












          <?php }
        } ?>


      <?php } else { ?>
        <tr>
          <th colspan="<?php echo $colspan ?>">No records to display...</th>
        </tr>

      <?php } ?>
    </tbody>

  </table>



</body>

</html>