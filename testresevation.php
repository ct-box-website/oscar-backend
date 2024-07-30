<?php

require __DIR__ . '/vendor/autoload.php';
/**
 * @var 
 * $pusher Pusher instance
 */
if (isset($_POST['username']) && isset($_POST['room-type']) && isset(($_POST["adult"])) && isset($_POST['phone'])) {

    if (empty($_POST['username']) || empty($_POST['phone']) || empty($_POST['room-type']) || empty($_POST['adult'])) {
        $msg = "Please fill out all fields. 4 second";
        $toast = true;
        include_once "./components/ui/toast.php";
    } else {
        $msg = "Your Booking have been successfully submitted. We will contact you shortly. 4 second";
        $toast = true;
        include_once "./components/ui/toast.php";

        $options = [
            'cluster' => 'ap1',
            'useTLS' => true
        ];


        $app_id = '1837546';
        $app_secret = '6ae7db84a049ecefb695';
        $app_key = 'e760aea9751a1d7d3e85';
        $pusher = new Pusher\Pusher(
            $app_key,
            $app_secret,
            $app_id,
            $options
        );
        /**
         * Data pushed to channel
         */

        $data['data'] = [
            "username" => $_POST['username'],
            "phone" => $_POST['phone'],
            "checkin" => $_POST['checkin'],
            "checkout" => $_POST['checkout'],
            "adult" => $_POST['adult'],
            "children" => $_POST['children'],
            "room-type" => $_POST['room-type'],
        ];

        $pusher->trigger('my-channel', 'my-event', $data);

    }
} else {

}
/**
 * Array
 */



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/resevation.module.css" />
    <script src="https://kit.fontawesome.com/83db4bf7c9.js" crossorigin="anonymous"></script>
    <style>
        .input-label {
            display: flex;
            flex-direction: column;
            row-gap: 10px;
            flex: 1;

            position: relative;
        }

        label {
            color: #ccc;
            font-weight: 500;
            font-size: 16px;

            background-color: #fff;
            padding-right: 30px;
            position: absolute;
            left: 14px;
            top: 16px;
        }

        .payment_method {
            background-color: #F9F9F9;
            display: flex;
            flex-direction: row;
            align-items: center;
            column-gap: 12px;
            padding: 12px;
            border-radius: 4px;
            border: 1.2px solid #e6e6e6;
        }
    </style>


</head>

<body>

    <div class="container d-flex align-items-center justify-content-center"
        style="height: 100dvh; position: relative; ">



        <!-- Image -->
        <!-- <div style="width: 400px; height: 100%;">
                <img src="https://wallpapers-clan.com/wp-content/uploads/2024/04/avatar-the-last-airbender-aang-beautiful-desktop-wallpaper-preview.jpg"
                    style="object-fit: cover; width: 100%; height: 100%;" alt="">
            </div> -->

        <!-- Form -->
        <form action="" id="formControl" method="POST">
            <div class="divider">

                <div class="d-flex flex-column gap-4"
                    style="width: 540px; padding: 36px; border-radius: 10px; position: relative; overflow: hidden;">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <p class="title">Start your <span style="color: #1572E8;">Resevation</span></p>
                    </div>

                    <input type="text" class="input" id="username" name="username" placeholder="Name" required>

                    <input type="tel" class="input" id="phone" name="phone" placeholder="Phone" required>

                    <div class="checkinout">
                        <div class="input-label">
                            <label for="checkin" id="chkin">Check In</label>
                            <input type="date" class="inputdate" id="checkin"
                                onfocus="document.getElementById('chkin').style.display='none'" name="checkin"
                                placeholder="Check in" required>
                        </div>
                        <div class="input-label">
                            <label for="checkout" id="chkout">Check Out</label>
                            <input type="date" class="inputdate" id="checkout"
                                onfocus="document.getElementById('chkout').style.display='none'" name="checkout"
                                placeholder="Check out" required>
                        </div>
                    </div>

                    <div class="checkinout">
                        <select name="adult" id="adult" class="inputselect" required>
                            <option value="1">1 Adult</option>
                            <option value="2">2 Adults</option>
                            <option value="3">3 Adults</option>
                            <option value="4">4 Adults</option>
                            <option value="5">5 Adults</option>
                        </select>

                        <select name="children" id="children" class="inputselect">
                            <option value="0">0 Children</option>
                            <option value="1">1 Child</option>
                            <option value="2">2 Children</option>
                            <option value="3">3 Children</option>
                            <option value="4">4 Children</option>
                            <option value="5">5 Children</option>
                        </select>
                    </div>

                    <!-- Get all categories-->
                    <script>

                        const requestOptions = {
                            method: "POST",
                            redirect: "follow"
                        };

                        async function getCategories() {
                            const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/categories/read.php", requestOptions);
                            // console.log(data.data);
                            const data = await response.json();
                            return data;
                        }

                        getCategories().then(result => {
                            console.log(result.data);
                            result.data.forEach(item => {
                                document.getElementById("room-type").innerHTML += `<option value="${item.id}">${item.category_name} &nbsp;&nbsp;&nbsp; $${parseFloat(item.price).toFixed(2)}</option>`;
                            });

                            // Calculate price and days based on room type and check-in/out dates
                            document.getElementById("room-type").addEventListener("change", function () {
                                const checkin = new Date(document.getElementById("checkin").value);
                                const checkout = new Date(document.getElementById("checkout").value);
                                const diffDays = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                                const selectedRoomType = document.getElementById("room-type").value;
                                const selectedCategory = result.data.find(item => item.id === parseInt(selectedRoomType));
                                document.getElementById("days").value = `${diffDays} ${(diffDays) > 1 ? 'days' : 'day'}`;
                                document.getElementById("price").value = `$${parseFloat(selectedCategory.price).toFixed(2) * diffDays}`;
                            })

                            document.getElementById('checkin').addEventListener('change', function () {
                                const checkin = new Date(this.value);
                                const checkout = new Date(document.getElementById("checkout").value);
                                const diffDays = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                                const selectedRoomType = document.getElementById("room-type").value;
                                const selectedCategory = result.data.find(item => item.id === parseInt(selectedRoomType));
                                document.getElementById("days").value = `${diffDays} ${(diffDays) > 1 ? 'days' : 'day'}`;

                                document.getElementById("price").value = `$${parseFloat(selectedCategory.price).toFixed(2) * diffDays}`;
                            })

                            document.getElementById('checkout').addEventListener('change', function () {
                                const checkin = new Date(document.getElementById("checkin").value);
                                const checkout = new Date(this.value);
                                const diffDays = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                                const selectedRoomType = document.getElementById("room-type").value;
                                const selectedCategory = result.data.find(item => item.id === parseInt(selectedRoomType));
                                document.getElementById("days").value = `${diffDays} ${(diffDays) > 1 ? 'days' : 'day'}`;
                                document.getElementById("price").value = `$${parseFloat(selectedCategory.price).toFixed(2) * diffDays}`;
                            })
                        });

                        async function getPaymentMethod() {
                            const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/payment_method/read.php", requestOptions);
                            // console.log(data.data);
                            const data = await response.json();
                            return data;
                        }
                        let count = 0;
                        getPaymentMethod().then(result => {
                            console.log(result.data);
                            result.data.forEach(item => {
                                if (count < 3) {
                                    document.getElementById("radio-group").innerHTML += `
                                    <div class="payment_method" >
                                        <input type="radio" name="payment_method" id="paymentmethod" class="radio" required >
                                        <img src="${item.image}"
                                            alt="" style="width: 24px; height: 24px; border-radius: 4px;">
                                        <div>${item.method}</div>
                                    </div>`;
                                    count++;
                                }
                            });
                        })


                    </script>
                    <select name="room-type" id="room-type" class="inputselect" required>
                        <option value="">Select Room Type</option>
                    </select>


                </div>
                <div class="d-flex flex-column gap-4"
                    style="width: 540px; padding: 36px; border-radius: 10px; position: relative; overflow: hidden;">
                    <!-- select radio -->
                    <div id="radio-group" class=""
                        style="background-color: #fff; padding: 20px; display: flex; flex-direction: column; row-gap: 10px; border-radius: 8px; box-shadow: 0 0 25px rgba(0, 0, 0, 0.1); ">

                    </div>
                    <input type="text" class="input" id="days" name="days" value="" placeholder="" disabled required>
                    <input type="text" class="input" id="price" name="price" value="" placeholder="" disabled required>

                    <input type="submit" class="button" id="buttonSubmit" value="Booking Now">
                </div>
            </div>
        </form>
    </div>




</body>

</html>