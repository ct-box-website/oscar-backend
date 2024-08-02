<?php

session_start();
$id = $_GET['id'];

$uri = $_SERVER['REQUEST_URI'];
$route = explode('/', $uri);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3"><?php echo $title ?></h3>
            <!-- <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6> -->
        </div>
        <?php if ($_SESSION["username"] === "admin") { ?>
            <div class="ms-md-auto py-2 py-md-0">
                <form action="" method="GET">
                    <?php if ($route[3] != "booking.php") { ?>
                        <a href="?action=<?php echo $addoption ?>" class="btn btn-primary btn-round">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add
                        </a>
                    <?php } ?>
                </form>
            </div>
        <?php } ?>

    </div>

    <script>
        document.getElementById('deletebtn').addEventListener('click', function () {
            getUserId(<?php echo $id ?>);
        });
    </script>

</body>

</html>