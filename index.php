<?php
session_start();
$path = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['username']) && !isset($_SESSION['token'])) {
  header("location: {$path}login.php");
  die();
}
$action = isset($_GET['action']) ? $_GET['action'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Backend Dev</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

<!-- Fonts and icons -->
<!-- <script>
  var username = localStorage.getItem('username'), loggedin = localStorage.getItem('loggedin');
  if (username && loggedin === 'true') {
    document.getElementById('username').innerText = username;
    } else {
      window.location.href = 'login.php';
      }
      
    </script> -->

<script src="assets/js/plugin/webfont/webfont.min.js"></script>
<script>
  WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
    custom: {
      families: [
        "Font Awesome 5 Solid",
        "Font Awesome 5 Regular",
        "Font Awesome 5 Brands",
        "simple-line-icons",
      ],
      urls: ["assets/css/fonts.min.css"],
    },
    active: function () {
      sessionStorage.fonts = true;
    },
  });
</script>

<!-- Pusher -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- CSS Files -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/plugins.min.css" />
<link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="assets/css/demo.css" />
<link rel="shortcut icon"
  href="https://cdn.myportfolio.com/17be4dd08c5417027a544816a909fcf8/4cb3876a-d1fd-46fc-84bb-4a5285eb33bc_rw_1200.png?h=b58c258f0b0bc2fd7d20c2ee8084a9cd"
  type="image/x-icon">

<script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  // Initialize pusher with your app's key
  var pusher = new Pusher('e760aea9751a1d7d3e85', {
    cluster: 'ap1'
  });

  /**
   * Getting the data from pusher
   */
  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function (data) {
    alert(JSON.stringify(data));
  });
</script>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php include "./components/index/sidebar.php" ?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <?php include "./components/index/navbar.php" ?>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">

          <?php
          $title = "Dashboard";
          include './components/index/header_nav.php';
          ?>

          <!-- Summarization Data -->
          <?php
          include "./components/index/summary.php";
          ?>

          <?php
          if ($action === "adduser") {
            include "./components/form/adduser.php";
          }
          ?>


          <!-- <div class="row">
            <div class="col-md-8">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">User Statistics</div>
                    <div class="card-tools">
                      <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                        <span class="btn-label">
                          <i class="fa fa-pencil"></i>
                        </span>
                        Export
                      </a>
                      <a href="#" class="btn btn-label-info btn-round btn-sm">
                        <span class="btn-label">
                          <i class="fa fa-print"></i>
                        </span>
                        Print
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-container" style="min-height: 375px">
                    <canvas id="statisticsChart"></canvas>
                  </div>
                  <div id="myChartLegend"></div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-primary card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Daily Sales</div>
                    <div class="card-tools">
                      <div class="dropdown">
                        <button class="btn btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Export
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-category">March 25 - April 02</div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">
                    <h1>$4,578.58</h1>
                  </div>
                  <div class="pull-in">
                    <canvas id="dailySalesChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="card card-round">
                <div class="card-body pb-0">
                  <div class="h1 fw-bold float-end text-primary">+5%</div>
                  <h2 class="mb-2">17</h2>
                  <p class="text-muted">Users online</p>
                  <div class="pull-in sparkline-fix">
                    <div id="lineChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <!-- Geolocation -->
          <!--  -->

          <div class="row">

            <!-- New Customer -->
            <?php
            include "./components/index/new_customer.php";
            ?>

            <!-- Transaction history -->
            <?php
            include "./components/index/transaction_history.php";
            ?>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <?php
      include "./components/base/footer.php";
      ?>
      <?php
      if ($action == "list") {
        $toast = true;
        $type = "success";
        $msg = "User Added Successfully";
        include "components/ui/toast.php";
      } elseif ($action == "faild") {
        $toast = true;
        $type = "error";
        $msg = "Failed to Add User";
        include "components/ui/toast.php";
      }
      ?>
    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>
              <button type="button" class="changeTopBarColor" data-color="blue"></button>
              <button type="button" class="changeTopBarColor" data-color="purple"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
              <button type="button" class="changeTopBarColor" data-color="green"></button>
              <button type="button" class="changeTopBarColor" data-color="orange"></button>
              <button type="button" class="changeTopBarColor" data-color="red"></button>
              <button type="button" class="selected changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="changeTopBarColor" data-color="blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="purple2"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="green2"></button>
              <button type="button" class="changeTopBarColor" data-color="orange2"></button>
              <button type="button" class="changeTopBarColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button type="button" class="changeSideBarColor" data-color="white"></button>
              <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="custom-toggle">
        <i class="icon-settings"></i>
      </div>
    </div>
    <!-- End Custom template -->
  </div>

  <!-- Chart JS -->
  <!-- <script src="assets/js/plugin/chart.js/chart.min.js"></script> -->

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <!-- <script src="assets/js/setting-demo.js"></script> -->
  <!-- <script src="assets/js/demo.js"></script> -->
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>