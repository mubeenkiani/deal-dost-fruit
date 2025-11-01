<?php
include 'connection.php';
session_start();

$error = "";
$success = "";

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
  header("Location: index.php");
  exit();
}

if (isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Step 1: Validation
  if (empty($email) || empty($password)) {
    $error = "⚠️ Please fill in both email and password fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "❌ Please enter a valid email address.";
  } elseif (strlen($password) < 6) {
    $error = "🔒 Password must be at least 6 characters.";
  } else {
    // Step 2: Secure email input
    $email = mysqli_real_escape_string($connect, $email);

    // Step 3: Check if user exists
    $query = "SELECT * FROM `admin_signup` WHERE `Email` = '$email' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) === 1) {
      $user = mysqli_fetch_assoc($result);

      // Step 4: Check if reset token is active (prevent login during reset)
      if (!empty($user['reset_token']) && strtotime($user['reset_expires']) > time()) {
        $error = "🔑 Password reset is in progress. Please reset your password using the link sent to your email.";
      } 
      // Step 5: Verify hashed password
      elseif (password_verify($password, $user['Password'])) {
        // Step 6: Successful login
        $_SESSION['admin_id'] = $user['ID'];
        $_SESSION['admin_username'] = $user['User_Name'];

        $success = "✅ Login successful! Redirecting...";
        echo "<script>
                setTimeout(function() {
                  window.location.href = 'index.php';
                }, 1500);
              </script>";
      } else {
        $error = "❌ Incorrect password. Please try again.";
      }
    } else {
      $error = "⚠️ No account found with this email address.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>Deal Dost Admin Panel - Sign In</title>
  <meta name="description" content="Deal Dost Admin Login" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="assets/vendor/libs/@form-validation/umd/styles/index.min.css" />
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css">
  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>
  <style>
    .alert {
      border-radius: 10px;
      font-size: 15px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <div class="card p-3">
          <div class="app-brand justify-content-center mt-4">
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
            <h4 class="mb-3 text-center">Welcome Back 👋</h4>
            <p class="mb-4 text-center">Sign in to manage your admin panel</p>

            <?php if (!empty($error)): ?>
              <div class="alert alert-danger text-center py-2" role="alert">
                <?= htmlspecialchars($error) ?>
              </div>
            <?php elseif (!empty($success)): ?>
              <div class="alert alert-success text-center py-2" role="alert">
                <?= htmlspecialchars($success) ?>
              </div>
            <?php endif; ?>

            <form method="POST" autocomplete="off" class="mb-3">
              <div class="form-floating form-floating-outline mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" 
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                <label for="email">Email</label>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" 
                           placeholder="************" required minlength="6" autocomplete="new-password" />
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>

              <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">Remember Me</label>
                </div>
                <a href="forgot-password.php" class="text-primary">Forgot Password?</a>
              </div>

              <button type="submit" name="submit" class="btn btn-primary d-grid w-100">Sign In</button>
            </form>

            <p class="text-center">
              <span>Don’t have an account?</span>
              <a href="signup.php"><span>Create one</span></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/js/menu.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/pages-auth.js"></script>
</body>
</html>
