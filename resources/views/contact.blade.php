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
			      	<li class="nav-item"><a class="nav-link" href="{{route('rate')}}">Rate</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('track')}}">Track</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
			      	<li class="nav-item"><a class="nav-link" href="{{route('register')}}">Sign Up</a></li>
			      	<li class="nav-item"><a class="nav-link active" href="{{route('contact_us')}}">Contact</a></li>
	    		</ul>
			</div>
		</nav>


@endsection
@section('content')
	@include('modal.how_it_works')
	<section class="p-3 mb-3" style="border: 1px solid #b6bbc1; background-color: #b6bbc1; border-radius: 10px; width: 100%; margin: 0 auto; margin-top: 90px">
		<!---Alert--->
		@if(session('success'))
		<div class="alert alert-info alert-dismissible fade show" role="alert" style="background-color: #249926">
          {{ session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  
        @endif

		@if(session('error'))
		<div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: #249926">
          {{ session('error')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  
        @endif		
			<form method="POST" action="{{route('emailContactUs')}}">
				@csrf
                  <div class="row">
                                <div class="col-md-6 ">
                                  <div class="form-group">
                                    <label for="name">Your name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                  </div>
                                </div>                        
                          
                                <div class="col-md-3 ">
                                  <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                  </div>
                                </div>
                                <div class="col-md-3 ">
                                  <div class="form-group">
                                    <label for="tel">Phone no. (optional)</label>
                                    <input type="text" class="form-control" id="tel" value="{{ old('tel') }}" name="tel">
                                  </div>
                                </div>
                  </div>	
				  <div class="form-group">
				    <label for="subject">Subject</label>
				    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
				  </div>	                  			  
				  <div class="form-group">
				    <label for="question">Question</label>
				    <textarea class="form-control" id="question" rows="6" name="question" required>{{ old('question') }}</textarea>
				  </div>	
				<div class="row pl-3">
					<div class="g-recaptcha" data-sitekey="6Le7LZ4UAAAAABTbDBwO4Y6JbsRzYeAAgQtZyhWm"></div>
				</div>			  
           		<div class="row pl-3">
           			<button type="submit" class="btn btn-primary"> Send</button>
           		</div>
       	</form>
	</section>
@endsection
@section('script')
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript">
    	$(document).ready(function(){
    		$('#how-it-works-button').on('click', function(){
				$('#how-it-works').modal('show')
			});
    	})
    </script>
@endsection