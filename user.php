<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 8;

$action = isset($_GET['action']) ? $_GET['action'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="assets/css/user.module.css">
    <?php include 'assets/header.plugins.php' ?>
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
                <div class="" style="padding: 30px;">

                    <?php
                    $title = "User";
                    $addoption = "adduser";
                    $disable = "";
                    include './components/index/header_nav.php';
                    ?>

                    <!-- Data Table -->
                    <?php
                    if ($action == "adduser" || $action == "failed") {
                        include "./components/form/adduser.php";
                    }
                    if ($action == "edituser") {
                        include "./components/form/edituser.php";
                    }
                    ?>


                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <?php ?>
                                    <h5 class="modal-title" id="staticBackdropLabel">

                                        Are you sure want to delete this
                                        user?

                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div id="user"
                                        style="display: flex; flex-direction: row; align-items: center; column-gap: 10px;">

                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button onclick="deleteUser()" type="button" id="deleteButton"
                                        class="btn btn-primary" data-bs-dismiss="modal">Sure</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        style="overflow-x: auto; background-color: #fff; padding: 16px 16px 26px 16px; border-radius: 8px; box-shadow: 0 0 25px rgba(0,0,0,0.1);">
                        <table style="width: 100%;">
                            <tr>
                                <th style="padding: 0 0 16px 0 ;">No</th>
                                <th style="padding: 0 0 16px 0 ;">Username</th>
                                <th style="padding: 0 0 16px 0 ;">Email</th>
                                <th style="padding: 0 0 16px 0 ;">Date of Birth</th>
                                <th style="padding: 0 0 16px 0 ;">Gender</th>
                                <th style="padding: 0 0 16px 0 ;">Address</th>
                                <th style="padding: 0 0 16px 0 ;">Role</th>
                                <th style="text-align: center; padding: 0 0 16px 0 ;">Status</th>
                                <?php if ($_SESSION['username'] == 'admin') { ?>
                                    <th style="text-align: center; padding: 0 0 16px 0 ;">Action</th>
                                <?php } ?>
                            </tr>

                            <?php
                            $apiUrl = "http://localhost/assignment/oscar-backend/_backend/api/user/read.php?page={$page}&limit={$limit}";
                            $data = file_get_contents($apiUrl);
                            $userData = json_decode($data, true);

                            $readCountApi = "http://localhost/assignment/oscar-backend/_backend/api/user/readAll.php";
                            $readCountData = file_get_contents($readCountApi);
                            $readCount = json_decode($readCountData, true);

                            $pages = ceil($readCount["data"][0]['total'] / $limit);
                            $i = $page * $limit - $limit + 1;
                            ?>
                            <?php foreach ($userData['data'] as $user) { ?>
                                <tr style="border-bottom: 1px solid #f1f1f1;">
                                    <td style="padding: 16px 0;">
                                        <?php echo $i ?>
                                    </td>
                                    <td>
                                        <div
                                            style="display: flex; flex-direction: row; align-items: center; column-gap: 12px;">
                                            <input type="checkbox" id="checkbox_id" <?php if ($_GET['id'] == $user['id'])
                                                echo "checked" ?> onchange="location.href = `?id=${this.value}`" name="id"
                                                    value="<?php echo $user['id'] ?>">
                                            <div style="width: 32px; height: 32px; border-radius: 8px; overflow: hidden;">
                                                <img src="_backend/config/avatar/<?= $user['avatar'] ?? '66a763b83af0e.png' ?>"
                                                    style="width: 100%; height: 100%; object-fit: cover;" />
                                            </div>
                                            <div style="font-size: 16px;"><?php echo $user['username'] ?></div>
                                        </div>
                                    </td>
                                    <td style="font-size: 16px;"><?php echo $user['email'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $user['date_of_birth'] ?></td>
                                    <td style="font-size: 16px;">
                                        <?php echo strtoupper($user['gender'][0]) . substr($user['gender'], 1) ?>
                                    </td>
                                    <td style="font-size: 16px;"><?php echo $user['address'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $user['role'] ?></td>
                                    <td style="text-align: center;">
                                        <div
                                            style="display: flex; align-items: center; column-gap: 5px; justify-content: center; ">
                                            <div
                                                style="<?php echo $user['status'] == 1 ? "background-color: #569c68;" : "background-color: #e64e65;" ?> width: 12px; height: 12px; border-radius: 20px; ">
                                            </div>
                                            <?php echo $user['status'] == 1 ? "Active" : "Inactive" ?>
                                        </div>
                                    </td>
                                    <?php if ($_SESSION['username'] == 'admin') { ?>
                                        <td style="text-align: center">
                                            <a href="?action=edituser&id=<?php echo $user['id'] ?>"
                                                style="border: none; background-color: transparent;padding: 8px; color: #1572E8; font-weight: 600;">
                                                <i class="fa-solid fa-pen-nib"></i> Edit
                                            </a>
                                            <button type="button" onclick="getUserId(<?php echo $user['id'] ?>)" id="user_id"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                style="border: none; background-color: transparent;padding: 8px; color: #e64e65; font-weight: 600;">
                                                <i class="fa-solid fa-trash-can"></i> Delete
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

                    <script>
                        async function getUserId(data) {
                            // alert("Are you sure want to delete user with ID: " + this.value);
                            const myHeaders = new Headers();
                            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

                            const urlencoded = new URLSearchParams();
                            urlencoded.append("id", data);

                            const requestOptions = {
                                method: "POST",
                                headers: myHeaders,
                                body: urlencoded,
                                redirect: "follow"
                            };

                            const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/user/readByID.php", requestOptions)
                            const result = await response.json();
                            console.log(result);
                            document.getElementById("user").innerHTML = `
                                <span style="font-size: 12px; font-weight: 600;" id="userId" >${result.data.id}</span>
                                <div style="width: 32px; height: 32px; border-radius: 50px; overflow: hidden;" >
                                    <img src="_backend/config/avatar/${result.data.avatar}" alt="Photo" style="width: 100%; height: 100%; object-fit: cover;"  />
                                </div>
                                <div style="display: flex; flex-direction: column; row-gap: -3px;" >
                                    <span style="font-size: 15px; font-weight: 500; color: #444;" >${result.data.username}</span>
                                    <span style="font-size: 12px; color: #a1a1a1;" >${result.data.email}</span>
                                </div>
                            `
                        }

                    </script>
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
            <?php
            include "./components/base/footer.php";
            ?>
            <?php
            if ($action == "list") {
                $toast = true;
                $type = "success";
                $msg = "User Added Successfully";
                include "components/ui/toast.php";
            } elseif ($action == "failed") {
                $toast = true;
                $type = "error";
                $msg = "Failed to Add User";
                include "components/ui/toast.php";
            } elseif ($action == 'avatar') {
                $toast = true;
                $type = "warning";
                $msg = "Avatar haven't been selected";
                include "components/ui/toast.php";
            }
            ?>
        </div>
    </div>
    <script>
        async function deleteUser() {
            const userId = document.getElementById('userId').innerHTML;
            console.log(userId);


            await deleteMe(userId);
        };


    </script>
    <script>
        async function deleteMe(id) {
            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            const urlencoded = new URLSearchParams();
            urlencoded.append("id", id);

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: urlencoded,
                redirect: "follow"
            };

            try {
                const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/user/delete.php", requestOptions);
                const result = await response.json();
                console.log(result)
                if (result.code == 1) {
                    location.reload();
                } else {
                    alert('Failed to delete user');
                }
            } catch (error) {
                console.error(error);
            };
        }
    </script>

    <?php include 'assets/footer.plugins.php' ?>

</body>

</html>