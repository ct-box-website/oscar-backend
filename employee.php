<?php
session_start();
$title = "Employee";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <?php include 'assets/header.plugins.php' ?>
</head>

<body>

    <div class="wrapper">
        <?php include "components/index/sidebar.php" ?>

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
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
                <?php include "components/index/navbar.php" ?>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">

                    <?php
                    include './components/index/header_nav.php';
                    ?>

                    <!-- Summarization Data -->

                </div>
            </div>
            <?php
            include "./components/base/footer.php";
            ?>

        </div>

    </div>


    <?php include 'assets/footer.plugins.php' ?>

</body>

</html>