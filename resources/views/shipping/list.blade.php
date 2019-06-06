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
          <li>
            <a href="{{ route('shipping')}}">
              <i class="now-ui-icons shopping_delivery-fast"></i>
              <p>Shipping Registration</p>
            </a>
          </li>
          <li class="active">
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
            @include('modal.update_payment')
            @include('modal.update_tracking_number')
            @include('modal.shipping_preview')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">Shipping List</h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Customer name</th>
                              <th>Shipping no.</th>
                              <th>Registration no.</th>
                              <th>Shipping cost</th>
                              <th>Paid</th>
                              <th>Tracking number</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 10pt">
                            @foreach($shippings as $shipping)
                            <tr data-id="{{$shipping->shipping_id}}">
                              <td>{{ Carbon\Carbon::parse($shipping->created_at)->format('Y-m-d') }}</td>
                              <td>{{ $shipping->first_name }} {{ $shipping->last_name }}</td>
                              <td>{{ $shipping->shipping_id}}</td>
                              <td>{{ $shipping->estimate_id}}</td>
                              <td>{{ $shipping->shipping_cost}}</td>
                              <td><input type="checkbox" name="paid" disabled="true" {{$shipping->paid? "checked":null}}></td>
                              <td>{{ $shipping->tracking_number}}</td> 
                              <td>
                                <div class="btn-group dropleft">
                                  <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                  </button>
                                  <div class="dropdown-menu custom-menu">
                                      <a class="dropdown-item preview_shipping" href="#">View shipping</a>
                                      @if($shipping->paid == 0)
                                      <a class="dropdown-item update_payment" href="#">Update payment</a>
                                      @elseif(empty($shipping->tracking_number))
                                      <a class="dropdown-item update_tracking_number" href="#">Update tracking no.</a>
                                      @elseif($shipping->tracking_number)
                                        <a class="dropdown-item email_tracking_number" href="#">Email tracking no.</a> 
                                    
                                      @endif
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
<script type="text/javascript">
    $('.update_payment').on('click',function(){
      let tr = $(this).parents('tr');
      let shipping_id = tr.data('id');
      $("#update_payment_modal").show();
      $('.shipping_id').val(shipping_id);
      $('.shipping_id_number').append(shipping_id);
    })


    $(document).mouseup(function (e){
          const modal = $(".modal-cover");

          if (modal.is(e.target) // if the target of the click isn't the container...
              && modal.has(e.target).length === 0) // ... nor a descendant of the container
          {
            modal.hide();
            $('.shipping_id').empty();
            $('.shipping_id_number').empty();
            $('.preview').empty();
            
          }
    });

    $('._modal-close').on('click',function(){
        $('.modal-cover').hide();
        $('.shipping_id').empty();
        $('.shipping_id_number').empty();
        $('.preview').empty();

    })       

    $('.update_tracking_number').on('click',function(){
      let tr = $(this).parents('tr');
      let shipping_id = tr.data('id');
      $("#update_tracking_number_modal").show();
      $('.shipping_id').val(shipping_id);
      $('.shipping_id_number').append(shipping_id);
    })

    $('.preview_shipping').on('click',function(){
      let tr = $(this).parents('tr');
      let shipping_id = tr.data('id');
      $('#preview_shipping_modal').show();
      $('.shipping_id_number').append(shipping_id);
      let data = {'shipping_id': shipping_id};
      $.ajax({
            type: 'POST',
            url: "{{ route('previewShipping') }}",
            datatype: 'json',
            data: data,
            success: function(result){       
              $('.sender_contact').append(result.estimate.sender_name);
              $('.sender_address').append(result.estimate.sender_address);
              $('.sender_address_2').append(result.estimate.sender_city + ", " + result.estimate.sender_state + ", " + result.estimate.sender_country + ", " + result.estimate.sender_postal_code);
              $('.receiver_contact').append(result.estimate.contact);
              $('.receiver_address').append(result.estimate.shipping_address);
              $('.receiver_address_2').append(result.estimate.city + ", " + result.estimate.province + ", " + result.estimate.shipping_country + ", " + result.estimate.postal_code);
              $('.total_amount').append(result.estimate.total_amount);
              $('.shipping_cost').append(result.shipping.shipping_cost);

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

              if(result.photo.length_photo !== null){
                $('.length').append("<a href='../storage/" + result.photo.length_photo + "' target='_blank'>"+ result.shipping.length + "</a>");
              } else{
                $('.length').append( result.shipping.length);
              };

              if(result.photo.width_photo !== null){
                $('.width').append("<a href='../storage/" + result.photo.width_photo + "' target='_blank'>"+ result.shipping.width + "</a>");
              } else{
                $('.width').append( result.shipping.width);
              };

              if(result.photo.height_photo !== null){
                $('.height').append("<a href='../storage/" + result.photo.height_photo + "' target='_blank'>"+ result.shipping.height + "</a>");
              } else{
                $('.height').append( result.shipping.height);
              };

              if(result.photo.weight_photo !== null){
                $('.weight').append("<a href='../storage/" + result.photo.weight_photo + "' target='_blank'>"+ result.shipping.weight + "</a>");
              } else{
                $('.weight').append( result.shipping.weight);
              };

              $('.note').append(result.estimate.note);
            }
          })    
    })

    $('.email_tracking_number').on('click',function(){
              let tr = $(this).parents('tr');
              let shipping_id = tr.data('id');  
              $.post("{{route('emailShipping')}}",{shipping_id: shipping_id},function(data){
                $(location).attr('href',"{{route('listShipping')}}");
              })         

    }) 

</script>

@endsection
