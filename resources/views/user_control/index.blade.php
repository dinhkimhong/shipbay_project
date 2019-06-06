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
            <a href="{{ route('allCustomers') }}">
              <i class="now-ui-icons objects_globe"></i>
              <p>Customer Control</p>
            </a>
          </li>
          <li class="active">
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
          @include('modal.update_role')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">User Control</h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>User ID</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 10pt">
                            @foreach($users as $key=>$user)
                            <tr data-id="{{$user->user_id}}">
                              <td>{{ ++$key }}</td>
                              <td>{{ $user->user_id}}</td>
                              <td>{{ $user->full_name() }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->roles()->first()->role }}</td>
                              <td><button class="btn btn-sm btn-info update_role">Update Role</button>
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
<script type="text/javascript">
  $(document).ready(function(){

    $(document).mouseup(function (e){
          const modal = $(".modal-cover");
          if (modal.is(e.target) // if the target of the click isn't the container...
              && modal.has(e.target).length === 0) // ... nor a descendant of the container
          {
            modal.hide();
            $('.shipping_id').empty();
            $('.preview').empty();
            
          }
    });
    $('._modal-close').on('click',function(){
        $('.modal-cover').hide();
        $('.preview').empty();
    })  

    $('.update_role').on('click',function(){
      let tr = $(this).parents('tr');
      let user_id = tr.data('id');
      $("#update_role_modal").show();
      let data = {'user_id': user_id};
      $.ajax({
            type: 'POST',
            url: "{{ route('customerInfo') }}",
            datatype: 'json',
            data: data,
            success: function(result){     
              $('.user_id').val(result.user_id);
              $('.name').val(result.first_name + " " +result.last_name);
              $('.email').val(result.email);
           }
      })  

    })

  })



</script>

@endsection