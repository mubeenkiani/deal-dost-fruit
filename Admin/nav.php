<?php
$msge = "";
    if (isset($_SESSION["email"])) {
      $msge = "signout";
    } else {
      $msge = "signin";
    }

    include 'connection.php';
    $sql = "SELECT * FROM `admin_signup`";
    $run = mysqli_query($connect,$sql);
    if (mysqli_num_rows($run)>0) {
      while($row = mysqli_fetch_assoc($run)){
?>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="mdi mdi-menu mdi-24px"></i>
    </a>
  </div>
  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <div class="navbar-nav align-items-center">
      <div class="nav-item navbar-search-wrapper mb-0">
        <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
          <i class="mdi mdi-magnify mdi-24px scaleX-n1-rtl"></i>
          <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
        </a>
      </div>
    </div>
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <li style="margin-right: 25px;">
        <a href="<?php echo $msge ?>.php" class="btn btn-primary">
          <?php echo $msge ?>
        </a>
      </li>
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle">
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
          <li>
            <a class="dropdown-item pb-2 mb-1" href="pages-account-settings-account.html">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2 pe-1">
                  <div class="avatar avatar-online">
                    <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0"></h6>
                  <small class="text-muted">
                    <?php echo $row['User_Name'] ?>
                  </small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-0"></div>
          </li>
          <li>
            <a class="dropdown-item" href="pages-profile-user.html">
              <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="pages-account-settings-account.html">
              <i class="mdi mdi-cog-outline me-1 mdi-20px"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="signout.php">
              <i class="mdi mdi-logout me-1 mdi-20px"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="navbar-search-wrapper search-input-wrapper  d-none">
    <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
      aria-label="Search...">
    <i class="mdi mdi-close search-toggler cursor-pointer"></i>
  </div>
</nav>
<?php }} ?>