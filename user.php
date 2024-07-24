<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <?php include 'assets/header.plugins.php' ?>
    <link rel="stylesheet" href="assets/css/user.module.css">
    <script src="https://kit.fontawesome.com/83db4bf7c9.js" crossorigin="anonymous"></script>
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
                    $title = "User";
                    include './components/index/header_nav.php';
                    ?>

                    <!-- Data Table -->
                    <div
                        style="background-color: #fff; padding: 16px; border-radius: 8px; box-shadow: 0 0 25px rgba(0,0,0,0.1)">
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="padding: 0 0 16px 0 ;">No</th>
                                    <th style="padding: 0 0 16px 0 ;">Username</th>
                                    <th style="padding: 0 0 16px 0 ;">Email</th>
                                    <th style="padding: 0 0 16px 0 ;">Address</th>
                                    <th style="text-align: center; padding: 0 0 16px 0 ;">Status</th>
                                    <th style="text-align: center; padding: 0 0 16px 0 ;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $apiUrl = "http://localhost/assignment/oscar-backend/_backend/api/user/read.php?page={$page}&limit={$limit}";
                                $data = file_get_contents($apiUrl);
                                $userData = json_decode($data, true);

                                $readCountApi = "http://localhost/assignment/oscar-backend/_backend/api/user/readAll.php";
                                $readCountData = file_get_contents($readCountApi);
                                $readCount = json_decode($readCountData, true);

                                $pages = ceil($readCount["data"][0]['id'] / 1);
                                ?>
                                <?php foreach ($userData['data'] as $user) { ?>
                                    <tr>
                                        <td style="padding: 16px 0;">1</td>
                                        <td>
                                            <div
                                                style="display: flex; flex-direction: row; align-items: center; column-gap: 12px;">
                                                <div
                                                    style="width: 32px; height: 32px; border-radius: 4px; overflow: hidden;">
                                                    <img src="_backend/config/avatar/<?= $user['avatar'] ?>"
                                                        style="width: 100%; height: 100%; object-fit: cover;" />
                                                </div>
                                                <div style="font-size: 16px;"><?php echo $user['username'] ?></div>
                                            </div>
                                        </td>
                                        <td style="font-size: 16px;"><?php echo $user['email'] ?></td>
                                        <td style="font-size: 16px;"><?php echo $user['address'] ?></td>
                                        <td style="text-align: center;">
                                            <div
                                                style="<?php echo $user['status'] == 1 ? "background-color: #1572E8;" : "background-color: #F25961;" ?> color: #fff; border-radius: 12px; padding: 2px 0;">
                                                <?php echo $user['status'] == 1 ? "Active" : "Inactive" ?>
                                            </div>
                                        </td>

                                        <td style="text-align: center">
                                            <button type="button"
                                                class="btn btn-primary btn-round btn-sm me-2">Edit</button>
                                            <button type="button"
                                                class="btn btn-danger btn-round btn-sm me-2">Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <!-- Fetch User Data Here -->

                                <!-- Fetch User Data Here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div style="margin-top: 40px">
                        <ul class="paginations">
                            <?php if ($page > 1) { ?>
                                <li class="">
                                    <a class="page-l arrow" style=" margin-right: 8px;"
                                        href="?page=<?php echo $page - 1 ?>">
                                        <i class="fa-solid fa-caret-left" style="font-size: 16px"></i>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php for ($i = 1; $i <= $pages; $i++) { ?>
                                <li class="">
                                    <a class="page-l <?php echo $page == $i ? "active-v" : "" ?> "
                                        href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($page < $pages) { ?>
                                <li class="<?php echo $page == $pages ? "disable" : "" ?> ">
                                    <a class="page-l arrow" style=" margin-left: 8px;" href="?page=<?php echo $page + 1 ?>">
                                        <i class="fa-solid fa-caret-right" style="font-size: 16px"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!-- Summarization Data -->
                </div>
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