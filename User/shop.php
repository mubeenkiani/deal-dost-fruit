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

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .fruite-img {
            height: 200px !important;
            overflow: hidden;
        }

        .fruite-img img {
            object-fit: cover;
            height: 100% !important;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .fruite-item:hover .fruite-img img {
            transform: scale(1.05);
        }

        .fruite-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .fruite-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .fruite-item .p-3 {
            padding: 0.75rem !important;
        }

        .fruite-item h6 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem !important;
            line-height: 1.3;
        }

        .price-section {
            margin-bottom: 0.5rem;
        }

        .price-section .current-price {
            font-size: 1.1rem !important;
            font-weight: 700;
            color: #81c408;
        }

        .price-section .original-price {
            font-size: 0.85rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 0.3rem;
        }

        .discount-badge {
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

        .rating-stars {
            color: #ffc107;
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .rating-stars i {
            margin-right: 1px;
        }

        .fruite-item .btn {
            padding: 0.35rem 0.7rem !important;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .pagination a {
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active):not(.disabled) {
            background-color: #ddd;
        }

        .pagination a.disabled {
            cursor: not-allowed;
        }

        #products-grid {
            transition: opacity 0.3s ease;
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

        @media (max-width: 576px) {
            .fruite-img {
                height: 160px !important;
            }

            .fruite-item h6 {
                font-size: 0.8rem;
            }

            .price-section .current-price {
                font-size: 0.95rem !important;
            }

            .price-section .original-price {
                font-size: 0.75rem;
            }

            .fruite-item .btn {
                font-size: 0.7rem;
                padding: 0.3rem 0.5rem !important;
            }

            .fruite-item .p-3 {
                padding: 0.5rem !important;
            }

            .rating-stars {
                font-size: 0.7rem;
            }

            .discount-badge {
                font-size: 0.65rem;
                padding: 0.15rem 0.4rem;
            }

            .cart-popup {
                width: 95%;
                right: 2.5%;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .fruite-img {
                height: 180px !important;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .fruite-img {
                height: 190px !important;
            }
        }
    </style>
</head>

<body>
    <div class="toast-container" id="toastContainer"></div>

    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <?php include 'layout/header.php'; ?>

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

    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-3"></div>

                        <div class="col-lg-9">
                            <div id="products-container">
                                <?php
                                $productsPerPage = 9;
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $productsPerPage;

                                $countQuery = "SELECT COUNT(*) as total FROM `product_info`";
                                $countResult = mysqli_query($connect, $countQuery);
                                $totalProducts = mysqli_fetch_assoc($countResult)['total'];
                                $totalPages = ceil($totalProducts / $productsPerPage);

                                $query = "SELECT * FROM `product_info` ORDER BY Id DESC LIMIT $offset, $productsPerPage";
                                $run = mysqli_query($connect, $query);
                                ?>

                                <div class="row g-3 justify-content-center" id="products-grid">
                                    <?php
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
                            <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item border shadow-sm h-100 d-flex flex-column">
                                    <div class="fruite-img position-relative">
                                        <a href="product_detail.php?id=' . $productId . '">
                                            <img src="../Admin/' . $productThumb . '" class="img-fluid w-100 rounded-top" alt="' . $productName . '">
                                        </a>
                                        <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" 
                                            style="top: 10px; left: 10px; font-size: 0.75rem;">' . $category . '</div>
                                        <div class="discount-badge">' . $discountPercent . '% OFF</div>
                                    </div>

                                    <div class="p-3 border border-secondary border-top-0 rounded-bottom d-flex flex-column justify-content-between flex-grow-1">
                                        <div>
                                            <h6 class="fw-semibold mb-2">' . $productName . '</h6>
                                            <div class="product-description text-muted mb-3">
                                                ' . $shortdes . '
                                            </div>
                                            <div class="rating-stars mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span class="text-muted ms-1">(4.5)</span>
                                            </div>

                                            <div class="price-section">
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
                                        echo '<div class="col-12"><p class="text-center">No products available.</p></div>';
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <?php if ($totalPages > 0): ?>
                                                <?php if ($page > 1): ?>
                                                    <a href="?page=<?php echo $page - 1; ?>" class="rounded">&laquo;</a>
                                                <?php else: ?>
                                                    <a href="#" class="rounded disabled" style="pointer-events: none; opacity: 0.5;">&laquo;</a>
                                                <?php endif; ?>

                                                <?php
                                                $startPage = max(1, $page - 2);
                                                $endPage = min($totalPages, $page + 2);

                                                if ($startPage > 1) {
                                                    echo '<a href="?page=1" class="rounded">1</a>';
                                                    if ($startPage > 2) {
                                                        echo '<span class="px-2">...</span>';
                                                    }
                                                }

                                                for ($i = $startPage; $i <= $endPage; $i++):
                                                ?>
                                                    <a href="?page=<?php echo $i; ?>" class="rounded <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                        <?php echo $i; ?>
                                                    </a>
                                                <?php endfor; ?>

                                                <?php
                                                if ($endPage < $totalPages) {
                                                    if ($endPage < $totalPages - 1) {
                                                        echo '<span class="px-2">...</span>';
                                                    }
                                                    echo '<a href="?page=' . $totalPages . '" class="rounded">' . $totalPages . '</a>';
                                                }
                                                ?>

                                                <?php if ($page < $totalPages): ?>
                                                    <a href="?page=<?php echo $page + 1; ?>" class="rounded">&raquo;</a>
                                                <?php else: ?>
                                                    <a href="#" class="rounded disabled" style="pointer-events: none; opacity: 0.5;">&raquo;</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <i class="fa fa-trash"></i> Clear All
            </button>
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
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
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

    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        let cartItems = [];

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
            }, 4000);
        }

        function removeToast(button) {
            const toast = button.closest('.toast');
            toast.classList.add('hiding');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }

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
                        <img src="${imagePath}" alt="${item.name}" class="cart-item-img" onerror="this.src='https://via.placeholder.com/75x75?text=No+Image'">
                        <div class="cart-item-details">
                            <div class="cart-item-name" title="${item.name}">${item.name}</div>
                            <div class="cart-item-price">Rs ${itemTotal.toFixed(2)}</div>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="event.stopPropagation(); decreaseQuantity(${index});" title="Decrease quantity">
                                    −
                                </button>
                                <span class="quantity-display" id="qty-${index}">${item.quantity}</span>
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

            cartSubtotal.style.display = 'block';
            subtotalAmount.textContent = `Rs ${subtotal.toFixed(2)}`;
        }

        function addToCart(productId, name, price, thumbnail) {
            const existingIndex = cartItems.findIndex(i => i.id === productId);

            if (existingIndex > -1) {
                cartItems[existingIndex].quantity++;
                showToast('Updated!', `${name} quantity increased to ${cartItems[existingIndex].quantity}`, 'success');
            } else {
                const item = {
                    id: productId,
                    name: name,
                    price: price,
                    thumbnail: thumbnail,
                    quantity: 1
                };
                cartItems.push(item);
                showToast('Added to Cart!', `${name} has been added to your cart`, 'success');
            }

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
            updateCartDisplay();
            showToast('Item Removed', `${itemName} has been removed from your cart`, 'info');
        }

        function clearCart() {
            if (confirm('Are you sure you want to clear the entire cart?')) {
                const itemCount = cartItems.length;
                cartItems = [];
                updateCartDisplay();
                showToast('Cart Cleared', `${itemCount} item(s) removed from your cart`, 'info');
            }
        }

        function viewCart() {
            const viewCartBtn = document.querySelector('.btn-view-cart');
            const originalContent = viewCartBtn.innerHTML;
            viewCartBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';
            viewCartBtn.disabled = true;

            setTimeout(() => {
                window.location.href = 'cart.php';
            }, 800);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
        });

        document.getElementById('cartPopup')?.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        document.addEventListener('click', function(event) {
            const popup = document.getElementById('cartPopup');
            const target = event.target;

            if (popup && popup.classList.contains('show')) {
                if (!popup.contains(target) && !target.closest('.btn-add-to-cart')) {
                    closeCartPopup();
                }
            }
        });
    </script>

    <script>
        function loadPage(page) {
            const container = document.getElementById('products-grid');
            container.style.opacity = '0.5';

            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'load_products.php?page=' + page, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('products-container').innerHTML = xhr.responseText;

                    document.querySelector('.col-lg-9').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    const newUrl = window.location.pathname + '?page=' + page;
                    window.history.pushState({
                        page: page
                    }, '', newUrl);
                }
            };

            xhr.send();
        }

        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.page) {
                loadPage(event.state.page);
            }
        });
    </script>
</body>

</html>