
<!DOCTYPE html>
<html lang="en">


<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content=" Medical Academy " />
	
	<!-- OG -->
	<meta property="og:title" content=" Medical Academy " />
	<meta property="og:description" content=" Medical Academy " />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="{{ asset('assets/home/images/favicon.ico') }}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/home/images/favicon.png') }}" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title> Medical Academy </title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/home/css/assets.css') }}">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/home/css/typography.css') }}">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/home/css/shortcodes/shortcodes.css') }}">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/home/css/style.css') }}">
	<link class="skin" rel="stylesheet" type="text/css" href="{{ asset('assets/home/css/color/color-1.css') }}">
	
</head>
<body id="bg">
<input type="hidden" name="url" value="Made by Eng.George Ayman & Eng.Zakaria Hamdan">
<div class="page-wraper">
    @yield('content')
</div>
<!-- External JavaScripts -->
<script src="{{ asset('assets/home/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/home/vendors/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/home/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/home/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/home/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('assets/home/vendors/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/home/vendors/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('assets/home/vendors/counter/counterup.min.js') }}"></script>
<script src="{{ asset('assets/home/vendors/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('assets/home/vendors/masonry/masonry.js') }}"></script>
<script src="{{ asset('assets/home/vendors/masonry/filter.js') }}"></script>
<script src="{{ asset('assets/home/vendors/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/home/js/functions.js') }}"></script>
<script src="{{ asset('assets/home/js/contact.js') }}"></script>
</body>

</html>
