<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="{{ asset('img/package.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Shipbay.us</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/now-ui-dashboard.css?v=1.3.0') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">
  @yield('css') 

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

/*css-modal*/

.modal-cover {
  position: fixed;
  top: 50px;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 10;
  transform: translateZ(0);
  background-color: rgba(0, 0, 0, 0.8);
  display: none;
}

.modal-area {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 2.5em 1.5em 1.5em 1.5em;
  background-color: #ffffff;
  box-shadow: 0 0 10px 3px rgba(0, 0, 0, 0.1);
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
}

@media screen and (min-width: 500px) {
  /* Center the Modal! */
  .modal-area {
      left: 50%;
      top: 50%;
      height: auto;
      transform: translate(-50%, -50%);
      max-width: 60em;
      max-height: calc(100% - 1em);
    }
}

._modal-close {
  position: absolute;
  top: 0;
  right: 0;
  padding: 0.5em;
  line-height: 1;
  background: #f6f6f7;
  border: 0;
  box-shadow: 0;
  cursor: pointer;
}

._modal-close-icon {
  width: 25px;
  height: 25px;
  fill: transparent;
  stroke: black;
  stroke-linecap: round;
  stroke-width: 2;
}

.modal-body {
  padding-top: 0.25em;
}
._hide-visual {
  border: 0 !important;
  clip: rect(0 0 0 0) !important;
  height: 1px !important;
  margin: -1px !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: absolute !important;
  width: 1px !important;
  white-space: nowrap !important;
}

.scroll-lock {
  overflow: hidden;
  margin-right: 17px;
}

.table > thead > tr > th{
  font-weight: bold;
}

.card label{
  font-size: 1em;
}

.form-control{
  font-size: 1em;
  border-radius: 10px;
}

.table > tfoot > tr > td {
  font-size: 0.9em;
  font-weight: bold;
}

.btn{
  font-size: 1em;
}

.sidebar .nav li > a{
  font-size: 0.9em;
}

div p{
  line-height: 9px;
}

/*css for autocomplete*/
body .ui-autocomplete{
  font-family: 'Tenali Ramakrishna', tahoma, sans-serif;
    color: #333;
    background: #f7f5f0;
    font-size: 15px;
    border-radius: 5px;
    z-index: 999999;
  }
.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active,
a.ui-button:active,
.ui-button:active,
.ui-button.ui-state-active:hover {
  border: none;
  background-color: green;
}
/*======*/

/*side bar*/
.sidebar .nav p, .off-canvas-sidebar .nav p{
  color: white;
  font-size: 1.1em;
}

.sidebar .nav li.active > a, .off-canvas-sidebar .nav li.active > a{
  background-color: #0cb73f;
}
/*======*/
/*btn-primary*/
.btn-primary{
  background-color: #0cb73f;
}

/*===delete arrow in menu dropdown==*/

.custom-menu::before{
  top: 0px;
}
</style>
</head>

<body>

  <div class="wrapper ">
    @yield('sidebar')
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('setting')}}">Account</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        @if($errors->any())
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        @elseif(session('error'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          {{ session('error')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>               
        @endif

        @yield('content')  

      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                We UNDERSTAND. We CARE.
              </li>
            </ul>
          </nav>
        </div>
      </footer>
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
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js') }}" type="text/javascript"></script>  
  <script src="{{ asset('js/jszip.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/vfs_fonts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/buttons.html5.min.js') }}" type="text/javascript"></script>

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