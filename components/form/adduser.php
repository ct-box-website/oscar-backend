<?php



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/adduser.module.css">
    <?php include "assets/fontawesome.plugins.php" ?>
    <?php include "assets/jquery.plugins.php" ?>
</head>

<body>

    <div class="c" style="position: relative;">
        <div class="header">
            <span>Add User</span>
            <a href="?action" style="font-size: 18px;"><i class="fa-solid fa-xmark"></i></a>
        </div>

        <div class="formcontainer">
            <form action="?action=adduser" method="post">
                <div class="form">

                    <div class="info">
                        <div class="formgroup">
                            <label for="name" class="label">Username</label>
                            <input type="text" id="name" value="" class="input" placeholder="username" name="name"
                                required>
                        </div>
                        <div class="formgroup">
                            <label for="email" class="label">Email</label>
                            <input type="email" id="email" value="" class="input" placeholder="exampl@gmail.com"
                                name="email" required>
                        </div>
                        <div class="formgroup">
                            <label for="text" class="label">Gender</label>
                            <select name="gender" id="gender" style="color: #919191;">
                                <option value="-" style="color: #a1a1a1;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Femael</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="formgroup">
                            <label for="date" class="label">Date of Birth</label>
                            <input type="date" id="date" value="" class="input" name="date_of_birth" required>
                        </div>
                        <div class="formgroup">
                            <label for="password" class="label">Password</label>
                            <input type="password" value="" id="password" class="input" placeholder="********"
                                name="password" required>
                            <span id="show" style="position: absolute; top: 42px; right: 16px; cursor: pointer">

                                <i id="icon" class="fa-solid fa-eye-slash" style="color: #a1a1a1;"></i>
                            </span>
                            <script>
                                $(function () {
                                    $("#show").click(function () {
                                        var password = $("#password");
                                        if (password.attr("type") === "password") {
                                            password.attr("type", "text");
                                            $("#icon").removeClass("fa-eye-slash").addClass("fa-eye");
                                        } else {
                                            password.attr("type", "password");
                                            $("#icon").removeClass("fa-eye").addClass("fa-eye-slash");
                                        }
                                    });
                                })
                            </script>
                        </div>

                        <div class="formgroup">
                            <label for="password" class="label">Address</label>
                            <select name="address" id="address" style="color: #919191;">
                                <option value="" style="color: #a1a1a1;">Select Address</option>
                                <option value="usa">USA</option>
                                <option value="uk">UK</option>
                                <option value="china">China</option>
                                <option value="india">India</option>
                                <option value="germany">Germany</option>
                                <option value="japan">Japan</option>
                                <option value="italy">Italy</option>
                                <option value="russia">Russia</option>
                                <option value="france">France</option>
                                <option value="spain">Spain</option>
                                <option value="canada">Canada</option>
                                <option value="australia">Australia</option>
                                <option value="mexico">Mexico</option>
                                <option value="argentina">Argentina</option>
                                <option value="brazil">Brazil
                            </select>
                        </div>

                        <button type="button" id="submit" class="btn btn-primary custom_animated">
                            <i class="fa-solid fa-floppy-disk" style="padding-right: 4px;"></i>
                            Save
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa-solid fa-trash-alt" style="padding-right: 4px;"></i>
                            Reset
                        </button>

                    </div>

                    <div class="avatar">
                        <div style="" class="avatar-board">
                            <i class="fa-solid fa-image"
                                style="color: #ccc; padding-right: 4px; font-size: 24px; display: block; "
                                id="icon-img"></i>
                            <img src="" alt="Avatar"
                                style="width: 100%; height: 100%; object-fit: cover; display: none;" id="preview">
                        </div>
                        <label for="avatar" class="btn btn-primary" style="
                        width: 100%;
                        text-align: center;
                        padding: 12px;
                        cursor: pointer;
                        border-radius: 5px;
                        ">
                            <i class="fa-solid fa-image" style="color: #fff; padding-right: 4px;"></i>
                            <span style="color: #fff;">Upload Avatar</span>
                        </label>
                        <input type="file" id="avatar" name="avatar" required>
                        <script>
                            $("#avatar").change(function () {
                                var file = this.files[0];
                                var reader = new FileReader();
                                reader.onloadend = function () {
                                    $("#preview").attr("src", reader.result);
                                    $("#preview").css("display", "block");
                                    $("#icon-img").css("display", "none");
                                }
                                reader.readAsDataURL(file);
                            });
                        </script>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.getElementById('submit').addEventListener('click', async function () {
            var username = document.getElementById('name')?.value;
            var email = document.getElementById('email')?.value;
            var password = document.getElementById('password')?.value;
            var gender = document.getElementById('gender')?.value;
            var date_of_birth = document.getElementById('date')?.value;
            var address = document.getElementById('address')?.value;
            var avatar = document.getElementById('avatar');
            if (username === "" || email === "" || password === "" || gender === "" || date_of_birth === "" || address === "") {
                window.location.href = '?action=failed';
                return false;
            }
            if (avatar.files[0] === undefined) {
                window.location.href = '?action=avatar';

                const formdata = new FormData();
                formdata.append("username", username);
                formdata.append("password", password);
                formdata.append("email", email);
                formdata.append("address", address);
                formdata.append("status", "1");

                const requestOptions = {
                    method: "POST",
                    body: formdata,
                    redirect: "follow"
                };

                const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/user/create.php", requestOptions)
                const result = await response.text();
                console.log(result);
                return false;
            }

            const formdata = new FormData();
            formdata.append("username", username);
            formdata.append("password", password);
            formdata.append("email", email);
            formdata.append("address", address);
            formdata.append("status", "1");
            formdata.append("avatar", avatar.files[0], `${avatar.files[0].name}`);

            const requestOptions = {
                method: "POST",
                body: formdata,
                redirect: "follow"
            };

            const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/user/create.php", requestOptions)
            const result = await response.json();
            if (result.code == 1) {
                window.location.href = '?action=list';
            }

        })
    </script>



</body>

</html>