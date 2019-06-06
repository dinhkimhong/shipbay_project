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
			      	<li class="nav-item"><a class="nav-link" href="#" id="how-it-works-button">How it works</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('rate')}}">Rate</a></li>
			      	<li class="nav-item"><a class="nav-link active" href="{{route('track')}}">Track</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('register')}}">Sign Up</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact</a></li>
	    		</ul>
			</div>
		</nav>
		<!--Jumboton-->

@endsection
@section('content')
		@include('modal.how_it_works')
		<div id="tracking">
			<section class="p-3 mb-3" style="border: 1px solid #b6bbc1; background-color: #b6bbc1; border-radius: 10px; width: 100%; margin: 0 auto; margin-top: 90px">

				@if(session('error'))
				<div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: #249926">
		          {{ session('error')}}
		          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>  
		        @endif		
					<form>
						@csrf
		                  <div class="row">
		                        <label class="col-md-2" for="tracking_code">Tracking number:</label>
		                        <input type="text" class="form-control col-md-4" id="tracking_code" name="tracking_code" required>                     
		                  </div>	
		           			<button type="submit" class="btn btn-primary">Track</button>
		       	</form>
			</section>
			<section>
				<div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Status</th>
                              <th>Location</th>

                            </tr>
                          </thead>
                          <tbody>
                            @foreach($tracking_details as $detail)
                            <tr>
                              <td>{{ Carbon\Carbon::parse($detail->datetime)->format('Y-m-d')}}</td>
                              <td>{{ Carbon\Carbon::parse($detail->datetime)->format('H:i:s')}}</td>                         
                              <td>{{ $detail->message}}</td>
                              <td>@if (!empty($detail->tracking_location->city)) 
                                  {{$detail->tracking_location->city . ', '}} 
                                  @endif
                                  @if (!empty($detail->tracking_location->state)) 
                                  {{$detail->tracking_location->state . ', '}} 
                                  @endif
                                  @if (!empty($detail->tracking_location->country)) 
                                  {{$detail->tracking_location->country . ', '}}
                                  @endif
                                  @if (!empty($detail->tracking_location->zip)) 
                                  {{$detail->tracking_location->zip}} 
                                  @endif
                            </td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>
                     </div> 
			</section>

		</div>
@endsection
@section('script')

   	<script type="text/javascript">
    	$(document).ready(function(){

    		$('#how-it-works-button').on('click', function(){
				$('#how-it-works').modal('show')
			});
		    $('form').on('submit',function(e){
		      e.preventDefault();
		      let tracking_code = $.trim($('#tracking_code').val()).replace(/\s/g,'');
		      $(location).attr('href',"{{route('track')}}" + "/" + tracking_code);
		    })	
		});	   	    	

    </script>
 @endsection
