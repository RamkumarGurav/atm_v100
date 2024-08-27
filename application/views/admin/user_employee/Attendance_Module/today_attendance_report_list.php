<?php

$page_module_name = "Today's Employee Attendance Report";


?>
<style>
  .dropdown-search {
    position: relative;
  }

  .dropdown-search input {
    width: 100%;
    box-sizing: border-box;
  }

  .dropdown-menu {
    width: 100%;
    box-sizing: border-box;
  }
</style>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $page_module_name ?> <small>List</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= MAINSITE_Admin . "wam" ?>">Home</a></li>
            <li class="breadcrumb-item"><a
                href="<?= MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name ?>"><?= $user_access->module_name ?>
                List</a></li>
            <li class="breadcrumb-item active"><?= $page_module_name ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <? ?>
  <section class="content">
    <div class="row">
      <div class="col-12">



        <div class="card">

          <div class="card-header">
            <h3 class="card-title"><span style="color:#FF0000;">Total Records:
                <?php echo $row_count; ?></span></h3>
            <div class="float-right">
              <?php
              if ($user_access->add_module == 1 && false) {
                ?>
                <a href="<?= MAINSITE_Admin . $user_access->class_name ?>/attendance-edit">
                  <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                    New</button></a>
              <? } ?>
              <?php
              if ($user_access->update_module == 1 && false) {
                ?>
                <button type="button" class="btn btn-success btn-sm" onclick="validateRecordsActivate()"><i
                    class="fas fa-check"></i> Active</button>
                <button type="button" class="btn btn-dark btn-sm" onclick="validateRecordsBlock()"><i
                    class="fas fa-ban"></i> Block</button>
              <? } ?>
              <?php
              if ($user_access->export_data == 1) {
                ?>
                <a href="<? echo MAINSITE_Admin . $user_access->class_name . "/today_attendance_report_list_export"; ?>"
                  target="_blank" type="button" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i>
                  Export</a>
              <? } ?>
            </div>
          </div>
          <!-- /.card-header -->
          <?php
          if ($user_access->view_module == 1) {
            ?>
            <div class="card-body">

              <?php echo form_open(MAINSITE_Admin . "$user_access->class_name/attendance-doUpdateStatus", array('method' => 'post', 'id' => 'ptype_list_form', "name" => "ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
              <input type="hidden" name="task" id="task" value="" />
              <? echo $this->session->flashdata('alert_message'); ?>
              <table id="example1" class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Emp ID</th>
                    <th>Emp Name</th>
                    <!-- <th>Branch</th> -->
                    <th>Contact No.</th>
                    <th>is Present?</th>
                    <!--   <th>Department</th>
                    <th>Designation</th> -->
                    <th>Logged in Time</th>
                    <th>Late Login By</th>
                    <th>Logged Out Time</th>
                    <th>Early Logout By</th>
                    <th>Total Worked Time</th>
                  </tr>
                </thead>
                <? if (!empty($user_employee_data)) { ?>
                  <tbody>
                    <?
                    $offset_val = (int) $this->uri->segment(5);

                    $count = $offset_val;

                    foreach ($user_employee_data as $item) {
                      $count++;
                      ?>
                      <tr>
                        <td><?= $count ?>.</td>

                        <td>
                          <?php if (!empty($item->user_employee_custom_id)): ?>
                            <a class="text-bold text-primary "
                              href="<?= MAINSITE_Admin . "user_employee/User-Employee-Module/view/" . $item->user_employee_id ?>"><?= $item->user_employee_custom_id ?></a>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($item->name)): ?>
                            <?= $item->name; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>

                        <!-- <td>
                          <?php if (!empty($item->branch_name)): ?>
                            <?= $item->branch_name; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td> -->
                        <td>
                          <?php if (!empty($item->contactno)): ?>
                            <?= $item->contactno; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <!-- <td>
                          <?php if (!empty($item->department_name)): ?>
                            <?= $item->department_name; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($item->designation_name)): ?>
                            <?= $item->designation_name; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td> -->
                        <td>
                          <?php if (!empty($item->attendance_data_list[0]->data_present)): ?>
                            <span class="badge badge-success">Yes</span>
                          <?php else: ?>
                            <span class="badge badge-danger">No</span>
                          <?php endif; ?>

                        </td>
                        <td>
                          <?php if (!empty($item->attendance_data_list[0]->data_present)): ?>
                            <a class="text-bold text-primary "
                              href="<?= MAINSITE_Admin . $user_access->class_name . "/attendance_view/" . $item->attendance_data_list[0]->attendance_id ?>">
                              <?= (new DateTime($item->attendance_data_list[0]->login_time))->format("\A\\t h:i A \O\\n d-F-Y"); ?>
                            </a>

                          <?php else: ?>
                            N/A
                          <?php endif; ?>

                        </td>
                        <td>
                          <?php if (!empty($item->attendance_data_list[0]->data_present)): ?>
                            <?php if (!empty($item->attendance_data_list[0]->late_login_by)): ?>
                              <?php

                              list($hours, $minutes, $seconds) = explode(':', $item->attendance_data_list[0]->late_login_by);


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
                          <?php if (!empty($item->attendance_data_list[0]->data_present)): ?>
                            <?php if (!empty($item->attendance_data_list[0]->logout_time)): ?>
                              <?= (new DateTime($item->attendance_data_list[0]->logout_time))->format("\A\\t h:i A \O\\n d-F-Y"); ?>
                            <?php else: ?>
                              <span class="badge badge-danger">Waiting..</span>
                            <?php endif; ?>
                          <?php else: ?>
                            N/A
                          <?php endif; ?>

                        </td>
                        <td>
                          <?php if (!empty($item->attendance_data_list[0]->data_present)): ?>
                            <?php if (!empty($item->attendance_data_list[0]->early_logout_by)): ?>
                              <?php

                              list($hours, $minutes, $seconds) = explode(':', $item->attendance_data_list[0]->early_logout_by);


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
                          <?php if (!empty($item->attendance_data_list[0]->data_present)): ?>
                            <?php if (!empty($item->attendance_data_list[0]->logout_time)): ?>
                              <?php

                              list($hours, $minutes, $seconds) = explode(':', $item->attendance_data_list[0]->total_actual_worked_time);


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



                      </tr>
                    <? } ?>
                  </tbody>
                <? } ?>
              </table>
              <?php echo form_close() ?>
              <center>
                <div class="pagination_custum"><? echo $this->pagination->create_links(); ?></div>
              </center>
            </div>
          <? } else {
            $this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
            $this->load->view('admin/template/access_denied', $this->data);
          } ?>
          <!-- /.card-body -->
        </div>
      </div>
    </div>


  </section>
  <? ?>
</div>

<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>

<script type="application/javascript">


  function check_uncheck_All_records() // done
  {
    var mainCheckBoxObj = document.getElementById("main_check");
    var checkBoxObj = document.getElementsByName("sel_recds[]");

    for (var i = 0; i < checkBoxObj.length; i++) {
      if (mainCheckBoxObj.checked)
        checkBoxObj[i].checked = true;
      else
        checkBoxObj[i].checked = false;
    }
  }

  function validateCheckedRecordsArray() // done
  {
    var checkBoxObj = document.getElementsByName("sel_recds[]");
    var count = true;

    for (var i = 0; i < checkBoxObj.length; i++) {
      if (checkBoxObj[i].checked) {
        count = false;
        break;
      }
    }

    return count;
  }

  function validateRecordsActivate() // done
  {
    if (validateCheckedRecordsArray()) {
      //alert("Please select any record to activate.");
      toastrDefaultErrorFunc("Please select any record to activate.");
      document.getElementById("sel_recds1").focus();
      return false;
    } else {
      document.ptype_list_form.task.value = 'active';
      document.ptype_list_form.submit();
    }
  }

  function validateRecordsBlock() // done
  {
    if (validateCheckedRecordsArray()) {
      //alert("Please select any record to block.");
      toastrDefaultErrorFunc("Please select any record to block.");
      document.getElementById("sel_recds1").focus();
      return false;
    } else {
      document.ptype_list_form.task.value = 'block';
      document.ptype_list_form.submit();
    }
  }
</script>

<script>

  window.addEventListener('load', function () {

    $(".paginationClass").click(function () {
      // console.log($(this).data('ci-pagination-page'));
      // console.log($(this));
      // console.log($(this).attr('href'));//alert();
      //alert(this.data('ci-pagination-page'));
      $('#search_report_form').attr('action', $(this).attr('href'));
      $('#search_report_form').submit();
      return false;
    });
    $('#reservationdate').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#reservationdate1').datetimepicker({
      format: 'DD-MM-YYYY'
    });

    $(".export_excel").bind("click", function () {

      console.log("export_excel");

      $('#search_report_form').attr('action', '<? echo MAINSITE_Admin . $user_access->class_name . "/today_attendance_report_list_export"; ?>');
      $('#search_report_form').attr('target', '_blank');
      $('#search_report_btn').click();

      $('#search_report_form').attr('action', '<? echo MAINSITE_Admin . $user_access->class_name . "/today_attendance_report_list" ?>');
      $('#search_report_form').attr('target', '');
    })



  })

</script>