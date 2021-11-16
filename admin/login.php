<?php
session_start();
include('../configs/query.php');
$query = new Query;

include('../configs/functions.php');
$func = new Functions;

if(isset($_SESSION['admin_id'])) {
    echo "<script>window.location='../admin/dashboard'</script>"; 
}

if(isset($_POST['loginbtn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $query->adminLogin($email, $password);
  $row= $stmt->FETCH(PDO::FETCH_ASSOC);
  if(($email==$row['email']) && ($password==$row['password'])) {
    $_SESSION['admin_id'] = $row['admin_id'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['admin_names'] = $row['firstname']." ".$row['lastname'];
    $_SESSION['telephone'] = $row['telephone'];
    echo "<script>window.location='dashboard'</script>";
  } else {
    echo "<script>window.location='login?message=lg_err'</script>"; 
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $func->getAppName(); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">

                <h2 class="text-center">Login to app!</h2><br>
                <?php
                if(isset($_POST['loginbtn'])) {
                  echo "<script>window.location='dashboard'</script>";
                }
                ?>
                <?php if(isset($_GET['message']) && ($_GET['message']=='lg_err')) {?>
                <a href="#" class="btn btn-danger btn-block">Invalid login credentials!</a><br>
                <?php } ?>
                <form method="POST">
                  <div class="form-group">
                    <label class="label">Email address</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="email" placeholder="Email address" required/>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" name="password" placeholder="*********" required/>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block" name="loginbtn">Login</button>
                  </div>
                  <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
                    </div>
                    <a href="reset_acc" class="text-small forgot-password text-black">Forgot Password</a>
                  </div>
                </form>
              </div>
              <br><hr>
              <p class="footer-text text-center text-white">Copyright © <?php echo date("Y") ?>. All rights reserved.</p>
              <p class="footer-text text-center text-white"><?php echo $func->getAppName(); ?></p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../assets/js/shared/off-canvas.js"></script>
    <script src="../assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <script src="../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
  </body>
</html>