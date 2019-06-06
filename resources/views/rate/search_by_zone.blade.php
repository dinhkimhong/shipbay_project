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
          <li  class="active">
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
          <li>
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
                    <h5 class="title">Updating rate of zone {{ $zone_id}}...</h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th style="width:80px">Weight (lbs)</th>
                              <th style="width:100px">Rate (USD)</th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 10pt">
                            @foreach($rates as $rate)
                            <tr>
                              <td>{{ $rate->weight }}</td>
                              <td class="rate" data-id="{{$rate->rate_id}}" data-field="rate" data-input="input">{{$rate->rate}}</td>
                            </tr>                            
                            @endforeach
                          </tbody>
                        </table>
                     </div>        
                  </div>
         
               </div>

              </div>
            </div>
@endsection
@section('script')
  <script src="{{ asset('js/one_click_edit.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      function success(resp){
        console.log(resp);
      } 

      const option = {url:'{{route('updateRate')}}'};

      $('.rate').oneClickEdit(option, success());
    })

  </script>


@endsection