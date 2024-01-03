<!DOCTYPE html>
<html  class="no-js" lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>MCAT Suite</title>
	<link rel="icon" href="assets/img/icon.png" type="image/gif" sizes="16x16">
	<link rel="icon" href="assets/img/icon.png" type="image/gif" sizes="18x18">
	<link rel="icon" href="assets/img/icon.png" type="image/gif" sizes="20x20">

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" href="assets/css/lightcase.css">
	<link rel="stylesheet" href="assets/css/fontawesome.all.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/typed.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/normalize.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
	<!-- Preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
	<!-- Start Header Area -->
	<header class="header">
		<div class="container">
			<div class="row">
				<!-- Logo -->
				<div class="col-lg-3 align-self-center">
					<div class="logo">
                        <img src="assets/img/logo.png" alt="MCAT Suite" />
					</div>
					<div class="canvas_open">
                        <a href="javascript:void(0)">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
				</div>
				<!-- Right -->
				<div class="col-lg-9">
					<!-- Header Right Button -->
					<div class="hr_btn">
						<a class="button-2" href="/register">Get Started</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End Header Area -->
	<!-- Start Mobile Menu Area -->
    <div class="mobile-menu-area">
        <!--offcanvas menu area start-->
        <div class="off_canvars_overlay"></div>
        <div class="offcanvas_menu">
            <div class="offcanvas_menu_wrapper">
                <div class="canvas_close">
                    <a href="javascript:void(0)"><i class="fas fa-times"></i></a>
                </div>
                <div class="mobile-logo">
                    <a href="index.html">
                        <img src="assets/img/logo.png" alt="logo" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--offcanvas menu area end-->
	<!-- Start Hero Section -->
	<section class="hero-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="hero-caption pt-150 pb-200">
						<h2>MCAT Suite</h2>
						<p>{!! $content['home-tagline'] !!}</p>
				</div>
			</div>
		</div>
		<div class="custom-shape-divider-bottom-1638549227">
		    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
		        <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
		    </svg>
		</div>
	</section>
	<!-- End Hero Section -->
	<!-- Header Counter Area -->
	<section class="h_counter_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="row h_counter_section">
                        @for($i = 0; $i < 3; $i++)
							<div class="col-md-4 position-relative">
								<div class="counter_item_h">
									<div class="title">
										<h2 class="counter text-gradient">{{ $content['home-feature-' . ($i+1) . '-number'] }}</h2>
										<h3 class="text-gradient">{!! $content['home-feature-' . ($i+1) . '-symbol'] ?? ' ' !!}</h3>
									</div>
									<h5>{{ $content['home-feature-' . ($i+1) . '-title'] }}</h5>
                                    <p class="text-sm">{{ $content['home-feature-' . ($i+1) . '-summary'] }}</p>
                                    <hr class="vertical dark">
                                </div>
                            </div>
                        @endfor
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Header Counter Area -->
	<!-- Start Video Area -->
	<section class="section-padding-2">
		<div class="container">
			<div class="row">
				<!-- Content -->
				<div class="col-lg-6 align-self-center">
					<div class="analytics-toll-content">
						<h2 class="text-gradient">{{ $content['home-block-1-title'] }}</h2>
						<p class="content">{!! $content['home-block-1-text'] !!}</p>
						<div class="row">
							<!-- Single -->
							<div class="col-sm-6 mb-30">
								<div class="info-box-s2">
									<div class="icon">
										<img src="assets/img/icon/1.png" alt="icon">
									</div>
									<div class="content">
										<h4>{{ $content['home-block-1-section-1-title'] }}</h4>
										<p>{!! $content['home-block-1-section-1-text'] !!}</p>
									</div>
								</div>
							</div>
							<!-- Single -->
							<div class="col-sm-6 mb-30">
								<div class="info-box-s2">
									<div class="icon">
										<img src="assets/img/icon/2.png" alt="icon">
									</div>
									<div class="content">
										<h4>{{ $content['home-block-1-section-2-title'] }}</h4>
                                        <p>{!! $content['home-block-1-section-2-text'] !!}</p>
									</div>
								</div>
							</div>
						</div>
						<a class="button-1" href="/dashboard">Get Started</a>
					</div>
				</div>
				<!-- Image -->
				<div class="col-lg-6">
					<div class="analytics-toll-img">
						<img src="https://img.youtube.com/vi/{{ $content['home-block-1-videoid'] }}/0.jpg" alt="img">
						<div class="video-btn-ab">
							<a data-rel="lightcase" href="https://www.youtube.com/embed/{{ $content['home-block-1-videoid'] }}"><i class="fas fa-play"></i> <span>Watch Video</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Video Area -->
	<!-- Start Features That Area -->
	<section class="pb-70">
		<div class="container">
			<!-- Section Headding -->
			<div class="row mb-40">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-headding">
						<h2>{!! $content['home-block-2-title'] !!}</h2>
						<p>{!! $content['home-block-2-subtitle'] !!}</p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Single -->
				<div class="col-lg-4 col-sm-6 mb-30">
					<div class="info-box-s1">
						<div class="icon">
							<img src="assets/img/icon/cod.png" alt="code">
						</div>
						<div class="content">
							<h4 class="text-gradient">{!! $content['home-block-2-section-1-title'] !!}</h4>
							<p>{!! $content['home-block-2-section-1-text'] !!}</p>
						</div>
					</div>
				</div>
				<!-- Single -->
				<div class="col-lg-4 col-sm-6 mb-30">
					<div class="info-box-s1">
						<div class="icon">
							<img src="assets/img/icon/meas.png" alt="mase">
						</div>
						<div class="content">
							<h4 class="text-gradient">{!! $content['home-block-2-section-2-title'] !!}</h4>
							<p>{!! $content['home-block-2-section-2-text'] !!}</p>
						</div>
					</div>
				</div>
				<!-- Single -->
				<div class="col-lg-4 col-sm-6 mb-30">
					<div class="info-box-s1">
						<div class="icon">
							<img src="assets/img/icon/do.png" alt="doc">
						</div>
						<div class="content">
							<h4 class="text-gradient">{!! $content['home-block-2-section-3-title'] !!}</h4>
							<p>{!! $content['home-block-2-section-3-text'] !!}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Features That Area -->

	<!-- Start Testimonial Area -->
	<section class="section-padding pt-0">
		<div class="container">
			<!-- Section Headding -->
			<div class="row mb-40">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-headding">
						<h2>Our Testimonial</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="testimonial-full owl-carousel">
						<!-- Single -->
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-item">
                                <div class="testimonial-single-header">
                                    <div class="thumbnail">
                                        <img src="{{ $testimonial['photo_url'] }}" alt="testimonial">
                                    </div>
                                    <div class="testimonial-title">
                                        <h4>{{ $testimonial['name'] }}</h4>
                                        <p>{{ $testimonial['title'] }}</p>
                                        <div class="ratting-tes">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-single-footer">
                                    <p>{!! $testimonial['text'] !!}</p>
                                </div>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- End Testimonial Area -->
    <!-- Start Our Story Area -->
    <section class="section-padding pt-0">
        <div class="container">
            <!-- Section Headding -->
            <div class="row mb-40">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-headding">
                        <h2>Our Story</h2>
                    </div>
                    <div>
                        {!! $content['home-our-story'] !!}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Our Story Area -->
	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Bottom -->
		<div class="footer-bottom pt-30 pb-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 align-self-center">
						<div class="copy-f-text">
							<p>Copyright ©2023 <a href="#">Karki's MCAT Suite</a>. All Rights Reserved</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer Area -->
	<div class="scroll-area">
       <i class="bi bi-arrow-up"></i>
    </div>


    <!-- Js File -->
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.nav.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/mixitup.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/lightcase.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/typed.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/mobile-menu.js"></script>
    <script src="assets/js/ajax-form.js"></script>
</body>
</html>
