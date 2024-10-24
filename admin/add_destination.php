<?php
include 'db.php';


$query = $conn->query("SELECT * FROM destinations");
$destinations = $query->fetch_all(MYSQLI_ASSOC);
// Query to get count of hotels
$sqlHotels = "SELECT COUNT(id) AS hotel_count FROM hotels";
$resultHotels = $conn->query($sqlHotels);
$rowHotels = $resultHotels->fetch_assoc();
$hotelCount = $rowHotels['hotel_count'];

// Query to get count of users
$sqlUsers = "SELECT COUNT(id) AS user_count FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$userCount = $rowUsers['user_count'];

// Query to get count of destinations (assuming you have a destinations table)
$sqlDestinations = "SELECT COUNT(id) AS destination_count FROM destinations";
$resultDestinations = $conn->query($sqlDestinations);
$rowDestinations = $resultDestinations->fetch_assoc();
$destinationCount = $rowDestinations['destination_count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WonderLust Destination List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
                        <a href="index-admin.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="active">
                            <span class="las la-map-marked"></span>
                            <small>Destination</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-hotel.php">
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
                <h1>Add Destination List</h1>
                <small>WanderLust</small>
            </div>

            <style>
    .page-content {
        background-color: #ffffff; /* White background for the form */
        padding: 30px; /* Increased padding for better readability */
        border-radius: 8px; /* Rounded corners for the form container */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        max-width: 800px; /* Limit form width */
        margin: 20px auto; /* Center the form */
    }

    form label {
        font-weight: bold;
        color: #333;
        margin-top: 15px;
    }

    form input[type="text"],
    form input[type="submit"],
    form select,
    form textarea,
    form input[type="file"] {
        width: 100%;
        padding: 12px; /* Increased padding for a better touch target */
        margin: 8px 0; /* Space between inputs */
        box-sizing: border-box; /* Ensures padding is included in width */
        border: 1px solid #ccc; /* Light gray border */
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Increased font size */
        transition: border-color 0.3s; /* Smooth transition for focus */
    }

    form input[type="text"]:focus,
    form textarea:focus,
    form select:focus {
        border-color: #3498db; /* Highlight border on focus */
        outline: none; /* Remove default outline */
    }

    form input[type="submit"] {
        background-color: #3498db; /* Blue background for submit button */
        color: #fff; /* White text */
        cursor: pointer; /* Pointer cursor on hover */
        border: none; /* Remove border */
        transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    form input[type="submit"]:hover {
        background-color: #2980b9; /* Darker blue on hover */
    }

    form textarea {
        height: 100px; /* Fixed height for textareas */
        resize: vertical; /* Allow vertical resizing */
    }
</style>

<div class="page-content">
    <!-- Destination Form -->
    <form method="POST" action="add_destination.php" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="location">Location</label>
        <input type="text" id="location" name="location" required>

        <label for="local_image">Choose Image from Your Device</label>
        <input type="file" id="local_image" name="local_image" accept="image/*">

        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>

        <label for="highlights">Highlights</label>
        <textarea id="highlights" name="highlights" required></textarea>

        <label for="itinerary">Itinerary</label>
        <textarea id="itinerary" name="itinerary" required></textarea>

        <label for="included">Included</label>
        <textarea id="included" name="included" required></textarea>

        <label for="excluded">Excluded</label>
        <textarea id="excluded" name="excluded" required></textarea>

        <label for="address">Address</label>
        <textarea id="address" name="address" required></textarea>

        <input type="submit" value="Add Destination">
    </form>
</div>


        </main>
    </div>

    <script>
        // JavaScript functions to control the popup
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "block";
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = "none";
        }
    </script>
</body>
</html>