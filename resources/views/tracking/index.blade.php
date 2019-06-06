@extends('layouts.main')
@section('sidebar')
    <div class="sidebar" data-color="black">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          SHIPBAY.US
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ route('estimate') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Register</p>
            </a>
          </li>
          <li>
            <a href="{{ route('order') }}">
              <i class="now-ui-icons education_atom"></i>
              <p>Order History</p>
            </a>
          </li>
          <li  class="active">
            <a href="{{ route('tracking') }}">
              <i class="now-ui-icons location_map-big"></i>
              <p>Tracking</p>
            </a>
          </li>
          <li>
            <a href="{{ route('contact') }}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Address Book</p>
            </a>
          </li>
          <li>
            <a href="{{ route('setting') }}">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>        
        </ul>
      </div>
    </div>

@endsection
@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">Tracking</h5>
                  </div>
                  <div class="card-body">
                    <form>        
                    @csrf
                      <div class="row form-group">
                          <label class="col-md-2">Tracking number: </label>
                          <input type="text" class="form-control col-md-3" id="tracking_code" name="tracking_code" required="true">
                      </div>    
                        <button type="submit" class="btn btn-primary">Track</button>                  
                    </form>                     
                  </div>
         
               </div>
              </div>
            </div>

@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('form').on('submit',function(e){
      e.preventDefault();
      let tracking_code = $.trim($('#tracking_code').val()).replace(/\s/g,'');
      $(location).attr('href',"{{route('tracking')}}" + "/" + tracking_code);
    })
  })
</script>
@endsection