<?php
include 'connection.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Karachi');
$alert = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $alert = "<div class='alert alert-danger text-center'>⚠️ Please enter your email address.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert = "<div class='alert alert-danger text-center'>❌ Invalid email format.</div>";
    } else {
        $email = mysqli_real_escape_string($connect, $email);
        $query = "SELECT * FROM admin_signup WHERE Email='$email' LIMIT 1";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

            // Save token and expiry in DB
            $update = "UPDATE admin_signup 
                       SET reset_token='$token', reset_expires='$expires' 
                       WHERE Email='$email'";
            mysqli_query($connect, $update);

            // Generate reset link for localhost
            $resetLink = "http://localhost/deal/Admin/reset-password.php?token=" . $token;

            // --- Send reset email using PHPMailer ---
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'express2634@gmail.com'; // your Gmail
                $mail->Password = 'eptfcnygiyacjpyn'; // your app password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('express2634@gmail.com', 'Deal Dost');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Deal Dost Password Reset Request';
                $mail->Body = "
                    <h2>Password Reset</h2>
                    <p>Hello <b>{$user['User_Name']}</b>,</p>
                    <p>You recently requested to reset your password for your Deal Dost account.</p>
                    <p>Click the link below to reset it:</p>
                    <p><a href='$resetLink' target='_blank'>$resetLink</a></p>
                    <p>This link will expire in 1 hour.</p>
                    <br>
                    <p>If you didn’t request a password reset, you can safely ignore this email.</p>
                ";

                $mail->send();
                $alert = "<div class='alert alert-success text-center'>
                            ✅ A password reset link has been sent to your email address.
                          </div>";
            } catch (Exception $e) {
                $alert = "<div class='alert alert-danger text-center'>
                            ❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}
                          </div>";
            }
        } else {
            $alert = "<div class='alert alert-danger text-center'>⚠️ No account found with this email.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Deal Dost</title>
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css">
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css">
  <link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>

<div class="authentication-wrapper authentication-basic container-p-y">
  <div class="authentication-inner py-4">
    <div class="card p-3">
      <div class="card-body">
        <h4 class="mb-4 text-center">Forgot Password? 🔑</h4>
        <?= $alert ?>

        <form method="POST">
          <div class="form-floating form-floating-outline mb-3">
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            <label>Email address</label>
          </div>
          <button class="btn btn-primary d-grid w-100" name="submit">Send Reset Link</button>
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
