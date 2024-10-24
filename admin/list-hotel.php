<?php
include 'db.php';

// Function to retrieve hotel details by ID
function getHotelById($conn, $hotelId) {
    $sql = "SELECT * FROM hotels WHERE id = $hotelId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Fetching all hotels
$sql = "SELECT id, name, price, rating, location, amenities_bed, amenities_bath, image FROM hotels";
$result = $conn->query($sql);

// Fetch counts
$sqlHotels = "SELECT COUNT(id) AS hotel_count FROM hotels";
$resultHotels = $conn->query($sqlHotels);
$rowHotels = $resultHotels->fetch_assoc();
$hotelCount = $rowHotels['hotel_count'];

$sqlUsers = "SELECT COUNT(id) AS user_count FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$userCount = $rowUsers['user_count'];

$sqlDestinations = "SELECT COUNT(id) AS destination_count FROM destinations";
$resultDestinations = $conn->query($sqlDestinations);
$rowDestinations = $resultDestinations->fetch_assoc();
$destinationCount = $rowDestinations['destination_count'];

// Handle view hotel by ID
if (isset($_GET['view_id'])) {
    $viewHotelId = $_GET['view_id'];
    $viewHotel = getHotelById($conn, $viewHotelId);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust About</title>
    <link rel="stylesheet" href="css/style.css">
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
                       <a href="index-admin.php" >
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
                       <a href=""class="active">
                            <span class="las la-hotel"></span>
                            <small>Hotel</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-data.php">
                            <span class="las la-chart-bar"></span>
                            <small>Analysis</small>
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
                        <h1>Hotel List</h1>
                        <small>WanderLust</small>
                    </div>
                    <div class="nav-section">
                        <nav>
                            <ul>
                                <li><a class="hover-effect" href="booking-list-admin.php"><i class="las la-clipboard-list"></i>&nbsp;Booking Details</a></li>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="page-content">
            
                <div class="analytics">

                <div class="card">
                        <div class="card-head">
                            <h2><?php echo $userCount; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>User</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $destinationCount; ?></h2>
                            <span class="las la-map-marker"></span> 
                        </div>
                        <div class="card-progress">
                            <small>Destination List</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $hotelCount; ?></h2>
                            <span class="las la-hotel"></span> 
                        </div>
                        <div class="card-progress">
                            <small>Hotel List</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>
   
                <a href="add_hotel.php" class="button">Add Hotel Content</a>
                        
                 </div>

                <div class="records table-responsive">

                    <div>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th><span class="las la-sort"></span> IMAGE</th>
                                    <th><span class="las la-sort"></span> NAME</th>
                                    <th><span class="las la-sort"></span> PRICE PER NIGHT</th>
                                    <th><span class="las la-sort"></span> STAR RATING</th>
                                    <th><span class="las la-sort"></span> LOCATIONTOUR </th>
                                    <th><span class="las la-sort"></span> AMENITIES BED</th>
                                    <th><span class="las la-sort"></span> AMENITIES BATH</th>
                                    <th><span class="las la-sort"></span> ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td>
                                            <div class="client">
                                                <div class="client-img bg-img" style="background-image: url(<?php echo $row['image']; ?>)"></div>
                                                <div class="client-info"></div>
                                            </div>
                                        </td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>RM <?php echo $row['price']; ?></td>
                                        <td><?php echo $row['rating']; ?>/5</td>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><?php echo $row['amenities_bed']; ?></td>
                                        <td><?php echo $row['amenities_bath']; ?></td>
                                        <td>
                                            <div class="actions">
                                                <span onclick="openPopup('viewPopup_<?php echo $row['id']; ?>')" style="color: blue; cursor: pointer;" class="las la-binoculars"></span>
                                                <div id="viewPopup_<?php echo $row['id']; ?>" class="popup">
                                                    <div class="popup-content">
                                                        <!-- Close button -->
                                                        <span class="close" onclick="closePopup('viewPopup_<?php echo $row['id']; ?>')">&times;</span>
                                                        <!-- View hotel details -->
                                                        <h2>View Hotel</h2>
                                                        <div class="container">
                                                            <div class="image-column">
                                                                <div class="img">
                                                                    <label for="image-url">Image:</label>
                                                                    <img src="<?php echo $row['image']; ?>" style="width: 200px; height: 150px;">
                                                                </div>
                                                            </div>
                                                            <div class="data-column">
                                                                <div class="text p-4">
                                                                    <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="hotel-name">Hotel Name:</label>
                                                                            <input type="text" name="hotel-name" value="<?php echo $row['name']; ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="price">Price per night:</label>
                                                                            <input type="text" name="price" value="RM <?php echo $row['price']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="star-rating">Star Rating:</label>
                                                                            <input type="text" name="star-rating" value="<?php echo $row['rating']; ?>/5" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="location">Location:</label>
                                                                            <input type="text" name="location" value="<?php echo $row['location']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <label for="amenities_bed">Amenities Bed:</label>
                                                                    <input type="text" name="amenities_bed" value="<?php echo $row['amenities_bed']; ?>" readonly>

                                                                    <label for="amenities_bath">Amenities Bath:</label>
                                                                    <input type="text" name="amenities_bath" value="<?php echo $row['amenities_bath']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="update_hotel.php?id=<?= $row['id'] ?>" style="color:green" class="las la-edit"></a> |
                                                <div id="updatePopup_<?php echo $row['id']; ?>" class="popup">
                                                    <div class="popup-content">
                                                        <!-- Close button -->
                                                        

                                                        <!-- Update hotel form -->
                                                        <h2>Update Hotel</h2>
                                                        <form action="update_hotel.php" method="post">
                                                            <div class="img">
                                                                <label for="image-url">Image URL:</label>
                                                                <input type="text" id="image-url" name="image-url" value="<?php echo $row['image']; ?>" required>
                                                            </div>
                                                            <div class="text p-4">
                                                                <div class="form-row">
                                                                    <div class="form-group">
                                                                        <label for="hotel-name">Hotel Name:</label>
                                                                        <input type="text" id="hotel-name" name="hotel-name" value="<?php echo $row['name']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="price">Price per person:</label>
                                                                        <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group">
                                                                        <label for="star-rating">Star Rating:</label>
                                                                        <select id="star-rating" name="star-rating" required>
                                                                            <option value="1" <?php echo ($row['rating'] == 1) ? 'selected' : ''; ?>>1 Star</option>
                                                                            <option value="2" <?php echo ($row['rating'] == 2) ? 'selected' : ''; ?>>2 Stars</option>
                                                                            <option value="3" <?php echo ($row['rating'] == 3) ? 'selected' : ''; ?>>3 Stars</option>
                                                                            <option value="4" <?php echo ($row['rating'] == 4) ? 'selected' : ''; ?>>4 Stars</option>
                                                                            <option value="5" <?php echo ($row['rating'] == 5) ? 'selected' : ''; ?>>5 Stars</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="location">Location:</label>
                                                                        <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>" required>
                                                                    </div>
                                                                </div>
                                                                <label for="amenities">Amenities:</label>
                                                                <textarea id="amenities" name="amenities" required><?php echo $row['amenities']; ?></textarea>
                                                            </div>
                                                            <input type="hidden" name="hotel-id" value="<?php echo $row['id']; ?>">
                                                            <input type="submit" value="Update">
                                                        </form>
                                                    </div>
                                                </div>
                                    
                                                <a href="delete_hotel.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete hotel <?php echo $row['name']; ?>?')" style="color: red;" class="las la-trash" title="Delete"></a>
</div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No hotels found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>  
        </main>

        <script>
            // JavaScript functions to control the popup
            function openPopup(popupId) {
                document.getElementById(popupId).style.display = "block";
            }

            function closePopup(popupId) {
                document.getElementById(popupId).style.display = "none";
            }
        </script>
    </div>
</body>
</html>
