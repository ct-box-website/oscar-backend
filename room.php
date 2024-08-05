<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 8;

$action = isset($_GET['action']) ? $_GET['action'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
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
            <!-- Button trigger modal -->

            <div class="container">
                <div class="" style="padding: 30px;">

                    <?php
                    $title = "Room";
                    $addoption = "addroom";
                    $disable = "";
                    include 'components/index/header_nav.php';
                    ?>

                    <!-- Add User Modal -->
                    <?php
                    if ($action == "addroom" || $action == "failed") {
                        include "./components/form/addroom.php";
                    }
                    if ($action == "editroom") {
                        include "./components/form/editroom.php";
                    }
                    ?>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Are you sure want to delete this
                                        room?</h5>
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
                                    <button onclick="deleteRoom()" type="button" id="deleteButton"
                                        class="btn btn-primary" data-bs-dismiss="modal">Sure</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div
                        style="display: block; overflow-x: auto; white-space: nowrap; background-color: #fff; padding: 16px 16px 26px 16px; border-radius: 8px; box-shadow: 0 0 25px rgba(0,0,0,0.1);">
                        <table>
                            <tr>
                                <th style="padding: 0 20px 16px 0 ;">No</th>
                                <th style="padding: 0 50px 16px 0 ; ">Title</th>
                                <th style="padding: 0 0 16px 0 ;">Description</th>
                                <th style="padding: 0 0 16px 20px ;">Category</th>
                                <th style="padding: 0 0 16px 40px ;">Price</th>
                                <th style="padding: 0 0 16px 40px ;">Capacity</th>
                                <th style="padding: 0 0 16px 40px ;">Images</th>
                                <th style="text-align: center; padding: 0 0 16px 40px ;">Status</th>
                                <?php if ($_SESSION['username'] == 'admin') { ?>
                                    <th style="text-align: center; padding: 0 0 16px 40px ;">Action</th>
                                <?php } ?>
                            </tr>

                            <?php
                            $apiUrl = "http://localhost/assignment/oscar-backend/_backend/api/room/readLimit.php?page=$page&limit=$limit";
                            $data = file_get_contents($apiUrl);
                            $roomData = json_decode($data, true);

                            $readCountApi = "http://localhost/assignment/oscar-backend/_backend/api/room/readCount.php";
                            $readCountData = file_get_contents($readCountApi);
                            $readCount = json_decode($readCountData, true);

                            $pages = ceil($readCount["data"][0]['total'] / $limit);
                            $i = $page * $limit - $limit + 1;
                            ?>

                            <?php foreach ($roomData['data'] as $room) { ?>
                                <tr style="border-bottom: 1px solid #f1f1f1;">

                                    <td style="padding: 16px 0;"><?php echo $i ?></td>

                                    <td style="width: 170px; padding-right: 10px;">
                                        <div
                                            style="display: flex; flex-direction: row; align-items: center; column-gap: 12px;">
                                            <!-- <div style="width: 32px; height: 32px; border-radius: 8px; overflow: hidden;">
                                                <img src="_backend/config/avatar/<?= $room['avatar'] ?>"
                                                    style="width: 100%; height: 100%; object-fit: cover;" />
                                            </div> -->
                                            <div
                                                style="font-size: 14px; white-space: nowrap; overflow: hidden; width: 180px; text-overflow: ellipsis;">
                                                <input type="checkbox" name="" id="" style="margin-right: 4px;">
                                                <?php echo $room['title'] ?>
                                            </div>
                                    </td>

                                    <td style="font-size: 14px;">
                                        <div
                                            style="white-space: nowrap; overflow: hidden; width: 300px; text-overflow: ellipsis;">
                                            <?php echo $room['description'] ?>
                                        </div>
                                    </td>

                                    <td style="font-size: 16px;">
                                        <div style="padding-left: 20px;">
                                            <?php echo $room['category_id'] ?>
                                        </div>
                                    </td>

                                    <td style="font-size: 16px; padding-left: 40px;">
                                        <i class="fa-solid fa-sack-dollar"
                                            style="color: #ffc105 ; font-size: 16px; margin-right: 6px;"></i>
                                        <?php echo "$ " . $room['price'] ?>
                                    </td>
                                    <td style="font-size: 16px; padding-left: 40px;">
                                        <i class="fa-solid fa-users" style="margin-right: 5px; font-size: 14px;"></i>
                                        <?php echo $room['scale'] ?>
                                    </td>
                                    <td style="font-size: 16px; padding-left: 40px;">
                                        <i class="fa-solid fa-image" style="color: #6d05ff; font-size: 16px;"></i>
                                        <?php echo '2+' ?>
                                    </td>
                                    <td>
                                        <div
                                            style="display: flex; align-items: center; column-gap: 5px; justify-content: center; padding-left: 40px; ">
                                            <div
                                                style="<?php echo $room['status'] == 1 ? "background-color: #569c68;" : "background-color: #e64e65;" ?> width: 12px; height: 12px; border-radius: 20px; ">
                                            </div>
                                            <?php echo $room['status'] == 1 ? "Active" : "Inactive" ?>
                                        </div>
                                    </td>
                                    <?php if ($_SESSION['username'] == 'admin') { ?>
                                        <td style="text-align: center; padding-left: 40px;">
                                            <a href="?action=editroom&id=<?php echo $room['id'] ?>"
                                                style="border: none; background-color: transparent;padding: 8px; color: #1572E8; font-weight: 600;">
                                                <i class="fa-solid fa-pen-nib"></i> Edit
                                            </a>
                                            <button type="button" onclick="getRoomId(<?php echo $room['id'] ?>)" id="user_id"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                style="border: none; background-color: transparent;padding: 8px; color: #e64e65; font-weight: 600;">
                                                <i class="fa-solid fa-trash-can"></i> Delete
                                            </button>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>
                        </table>
                    </div>


                    <script>
                        async function getRoomId(data) {
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

                            const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/room/readByID.php", requestOptions)
                            const result = await response.json();
                            console.log(result);
                            document.getElementById("user").innerHTML = `
                                <span style="font-size: 12px; font-weight: 600;" id="roomId" >${result.data.id}</span>
                                <div style="display: flex; flex-direction: column; row-gap: -3px;" >
                                    <span style="font-size: 15px; font-weight: 500; color: #444;" >${result.data.title}</span>
                                </div>
                            `
                        }

                    </script>

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

                </div>
            </div>

        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Launch static backdrop modal
        </button>

        <!-- Modal -->
        <div class="modal fade modal-dialog modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function deleteRoom() {
            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            const urlencoded = new URLSearchParams();
            urlencoded.append("id", document.getElementById("roomId").innerText);

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: urlencoded,
                redirect: "follow"
            };

            const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/room/deleteRoom.php", requestOptions);
            const result = await response.json();
            console.log(result);
            if (result.code == 1) {
                location.reload();
            } else {
                alert('Failed to delete room');
            }
        }
    </script>

    <?php include 'assets/footer.plugins.php' ?>
</body>

</html>