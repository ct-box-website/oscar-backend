<?php
session_start();
$url = $_SERVER['REQUEST_URI'];
$uri = substr($url, strrpos($url, '/') + 1);

$id = $_SESSION['id'];
$curl = curl_init();

curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'http://localhost/assignment/oscar-backend/_backend/api/user/readByID.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "id=$id",
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]
);

$response = curl_exec($curl);
$userData = json_decode($response, true);
curl_close($curl);

?>

<script src="https://kit.fontawesome.com/83db4bf7c9.js" crossorigin="anonymous"></script>
<div class="sidebar" data-background-color="dark">

    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <a href="index.php" class="logo">
                <!-- <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" /> -->
                <span class="" style="color: #fff; font-size: 18px; font-weight: 700">
                    Backend <span style="color: #5C55BF; font-weight: 900;">Dev</span>
                </span>
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

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <li class="nav-item <?php echo $uri === 'index.php' ? "active" : "" ?>">

                    <a href="index.php" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <!-- <span class="caret"></span> -->
                    </a>

                    <!-- <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                </li>

                <!-- Label -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Contents</h4>
                </li>

                <li
                    class="nav-item <?php echo ($uri === 'user.php' || $uri === 'employee.php' || $uri === 'attendance.php') ? "active" : "" ?> ">



                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                        <span class="caret"></span>
                    </a>


                    <!-- Dropdown -->
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <?php if ($userData['data']['role'] == 'admin') { ?>
                                <li>
                                    <!-- <a href="components/buttons.html">
                                    <span class="sub-item">Buttons</span>
                                </a> -->

                                    <a href="user.php">
                                        <span class="sub-item">User</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($userData['data']['role'] == 'manager' || $userData['data']['role'] == 'admin') { ?>
                                <li>
                                    <!-- <a href="components/avatars.html">
                                    <span class="sub-item">Avatars</span>
                                </a> -->
                                    <a href="employee.php">
                                        <span class="sub-item">Employees</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="attendance.php">
                                    <span class="sub-item">Attendance</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="components/panels.html">
                                    <span class="sub-item">Panels</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/sweetalert.html">
                                    <span class="sub-item">Sweet Alert</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/font-awesome-icons.html">
                                    <span class="sub-item">Font Awesome Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/simple-line-icons.html">
                                    <span class="sub-item">Simple Line Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>

                </li>
                <!-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Sidebar Layouts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-2.html">
                                    <span class="sub-item">Sidebar Style 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-menu.html">
                                    <span class="sub-item">Icon Menu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Forms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">

                        <ul class="nav nav-collapse">
                            <li>
                                <a href="pages/invoice.php">
                                    <span class="sub-item">Invoice</span>
                                </a>
                            </li>
                            <li>

                                <a href="#">
                                    <span class="sub-item">Announcment</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Resevation</p>
                        <!-- <span class="caret"></span> -->
                        <span class="badge badge-success" id="reservation">

                        </span>
                    </a>

                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="booking.php">
                                    <span class="sub-item">Booking</span>
                                </a>
                            </li>
                            <li>
                                <a href="?action=checkin">
                                    <span class="sub-item">Check-in</span>
                                </a>
                            </li>
                            <li>
                                <a href="?action=checkout">
                                    <span class="sub-item">Check-out</span>
                                </a>
                            </li>
                            <li>
                                <a href="history.php">
                                    <span class="sub-item">History</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">Google Maps</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="maps/jsvectormap.html">
                                    <span class="sub-item">Jsvectormap</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a href="room.php?action=room">
                        <i class="fa-solid fa-person-shelter"></i>
                        <p>Room</p>
                        <!-- <span class="badge badge-secondary">1</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a href="spa.php">
                        <i class="fa-solid fa-spa"></i>
                        <p>Massage & Spa</p>
                        <!-- <span class="badge badge-secondary">1</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a href="content.php">
                        <i class="fas fa-desktop"></i>
                        <p>Contents</p>
                        <!-- <span class="badge badge-success">4</span> -->
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../../documentation/index.html">
                        <i class="fas fa-file"></i>
                        <p>Reports</p>
                        <!-- <span class="badge badge-secondary">1</span> -->
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
</div>