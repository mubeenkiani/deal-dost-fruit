<?php
include 'connection.php';

$orderId = isset($_GET['order_id']) ? $_GET['order_id'] : '';

if (empty($orderId)) {
    header('Location: shop.php');
    exit();
}

// Fetch order details
$orderId = mysqli_real_escape_string($connect, $orderId);
$query = "SELECT * FROM orders WHERE order_id = '$orderId'";
$result = mysqli_query($connect, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    header('Location: shop.php');
    exit();
}

$cartItems = json_decode($order['cart_data'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - Thank You!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f8f9fa;
        }
        .success-animation {
            text-align: center;
            padding: 40px 0;
        }
        .success-checkmark {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d4edda;
            animation: scaleIn 0.5s ease-out;
            box-shadow: 0 10px 30px rgba(21, 87, 36, 0.3);
        }
        .success-checkmark i {
            font-size: 50px;
            color: #155724;
        }
        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        .order-details-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .order-item {
            border-bottom: 1px solid #dee2e6;
            padding: 15px 0;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .order-item-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
        }
        .order-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .badge-status {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .info-row {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #666;
            min-width: 150px;
            display: inline-block;
        }
        .info-value {
            color: #333;
        }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .order-details-card { box-shadow: none; border: 1px solid #ddd; }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="success-animation">
                    <div class="success-checkmark">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2 class="mt-4 mb-2">🎉 Order Placed Successfully!</h2>
                    <p class="text-muted mb-4">Thank you for your order. We'll contact you soon for delivery confirmation.</p>
                </div>

                <div class="order-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2"><i class="fas fa-receipt me-2"></i>Order Details</h4>
                            <p class="mb-1"><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
                            <p class="mb-0"><strong>Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <span class="badge bg-warning text-dark badge-status">
                                <i class="fas fa-clock me-1"></i><?php echo $order['order_status']; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="order-details-card">
                            <h5 class="mb-4"><i class="fas fa-user text-primary me-2"></i>Customer Information</h5>
                            <div class="info-row">
                                <span class="info-label">Name:</span>
                                <span class="info-value"><?php echo $order['first_name'] . ' ' . $order['last_name']; ?></span>
                            </div>
                            <?php if ($order['company_name']): ?>
                            <div class="info-row">
                                <span class="info-label">Company:</span>
                                <span class="info-value"><?php echo $order['company_name']; ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="info-row">
                                <span class="info-label">Email:</span>
                                <span class="info-value"><?php echo $order['email']; ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Mobile:</span>
                                <span class="info-value"><?php echo $order['mobile']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="order-details-card">
                            <h5 class="mb-4"><i class="fas fa-map-marker-alt text-danger me-2"></i>Shipping Address</h5>
                            <div class="info-row">
                                <span class="info-label">Address:</span>
                                <span class="info-value"><?php echo $order['address']; ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">City:</span>
                                <span class="info-value"><?php echo $order['city']; ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Postcode:</span>
                                <span class="info-value"><?php echo $order['postcode']; ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Country:</span>
                                <span class="info-value"><?php echo $order['country']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-details-card">
                    <h5 class="mb-4"><i class="fas fa-shopping-bag text-success me-2"></i>Order Items</h5>
                    <?php foreach ($cartItems as $item): 
                        $itemTotal = $item['price'] * $item['quantity'];
                    ?>
                    <div class="order-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3 flex-grow-1">
                                <img src="../Admin/<?php echo $item['thumbnail']; ?>" class="order-item-img" alt="<?php echo $item['name']; ?>">
                                <div>
                                    <h6 class="mb-1"><?php echo $item['name']; ?></h6>
                                    <small class="text-muted">Quantity: <?php echo $item['quantity']; ?> × Rs <?php echo number_format($item['price'], 2); ?></small>
                                </div>
                            </div>
                            <div class="text-end">
                                <strong class="text-primary">Rs <?php echo number_format($itemTotal, 2); ?></strong>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <strong>Rs <?php echo number_format($order['subtotal'], 2); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping:</span>
                            <strong>Rs <?php echo number_format($order['shipping'], 2); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                            <h5 class="mb-0">Total Amount:</h5>
                            <h4 class="mb-0 text-primary">Rs <?php echo number_format($order['total'], 2); ?></h4>
                        </div>
                    </div>
                </div>

                <div class="order-details-card">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="mb-2"><i class="fas fa-credit-card text-warning me-2"></i>Payment Method</h6>
                            <p class="mb-0 text-muted"><?php echo $order['payment_method']; ?></p>
                        </div>
                        <?php if ($order['order_notes']): ?>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <h6 class="mb-2"><i class="fas fa-sticky-note text-info me-2"></i>Order Notes</h6>
                            <p class="mb-0 text-muted"><?php echo nl2br($order['order_notes']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="text-center mt-4 no-print">
                    <a href="shop.php" class="btn btn-primary px-5 py-3 me-3">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-secondary px-5 py-3">
                        <i class="fas fa-print me-2"></i>Print Order
                    </button>
                </div>

                <div class="alert alert-info mt-4 text-center no-print">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Important:</strong> Please keep your Order ID (<?php echo $order['order_id']; ?>) for tracking purposes. 
                    We'll contact you soon at <strong><?php echo $order['mobile']; ?></strong> for delivery confirmation.
                </div>

                <div class="alert alert-success mt-3 text-center no-print">
                    <i class="fas fa-envelope me-2"></i>
                    A confirmation email will be sent to <strong><?php echo $order['email']; ?></strong>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Clear cart from localStorage
        localStorage.removeItem('cartItems');
        
        // Optional: Show a toast notification
        console.log('Order placed successfully! Cart cleared.');
    </script>
</body>
</html>