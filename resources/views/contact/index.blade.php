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
                    <form method="POST" action="{{ route('createContact') }}">
                      @csrf
                              <div class="row">
                                <div class="col-md-6 pr-1">
                                  <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" name="contact" required>
                                  </div>
                                </div>                        
                          
                                <div class="col-md-6 pl-1">
                                  <div class="form-group">
                                    <label>Company name</label>
                                    <input type="text" class="form-control" name="company" >
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-3 pr-1">
                                  <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city">
                                  </div>
                                </div>
                                <div class="col-md-3 px-1">
                                  <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" class="form-control" name="province">
                                  </div>
                                </div>                        
                                <div class="col-md-2 px-1">
                                  <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="shipping_country_id" required>
                                      <option value=""></option>
                                      @foreach($shipping_countries as $country)
                                      <option value="{{$country->shipping_country_id}}">{{$country->country}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 px-1">
                                  <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" >
                                  </div>
                                </div>
                                <div class="col-md-2 pl-1">
                                  <div class="form-group">
                                    <label>Telephone no.</label>
                                    <input type="text" class="form-control" name="tel">
                                  </div>
                                </div>                        
                              </div>
                              <button class="btn btn-primary">Create</button>
                             
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
                            @foreach($contacts as $contact)
                            <tr>
                              <td>{{ $contact->contact }}</td>
                              <td>{{ $contact->company }}</td>
                              <td>{{ $contact->address}}, {{$contact->city}}, {{$contact->province}}, {{$contact->country}}</td>
                              <td data-id="{{$contact->contact_id}}">
                                <a class="btn btn-sm btn-info" href="{{route('showContact',$contact->contact_id)}}">Edit</a>
                                <button class="btn btn-sm btn-danger remove_contact">Delete</button>
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