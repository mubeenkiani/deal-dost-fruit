<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
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
            color: #81c408;
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
            background: #ff6b6b;
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
        }

        .hero-content h1 {
            margin-bottom: 2rem !important;
        }

        .hero-search {
            position: relative;
            margin-bottom: 0;
        }

        .hero-search .form-control {
            width: 75% !important;
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
        }

        .cart-popup {
            position: fixed;
            top: -100%;
            right: 20px;
            width: 420px;
            max-height: 680px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid #e8e8e8;
        }

        .cart-popup.show {
            top: 80px;
        }

        .cart-popup-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #2c3e50;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-popup-header h5 {
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .cart-popup-header i {
            color: #495057;
        }

        .cart-popup-close {
            background: rgba(108, 117, 125, 0.1);
            border: none;
            color: #495057;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-popup-close:hover {
            background: rgba(108, 117, 125, 0.2);
            transform: rotate(90deg);
        }

        .cart-popup-body {
            max-height: 400px;
            overflow-y: auto;
            padding: 20px;
            flex: 1;
            background: #fafafa;
        }

        .cart-popup-body::-webkit-scrollbar {
            width: 8px;
        }

        .cart-popup-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .cart-popup-body::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .cart-popup-body::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .cart-item {
            display: flex;
            gap: 14px;
            padding: 16px;
            background: white;
            border-radius: 12px;
            margin-bottom: 12px;
            animation: slideIn 0.4s ease;
            position: relative;
            border: 1px solid #e8e8e8;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        @keyframes slideIn {
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
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 10px;
            flex-shrink: 0;
            border: 1px solid #e8e8e8;
        }

        .cart-item-details {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-right: 30px;
        }

        .cart-item-price {
            color: #495057;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity-btn {
            background: #6c757d;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            padding: 0;
            line-height: 1;
            font-weight: 600;
        }

        .quantity-btn:hover {
            background: #495057;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
        }

        .quantity-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(108, 117, 125, 0.3);
        }

        .quantity-display {
            min-width: 40px;
            text-align: center;
            font-weight: 700;
            font-size: 15px;
            color: #2c3e50;
            background: #f8f9fa;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .quantity-display.updating {
            background: #e9ecef;
            transform: scale(1.1);
        }

        .cart-item-remove {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #dc3545;
            color: white;
            border: none;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 0;
            line-height: 1;
            font-weight: 600;
            opacity: 0.9;
        }

        .cart-item-remove:hover {
            background: #c82333;
            transform: scale(1.15);
            opacity: 1;
        }

        .cart-subtotal {
            padding: 20px 24px;
            background: white;
            border-top: 2px solid #e9ecef;
            border-bottom: 2px solid #e9ecef;
        }

        .cart-subtotal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-subtotal-label {
            font-size: 16px;
            font-weight: 600;
            color: #495057;
        }

        .cart-subtotal-amount {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        .cart-popup-footer {
            padding: 20px 24px;
            background: #f8f9fa;
            display: flex;
            gap: 12px;
        }

        .cart-popup-footer button {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-view-cart {
            background: #2c3e50;
            color: white;
        }

        .btn-view-cart:hover {
            background: #1a252f;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 62, 80, 0.3);
        }

        .btn-view-cart:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-clear-cart {
            background: white;
            color: #dc3545;
            border: 2px solid #dc3545 !important;
        }

        .btn-clear-cart:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #adb5bd;
        }

        .empty-cart i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.4;
        }

        .empty-cart p {
            font-size: 16px;
            font-weight: 500;
        }

        .cart-badge {
            background: #dc3545;
            color: white;
            border-radius: 12px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 8px;
            min-width: 24px;
            display: inline-block;
            text-align: center;
        }

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
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            max-width: 400px;
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-left: 4px solid #28a745;
        }

        .toast.error {
            border-left-color: #dc3545;
        }

        .toast.info {
            border-left-color: #17a2b8;
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
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
            background: #d4edda;
            color: #28a745;
        }

        .toast.error .toast-icon {
            background: #f8d7da;
            color: #dc3545;
        }

        .toast.info .toast-icon {
            background: #d1ecf1;
            color: #17a2b8;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 700;
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: #6c757d;
            line-height: 1.4;
        }

        .toast-close {
            background: transparent;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            font-size: 20px;
            line-height: 1;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .toast-close:hover {
            background: #f8f9fa;
            color: #495057;
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

        @media (max-width: 576px) {
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

            .cart-popup {
                width: 95%;
                right: 2.5%;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .home-fruite-img {
                height: 180px !important;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .home-fruite-img {
                height: 190px !important;
            }
        }
    </style>
</head>

<body>
    <div class="toast-container" id="toastContainer"></div>

    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <?php include 'layout/header.php'; ?>

    <div class="container-fluid py-3 mb-3 hero-header">
        <div class="container py-3">
            <div class="row g-4 align-items-center">
                <div class="col-md-12 col-lg-5 hero-content">
                    <h1 class="mb-3 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                    <div class="hero-search">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" placeholder="Search">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7">
                    <div id="carouselId" class="carousel slide position-relative hero-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="img/hero-img-1.png" class="img-fluid w-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="img/hero-img-2.jpg" class="img-fluid w-100 rounded" alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a>
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
                        <h1>Our Organic Products</h1>
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
                                            <div class="product-description text-muted mb-3">
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
                                    <h5 class="text-white">Fresh Apples</h5>
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
                                    <h5 class="text-primary">Tasty Fruits</h5>
                                    <h3 class="mb-0">Free delivery</h3>
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
                                    <h5 class="text-white">Exotic Vegitable</h5>
                                    <h3 class="mb-0">Discount 30$</h3>
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
            <h1 class="mb-0">Fresh Organic Vegetables</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-3.png" class="img-fluid w-100 rounded-top bg-light" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Banana</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Bell Papper</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Potatoes</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
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
                        <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                        <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                        <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p>
                        <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">50$</span>
                                <span class="h4 text-muted mb-0">kg</span>
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
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/best-product-1.jpg" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
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
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
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
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
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
                            <h4>satisfied customers</h4>
                            <h1>1963</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>quality of service</h4>
                            <h1>99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>quality certificates</h4>
                            <h1>33</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Available Products</h4>
                            <h1>789</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->


    <!-- Tastimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Our Testimonial</h4>
                <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
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
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
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
    <!-- Tastimonial End -->


    <!-- Footer Start -->
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

    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-side-right modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Cart Item 1 -->
                    <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                        <div class="cart-item-name">
                            <p class="mb-0">Product Name 1</p>
                            <p class="mb-0 text-muted">Price: $10.00</p>
                        </div>
                        <div class="cart-item-quantity d-flex align-items-center">
                            <button class="btn btn-sm btn-secondary">-</button>
                            <input type="number" class="form-control form-control-sm mx-2" value="1" min="1" style="width: 50px;">
                            <button class="btn btn-sm btn-secondary">+</button>
                        </div>
                    </div>

                    <!-- Cart Item 2 -->
                    <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                        <div class="cart-item-name">
                            <p class="mb-0">Product Name 2</p>
                            <p class="mb-0 text-muted">Price: $20.00</p>
                        </div>
                        <div class="cart-item-quantity d-flex align-items-center">
                            <button class="btn btn-sm btn-secondary">-</button>
                            <input type="number" class="form-control form-control-sm mx-2" value="1" min="1" style="width: 50px;">
                            <button class="btn btn-sm btn-secondary">+</button>
                        </div>
                    </div>
                    <!-- Add more cart items as needed -->

                    <div class="cart-total d-flex justify-content-between align-items-center mt-4">
                        <p class="mb-0">Total:</p>
                        <p class="mb-0">$30.00</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
    </div>



    <div class="cart-popup" id="cartPopup">
        <div class="cart-popup-header">
            <h5 class="mb-0">
                <i class="fa fa-shopping-cart me-2"></i>Shopping Cart
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
                <i class="fa fa-eye me-1"></i> View Cart
            </button>
            <button class="btn-clear-cart" onclick="clearCart()">
                <i class="fa fa-trash me-1"></i> Clear All
            </button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

<div id="product-container" class="row"></div>
<script>
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    function showCartPopup() {
        const popup = document.getElementById('cartPopup');
        popup.classList.add('show');
        updateCartDisplay();
    }

    function closeCartPopup() {
        const popup = document.getElementById('cartPopup');
        popup.classList.remove('show');
    }

    function updateCartDisplay() {
        const cartBody = document.getElementById('cartPopupBody');
        const cartBadge = document.getElementById('cartBadge');
        const cartSubtotal = document.getElementById('cartSubtotal');
        const subtotalAmount = document.getElementById('subtotalAmount');

        // Update cart badge
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

        // Calculate subtotal
        let subtotal = 0;

        cartBody.innerHTML = cartItems.map((item, index) => {
            const itemTotal = parseFloat(item.price) * item.quantity;
            subtotal += itemTotal;

            return `
            <div class="cart-item">
                <img src="../Admin/${item.thumbnail}" alt="${item.name}" class="cart-item-img">
                <div class="cart-item-details">
                    <div class="cart-item-name" title="${item.name}">${item.name}</div>
                    <div class="cart-item-price">Rs ${itemTotal.toFixed(2)}</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="event.stopPropagation(); decreaseQuantity(${index});" title="Decrease quantity">
                            −
                        </button>
                        <span class="quantity-display">${item.quantity}</span>
                        <button class="quantity-btn" onclick="event.stopPropagation(); increaseQuantity(${index});" title="Increase quantity">
                            +
                        </button>
                    </div>
                </div>
                <button class="cart-item-remove" onclick="event.stopPropagation(); removeFromCart(${index});" title="Remove item">
                    &times;
                </button>
            </div>
        `;
        }).join('');

        // Show and update subtotal
        cartSubtotal.style.display = 'block';
        subtotalAmount.textContent = `Rs ${subtotal.toFixed(2)}`;
    }

    function addToCart(productId, name, price, thumbnail) {
        // Check if item already exists
        const existingIndex = cartItems.findIndex(i => i.id === productId);

        if (existingIndex > -1) {
            // Increment quantity if item exists
            cartItems[existingIndex].quantity++;
        } else {
            // Add new item
            const item = {
                id: productId,
                name: name,
                price: price,
                thumbnail: thumbnail,
                quantity: 1
            };
            cartItems.push(item);
        }

        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        showCartPopup();
    }

    function increaseQuantity(index) {
        cartItems[index].quantity++;
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartDisplay();
    }

    function decreaseQuantity(index) {
        if (cartItems[index].quantity > 1) {
            cartItems[index].quantity--;
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartDisplay();
        } else {
            // If quantity is 1, remove the item but keep popup open
            removeFromCart(index);
        }
    }

    function removeFromCart(index) {
        // Remove item from cart
        cartItems.splice(index, 1);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartDisplay();
        // POPUP STAYS OPEN - no auto-close
    }

    function clearCart() {
        if (confirm('Are you sure you want to clear the entire cart?')) {
            cartItems = [];
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartDisplay();
            // POPUP STAYS OPEN - user can close manually
        }
    }

    function viewCart() {
        window.location.href = 'cart.php';
    }

    // Load cart on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartDisplay();
    });

    // Prevent popup from closing when clicking inside it
    document.getElementById('cartPopup')?.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Close popup only when clicking outside
    document.addEventListener('click', function(event) {
        const popup = document.getElementById('cartPopup');
        const target = event.target;

        // Only close if clicking outside popup AND not on add to cart button
        if (popup && popup.classList.contains('show')) {
            if (!popup.contains(target) && !target.closest('.btn-add-to-cart')) {
                closeCartPopup();
            }
        }
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