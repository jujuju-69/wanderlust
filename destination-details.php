<?php
$title = 'Destination Details';  // set destination/tour title
include 'header.php';
include 'db.php';
$id = $_GET['id'];

// Fetch destination details
$query = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$destination = $query->get_result()->fetch_assoc();

// Fetch hotels based on destination location
$location = $destination['location'];
$hotelsQuery = $conn->prepare("SELECT * FROM hotels WHERE location = ?");
$hotelsQuery->bind_param("s", $location);
$hotelsQuery->execute();
$hotels = $hotelsQuery->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <h1 class="mb-0 bread"><?php echo $destination['location']; ?></h1>
      </div>
    </div>
 </div>
</section>

<!-- DETAILS -->
<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <div class="header">
            <h1><?php echo $destination['name']; ?> </h1>
      </div>
          
        <img src="<?php echo $destination['image']; ?>" alt="<?php echo $destination['name']; ?>" class="img-fluid">
   
        <div class="description">
            <p><?php echo $destination['description']; ?></p>
        </div>
		
        <div>
            <h2>Included and Excluded</h2>
            <div class="included-excluded">
                <div class="included">
                    <ul>
                        <li><i class="fa fa-check"></i><?php echo $destination['included']; ?></li>
                    </ul>
                </div>
                <div class="excluded">
                    <ul>
                        <li><i class="bi bi-x-square-fill"></i><?php echo $destination['excluded']; ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="highlights">
            <h2>Highlights of the Tour</h2>
            <ul>
                <li><i class="bi bi-bookmark-star-fill"></i> <?php echo $destination['highlights']; ?></li>
            </ul>
        </div>

        <div class="itinerary">
            <h2>Itinerary</h2>
            <div class="accordion">
                <div class="accordion-item">
                    <button class="btn btn-primary accordion-button">Day 01: Admire Big Ben, Buckingham Palace And St Paul’s Cathedral<i class="bi bi-chevron-down"></i></button>
                    <div class="accordion-content">
                        <p><?php echo $destination['itinerary']; ?></p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="btn btn-primary accordion-button">Day 02: Adventure Begins<i class="bi bi-chevron-down"></i></button>
                    <div class="accordion-content">
                        <p>Begin your adventure with thrilling activities.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="btn btn-primary accordion-button">Day 03: Historical Tour<i class="bi bi-chevron-down"></i></button>
                    <div class="accordion-content">
                        <p>Delve into the rich history of the area.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="location">
            <h2>Location Map</h2>
            <div class="map-container mt-3">
            <?php
            // Fetch the location address from the database result
            $address = $destination['address'];
            
            // Encode the address for use in the URL
            $encodedAddress = urlencode($address);

            // URL for the Google Maps Embed
            $mapUrl = "https://www.google.com/maps?q=$encodedAddress&output=embed";
            ?>

            <!-- Embed the Google Map in an iframe -->
            <iframe
                id="map"
                frameborder="0"
                style="border:0"
                src="<?php echo $mapUrl; ?>"
                allowfullscreen>
            </iframe>
            </div>
        </div>

        <!-- Display Hotels -->
        <div class="hotels">
            <h2>Hotels in <?php echo $destination['location']; ?></h2>
            <?php if (count($hotels) > 0): ?>
                <div class="row">
                    <?php foreach ($hotels as $hotel): ?>
                        <div class="col-md-4 ftco-animate">
                            <div class="project-wrap">
                                <a href="hotel-details.php?id=<?php echo $hotel['id']; ?>" class="img" style="background-image: url('<?php echo $hotel['image']; ?>');">
    
                                </a>
                                <div class="text p-4">
                                    <h3><a href="hotel-details.php?id=<?php echo $hotel['id']; ?>"><?php echo $hotel['name']; ?></a></h3>
                                    <p><?php echo $hotel['rating']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No hotels available in this location.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include 'destination-sidebar.php'; ?>
</section>

<!-- ACTIVITY -->
<section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Popular <span style="font-weight:bold; color:#f15d30;">Activities</span> To Do</h2> 
                <!-- pull >4 data from databse, select destination and calc total of tour existed from tour table -->
            </div>
        </div>
    </div>
    <div class="container-1">
        <div class="carousel-1">
            <img class="item" src="https://images.pexels.com/photos/21927155/pexels-photo-21927155/free-photo-of-madera-amanecer-paisaje-agua.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/22027165/pexels-photo-22027165/free-photo-of-nieve-nevar-paisaje-puesta-de-sol.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/22377281/pexels-photo-22377281/free-photo-of-madera-paisaje-agua-verano.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/22447657/pexels-photo-22447657/free-photo-of-madera-paisaje-agua-verano.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/13673325/pexels-photo-13673325.jpeg" alt="">
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

.map-container {
    width: 100%;
    height: 450px;
    margin-bottom: 20px;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    color: #27ae60;
    margin: 0;
    font-size: 2em;
}

.header del {
    color: #e74c3c;
}

.header p {
    color: #7f8c8d;
}

.description, .included-excluded, .highlights, .itinerary, .location {
    margin-bottom: 20px;
}

h2 {
    color: #2c3e50;
    border-bottom: 2px solid #ecf0f1;
    padding-bottom: 10px;
}

.included-excluded {
    display: flex;
    justify-content: space-between;
}

.included-excluded .included, .included-excluded .excluded {
    width: 45%;
}

.included-excluded ul {
    list-style: none;
    padding: 0;
}

.included-excluded ul li {
    color: #27ae60;
    margin-bottom: 10px;
}

.included-excluded ul li i {
    color: #27ae60;
    margin-right: 10px;
}

.included-excluded .excluded ul li {
    color: #e74c3c;
}

.included-excluded .excluded ul li i {
    color: #e74c3c;
}

.highlights ul {
    list-style: none;
    padding: 0;
}

.highlights ul li {
    color: #f39c12;
    margin-bottom: 10px;
}

.highlights ul li i {
    color: #f39c12;
    margin-right: 10px;
}

.accordion {
    margin-bottom: 20px;
}

.accordion .accordion-item {
    margin-bottom: 10px;
}

.accordion .accordion-button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #2980b9;
    color: white;
    border: none;
    cursor: pointer;
    width: 100%;
}

.accordion .accordion-content {
    display: none;
    padding: 10px;
    background-color: #ecf0f1;
    border: 1px solid #bdc3c7;
}

.map-container {
    width: 100%;
    height: 450px;
    margin-bottom: 20px;
}

.hotels {
    margin-top: 20px;
}

.project-wrap {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.project-wrap:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
}

.project-wrap .img {
    position: relative;
    width: 100%;
    height: 250px;
    background-size: cover;
    background-position: center;
}

.project-wrap .price {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: #27ae60;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
}

.project-wrap .text {
    padding: 20px;
}

.project-wrap .text h3 {
    margin: 0;
    font-size: 1.5em;
    color: #2c3e50;
}

.project-wrap .text p {
    color: #7f8c8d;
}

</style>