<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="toast"
        style="position: fixed; bottom: 50px; right: 20px; z-index: 100; width: 400px; display: <?php echo $toast ? "blcok" : "none" ?>; transition: all ease-in-uot 0.5s;">
        <div
            style="background-color: #F9F9F9; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2); padding: 16px; border-radius: 4px; position: relative; overflow: hidden">
            <?php
            $bg = "";
            $bg = match ($type) {
                "success" => "#4CAF50",
                "error" => "#f44336",
                "warning" => "#FFC107",
                "info" => "#2196F3",
                default => "#1572E8",
            };
            $icon = match ($type) {
                "success" => "check-circle",
                "error" => "times-circle",
                "warning" => "exclamation-triangle",
                "info" => "info-circle",
                default => "info-circle",
            };
            ?>

            <div
                style="background-color: <?php echo $bg ?>; position: absolute; left: 0; top: 0; width: 5px; height: 100%;">
            </div>
            <i class="fa-solid fa-<?php echo $icon ?> fa-2x"
                style="color: <?php echo $bg ?>; padding-right: 8px; font-size: 18px;"></i>
            <span style="font-size: 18px;"><?php echo $msg; ?> </span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("toast").style.display = "none";
        }, 5000)

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                document.getElementById("toast").style.display = "none";
            }
        })

        document.getElementById("toast").addEventListener("click", function () {
            document.getElementById("toast").style.display = "none";
        })
    </script>

</body>

</html>