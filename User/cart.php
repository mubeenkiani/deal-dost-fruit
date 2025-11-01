<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shopping Cart - Deal Dost</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1a1a1a;
        }

        /* Header Styles */
        .page-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 60px 0 40px;
            margin-bottom: 0;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-item a:hover {
            color: #ffffff;
        }

        .breadcrumb-item.active {
            color: #ffffff;
        }

        /* Mobile Header Adjustments */
        @media (max-width: 768px) {
            .page-header {
                padding: 40px 0 30px;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }
        }

        /* Cart Container */
        .cart-container {
            padding: 50px 0;
            min-height: 60vh;
        }

        @media (max-width: 768px) {
            .cart-container {
                padding: 30px 0;
            }
        }

        /* Empty Cart Message */
        .empty-cart-message {
            text-align: center;
            padding: 80px 20px;
            background: #f8f8f8;
            border-radius: 16px;
        }

        .empty-cart-message i {
            font-size: 80px;
            color: #d0d0d0;
            margin-bottom: 25px;
        }

        .empty-cart-message h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .empty-cart-message p {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn-primary-custom {
            background: #1a1a1a;
            color: #ffffff;
            padding: 14px 40px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: #000000;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .empty-cart-message {
                padding: 60px 20px;
            }

            .empty-cart-message i {
                font-size: 60px;
            }

            .empty-cart-message h3 {
                font-size: 1.5rem;
            }

            .empty-cart-message p {
                font-size: 1rem;
            }
        }

        /* Cart Items - Mobile First Design */
        .cart-items-container {
            background: #ffffff;
        }

        .cart-item {
            background: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .cart-item-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            background: #f8f8f8;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .cart-item-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        /* Quantity Controls */
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8f8f8;
            padding: 8px 12px;
            border-radius: 50px;
            width: fit-content;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            background: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #1a1a1a;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #1a1a1a;
            color: #ffffff;
        }

        .quantity-display {
            min-width: 35px;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            color: #1a1a1a;
        }

        .remove-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #e8e8e8;
            background: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #ff4444;
            border-color: #ff4444;
            color: #ffffff;
        }

        .remove-btn i {
            font-size: 16px;
        }

        /* Mobile Cart Item Layout */
        @media (max-width: 768px) {
            .cart-item {
                padding: 16px;
            }

            .cart-item-img {
                width: 80px;
                height: 80px;
            }

            .cart-item-name {
                font-size: 1rem;
            }

            .cart-item-price {
                font-size: 1.1rem;
            }

            .quantity-controls {
                gap: 10px;
                padding: 6px 10px;
            }

            .quantity-btn {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .quantity-display {
                font-size: 0.95rem;
                min-width: 30px;
            }
        }

        /* Coupon Section */
        .coupon-section {
            background: #f8f8f8;
            padding: 25px;
            border-radius: 12px;
            margin-top: 30px;
        }

        .coupon-input {
            border: 2px solid #e8e8e8;
            border-radius: 50px;
            padding: 14px 24px;
            width: 100%;
            max-width: 300px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .coupon-input:focus {
            outline: none;
            border-color: #1a1a1a;
        }

        .btn-apply-coupon {
            background: #1a1a1a;
            color: #ffffff;
            padding: 14px 32px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-apply-coupon:hover {
            background: #000000;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .coupon-section {
                padding: 20px;
            }

            .coupon-input {
                max-width: 100%;
                margin-bottom: 12px;
            }

            .btn-apply-coupon {
                width: 100%;
            }
        }

        /* Cart Summary */
        .cart-summary {
            background:lightgrey;
            color: #ffffff;
            border-radius: 16px;
            padding: 30px;
            position: sticky;
            top: 20px;
        }

        .cart-summary h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            color:black;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-size: 1rem;
            color:black;
        }

        .summary-value {
            font-size: 1.1rem;
            font-weight: 600;
            color:black;
        }

        .summary-total {
            padding: 20px 0;
            margin-top: 15px;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
        }

        .summary-total .summary-label {
            font-size: 1.2rem;
            font-weight: 700;
            color:black;
        }

        .summary-total .summary-value {
            font-size: 1.5rem;
            font-weight: 800;
        }

        .btn-checkout {
            background: #ffffff;
            color: #1a1a1a;
            width: 100%;
            padding: 16px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }

        .shipping-note {
            font-size: 0.9rem;
            color:black;
            text-align: center;
            margin-top: 15px;
        }

        @media (max-width: 992px) {
            .cart-summary {
                position: static;
                margin-top: 30px;
            }
        }

        @media (max-width: 768px) {
            .cart-summary {
                padding: 25px 20px;
            }

            .cart-summary h2 {
                font-size: 1.5rem;
            }

            .summary-total .summary-value {
                font-size: 1.3rem;
            }
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 320px;
            max-width: 400px;
            background: #1a1a1a;
            color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
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
            font-size: 18px;
            flex-shrink: 0;
        }

        .toast-icon.success {
            background: #ffffff;
            color: #1a1a1a;
        }

        .toast-icon.warning {
            background: #ffc107;
            color: #1a1a1a;
        }

        .toast-icon.error {
            background: #ff4444;
            color: #ffffff;
        }

        .toast-icon.info {
            background: #ffffff;
            color: #1a1a1a;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .toast-message {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 20px;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
        }

        .toast-close:hover {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .toast-notification {
                right: 10px;
                left: 10px;
                min-width: auto;
                max-width: none;
            }
        }

        /* Confirmation Modal */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .custom-modal {
            background: #ffffff;
            border-radius: 16px;
            padding: 35px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            animation: scaleIn 0.3s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #1a1a1a;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 20px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .modal-message {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
            font-size: 1rem;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .modal-btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .modal-btn.confirm {
            background: #1a1a1a;
            color: #ffffff;
        }

        .modal-btn.confirm:hover {
            background: #000000;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .modal-btn.cancel {
            background: #f8f8f8;
            color: #1a1a1a;
        }

        .modal-btn.cancel:hover {
            background: #e8e8e8;
        }

        @media (max-width: 768px) {
            .custom-modal {
                padding: 30px 20px;
            }

            .modal-title {
                font-size: 1.3rem;
            }

            .modal-actions {
                flex-direction: column-reverse;
            }

            .modal-btn {
                width: 100%;
            }
        }

        /* Desktop Table View */
        .desktop-cart-table {
            display: none;
        }

        @media (min-width: 769px) {
            .desktop-cart-table {
                display: block;
                background: #ffffff;
                border-radius: 12px;
                overflow: hidden;
            }

            .mobile-cart-items {
                display: none;
            }

            .table {
                margin: 0;
            }

            .table thead {
                background: #1a1a1a;
                color: #ffffff;
            }

            .table thead th {
                padding: 18px;
                font-weight: 600;
                font-size: 0.95rem;
                border: none;
            }

            .table tbody tr {
                border-bottom: 1px solid #e8e8e8;
                transition: background 0.3s ease;
            }

            .table tbody tr:hover {
                background: #f8f8f8;
            }

            .table tbody td {
                padding: 20px 18px;
                vertical-align: middle;
                color: #1a1a1a;
            }
        }

        /* Footer Styles */
        .footer {
            background: #1a1a1a;
            color: rgba(255, 255, 255, 0.8);
            padding: 50px 0 0;
            margin-top: 80px;
        }

        .footer h4 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #ffffff;
        }

        .copyright {
            background: #000000;
            padding: 20px 0;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .footer {
                margin-top: 50px;
                padding: 40px 0 0;
            }
        }

        /* Spinner */
        #spinner {
            background: #ffffff;
        }

        .spinner-grow {
            width: 3rem;
            height: 3rem;
            background: #1a1a1a;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>

    <!-- Page Header -->
    <div class="container-fluid page-header">
        <div class="container">
            <h1 class="text-center">Shopping Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </div>
    </div>

   <?php 
   
include 'layout/header.php';   
?>

    <div class="container-fluid cart-container">
        <div class="container">
            <!-- Empty Cart Message -->
            <div id="emptyCartMessage" class="empty-cart-message" style="display: none;">
                <i class="fa fa-shopping-cart"></i>
                <h3>Your cart is empty</h3>
                <p>Add some products to get started!</p>
                <a href="shop.php" class="btn-primary-custom">Continue Shopping</a>
            </div>

            <!-- Cart Content -->
            <div id="cartContent" style="display: none;">
                <div class="row">
                    <!-- Cart Items Column -->
                    <div class="col-lg-8">
                        <!-- Mobile Cart Items -->
                        <div class="mobile-cart-items" id="mobileCartItems">
                            <!-- Items will be inserted here -->
                        </div>

                        <!-- Desktop Cart Table -->
                        <div class="desktop-cart-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="cartTableBody">
                                    <!-- Items will be inserted here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Coupon Section -->
                        <div class="coupon-section">
                            <div class="row align-items-center g-3">
                                <div class="col-md-8">
                                    <input type="text" id="couponCode" class="coupon-input" placeholder="Enter coupon code">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn-apply-coupon" onclick="applyCoupon()">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Summary Column -->
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h2>Order Summary</h2>
                            
                            <div class="summary-row">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value" id="subtotalDisplay">Rs 0.00</span>
                            </div>
                            
                            <div class="summary-row">
                                <span class="summary-label">Shipping</span>
                                <span class="summary-value" id="shippingDisplay">Rs 200.00</span>
                            </div>
                            
                            <div class="summary-row summary-total">
                                <span class="summary-label">Total</span>
                                <span class="summary-value" id="totalDisplay">Rs 0.00</span>
                            </div>

                            <button class="btn-checkout" onclick="proceedCheckout()">
                                Proceed to Checkout
                            </button>

                            <p class="shipping-note">Shipping to Pakistan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid footer">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Deal Dost</h4>
                    <p class="mb-4">Your trusted partner for quality products at the best prices.</p>
                    <a href="#" class="btn-primary-custom">Learn More</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Quick Links</h4>
                    <a class="d-block mb-2" href="#">About Us</a>
                    <a class="d-block mb-2" href="#">Contact Us</a>
                    <a class="d-block mb-2" href="#">Privacy Policy</a>
                    <a class="d-block mb-2" href="#">Terms & Conditions</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Account</h4>
                    <a class="d-block mb-2" href="#">My Account</a>
                    <a class="d-block mb-2" href="#">Order History</a>
                    <a class="d-block mb-2" href="#">Wishlist</a>
                    <a class="d-block mb-2" href="#">Shopping Cart</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Contact</h4>
                    <p>Address: Lahore, Pakistan</p>
                    <p>Email: info@dealdost.com</p>
                    <p>Phone: +92 300 1234567</p>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span>&copy; 2025 Deal Dost. All rights reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <span>Designed with care for our customers</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const SHIPPING_COST = 200;

        // Toast Notification System
        function showToast(title, message, type = 'info') {
            const icons = {
                success: '<i class="fas fa-check-circle"></i>',
                warning: '<i class="fas fa-exclamation-triangle"></i>',
                error: '<i class="fas fa-times-circle"></i>',
                info: '<i class="fas fa-info-circle"></i>'
            };

            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.innerHTML = `
                <div class="toast-icon ${type}">
                    ${icons[type]}
                </div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <p class="toast-message">${message}</p>
                </div>
                <button class="toast-close" onclick="this.parentElement.classList.add('hide')">
                    ×
                </button>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 400);
            }, 4000);
        }

        // Confirmation Modal System
        function showConfirmModal(title, message, onConfirm) {
            const overlay = document.createElement('div');
            overlay.className = 'custom-modal-overlay';
            overlay.innerHTML = `
                <div class="custom-modal">
                    <div class="modal-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="modal-title">${title}</h3>
                    <p class="modal-message">${message}</p>
                    <div class="modal-actions">
                        <button class="modal-btn cancel" onclick="this.closest('.custom-modal-overlay').remove()">
                            Cancel
                        </button>
                        <button class="modal-btn confirm" id="confirmBtn">
                            Confirm
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(overlay);

            document.getElementById('confirmBtn').addEventListener('click', () => {
                onConfirm();
                overlay.remove();
            });

            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.remove();
                }
            });
        }

        function displayCart() {
            const cartTableBody = document.getElementById('cartTableBody');
            const mobileCartItems = document.getElementById('mobileCartItems');
            const emptyMessage = document.getElementById('emptyCartMessage');
            const cartContent = document.getElementById('cartContent');

            if (cartItems.length === 0) {
                emptyMessage.style.display = 'block';
                cartContent.style.display = 'none';
                return;
            }

            emptyMessage.style.display = 'none';
            cartContent.style.display = 'block';

            let subtotal = 0;

            // Desktop Table View
            cartTableBody.innerHTML = cartItems.map((item, index) => {
                const itemTotal = parseFloat(item.price) * item.quantity;
                subtotal += itemTotal;

                return `
                    <tr>
                        <td>
                            <img src="../Admin/${item.thumbnail}" class="cart-item-img" alt="${item.name}">
                        </td>
                        <td>
                            <strong>${item.name}</strong>
                        </td>
                        <td>
                            Rs ${parseFloat(item.price).toFixed(2)}
                        </td>
                        <td>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="decreaseQuantity(${index})">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <span class="quantity-display">${item.quantity}</span>
                                <button class="quantity-btn" onclick="increaseQuantity(${index})">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <strong>Rs ${itemTotal.toFixed(2)}</strong>
                        </td>
                        <td>
                            <button class="remove-btn" onclick="removeFromCart(${index})">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');

            // Mobile Card View
            mobileCartItems.innerHTML = cartItems.map((item, index) => {
                const itemTotal = parseFloat(item.price) * item.quantity;

                return `
                    <div class="cart-item">
                        <div class="d-flex gap-3">
                            <img src="../Admin/${item.thumbnail}" class="cart-item-img" alt="${item.name}">
                            <div class="cart-item-details">
                                <h3 class="cart-item-name">${item.name}</h3>
                                <div class="cart-item-price">Rs ${parseFloat(item.price).toFixed(2)}</div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="quantity-controls">
                                        <button class="quantity-btn" onclick="decreaseQuantity(${index})">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <span class="quantity-display">${item.quantity}</span>
                                        <button class="quantity-btn" onclick="increaseQuantity(${index})">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <button class="remove-btn" onclick="removeFromCart(${index})">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <strong style="font-size: 1.1rem;">Total: Rs ${itemTotal.toFixed(2)}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            const total = subtotal + SHIPPING_COST;
            document.getElementById('subtotalDisplay').textContent = `Rs ${subtotal.toFixed(2)}`;
            document.getElementById('totalDisplay').textContent = `Rs ${total.toFixed(2)}`;
        }

        function increaseQuantity(index) {
            cartItems[index].quantity++;
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            displayCart();
            showToast('Quantity Updated', `${cartItems[index].name} quantity increased`, 'success');
        }

        function decreaseQuantity(index) {
            if (cartItems[index].quantity > 1) {
                cartItems[index].quantity--;
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                displayCart();
                showToast('Quantity Updated', `${cartItems[index].name} quantity decreased`, 'success');
            } else {
                removeFromCart(index);
            }
        }

        function removeFromCart(index) {
            const itemName = cartItems[index].name;
            showConfirmModal(
                'Remove Item?',
                `Are you sure you want to remove "${itemName}" from your cart?`,
                () => {
                    cartItems.splice(index, 1);
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    displayCart();
                    showToast('Item Removed', `${itemName} has been removed from your cart`, 'success');
                }
            );
        }

        function applyCoupon() {
            const couponCode = document.getElementById('couponCode').value.trim();
            if (couponCode === '') {
                showToast('Invalid Coupon', 'Please enter a coupon code', 'warning');
                return;
            }
            showToast('Coming Soon', 'Coupon functionality will be available soon!', 'info');
        }

        function proceedCheckout() {
            if (cartItems.length === 0) {
                showToast('Cart Empty', 'Please add items to your cart before checkout', 'warning');
                return;
            }
            window.location.href = 'chackout.php';
        }

        // Hide spinner and display cart
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.getElementById('spinner').classList.remove('show');
                displayCart();
            }, 500);
        });
    </script>
</body>

</html>