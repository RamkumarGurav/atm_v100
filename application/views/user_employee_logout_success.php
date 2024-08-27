<style>
  .container {
    padding: 2rem 0;
  }

  p.ppyt i {
    padding-right: 10px;
    color: #feaa27;
  }

  strong {
    color: #bf790c;
    font-size: 15px;
  }

 

  .card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    overflow: hidden;
  }

  .work-header {
    /* background: linear-gradient(to right, #00c33c, #00f33f); */
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    font-size: 18px;
    color: black;
    border-bottom: none;
    padding: .4rem;
  }

  .card-header {
    background: linear-gradient(to right, #00474c, #4d8e82);
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-bottom: none;
    padding: 1rem;
  }

  .form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
  }

  .btn-primary {
    background: linear-gradient(to right, #00474c, #4d8e82);
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 2rem;
    font-weight: bold;
    letter-spacing: 0.05em;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
  }

  .employee-details {
    background: white;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  }

  .profile-pic {
    width: 115px;
    height: 114px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 1rem;
    border: 3px solid #fdab2d;
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
  }

  .employee-info h4 {
    color: #422b07;
    margin-bottom: 1rem;
    font-weight: 600;
    font-size: 21px;
  }

  .employee-info p {
    font-size: 15px;
    margin-bottom: 0.5rem;
    border-bottom: 1px solid #0000002e;
  }
</style>
<style>
  #msg {
    color: #808080;
    font-weight: lighter;
  }

  #wrapper {
    /* display: none; */
  }

  button:disabled {
    background: #ccc;
  }

  canvas,
  video {
    background-color: #eee;
    max-width: 100%;
  }

  h3.tt.text-center.mb-4 {
    font-size: 20px;
    margin-bottom: 8px;
  }

  input[type="text"],
  input[type="password"] {
    padding: 5px;
    margin: 5px;
  }

  .img-widnew img {
    width: 100%;
  }

  h3.ttcen {
    text-align: center;
    padding-bottom: 30px;
    font-weight: 600;
    color: #444444;
    font-size: 30px;
    position: relative;
    left: 130px;
    top: 77px;
  }

  h3.lg-ss {
    text-align: center;
    /* padding-bottom: 25px; */
    font-weight: 600;
    position: relative;
    top: 13px;
  }

  .disfle {
    display: flex;
    gap: 10px;
    position: relative;
    left: 34%;
  }

  div#newform_wrapper {
    margin-top: 10px;
  }
</style>
<div class="d-flex justify-content-center align-items-center px-4 ">
  <div class=" d-flex justify-content-center align-items-center  px-2 rounded">
    <i class="fa-solid fa-circle-check" style="font-size:30px;"></i>
    <span class="text-lg ml-2" style="font-size:30px;"> SUCCESSFUL LOGOUT</span>
  </div>
</div>
<div class="container" style="padding-top:15px;">
  <!-- <div>
    <div class="disfle">
      <img class="new" src="<?= IMAGE ?>password.png" alt="">
      <h3 class="lg-ss"> Successfull Logout</h3>
    </div>

  </div> -->

  <div class="row d-flex justify-content-center ">
    <div class="col-lg-4">
      <div class="employee-details">
        <h3 class="tt text-center mb-4">Employee Details</h3>
        <img src="<?= _uploaded_files_ . 'user_employee/profile_image/' . $attendance_data->profile_image ?>"
          alt="<?= $attendance_data->name ?>'s Profile" class="profile-pic d-block">

        <div class="employee-info mt-4">
          <h4 class="text-center"><?= $attendance_data->name ?></h4>
          <p class="ppyt"><i class="fa-solid fa-building"></i><strong>Branch:</strong>
            <?= $user_employee_data->branch_name ?></p>
          <p class="ppyt"><i class="fa-solid fa-briefcase"></i><strong>Department:</strong>
            <?= $user_employee_data->department_name ?></p>
          <p class="ppyt"><i class="fa-solid fa-user"></i><strong>Designation:</strong>
            <?= $user_employee_data->designation_name ?></p>
          <p class="ppyt"><i class="fa-regular fa-calendar"></i><strong>Date of Birth:</strong>
            <?= date("d-F-Y", strtotime($user_employee_data->birthday)) ?></p>
        </div>
      </div>
    </div>

    <div class="col-lg-6 bg-white employee-details">
      <h3 class=" work-header">
        Total worked time :
        <?php

        list($hours, $minutes, $seconds) = explode(':', $attendance_data->total_time);


        $formatted_time = "{$hours}Hr:{$minutes}Min:{$seconds}Sec";

        echo $formatted_time;
        ?>
      </h3>
      <!-- <h3 class="p-2 rounded-full text-white text-bold text-lg work-header"
        style="background-color:#fdab2d;font-size:15px;">
        Total worked time : 00hr:02min:50sec
      </h3> -->
      <div class="row ">
        <div class="col-lg-6">
          <div id="newform_wrapper" class="card">
            <div class="card-header">Login Details</div>
            <div class="card-body" style="padding:10px">
              <p class="p-tt" style="font-size:14px;">
                Time : <?= date("d-F-Y \a\\t h:i A", strtotime($attendance_data->login_time)) ?>
              </p>
              <div id="wrapper" class="mb-2">
                <div class="img-wid">
                  <img class="rightmi img-fluid rounded time-img" style="width:200px:height:180px;"
                    src="<?= _uploaded_files_ . 'attendance_login_image/' . $attendance_data->attendance_login_image ?>"
                    alt="Login Image">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div id="newform_wrapper" class="card">
            <div class="card-header">Logout Details</div>
            <div class="card-body" style="padding:10px">
              <p class="p-tt" style="font-size:14px;">
                Time : <?= date("d-F-Y \a\\t h:i A", strtotime($attendance_data->logout_time)) ?>
              </p>
              <div id="wrapper" class="mb-2">
                <div class="img-wid">
                  <img class="rightmi img-fluid rounded time-img" style="width:200px:height:180px;"
                    src="<?= _uploaded_files_ . 'attendance_logout_image/' . $attendance_data->attendance_logout_image ?>"
                    alt="Logout Image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>