@extends('layouts.main')
@section('sidebar')
    <div class="sidebar" data-color="black">
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          SHIPBAY.US
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ route('allCustomers') }}">
              <i class="now-ui-icons objects_globe"></i>
              <p>Customer Control</p>
            </a>
          </li>
          <li>
            <a href="{{ route('allUsers') }}">
              <i class="now-ui-icons users_circle-08"></i>
              <p>User Control</p>
            </a>
          </li>
          <li>
            <a href="{{ route('controlRate') }}">
              <i class="now-ui-icons business_money-coins"></i>
              <p>Rate Control</p>
            </a>
          </li>          
          <li>
            <a href="{{ route('shipping')}}">
              <i class="now-ui-icons shopping_delivery-fast"></i>
              <p>Shipping Registration</p>
            </a>
          </li>
          <li>
            <a href="{{ route('listShipping')}}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Shipping List</p>
            </a>
          </li>          
          <li class="active">
            <a href="{{ route('report')}}">
              <i class="now-ui-icons education_paper"></i>
              <p>Report</p>
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
                    <h5 class="title">Shipping Detail Report</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('shippingDetailInfo') }}">        
                    @csrf     
                      <div class="form-group row">
                          <label for="paid" class="col-form-label col-md-2">Shipped:</label>
                          <select class="form-control col-md-2" name="shipped">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                      </div>                                  
                      <div class="form-group row">
                          <label for="start_date" class="col-form-label col-md-2">Start date:</label>
                          <input type="text" name="start_date" id="start_date" class="form-control col-md-2" placeholder="yyyy-mm-dd" required="true">
                          <label for="end_date" class="col-form-label col-md-2">End date:</label>
                          <input type="text" name="end_date" id="end_date" class="form-control col-md-2" placeholder="yyyy-mm-dd" required="true">
                      </div>     
                      <button class="btn btn-primary" id="search">Search</button>                            
                    </form> 
                  </div>        
               </div>

              </div>
            </div>

@endsection
@section('script')
  <script type="text/javascript">
    $('#start_date, #end_date').datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat: "yy-mm-dd",
    })

  </script>

@endsection