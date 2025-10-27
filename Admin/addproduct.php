<?php

$alert = "";
include 'connection.php';

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($connect, $_POST['name']);
  $category = mysqli_real_escape_string($connect, $_POST['category']);
  $price = mysqli_real_escape_string($connect, $_POST['price']);
  $shortdes = mysqli_real_escape_string($connect, $_POST['shortdes']);
  $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
  $city = mysqli_real_escape_string($connect, $_POST['city']);
  $country = mysqli_real_escape_string($connect, $_POST['country']);
  $brand = mysqli_real_escape_string($connect, $_POST['brand']);
  $freshnes = mysqli_real_escape_string($connect, $_POST['freshnes']);
  $desciption = mysqli_real_escape_string($connect, $_POST['desciption']);
  $discountPercent = mysqli_real_escape_string($connect, $_POST['discount']);
  $rating = mysqli_real_escape_string($connect, $_POST['rating']);

  // Handle color variants
  $colorVariants = isset($_POST['colors']) ? implode(',', $_POST['colors']) : '';

  $thumbnail = $_FILES['thumbnail']['name'];
  $image1 = $_FILES['image1']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];
  $image4 = $_FILES['image4']['name'];

  $thumbnailpath = "media/thumbnails/" . $thumbnail;
  $image1path = "media/images/" . $image1;
  $image2path = "media/images/" . $image2;
  $image3path = "media/images/" . $image3;
  $image4path = "media/images/" . $image4;

  // Create directories if they don't exist
  if (!file_exists('media/thumbnails')) {
    mkdir('media/thumbnails', 0777, true);
  }
  if (!file_exists('media/images')) {
    mkdir('media/images', 0777, true);
  }

  move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailpath);
  move_uploaded_file($_FILES['image1']['tmp_name'], $image1path);
  move_uploaded_file($_FILES['image2']['tmp_name'], $image2path);
  move_uploaded_file($_FILES['image3']['tmp_name'], $image3path);
  move_uploaded_file($_FILES['image4']['tmp_name'], $image4path);

  $query = "INSERT INTO `product_info`(`Name`, `Category`, `Price`,`shortdes`, `Quantity`, `City`, `Country`, `Brand`, `Freshness`, `Description`, `Thumbnail`, `Image1`, `Image2`, `Image3`, `Image4`, `DiscountPercent`, `Rating`, `ColorVariants`) 
            VALUES ('$name','$category','$price', '$shortdes','$quantity','$city','$country','$brand','$freshnes','$desciption','$thumbnailpath','$image1path','$image2path','$image3path','$image4path','$discountPercent','$rating','$colorVariants')";

  $run = mysqli_query($connect, $query);

  if (!$run) {
    $alert = "<div class='alert alert-danger'>Product not Added: " . mysqli_error($connect) . "</div>";
  } else {
    $alert = "<div class='alert alert-success'>Product Added Successfully</div>";
    header("location:manageproduct.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
  data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Add Product - Materio</title>

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
  <link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
  <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
  <link rel="stylesheet" href="assets/vendor/libs/flatpickr/flatpickr.css" />
  <link rel="stylesheet" href="assets/vendor/libs/tagify/tagify.css" />
  <link rel="stylesheet" href="assets/vendor/libs/%40form-validation/umd/styles/index.min.css" />

  <style>
    .color-selection-box {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      padding: 15px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      background: #f9f9f9;
    }

    .color-option {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .color-option input[type="checkbox"] {
      display: none;
    }

    .color-preview {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      border: 3px solid #e0e0e0;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }

    .color-option input[type="checkbox"]:checked+.color-preview {
      border-color: #333;
      transform: scale(1.1);
      box-shadow: 0 0 0 2px #fff, 0 0 0 4px #333;
    }

    .color-option input[type="checkbox"]:checked+.color-preview::after {
      content: '✓';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    }

    .color-label {
      font-size: 14px;
      color: #666;
      cursor: pointer;
    }
  </style>

  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
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
                  <li class="menu-item active">
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
            </ul>
          </li>
        </ul>
      </aside>

      <!-- Layout page -->
      <div class="layout-page">

        <!-- Navbar -->
        <?php include 'nav.php' ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row mb-4">
              <div class="col-md">
                <div class="card">
                  <h5 class="card-header">Add Product</h5>
                  <div class="card-body">
                    <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                      <?php echo $alert ?>

                      <div class="row">
                        <!-- Product Name -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="text" class="form-control" id="productname" placeholder="Product Name" name="name" required />
                          <label for="productname">Product Name</label>
                          <div class="invalid-feedback">Please enter Product Name.</div>
                        </div>

                        <!-- Category -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Laptops">Laptops</option>
                            <option value="Cell Phones">Cell Phones</option>
                            <option value="TV">TV</option>
                            <option value="Smart Watches">Smart Watches</option>
                            <option value="Digital Cameras">Digital Cameras</option>
                            <option value="Audios">Audios</option>
                            <option value="Computer">Computer</option>
                          </select>
                          <label class="form-label" for="category">Category</label>
                          <div class="invalid-feedback">Please select your Category</div>
                        </div>

                        <!-- Price -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="number" class="form-control" id="productprice" placeholder="Product Price" name="price" step="0.01" required />
                          <label for="productprice">Product Price (Rs)</label>
                          <div class="invalid-feedback">Please enter Product Price.</div>
                        </div>


                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="text" class="form-control" id="productprice" placeholder="Short Description" name="shortdes" required />
                          <label for="shortdescription">Short Descripton</label>
                          <div class="invalid-feedback">Please enter Short Description.</div>
                        </div>

                        <!-- Quantity -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="number" id="productquantity" class="form-control" placeholder="Product Quantity" name="quantity" required />
                          <label for="productquantity">Product Quantity</label>
                          <div class="invalid-feedback">Please enter Product Quantity</div>
                        </div>

                        <!-- Discount Percentage -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="number" id="discount" class="form-control" placeholder="Discount Percentage" name="discount" min="0" max="100" value="15" required />
                          <label for="discount">Discount Percentage (%)</label>
                          <div class="invalid-feedback">Please enter Discount Percentage</div>
                        </div>

                        <!-- Rating -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="number" id="rating" class="form-control" placeholder="Product Rating" name="rating" min="0" max="5" step="0.1" value="4.5" required />
                          <label for="rating">Product Rating (0-5)</label>
                          <div class="invalid-feedback">Please enter Product Rating</div>
                        </div>

                        <!-- City -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <select class="form-select" id="city" name="city" required>
                            <option value="">Select City</option>
                            <option value="NewYork">New York</option>
                            <option value="LiverPool">Liver Pool</option>
                            <option value="AuckLand">AuckLand</option>
                            <option value="Sydney">Sydney</option>
                            <option value="Islamabad">Islamabad</option>
                          </select>
                          <label class="form-label" for="city">City</label>
                          <div class="invalid-feedback">Please select your City</div>
                        </div>

                        <!-- Country -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <select class="form-select" id="country" name="country" required>
                            <option value="">Select Country</option>
                            <option value="USA">USA</option>
                            <option value="UK">UK</option>
                            <option value="NewZealand">New Zealand</option>
                            <option value="Australia">Australia</option>
                            <option value="Pakistan">Pakistan</option>
                          </select>
                          <label class="form-label" for="country">Country</label>
                          <div class="invalid-feedback">Please select your Country</div>
                        </div>

                        <!-- Brand -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="text" id="productbrand" class="form-control" placeholder="Product Brand" name="brand" required />
                          <label for="productbrand">Product Brand</label>
                          <div class="invalid-feedback">Please enter Product Brand</div>
                        </div>

                        <!-- Freshness -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <select class="form-select" id="freshnes" name="freshnes" required>
                            <option value="">Select Freshness</option>
                            <option value="Brand New">Brand New</option>
                            <option value="Second Hand">Second Hand</option>
                            <option value="Recycled">Recycled</option>
                          </select>
                          <label class="form-label" for="freshnes">Freshness</label>
                          <div class="invalid-feedback">Please select your Freshness</div>
                        </div>

                        <!-- Color Variants -->
                        <div class="mb-4 col-12">
                          <label class="form-label fw-bold">Color Variants</label>
                          <div class="color-selection-box">
                            <div class="color-option">
                              <input type="checkbox" id="color-red" name="colors[]" value="#ff6b6b">
                              <label for="color-red" class="color-preview" style="background-color: #ff6b6b;" title="Red"></label>
                              <label for="color-red" class="color-label">Red</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-blue" name="colors[]" value="#4dabf7">
                              <label for="color-blue" class="color-preview" style="background-color: #4dabf7;" title="Blue"></label>
                              <label for="color-blue" class="color-label">Blue</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-pink" name="colors[]" value="#ff69b4">
                              <label for="color-pink" class="color-preview" style="background-color: #ff69b4;" title="Pink"></label>
                              <label for="color-pink" class="color-label">Pink</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-green" name="colors[]" value="#51cf66">
                              <label for="color-green" class="color-preview" style="background-color: #51cf66;" title="Green"></label>
                              <label for="color-green" class="color-label">Green</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-orange" name="colors[]" value="#ff922b">
                              <label for="color-orange" class="color-preview" style="background-color: #ff922b;" title="Orange"></label>
                              <label for="color-orange" class="color-label">Orange</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-purple" name="colors[]" value="#9775fa">
                              <label for="color-purple" class="color-preview" style="background-color: #9775fa;" title="Purple"></label>
                              <label for="color-purple" class="color-label">Purple</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-black" name="colors[]" value="#212529">
                              <label for="color-black" class="color-preview" style="background-color: #212529;" title="Black"></label>
                              <label for="color-black" class="color-label">Black</label>
                            </div>

                            <div class="color-option">
                              <input type="checkbox" id="color-white" name="colors[]" value="#ffffff">
                              <label for="color-white" class="color-preview" style="background-color: #ffffff; border: 2px solid #666;" title="White"></label>
                              <label for="color-white" class="color-label">White</label>
                            </div>
                          </div>
                        </div>

                        <!-- Description -->
                        <div class="form-floating form-floating-outline mb-4 col-12">
                          <textarea class="form-control h-px-100" id="description" rows="4" placeholder="Product Description" name="desciption" required></textarea>
                          <label for="description">Product Description</label>
                          <div class="invalid-feedback">Please enter Product Description</div>
                        </div>

                        <!-- Thumbnail -->
                        <div class="form-floating form-floating-outline mb-4 col-12">
                          <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required />
                          <label for="thumbnail">Product Thumbnail</label>
                          <div class="invalid-feedback">Please upload Product Thumbnail</div>
                        </div>

                        <!-- Images -->
                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="file" class="form-control" id="image1" name="image1" accept="image/*" required />
                          <label for="image1">Image 1</label>
                          <div class="invalid-feedback">Please upload Image 1</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="file" class="form-control" id="image2" name="image2" accept="image/*" required />
                          <label for="image2">Image 2</label>
                          <div class="invalid-feedback">Please upload Image 2</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="file" class="form-control" id="image3" name="image3" accept="image/*" required />
                          <label for="image3">Image 3</label>
                          <div class="invalid-feedback">Please upload Image 3</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4 col-md-6">
                          <input type="file" class="form-control" id="image4" name="image4" accept="image/*" required />
                          <label for="image4">Image 4</label>
                          <div class="invalid-feedback">Please upload Image 4</div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center mt-3">
                          <button type="submit" class="btn btn-primary btn-lg px-5" name="submit">
                            <i class="mdi mdi-check me-2"></i>Add Product
                          </button>
                          <a href="manageproduct.php" class="btn btn-outline-secondary btn-lg px-5 ms-2">
                            <i class="mdi mdi-close me-2"></i>Cancel
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
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
  <script src="assets/vendor/libs/select2/select2.js"></script>
  <script src="assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
  <script src="assets/vendor/libs/moment/moment.js"></script>
  <script src="assets/vendor/libs/flatpickr/flatpickr.js"></script>
  <script src="assets/vendor/libs/tagify/tagify.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
  <script src="assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/form-validation.js"></script>

</body>

</html>