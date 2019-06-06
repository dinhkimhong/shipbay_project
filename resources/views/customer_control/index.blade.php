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
          <li class="active">
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
                    <h5 class="title">Customer Control</h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>ID</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Full Address</th>
                              <th>Tel</th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 10pt">
                            @foreach($customers as $key=>$customer)
                            <tr data-id="{{ $customer->user_id }}">
                              <td>{{ ++$key }}</td>
                              <td>{{ $customer->id }}</td>
                              <td>{{ $customer->full_name() }}</td>
                              <td>{{ $customer->email }}</td>
                              <td>{{ $customer->address_2() }}</td>
                              <td>{{ $customer->tel }}</td>
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