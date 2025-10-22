<?php

$alert = "";
  $msge = "";
  include 'connection.php';
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $thumbnail = $_FILES['thumbnail']['name'];

    $thumbnailpath = "media/thumnails/.$thumbnail";

    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailpath);

    $query = "INSERT INTO `product_category`(`Name`, `Thumbnail`, `Quantity`) VALUES ('$name','$thumbnailpath','$quantity')";
    $run = mysqli_query($connect,$query);

    if (!$run) {
      $alert = "<div class'alert alert-danger'>Category not Added</div>";
    } else {
      $alert = "<div class'alert alert-success'>Category Added</div>";
      header("location:managecategory.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
  data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Materio</title>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
  <meta name="keywords"
    content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://themeselection.com/item/materio-bootstrap-html-admin-template/">
  <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <script>(function (w, d, s, l, i) { w[l] = w[l] || []; w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' }); var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src = 'www.googletagmanager.com/gtm5445.html?id=' + i + dl; f.parentNode.insertBefore(j, f); })(window, document, 'script', 'dataLayer', 'GTM-5DDHKGP');</script>
  <!-- End Google Tag Manager -->

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon"
    href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
  <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
  <link rel="stylesheet" href="assets/vendor/libs/flatpickr/flatpickr.css" />
  <link rel="stylesheet" href="assets/vendor/libs/tagify/tagify.css" />
  <link rel="stylesheet" href="assets/vendor/libs/%40form-validation/umd/styles/index.min.css" />
  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>
</head>

<body>
  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
      style="display: none; visibility: hidden"></iframe></noscript>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo ">
          <a href="index-2.html" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
              <span style="color:var(--bs-primary);">
                <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                    fill="currentColor" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                    d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                    d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                    fill="currentColor" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                    d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
                  <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                    d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                    fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                    fill="white" fill-opacity="0.15" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                    fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                    fill="white" fill-opacity="0.3" />
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


          <!-- Apps & Pages -->
          <li class="menu-header fw-medium">
            <span class="menu-header-text">Apps &amp; Pages</span>
          </li>
          <!-- e-commerce-app menu start -->
          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons mdi mdi-cart-outline'></i>
              <div data-i18n="Dasboard">Dasboard</div>
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
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Order">Order</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="manageorder.php" class="menu-link">
                      <div data-i18n="Manage Order">Manage Order</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Category">Category</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item active">
                    <a href="addcategory.php" class="menu-link">
                      <div data-i18n="Add Category">Add Category</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="managecategory.php" class="menu-link">
                      <div data-i18n="Manage Category">Manage Category</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Banner">Banner</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addbanner.php" class="menu-link">
                      <div data-i18n="Add Banner">Add Banner</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="managebanner.php" class="menu-link">
                      <div data-i18n="Manage Banner">Manage Banner</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Gallery">Gallery</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addgallery.php" class="menu-link">
                      <div data-i18n="Add Gallery">Add Gallery</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="managegallery.php" class="menu-link">
                      <div data-i18n="Manage Gallery">Manage Gallery</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Contact">Contact</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addcontact.php" class="menu-link">
                      <div data-i18n="Add Contact">Add Contact</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="managecontact.php" class="menu-link">
                      <div data-i18n="Manage Contact">Manage Contact</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Term & Condition">Term & Condition</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addterm.php" class="menu-link">
                      <div data-i18n="Add Term & Condition">Add Term & Condition</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="manageterm.php" class="menu-link">
                      <div data-i18n="Manage Term & Condition">Manage Term & Condition</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="Privacy Policy">Privacy Policy</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addpolicy.php" class="menu-link">
                      <div data-i18n="Add Privacy Policy">Add Privacy Policy</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="managepolicy.php" class="menu-link">
                      <div data-i18n="Manage Privacy Policy">Manage Privacy Policy</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="About Us">About Us</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addaboutus.php" class="menu-link">
                      <div data-i18n="Add About Us">Add About Us</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="manageaboutus.php" class="menu-link">
                      <div data-i18n="Manage About Us">Manage About Us</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <div data-i18n="F.A.Qs">F.A.Qs</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="addfaq.php" class="menu-link">
                      <div data-i18n="Add F.A.Qs">Add F.A.Qs</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="managefaqs.php" class="menu-link">
                      <div data-i18n="Manage F.A.Qs">Manage F.A.Qs</div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </aside>
      <!-- Layout container -->
      <div class="layout-page">
        <?php include 'nav.php' ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
              <div class="col-md">
                <div class="card">
                  <h5 class="card-header">Add Category</h5>
                  <div class="card-body">
                    <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                      <?php echo $alert ?>
                      <div class="row container">
                        <div class="form-floating form-floating-outline mb-4 col-8">
                          <input type="text" class="form-control" id="categoryname" placeholder="Category Name"
                            name="name" required />
                          <label for="categoryname">Category Name</label>
                          <div class="invalid-feedback"> Please enter Category Name. </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4 col-8">
                          <input type="file" class="form-control" id="thmbnail" name="thumbnail" required />
                          <label for="thmbnail">Category Thumbnail</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4 col-8">
                          <input type="number" id="categoryquantity" class="form-control"
                            placeholder="Category Quantity" name="quantity" required />
                          <label for="categoryquantity">Category Quantity</label>
                          <div class="invalid-feedback"> Please enter Category Quantity </div>
                        </div>
                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /Bootstrap Validation -->
            </div>
          </div>
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/libs/hammer/hammer.js"></script>
  <script src="assets/vendor/libs/i18n/i18n.js"></script>
  <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="assets/vendor/js/menu.js"></script>
  <!-- Vendors JS -->
  <script src="assets/vendor/libs/select2/select2.js"></script>
  <script src="assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
  <script src="assets/vendor/libs/moment/moment.js"></script>
  <script src="assets/vendor/libs/flatpickr/flatpickr.js"></script>
  <script src="assets/vendor/libs/tagify/tagify.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>
  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <!-- Page JS -->
  <script src="assets/js/form-validation.js"></script>

</body>

</html>