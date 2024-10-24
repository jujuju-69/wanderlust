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
                    <a href="list-destination.php">
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
                        <a href="#" class="active">
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
                <h1>Data Analysis</h1>
                <small>from WanderLust database </small>
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
            </div>
        </main>
    </div>

    <section id="dashboard-powerbi">
                <h1>Welcome to the Dashboard Analysis Data</h1>
                <p>Below you can find key reports and insights:</p>
                <br>
                <div class="powerbi-report">
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiM2QwNTdlYjctNTQ1NS00MWY4LWJhOTQtNTAxZDkzYTU5ZGI1IiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D" 
                        
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>

                        <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
                <h1>Welcome to the Dashboard Analysis Data</h1>
                <p>Below you can find key reports and insights:</p>
                <br>
                <div class="powerbi-report">
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiM2QwNTdlYjctNTQ1NS00MWY4LWJhOTQtNTAxZDkzYTU5ZGI1IiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D" 
                        
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
                <h1>Welcome to the Dashboard Analysis Data</h1>
                <p>Below you can find key reports and insights:</p>
                <br>
                <div class="powerbi-report">
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiM2QwNTdlYjctNTQ1NS00MWY4LWJhOTQtNTAxZDkzYTU5ZGI1IiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D" 
                        
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>
                
                </div>
    </section>

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