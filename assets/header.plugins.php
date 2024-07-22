<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                urls: ["./assets/css/fonts.min.css"],
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

</body>

</html>