<?php
include 'connection.php';

// Order count queries
$query = "SELECT * FROM `orders`";
$query1 = "SELECT * FROM `orders` WHERE order_status = 'Completed'";
$query2 = "SELECT * FROM `orders` WHERE order_status = 'Pending'";
$query3 = "SELECT * FROM `orders` WHERE order_status = 'Cancelled'";
$run = mysqli_query($connect, $query);
$run1 = mysqli_query($connect, $query1);
$run2 = mysqli_query($connect, $query2);
$run3 = mysqli_query($connect, $query3);
$count = mysqli_num_rows($run);
$count1 = mysqli_num_rows($run1);
$count2 = mysqli_num_rows($run2);
$count3 = mysqli_num_rows($run3);
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
  data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Orders</title>
  <link rel="icon" type="image/x-icon"
    href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
  <link rel="stylesheet"
    href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">

  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>

  <style>
    .order-status {
      border: none;
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: 500;
      color: #fff;
      transition: all 0.3s ease;
      text-align: center;
      cursor: pointer;
    }

    .status-pending {
      background-color: #ffc107 !important;
    }

    .status-processing {
      background-color: #0d6efd !important;
    }

    .status-completed {
      background-color: #198754 !important;
    }

    .status-cancelled {
      background-color: #dc3545 !important;
    }

    .status-updated {
      box-shadow: 0 0 10px rgba(25, 135, 84, 0.5);
    }

    .table-hover tbody tr:hover {
      background-color: #f6f8fa;
    }

    /* Search bar style */
    .search-container {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin: 20px;
    }

    .search-container input {
      width: 300px;
      padding: 8px 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      transition: all 0.3s ease;
    }

    .search-container input:focus {
      outline: none;
      border-color: #0d6efd;
      box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }
  </style>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Materio</span>
          </a>
        </div>

        <ul class="menu-inner pb-5">
          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons mdi mdi-cart-outline'></i>
              <div>Order</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item active">
                <a href="manageorder.php" class="menu-link">
                  <div>Manage Order</div>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </aside>

      <div class="layout-page">
        <?php include 'nav.php' ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Order Stats -->
            <div class="card mb-4">
              <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                  <div class="col-sm-6 col-lg-3">
                    <div
                      class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                      <div>
                        <h3 class="mb-2">
                          <span
                            class="badge rounded-pill bg-label-info me-1"><?php echo $count ?></span>
                        </h3>
                        <p class="mb-0">Total Orders</p>
                      </div>
                      <div class="avatar me-sm-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                          <i class="mdi mdi-calendar-month mdi-24px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div
                      class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                      <div>
                        <h3 class="mb-2">
                          <span
                            class="badge rounded-pill bg-label-success me-1"><?php echo $count1 ?></span>
                        </h3>
                        <p class="mb-0">Orders Completed</p>
                      </div>
                      <div class="avatar me-lg-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                          <i class="mdi mdi-check-all mdi-24px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div
                      class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                      <div>
                        <h3 class="mb-2">
                          <span
                            class="badge rounded-pill bg-label-warning me-1"><?php echo $count2 ?></span>
                        </h3>
                        <p class="mb-0">Orders Pending</p>
                      </div>
                      <div class="avatar me-sm-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                          <i class="mdi mdi-wallet-outline mdi-24px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                      <div>
                        <h3 class="mb-2">
                          <span
                            class="badge rounded-pill bg-label-danger me-1"><?php echo $count3 ?></span>
                        </h3>
                        <p class="mb-0">Orders Cancelled</p>
                      </div>
                      <div class="avatar">
                        <span class="avatar-initial rounded bg-label-secondary">
                          <i class="mdi mdi-alert-octagon-outline mdi-24px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Search bar -->
            <div class="search-container">
              <input type="text" id="searchInput" placeholder="Search orders by any field...">
            </div>

            <!-- Orders Table -->
            <div class="card">
              <h5 class="card-header">Orders</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>#</th>
                      <th>Order ID</th>
                      <th>Customer</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>City</th>
                      <th>Country</th>
                      <th>Subtotal</th>
                      <th>Shipping</th>
                      <th>Total</th>
                      <th>Payment Method</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="orderTableBody">
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM `orders` ORDER BY id DESC";
                    $run = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($run) > 0) {
                      while ($row = mysqli_fetch_assoc($run)) {
                        $statusClass = 'status-' . strtolower($row['order_status']);
                    ?>
                        <tr id="row-<?php echo $row['id'] ?>">
                          <td><?php echo $i ?></td>
                          <td><?php echo $row['order_id'] ?></td>
                          <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                          <td><?php echo $row['email'] ?></td>
                          <td><?php echo $row['mobile'] ?></td>
                          <td><?php echo $row['city'] ?></td>
                          <td><?php echo $row['country'] ?></td>
                          <td>Rs:<?php echo number_format($row['subtotal'], 2) ?></td>
                          <td>Rs:<?php echo number_format($row['shipping'], 2) ?></td>
                          <td>Rs:<?php echo number_format($row['total'], 2) ?></td>
                          <td><?php echo $row['payment_method'] ?></td>
                          <td>
                            <select class="order-status <?php echo $statusClass; ?>"
                              data-id="<?php echo $row['id']; ?>">
                              <option value="Pending"
                                <?php if ($row['order_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                              <option value="Processing"
                                <?php if ($row['order_status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                              <option value="Completed"
                                <?php if ($row['order_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                              <option value="Cancelled"
                                <?php if ($row['order_status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                          </td>
                          <td><?php echo date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                          <td>
                            <a href="orderdetails.php?Id=<?php echo $row['id'] ?>">
                              <i class="mdi mdi-eye me-1 text-secondary"></i>
                            </a>
                          </td>
                        </tr>
                    <?php $i++;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>

  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    // Live search filter
    $("#searchInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#orderTableBody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    // Order status change AJAX
    $(document).on('change', '.order-status', function() {
      var id = $(this).data('id');
      var status = $(this).val();
      var select = $(this);

      select.removeClass('status-pending status-processing status-completed status-cancelled');
      if (status === 'Pending') select.addClass('status-pending');
      else if (status === 'Processing') select.addClass('status-processing');
      else if (status === 'Completed') select.addClass('status-completed');
      else select.addClass('status-cancelled');

      $.ajax({
        url: 'update_order_status.php',
        type: 'POST',
        data: {
          id: id,
          status: status
        },
        success: function(response) {
          if (response.trim() === 'success') {
            select.addClass('status-updated');
            setTimeout(() => select.removeClass('status-updated'), 1000);
          } else {
            alert('Failed to update order status!');
          }
        },
        error: function() {
          alert('Error updating order status.');
        }
      });
    });
  </script>
</body>

</html>