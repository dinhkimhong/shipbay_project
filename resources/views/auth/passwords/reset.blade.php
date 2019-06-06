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
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

  }
  .background {
    background-image: url("../../img/highway.jpg");
    height: 100%;
  }

  .form-content {
      position: absolute; 
      padding: 20px;    
      top: 20%; 
      left: 30%; 
      width: 40%; 
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
  }

  .form-control{
    border-radius: 10px;
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
  @include('modal.how_it_works')
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
              <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Sign Up</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact</a></li>
          </ul>
      </div>
    </nav>
  </header>
<div class="background">
    <div class="form-content" style="border-radius: 10px">
        <h3>Reset password</h3>
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                     @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                     @endif
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                 
                </div>                                
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
    </div>

</div>


  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
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