<?php
include 'connection.php';

if (!isset($_GET['Id'])) {
  header('Location: manageorder.php');
  exit();
}

$order_id = $_GET['Id'];

if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
  $query = "SELECT * FROM `orders` WHERE id = '$order_id'";
  $run = mysqli_query($connect, $query);
  
  if (mysqli_num_rows($run) == 0) {
    echo json_encode(['error' => 'Order not found']);
    exit();
  }
  
  $order = mysqli_fetch_assoc($run);
  echo json_encode($order);
  exit();
}

$query = "SELECT * FROM `orders` WHERE id = '$order_id'";
$run = mysqli_query($connect, $query);

if (mysqli_num_rows($run) == 0) {
  header('Location: manageorder.php');
  exit();
}

$order = mysqli_fetch_assoc($run);
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Order Receipt - <?php echo $order['order_id']; ?></title>

  <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>

  <style>
    @media print {
      .no-print {
        display: none !important;
      }
      .receipt-container {
        box-shadow: none !important;
        margin: 0 !important;
        page-break-inside: avoid;
      }
      body {
        background: white !important;
      }
    }

    .receipt-container {
      background: white;
      padding: 30px;
      max-width: 700px;
      margin: 0 auto;
    }

    .receipt-header {
      text-align: center;
      padding-bottom: 15px;
      margin-bottom: 20px;
      border-bottom: 2px solid #000;
    }

    .receipt-logo {
      font-size: 28px;
      font-weight: 700;
      color: #000;
      margin-bottom: 5px;
    }

    .receipt-title {
      font-size: 14px;
      font-weight: 600;
      color: #333;
      text-transform: uppercase;
    }

    .qr-section {
      text-align: center;
      margin-bottom: 20px;
      padding: 15px;
      background: white;
      min-height: 250px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #qrcode-container {
      display: inline-block;
      text-align: center;
    }

    #qrcode-image {
      max-width: 200px;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    .qr-loading {
      padding: 80px;
      text-align: center;
      color: #666;
      font-size: 14px;
    }

    .receipt-details {
      padding: 15px 0;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      font-size: 14px;
    }

    .detail-label {
      font-weight: 600;
      color: #333;
      width: 45%;
    }

    .detail-value {
      color: #666;
      width: 55%;
      text-align: right;
      word-break: break-word;
    }

    .section-spacer {
      height: 15px;
    }

    .total-section {
      background: #f5f5f5;
      padding: 15px;
      margin-top: 15px;
      margin-bottom: 20px;
    }

    .total-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      font-size: 14px;
    }

    .grand-total {
      font-size: 20px;
      font-weight: 700;
      padding-top: 12px;
      margin-top: 12px;
      border-top: 2px solid #000;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 10px;
      border: 1px solid #333;
      font-weight: 600;
      font-size: 11px;
    }

    .receipt-footer {
      text-align: center;
      margin-top: 20px;
      padding-top: 15px;
      color: #666;
      font-size: 12px;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
              <span style="color:var(--bs-primary);">
                <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z" fill="currentColor" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z" fill="currentColor" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="white" fill-opacity="0.15" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.990 0.411583 237.721 1.18923Z" fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.990 0.411583 237.721 1.18923Z" fill="white" fill-opacity="0.3" />
                </svg>
              </span>
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Materio</span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
          </a>
        </div>

        <ul class="menu-inner pb-5">
          <li class="menu-header fw-medium">
            <span class="menu-header-text">Apps &amp; Pages</span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons mdi mdi-cart-outline'></i>
              <div data-i18n="Dasboard">Dashboard</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="index.php" class="menu-link">
                  <div data-i18n="Dashboard">Dashboard</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Products">Products</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addproduct.php" class="menu-link">
                      <div data-i18n="Add Product">Add Product</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="manageproduct.php" class="menu-link">
                      <div data-i18n="Manage Product">Manage Product</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Order">Order</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item active">
                    <a href="manageorder.php" class="menu-link">
                      <div data-i18n="Manage Order">Manage Order</div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </aside>

      <div class="layout-page">
        <?php include 'nav.php'; ?>

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            <div class="action-buttons no-print">
              <a href="manageorder.php" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left me-1"></i> Back
              </a>
              <button onclick="printReceipt()" class="btn btn-primary">
                <i class="mdi mdi-printer me-1"></i> Print
              </button>
              <button onclick="downloadPDF()" class="btn btn-success">
                <i class="mdi mdi-download me-1"></i> Download PDF
              </button>
            </div>

            <div class="receipt-container" id="receipt">

              <div class="receipt-header">
                <div class="receipt-logo">MATERIO</div>
                <div class="receipt-title">Order Receipt</div>
              </div>

              <div class="qr-section">
                <div id="qrcode-container">
                  <img id="qrcode-image" src="" alt="QR Code" style="display:none;" />
                  <div class="qr-loading">Loading QR Code...</div>
                </div>
              </div>

              <div class="receipt-details">
                <div class="detail-row">
                  <span class="detail-label">Order ID:</span>
                  <span class="detail-value"><?php echo $order['order_id']; ?></span>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Order Date:</span>
                  <span class="detail-value"><?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></span>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Status:</span>
                  <span class="detail-value">
                    <span class="status-badge"><?php echo $order['order_status']; ?></span>
                  </span>
                </div>

                <div class="section-spacer"></div>

                <div class="detail-row">
                  <span class="detail-label">Customer Name:</span>
                  <span class="detail-value"><?php echo $order['first_name'] . ' ' . $order['last_name']; ?></span>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Email:</span>
                  <span class="detail-value"><?php echo $order['email']; ?></span>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Mobile:</span>
                  <span class="detail-value"><?php echo $order['mobile']; ?></span>
                </div>

                <div class="section-spacer"></div>

                <div class="detail-row">
                  <span class="detail-label">Address:</span>
                  <span class="detail-value"><?php echo !empty($order['address']) ? $order['address'] : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                  <span class="detail-label">City:</span>
                  <span class="detail-value"><?php echo $order['city']; ?></span>
                </div>
                <div class="detail-row">
                  <span class="detail-label">Country:</span>
                  <span class="detail-value"><?php echo $order['country']; ?></span>
                </div>
                <?php if (!empty($order['zip'])) { ?>
                <div class="detail-row">
                  <span class="detail-label">ZIP Code:</span>
                  <span class="detail-value"><?php echo $order['zip']; ?></span>
                </div>
                <?php } ?>

                <div class="section-spacer"></div>

                <div class="detail-row">
                  <span class="detail-label">Payment Method:</span>
                  <span class="detail-value"><?php echo $order['payment_method']; ?></span>
                </div>
              </div>

              <div class="total-section">
                <div class="total-row">
                  <span>Subtotal:</span>
                  <span>$<?php echo number_format($order['subtotal'], 2); ?></span>
                </div>
                <div class="total-row">
                  <span>Shipping:</span>
                  <span>$<?php echo number_format($order['shipping'], 2); ?></span>
                </div>
                <?php if (!empty($order['tax']) && $order['tax'] > 0) { ?>
                <div class="total-row">
                  <span>Tax:</span>
                  <span>$<?php echo number_format($order['tax'], 2); ?></span>
                </div>
                <?php } ?>
                <?php if (!empty($order['discount']) && $order['discount'] > 0) { ?>
                <div class="total-row">
                  <span>Discount:</span>
                  <span>-$<?php echo number_format($order['discount'], 2); ?></span>
                </div>
                <?php } ?>
                <div class="total-row grand-total">
                  <span>GRAND TOTAL:</span>
                  <span>$<?php echo number_format($order['total'], 2); ?></span>
                </div>
              </div>

              <div class="receipt-footer">
                <p style="margin: 5px 0; font-weight: 600;">Thank You For Your Order!</p>
                <p style="margin: 5px 0;">Email: support@materio.com | Phone: +1 234 567 8900</p>
              </div>

            </div>

          </div>

          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/js/menu.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    var orderId = <?php echo $order_id; ?>;
    var qrCodeGenerated = false;

    function generateQRCodeAsImage(text) {
      const tempDiv = document.createElement('div');
      tempDiv.style.position = 'absolute';
      tempDiv.style.left = '-9999px';
      document.body.appendChild(tempDiv);

      const qr = new QRCode(tempDiv, {
        text: text,
        width: 200,
        height: 200,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
      });

      setTimeout(() => {
        const canvas = tempDiv.querySelector('canvas');
        if (canvas) {
          const imgData = canvas.toDataURL('image/png');
          const qrImage = document.getElementById('qrcode-image');
          qrImage.src = imgData;
          qrImage.style.display = 'block';
          document.querySelector('.qr-loading').style.display = 'none';
          qrCodeGenerated = true;
        }
        document.body.removeChild(tempDiv);
      }, 300);
    }

    function initQRCode() {
      fetch(window.location.pathname + '?Id=' + orderId + '&ajax=1')
        .then(response => response.json())
        .then(order => {
          var orderData = "ORDER: " + order.order_id + "\n" +
            "DATE: " + order.created_at + "\n" +
            "STATUS: " + order.order_status + "\n" +
            "CUSTOMER: " + order.first_name + " " + order.last_name + "\n" +
            "EMAIL: " + order.email + "\n" +
            "PHONE: " + order.mobile + "\n" +
            "TOTAL: $" + parseFloat(order.total).toFixed(2) + "\n" +
            "PAYMENT: " + order.payment_method;

          generateQRCodeAsImage(orderData);
        })
        .catch(error => {
          console.error('QR Code Error:', error);
          document.querySelector('.qr-loading').innerHTML = 'QR Code Failed';
        });
    }

    function printReceipt() {
      window.print();
    }

    function downloadPDF() {
      if (!qrCodeGenerated) {
        alert('Please wait for QR code to load completely.');
        return;
      }

      const receiptElement = document.getElementById('receipt');
      const buttons = document.querySelectorAll('.no-print');
      const backdrop = document.querySelector('.content-backdrop');
      const overlay = document.querySelector('.layout-overlay');
      
      buttons.forEach(btn => btn.style.display = 'none');
      if (backdrop) backdrop.style.display = 'none';
      if (overlay) overlay.style.display = 'none';

      setTimeout(() => {
        html2canvas(receiptElement, {
          scale: 2.5,
          useCORS: true,
          allowTaint: false,
          logging: false,
          backgroundColor: '#ffffff',
          width: receiptElement.offsetWidth,
          height: receiptElement.offsetHeight,
          scrollY: 0,
          scrollX: 0
        }).then(canvas => {
          const imgData = canvas.toDataURL('image/png');
          const pdf = new jspdf.jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4',
            compress: true
          });
          
          const pageWidth = pdf.internal.pageSize.getWidth();
          const pageHeight = pdf.internal.pageSize.getHeight();
          const margin = 10;
          const contentWidth = pageWidth - (margin * 2);
          const contentHeight = (canvas.height * contentWidth) / canvas.width;
          
          if (contentHeight <= pageHeight - (margin * 2)) {
            pdf.addImage(imgData, 'PNG', margin, margin, contentWidth, contentHeight, undefined, 'FAST');
          } else {
            const ratio = (pageHeight - (margin * 2)) / contentHeight;
            const adjustedWidth = contentWidth * ratio;
            const adjustedHeight = contentHeight * ratio;
            pdf.addImage(imgData, 'PNG', margin, margin, adjustedWidth, adjustedHeight, undefined, 'FAST');
          }

          pdf.save('Order_<?php echo $order['order_id']; ?>.pdf');
          
          buttons.forEach(btn => btn.style.display = '');
          if (backdrop) backdrop.style.display = '';
          if (overlay) overlay.style.display = '';
        }).catch(error => {
          console.error('PDF Error:', error);
          alert('Failed to generate PDF. Please try again.');
          buttons.forEach(btn => btn.style.display = '');
          if (backdrop) backdrop.style.display = '';
          if (overlay) overlay.style.display = '';
        });
      }, 500);
    }

    document.addEventListener('DOMContentLoaded', function() {
      initQRCode();
    });
  </script>

</body>

</html>