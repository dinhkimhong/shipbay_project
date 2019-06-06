@extends('layouts-mainpage.main')
@section('header')
		<nav class="navbar navbar-expand-lg fixed-top">
	  		<a class="navbar-brand" href="{{route('index')}}"><img src="{{ asset('img/logo.png')}}" height="40" class="d-inline-block align-top" alt=""></a>
	  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #249926">
	    	<span class="navbar-toggler-icon"></span>
	  		</button>

	  		<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
	    		<ul class="navbar-nav float-right">
			      	<li class="nav-item"><a class="nav-link active" href="{{route('index')}}">1-888-525-8882</a></li>
			      	<li class="nav-item"><a class="nav-link" href="#" id="how-it-works-button">How it works</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('rate')}}">Rate</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('track')}}">Track</a></li>
			   
			      	<li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('register')}}">Sign Up</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact</a></li>
	    		</ul>
			</div>
		</nav>
		<!--Jumboton-->

		<div class="jumbotron jumbotron-fluid">
			 <video id="video-background" preload muted autoplay loop>
	            	<source src="http://media.istockphoto.com/videos/logistic-warehouse-full-of-merchandise-video-id531027236" type="video/mp4">
	            	<source src="http://media.istockphoto.com/videos/logistic-warehouse-full-of-merchandise-video-id531027236" type="video/webm">
	                This browser does not support video
	            </video>
			 <div class="row text">
			  	<div class="col-sm-1">

				</div>					
				<div class="col-sm-10">
					<div class="row pl-3">
				  	<h1 id="header_text" style="font-weight: 800; color: white; ">SHIP YOUR PACKAGE WITH <span style="color: #14d64d">SHIPBAY</span></h1>
				  </div>
				  <div class="row pl-3">
				  	<h5 id="header_text_small" style="font-weight: 800; color: white; ">THE BEST WAY TO SHIP PACKAGES TO ASIA</h5>
				  </div>
			
					<form>
					@csrf
						<div class="form-group row p-3" id="form_freight" style="margin: 0 auto">
						  <div class="col-md-2">
						    <!-- <label class="sr-only">Country</label> -->
						      <select class="form-control" style="font-weight: 800" id="shipping_country" name="shipping_country" required="true" >
						      	@foreach($shipping_countries as $country)
						      	<option value="{{$country->country}}" @if($country->country === "China") selected="true"; @endif>{{$country->country}}</option>
						      	@endforeach
						      </select>
						  </div>
						  <div class="col-md-2">
						    <!-- <label class="sr-only">Weight</label> -->
						    <input type="text" class="form-control" id="weight" name="weight" placeholder="weight lbs..." required="true">
						  </div>
						  <div class="col-md-2">
						    <!-- <label class="sr-only">Length</label> -->
						    <input type="text" class="form-control" id="length" name="length" placeholder="length inches..." required="true">
						  </div>
						  <div class="col-md-2">
						    <!-- <label class="sr-only">Width</label> -->
						    <input type="text" class="form-control" id="width" name="width" placeholder="width inches..." required="true">
						  </div>
						  <div class="col-md-2">
						    <!-- <label class="sr-only">Height</label> -->
						    <input type="text" class="form-control" id="height" name="height" placeholder="height inches..." required="true">
						  </div>	
						  						  
						  	<button type="submit" class="btn btn-primary my-auto mx-auto" style="background-color: #f27532; color: white; font-weight: 600" id="get_rate">Find Rate</button>
						</div>
					</form>

				</div>
				<div class="col-sm-1">

				</div>	
			  </div>
		</div>

@endsection
@section('content')

		@include('modal.how_it_works')
		@include('modal.rate_modal')
		@include('modal.alert_rate')
		<section class="row pb-3">
			<div class="col-sm-12">
			
				<p>We're a shipping logistics company that specializes in personal package shipments to Asia.</p>
				<ul id="benefit" style="list-style: none; line-height: 1em">
					<li>- Delivery within <span style="text-decoration: underline;">7-10 days</span> </li><br>
					<li>- All shipments are trackable online </li><br>
					<li>- Shipments are insured up to $100 (Free of Charge)</li><br>
					<li>- Shipments are handles via well recognized shipping brands in Asia </li>
                </ul>
				<p class="pt-3" style="margin-top:20px; border-top: 1px solid grey; text-decoration: underline;">Our rate is all inclusive door to door rate. All include following.</p>
				<ul id="customer_charge" style="list-style: none; line-height: 1em;">
					<li>- Any remote charges</li><br>
					<li>- Custom clearance fee </li><br>
					<li>- UPS Inbound Fee to our warehouse within US</li><br>
					<li>(*) We beat anyone's shipping rate. If you find any cheaper rate, tell us and we will match their price. That's how confident we are on our shipping rate and services. </li>
                </ul> 
			</div>                                    	
			
		</section>
        <section id="video" class="row" style="background-color: grey" >
        	<div class="col-sm-2">
        	</div>

            <div class="col-md-8">
              <!-- Video Code -->
              <!-- "Video For Everybody" v0.4.1 by Kroc Camen of Camen Design <camendesign.com/code/video_for_everybody>
                     =================================================================================================================== -->
                <!-- first try HTML5 playback: if serving as XML, expand `controls` to `controls="controls"` and autoplay likewise       -->
                <!-- warning: playback does not work on iPad/iPhone if you include the poster attribute! fixed in iOS4.0                 -->
                <video width="100%" controls="" preload="none" style="display: block; margin: 0 auto">
                    <!-- MP4 must be first for iPad! -->
                    <source src="{{ asset('media/video.mp4')}}" type="video/mp4"><!-- WebKit video    -->
                    <source src="__VIDEO__.webm" type="video/webm"><!-- Chrome / Newest versions of Firefox and Opera -->
                    <source src="__VIDEO__.OGV" type="video/ogg"><!-- Firefox / Opera -->
                    <!-- fallback to Flash: -->
                    <object width="640" height="384" type="application/x-shockwave-flash" data="__FLASH__.SWF">
                        <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
                        <param name="movie" value="__FLASH__.SWF">
                        <param name="flashvars" value="image=__POSTER__.JPG&amp;file=media/FMLchriskim1975.mp4">
                        <!-- fallback image. note the title field below, put the title of the video there -->
                    </object>
                </video>
                
              <!-- Video Code End -->
              </div>
        	<div class="col-md-2">
        	</div>              
      	</section>
		<section id="introduction" class="row pt-3 pb-3" style="border-bottom: 1px solid grey">		
			<div class="col-sm-6">
				<p> Customers want an affordable but safe way to ship to Asia. Shipbay provides online tracking for every shipment and we can provide customer service in their native language. </p><br>
                <h5 class="homepage-h5 uppercase">Do you have something to ship to Asia?</h5>
                <h1 class="uppercase homepage-h1">Benefits for Customers</h1>
                <p class="homepage-p">- Cheaper than UPS, FedEx and DHL <br>
                                          - All shipments are trackable online<br>
                                          - Shipments are insured up to $100 (Free of Charge)<br>
                                          - Shipments are handles via well recognized shipping brands in Asia</p>        
			</div>
			<div class="col-sm-6">
				<img src="{{ asset('img/Carrier_HP-1.jpg') }}" style="width: 400" class="img-fluid">
			</div>	

		</section>      	


		<section id="introduction_1" class="row pt-3 pb-3" style="border-bottom: 1px solid grey">		
			<div class="col-sm-6">
				<p >  Do you have a retail shipping store and had customers ask for quotes on shipping their personal packages to Asia only to have them walk out the store after seeing the prices? Stop losing customers and add Shipbay to your arsenal of services. Becoming an agent is simple and you can benefit by offering your customers the most affordable and reliable shipping to Asia. </p> <br>
                <h5 class="homepage-h5 uppercase">Do you have a retail shipping store?</h5>
                <h1 class="uppercase homepage-h1">Benefits for Agents</h1>
                <p class="homepage-p">- Offer customers more shipping options <br>
                                          - Drive more traffic to your store <br>
                                          - Reach more customers with specialized services <br>
                                          - Offer best pricing to customers <br>
                                          - All packages are trackable online and we handle customer service issues</p>        
			</div>
			<div class="col-sm-6">
				<img src="{{ asset('img/Shipper_HP-2.jpg')}}" style="width: 400" class="img-fluid">
			</div>	

		</section>	
		<section id="introduction_2" class="row pt-3 pb-3">		
			<div class="col-sm-6">
                <p> DHL, UPS and FedEx are great US based companies but they are not as well known in Asia. We work with some of the best shipping logistics companies in Asia that have the know how required to correctly and quickly deliver packages. Shipbay handles customs clearance issues on the front end and direct contact with agents and customers to ensure packages are handled with care. </p> <br>
                <h5 class="homepage-h5 uppercase">Comparisons</h5>
                <h1 class="uppercase homepage-h1">SHIPBAY <small>vs</small> The Big 4</h1>
                <p class="homepage-p">- Cheaper than DHL, FedEx, and UPS <br>
                                          - Faster than USPS <br>
                                          - Shipping brands are recognized by Asian customers <br>
                                          - Customer service in their native language </p>     
			</div>
			<div class="col-sm-6">
				<img src="{{ asset('img/Business_HP-1.jpg')}}" style="width: 400" class="img-fluid">
			</div>	
		</section>

@endsection
@section('script')

   	<script type="text/javascript">
	    	
    	$(document).ready(function(){


    		$('#how-it-works-button').on('click', function(){
				$('#how-it-works').modal('show')
			});

			$('#get_rate').on('click',function(e){
				e.preventDefault();
				findRate();
			})

			function findRate(){
		          let shipping_country = $('#shipping_country').val();
			   		let length = $('#length').val();
			        let width = $('#width').val();
			        let height = $('#height').val();
			        let weight = $('#weight').val();
			        if(length !== "" && width !== "" && height !== "" && weight!== ""){         
		          		let data = {'shipping_country': shipping_country, 'length': length, 'width': width, 'height': height,'weight': weight};
			          $.ajax({
			            type: 'POST',
			            url: "{{ route('findRate') }}",
			            datatype: 'json',
			            data: data,
			            success: function(result){
			              $('#shipping_cost').empty().val(result.rate);
			            }
			          })
			          $('#find_rate').modal('show');
				    }else{
				    	$('#alert_rate').modal('show');
				  	}
		    }



		    //===============number and dot=============
		    function number(input){
		        $(input).keypress(function(evt){
		            var theEvent = evt || window.event;
		            var key = theEvent.keyCode || theEvent.which;
		            key = String.fromCharCode(key);
		            var regex = /[-\d\.]/;
		            var objRegex= /^-?\d*[\.]?\d*$/;
		            var val = $(evt.target).val();
		            if(!regex.test(key) || !objRegex.test(val+key)|| !theEvent.keyCode ==46 || !theEvent.keyCode == 8){
		                theEvent.returnValue = false;
		                if(theEvent.preventDefault) theEvent.preventDefault();
		            };
		        })
		    }

		    number('#length');
		    number('#weight');
		    number('#width');
		    number('#height');
    	})


    </script>
 @endsection
