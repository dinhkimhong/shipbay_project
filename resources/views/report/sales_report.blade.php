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
                    <h5 class="title">Sales Report</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Date</th>
                              <th>Shipping no.</th>
                              <th>Registration no.</th>
                              <th>Customer ID</th>
                              <th>Customer Name</th>
                              <th>State</th>
                              <th>Shipping cost</th>                                                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($rows as $key=>$row)
                            <tr>
                              <td>{{ ++$key }}</td>
                              <td>{{ Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                              <td>{{ $row->shipping_id }}</td>
                              <td>{{ $row->estimate_id }}</td>
                              <td>{{ $row->user_id }}</td>
                              <td>{{ $row->first_name }} {{$row->last_name}}</td>
                              <td>{{ $row->state }}</td>                              
                              <td>{{ $row->shipping_cost }}</td>                              
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
    $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]   
    });

  })
</script>  
@endsection