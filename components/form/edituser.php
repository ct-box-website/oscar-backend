<?php

$id = $_GET['id'];


$curl = curl_init();

curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'http://localhost/assignment/oscar-backend/_backend/api/user/readByID.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "id=$id",
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]
);

$response = curl_exec($curl);
$userData = json_decode($response, true);
curl_close($curl);


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
            <span>Update User</span>
            <a href="?action" style="font-size: 18px;"><i class="fa-solid fa-xmark"></i></a>
        </div>

        <div class="formcontainer">
            <form action="?action=adduser" method="post">
                <div class="form">

                    <div class="info">
                        <div class="formgroup">
                            <label for="name" class="label">Username</label>
                            <input type="text" id="user_id" value="<?php echo $userData['data']['id'] ?>" class="input"
                                placeholder="username" name="id" hidden disabled>
                            <input type="text" oninput="console.log(this.value)" id="username"
                                value="<?php echo $userData['data']['username'] ?>" class="input" placeholder="username"
                                name="name" required>

                        </div>
                        <div class="formgroup">
                            <label for="email" class="label">Email</label>
                            <input type="email" id="email" value="<?php echo $userData['data']['email'] ?>"
                                class="input" placeholder="exampl@gmail.com" name="email" required>
                        </div>
                        <div class="formgroup">
                            <label for="text" class="label">Gender</label>
                            <select name="gender" id="gender" style="color: #919191;">
                                <option value="<?php echo $userData['data']['gender'] ?>" style="color: #a1a1a1;">
                                    <?php echo strtoupper($userData['data']['gender'][0]) . substr($userData['data']['gender'], 1) ?>
                                </option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="formgroup">
                            <label for="text" class="label">Role</label>
                            <select name="role" id="role" style="color: #919191;">
                                <option value="<?php echo $userData['data']['gender'] ?>" style="color: #a1a1a1;">
                                    <?php echo strtoupper($userData['data']['role'][0]) . substr($userData['data']['role'], 1) ?>
                                </option>
                                <option value="manager">Manager</option>
                                <option value="user">User</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="formgroup">
                            <label for="date" class="label">Date of Birth</label>
                            <input type="date" id="date" value="<?php echo $userData['data']['date_of_birth'] ?>"
                                class="input" name="date_of_birth" required>
                        </div>
                        <!-- <div class="formgroup" onclick="alert('Password cannot update!')">
                            <label for="password" class="label">Password</label>
                            <input type="password" value="" id="password" class="input" disabled placeholder="********"
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
                        </div> -->

                        <div class="formgroup">
                            <label for="password" class="label">Address</label>
                            <select name="address" onchange="console.log(this.value)" id="address"
                                style="color: #919191;">
                                <option value="<?php echo $userData['data']['address'] ?>" style="color: #a1a1a1;">
                                    <?php echo $userData['data']['address'] ?>
                                </option>
                                <option value="banteay-meanchey">Banteay Meanchey</option>
                                <option value="battambang">Battambang</option>
                                <option value="kampong-cham">Kampong Cham</option>
                                <option value="kampong-chhnang">Kampong Chhnang</option>
                                <option value="kampong-speu">Kampong Speu</option>
                                <option value="kampong-thom">Kampong Thom</option>
                                <option value="kampot">Kampot</option>
                                <option value="kandal">Kandal</option>
                                <option value="koh-kong">Koh Kong</option>
                                <option value="kratie">Kratie</option>
                                <option value="mondulkiri">Mondulkiri</option>
                                <option value="phnom-penh">Phnom Penh</option>
                                <option value="preah-vihear">Preah Vihear</option>
                                <option value="prey-veng">Prey Veng</option>
                                <option value="pursat">Pursat</option>
                                <option value="ratanakiri">Ratanakiri</option>
                                <option value="siem-reap">Siem Reap</option>
                                <option value="preah-sihanouk">Preah Sihanouk</option>
                                <option value="stung-treng">Stung Treng</option>
                                <option value="svay-rieng">Svay Rieng</option>
                                <option value="takeo">Takeo</option>
                                <option value="oddar-meanchey">Oddar Meanchey</option>
                                <option value="kep">Kep</option>
                                <option value="pailin">Pailin</option>
                                <option value="tboung-khmum">Tboung Khmum</option>

                            </select>
                        </div>

                        <button type="button" id="submit" class="btn btn-primary custom_animated">
                            <i class="fa-solid fa-floppy-disk" style="padding-right: 4px;"></i>
                            Update
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa-solid fa-trash-alt" style="padding-right: 4px;"></i>
                            Reset
                        </button>

                    </div>

                    <div class="avatar">
                        <div style="" class="avatar-board">
                            <!-- <i class="fa-solid fa-image"
                                style="color: #ccc; padding-right: 4px; font-size: 24px; display: block; "
                                id="icon-img"></i> -->
                            <img src="_backend/config/avatar/<?php echo $userData['data']['avatar'] ?>" alt="Avatar"
                                style="width: 100%; height: 100%; object-fit: cover;" id="preview">
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
                        <input type="file" id="avatar" value="<?php echo $userData['data']['avatar'] ?>" name="avatar"
                            required>
                        <script>
                            $("#avatar").change(function () {
                                var file = this.files[0];
                                var reader = new FileReader();
                                reader.onloadend = function () {
                                    $("#preview").attr("src", reader.result);
                                }
                                reader.readAsDataURL(file);
                            });
                        </script>
                    </div>
                </div>
            </form>
            <script>
                document.getElementById("submit").addEventListener("click", async function () {
                    var id = document.getElementById("user_id").value;
                    var name = document.getElementById("username").value;
                    var email = document.getElementById("email").value;
                    var address = document.getElementById("address").value;
                    var date_of_birth = document.getElementById("date").value;
                    var gender = document.getElementById("gender").value;
                    var role = document.getElementById("role").value;
                    var avatar = document.getElementById("avatar");
                    if (!avatar) {
                        alert("Please select an avatar!");
                        console.log(avatar);
                        return;
                    } else {
                        console.log(avatar?.value);
                    }

                    // Create a new FormData object.
                    const formdata = new FormData();
                    formdata.append("id", id);
                    formdata.append("username", name);
                    formdata.append("email", email);
                    formdata.append("address", address);
                    formdata.append("status", "1");
                    formdata.append("role", role);
                    formdata.append("date_of_birth", date_of_birth);
                    formdata.append("gender", gender);
                    if (avatar.files[0]) formdata.append("avatar", avatar.files[0], `${avatar.files[0].name}`);


                    const requestOptions = {
                        method: "POST",
                        body: formdata,
                        redirect: "follow"
                    };

                    try {
                        const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/user/update.php", requestOptions);
                        const result = await response.json();
                        console.log(result)
                        if (result.code == 1) {
                            window.location.href = "?action=list";
                        }
                    } catch (error) {
                        console.error(error);
                    };
                });


            </script>
        </div>
    </div>
</body>

</html>