<?php
require("./logic/signup_action.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/index.css">

  <title>Sign Up Page</title>
  <style>
    .error {
      color: #af4242;
      background-color: #fde8ec;
      padding: 10px;
      display: none;
      margin-bottom: 1px;
      margin-top: 20px;
      font-size: 16px;
      border-radius: 6px
    }
  </style>
  <?php
  if ($email_error != null) {
    ?>
    <style>
      .email-error {
        display: block
      }
    </style>
    <?php
  }
  if ($password_error != null) {
    ?>
    <style>
      .password-error {
        display: block
      }
    </style>
    <?php
  }
  if ($email_used != null) {
    ?>
    <style>
      .email-used {
        display: block
      }
    </style>
    <?php
  }
  if ($firstName_error != null) {
    ?>
    <style>
      .firstName-error {
        display: block
      }
    </style>
    <?php
  }
  if ($lastName_error != null) {
    ?>
    <style>
      .lastName-error {
        display: block
      }
    </style>
    <?php
  }
  if ($success_add != null) {
    ?>
    <style>
      .success-add {
        display: block
      }
    </style>
    <?php
  }

  ?>
</head>

<body class="bodyy">
  <div class="head">
    <img src="./assets/logo2.png" alt="#">
  </div>
  <div class="container-full">
    <div class="row d-flex justify-content-start align-items-start">
      <div class="alert alert-secondary col-md-4 col-lg-6 col-xl-4 offset-1 p-4">
        <form class="" action="" method="post" autocomplete="off">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <h1 class="h2 mb-3 me-3 ">Sign Up</h1>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-1">
            <label class="form-label">Fisrt Name</label>
            <input type="firstName" class="form-control form-control" id="username" name="firstName"
              placeholder="Enter Your First" value="<?php echo $firstName ?>">
            <p class="error firstName-error">
              <?php echo $firstName_error ?>
            </p>
          </div>

          <div class="form-outline mb-1">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control form-control" id="lastName" name="lastName"
              placeholder="Enter Your Last Name">
            <p class="error firstName-error">
              <?php echo $lastName_error ?>
            </p>
          </div>

          <div class="form-outline mb-1">
            <label class="form-label">Email</label>
            <input type="text" class="form-control form-control" id="lastName" name="email"
              placeholder="Enter Your Email" value="<?php echo $email ?>">
          </div>

          <!-- Password input -->
          <div class="form-outline mb-1">
            <label class="form-label">Password</label>
            <input type="password" class="form-control form-control" name="password" id="password"
              placeholder="Enter Password">
          </div>

          <div class="justify-content-center">
            <div class="log-buttons">
              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn" name="signUp"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign Up</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="./index.php"
                    class="link-danger">Sign In</a></p>
              </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="side-log">
      <img src="./assets/logo3.png" class="img-logo" alt="Sample image">
      <span>Cyberbullying Prediction System</span>
    </div>
    <div class="side-pic">
      <img src="./assets/loginpic.png" class="img" alt="Sample image">
    </div>
  </div>

  <!-- script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>