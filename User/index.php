<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DealDost - Your Shopping Partner</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

<style>
        .home-fruite-img {
            height: 200px !important;
            overflow: hidden;
        }

        .home-fruite-img img {
            object-fit: cover;
            height: 100% !important;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .home-fruite-item:hover .home-fruite-img img {
            transform: scale(1.05);
        }

        .home-fruite-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .home-fruite-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .home-fruite-item .p-3 {
            padding: 0.75rem !important;
        }

        .home-fruite-item h6 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem !important;
            line-height: 1.3;
        }

        .home-price-section {
            margin-bottom: 0.5rem;
        }

        .home-price-section .current-price {
            font-size: 1.1rem !important;
            font-weight: 700;
            color: #000;
        }

        .home-price-section .original-price {
            font-size: 0.85rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 0.3rem;
        }

        .home-discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #000;
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .home-rating-stars {
            color: #ffc107;
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .home-rating-stars i {
            margin-right: 1px;
        }

        .home-fruite-item .btn {
            padding: 0.35rem 0.7rem !important;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .hero-header {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
            margin-bottom: 2rem !important;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .hero-content h1 {
            margin-bottom: 1.5rem !important;
            color: #000;
        }

        .hero-content p {
            color: #666;
        }

        .hero-search {
            position: relative;
            margin-bottom: 0;
        }

        .hero-search .form-control {
            width: 75% !important;
            border: 2px solid #000 !important;
        }

        .hero-search .btn {
            background: #000 !important;
            border-color: #000 !important;
        }

        @media (min-width: 992px) {
            .hero-search .btn {
                height: auto !important;
                top: 50% !important;
                transform: translateY(-50%);
                padding: 0.75rem 1.75rem !important;
                font-size: 1rem;
            }
        }

        .hero-carousel {
            height: 100%;
        }

        .hero-carousel .carousel-inner {
            height: 100%;
        }

        .hero-carousel .carousel-item {
            height: 450px;
        }

        .hero-carousel .carousel-item img {
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Cart Popup Overlay */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            z-index: 9998;
            pointer-events: none;
            transition: background 0.4s ease;
        }

        .cart-overlay.show {
            background: rgba(0, 0, 0, 0.5);
            pointer-events: auto;
        }

        /* Compact Cart Popup - Right Side */
        .cart-popup {
            position: fixed;
            top: 0;
            right: -100%;
            width: 360px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 25px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            transition: right 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .cart-popup.show {
            right: 0;
        }

        .cart-popup-header {
            background: #000;
            color: white;
            padding: 16px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
        }

        .cart-popup-header h5 {
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .cart-popup-header i {
            color: white;
            font-size: 16px;
        }

        .cart-popup-close {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-popup-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .cart-popup-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
            padding: 14px;
            flex: 1;
            background: #f8f9fa;
        }

        .cart-popup-body::-webkit-scrollbar {
            width: 6px;
        }

        .cart-popup-body::-webkit-scrollbar-track {
            background: #e9ecef;
            border-radius: 3px;
        }

        .cart-popup-body::-webkit-scrollbar-thumb {
            background: #000;
            border-radius: 3px;
        }

        .cart-popup-body::-webkit-scrollbar-thumb:hover {
            background: #333;
        }

        .cart-item {
            display: flex;
            gap: 10px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            margin-bottom: 10px;
            animation: slideInRight 0.4s ease;
            position: relative;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #000;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .cart-item-img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
            border: 1px solid #e0e0e0;
        }

        .cart-item-details {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #000;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-right: 22px;
        }

        .cart-item-price {
            color: #000;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-btn {
            background: #000;
            color: white;
            border: none;
            width: 22px;
            height: 22px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            padding: 0;
            line-height: 1;
            font-weight: 600;
        }

        .quantity-btn:hover {
            background: #333;
            transform: scale(1.1);
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        .btn-add-to-cart {
            background: #000 !important;
            color: white !important;
            border: none !important;
            transition: all 0.3s ease;
        }

        .btn-add-to-cart:hover {
            background: #333 !important;
            transform: translateY(-2px);
        }

        .quantity-display {
            min-width: 28px;
            text-align: center;
            font-weight: 700;
            font-size: 12px;
            color: #000;
            background: #f8f9fa;
            padding: 3px 6px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .quantity-display.updating {
            background: #000;
            color: white;
            transform: scale(1.15);
        }

        .cart-item-remove {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #000;
            color: white;
            border: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 0;
            line-height: 1;
            font-weight: 600;
        }

        .cart-item-remove:hover {
            background: #dc3545;
            transform: scale(1.15);
        }

        .cart-subtotal {
            padding: 14px 18px;
            background: white;
            border-top: 2px solid #e0e0e0;
        }

        .cart-subtotal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-subtotal-label {
            font-size: 13px;
            font-weight: 600;
            color: #666;
        }

        .cart-subtotal-amount {
            font-size: 18px;
            font-weight: 800;
            color: #000;
        }

        .cart-popup-footer {
            padding: 14px 18px;
            background: white;
            display: flex;
            gap: 8px;
            border-top: 1px solid #e0e0e0;
        }

        .cart-popup-footer button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-view-cart {
            background: #000;
            color: white;
        }

        .btn-view-cart:hover {
            background: #333;
            transform: translateY(-2px);
        }

        .btn-view-cart:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .btn-clear-cart {
            background: white;
            color: #000;
            border: 2px solid #000 !important;
        }

        .btn-clear-cart:hover {
            background: #000;
            color: white;
            transform: translateY(-2px);
        }

        .empty-cart {
            text-align: center;
            padding: 50px 15px;
            color: #999;
        }

        .empty-cart i {
            font-size: 50px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        .empty-cart p {
            font-size: 14px;
            font-weight: 500;
            color: #666;
        }

        .cart-badge {
            background: #000;
            color: white;
            border-radius: 12px;
            padding: 2px 7px;
            font-size: 10px;
            font-weight: 700;
            margin-left: 6px;
            min-width: 18px;
            display: inline-block;
            text-align: center;
        }

        /* Toast Notification - Top Right */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: white;
            padding: 14px 18px;
            border-radius: 8px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 280px;
            max-width: 380px;
            animation: slideInRight 0.4s ease;
            border-left: 4px solid #28a745;
        }

        .toast.error {
            border-left-color: #dc3545;
        }

        .toast.info {
            border-left-color: #000;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .toast.hiding {
            animation: slideOutRight 0.3s ease forwards;
        }

        @keyframes slideOutRight {
            to {
                opacity: 0;
                transform: translateX(120%);
            }
        }

        .toast-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            background: #d4edda;
            color: #28a745;
        }

        .toast.error .toast-icon {
            background: #f8d7da;
            color: #dc3545;
        }

        .toast.info .toast-icon {
            background: #e9ecef;
            color: #000;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 700;
            font-size: 13px;
            color: #000;
            margin-bottom: 3px;
        }

        .toast-message {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        .toast-close {
            background: transparent;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
            padding: 0;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .toast-close:hover {
            background: #f8f9fa;
            color: #000;
        }

        @media (max-width: 991px) {
            .hero-header {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            .hero-content h1 {
                font-size: 2rem !important;
                margin-bottom: 1.5rem !important;
            }

            .hero-carousel .carousel-item {
                height: 300px;
            }

            .hero-search .form-control {
                width: 100% !important;
            }

            .hero-search .btn {
                position: relative !important;
                right: 0 !important;
                width: 100%;
                margin-top: 0.75rem;
            }
        }

        /* Mobile Cart Popup - Small Right Side */
        @media (max-width: 576px) {
            .cart-popup {
                width: 280px;
                right: -280px;
                max-height:50vh;
            }

            .cart-popup.show {
                right: 0;
            }

            .cart-popup-header {
                padding: 10px 12px;
            }

            .cart-popup-header h5 {
                font-size: 12px;
                gap: 6px;
            }

            .cart-popup-header i {
                font-size: 13px;
            }

            .cart-popup-close {
                width: 24px;
                height: 24px;
                font-size: 15px;
            }

            .cart-popup-body {
                padding: 8px;
                max-height: calc(75vh - 140px);
            }

            .cart-item {
                padding: 6px;
                gap: 6px;
                margin-bottom: 8px;
            }

            .cart-item-img {
                width: 40px;
                height: 40px;
            }

            .cart-item-name {
                font-size: 10px;
                margin-bottom: 3px;
                padding-right: 18px;
            }

            .cart-item-price {
                font-size: 11px;
                margin-bottom: 4px;
            }

            .quantity-btn {
                width: 18px;
                height: 18px;
                font-size: 10px;
                border-radius: 3px;
            }

            .quantity-display {
                min-width: 22px;
                padding: 2px 4px;
                font-size: 10px;
            }

            .cart-item-remove {
                width: 16px;
                height: 16px;
                font-size: 9px;
                top: 4px;
                right: 4px;
            }

            .cart-subtotal {
                padding: 8px 12px;
            }

            .cart-subtotal-label {
                font-size: 11px;
            }

            .cart-subtotal-amount {
                font-size: 14px;
            }

            .cart-popup-footer {
                padding: 8px 12px;
                gap: 6px;
            }

            .cart-popup-footer button {
                padding: 7px;
                font-size: 10px;
            }

            .empty-cart {
                padding: 30px 10px;
            }

            .empty-cart i {
                font-size: 35px;
                margin-bottom: 10px;
            }

            .empty-cart p {
                font-size: 12px;
            }

            .cart-badge {
                padding: 2px 5px;
                font-size: 9px;
                margin-left: 4px;
                min-width: 16px;
            }

            .toast {
                min-width: 240px;
                max-width: 260px;
                padding: 10px 12px;
            }

            .toast-icon {
                width: 24px;
                height: 24px;
                font-size: 12px;
            }

            .toast-title {
                font-size: 11px;
            }

            .toast-message {
                font-size: 10px;
            }

            .toast-close {
                width: 20px;
                height: 20px;
                font-size: 14px;
            }

            .hero-header {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }

            .hero-content h1 {
                font-size: 1.5rem !important;
                margin-bottom: 1rem !important;
            }

            .hero-carousel .carousel-item {
                height: 250px;
            }

            .hero-search .form-control {
                padding: 0.75rem 1rem !important;
                font-size: 0.9rem;
            }

            .hero-search .btn {
                padding: 0.75rem 1.5rem !important;
                font-size: 0.9rem;
            }

            .home-fruite-img {
                height: 160px !important;
            }

            .home-fruite-item h6 {
                font-size: 0.8rem;
            }

            .home-price-section .current-price {
                font-size: 0.95rem !important;
            }

            .home-price-section .original-price {
                font-size: 0.75rem;
            }

            .home-fruite-item .btn {
                font-size: 0.7rem;
                padding: 0.3rem 0.5rem !important;
            }

            .home-fruite-item .p-3 {
                padding: 0.5rem !important;
            }

            .home-rating-stars {
                font-size: 0.7rem;
            }

            .home-discount-badge {
                font-size: 0.65rem;
                padding: 0.15rem 0.4rem;
            }
        }

        /* Extra Small Devices */
        @media (max-width: 380px) {
            .cart-popup {
                width: 260px;
                right: -260px;
            }

            .cart-popup-header h5 {
                font-size: 11px;
            }

            .cart-item-img {
                width: 35px;
                height: 35px;
            }

            .cart-item-name {
                font-size: 9px;
            }

            .cart-item-price {
                font-size: 10px;
            }
        }

        /* Small Tablets */
        @media (min-width: 577px) and (max-width: 768px) {
            .cart-popup {
                width: 320px;
                right: -320px;
            }

            .cart-popup.show {
                right: 0;
            }

            .cart-popup-header {
                padding: 12px 14px;
            }

            .cart-popup-body {
                padding: 10px;
            }

            .cart-item-img {
                width: 50px;
                height: 50px;
            }

            .home-fruite-img {
                height: 180px !important;
            }
        }

        /* Medium Tablets */
        @media (min-width: 769px) and (max-width: 992px) {
            .cart-popup {
                width: 340px;
                right: -340px;
            }

            .cart-popup.show {
                right: 0;
            }

            .home-fruite-img {
                height: 190px !important;
            }
        }
    </style>
</head>

<body>
    <div class="cart-overlay" id="cartOverlay" onclick="closeCartPopup()"></div>
    <div class="toast-container" id="toastContainer"></div>

    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <?php include 'layout/header.php'; ?>

    <div class="container-fluid py-3 mb-3 hero-header">
        <div class="container py-3">
            <div class="row g-4 align-items-center">
                <div class="col-md-12 col-lg-5 hero-content">
                    <h1 class="mb-3 display-3">Welcome to DealDost</h1>
                    <p class="fs-5 mb-4">Your Trusted Shopping Partner - Best Deals, Best Quality!</p>
                    <div class="hero-search">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" placeholder="Search products...">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Search</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7">
                    <div id="carouselId" class="carousel slide position-relative hero-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="img/hero-img-1.png" class="img-fluid w-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Shop Now</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="img/hero-img-2.jpg" class="img-fluid w-100 rounded" alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Explore</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Featured Products</h1>
                        <p class="text-muted">Discover our best deals today</p>
                    </div>
                </div>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-3">
                            <?php
                            $query = "SELECT * FROM `product_info` ORDER BY Id DESC LIMIT 8";
                            $run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($run) > 0) {
                                while ($row = mysqli_fetch_assoc($run)) {
                                    $productId = $row['Id'];
                                    $productName = htmlspecialchars($row['Name']);
                                    $productPrice = htmlspecialchars($row['Price']);
                                    $productThumb = htmlspecialchars($row['Thumbnail']);
                                    $shortdes = htmlspecialchars($row['shortdes']);
                                    $category = htmlspecialchars($row['Category'] ?? 'Product');

                                    $discountPrice = $productPrice * 0.85;
                                    $discountPercent = 15;

                                    echo '
                            <div class="col-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="rounded position-relative home-fruite-item border shadow-sm h-100 d-flex flex-column">
                                    <div class="home-fruite-img position-relative">
                                        <a href="product_detail.php?id=' . $productId . '">
                                            <img src="../Admin/' . $productThumb . '" class="img-fluid w-100 rounded-top" alt="' . $productName . '">
                                        </a>
                                        <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" 
                                            style="top: 10px; left: 10px; font-size: 0.75rem;">' . $category . '</div>
                                        <div class="home-discount-badge">' . $discountPercent . '% OFF</div>
                                    </div>

                                    <div class="p-3 border border-secondary border-top-0 rounded-bottom d-flex flex-column justify-content-between flex-grow-1">
                                        <div>
                                            <h6 class="fw-semibold mb-2">' . $productName . '</h6>
                                            <div class="product-description text-muted mb-3" style="font-size: 0.8rem; line-height: 1.4;">
                                                ' . $shortdes . '
                                            </div>
                                            <div class="home-rating-stars mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span class="text-muted ms-1">(4.5)</span>
                                            </div>

                                            <div class="home-price-section">
                                                <span class="current-price">Rs ' . number_format($discountPrice, 0) . '</span>
                                                <span class="original-price">Rs ' . $productPrice . '</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <button type="button" 
                                                class="btn bg-black border border-secondary rounded-pill text-white w-100 btn-add-to-cart"
                                                onclick="event.stopPropagation(); addToCart(\'' . $productId . '\', \'' . addslashes($productName) . '\', \'' . $discountPrice . '\', \'' . $productThumb . '\');">
                                                <i class="fa fa-shopping-cart me-1"></i> Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                                }
                            } else {
                                echo '<p class="text-center">No products found.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Fresh Products</h5>
                                    <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Quality Items</h5>
                                    <h3 class="mb-0">Free Delivery</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Best Deals</h5>
                                    <h3 class="mb-0">Discount 30%</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Trending Products</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Product</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Premium Item</h4>
                        <p>High quality products at amazing prices for our valued customers</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs 499 / unit</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Product</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Special Offer</h4>
                        <p>Limited time deals on selected items at DealDost</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs 399 / unit</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-3.png" class="img-fluid w-100 rounded-top bg-light" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Product</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Best Seller</h4>
                        <p>Most popular products loved by our customers</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs 799 / unit</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Product</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Featured Item</h4>
                        <p>Exclusive products available only at DealDost</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs 699 / unit</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Product</div>
                    <div class="p-4 rounded-bottom">
                        <h4>New Arrival</h4>
                        <p>Latest products just added to our collection</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs 599 / unit</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Product</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Top Rated</h4>
                        <p>Highly rated products by verified buyers</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs 899 / unit</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Amazing Deals</h1>
                        <p class="fw-normal display-3 text-dark mb-4">at DealDost</p>
                        <p class="mb-4 text-dark">Shop the best products at unbeatable prices. Your satisfaction is our priority!</p>
                        <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">Shop Now</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">50%</span>
                                <span class="h4 text-muted mb-0">OFF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Bestseller Products</h1>
                <p>Discover the most popular items loved by our customers at DealDost</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/best-product-1.jpg" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Premium Product</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">Rs 312</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/best-product-2.jpg" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Quality Item</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">Rs 412</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/best-product-3.jpg" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Top Choice</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">Rs 512</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Happy Customers</h4>
                            <h1>5000+</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Quality Service</h4>
                            <h1>99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Products</h4>
                            <h1>1000+</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Daily Orders</h4>
                            <h1>500+</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Customer Reviews</h4>
                <h1 class="display-5 mb-5 text-dark">What Our Customers Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Amazing service and quality products! DealDost is my go-to shopping partner for all my needs.
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Ahmed Khan</h4>
                                <p class="m-0 pb-3">Business Owner</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Best deals and fast delivery! Highly recommend DealDost for online shopping.
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Fatima Ali</h4>
                                <p class="m-0 pb-3">Teacher</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Excellent customer service and genuine products. DealDost never disappoints!
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Hassan Raza</h4>
                                <p class="m-0 pb-3">Engineer</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">DealDost</h1>
                            <p class="text-secondary mb-0">Your Shopping Partner</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="email" placeholder="Your Email">
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
                        <h4 class="text-light mb-3">Why DealDost?</h4>
                        <p class="mb-4">Your trusted shopping partner offering the best deals on quality products. Shop with confidence at DealDost!</p>
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
                        <a class="btn-link" href="">Shop Details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">Track Order</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: Lahore, Punjab, Pakistan</p>
                        <p>Email: info@dealdost.com</p>
                        <p>Phone: +92 300 1234567</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>DealDost</a>, All rights reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed with ❤️ for Pakistan
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <div class="cart-popup" id="cartPopup">
        <div class="cart-popup-header">
            <h5>
                <i class="fa fa-shopping-cart"></i>Shopping Cart
                <span class="cart-badge" id="cartBadge">0</span>
            </h5>
            <button class="cart-popup-close" onclick="closeCartPopup()" title="Close Cart">
                &times;
            </button>
        </div>
        <div class="cart-popup-body" id="cartPopupBody">
            <div class="empty-cart">
                <i class="fa fa-shopping-cart"></i>
                <p>Your cart is empty</p>
            </div>
        </div>
        <div class="cart-subtotal" id="cartSubtotal" style="display: none;">
            <div class="cart-subtotal-row">
                <span class="cart-subtotal-label">Subtotal:</span>
                <span class="cart-subtotal-amount" id="subtotalAmount">Rs 0</span>
            </div>
        </div>
        <div class="cart-popup-footer">
            <button class="btn-view-cart" onclick="viewCart()">
                <i class="fa fa-eye"></i> View Cart
            </button>
            <button class="btn-clear-cart" onclick="clearCart()">
                <i class="fa fa-trash"></i> Clear
            </button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        function showToast(title, message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            const iconMap = {
                success: 'fa-check',
                error: 'fa-times',
                info: 'fa-info'
            };

            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="fa ${iconMap[type]}"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="removeToast(this)">
                    <i class="fa fa-times"></i>
                </button>
            `;

            toastContainer.appendChild(toast);

            setTimeout(() => {
                removeToast(toast.querySelector('.toast-close'));
            }, 3500);
        }

        function removeToast(button) {
            const toast = button.closest('.toast');
            if (toast) {
                toast.classList.add('hiding');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        function showCartPopup() {
            const popup = document.getElementById('cartPopup');
            const overlay = document.getElementById('cartOverlay');
            popup.classList.add('show');
            overlay.classList.add('show');
            updateCartDisplay();
        }

        function closeCartPopup() {
            const popup = document.getElementById('cartPopup');
            const overlay = document.getElementById('cartOverlay');
            popup.classList.remove('show');
            overlay.classList.remove('show');
        }

        function updateCartDisplay() {
            const cartBody = document.getElementById('cartPopupBody');
            const cartBadge = document.getElementById('cartBadge');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const subtotalAmount = document.getElementById('subtotalAmount');

            const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
            cartBadge.textContent = totalItems;

            if (cartItems.length === 0) {
                cartBody.innerHTML = `
                    <div class="empty-cart">
                        <i class="fa fa-shopping-cart"></i>
                        <p>Your cart is empty</p>
                    </div>
                `;
                cartSubtotal.style.display = 'none';
                return;
            }

            let subtotal = 0;

            cartBody.innerHTML = cartItems.map((item, index) => {
                const itemTotal = parseFloat(item.price) * item.quantity;
                subtotal += itemTotal;

                const imagePath = item.thumbnail.startsWith('http') ? item.thumbnail : `../Admin/${item.thumbnail}`;

                return `
                    <div class="cart-item">
                        <img src="${imagePath}" alt="${item.name}" class="cart-item-img" onerror="this.src='https://via.placeholder.com/55x55?text=No+Image'">
                        <div class="cart-item-details">
                            <div class="cart-item-name" title="${item.name}">${item.name}</div>
                            <div class="cart-item-price">Rs ${itemTotal.toFixed(2)}</div>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="event.stopPropagation(); decreaseQuantity(${index});" title="Decrease">
                                    −
                                </button>
                                <span class="quantity-display" id="qty-${index}">${item.quantity}</span>
                                <button class="quantity-btn" onclick="event.stopPropagation(); increaseQuantity(${index});" title="Increase">
                                    +
                                </button>
                            </div>
                        </div>
                        <button class="cart-item-remove" onclick="event.stopPropagation(); removeFromCart(${index});" title="Remove">
                            &times;
                        </button>
                    </div>
                `;
            }).join('');

            cartSubtotal.style.display = 'block';
            subtotalAmount.textContent = `Rs ${subtotal.toFixed(2)}`;
        }

        function addToCart(productId, name, price, thumbnail) {
            const existingIndex = cartItems.findIndex(i => i.id === productId);

            if (existingIndex > -1) {
                cartItems[existingIndex].quantity++;
                showToast('Updated!', `${name} quantity increased`, 'success');
            } else {
                const item = {
                    id: productId,
                    name: name,
                    price: price,
                    thumbnail: thumbnail,
                    quantity: 1
                };
                cartItems.push(item);
                showToast('Added to Cart!', `${name} added successfully`, 'success');
            }

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            showCartPopup();
        }

        function increaseQuantity(index) {
            cartItems[index].quantity++;

            const qtyDisplay = document.getElementById(`qty-${index}`);
            const priceDisplay = qtyDisplay.closest('.cart-item-details').querySelector('.cart-item-price');

            if (qtyDisplay && priceDisplay) {
                qtyDisplay.classList.add('updating');
                qtyDisplay.textContent = cartItems[index].quantity;

                const itemTotal = parseFloat(cartItems[index].price) * cartItems[index].quantity;
                priceDisplay.textContent = `Rs ${itemTotal.toFixed(2)}`;

                setTimeout(() => {
                    qtyDisplay.classList.remove('updating');
                }, 300);
            }

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateSubtotalAndBadge();
        }

        function decreaseQuantity(index) {
            if (cartItems[index].quantity > 1) {
                cartItems[index].quantity--;

                const qtyDisplay = document.getElementById(`qty-${index}`);
                const priceDisplay = qtyDisplay.closest('.cart-item-details').querySelector('.cart-item-price');

                if (qtyDisplay && priceDisplay) {
                    qtyDisplay.classList.add('updating');
                    qtyDisplay.textContent = cartItems[index].quantity;

                    const itemTotal = parseFloat(cartItems[index].price) * cartItems[index].quantity;
                    priceDisplay.textContent = `Rs ${itemTotal.toFixed(2)}`;

                    setTimeout(() => {
                        qtyDisplay.classList.remove('updating');
                    }, 300);
                }

                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateSubtotalAndBadge();
            } else {
                removeFromCart(index);
            }
        }

        function updateSubtotalAndBadge() {
            const cartBadge = document.getElementById('cartBadge');
            const subtotalAmount = document.getElementById('subtotalAmount');

            const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
            cartBadge.textContent = totalItems;

            const subtotal = cartItems.reduce((sum, item) => sum + (parseFloat(item.price) * item.quantity), 0);
            subtotalAmount.textContent = `Rs ${subtotal.toFixed(2)}`;
        }

        function removeFromCart(index) {
            const itemName = cartItems[index].name;
            cartItems.splice(index, 1);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartDisplay();
            showToast('Item Removed', `${itemName} removed from cart`, 'info');
        }

        function clearCart() {
            if (confirm('Clear all items from cart?')) {
                const itemCount = cartItems.length;
                cartItems = [];
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCartDisplay();
                showToast('Cart Cleared', `${itemCount} item(s) removed`, 'info');
            }
        }

        function viewCart() {
            const viewCartBtn = document.querySelector('.btn-view-cart');
            const originalContent = viewCartBtn.innerHTML;
            viewCartBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';
            viewCartBtn.disabled = true;

            setTimeout(() => {
                window.location.href = 'cart.php';
            }, 600);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
        });

        document.getElementById('cartPopup')?.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>

    <script>
        $(document).ready(function() {
            function loadProducts() {
                $.ajax({
                    url: 'fetch_products.php',
                    method: 'GET',
                    success: function(response) {
                        $('#product-container').html(response);
                    }
                });
            }
            loadProducts();
        });
    </script>
</body>

</html>