<!-- Add this CSS in your <head> section or style.css -->
<style>
.cart-popup {
    position: fixed;
    top: -100%;
    right: 20px;
    width: 400px;
    max-height: 650px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    z-index: 9999;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.cart-popup.show {
    top: 80px;
}

.cart-popup-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-popup-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s;
}

.cart-popup-close:hover {
    background: rgba(255,255,255,0.3);
    transform: rotate(90deg);
}

.cart-popup-body {
    max-height: 380px;
    overflow-y: auto;
    padding: 15px;
    flex: 1;
}

.cart-popup-body::-webkit-scrollbar {
    width: 6px;
}

.cart-popup-body::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.cart-popup-body::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.cart-item {
    display: flex;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 10px;
    animation: slideIn 0.3s ease;
    position: relative;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.cart-item-img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
}

.cart-item-details {
    flex: 1;
    min-width: 0;
}

.cart-item-name {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-right: 25px;
}

.cart-item-price {
    color: #667eea;
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 8px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.quantity-btn {
    background: #667eea;
    color: white;
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    padding: 0;
    line-height: 1;
    font-weight: bold;
}

.quantity-btn:hover {
    background: #5568d3;
    transform: scale(1.1);
}

.quantity-btn:active {
    transform: scale(0.95);
}

.quantity-display {
    min-width: 35px;
    text-align: center;
    font-weight: 600;
    font-size: 15px;
    color: #333;
    background: white;
    padding: 4px 10px;
    border-radius: 5px;
    border: 2px solid #e0e0e0;
}

.cart-item-remove {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #dc3545;
    color: white;
    border: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    padding: 0;
    line-height: 1;
    font-weight: bold;
}

.cart-item-remove:hover {
    background: #c82333;
    transform: scale(1.15);
}

.cart-subtotal {
    padding: 15px 20px;
    background: #fff;
    border-top: 2px solid #e0e0e0;
    border-bottom: 2px solid #e0e0e0;
}

.cart-subtotal-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-subtotal-label {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.cart-subtotal-amount {
    font-size: 22px;
    font-weight: bold;
    color: #667eea;
}

.cart-popup-footer {
    padding: 15px 20px;
    background: #f8f9fa;
    display: flex;
    gap: 10px;
}

.cart-popup-footer button {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 14px;
}

.btn-view-cart {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-view-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.btn-clear-cart {
    background: white;
    color: #dc3545;
    border: 2px solid #dc3545 !important;
}

.btn-clear-cart:hover {
    background: #dc3545;
    color: white;
}

.empty-cart {
    text-align: center;
    padding: 50px 20px;
    color: #999;
}

.empty-cart i {
    font-size: 60px;
    margin-bottom: 15px;
    opacity: 0.5;
}

.cart-badge {
    background: #dc3545;
    color: white;
    border-radius: 12px;
    padding: 3px 10px;
    font-size: 12px;
    font-weight: bold;
    margin-left: 8px;
}

@media (max-width: 576px) {
    .cart-popup {
        width: 95%;
        right: 2.5%;
    }
}
</style>

<!-- Add this HTML before closing </body> tag -->
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

<!-- Add this JavaScript before closing </body> tag -->
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

<!-- Updated Product Card HTML -->
<div class="tab-content">
    <div id="tab-1" class="tab-pane fade show p-0 active">
        <div class="row g-4">
            <?php
            include 'config.php';
            $query = "SELECT * FROM `product_info` ORDER BY Id DESC";
            $run = mysqli_query($connect, $query);

            if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_assoc($run)) {
                    $stockClass = $row['Stock'] == 'InStock' ? 'success' : 'danger';
                    $productId = $row['Id'];
                    $productName = htmlspecialchars($row['Name']);
                    $productPrice = htmlspecialchars($row['Price']);
                    $productThumb = htmlspecialchars($row['Thumbnail']);
                    
                    echo '
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="rounded position-relative fruite-item border shadow-sm h-100 d-flex flex-column">
                    <div class="fruite-img position-relative" style="overflow: hidden;">
                        <a href="product_detail.php?id=' . $productId . '">
                            <img src="../Admin/' . $productThumb . '" class="img-fluid w-100 rounded-top" alt="" style="object-fit: cover; height: 230px;">
                        </a>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" 
                            style="top: 10px; left: 10px;">' . htmlspecialchars($row['Category'] ?? 'Product') . '</div>
                    </div>

                    <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column justify-content-between flex-grow-1">
                        <div>
                            <h5 class="fw-semibold mb-2">' . $productName . '</h5>
                            <p class="text-muted mb-3" style="min-height: 50px;">' . htmlspecialchars(substr($row['Description'], 0, 80)) . '...</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                            <p class="text-dark fs-5 fw-bold mb-0">Rs ' . $productPrice . '</p>
                            <button type="button" 
                                class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart"
                                onclick="event.stopPropagation(); addToCart(\'' . $productId . '\', \'' . addslashes($productName) . '\', \'' . $productPrice . '\', \'' . $productThumb . '\');">
                                <i class="fa fa-shopping-cart me-2 text-primary"></i> Add to Cart
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