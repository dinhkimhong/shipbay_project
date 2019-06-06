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
              <p>Estimate</p>
            </a>
          </li>
          <li>
            <a href="{{ route('order') }}">
              <i class="now-ui-icons education_atom"></i>
              <p>Order</p>
            </a>
          </li>
          <li>
            <a href="{{ route('tracking') }}">
              <i class="now-ui-icons location_map-big"></i>
              <p>Tracking</p>
            </a>
          </li>
          <li class="active">
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
                    <h5 class="title">Address Book</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('updateContact')}}">
                      @csrf
                              <input type="text" name="contact_id" value="{{$contact->contact_id}}" hidden>
                              <div class="row">
                                <div class="col-md-6 pr-1">
                                  <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" name="contact" required value="{{$contact->contact}}">
                                  </div>
                                </div>                        
                          
                                <div class="col-md-6 pl-1">
                                  <div class="form-group">
                                    <label>Company name</label>
                                    <input type="text" class="form-control" name="company" value="{{$contact->company}}" >
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" required value="{{$contact->address}}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-3 pr-1">
                                  <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" value="{{$contact->city}}">
                                  </div>
                                </div>
                                <div class="col-md-3 px-1">
                                  <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" class="form-control" name="province" value="{{$contact->province}}">
                                  </div>
                                </div>                        
                                <div class="col-md-2 px-1">
                                  <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="shipping_country_id" required>
                                      <option value=""></option>
                                      @foreach($shipping_countries as $country)
                                      <option value="{{$country->shipping_country_id}}" @if($contact->shipping_country_id == $country->shipping_country_id) selected="true" @endif>{{$country->country}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 px-1">
                                  <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" value="{{$contact->postal_code}}">
                                  </div>
                                </div>
                                <div class="col-md-2 pl-1">
                                  <div class="form-group">
                                    <label>Telephone no.</label>
                                    <input type="text" class="form-control" name="tel" value="{{$contact->tel}}">
                                  </div>
                                </div>                        
                              </div>
                              <button class="btn btn-primary">Update</button>
                             
                        </form>
                  </div>
         
               </div>
      <div class="row">
          <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Contact</th>
                              <th>Company name</th>
                              <th>Full Address</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                            @foreach($contacts as $cont)
                            <tr>
                              <td>{{ $cont->contact }}</td>
                              <td>{{ $cont->company }}</td>
                              <td>{{ $cont->address}}, {{$cont->city}}, {{$cont->province}}, {{$cont->country}}</td>
                              <td>
                                @if($contact->contact_id == $cont->contact_id)
                                Updating...
                                @else
                                <a class="btn btn-sm btn-info" href="{{route('showContact',$cont->contact_id)}}">Edit</a>
                                <button class="btn btn-sm btn-danger remove_contact">Delete</button> 
                                @endif
                              </td>
                            </tr>
                            @endforeach
                          <tbody>
                            
                          </tbody>
                        </table>
                     </div>
                  </div>
                </div>
             </div>
        </div>
      </div>
    </div>

@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('.remove_contact').on('click',function(){
            var td = $(this).parents("td");
            var contact_id = td.data("id");
            $.post("{{ route('deleteContact')}}", {contact_id: contact_id},function(data){
              if(data.success){
                $(location).attr('href',"{{route('contact')}}");
                alert(data.success);
              }
            })      
      })
    })

  </script>

@endsection