<?php
$title = 'Natural WonderLust - Travel & Tour';
include 'header.php';
include 'db.php';

$query = $conn->query("SELECT * FROM destinations");
$destinations = $query->fetch_all(MYSQLI_ASSOC);
?>
	<!-- HERO -->
	<div class="hero-wrap js-fullheight" style="background-image: url('images/bg-img-4.png');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<span class="subheading">Welcome to Natural WanderLust</span>
					<h1 class="mb-4">Discover Your Favorite Place with Us</h1>
					<p class="caps">Travel to the any corner of the world, without going around in circles</p>
				</div>
				<a href="https://www.youtube.com/watch?v=EVG-IH8cMYs" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
					<span class="fa fa-play"></span>
				</a>
			</div>
		</div>
	</div>

	<!-- SEARCH TAB -->
	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ftco-search d-flex justify-content-center">
						<div class="row">
							<div class="col-md-12 nav-link-wrap">
								<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Search Tour</a>

									<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Hotel</a>

								</div>
							</div>
							<div class="col-md-12 tab-wrap">
								
								<div class="tab-content" id="v-pills-tabContent">
								<!-- TOUR TAB -->
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
								<?php
								include 'search-tour.php';
								?>
								</div>
								<!-- HOTEL TAB -->
								<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
								<?php
								include 'search-hotel.php';
								?>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	
	<!-- TOURS -->
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Destination</span>
						<h2 class="mb-4">Tour Destination</h2> 
						<!-- pull 6 data from databse, select related column from tour table -->
					</div>
				</div>
				<section id="section-page1" class="ftco-section">
				<div class="container">
    <div class="row">
      <?php foreach ($destinations as $destination): ?>
        <div class="col-md-4 ftco-animate">
          <div class="project-wrap">
          <a href="destination-details.php?id=<?php echo $destination['id']; ?>" class="img" style="background-image: url('<?php echo $destination['image']; ?>');">
          <span class="price">Best Price</span>
            </a>
            <div class="text p-4">
              <span class="days">Come Join Us</span>
              <h3><a href="destination-details.php?id=<?php echo $destination['id']; ?>"><?php echo $destination['name']; ?></a></h3>
              <p class="location"><span class="fa fa-map-marker"></span> <?php echo $destination['location']; ?></p>
              <ul>
                <li><span class="flaticon-shower"></span>2</li>
                <li><span class="flaticon-king-size"></span>3</li>
                <li><span class="flaticon-mountains"></span>Near Mountain</li>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
			</div>
		</section>
	<!-- VIDEO - ABOUT -->
		<section class="ftco-section ftco-about img"style="background-image: url(images/bg_4.jpg);">
			<div class="overlay"></div>
			<div class="container py-md-5">
				<div class="row py-md-5">
					<div class="col-md d-flex align-items-center justify-content-center">
						<a href="https://www.youtube.com/watch?v=sKDQFvw-wrM" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
							<span class="fa fa-play"></span>
						</a>
					</div>
				</div>
			</div>	
		</section>
	<!-- ABOUT -->
		<section class="ftco-section ftco-about ftco-no-pt img">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-12 about-intro">
						<div class="row">
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url(images/about-1.jpg);">
								</div>
							</div>
							<div class="col-md-6 pl-md-5 py-5">
								<div class="row justify-content-start pb-3">
									<div class="col-md-12 heading-section ftco-animate">
										<span class="subheading">About Us</span>
										<h2 class="mb-4">Make Your Tour Memorable and Safe With Us</h2>
										<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
										<p><a href="about.php" class="btn btn-primary">Know More</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- BANNER -->
		<section class="ftco-intro ftco-section ftco-no-pt">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12 text-center">
						<div class="img"  style="background-image: url(images/bg_2.jpg);">
							<div class="overlay"></div>
							<h2>We Are WanderLust A Travel Enthusiast</h2>
							<p>We can manage your dream building A small river named Duden flows by their place</p>
							<p class="mb-0"><a href="contact.php" class="btn btn-primary px-4 py-3">Contact Us</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>

<?php
include 'footer.php';
?>