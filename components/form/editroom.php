<?php
$room_id = $_GET['id'];
$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => 'http://localhost/assignment/oscar-backend/_backend/api/room/readById.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "id=$room_id",
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    )
);

$response = curl_exec($curl);
$data = json_decode($response, true);
$room = $data['data'];
curl_close($curl);

$images = explode(',', $room['images']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/addroom.module.css">
</head>

<body>

    <div class="co">
        <div class="form-header">
            <span>Update Room</span>
            <a href="?action" style="font-size: 18px;"><i class="fa-solid fa-xmark"></i></a>
        </div>

        <div class="divider">

            <form action="">
                <div class="form">

                    <label for="title">Title:</label>
                    <input type="text" value="<?php echo $room['title'] ?>" id="title" name="title" class="input"
                        placeholder="Title">

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" class="input" cols="50">
                        <?php echo $room['description'] ?>
                    </textarea>

                    <label for="category">Category:</label>
                    <select id="category" name="category" class="input-select">
                        <option value="<?php echo $room['category_id'] ?>"><?php echo $room['category_id'] ?></option>
                    </select>

                    <label for="price">Price:</label>
                    <input type="number" id="price" value="<?php echo $room['price'] ?>" name="price" class="input"
                        placeholder="Price $" min="0">

                    <label for="scale">Capacity:</label>
                    <select id="capacity" name="scale" class="input-select">
                        <option value="<?php echo $room['scale'] ?>"><?php echo $room['scale'] ?></option>
                        <option value="2-3">2-3 People</option>
                        <option value="3-4">3-4 People</option>
                        <option value="4-5">4-5 People</option>
                    </select>
                </div>
            </form>

            <div class="sidebar-form">
                <span style="">Upload Images:</span>
                <div class="image-con">
                    <label class="image" for="image1">
                        <i class="fa-regular fa-image" id="icon1" style="display: none;"></i>
                        <img src="<?php echo $images[0] ?>" alt="" class="image_show" id="showImage1"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" onchange="console.log('Are ok')" id="image1">

                    <label class="image" for="image2">
                        <i class="fa-regular fa-image" id="icon2" style="display: none;"></i>
                        <img src="<?php echo $images[1] ?>" alt="" class="image_show" id="showImage2"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" id="image2">

                    <label class="image" for="image3">
                        <i class="fa-regular fa-image" id="icon3" style="display: none;"></i>
                        <img src="<?php echo $images[2] ?>" alt="" class="image_show" id="showImage3"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" id="image3">

                    <label class="image" for="image4">
                        <i class="fa-regular fa-image" id="icon4" style="display: none;"></i>
                        <img src="<?php echo $images[3] ?>" alt="" class="image_show" id="showImage4"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" id="image4">
                </div>
                <div class="button-control">
                    <button type="button" class="btn btn-primary" id="btn-submit">
                        <i class="fa-regular fa-floppy-disk"></i> Submit
                    </button>
                    <a href="?action" class="btn btn-danger">
                        <i class="fa-solid fa-ban"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function getCategories() {


            const requestOptions = {
                method: "POST",
                redirect: "follow"
            };

            try {
                const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/categories/read.php", requestOptions);
                const result = await response.json();
                if (result.code == 1 && result.data.length > 0) {
                    result.data.forEach(item => {
                        document.getElementById('category').innerHTML += `<option value="${item.id}">${item.category_name}</option>`;
                    });
                } else {
                    console.log('No categories found');
                }
            } catch (error) {
                console.error(error);
            };
        }
        getCategories();
    </script>

    <script>
        var image = {
            image1: '',
            image2: '',
            image3: '',
            image4: '',
        };
        // Add event listeners for image input fields
        document.getElementById('image1').addEventListener('change', async function () {
            const fileInput = document.querySelectorAll('.image-con #image1');
            image.image1 = await uploadImages(fileInput[0].files[0]);
            document.getElementById('showImage1').src = image.image1;
            document.getElementById('showImage1').style.display = 'block';
            document.getElementById('icon1').style.display = 'none';
            console.log('Image 1 uploaded successfully');
        });
        document.getElementById('image2').addEventListener('change', async function () {
            const fileInput = document.querySelectorAll('.image-con #image2');
            image.image2 = await uploadImages(fileInput[0].files[0]);
            document.getElementById('showImage2').src = image.image2;
            document.getElementById('showImage2').style.display = 'block';
            document.getElementById('icon2').style.display = 'none';
            console.log('Image 2 uploaded successfully');
        });
        document.getElementById('image3').addEventListener('change', async function () {
            const fileInput = document.querySelectorAll('.image-con #image3');
            image.image3 = await uploadImages(fileInput[0].files[0]);
            document.getElementById('showImage3').src = image.image3;
            document.getElementById('showImage3').style.display = 'block';
            document.getElementById('icon3').style.display = 'none';
            console.log('Image 3 uploaded successfully');
        });
        document.getElementById('image4').addEventListener('change', async function () {
            const fileInput = document.querySelectorAll('.image-con #image4');
            image.image4 = await uploadImages(fileInput[0].files[0]);
            document.getElementById('showImage4').src = image.image4;
            document.getElementById('showImage4').style.display = 'block';
            document.getElementById('icon4').style.display = 'none';
            console.log('Image 4 uploaded successfully');
        });

        async function uploadImages(file) {
            const formData = new FormData();
            formData.append('file', file);
            const response = await fetch('http://100.29.7.81/api/uploadImage/upload.php', {
                method: 'POST',
                body: formData,
            });
            if (response.ok) {
                console.log('��� Images1 uploaded successfully');
                const images = await response.json();
                console.log(images.data.file_url);
                return images.data.file_url;
            } else {
                console.error('Error uploading images');
            }
        };

        // Add event listener for submit button
        document.getElementById('btn-submit').addEventListener('click', async function () {
            const images = image.image1 + "," + image.image2 + "," + image.image3 + "," + image.image4;
            var title = document.getElementById('title').value;
            var description = document.getElementById('description').value;
            var category_id = document.getElementById('category').value;
            var price = document.getElementById('price').value;
            var scale_id = document.getElementById('capacity').value;
            console.log(images, title, description, category_id, price, scale_id);
            // Validate form inputs
            if (title === "" || description === "" || category_id === "" || price === "" || scale_id === "") {
                alert("Please fill out all required fields");
                return;
            }

            // Validate price input
            if (isNaN(price) || price <= 0) {
                alert("Price must be a positive number");
                return;
            }

            // Validate scale input
            if (scale_id === "") {
                alert("Please select a capacity");
                return;
            }

            // Validate images
            if (images === "{}") {
                alert("Please upload at least one image");
                return;
            }

            // Submit the form data to the server or save it locally
            const formdata = new FormData();
            formdata.append("title", title);
            formdata.append("description", description);
            formdata.append("category_id", category_id);
            formdata.append("price", price);
            formdata.append("scale", scale_id);
            formdata.append("images", images);

            const requestOptions = {
                method: "POST",
                body: formdata,
                redirect: "follow"
            };

            try {
                const response = await fetch("http://localhost/assignment/oscar-backend/_backend/api/room/create.php", requestOptions);
                const result = await response.json();
                if (result.code == 1) {
                    alert("Room created successfully");
                    window.location.href = "?action=success";
                }
            } catch (error) {
                alert("Error creating room");
                window.location.href = "?action";
                console.error(error);
            };
        })
    </script>

</body>

</html>