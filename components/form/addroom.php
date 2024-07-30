<?php

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
            <span>Add Room</span>
            <a href="?action" style="font-size: 18px;"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <div class="divider">

            <form action="">
                <div class="form">

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="input" placeholder="title">

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" class="input" cols="50"></textarea>

                    <label for="category">Category:</label>
                    <select id="category" name="category" class="input-select">
                        <option value="">Select room type</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                    </select>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="input">

                    <label for="scale">Capacity:</label>
                    <select id="capacity" name="scale" class="input-select">
                        <option value="">Select capacity</option>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                    </select>
                </div>
            </form>

            <div class="sidebar-form">
                <span style="">Upload Images:</span>
                <div class="image-con">
                    <label class="image" for="image1">
                        <i class="fa-regular fa-image" id="icon1" style="display: block;"></i>
                        <img src="" alt="" class="image_show" id="showImage1"
                            style="display: none;  width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" onchange="console.log('Are ok')" id="image1">

                    <label class="image" for="image2">
                        <i class="fa-regular fa-image" id="icon2" style="display: block;"></i>
                        <img src="" alt="" class="image_show" id="showImage2"
                            style="display: none;  width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" id="image2">

                    <label class="image" for="image3">
                        <i class="fa-regular fa-image" id="icon3" style="display: block;"></i>
                        <img src="" alt="" class="image_show" id="showImage3"
                            style="display: none;  width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">
                    </label>
                    <input type="file" name="images" id="image3">

                    <label class="image" for="image4">
                        <i class="fa-regular fa-image" id="icon4" style="display: block;"></i>
                        <img src="" alt="" class="image_show" id="showImage4"
                            style="display: none;  width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">
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
                const result = await response.text();
                console.log("===", result)
            } catch (error) {
                console.error(error);
            };
        })
    </script>

</body>

</html>