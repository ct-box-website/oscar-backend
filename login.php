<?php

session_start();

session_destroy();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="shortcut icon"
        href="https://cdn.myportfolio.com/17be4dd08c5417027a544816a909fcf8/4cb3876a-d1fd-46fc-84bb-4a5285eb33bc_rw_1200.png?h=b58c258f0b0bc2fd7d20c2ee8084a9cd"
        type="image/x-icon">
    <style>
        .input {
            padding: 10px;
            border: none;
            padding-left: 16px;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease;
            font-size: 16px;
            color: #888;
            font-weight: 600;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);

            &::placeholder {
                color: #ccc;
                font-weight: 400;
            }
        }

        .button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #1572E8;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;

            &:hover {
                background-color: #1059C6;
                scale: 1.01;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            &:active {
                transform: scale(0.98);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.01);

            }
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100dvh;">
        <form action="" id="formControl" method="POST">
            <div class="d-flex flex-column gap-4"
                style="width: 500px; padding: 36px; padding-top: 140px; border-radius: 10px; background-color: #F9F9F9; box-shadow: 0 0 25px rgba(0, 0, 0, 0.15); position: relative; overflow: hidden;">

                <div style="z-index: 20; display: flex; margin-top: 20px; " class="align-items-center flex-column">
                    <div style="width: 84px; height: 84px; border-radius: 100%; border: 4px solid #fff">
                        <img src="https://cdn-icons-png.flaticon.com/256/3177/3177440.png" alt=""
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>

                <div style="position: absolute; left: 0; top: 0; z-index: 0; height: 200px; width: 100%">
                    <img src="https://www.dexerto.com/cdn-cgi/image/width=3840,quality=75,format=auto/https://editors.dexerto.com/wp-content/uploads/2022/08/15/Avatar-Generations-release-date-1024x576.jpg"
                        style="width: 100%; height: 100%; object-fit:cover; object-position: bottom;" sizes="500"
                        alt="">
                </div>


                <div class="d-flex align-items-center justify-content-center flex-column">
                    <p class="title">Login to <span style="color: #1572E8;">Continue</span></p>
                </div>

                <input type="text" class="input" id="username" name="username" placeholder="Username" required>

                <input type="password" class="input" id="password" name="password" placeholder="Password" required>

                <input type="submit" class="button" id="buttonSubmit" value="Login">

            </div>
        </form>
        <script>
            document.getElementById("formControl").addEventListener('submit', async function (event) {
                event.preventDefault();
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;


                const url = 'http://192.168.1.5/assignment/oscar-backend/_backend/api/user/read.php';

                const options = {
                    method: 'POST',
                    headers: { 'content-type': 'application/x-www-form-urlencoded' },
                };

                try {
                    const response = await fetch(url, options);
                    const data = await response.json();
                    const user = data.data.find(user => user.username === username && user.password === password);
                    if (user) {
                        // localStorage.setItem('token', data.data.token);
                        console.log("Successfully logged in");
                        window.location.replace('http://192.168.1.5/assignment/oscar-backend/index.php')
                    } else {
                        alert('Invalid Credentials');
                    }
                    return data;
                } catch (error) {
                    console.error(error);
                }

            })
        </script>

        <?php

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }
        ?>
        <!-- console.log(data);
                if (data.status === 200) {
                    localStorage.setItem('token', data.data.token);
                    window.location.href = 'dashboard.php';
                } else {
                    alert(data.msg);
                } -->
    </div>

</body>

</html>