<?php

session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 8;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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
                <?php include "./components/index/navbar.php" ?>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">

                    <?php
                    $title = "Booking";
                    include './components/index/header_nav.php';
                    ?>

                    <!-- Booking Date Table -->
                    <div style=" background-color: #fff;
                         padding: 16px 16px 26px 16px; 
                         border-radius: 8px; 
                         box-shadow: 0 0 25px rgba(0,0,0,0.1);
                         
                         ">
                        <div style="display: block; overflow-x: auto; white-space: nowrap;">
                            <table>
                                <tr>
                                    <th style="padding: 0 20px 16px 0 ;">No</th>
                                    <th style="padding: 0 100px 16px 0 ;">Name</th>
                                    <th style="padding: 0 100px 16px 0 ;">Phone</th>
                                    <th style="padding: 0 30px 16px 0 ;">Adult</th>
                                    <th style="padding: 0 30px 16px 0 ;">Children</th>
                                    <th style="padding: 0 30px 16px 0 ;">Room type</th>
                                    <th style="padding: 0 30px 16px 0 ;">Price</th>
                                    <th style="padding: 0 30px 16px 0 ;">Payment Method</th>
                                    <th style="padding: 0 100px 16px 0 ;">Booking Date</th>
                                    <th style="padding: 0 50px 16px 0 ;">Check In</th>
                                    <th style="padding: 0 50px 16px 0 ;">Check Out</th>
                                    <th style="padding: 0 40px 16px 0 ;">Status</th>
                                    <?php if ($_SESSION['username'] == 'admin') { ?>
                                        <th style="text-align: center; padding: 0 0 16px 0px ;">Action</th>
                                    <?php } ?>
                                </tr>

                                <?php
                                $paymentApi = "http://localhost/assignment/oscar-backend/_backend/api/payment_method/read.php";
                                $paymentData = file_get_contents($paymentApi);
                                $payment = json_decode($paymentData, true);

                                $apiUrl = "http://localhost/assignment/oscar-backend/_backend/api/reservation/readLimit.php?page={$page}&limit={$limit}";
                                $data = file_get_contents($apiUrl);
                                $reservation = json_decode($data, true);

                                $readCountApi = "http://localhost/assignment/oscar-backend/_backend/api/reservation/readCount.php";
                                $readCountData = file_get_contents($readCountApi);
                                $readCount = json_decode($readCountData, true);

                                $pages = ceil($readCount["data"][0]['total'] / $limit);
                                $i = $page * $limit - $limit + 1;
                                ?>
                                <?php foreach ($reservation['data'] as $reserv) { ?>
                                    <tr style="border-bottom: 1px solid #f1f1f1;">

                                        <td style="padding: 16px 0;">
                                            <?php echo $i ?>
                                        </td>

                                        <td>
                                            <div
                                                style="display: flex; flex-direction: row; align-items: center; column-gap: 12px;">
                                                <input type="checkbox" id="checkbox_id" <?php if ($_GET['id'] == $reserv['id'])
                                                    echo "checked" ?> onchange="location.href = `?id=${this.value}`" name="id"
                                                        value="<?php echo $reserv['id'] ?>">
                                                <?php echo $reserv['name'] ?>
                                            </div>
                                        </td>
                                        <td style="font-size: 16px;"><?php echo $reserv['phone'] ?></td>
                                        <td style="font-size: 16px;"><?php echo $reserv['adults'] ?></td>
                                        <td style="font-size: 16px;"><?php echo $reserv['children'] ?></td>
                                        <td style="font-size: 16px;"><?php echo $reserv['category_id'] ?></td>
                                        <td style="font-size: 16px;"><?php echo "$ " . (double) $reserv['price'] ?></td>
                                        <td style="font-size: 16px;">
                                            <?php echo $payment['data'][$reserv['payment_id']]['method'] ?>
                                        </td>
                                        <td style="font-size: 16px;"><?php echo $reserv['created_at'] ?></td>
                                        <td style="font-size: 16px;"><?php echo $reserv['check_in'] ?></td>
                                        <td style="font-size: 16px;"><?php echo $reserv['check_out'] ?></td>
                                        <td style="">
                                            <div style="display: flex; align-items: center; column-gap: 5px; ">
                                                <div
                                                    style="<?php echo $reserv['status'] == 1 ? "background-color: #569c68;" : "background-color: #e64e65;" ?> width: 12px; height: 12px; border-radius: 20px; ">
                                                </div>
                                                <?php echo $reserv['status'] == 1 ? "Active" : "Inactive" ?>
                                            </div>
                                        </td>
                                        <?php if ($_SESSION['username'] == 'admin') { ?>
                                            <td style="text-align: center">
                                                <a href="?action=edituser&id=<?php echo $user['id'] ?>"
                                                    style="border: none; background-color: transparent;padding: 8px; color: #1572E8; font-weight: 600;">
                                                    <i class="fa-regular fa-square-check"></i> Accept
                                                </a>
                                                <button type="button" onclick="getUserId(<?php echo $user['id'] ?>)"
                                                    id="user_id" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                    style="border: none; background-color: transparent;padding: 8px; color: #e64e65; font-weight: 600;">
                                                    <i class="fa-solid fa-trash-can"></i> Decline
                                                </button>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php $i++; ?>
                                <?php } ?>
                                <!-- Fetch User Data Here -->

                                <!-- Fetch User Data Here -->
                            </table>
                        </div>
                    </div>

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