<?php
include 'connection.php';
if (isset($_POST['submit'])) {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  if (!empty($username) && !empty($email) && !empty($password)) {
    $username = mysqli_real_escape_string($connect, htmlspecialchars($username));
    $email = mysqli_real_escape_string($connect, htmlspecialchars($email));
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO `admin_signup`(`User_Name`, `Email`, `Password`) VALUES ('$username','$email','$passwordHash')";
    $run = mysqli_query($connect, $query);
    if ($run) {
      header("Location: signin.php");
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Deal Dost Admin Panel - Register</title>
  <meta name="description" content="Deal Dost Admin Registration" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="assets/vendor/libs/%40form-validation/umd/styles/index.min.css" />
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css">
  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>
</head>
<body>
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <div class="card p-2">
          <div class="app-brand justify-content-center mt-5">
            <a href="#" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3 1.25L56.65 28.64C59.03 30.11 60.48 32.71 60.48 35.51V160.63C60.48 163.47 58.99 166.1 56.56 167.55L12.2 194.11C8.38 196.4 3.43 195.15 1.14 191.33C0.39 190.08 0 188.64 0 187.18V8.12C0 3.66 3.61 0.05 8.06 0.05C9.56 0.05 11.03 0.47 12.3 1.25Z" fill="currentColor"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M237.72 1.19L125 70.31V136.87L250 65.25V8.07C250 3.61 246.39 0 241.93 0C240.45 0 238.99 0.41 237.72 1.19Z" fill="currentColor"/>
                </svg>
              </span>
              <span class="app-brand-text demo text-heading fw-semibold">Deal Dost Admin</span>
            </a>
          </div>
          <div class="card-body mt-2">
            <h4 class="mb-4 text-center">Create Your Admin Account 🚀</h4>
            <form class="mb-3" method="POST" autocomplete="off">
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autocomplete="off" required>
                <label for="username">Username</label>
              </div>
              <div class="form-floating form-floating-outline mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autocomplete="off" required>
                <label for="email">Email</label>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder="************" autocomplete="new-password" required />
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                  <label class="form-check-label" for="terms-conditions">I agree to <a href="#">privacy policy & terms</a></label>
                </div>
              </div>
              <button type="submit" name="submit" class="btn btn-primary d-grid w-100">Sign Up</button>
            </form>
            <p class="text-center">
              <span>Already have an account?</span>
              <a href="signin.php"><span>Sign in instead</span></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="assets/vendor/js/menu.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/pages-auth.js"></script>
</body>
</html>
