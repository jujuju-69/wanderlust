<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wanderlust";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload for hotels
    $target_dir_hotel = "images/";  // Specify the directory for hotels files
    $target_file_hotel = $target_dir_hotel . basename($_FILES["image-file"]["name"]);
    $uploadOk_hotel = 1;
    $imageFileType_hotel = strtolower(pathinfo($target_file_hotel, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check_hotel = getimagesize($_FILES["image-file"]["tmp_name"]);
    if ($check_hotel === false) {
        echo "File is not an image.";
        $uploadOk_hotel = 0;
    }

    // Check file size
    if ($_FILES["image-file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk_hotel = 0;
    }

    // Allow certain file formats
    if ($imageFileType_hotel != "jpg" && $imageFileType_hotel != "png" && $imageFileType_hotel != "jpeg"
        && $imageFileType_hotel != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk_hotel = 0;
    }

    // Proceed if all checks passed
    if ($uploadOk_hotel == 1) {
        // Move uploaded file to the designated directory
        if (move_uploaded_file($_FILES["image-file"]["tmp_name"], $target_file_hotel)) {
            // File uploaded successfully, proceed to insert data into database
            $hotel_name = $_POST['hotel-name'];
            $price = $_POST['price'];
            $star_rating = $_POST['star-rating'];
            $location = $_POST['location'];
            $amenities_bed = $_POST['amenities-bed'];
            $amenities_bath = $_POST['amenities-bath'];
            $image_url_hotel = $target_file_hotel; // Store image path in database

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO hotels (name, price, rating, location, amenities_bed, amenities_bath, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $hotel_name, $price, $star_rating, $location, $amenities_bed, $amenities_bath, $image_url_hotel);

            // Execute query and check if successful
            if ($stmt->execute()) {
                // Redirect back to hotel list page after successful insertion
                header("Location: list-hotel.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, your file was not uploaded.";
    }
}

// Close the connection
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WonderLust Add Hotel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* Add your custom CSS styles here */
        /* Existing styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }
        
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 8px;
            color: #666;
        }
        
        .hotel-image {
            width: 100%;
            height: auto;
            max-height: 300px; /* Adjust height as needed */
            object-fit: cover; /* Ensures the image covers the entire container */
            border-radius: 5px; /* Optional: Adds rounded corners */
        }
        
        /* New styles for the form */
        .page-content {
            background-color: #f0f0f0; /* Light gray background */
            padding: 20px; /* Add padding for better readability */
            border-radius: 10px; /* Rounded corners for the form container */
        }
        
        form {
            background-color: #fff; /* White background for form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }
        
        form label {
            font-weight: bold;
            color: #333;
        }
        
        form input[type="text"],
        form input[type="submit"],
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        form input[type="submit"] {
            background-color: #3498db; /* Blue background for submit button */
            color: #fff;
            cursor: pointer;
        }
        
        form input[type="submit"]:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }
        
        form textarea {
            height: 100px; /* Set height for the textarea */
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/WanderLust-Logo.png)"></div>
                <h4>Admin NWDL</h4>
                <small>N.WanderLust</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                        <a href="index-admin.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-destination.php">
                            <span class="las la-map-marked"></span>
                            <small>Destination</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-hotel.php" class="active">
                            <span class="las la-hotel"></span>
                            <small>Hotel</small>
                        </a>
                    </li>
                    <li>
                        <a href="logout-admin.php">
                            <span class="las la-sign-out-alt"></span>
                            <small>Log Out</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <main>
            <div class="page-header">
                <div class="header-content">
                    <div class="title-section">
                        <h1>Add Hotel</h1>
                        <small>WanderLust</small>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <!-- Hotel Form -->
                <form action="add_hotel.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="image-file">Choose Image:</label>
        <input type="file" id="image-file" name="image-file" onchange="updateImagePreview(this)" accept="image/*" required>
        <p id="file-name"></p>
        <img id="image-preview" src="" alt="Image Preview" class="hotel-image">
    </div>
                    <div class="text p-4">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="hotel-name">Hotel Name:</label>
                                <input type="text" id="hotel-name" name="hotel-name" placeholder="Enter hotel name" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price per person:</label>
                                <input type="text" id="price" name="price" placeholder="Enter price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="star-rating">Star Rating:</label>
                                <select id="star-rating" name="star-rating" required>
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" id="location" name="location" placeholder="Enter location" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="amenities-bed">Bed Amenities:</label>
                                <input type="text" id="amenities-bed" name="amenities-bed" placeholder="Enter bed amenities" required>
                            </div>
                            <div class="form-group">
                                <label for="amenities-bath">Bath Amenities:</label>
                                <input type="text" id="amenities-bath" name="amenities-bath" placeholder="Enter bath amenities" required>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>
    </div>

    <script>
function updateImagePreview(input) {
    const file = input.files[0];
    const reader = new FileReader();

    // Update the file name display
    document.getElementById('file-name').textContent = file.name;

    // Update the image preview
    reader.onload = function(e) {
        document.getElementById('image-preview').src = e.target.result;
    };

    // Read the uploaded file as a URL
    reader.readAsDataURL(file);
}
</script>
</body>
</html>
