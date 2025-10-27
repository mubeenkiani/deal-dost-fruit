<?php
session_start();
include 'connection.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$orderPlaced = false;
$orderId = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Get form data
    $firstName = mysqli_real_escape_string($connect, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($connect, $_POST['last_name']);
    $companyName = mysqli_real_escape_string($connect, $_POST['company_name']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $city = mysqli_real_escape_string($connect, $_POST['city']);
    $country = mysqli_real_escape_string($connect, $_POST['country']);
    $postcode = mysqli_real_escape_string($connect, $_POST['postcode']);
    $mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $orderNotes = mysqli_real_escape_string($connect, $_POST['order_notes']);
    $cartData = $_POST['cart_data'];
    $subtotal = floatval($_POST['subtotal']);
    $shipping = floatval($_POST['shipping']);
    $total = floatval($_POST['total']);

    // Generate order ID
    $orderId = 'ORD-' . time() . '-' . rand(1000, 9999);

    // Insert order into database
    $query = "INSERT INTO orders (order_id, first_name, last_name, company_name, address, city, country, postcode, mobile, email, order_notes, cart_data, subtotal, shipping, total, payment_method, order_status, created_at) 
              VALUES ('$orderId', '$firstName', '$lastName', '$companyName', '$address', '$city', '$country', '$postcode', '$mobile', '$email', '$orderNotes', '$cartData', '$subtotal', '$shipping', '$total', 'Cash on Delivery', 'Pending', NOW())";

    if (mysqli_query($connect, $query)) {
        // Decode cart data for email
        $cartItems = json_decode($cartData, true);
        $itemsList = "";
        $itemsHtml = "";

        foreach ($cartItems as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $itemsList .= "• {$item['name']} (Qty: {$item['quantity']}) - Rs " . number_format($itemTotal, 2) . "\n";
            $itemsHtml .= "<tr>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>{$item['name']}</td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>{$item['quantity']}</td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>Rs " . number_format($item['price'], 2) . "</td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>Rs " . number_format($itemTotal, 2) . "</td>
            </tr>";
        }

        // HTML email message
        $htmlMessage = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                .header h1 { margin: 0; font-size: 28px; }
                .content { background: #f9f9f9; padding: 30px; }
                .section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
                .section h2 { color: #667eea; margin-top: 0; font-size: 18px; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
                .info-row { display: flex; padding: 8px 0; border-bottom: 1px solid #eee; }
                .info-label { font-weight: bold; width: 140px; color: #666; }
                .info-value { flex: 1; color: #333; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th { background: #667eea; color: white; padding: 12px; text-align: left; }
                td { padding: 12px; border-bottom: 1px solid #eee; }
                .total-row { background: #f0f0f0; font-weight: bold; font-size: 16px; }
                .footer { background: #333; color: white; padding: 20px; text-align: center; border-radius: 0 0 10px 10px; }
                .badge { display: inline-block; padding: 5px 15px; background: #ffc107; color: #333; border-radius: 20px; font-weight: bold; }
                .alert { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🎉 New Order Received!</h1>
                    <p style='margin: 10px 0 0 0; font-size: 16px;'>Order ID: <strong>$orderId</strong></p>
                </div>
                
                <div class='content'>
                    <div class='alert'>
                        <strong>⚡ Action Required:</strong> You have received a new order. Please process it as soon as possible.
                    </div>
                    
                    <div class='section'>
                        <h2>📋 Order Information</h2>
                        <div class='info-row'>
                            <div class='info-label'>Order ID:</div>
                            <div class='info-value'><strong>$orderId</strong></div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Order Date:</div>
                            <div class='info-value'>" . date('d M Y, h:i A') . "</div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Status:</div>
                            <div class='info-value'><span class='badge'>Pending</span></div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Payment Method:</div>
                            <div class='info-value'>Cash on Delivery</div>
                        </div>
                    </div>
                    
                    <div class='section'>
                        <h2>👤 Customer Details</h2>
                        <div class='info-row'>
                            <div class='info-label'>Name:</div>
                            <div class='info-value'>$firstName $lastName</div>
                        </div>
                        " . ($companyName ? "<div class='info-row'><div class='info-label'>Company:</div><div class='info-value'>$companyName</div></div>" : "") . "
                        <div class='info-row'>
                            <div class='info-label'>Email:</div>
                            <div class='info-value'><a href='mailto:$email'>$email</a></div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Mobile:</div>
                            <div class='info-value'><a href='tel:$mobile'>$mobile</a></div>
                        </div>
                    </div>
                    
                    <div class='section'>
                        <h2>📍 Shipping Address</h2>
                        <p style='margin: 0; line-height: 1.8;'>
                            <strong>$firstName $lastName</strong><br>
                            " . ($companyName ? "$companyName<br>" : "") . "
                            $address<br>
                            $city, $postcode<br>
                            $country
                        </p>
                    </div>
                    
                    <div class='section'>
                        <h2>🛍️ Order Items</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                $itemsHtml
                                <tr>
                                    <td colspan='3' style='text-align: right; padding: 15px;'><strong>Subtotal:</strong></td>
                                    <td style='padding: 15px;'><strong>Rs " . number_format($subtotal, 2) . "</strong></td>
                                </tr>
                                <tr>
                                    <td colspan='3' style='text-align: right; padding: 15px;'><strong>Shipping:</strong></td>
                                    <td style='padding: 15px;'><strong>Rs " . number_format($shipping, 2) . "</strong></td>
                                </tr>
                                <tr class='total-row'>
                                    <td colspan='3' style='text-align: right; padding: 15px;'><strong>TOTAL:</strong></td>
                                    <td style='padding: 15px;'><strong style='color: #667eea; font-size: 18px;'>Rs " . number_format($total, 2) . "</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    " . ($orderNotes ? "
                    <div class='section'>
                        <h2>📝 Order Notes</h2>
                        <p style='margin: 0; background: #f9f9f9; padding: 15px; border-radius: 5px;'>" . nl2br($orderNotes) . "</p>
                    </div>
                    " : "") . "
                </div>
                
                <div class='footer'>
                    <p style='margin: 0;'>This is an automated notification from your e-commerce website.</p>
                    <p style='margin: 10px 0 0 0; font-size: 12px; opacity: 0.8;'>© " . date('Y') . " Your Store. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";


        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'express2634@gmail.com';
            $mail->Password   = 'ikebdeuszyefxmtz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;


            $mail->setFrom('express2634@gmail.com', 'Deal Dost');
            $mail->addAddress('express2634@gmail.com');
            $mail->addReplyTo($email, "$firstName $lastName");


            $mail->isHTML(true);
            $mail->Subject = "🛒 New Order Received - $orderId";
            $mail->Body    = $htmlMessage;
            $mail->AltBody = strip_tags($htmlMessage);

            $mail->send();
            $emailSent = true;
        } catch (Exception $e) {
            $emailSent = false;
            error_log("Email Error: {$mail->ErrorInfo}");
        }

        $orderPlaced = true;
    } else {
        $error = "Failed to place order. Please try again. Error: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .form-label sup {
            color: #dc3545;
        }

        .order-summary-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        /* Toast Notification Styles */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 320px;
            max-width: 400px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 20px;
            z-index: 9999;
            animation: slideInRight 0.4s ease-out;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .toast-notification.hide {
            animation: slideOutRight 0.4s ease-out forwards;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .toast-icon.success {
            background: #d4edda;
            color: #155724;
        }

        .toast-icon.warning {
            background: #fff3cd;
            color: #856404;
        }

        .toast-icon.error {
            background: #f8d7da;
            color: #721c24;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .toast-message {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 20px;
            color: #999;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 10000;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            text-align: center;
            color: white;
        }

        .loading-spinner i {
            font-size: 48px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Success Modal */
        .success-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 10001;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
        }

        .success-modal {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            animation: scaleIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #d4edda;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounceIn 0.6s ease-out;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .success-icon i {
            font-size: 50px;
            color: #155724;
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
  
    <?php

    include 'layout/header.php';
    ?>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>

    <?php if ($orderPlaced): ?>
        <script>
            localStorage.removeItem('cartItems');
        </script>
        <div class="success-modal-overlay">
            <div class="success-modal">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="mb-3">Order Placed Successfully! 🎉</h2>
                <p class="text-muted mb-2">Thank you for your order!</p>
                <p class="mb-4"><strong>Order ID: <?php echo $orderId; ?></strong></p>
                <p class="mb-4">We've sent you a confirmation email and notified our team. We'll contact you soon for delivery confirmation.</p>
                <a href="order_success.php?order_id=<?php echo $orderId; ?>" class="btn btn-primary px-5 py-3">
                    <i class="fas fa-eye me-2"></i>View Order Details
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('Error', '<?php echo addslashes($error); ?>', 'error');
            });
        </script>
    <?php endif; ?>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <i class="fas fa-circle-notch"></i>
            <h4 class="mt-3">Processing your order...</h4>
            <p>Please wait</p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing Details</h1>
            <form id="checkoutForm" method="POST">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Company Name</label>
                            <input type="text" name="company_name" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address<sup>*</sup></label>
                            <input type="text" name="address" class="form-control" placeholder="House Number Street Name" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" name="country" class="form-control" value="Pakistan" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" name="postcode" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" name="mobile" class="form-control" placeholder="+92 300 1234567" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Order Notes (Optional)</label>
                            <textarea name="order_notes" class="form-control" cols="30" rows="6" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <h4 class="mb-4">Your Order</h4>
                            <div id="orderSummary">
                                <div class="text-center py-5">
                                    <i class="fas fa-shopping-cart fa-3x text-muted"></i>
                                    <p class="mt-3">Loading order summary...</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-4 bg-light rounded">
                            <h5 class="mb-3">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <strong id="displaySubtotal">Rs 0.00</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <strong id="displayShipping">Rs 200.00</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <h5>Total:</h5>
                                <h5 class="text-primary" id="displayTotal">Rs 0.00</h5>
                            </div>
                        </div>

                        <div class="mt-4 p-4 border rounded">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="cod" name="payment_method" value="cod" checked required>
                                <label class="form-check-label" for="cod">
                                    <strong>Cash on Delivery</strong>
                                </label>
                            </div>
                            <p class="text-muted mt-2 mb-0 small">Pay with cash upon delivery.</p>
                        </div>

                        <input type="hidden" name="cart_data" id="cartData">
                        <input type="hidden" name="subtotal" id="subtotalInput">
                        <input type="hidden" name="shipping" id="shippingInput" value="200">
                        <input type="hidden" name="total" id="totalInput">

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" name="place_order" class="btn btn-primary py-3 px-4 text-uppercase w-100">
                                <i class="fas fa-check-circle me-2"></i>Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Fruitables</h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const SHIPPING_COST = 200;
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        function showToast(title, message, type = 'info') {
            const icons = {
                success: '<i class="fas fa-check-circle"></i>',
                error: '<i class="fas fa-times-circle"></i>',
            };

            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.innerHTML = `
                <div class="toast-icon ${type}">${icons[type]}</div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <p class="toast-message">${message}</p>
                </div>
                <button class="toast-close" onclick="this.parentElement.classList.add('hide')">×</button>
            `;

            document.body.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 400);
            }, 5000);
        }

        function displayOrderSummary() {
            const orderSummary = document.getElementById('orderSummary');

            if (cartItems.length === 0) {
                orderSummary.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted"></i>
                        <h5 class="mt-3">Your cart is empty</h5>
                        <a href="shop.php" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                `;
                return;
            }

            let subtotal = 0;
            let orderHTML = '';

            cartItems.forEach(item => {
                const itemTotal = parseFloat(item.price) * item.quantity;
                subtotal += itemTotal;

                orderHTML += `
                    <div class="order-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="../Admin/${item.thumbnail}" class="order-summary-img" alt="${item.name}">
                                <div>
                                    <h6 class="mb-0">${item.name}</h6>
                                    <small class="text-muted">Qty: ${item.quantity}</small>
                                </div>
                            </div>
                            <strong>Rs ${itemTotal.toFixed(2)}</strong>
                        </div>
                    </div>
                `;
            });

            orderSummary.innerHTML = orderHTML;

            const total = subtotal + SHIPPING_COST;

            document.getElementById('displaySubtotal').textContent = `Rs ${subtotal.toFixed(2)}`;
            document.getElementById('displayTotal').textContent = `Rs ${total.toFixed(2)}`;

            document.getElementById('cartData').value = JSON.stringify(cartItems);
            document.getElementById('subtotalInput').value = subtotal.toFixed(2);
            document.getElementById('totalInput').value = total.toFixed(2);
        }

        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            if (cartItems.length === 0) {
                e.preventDefault();
                showToast('Cart Empty', 'Please add items to your cart before checkout', 'warning');
                return;
            }

            document.getElementById('loadingOverlay').style.display = 'flex';
        });

        document.addEventListener('DOMContentLoaded', function() {
            displayOrderSummary();
        });
    </script>
</body>

</html>