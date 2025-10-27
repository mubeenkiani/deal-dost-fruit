<?php
include 'connection.php';
$query = "SELECT * FROM `product_info`";
$query1 = "SELECT * FROM `product_info` WHERE Stock = 'InStock'";
$query2 = "SELECT * FROM `product_info` WHERE Stock = 'Out Of Stock'";
$run = mysqli_query($connect, $query);
$run1 = mysqli_query($connect, $query1);
$run2 = mysqli_query($connect, $query2);
$count = mysqli_num_rows($run);
$count1 = mysqli_num_rows($run1);
$count2 = mysqli_num_rows($run2);
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
  data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Manage Products - Materio</title>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
  <meta name="keywords" content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

  <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
  <link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
  <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    .product-thumbnail {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }

    .color-dots {
      display: flex;
      gap: 4px;
    }

    .color-dot {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid #e0e0e0;
      display: inline-block;
    }

    .action-buttons a {
      padding: 6px 10px;
      margin: 0 2px;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .action-buttons a:hover {
      background: #f5f5f5;
    }
  </style>

  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>
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
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="white" fill-opacity="0.3" />
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
          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons mdi mdi-cart-outline'></i>
              <div data-i18n="Dashboard">Dashboard</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="index.php" class="menu-link">
                  <div data-i18n="Dashboard">Dashboard</div>
                </a>
              </li>
              <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Products">Products</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addproduct.php" class="menu-link">
                      <div data-i18n="Add Product">Add Product</div>
                    </a>
                  </li>
                  <li class="menu-item active">
                    <a href="manageproduct.php" class="menu-link">
                      <div data-i18n="Manage Product">Manage Product</div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </aside>

      <div class="layout-page">
        <?php include 'nav.php' ?>

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-5">
              <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                  <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-4">
                      <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                        <div>
                          <p class="mb-2">Total Products</p>
                          <h4 class="mb-2">
                            <span class="badge rounded-pill bg-label-primary"><?php echo $count ?></span>
                          </h4>
                        </div>
                        <div class="avatar me-sm-4">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="mdi mdi-package-variant-closed mdi-24px"></i>
                          </span>
                        </div>
                      </div>
                      <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>
                    <div class="col-sm-6 col-lg-4">
                      <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                        <div>
                          <p class="mb-2">In Stock</p>
                          <h4 class="mb-2">
                            <span class="badge rounded-pill bg-label-success"><?php echo $count1 ?></span>
                          </h4>
                        </div>
                        <div class="avatar me-lg-4">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="mdi mdi-check-circle mdi-24px"></i>
                          </span>
                        </div>
                      </div>
                      <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-4">
                      <div class="d-flex justify-content-between align-items-start card-widget-3">
                        <div>
                          <p class="mb-2">Out of Stock</p>
                          <h4 class="mb-2">
                            <span class="badge rounded-pill bg-label-danger"><?php echo $count2 ?></span>
                          </h4>
                        </div>
                        <div class="avatar me-sm-4">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="mdi mdi-alert-circle mdi-24px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product List</h5>
                <a href="addproduct.php" class="btn btn-primary">
                  <i class="mdi mdi-plus me-1"></i>Add New Product
                </a>
              </div>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Rating</th>
                      <th>Colors</th>
                      <th>Quantity</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM `product_info` ORDER BY Id DESC";
                    $run = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($run) > 0) {
                      while ($row = mysqli_fetch_assoc($run)) {
                        $statusBadge = ($row['Stock'] == 'InStock') ? 'success' : 'danger';
                        $discountPrice = $row['Price'] * (1 - ($row['DiscountPercent'] / 100));
                        $colors = !empty($row['ColorVariants']) ? explode(',', $row['ColorVariants']) : [];
                    ?>
                        <tr>
                          <td><?php echo $i ?></td>
                          <td>
                            <img src="<?php echo htmlspecialchars($row['Thumbnail']) ?>" class="product-thumbnail" alt="Product">
                          </td>
                          <td>
                            <strong><?php echo htmlspecialchars($row['Name']) ?></strong><br>
                            <small class="text-muted"><?php echo htmlspecialchars($row['Brand']) ?></small>
                          </td>
                          <td>
                            <span class="badge bg-label-info"><?php echo htmlspecialchars($row['Category']) ?></span>
                          </td>
                          <td>
                            <strong class="text-success">Rs <?php echo number_format($discountPrice, 0) ?></strong><br>
                            <small class="text-muted text-decoration-line-through">Rs <?php echo number_format($row['Price'], 0) ?></small>
                          </td>
                          <td>
                            <span class="badge bg-label-warning"><?php echo $row['DiscountPercent'] ?>% OFF</span>
                          </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <i class="mdi mdi-star text-warning me-1"></i>
                              <span><?php echo $row['Rating'] ?></span>
                            </div>
                          </td>
                          <td>
                            <div class="color-dots">
                              <?php
                              if (!empty($colors)) {
                                foreach (array_slice($colors, 0, 3) as $color) {
                                  echo '<span class="color-dot" style="background-color: ' . htmlspecialchars(trim($color)) . ';" title="' . htmlspecialchars(trim($color)) . '"></span>';
                                }
                                if (count($colors) > 3) {
                                  echo '<span class="badge bg-label-secondary">+' . (count($colors) - 3) . '</span>';
                                }
                              } else {
                                echo '<span class="text-muted">N/A</span>';
                              }
                              ?>
                            </div>
                          </td>
                          <td>
                            <span class="badge bg-label-primary"><?php echo $row['Quantity'] ?></span>
                          </td>
                          <td>
                            <span class="badge rounded-pill bg-label-<?php echo $statusBadge ?>">
                              <?php echo htmlspecialchars($row['Stock']) ?>
                            </span>
                          </td>
                          <td>
                            <div class="action-buttons">
                              <a href="editproduct.php?Id=<?php echo $row['Id'] ?>" title="Edit">
                                <i class="mdi mdi-pencil-outline mdi-20px text-primary"></i>
                              </a>
                              <a href="deleteproduct.php?Id=<?php echo $row['Id'] ?>"
                                onclick="return confirm('Are you sure you want to delete this product?')"
                                title="Delete">
                                <i class="mdi mdi-trash-can-outline mdi-20px text-danger"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                    <?php
                        $i++;
                      }
                    } else {
                      echo '<tr><td colspan="11" class="text-center py-4">No products found</td></tr>';
                    }
                    ?>
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
  <script src="assets/vendor/libs/hammer/hammer.js"></script>
  <script src="assets/vendor/libs/i18n/i18n.js"></script>
  <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="assets/vendor/js/menu.js"></script>
  <script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
  <script src="assets/vendor/libs/select2/select2.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/app-ecommerce-product-list.js"></script>

</body>

</html>