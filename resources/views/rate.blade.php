@extends('layouts-mainpage.main')
@section('header')
		<nav class="navbar navbar-expand-lg fixed-top">
	  		<a class="navbar-brand" href="{{route('index')}}"><img src="{{ asset('img/logo.png')}}" height="40" class="d-inline-block align-top" alt=""></a>
	  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #249926">
	    	<span class="navbar-toggler-icon"></span>
	  		</button>

	  		<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
	    		<ul class="navbar-nav float-right">
			      	<li class="nav-item"><a class="nav-link" href="{{route('index')}}">1-888-525-8882</a></li>
			      	<li class="nav-item"><a class="nav-link" href="#" id="how-it-works-button">How it works</a></li></li>
			      	<li class="nav-item"><a class="nav-link active" href="{{route('rate')}}">Rate</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('track')}}">Track</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('register')}}">Sign Up</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact</a></li>
	    		</ul>
			</div>
		</nav>
@endsection
@section('content')
		@include('modal.how_it_works')
		<section>
			<div>
				<img src="{{ asset('img/logo-dark.png')}}" height="70" alt="shipbay" style="float: center">	
				<p class="pt-3" style="margin-top:20px; text-decoration: underline;">Our rate is all inclusive door to door rate. All include following.</p>
				<ul id="customer_charge" style="list-style: none; line-height: 1em;">
					<li>- Any remote charges</li><br>
					<li>- Custom clearance fee </li><br>
					<li>- UPS Inbound Fee to our warehouse within US</li><br>
					<li>(*) We beat anyone's shipping rate. If you find any cheaper rate, tell us and we will match their price. That's how confident we are on our shipping rate and services. </li>
                </ul>                                    	
			</div>
		</section>
		<section class="p-3" style="border: 1px solid #b6bbc1; background-color: #b6bbc1; border-radius: 10px">
			<form >
				<div class="row" >
				                <div class="col-md-2 ">
                                    <div class="form-group">
                                      <label>Shipping Country</label>
								      <select class="form-control" id="shipping_country" name="shipping_country" required="true" style="font-weight: 600">
								      	@foreach($shipping_countries as $country)
								      	<option value="{{$country->country}}" @if($country->country === "China") selected="true"; @endif>{{$country->country}}</option>
								      	@endforeach
								      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-2 ">
                                    <div class="form-group">
                                      <label>Weight (lbs)</label>
                                      <input type="text" class="form-control" id="weight" >
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Length (inches)</label>
                                      <input type="text" class="form-control" id="length" >
                                    </div>
                                  </div>                        
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Width (inches)</label>
                                      <input type="text" class="form-control" id="width" >
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Height (inches)</label>
                                      <input type="text" class="form-control" id="height" >
                                    </div>
                                  </div>                                  
                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label>Shipping Cost (USD)</label>
                                      <input type="text" class="form-control" id="shipping_cost" readonly>
                                    </div>
                                  </div>  

           		</div> 
           		<div class="row pl-3">
           			<a class="btn btn-primary" href="{{route('login')}}">Register package</a>
           		</div>
       		</form>
		</section>

		<section class="pt-3" >
		<img src="{{ asset('img/shipbay-rate.jpg')}}" style="display: block; margin-left: auto; margin-right: auto; width: 75%;">
		</section>
@endsection
@section('script')
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('#how-it-works-button').on('click', function(){
				$('#how-it-works').modal('show')
			});
	        $('form').delegate('#length, #width, #height,#shipping_country,#weight','change keyup',function(){
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
		              $('#shipping_cost').val(result.rate);
		            }
		          })
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