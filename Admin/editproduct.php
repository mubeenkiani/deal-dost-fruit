<?php
  $id = $_GET['Id'];
  $msge = "";
  include 'connection.php';
  if(isset($_POST['Update'])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $brand = $_POST['brand'];
    $freshnes = $_POST['freshnes'];
    $status = $_POST['status'];
    $desciption = $_POST['desciption'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $oldthumbnail = $_POST['oldthumbnail'];
    if ($thumbnail == "") {
      $thumbnailpath = $oldthumbnail;
    } else {
      $thumbnailpath = "media/thumnails/.$thumbnail";
      move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailpath);
    }
    $image1 = $_FILES['image1']['name'];
    $oldimage1 = $_POST['oldimage1'];
    if ($image1 == "") {
      $image1path = $oldimage1;
    } else {
      $image1path = "media/thumnails/.$image1";
      move_uploaded_file($_FILES['image1']['tmp_name'], $image1path);
    }
    $oldimage2 = $_POST['oldimage2'];
    $image2 = $_FILES['image2']['name'];
    if ($image2 == "") {
      $image2path = $oldimage2;
    } else {
      $image2path = "media/thumnails/.$image2";
      move_uploaded_file($_FILES['image2']['tmp_name'], $image2path);
    }
    $oldimage3 = $_POST['oldimage3'];
    $image3 = $_FILES['image3']['name'];
    if ($image3 == "") {
      $image3path = $oldimage3;
    } else {
      $image3path = "media/thumnails/.$image3";
      move_uploaded_file($_FILES['image3']['tmp_name'], $image3path);
    }
    $oldimage4 = $_POST['oldimage4'];
    $image4 = $_FILES['image4']['name'];
    if ($image4 == "") {
      $image4path = $oldimage4;
    } else {
      $image4path = "media/thumnails/.$image4";
      move_uploaded_file($_FILES['image4']['tmp_name'], $image4path);
    }
    $query = "UPDATE `product_info` SET `Name`='$name',`Category`='$category',`Price`='$price',`Quantity`='$quantity',`City`='$city',`Country`='$country',`Brand`='$brand',`Freshness`='$freshnes',`Description`='$desciption',`Thumbnail`='$thumbnailpath',`Image1`='$image1path',`Image2`='$image2path',`Image3`='$image3path',`Image4`='$image4path',`Stock`='$status' WHERE Id = '$id'";
    $run = mysqli_query($connect,$query);
    if ($run) {
      
      header("location:manageproduct.php");
    } else {
    }  
  }
  $sql = "SELECT * FROM `product_info` WHERE Id = '$id'";
  $run = mysqli_query($connect,$sql);
  if (mysqli_num_rows($run)>0) {
    while ($row = mysqli_fetch_assoc($run)) {
      $oldname = $row['Name'];
      $oldcategry = $row['Category'];
      $oldprice = $row['Price'];
      $oldquantity = $row['Quantity'];
      $oldcity = $row['City'];
      $oldcountry = $row['Country'];
      $oldbrand = $row['Brand'];
      $oldfreshnes = $row['Freshness'];
      $olddesciption = $row['Description'];
      $oldthumbnail = $row['Thumbnail'];
      $oldimage1 = $row['Image1'];
      $oldimage2 = $row['Image2'];
      $oldimage3 = $row['Image3'];
      $oldimage4 = $row['Image4'];
      $oldstatus = $row['Status'];
    }
  }
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

  
<!-- Mirrored from demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Sep 2023 05:42:41 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Materio</title>

    
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/materio-bootstrap-html-admin-template/">
    
    
    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5DDHKGP');</script>
    <!-- End Google Tag Manager -->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap" rel="stylesheet">

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

    <!-- Page CSS -->
    

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    
</head>

<body>

  
  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  
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
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <div data-i18n="Category">Category</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
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
<!-- / Menu -->

    

    <!-- Layout container -->
    <div class="layout-page">
      
      



<!-- Navbar -->

<?php include 'nav.php' ?>

<!-- / Navbar -->

      

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            

<div class="row mb-4">
  <div class="col-md">
    <div class="card">
      <h5 class="card-header">Update Product</h5>
      <div class="card-body">
        <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
          <?php echo $msge ?>
          <div class="row">
          <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="text" class="form-control" id="productname" placeholder="Product Name" name="name" value="<?php echo $oldname ?>" required />
              <label for="productname">Product Name</label>
              <div class="invalid-feedback"> Please enter Product Name. </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="text" id="productcategory" class="form-control" placeholder="Product Category" name="category" value="<?php echo $oldcategry ?>" required />
              <label for="productcategory">Product Category</label>
              <div class="invalid-feedback"> Please enter Product Category </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="number" class="form-control" id="productprice" placeholder="Product Price" name="price" value="<?php echo $oldprice ?>" required />
              <label for="productprice">Product Price</label>
              <div class="invalid-feedback"> Please enter Product Price. </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="number" id="productquantity" class="form-control" placeholder="Product Quantity" name="quantity" value="<?php echo $oldquantity ?>" required />
              <label for="productquantity">Product Quantity</label>
              <div class="invalid-feedback"> Please enter Product Quantity </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <select class="form-select" id="city" name="city" value="<?php echo $oldcity ?>" required>
                <option value="">Select City</option>
                <option value="NewYork" <?php if ($oldcity == "NewYork") { echo"selected";} ?>>New York</option>
                <option value="LiverPool" <?php if ($oldcity == "LiverPool") { echo"selected";} ?>>Liver Pool</option>
                <option value="AuckLand" <?php if ($oldcity == "AuckLand") { echo"selected";} ?>>AuckLand</option>
                <option value="Sydney" <?php if ($oldcity == "Sydney") { echo"selected";} ?>>Sydney</option>
                <option value="Islambad" <?php if ($oldcity == "Islambad") { echo"selected";} ?>>Islambad</option>
              </select>
              <label class="form-label" for="city">City</label>
              <div class="invalid-feedback"> Please select your City </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <select class="form-select" id="country" name="country" value="<?php echo $oldcountry ?>" required>
                <option value="">Select Country</option>
                <option value="USA" <?php if ($oldcountry == "USA") { echo"selected";} ?>>USA</option>
                <option value="UK" <?php if ($oldcountry == "UK") { echo"selected";} ?>>UK</option>
                <option value="NewZealand" <?php if ($oldcountry == "NewZealand") { echo"selected";} ?>>New Zealannd</option>
                <option value="Australia" <?php if ($oldcountry == "Australia") { echo"selected";} ?>>Australia</option>
                <option value="Pakiatan" <?php if ($oldcountry == "Pakiatan") { echo"selected";} ?>>Pakiatan</option>
              </select>
              <label class="form-label" for="country">Country</label>
              <div class="invalid-feedback"> Please select your Country </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="text" id="productbrand" class="form-control" placeholder="Product Brand" name="brand" value="<?php echo $oldbrand ?>" required />
              <label for="productbrand">Product Brand</label>
              <div class="invalid-feedback"> Please enter Product Brand </div>
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <select class="form-select" id="freshnes" name="freshnes"  value="<?php echo $oldfreshnes ?>" required>
                <option value="">Select Freshnes</option>
                <option value="Brand New" <?php if ($oldfreshnes == "Brand New") { echo"selected";} ?>>Brand New</option>
                <option value="Second Hand" <?php if ($oldfreshnes == "Second Hand") { echo"selected";} ?>>Second Hand</option>
                <option value="Recycled" <?php if ($oldfreshnes == "Recycled") { echo"selected";} ?>>Recycled</option>
              </select>
              <label class="form-label" for="freshnes">Freshnes</label>
              <div class="invalid-feedback"> Please select your Freshnes</div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <textarea class="form-control h-px-75" id="description" rows="3" placeholder="Product Description" name="desciption" required><?php echo $olddesciption ?></textarea>
              <label for="description">Product Description</label>
            </div>

            <div class="form-floating form-floating-outline mb-4 col-7">
              <select class="form-select" id="status" name="status"  value="<?php echo $oldstatus ?>" required>
                <option value="">Select Status</option>
                <option value="InStock" <?php if ($oldstatus == "InStock") { echo"selected";} ?>>Instock</option>
                <option value="Out of Stock" <?php if ($oldstatus == "Out of Stock") { echo"selected";} ?>>Out of Stock</option>
              </select>
              <label class="form-label" for="status">Status</label>
              <div class="invalid-feedback"> Please select your Status</div>
            </div>
            <div class="col-6 mb-4">
              <img src="<?php echo $oldthumbnail ?>" width="50%">
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="file" class="form-control" id="thmbnail" name="thumbnail"  />
              <label for="thmbnail">Product Thumbnail</label>
              <input type="hidden" name="oldthumbnail" value="<?php echo $oldthumbnail ?>"/>
            </div>
            <div class="col-6 mb-4">
              <img src="<?php echo $oldimage1 ?>" width="50%">
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="file" class="form-control" id="image" name="image1"  />
              <label for="image1">Image 1</label>
              <input type="hidden" name="oldimage1" value="<?php echo $oldimage1 ?>"/>
            </div>
            <div class="col-6 mb-4">
              <img src="<?php echo $oldimage2 ?>" width="50%">
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="file" class="form-control" id="image2" name="image2"  />
              <label for="image2">Image 2</label>
              <input type="hidden" name="oldimage2" value="<?php echo $oldimage2 ?>"/>
            </div>
            <div class="col-6 mb-4">
              <img src="<?php echo $oldimage3 ?>" width="50%">
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="file" class="form-control" id="image3" name="image3"  />
              <label for="image3">Image 3</label>
              <input type="hidden" name="oldimage3" value="<?php echo $oldimage3 ?>"/>
            </div>
            <div class="col-6 mb-4">
              <img src="<?php echo $oldimage4 ?>" width="50%">
            </div>
            <div class="form-floating form-floating-outline mb-4 col-6">
              <input type="file" class="form-control" id="image4" name="image4"  />
              <label for="image4">Image 4</label>
              <input type="hidden" name="oldimage4" value="<?php echo $oldimage4 ?>"/>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary" name="Update">Update</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Bootstrap Validation -->
</div>

          </div>
          <!-- / Content -->

          
          


          
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    
    
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    
    
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    
  </div>
  <!-- / Layout wrapper -->

  

  

  <!-- Core JS -->
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
  
  <!-- endbuild -->

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


<!-- Mirrored from demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Sep 2023 05:42:41 GMT -->
</html>

<!-- beautify ignore:end -->

