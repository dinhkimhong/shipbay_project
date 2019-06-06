@extends('layouts.main')
@section('css')
  <!-- css for payment -->
  <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection
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
          <li class="active">
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
          @include('modal.measurement')
          @include('modal.registration1_preview')
          @include('modal.update_shipping_address')
          @include('modal.question')
          @include('modal.payment')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">Order / Registration History</h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" >
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>No.</th>
                              <th>Receiver</th>
                              <th>Measurement</th>
                              <th>Est. Shipping Cost</th>
                              <th>Actual Shipping Cost</th>
                              <th>Paid</th>
                              <th>UPS Label</th>
                              <th>Inhouse Label</th>
                              <th>Tracking UPS</th>
                              <th>Dest. Tracking No.</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 10pt">
                            @foreach ($estimates as $estimate)
                            <tr data-id="{{$estimate->estimate_id}}">
                              <td>{{ Carbon\Carbon::parse($estimate->created_at)->format('Y-m-d')}}</td>
                              <td>{{ $estimate->estimate_id}}</td>
                              <td>{{ $estimate->contact}}</td>
                              <td><button class="btn btn-sm btn-info view_measurement">Compare</button></td>
                              <td class="text-right">{{$estimate->estimated_shipping_cost}}</td> 
                              <td class="text-right actual_shipping_cost">{{$estimate->actual_shipping_cost}}</td> 
                              <td class="text-center">
                                @if($estimate->paid)
                                <input type="checkbox" name="paid" disabled="true" checked="true">
                                @elseif($estimate->actual_shipping_cost !== null)
                                <a class="btn btn-primary payment" href="#" >Pay</a>
                                @else
          
                                @endif
                              </td>
                              <td class="text-center"><a href="{{$estimate->label_url}}" target="_blank"><span style="font-size: 1.3em; color: #4a80d6;" data-toggle="tooltip" data-placement="top" title="Print USPS label"><i class="fas fa-print"></i></span></a></td>
                              <td class="text-center"><a href="{{route('printEstimate',$estimate->estimate_id)}}" target="_blank"><span style="font-size: 1.3em; color: #249926;" data-toggle="tooltip" data-placement="top" title="Print Shipbay label"><i class="fas fa-print"></i></span></a></td>
                              <td><a class="btn btn-sm btn-info" href="{{route('trackingPackage',$estimate->estimate_tracking_code) }}" target="_blank">{{ $estimate->estimate_tracking_code }}</a></td>
                              <td>@if($estimate->shipping_tracking_number !== null) <a class="btn btn-sm btn-primary" href="{{route('trackingPackage',$estimate->shipping_tracking_number) }}" target="_blank">{{ $estimate->shipping_tracking_number }}</a> @endif</td>
                              <td>
                                <div class="btn-group dropleft">
                                  <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                  </button>
                                  <div class="dropdown-menu custom-menu">
                                      <a class="dropdown-item view_package" href="#">View</a>
                                      @if(!in_array($estimate->estimate_id,$estimate_id_in_shippings))
                                      <a class="dropdown-item update_shipping_address" href="#">Update address</a>
                                      @elseif(empty($estimate->paid))                                    
                                      <a class="dropdown-item update_shipping_address" href="#">Update address</a>
                                      @elseif(empty($estimate->shipping_tracking_number))
                                      <a class="dropdown-item update_shipping_address" href="#">Update address</a>
                                      @endif
                                      <a class="dropdown-item question" href="#">Question</a>
                                  </div>
                                </div>
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
@section('script')
  <!-- js for Stripe -->
  <script src="https://js.stripe.com/v3/"></script>  
  <script src="{{ asset('js/charge.js') }}" type="text/javascript"></script>

  
<script type="text/javascript">
      $('.view_measurement').on('click',function(){
      let tr = $(this).parents('tr');
      let estimate_id = tr.data('id');
      let data = {'estimate_id': estimate_id};
      $("#measurement_modal").show();
      $.ajax({
          type: 'POST',
          url: "{{ route('findMeasurement') }}",
          datatype: 'json',
          data: data,
          success: function(result){
            $('.customer_length').append(result.customer_info.length);
            $('.customer_width').append(result.customer_info.width);
            $('.customer_height').append(result.customer_info.height);
            $('.customer_weight').append(result.customer_info.weight);
            $('.estimated_shipping_cost').append(result.customer_info.shipping_cost);
            $('.length').append(result.shipbay_info.length);
            $('.width').append(result.shipbay_info.width);
            $('.height').append(result.shipbay_info.height);
            $('.weight').append(result.shipbay_info.weight);
            if(result.shipbay_info.length_photo !== null){
              $('.length_photo').append("<a href='storage/" + result.shipbay_info.length_photo + "' target='_blank'>View photo</a>");
            }
            if(result.shipbay_info.width_photo !== null){
              $('.width_photo').append("<a href='storage/" + result.shipbay_info.width_photo + "' target='_blank'>View photo</a>");
            }
            if(result.shipbay_info.height_photo !== null){
              $('.height_photo').append("<a href='storage/" + result.shipbay_info.height_photo + "' target='_blank'>View photo</a>");
            }
            if(result.shipbay_info.weight_photo !== null){
              $('.weight_photo').append("<a href='storage/" + result.shipbay_info.weight_photo + "' target='_blank'>View photo</a>");
            }
            $('.measurement_actual_shipping_cost').append(result.shipbay_info.shipping_cost);
          }      
      })         
    })


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

    $('.view_package').on('click',function(){
      let tr = $(this).parents('tr');
      let estimate_id = tr.data('id');
      $('#preview_shipping_modal').show();
      let data = {'estimate_id': estimate_id};
      $('.shipping_id_number').append(estimate_id);
      $.ajax({
            type: 'POST',
            url: "{{ route('previewEstimate') }}",
            datatype: 'json',
            data: data,
            success: function(result){       
              $('.sender_contact').append(result.sender.sender_name);
              $('.sender_address').append(result.sender.sender_address);
              $('.sender_address_2').append(result.sender.sender_city + ", " + result.sender.sender_state + ", " + result.sender.sender_country + ", " + result.sender.sender_postal_code);
              $('.receiver_contact').append(result.receiver.contact);
              $('.receiver_address').append(result.receiver.shipping_address);
              $('.receiver_address_2').append(result.receiver.city + ", " + result.receiver.province + ", " + result.receiver.shipping_country + ", " + result.receiver.postal_code);
              $('.total_amount').append(result.receiver.total_amount);
              $('.shipping_cost').append(result.measurement.shipping_cost);
              $('.size').append(result.measurement.length + " x " + result.measurement.width + " x " + result.measurement.height);
              $('.weight').append(result.measurement.weight);
              $('.note').append(result.sender.note);

              let i ="";
              for (i in result.items){
                let tr = "<tr>"+
                          "<td>" + result.items[i].category + "</td>"+
                          "<td>" + result.items[i].item + "</td>"+
                          "<td>" + result.items[i].quantity + "</td>"+
                          "<td>" + result.items[i].price + "</td>"+
                          "<td>" + (result.items[i].quantity * result.items[i].price).toFixed(2) + "</td>"+
                          "</tr>";
                $('.items').append(tr);
              }
            }
          })      
    })

    $('.update_shipping_address').on('click',function(){
      let tr = $(this).parents('tr');
      let estimate_id = tr.data('id');
      $('#update_shipping_address_modal').show();    
      let data = {'estimate_id': estimate_id};
      $.ajax({
            type: 'POST',
            url: "{{ route('previewEstimate') }}",
            datatype: 'json',
            data: data,
            success: function(result){     
              $('.estimate_id').val(estimate_id);
              $('.add_registration_number').append(estimate_id);
              $('.sender_name').val(result.sender.sender_name);
              $('.sender_address').val(result.sender.sender_address);
              $('.sender_city').val(result.sender.sender_city);
              $('.sender_state').val(result.sender.sender_state);
              $('.sender_country').val(result.sender.sender_country);
              $('.sender_postal_code').val(result.sender.sender_postal_code);
              $('.sender_tel').val(result.sender.sender_tel);

              $('.contact').val(result.receiver.contact);
              $('.shipping_address').val(result.receiver.shipping_address);
              $('.city').val(result.receiver.city);
              $('.province').val(result.receiver.province);
              $('.shipping_country').val(result.receiver.shipping_country);
              $('.postal_code').val(result.receiver.postal_code);
              $('.tel').val(result.receiver.tel);

            }

      })  

    })

    $('.question').on('click',function(){
      let tr = $(this).parents('tr');
      let estimate_id = tr.data('id');
      $("#question_modal").show();
      $('.estimate_number').empty().append(estimate_id);
      $('.estimate_id').val(estimate_id);

    })

    $('.payment').on('click',function(){
      let tr = $(this).parents('tr');
      let estimate_id = tr.data('id');
      let shipping_cost = tr.find('.actual_shipping_cost').html();
      $("#payment_modal").show();
      $('.estimate_number').empty().append(estimate_id);
      $('.registration_number').empty().val(estimate_id);
      $('.shipping_cost').empty().val(shipping_cost);
      $('.shipping_cost_btn').empty().append(shipping_cost);
    })
</script>
@endsection