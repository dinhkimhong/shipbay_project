<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="{{ asset('img/letter.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Shipbay.us</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/now-ui-dashboard.css') }}" rel="stylesheet" />

 <style type="text/css">
body, html {
  height: 100%;
  margin: 0;
}

    .navbar{
      background-color: #2e363a;
      min-height: 40px;
      line-height: 40px;
    }
      .navbar .navbar-nav .nav-item a{
        color: white;
        font-weight: 520;
        font-size: 15px;
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



.background {
    background-image: url("img/highway.jpg");
  height: 100%;
  position: relative;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}


.form-content {
    position: absolute; 
    padding: 20px;    
    top: 5%; 
    left: 25%; 
    width: 50%; 
    background-color: white; 
}
.form-content h3{
    text-align: center
}

@media screen and (max-width: 600px) {
    .form-content {
        width: 95%; 
        left: 2.5%;
        right: 2.5%;
    }
    .background{
      background-image: none;
    }
    body{
      background-color: grey;
    }
}

.form-control{
  border-radius: 10px;
  font-size: 1em;
}

.btn {
  font-size: 1em;
}

.btn-primary{
  background-color: #0cb73f;
}

</style>
</head>

<body>
  <header>
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
              <li class="nav-item"><a class="nav-link active" href="{{route('register')}}">Sign Up</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact</a></li>
          </ul>
      </div>
    </nav>
  </header>
<div class="background">
    @include('modal.how_it_works')
    <div class="form-content" style="border-radius: 10px; margin-top: 60px;">
        <h3>Sign up</h3>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="first_name">First Name (*)</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>
                <div class="col-md-6">
                  <label for="last_name">Last Name (*)</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email address (*)</label>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="password">Password (*)</label>
                  <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                  
                </div>
                <div class="col-md-6">
                   <label for="confirm_password">Confirm Password (*)</label>
                   <input type="password" name="password_confirmation" class="form-control" id="confirm_password" required>
                </div>
              </div>
              <div class="form-group">
                <label for="address">Address (*)</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" required>
              </div> 
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                </div>
                <div class="col-md-3">
                  <label for="state">State (*)</label>
                  <select class="form-control" name="state_id" required>
                    <option value=""></option>
                    @foreach($states as $state)
                    <option value="{{$state->state_id}}" @if(old('state_id') == $state->state_id) selected="true" @endif>{{$state->state}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="postal_code">Postal Code (*)</label>
                  <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required="true">
                </div>
                <div class="col-md-3">
                  <label for="country">Country</label>
                  <select class="form-control" id="country" name="country_id" required>
                    @foreach($countries as $country)
                    <option value="{{$country->country_id}}">{{$country->country}}</option>
                    @endforeach
                  </select>
                </div>   
              </div>
              <button type="submit" class="btn btn-primary">Sign Up</button>
              <p>(*) If you already had an account, <span> <a href="{{ route('login')}}">click here</a></span> to log in.</p>
            </form>
    </div>

</div>


  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/now-ui-dashboard.min.js?v=1.3.0') }}" type="text/javascript"></script>
  <script type="text/javascript">
      $('#how-it-works-button').on('click', function(){
        $('#how-it-works').modal('show')
      });
  </script>
</body>

</html>