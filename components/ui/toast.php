<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="toast"
        style="position: absolute; bottom: 50px; right: 20px; z-index: 100; width: 400px; display: <?php echo $toast ? "blcok" : "none" ?>">
        <div
            style="background-color: #F9F9F9; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2); padding: 16px; border-radius: 4px; position: relative; overflow: hidden">
            <div style="background-color: #1572E8; position: absolute; left: 0; top: 0; width: 4px; height: 100%;">
            </div>
            <span><?php echo $msg; ?> </span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("toast").style.display = "none";
        }, 10000)

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