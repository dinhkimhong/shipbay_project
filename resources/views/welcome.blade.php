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
</style>
</head>

<body>
@guest
<div class="background">
    <div class="form-content">
        <h3>Login</h3>
            <form method="POST" action="{{ route('login') }}">
              @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" required="true" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required="true" />
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('register') }}" class="btn btn-secondary">SignUp</a>
            </form>
    </div>

</div>
@else
  <h5>How it work steps (For retail public customer):</h5>
  <ol>
    <li>Create an account.</li>
    <li>Register your shipment.</li>
    <li>Download and Print Two Label (1-FedEx label, 1-Shipbay label) from Ship Order under My Page.</li>
    <li>Attach Fedex Label to your shipment box, drop nearest Fedex Location, put shipbay label inside of the package.</li>
    <li>Once we receive your package, we will send email with shipping invoice</li>
    <li>Make payment online under My Page.</li>
    <li>Shipment is on it way to your destination</li>
    <li>Track your package after 48 hours.</li>
  </ol>
  <a href="{{route('estimate')}}" class="btn btn-primary">Register shipment</a>
@endguest

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

</body>

</html>