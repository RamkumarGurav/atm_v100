<?php

$page_module_name = "Empoyee Attendance Report";

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
        <div id="accordion">
          <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
          <div class="card card-warning">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="false">
                  Filter Panel
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" style="">
              <div class="card-body">

                <?php echo form_open(MAINSITE_Admin . "$user_access->class_name" . "/attendance-report-list", array('method' => 'post', 'id' => 'search_report_form', "name" => "search_report_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Field</label>
                        <select name="field_name" id="field_name" class="form-control" style="width: 100%;">
                          <option value='urm.name' <? if ($field_name == 'urm.name') {
                            echo 'selected';
                          } ?>>
                            Employee Name</option>
                          <option value='urm.user_employee_custom_id' <? if ($field_name == 'urm.user_employee_custom_id') {
                            echo 'selected';
                          } ?>>
                            Employee ID</option>

                        </select>

                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Field Value</label>
                        <input type="text" name="field_value" id="field_value" placeholder="Field Value"
                          style="width: 100%;" class="form-control" value="<?= $field_value ?>">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Branch Name</label>
                        <select type="text" class="form-control" id="branch_id" name="branch_id" style="width: 100%;">
                          <option value="">Select Branch</option>
                          <? foreach ($branch_data as $item) {
                            $selected = "";
                            if ($item->branch_id == $branch_id) {
                              $selected = "selected";
                            }
                            ?>
                            <option value="<?= $item->branch_id ?>" <?= $selected ?>>
                              <?= $item->branch_name ?>
                              <? if ($item->status != 1) {
                                echo " [Block]";
                              } ?>
                            </option>
                          <? } ?>
                        </select>

                      </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Department Name</label>
                        <select type="text" class="form-control" id="department_id" name="department_id"
                          style="width: 100%;">
                          <option value="">Select Department</option>
                          <? foreach ($department_data as $item) {
                            $selected = "";
                            if ($item->department_id == $department_id) {
                              $selected = "selected";
                            }
                            ?>
                            <option value="<?= $item->department_id ?>" <?= $selected ?>>
                              <?= $item->department_name ?>
                              <? if ($item->status != 1) {
                                echo " [Block]";
                              } ?>
                            </option>
                          <? } ?>
                        </select>

                      </div>

                    </div>
                    <!-- <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="user_employee_search">Employee ID</label>
                                                <div class="dropdown-search">
                                                    <input type="text" class="form-control" id="user_employee_search"
                                                        placeholder="Search Employee ID">
                                                    <div class="dropdown-menu" id="user_employee_dropdown"
                                                        aria-labelledby="user_employee_search">

                                                        <?php foreach ($user_employee_data_for_dropdown as $item) { ?>
                                                            <a class="dropdown-item" href="#"
                                                                data-value="<?= $item->user_employee_custom_id ?>">
                                                                <?= $item->user_employee_custom_id ?>     <?php if ($item->status != 1)
                                                                         echo " [Block]"; ?>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                    <input type="hidden" id="user_employee_custom_id"
                                                        name="user_employee_custom_id">
                                                </div>
                                            </div>
                                        </div> -->
                  </div>

                  <div class="row">


                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Designation Name</label>
                        <select type="text" class="form-control" id="designation_id" name="designation_id"
                          style="width: 100%;">
                          <option value="">Select Designation</option>
                          <? foreach ($designation_data as $item) {
                            $selected = "";
                            if ($item->designation_id == $designation_id) {
                              $selected = "selected";
                            }
                            ?>
                            <option value="<?= $item->designation_id ?>" <?= $selected ?>>
                              <?= $item->designation_name ?>
                              <? if ($item->status != 1) {
                                echo " [Block]";
                              } ?>
                            </option>
                          <? } ?>
                        </select>

                      </div>
                    </div>
                    <!-- <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Login Date</label>
                                                <div class="input-group date reservationdate" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="text" value="<?= $login_date ?>" name="login_date"
                                                        id="login_date" placeholder="Login Date" style="width: 100%;"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#reservationdate" />
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Logout Date</label>

                                                <div class="input-group date reservationdate" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="text" value="<?= $logout_date ?>" name="logout_date"
                                                        id="logout_date" placeholder="Logout Date" style="width: 100%;"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#reservationdate" />
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> -->

                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Start Date</label>
                        <div class="input-group date reservationdate" id="reservationdate" data-target-input="nearest">
                          <input type="text" value="<?= $start_date ?>" name="start_date" id="start_date"
                            placeholder="Start Date" style="width: 100%;" class="form-control datetimepicker-input"
                            data-target="#reservationdate" />
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>End Date</label>
                        <div class="input-group date reservationdate1" id="reservationdate1"
                          data-target-input="nearest">
                          <input type="text" value="<?= $end_date ?>" name="end_date" id="end_date"
                            placeholder="End Date" style="width: 100%;" class="form-control datetimepicker-input"
                            data-target="#reservationdate1" />
                          <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <!-- <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Attendance Status</label>
                        <select name="record_status" id="record_status" class="form-control" style="width: 100%;">
                          <option value=''>Active / Block</option>
                          <option value='1' <? if ($record_status == 1) {
                            echo 'selected';
                          } ?>>
                            Active</option>
                          <option value='zero' <? if ($record_status == 'zero') {
                            echo 'selected';
                          } ?>>Block</option>
                        </select>

                      </div>
                    </div> -->

                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Emlpoyee Status</label>
                        <select name="record_status" id="record_status" class="form-control" style="width: 100%;">
                          <!-- <option value=''>Active / Temp Block / Block</option> -->
                          <option value='1' <? if ($record_status == 1) {
                            echo 'selected';
                          } ?>>
                            Active</option>
                          <option value='2' <? if ($record_status == 2) {
                            echo 'selected';
                          } ?>>Temp Block
                          </option>
                          <option value='1and2' <? if ($record_status == "1and2") {
                            echo 'selected';
                          } ?>>Active / Temp Block
                          </option>
                          <option value='zero' <? if ($record_status == 'zero') {
                            echo 'selected';
                          } ?>>Block</option>

                        </select>

                      </div>
                    </div>

                  </div>


                  <div class="row">

                  </div>


                  <div class="row">



                    <!-- /.col -->

                  </div>


                </div>
                <div class="panel-footer">
                  <center>
                    <button type="submit" class="btn btn-info" id="search_report_btn" name="search_report_btn"
                      value="1">Filter</button>
                    <!-- <button type="submit" class="btn btn-warning" id="search_report_download_btn"
                      name="search_report_download_btn" value="1">Generate Report</button> -->
                    &nbsp;&nbsp;<button type="reset" class="btn btn-default">Reset</button>
                  </center>
                </div>
                <?php echo form_close() ?>
              </div>
            </div>
          </div>

        </div>


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
                <button type="button" class="btn btn-success btn-sm export_excel"><i class="fas fa-file-excel"></i>
                  Export</button>
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
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Emp ID</th>
                    <th>Emp Name</th>

                    <th>Branch</th>
                    <!--   <th>Department</th>
                    <th>Designation</th> -->
                    <th>Attendance</th>
                    <th>Total Worked Time</th>
                    <th>Late Logins</th>
                    <th>Early Logouts</th>
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
                          <?php if (!empty($start_date)): ?>
                            <?= $start_date; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($end_date)): ?>
                            <?= $end_date; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
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

                        <td>
                          <?php if (!empty($item->branch_name)): ?>
                            <?= $item->branch_name; ?>
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
                          <?php if (!empty($item->attendance_data->total_actual_worked_days)): ?>
                            <?= $item->attendance_data->total_actual_worked_days; ?>
                          <?php else: ?>
                            0
                          <?php endif; ?>

                        </td>
                        <td>

                          <?php

                          list($hours, $minutes, $seconds) = explode(':', $item->attendance_data->total_actual_worked_time);


                          $formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

                          echo $formatted_time;
                          ?>
                        </td>
                        <td>
                          <?= $item->attendance_data->total_late_logins; ?>
                        </td>
                        <td>
                          <?= $item->attendance_data->total_early_logouts; ?>
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

      $('#search_report_form').attr('action', '<? echo MAINSITE_Admin . $user_access->class_name . "/attendance_report_list_export"; ?>');
      $('#search_report_form').attr('target', '_blank');
      $('#search_report_btn').click();

      $('#search_report_form').attr('action', '<? echo MAINSITE_Admin . $user_access->class_name . "/attendance_report_list" ?>');
      $('#search_report_form').attr('target', '');
    })



  })

</script>