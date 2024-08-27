<?php
$is_webcam = true;
if ($this->Common_Model->checkScreen() == "isdesktop") {
  $is_webcam = true;
}
?>

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

  /* h3.tt.text-center.mb-4::before {
    content: "";
    position: absolute;
    left: 47%;
    width: 70px;
    background: #ffb33c;
    top: 316px;
    right: 0;
} */
  h3.tt.text-center.mb-4 {
    font-size: 20px;
    margin-bottom: 8px;
    color: #125859;
    font-weight: 600;
  }

  .card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    overflow: hidden;
  }

  .card-header {
    background: linear-gradient(to right, #00474c, #4d8e82) !important;
  }

  .card-header {
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-bottom: none;
    padding: 1.5rem;
  }

  .form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
  }

  .btn-primary {
    background: linear-gradient(to right, #FFC107, #FF9800);
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
</style>
<?php echo $this->session->flashdata('alert_message'); ?>

<!-- <h5>Employee Status: <?= $employee_status ?></h5>
<h5>Employee Login Status: <?= $employee_login_status ?></h5> -->
<div class="container" style="padding-top:15px;">
  <h1 id="msg">Please allow this page to access your camera.</h1>


  <div class="row d-flex justify-content-center ">


    <div class="employee-details">
      <h3 class="tt text-center mb-4">Employee Details</h3>
      <?php if (!empty($user_employee_data->profile_image)) { ?>
        <img src="<?= _uploaded_files_ . 'user_employee/profile_image/' . $user_employee_data->profile_image ?>"
          alt="Employee Profile Picture" class="profile-pic d-block">
      <?php } else { ?>
        <img src="<?= _uploaded_files_ ?>no-img.png" alt="Employee Profile Picture" class="profile-pic d-block">
      <?php } ?>

      <div class="employee-info mt-4">
        <h4 class="text-center"><?= $user_employee_data->name ?></h4>
        <p class="ppyt"><i class="fa-solid fa-building"></i><strong>Branch:</strong>
          <?= $user_employee_data->branch_name ?></p>
        <p class="ppyt"><i class="fa-solid fa-briefcase"></i><strong>Department:</strong>
          <?= $user_employee_data->department_name ?></p>
        <p class="ppyt"><i class="fa-solid fa-user"></i><strong>Designation:</strong>
          <?= $user_employee_data->designation_name ?></p>
        <!-- <p class="ppyt"><i class="fa-regular fa-calendar"></i><strong>Date of Birth:</strong>
          <?= date("d-F-Y", strtotime($user_employee_data->birthday)) ?></p> -->
      </div>
    </div>

    <?php if ($employee_status == "active"): ?>
      <?php if ($employee_login_status == "allowed_for_login"): ?>
        <div id="form_wrapper" class="card" style="min-width:200px;margin-left:20px;">
          <div class="card-header">Employee Login</div>
          <div class="card-body">

            <div id="wrapper" class="mb-2">
              <video style="height:200px;width:auto;"></video>
              <canvas style="height:200px;width:auto;display:none;"></canvas>
              <br />
              <button id="capturePhoto" class="btn btn-warning">Capture Photo</button>
              <button id="retakePhoto" class="btn btn-danger" style="display: none;">Retake Photo</button>
            </div>

            <form method="post" enctype="multipart/form-data" action="<?= MAINSITE . 'ajax_user_employee_do_login' ?>"
              id="loginForm">
              <input type="hidden" name="task" value="user_employee_login">
              <input type="hidden" id="capturedImage" name="capturedImage" required>

              <button type="submit" class="btn btn-primary" id="loginButton" style="display:none;">Login</button>
            </form>
          </div>
        </div>
      <?php elseif ($employee_login_status == "allowed_for_logout"): ?>
        <div id="form_wrapper" class="card" style="min-width:200px;margin-left:20px;">
          <div class="card-header">Employee Logout</div>
          <div class="card-body">
            <div id="wrapper" class="mb-2">
              <video style="height:200px;width:auto;"></video>
              <canvas style="height:200px;width:auto;display:none;"></canvas>
              <br />
              <button id="capturePhoto" class="btn btn-warning">Capture Photo</button>
              <button id="retakePhoto" class="btn btn-danger" style="display: none;">Retake Photo</button>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?= MAINSITE . 'ajax_user_employee_do_logout' ?>"
              id="loginForm">
              <input type="hidden" name="task" value="user_employee_logout">
              <input type="hidden" id="capturedImage" name="capturedImage" required>


              <button type="submit" class="btn btn-primary" id="loginButton" style="display:none;">Logout</button>
            </form>
          </div>
        </div>
      <?php endif; ?>


    <?php endif; ?>




  </div>
</div>





<script>
  $(document).ready(function () {
    $('#errorToast').toast();
  });


</script>
<script>
  'use strict';

  var message, wrapper, buttonCapturePhoto, buttonRetakePhoto, video, canvas, loginForm, capturedImageData;

  function initElement() {
    message = document.getElementById('msg');
    wrapper = document.getElementById('wrapper');
    buttonCapturePhoto = document.getElementById('capturePhoto');
    buttonRetakePhoto = document.getElementById('retakePhoto');
    video = document.querySelector('video');
    canvas = document.querySelector('canvas');
    loginForm = document.getElementById('loginForm');
    // loginButton = document.getElementById('loginButton');

    if (navigator.mediaDevices === undefined) {
      navigator.mediaDevices = {};
    }

    if (navigator.mediaDevices.getUserMedia === undefined) {
      navigator.mediaDevices.getUserMedia = function (constraints) {
        var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

        if (!getUserMedia) {
          return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
        }

        return new Promise(function (resolve, reject) {
          getUserMedia.call(navigator, constraints, resolve, reject);
        })
      }
    }
  }

  function onCapturePhoto() {
    canvas.getContext('2d').drawImage(video, 0, 0, video.width, video.height);
    capturedImageData = canvas.toDataURL('image/jpeg');
    document.getElementById('capturedImage').value = capturedImageData;
    video.style.display = 'none';
    canvas.style.display = 'block';
    buttonCapturePhoto.style.display = 'none';
    buttonRetakePhoto.style.display = 'inline-block';
    loginForm.style.display = 'block';
    document.getElementById('loginButton').style.display = 'block';
    // loginButton.style.display = 'block';
  }

  function onRetakePhoto() {
    video.style.display = 'block';
    canvas.style.display = 'none';
    buttonCapturePhoto.style.display = 'inline-block';
    buttonRetakePhoto.style.display = 'none';
    loginForm.style.display = 'none';
    // loginButton.style.display = 'none';
  }

  function onLoadVideo() {
    video.setAttribute('width', this.videoWidth);
    video.setAttribute('height', this.videoHeight);
    canvas.setAttribute('width', this.videoWidth);
    canvas.setAttribute('height', this.videoHeight);
    video.play();
  }

  function onMediaStream(stream) {
    if ('srcObject' in video) {
      video.srcObject = stream;
    } else {
      video.src = window.URL.createObjectURL(stream);
    }

    message.style.display = 'none';
    wrapper.style.display = 'block';
    buttonCapturePhoto.addEventListener('click', onCapturePhoto);
    buttonRetakePhoto.addEventListener('click', onRetakePhoto);
    video.addEventListener('loadedmetadata', onLoadVideo);
  }

  function onMediaError(err) {
    message.innerHTML = "Sorry , Your device is not connected to web camera";
  }

  function initEvent() {
    navigator.mediaDevices
      .getUserMedia({ video: true })
      .then(onMediaStream)
      .catch(onMediaError);

    loginForm.addEventListener('submit', function (e) {
      e.preventDefault();
      console.log('Login submitted');
      console.log('Captured Image:', capturedImageData);
      if (capturedImageData) {
        e.currentTarget.submit();
      }
    });
  }

  function init() {
    initElement();
    initEvent();
  }

  if (window.location.protocol != 'https:' && window.location.protocol != 'file:') {
    window.location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
  }

  window.addEventListener('DOMContentLoaded', init);
</script>