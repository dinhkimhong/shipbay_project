<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shipbay.us</title>
    <!-- Bootstrap CSS -->
	<link rel="icon" href="img/logo-dark.png">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/now-ui-dashboard.css') }}" rel="stylesheet" />

    <style type="text/css">
		*{
		  margin: 0;
		  padding: 0;
		}
		body{
		  font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
			font-size: 15px;
		}

		.background {
		  position: relative;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;

		}
		.background {
		  background-image: url("img/highway.jpg");
		  height: 100%;
		}

		.navbar{
		  background-color: #2e363a;
		  min-height: 40px;
		  line-height: 40px;
		}
/*    	.jumbotron{
    		background-image: url("img/warehouse_1.jpg");
			background-size: cover;
			

    	}*/
    	@media(max-width: 400px){
    		/*.jumbotron{*/
    			/*background: #2e363a;*/
    			/*display: none;*/
    		/*}*/
    		#header_text{
    			display: none
    		}
    		#form_freight{
    			background-color: transparent;
    		}
    		.text{
			  position: relative;
			  z-index: 2;
			  padding-top: 0px;
    		}

    	}


		.jumbotron{
		  	position: relative;
		    overflow: hidden;
		    height: 600px;
		    margin-top: 70px;
		}
		.text {
		  position: relative;
		  z-index: 2;
		  padding-top: 120px;
		}

		#video-background{ 
		  position: absolute;
		  height: auto;
		  width: auto;
		  min-height: 100%;
		  min-width: 100%;
		  left: 50%;
		  top: 50%;
		  -webkit-transform: translate3d(-50%, -50%, 0);
		  transform: translate3d(-50%, -50%, 0);
		  z-index: 1;
		  filter: brightness(60%);
			-webkit-filter: brightness(60%);
			-moz-filter: brightness(60%);
			-o-filter: brightness(60%);
			-ms-filter: brightness(60%);
		}

		#form_freight{
			background-color: rgba(0, 0, 0, 0.6);
		}
		.navbar .navbar-nav .nav-item a{
			color: white;
			font-weight: 520;
			font-size: 15px
		}

		.navbar .navbar-nav .nav-item a:hover{
		    text-decoration: underline;
		}    	

		.navbar .navbar-nav .nav-item {
		    padding-left: 10px;
		}

		.navbar .navbar-nav .nav-item .active{
		    color: #14d64d;
		    font-weight: bold;
		    text-decoration: underline;
		}

		#title{
			font-weight: bold;
			font-size: 34pt;
			color: white;
		}

		.country_slider { padding-bottom: 3em; }
		.country_slider .slide h4 { color:rgba(255,255,255,0.4); text-transform: uppercase; font-weight: 300; text-align:center; line-height:1.6em;}	

		.card .card-body{
			background-color: #304C63;
			color: white;
		}	

		#feedback .card-body{
			font-size: 0.85em;
		}

		.form-control{
			border-radius: 5px;
			background-color: white;
			font-size: 1em;
		}


		#shipping_cost{
			font-weight: bold;
			color: green
		}

		.btn{
			background-color: #0cb73f;
			border-color: #0cb73f;
			font-size: 1em;
			font-weight: 500;
		}

		.btn-primary:hover{
			background-color: #0cb73f;
			border-color: #0cb73f;
		}		


		.homepage-h1{
			font-size: 2.5em;
		}

		.homepage-h5{
			font-size: 1.2em;
			text-decoration: underline;
		}
		footer{
			font-size: 0.9em;
			line-height: 7px;
			border-top: 1px solid grey
		}		
		#footer{
			margin: 15px; 
			padding-top: 35px; 
			color: black; 
			padding-bottom: 35px
		}

		#tracking{
			min-height: 450px;
		}

		#tracking_result{
			font-size: 14px;
		}

    </style>
</head>
<body>
	<header>
		@yield('header')

	</header>
	<div class="container">
		@yield('content')	
	</div>

	<footer>
		<div class="row" id="footer">
			<div class="col-sm-2">
				<p style="text-decoration: underline;">Contact us</p>
				<p>Phone: 1-888-525-8882</p>
				<p>Email: info@hanmipost.com</p>
			</div>
			<div class="col-sm-2">
				<p>VA Processing Center</p>
				<p>SHIPBAY (HANMIPOST) </p>
				<p>14101 SULLYFIELD CIRCLE</p>
				<p>SUITE 340-SB</p>
				<p>CHANTILLY, VA 20151</p>

			</div>
			<div class="col-sm-2">
				<p>CA Processing Center</p>
				<p>SHIPBAY (FOREX CARGO)</p>
				<p>811 EAST G STREET</p>
				<p>SUITE # F</p>
				<p>WILMINGTON, CA 90744</p>		

			</div>
			<div class="col-sm-6">
				<p>Our partners:</p>
				<img src="{{ asset('img/Hanmipost.png')}}" align="Hanmipost" height="60">
				<img src="{{ asset('img/SF-Express.png')}}" align="Hanmipost" height="60">
				<img src="{{ asset('img/tia.png')}}" align="Hanmipost" height="60">
				<img src="{{ asset('img/who-4.png')}}" align="Hanmipost" height="60">

			</div>						

		</div>
	</footer>

	<script src="{{ asset('js/core/jquery.min.js') }}"></script>
	<script src="{{ asset('js/core/popper.min.js') }}"></script>
	<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
   	<script type="text/javascript">
	    $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
    </script>

	@yield('script')

</body>
</html>