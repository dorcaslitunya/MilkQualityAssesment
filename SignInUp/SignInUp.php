<?php
defined("site") or define("site", $_SERVER['DOCUMENT_ROOT']."/");
defined("page_title") or define("page_title", "Welcome");
defined("site_title") or define("site_title", "MilkTester");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include site . "/modules/html.header/header.php";
  include site . "/modules/html.header/styles.css.php";
  include site . "/modules/html.header/CDNs.chartJS.php";
  include site . "/modules/html.header/CDNs.datatable.php";
  include site . "/modules/html.scripts/CDNs.doc.php";
  include site . "/modules/html.header/CDNs.google.maps.php";
  // include site . "/pages/authentication/SignInUp/SignInUp.css";
  ?>
  <style>
    .pre-hide {
      display: none;
    }
  </style>

</head>

<body class="bg-gray-100">
  <!-- Navbar -->
  <?php //include site."/pages/authentication/signin/welcome.nav.php"; 
  ?>
  <!-- End Navbar -->

  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-7 pb-9 m-3 border-radius-lg" style="background-image: url('DCIM/site/logo.png');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">BME.KIRIEV.CO.KE</h1>
            <p class="text-lead text-white">IoT Asset Management Dashboard</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card mt-5">
            <div class="card-header pb-0 text-start">
              <h3 class="font-weight-bolder">Welcome back</h3>
              <p class="mb-0">Enter your email and password to sign in</p>
            </div>
            <div class="card-body">
              <form role="form" class="text-start">
                <div class="sign_up pre-hide">
                  <label>Name</label>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="name" placeholder="name" aria-label="name">
                  </div>
                </div>
                <div class="sign_up_in">
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control" id="email" placeholder="email" aria-label="email">
                  </div>
                </div>
                <div class="sign_up pre-hide">
                  <label>Institution</label>
                  <div class="mb-3">
                    <input type="test" class="form-control" id="company" placeholder="institution" aria-label="institution">
                  </div>
                </div>
                <div class="sign_up pre-hide">
                  <label>Number</label>
                  <div class="mb-3">
                    <input type="number" class="form-control" id="phone" placeholder="number" aria-label="number">
                  </div>
                </div>
                <div class="sign_up_in">
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" aria-label="Password">
                  </div>
                </div>
                <div class="sign_in">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                </div>
                <div class="sign_in">
                  <div class="text-center">
                    <input type="button" id="btn_signin" class="btn btn-primary w-100 mt-4 mb-0" value="Sign in"></input>
                  </div>
                </div>
                <div class="sign_in">
                  <!-- include google sign in -->
                  <div class="text-center">
                    <input onclick="window.location='<?php echo $login_url; ?>'" type="button" id="btn_signin" class="btn btn-primary w-100 mt-4 mb-0" value="Sign in with google"></input>
                  </div>
                </div>


                <div class="sign_up pre-hide">
                  <div class="text-center">
                    <input type="button" id="btn_signup" class="btn btn-primary w-100 mt-4 mb-0" value="Sign up"></input>
                  </div>
                </div>
              </form>
            </div>
            <div class="">
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <div class="sign_up pre-hide">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="javascript:;" class="text-primary font-weight-bold"><span id="swtch_to_signin">Sign in instead</span></a>
                  </p>
                </div>
                <div class="sign_in">
                  <p class="mb-4 text-sm mx-auto">
                    Already have an account?
                    <a href="javascript:;" class="text-primary font-weight-bold"><span id="swtch_to_signup">Sign up instead</span></a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script src="/dashboard/pages/authentication/SignInUp/SignInUp.js"></script>
      <script src="/dashboard/pages/authentication/SignInUp/SignIn.Handler.js"></script>
      <script src="/dashboard/pages/authentication/SignInUp/SignUp.Handler.js"></script>


    </div>
  </main>


  < <!-- TODO Footer -->
    <BR><BR>
    <?php //include site."/pages/authentication/signin/welcome.footer.php"; 
    ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Kanban scripts -->
    <script src="assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="assets/js/plugins/jkanban/jkanban.js"></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.min.js"></script>
</body>

</html>