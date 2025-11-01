<?php
include 'connection.php';
date_default_timezone_set('Asia/Karachi');
$alert = '';
$token = '';

// ✅ Check if token exists in URL
if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($connect, $_GET['token']);
    $query = "SELECT * FROM admin_signup WHERE reset_token='$token' AND reset_expires > NOW()";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 0) {
        $alert = "<div class='alert alert-danger text-center'>❌ Invalid or expired password reset link.</div>";
    }
} else {
    // Redirect if no token provided
    header("Location: forgot-password.php");
    exit();
}

// ✅ Handle password reset submission
if (isset($_POST['reset'])) {
    $token = mysqli_real_escape_string($connect, $_POST['token']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if (empty($password) || empty($confirm)) {
        $alert = "<div class='alert alert-danger text-center'>⚠️ Please fill in all password fields.</div>";
    } elseif (strlen($password) < 6) {
        $alert = "<div class='alert alert-danger text-center'>🔒 Password must be at least 6 characters long.</div>";
    } elseif ($password !== $confirm) {
        $alert = "<div class='alert alert-danger text-center'>❌ Passwords do not match.</div>";
    } else {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $update = "UPDATE admin_signup 
                   SET Password='$hashed', reset_token=NULL, reset_expires=NULL 
                   WHERE reset_token='$token'";

        if (mysqli_query($connect, $update)) {
            $alert = "<div class='alert alert-success text-center'>
                        ✅ Password updated successfully! Redirecting to login...
                      </div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'signin.php';
                    }, 2000);
                  </script>";
        } else {
            $alert = "<div class='alert alert-danger text-center'>⚠️ Error updating password. Please try again.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Deal Dost</title>
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css">
    <link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>

    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <div class="card p-3">
                <div class="card-body">
                    <h4 class="mb-4 text-center">Reset Your Password 🔒</h4>

                    <?= $alert ?>




                    <form method="POST" class="mt-3">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="password" class="form-control" name="password" placeholder="New Password" required>
                            <label>New Password</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="password" class="form-control" name="confirm" placeholder="Confirm Password" required>
                            <label>Confirm Password</label>
                        </div>
                        <button class="btn btn-primary d-grid w-100" name="reset">Reset Password</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        <a href="signin.php" class="text-primary fw-semibold text-decoration-none">
                            <i class="mdi mdi-login"></i> Back to Login
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>

</body>

</html>