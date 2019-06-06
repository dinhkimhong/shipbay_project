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
          <li class="active">
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
                    <h5 class="title">Registration no. {{$estimate_id}}</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('saveShipping')}}" enctype="multipart/form-data">
                      @csrf
                      <input type="text" name="estimate_id" value="{{$estimate_id}}" hidden>
                      <div class="border-bottom border-success">
                        <section class="p-3">
                          
                          <div class="row">
                                <div class="col-md">
                                  <p style="font-weight: bold; text-decoration: underline;">Sender:</p>
                                  <p>{{$estimate->sender_name}}</p>
                                  <p>{{$estimate->sender_address}}</p>
                                  <p>{{$estimate->city}}, {{$estimate->sender_state}}, {{$estimate->sender_city}}, {{$estimate->sender_postal_code}}</p>
                                  <p>Tel: {{$estimate->sender_tel}}</p>
                                </div>
                                <div class="col-md">
                                  <p style="font-weight: bold; text-decoration: underline;">Receiver:</p>
                                  <p>{{ $estimate->contact }}</p>
                                  <p>{{ $estimate->shipping_address }}</p>
                                  <p>{{ $estimate->address_2()}}</p>
                                  <p>Tel: {{ $estimate->tel}}</p>                                  
                                </div>            
                          </div>  
                        </section>
                    </div>

                    <div class="border-bottom border-success">
                        <section class="p-3">
                          <div class="table-responsive">
                            <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Category</th>
                                          <th>Item</th>
                                          <th>Quantity</th>
                                          <th>Unit Price</th>
                                          <th>Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody id="item">
                                      @foreach ($estimate_detail as $detail)
                                      <tr>
                                          <td>{{$detail->category}}</td>
                                          <td style="width: 40%">
                                            {{ $detail->item}}
                                          </td>
                                          <td>
                                            {{ $detail->quantity}}
                                          </td>
                                          <td>
                                            {{ number_format($detail->price,2)}}
                                          </td>
                                          <td>
                                            {{ number_format($detail->quantity * $detail->price,2) }}
                                          </td>
                                        </tr>                                    
                                      @endforeach
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colSpan="4">Total Value</td>
                                      <td colSpan="1">{{$estimate->total_amount}}</td>
                                    </tr>
                                  </tfoot>
                              </table>
                          </div>
                        <div class="form-group row">
                          <label class="col-md-2">Length</label>
                          <input type="text" class="form-control col-md-2" id="length" name="length" placeholder="length..." value="@if(old('length')) {{old('length')}}
                                @else {{ $estimate->length}}
                                @endif" required>
                          <div class="custom-file col-md-4">
                            <input type="file" name="length_photo" style="opacity: 1">
                          </div> 
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">Width</label>
                          <input type="text" class="form-control col-md-2" id ="width" name="width" placeholder="width..." value="@if(old('width')) {{old('width')}}
                            @else {{ $estimate->width}}
                            @endif" required>
                          <div class="custom-file col-md-4">
                            <input type="file" name="width_photo" style="opacity: 1">
                          </div> 
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">Height</label>                          
                          <input type="text" class="form-control col-md-2" id="height" name="height" placeholder="height..." value="@if(old('height')) {{old('height')}}
                                @else {{ $estimate->height}}
                                @endif" required>
                          <div class="custom-file col-md-4">
                            <input type="file" name="height_photo" style="opacity: 1">
                          </div> 
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">Weight</label>
                            <input type="text" class="form-control col-md-2" name="weight" value="@if(old('weight')) {{old('weight')}}
                            @else {{$estimate->weight}}
                            @endif" required>
                            <div class="custom-file col-md-4">
                              <input type="file" name="weight_photo" style="opacity: 1">
                            </div>                            
                        </div>   
                        <div class="form-group row">
                            <label class="col-md-2" style="font-weight: bold">Shipping cost</label>
                            <input type="text" class="form-control col-md-2" name="shipping_cost" value="@if(old('shipping_cost')) {{old('shipping_cost')}}
                            @else {{$estimate->shipping_cost}}
                            @endif" required> 
                        </div>         
                                                        
                        </section>
                        <section class="p-3">
                            <p style="font-weight: bold">Note to courier: <span style="color: red">{{$estimate->note}}</span></p>
                        </section>
                      </div>
                      <button type="submit" class="btn btn-primary" id="btn_update">Create</button>
                    </form> 
                   
                  </div>
               </div>
             </div>
            </div>

@endsection