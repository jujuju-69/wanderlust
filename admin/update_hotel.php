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

// Initialize $hotelId
$hotelId = null;

// Check if hotel ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $hotelId = $_GET['id'];

    // Query to fetch hotel details by ID
    $sql = "SELECT id, name, price, rating, location, amenities_bed, amenities_bath, image
            FROM hotels
            WHERE id = $hotelId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $hotel = $result->fetch_assoc();
    } else {
        echo "Hotel not found.";
        exit; // Or handle error as needed
    }
} else {
    echo "Hotel ID not provided.";
    exit; // Or redirect to an error page
}

// Handle form submission to update hotel details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data if required
    $hotelName = $_POST['hotel-name'];
    $price = $_POST['price'];
    $rating = $_POST['star-rating'];
    $location = $_POST['location'];
    $amenitiesBed = $_POST['amenities-bed'];
    $amenitiesBath = $_POST['amenities-bath'];

    // Initialize $updateSql
    $updateSql = "UPDATE hotels SET 
                  name = '$hotelName', 
                  price = '$price', 
                  rating = '$rating',
                  location = '$location', 
                  amenities_bed = '$amenitiesBed', 
                  amenities_bath = '$amenitiesBath'";

    // Handle image upload if a new file is selected
    if ($_FILES['image-file']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image-file']['tmp_name'];
        $upload_dir = '../images/';
        $new_filename = uniqid('hotel_image_') . '.' . pathinfo($_FILES['image-file']['name'], PATHINFO_EXTENSION); // Generate a unique filename
        $destination = $upload_dir . $new_filename;
        
        // Move the uploaded file to the designated directory
        if (move_uploaded_file($tmp_name, $destination)) {
            // Update the database with the new image path
            $updateSql .= ", image = '$destination'";
        } else {
            echo "Failed to move uploaded file.";
        }
    }

    // Finalize the update SQL with WHERE clause
    $updateSql .= " WHERE id = $hotelId";
    
    // Execute the update query
    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to list-hotel.php upon successful update
        header("Location: list-hotel.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust Hotel List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* Add your custom CSS styles here */
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

    /* Existing styles */
    
    /* Styling for file input */
    .img input[type="file"] {
        display: none; /* Hide the default file input */
    }
    
    .img label {
        display: inline-block;
        background-color: #3498db; /* Example background color */
        color: #fff;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
    }
    
    .img label:hover {
        background-color: #2980b9; /* Darker background color on hover */
    }
    
    .img img {
        max-width: 100px;
        margin-top: 10px;
        display: block; /* Ensure the image is displayed properly */
    }

    </style>
</head>

<body>
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
                       <a href="index-admin.php" >
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="list-about.php">
                            <span class="las la-info-circle"></span>
                            <small>About</small>
                        </a>
                    </li>
                    <li>
                       <a href="list-destination.php">
                            <span class="las la-map-marked"></span> 
                            <small>Destination</small>
                        </a>
                    </li>
                    <li>
                       <a href="list-hotel.php"class="active">
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
    
    <div class="main-content">
        <main>
            <div class="page-header">
                <div class="header-content">
                    <div class="title-section">
                        <h1>Edit Hotel List</h1>
                        <small>WanderLust</small>
                    </div>
                </div>
            </div>
            
            <div class="page-content">
                <div class="edit-hotel-form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $hotelId; ?>" method="post" enctype="multipart/form-data">
                        <label for="hotel-name">Hotel Name:</label>
                        <input type="text" id="hotel-name" name="hotel-name" value="<?php echo htmlspecialchars($hotel['name']); ?>" required>

                        <label for="price">Price per person:</label>
                        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($hotel['price']); ?>" required>

                        <label for="star-rating">Star Rating:</label>
                        <select id="star-rating" name="star-rating" required>
                            <option value="1" <?php if ($hotel['rating'] == 1) echo 'selected'; ?>>1 Star</option>
                            <option value="2" <?php if ($hotel['rating'] == 2) echo 'selected'; ?>>2 Stars</option>
                            <option value="3" <?php if ($hotel['rating'] == 3) echo 'selected'; ?>>3 Stars</option>
                            <option value="4" <?php if ($hotel['rating'] == 4) echo 'selected'; ?>>4 Stars</option>
                            <option value="5" <?php if ($hotel['rating'] == 5) echo 'selected'; ?>>5 Stars</option>
                        </select>

                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($hotel['location']); ?>" required>

                        <label for="amenities-bed">Amenities (Bed):</label>
                        <input type="text" id="amenities-bed" name="amenities-bed" value="<?php echo htmlspecialchars($hotel['amenities_bed']); ?>" required>

                        <label for="amenities-bath">Amenities (Bath):</label>
                        <input type="text" id="amenities-bath" name="amenities-bath" value="<?php echo htmlspecialchars($hotel['amenities_bath']); ?>" required>
                        
                        <div class="img">
    <label for="image-file">Choose Image</label>
    <input type="file" id="image-file" name="image-file" onchange="updateImagePreview(this)">
    <?php if (!empty($hotel['image']) && file_exists($hotel['image'])): ?>
        <img id="image-preview" src="<?php echo $hotel['image']; ?>" alt="Current Image">
    <?php else: ?>
        <p>No image uploaded yet.</p>
    <?php endif; ?>
    <span id="file-name"></span>
</div>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
    function updateImagePreview(input) {
        const fileName = input.files[0].name;
        document.getElementById('file-name').textContent = fileName;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>

</body>
</html>
