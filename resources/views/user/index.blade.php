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
    @if(Auth()->user()->hasRole('User'))
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
          <li>
            <a href="{{ route('contact') }}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Address Book</p>
            </a>
          </li>
      @else
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
          <li>
            <a href="{{ route('report')}}">
              <i class="now-ui-icons education_paper"></i>
              <p>Report</p>
            </a>
          </li>      

      @endif    
          <li   class="active">
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
			@include('modal.password')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">User Profile</h5>
                  </div>
                  <div class="card-body">
		                <form method="POST" action="{{ route('updateUser')}}">
		                	@csrf
		                  <div class="row">
		                    <div class="col-md-5">
		                      <div class="form-group">
		                        <label>Company name</label>
		                        <input type="text" class="form-control" name="company" value="{{ Auth::user()->company }}">
		                      </div>
		                    </div>
		                  </div>
		                  <div class="row">
		                    <div class="col-md-4">
		                      <div class="form-group">
		                        <label for="email">Email address</label>
		                        <input type="email" class="form-control" name="email" readOnly value="{{ Auth::user()->email }}">
		                      </div>
		                    </div>
		                    <div class="col-md-4">
		                      <div class="form-group">
		                        <label for="password">Password</label><br>
		                        <a class="btn btn-sm btn-primary" id="change_password">Change Password</a>
		                      </div>
		                    </div>
		                  </div>
		                  <div class="row">
		                    <div class="col-md-4">
		                      <div class="form-group">
		                        <label>Title</label>
								<select class="form-control" name="title_id">
									<option value=""></option>
									@foreach($titles as $title)
									<option value="{{$title->title_id}}" @if(Auth::user()->title_id == $title->title_id) selected="true" @endif>{{$title->title}} </option>
									@endforeach
								</select>		                        
		                      </div>
		                    </div>
		                    <div class="col-md-4 ">
		                      <div class="form-group">
		                        <label>First Name</label>
		                        <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}">
		                      </div>
		                    </div>
		                    <div class="col-md-4">
		                      <div class="form-group">
		                        <label>Last Name</label>
		                        <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}">
		                      </div>
		                    </div>
		                  </div>
		                  <div class="row">
		                    <div class="col-md-12">
		                      <div class="form-group">
		                        <label>Address</label>
		                        <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
		                      </div>
		                    </div>
		                  </div>
		                  <div class="row">
		                    <div class="col-md-3">
		                      <div class="form-group">
		                        <label>City</label>
		                        <input type="text" class="form-control" name="city" value="{{ Auth::user()->city }}" >
		                      </div>
		                    </div>
		                    <div class="col-md-3">
		                      <div class="form-group">
		                        <label>State/ Province</label>
		                        <select class="form-control" name="state_id">
		                        	<option value=""></option>
		                        	@foreach($states as $state)
		                        	<option value="{{$state->state_id}}" @if(Auth::user()->state_id == $state->state_id) selected="true" @endif>{{$state->state}}</option>
		                        	@endforeach
		                        </select>
		                      </div>
		                    </div>		                    
		                    <div class="col-md-2">
		                      <div class="form-group">
		                        <label>Country</label>
		                        <select class="form-control" name="country_id">
		                        	<option value=""></option>
		                        	@foreach($countries as $country)
		                        	<option value="{{$country->country_id}}" @if(Auth::user()->country_id == $country->country_id) selected="true" @endif>{{$country->country}}</option>
		                        	@endforeach
		                        </select>
		                      </div>
		                    </div>
		                    <div class="col-md-2">
		                      <div class="form-group">
		                        <label>Postal Code</label>
		                        <input type="text" class="form-control" name="postal_code" value="{{ Auth::user()->postal_code }}">
		                      </div>
		                    </div>
		                    <div class="col-md-2">
		                      <div class="form-group">
		                        <label>Telephone no.</label>
		                        <input type="text" class="form-control" name="tel" value="{{ Auth::user()->tel }}">
		                      </div>
		                    </div>		                    
		                  </div>
		                  <button class="btn btn-primary">Save</button>
		                  
		                </form>                  	
                  </div>
         
               </div>

              </div>
            </div>
@endsection
@section('script')
<script type="text/javascript">
	
        $('#change_password').on('click',function(){
          $('#password_modal').show();
       })

	    $('._modal-close').on('click',function(){
          $('.modal-cover').hide();    
        })     

        $(document).mouseup(function (e){
          const modal = $(".modal-cover");

          if (modal.is(e.target) // if the target of the click isn't the container...
              && modal.has(e.target).length === 0) // ... nor a descendant of the container
          {
            modal.hide();             
          }
        });

</script>
@endsection