<?php
require("./logic/login_action.php")

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">


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
  if ($email_not_regis != null) {
    ?>
    <style>
      .email_not_regis {
        display: block
      }
    </style>
    <?php
  }
  if ($password_not_match != null) {
    ?>
    <style>
      .password_not_match {
        display: block
      }
    </style>
    <?php
  }
  ?>

  <title>Login Page</title>
</head>

<body class="bodyy">
  <div class="head-log">
    <img src="./assets/logo3.png" class="img-logo" alt="Sample image">
    <span>Cyberbullying Prediction System</span>
  </div>
  <div class="container-full-index">
    <div class="row d-flex justify-content-start align-items-start">
      <div class="alert alert-secondary col-md-4 col-lg-6 col-xl-4 offset-1 p-4">
        <form class="signIn" action="" method="post" autocomplete="off">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <h1 class="h2 mb-3 me-3">Sign In</h1>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control form-control " id="email" name="email"
              placeholder="Enter Your Email" value="<?php echo $email ?>">
            <p class="error email-error">
              <?php echo $email_error ?>
            </p>
            <p class="error email_not_regis">
              <?php echo $email_not_regis ?>
            </p>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label">Password </label>
            <input type="password" class="form-control form-control" name="password" id="password"
              placeholder="Enter Password" <?php echo $password ?>>
            <p class="error password-error is-invalid">
              <?php echo $password_error ?>
            </p>
            <p class="error password_not_match">
              <?php echo $password_not_match ?>
            </p>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="login" value="SignIn" class="btn btn-primary btn" onclick="checkForm()"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Do you have an account? <a href="./signup.php"
                class="link-danger">Sign Up</a></p>
          </div>
          <?php if (isset($error)): ?>
            <p style="color: red; font-style: italic;"> Wrong Email/Password! </p>
          <?php endif; ?>
        </form>
      </div>
      <div class="col-xl-6">
        <div class="side-pic">
          <img src="./assets/loginpic.png" class="img" alt="Sample image">
        </div>
      </div>
    </div>
  </div>



  <!-- Modal Message Dialog -->
  <div class="modal fade" id="message-dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 id="title-modal" class="modal-title"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div id="body-modal"></div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- script -->
  <script src="./js/func_login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>