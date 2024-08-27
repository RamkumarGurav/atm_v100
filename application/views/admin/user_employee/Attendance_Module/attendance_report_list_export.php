<?php


$filename = "Employee-Atendance-Report-" . date('d-m-Y') . ".xls";
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
							<th style="background-color:#999" width="*">Sl. No.</th>
							<th style="background-color:#999" width="*">Start Date</th>
							<th style="background-color:#999" width="*">End Date</th>
							<th style="background-color:#999" width="*">Employee Name</th>
							<th style="background-color:#999" width="*">Employee ID</th>
							<th style="background-color:#999" width="*">Branch</th>
							<th style="background-color:#999" width="*">Department</th>
							<th style="background-color:#999" width="*">Designation</th>
							<th style="background-color:#999" width="*">Email Id</th>
							<th style="background-color:#999" width="*">Mobile No</th>
							<th style="background-color:#999" width="*">Total Days</th>
							<th style="background-color:#999" width="*">Expected Attendance</th>
							<th style="background-color:#999" width="*">Actual Attendance</th>
							<th style="background-color:#999" width="*">Missed Attendance</th>
							<th style="background-color:#999" width="*">Expected Work Time</th>
							<th style="background-color:#999" width="*">Actual Worked Time</th>
							<th style="background-color:#999" width="*">Late Logins</th>
							<th style="background-color:#999" width="*">Early Logouts</th>
							<th style="background-color:#999" width="*">Employee Status</th>
						</tr>
						<tr>
							<td width="*"><?php echo $count; ?></td>

							<td width="*" style="mso-number-format:'\@'"><?= date("d/m/Y", strtotime($start_date)) ?></td>
							<td width="*" style="mso-number-format:'\@'"><?= date("d/m/Y", strtotime($end_date)) ?></td>
							<td width="*"><?php echo $row->name; ?></td>

							<td width="*"><?php echo $row->user_employee_custom_id; ?></td>




							<td width="*"><?php echo $row->branch_name; ?></td>
							<td width="*"><?php echo $row->department_name; ?></td>
							<td width="*"><?php echo $row->designation_name; ?></td>
							<td width="*"><?php echo $row->personal_email; ?></td>
							<td width="*"><?php echo $row->contactno; ?></td>
							<td width="*"> <?php if (!empty($row->attendance_data->total_days)): ?>
									<?= $row->attendance_data->total_days; ?>
								<?php else: ?>
									0
								<?php endif; ?>
							</td>
							<td width="*"> <?php if (!empty($row->attendance_data->total_expected_worked_days)): ?>
									<?= $row->attendance_data->total_expected_worked_days; ?>
								<?php else: ?>
									0
								<?php endif; ?>
							</td>
							<td width="*"> <?php if (!empty($row->attendance_data->total_actual_worked_days)): ?>
									<?= $row->attendance_data->total_actual_worked_days; ?>
								<?php else: ?>
									0
								<?php endif; ?>
							</td>
							<td width="*"> <?php if (!empty($row->attendance_data->total_absent_days)): ?>
									<?= $row->attendance_data->total_absent_days; ?>
								<?php else: ?>
									0
								<?php endif; ?>
							</td>
							<td width="*">
								<?php

								list($hours, $minutes, $seconds) = explode(':', $row->attendance_data->total_expected_worked_time);


								$formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

								echo $formatted_time;
								?>
							</td>
							<td width="*">
								<?php

								list($hours, $minutes, $seconds) = explode(':', $row->attendance_data->total_actual_worked_time);


								$formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

								echo $formatted_time;
								?>
							</td>
							<td width="*"> <?= $row->attendance_data->total_late_logins; ?></td>
							<td width="*"> <?= $row->attendance_data->total_early_logouts; ?></td>
							<td width="*">
								<?php if ($row->status == 1) { ?> Active
								<?php } else { ?>Block
								<?php } ?>
							</td>

						</tr>
						<tr>
							<th style="background-color:#999777" width="*"></th>
							<th style="background-color:#999777" width="*">Sl. No.</th>
							<th style="background-color:#999777" width="*">Attendance Date</th>
							<th style="background-color:#999777" width="*">Day Type</th>
							<th style="background-color:#999777" width="*">Login Time</th>
							<th style="background-color:#999777" width="*">Logout Time</th>
							<th style="background-color:#999777" width="*">Expected Work Time</th>
							<th style="background-color:#999777" width="*">Actual Worked Time</th>
						</tr>



						<?php
						$a_count = 0;
						// echo "count : ".count($ptype_list)." <br>";
						if (!empty($row->attendance_data_list)) { //print_r($ptype_list);
							foreach ($row->attendance_data_list as $item) {
								//if($row->in_hand > 0 || $row->total_purchase > 0 || $row->total_sold > 0 || $row->total_returned > 0 || $row->to_receive > 0 )
								{
									$a_count++;


									?>

									<tr>
										<td width="*"></td>
										<td width="*"><?php echo $a_count; ?></td>
										<td width="*" style="mso-number-format:'\@'"><?= date("d/m/Y", strtotime($item->date)) ?></td>
										<td width="*">

											<?php if (!empty($item->data_present)): ?>
												<?php if (!empty($item->is_working_day)): ?>
													Working Day
												<?php else: ?>
													Extra Working Day
												<?php endif; ?>
											<?php else: ?>
												<?php if (!empty($item->is_working_day)): ?>
													Leave Day
												<?php else: ?>
													Holiday
												<?php endif; ?>
											<?php endif; ?>

										</td>
										<td width="*" style="mso-number-format:'\@'"> <?php if (!empty($item->login_time)): ?>
												<?= (new DateTime($item->login_time))->format("\A\\t h:i A \O\\n d/m/Y"); ?>
											<?php else: ?>
												N/A
											<?php endif; ?>
										</td>
										<td width="*" style="mso-number-format:'\@'"> <?php if (!empty($item->logout_time)): ?>
												<?= (new DateTime($item->logout_time))->format("\A\\t h:i A \O\\n d/m/Y"); ?>
											<?php else: ?>
												N/A
											<?php endif; ?>
										</td>
										<td width="*">
											<?php if (!empty($item->data_present)): ?>
												<?php

												list($hours, $minutes, $seconds) = explode(':', $item->total_expected_worked_time);


												$formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

												echo $formatted_time;
												?>
											<?php else: ?>
												N/A
											<?php endif; ?>
										</td>
										<td width="*">
											<?php if (!empty($item->data_present && !empty($item->logout_time))): ?>

												<?php

												list($hours, $minutes, $seconds) = explode(':', $item->total_actual_worked_time);


												$formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

												echo $formatted_time;
												?>
											<?php else: ?>
												N/A
											<?php endif; ?>
										</td>

									</tr>


								<?php }
							} ?>


						<?php } else { ?>
							<tr>
								<th colspan="<?php echo $colspan ?>">No records to display...</th>
							</tr>

						<?php } ?>







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