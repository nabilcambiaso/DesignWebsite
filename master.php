<?php

function nav()
{
 echo '
 <!DOCTYPE html>
 <html lang="en">

 <head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>eStartup Bootstrap Template - Index</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/modal-video/css/modal-video.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

 </head>

 <body>

  <!-- ======= Header ======= -->
  <header id="header" class="header">
    <div class="container">

      <div id="logoMaster" class="pull-left">
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="./"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="./design"><i class="fa fa-pencil"></i> Designs</a></li>
          <li><a href="./products"><i class="fa fa-pencil"></i> Products</a></li>
          <li><a href="./#contact"><i class="fa fa-user"></i> Contact</a></li>
          <li><a href="./saved"><i class="fa fa-bookmark"></i> Saved</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

 ';
}

function footer()
{
  echo '
  <!-- ======= Footer ======= -->
  <footer class="footer">
    <div class="container">
      <div class="row">

        <div class="col-md-12 col-lg-4">
          <div class="footer-logo">

            <a class="navbar-brand" href="#"><h3>Majda Website</h3></a>
            <p>Styles come and go. Good design is a language, not a style.</p>

          </div>
        </div>
        <div class="col-lg-2"></div>

        <div class="col-sm-6 col-md-4 col-lg-2">
          <div class="list-menu">

            <h4>Abou Us</h4>

            <ul class="list-unstyled">
              <li><a href="#">About us</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>

          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-2">
          <div class="list-menu">

            <h4>Services</h4>

            <ul class="list-unstyled">
              <li><a href="./design">Designs</a></li>
            </ul>
            <ul class="list-unstyled">
              <li><a href="./products">Products</a></li>
            </ul>

          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-2">
          <div class="list-menu">

            <h4>Support</h4>

            <ul class="list-unstyled">
              <li><a href="#">faq</a></li>
              <li><a href="#">Developer help</a></li>
              <li><a href="#">Contact us</a></li>
            </ul>

          </div>
        </div>

      </div>
    </div>

    <div class="copyrights">
      <div class="container">
        <p>&copy; Copyrights Majda Design. All rights reserved.</p>
      </div>
    </div>

  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/modal-video/js/modal-video.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/superfish/superfish.min.js"></script>
  <script src="assets/vendor/hoverIntent/hoverIntent.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="./javascriptFiles/master.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  </body>
  </html>
  ';
}



?>