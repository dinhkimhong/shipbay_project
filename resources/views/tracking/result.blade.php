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
                    <h5 class="title">Result of tracking no. {{ $tracking_code }}</h5>
                  </div>
                  <div class="card-body">
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
                  </div>
         
               </div>

              </div>
            </div>

@endsection