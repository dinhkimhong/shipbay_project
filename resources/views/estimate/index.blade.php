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
            @include('modal.registration_preview')
            @include('modal.contact_list')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">Register Package</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('createEstimate')}} ">
                      @csrf
                      <div style="border-bottom: 2px solid #249926">
                        <section class="p-3">
                          <p style="font-weight: bold; text-decoration: underline;">Shipper Information:</p>
                        @if(old('sender_name'))
                        <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{old('sender_name')}}" required>
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Adddress</label>
                                    <input type="text" class="form-control" name="sender_address" id="sender_address" value="{{old('sender_address')}}" required>  
                                  </div>
                              </div>            
                        </div>  
                        <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control" name="sender_city" id="sender_city" value="{{old('sender_city')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Province</label>
                                      <input type="text" class="form-control" name="sender_state" id="sender_state" value="{{old('sender_state')}}">
                                    </div>
                                  </div>                        
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Country</label>
                                      <input type="text" class="form-control" id="sender_country" name="sender_country" value="{{old('sender_country')}}" readonly="true">
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control" name="sender_postal_code" id="sender_postal_code" value="{{old('sender_postal_code')}}" >
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Telephone no.</label>
                                      <input type="text" class="form-control" name="sender_tel" id="sender_tel" value="{{old('sender_tel')}}">
                                    </div>
                                  </div>                        
                        </div> 
                        @else
                        <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ Auth::user()->first_name . " " . Auth::user()->last_name}}" required>
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Adddress</label>
                                    <input type="text" class="form-control" name="sender_address" id="sender_address" value="{{ Auth::user()->address }}" required>  
                                  </div>
                              </div>            
                        </div>  
                        <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control" name="sender_city" id="sender_city" value="{{ Auth::user()->city }}">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>State</label>
                                      <input type="text" class="form-control" name="sender_state" id="sender_state" value="{{ Auth::user()->state_id }}">
                                    </div>
                                  </div>                        
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Country</label>
                                      <input type="text" class="form-control" id="sender_country" name="sender_country" value="{{ Auth::user()->country_id }}" readonly="true">
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control" name="sender_postal_code" id="sender_postal_code" value="{{ Auth::user()->postal_code }}" >
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Telephone no.</label>
                                      <input type="text" class="form-control" name="sender_tel" id="sender_tel" value="{{ Auth::user()->tel }}">
                                    </div>
                                  </div>                        
                        </div> 
                        @endif                     
                      </section>
                    </div>

                      <div style="border-bottom: 2px solid #249926">
                        <section class="p-3">
                          <p style="font-weight: bold; text-decoration: underline;">Recipient Information:</p>
                        <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Contact </label><button class="btn btn-sm btn-info" id="contact_list">Choose from Address Book</button>
                                    <input type="text" class="form-control" id="contact" name="contact" value="{{old('contact')}}" required>
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Adddress</label>
                                    <input type="text" class="form-control" name="shipping_address" id="shipping_address" value="{{old('shipping_address')}}" required>  
                                  </div>
                              </div>            
                        </div>  
                        <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control" name="city" id="city" value="{{old('city')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Province</label>
                                      <input type="text" class="form-control" name="province" id="province" value="{{old('province')}}">
                                    </div>
                                  </div>                        
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Country</label>
                                        <select class="form-control" id="shipping_country" name="shipping_country" required>
                                          <option value=""></option>
                                          @foreach($shipping_countries as $country)
                                            <option value="{{$country->country}}" @if(old('shipping_country')== $country->country) selected="true" @endif> {{$country->country}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{old('postal_code')}}" >
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Telephone no.</label>
                                      <input type="text" class="form-control" name="tel" id="tel" value="{{old('tel')}}">
                                    </div>
                                  </div>                        
                        </div>                      
                      </section>
                    </div>

                    <div style="border-bottom: 2px solid #249926">
                        <section class="p-3">
                          <p style="font-weight: bold; text-decoration: underline;">Package Information:</p>
                          <div class="table-responsive">
                            <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Category</th>
                                          <th style="width: 40%">Item</th>
                                          <th>Quantity</th>
                                          <th>Unit Price</th>
                                          <th>Amount</th>
                                          <th><button class="btn btn-sm btn-info" id="add_item">Add</button></th>
                                      </tr>
                                  </thead>
                                  <tbody id="item">
                                    @if(old('item'))
                                      @foreach (old('item') as $key=>$value)
                                      <tr class="item_row">
                                        <td>
                                          <select class="form-control category" name="category_id[]" >
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->category_id}}" @if (old('category_id')[$key] ==$category->category_id) selected="true" @endif >{{$category->category}}</option>
                                            @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control item" name="item[]" value="{{old('item')[$key]}}"></td>
                                        <td><input type="text" class="form-control text-right quantity" name="quantity[]" value="{{old('quantity')[$key]}}"></td>
                                        <td><input type="text" class="form-control text-right price" name="price[]" value="{{old('price')[$key]}}"></td>
                                        <td><input type="text" class="form-control text-right amount" readonly="true"></td>
                                        <td><button class="btn btn-sm btn-danger remove_item">Remove</button></td>
                                      </tr>
                                      @endforeach
                                    @else
                                    <tr class="item_row">
                                        <td><select class="form-control category" name="category_id[]" >
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                            <option value={{$category->category_id}}>{{$category->category}}</option>
                                            @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control item" name="item[]"></td>
                                        <td><input type="text" class="form-control text-right quantity" name="quantity[]" ></td>
                                        <td><input type="text" class="form-control text-right price" name="price[]"></td>
                                        <td><input type="text" class="form-control text-right amount" readonly="true"></td>
                                        <td><button class="btn btn-sm btn-danger remove_item">Remove</button></td>
                                      </tr>                                    
                                    @endif
                      
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colSpan="4">Total</td>
                                      <td colSpan="1"><input type="text" class="form-control text-right" name="total_amount" id="total_amount" readonly="true"></td>
                                    </tr>
                                    <tr>
                                      <td colSpan="4">Shipping cost</td>
                                      <td colSpan="1"><input type="text" class="form-control text-right" name="shipping_cost" id="shipping_cost" value="{{old('shipping_cost')}}" readonly="true"></td>
                                    </tr>
                                  </tfoot>
                              </table>
                          </div>
                        <div class="form-group row">
                          <label class="col-md-2">Size (inch)</label>
                          <input type="text" class="form-control col-md-2" id="length" name="length" placeholder="length..." value="{{ old('length')}}" required>
                          <input type="text" class="form-control col-md-2" id ="width" name="width" placeholder="width..." value="{{ old('width')}}" required>
                          <input type="text" class="form-control col-md-2" id="height" name="height" placeholder="height..." value="{{ old('height')}}" required>
                          <input type="text" class="form-control col-md-2" id="volume" readonly="true">

                        </div>
                          <div class="form-group row">
                            <label class="col-md-2">Weight (lbs)</label>
                            <input type="text" class="form-control col-md-2" id="weight" name="weight" value="{{old('weight')}}" required>
                        </div>     
                        <div class="row">
                          <div class="form-group col-md-12">
                            <label>Note to courier:</label>
                            <textarea class="form-control note" row="3" id="note" name="note" value="{{old('note')}}"></textarea>
                          </div>
                        </div>                                             
                        </section>
                      </div>
  
                        <button type="submit" class="btn btn-info" id="preview_estimate">Preview</button>
                        <button type="submit" class="btn btn-primary" id="btn_add_estimate">Register</button>
                    </form> 
                   
                  </div>
               </div>
             </div>
            </div>

@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
        
        amount();
        totalAmount();
        volume();

        $(document).on('click','#add_item',function(e){
          e.preventDefault();
          var new_row =  '<tr class="item_row">'+
                          '<td><select class="form-control category" name="category_id[]" >'+
                              '<option value=""></option>'+
                              '@foreach($categories as $category)'+
                              '<option value={{$category->category_id}}>{{$category->category}}</option>'+
                              '@endforeach'+
                              '</select>'+
                         '</td>'+
                          '<td><input type="text" class="form-control item" name="item[]"></td>'+
                          '<td><input type="text" class="form-control text-right quantity" name="quantity[]" ></td>'+
                          '<td><input type="text" class="form-control text-right price" name="price[]"></td>'+
                          '<td><input type="text" class="form-control text-right amount" readonly="true"></td>'+
                          '<td><button class="btn btn-sm btn-danger remove_item">Remove</button></td>'+
                        '</tr>';
                      $('#item').append(new_row); 
                      totalAmount();

                      
        })

        $(document).on('click','.remove_item',function(e){
          e.preventDefault();
          var row_quantity = $('#item tr').length;
          if(row_quantity == 1){
            alert('You can not delete last item');
          } else {
            $(this).parents('tr').remove();
          }
          totalAmount();
        })

        $('tbody').delegate('.quantity, .price','change keyup',function(){
          amount();
          totalAmount();
        })

        $('form').delegate('#length, #width, #height,#shipping_country,#weight','change keyup',function(){
          volume();
          findRate();
        })

        function findRate(){
          let shipping_country = $('#shipping_country').val();
          let length = $('#length').val();
          let width = $('#width').val();
          let height = $('#height').val();
          let weight = $('#weight').val();
          let data = {'shipping_country': shipping_country, 'length': length, 'width': width, 'height': height,'weight': weight};
          $.ajax({
            type: 'POST',
            url: "{{ route('findRate') }}",
            datatype: 'json',
            data: data,
            success: function(result){
              $('#shipping_cost').val(result.rate.toFixed(2));
            }
          })
        }


        function amount(){
          var amount = 0;  
          $('.amount').each(function(i,e){
            var tr = $(this).parents('tr');
            var quantity = tr.find('.quantity').val();
            var price = tr.find('.price').val();
            var amount = (quantity * price);
            tr.find('.amount').val(amount.toFixed(2));
          })
        }

        function totalAmount(){
          var total_amount = 0;
          $('.amount').each(function(i,e){
            var amount = $(this).val()-0;
            total_amount += amount;
          })
          $('#total_amount').val(total_amount.toFixed(2));
        }

        function volume(){
          var length = $('#length').val();
          var width = $('#width').val();
          var height = $('#height').val();
          var volume = (length*width*height)/1000;
          $('#volume').val(volume.toFixed(2));
        }

        $('.select_contact').on('click',function(){
          var tr = $(this).parents("tr");
          var contact_id = tr.data("id");
          var dataContactId = {'contact_id': contact_id};
          $.ajax({
            type: 'POST',
            url: "{{ route('findContactInfo') }}",
            datatype: 'json',
            data: dataContactId,
            success: function(result){
              $('#contact').val(result.contact);
              $('#shipping_address').val(result.address);
              $('#city').val(result.city);
              $('#province').val(result.province);
              $('#shipping_country').val(result.country);
              $('#postal_code').val(result.postal_code);
              $('#tel').val(result.tel);
              findRate();
            }
          })
          $('.modal-cover').hide();
        })

        $('.remove_estimate').on('click',function(){
            var td = $(this).parents("td");
            var estimate_id = td.data("id");
            $.post("{{ route('deleteEstimate')}}", {estimate_id: estimate_id},function(data){
              alert(data);
              $(location).attr('href',"{{route('estimate')}}");
            })
        })

        //Modal hide and show

        $('#contact_list').on('click',function(e){
          e.preventDefault();
          $('#contact_list_modal').show();
        })

        $('#preview_estimate').on('click',function(e){
          e.preventDefault();
          $('#preview_estimate_modal').show();
          let sender = $('#sender_name').val();
          let sender_address = $('#sender_address').val();
          let sender_country = $('#sender_city').val() + ", " + $('#sender_state').val() + ", " + $('#sender_country').val() + ", " + $('#sender_postal_code').val();
          let sender_tel = $('#sender_tel').val();
          let contact = $('#contact').val();
          let shipping_address = $('#shipping_address').val();
          let country_address = $('#city').val() + ", " + $('#province').val() + ", " + $('#shipping_country').val() + ", " + $('#postal_code').val();
          let tel = $('#tel').val();
          let total_amount = $('#total_amount').val();
          let shipping_cost = $('#shipping_cost').val();          
          let length = $('#length').val();
          let width = $('#width').val();
          let height = $('#height').val();
          let size = length + " x " + width + " x " + height;          
          let volume = $('#volume').val();
          let weight =$('#weight').val();
          let note = $('#note').val();
          $('#sender_preview').empty().append(sender);
          $('#sender_address_preview').empty().append(sender_address);
          $('#sender_country_preview').empty().append(sender_country);
          $('#sender_tel_preview').empty().append(sender_tel);
          $('#contact_preview').empty().append(contact);
          $('#address_preview').empty().append(shipping_address);
          $('#country_preview').empty().append(country_address);
          $('#tel_preview').empty().append(tel);
          $('#size_preview').empty().append(size);
          $('#volume_preview').empty().append(volume);
          $('#weight_preview').empty().append(weight);
          $('#total_amount_preview').empty().append(total_amount);
          $('#shipping_cost_preview').empty().append(shipping_cost);
          $('#note_preview').empty().append(note);
          $('#item_preview').empty();

          $('.item_row').each(function(i,e){
            let category = $(this).find('.category :selected').text();
            let item = $(this).find('.item').val();
            let unit = $(this).find('.unit').val();
            let quantity = $(this).find('.quantity').val();
            let price = $(this).find('.price').val();
            let amount = $(this).find('.amount').val();
            let tr = '<tr>'+
                    '<td>'+ category+ '</td>'+
                    '<td>'+ item + '</td>'+
                    '<td class="text-right">'+ quantity+'</td>'+ 
                    '<td class="text-right">'+price+'</td>'+
                    '<td class="text-right">'+amount+'</td>'+
                    '</tr>';
            $('#item_preview').append(tr);                                                                                        
          })

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

        //==button in registration form
        $('#btn_add_estimate').on('click',function(){
          $('form').submit();
        })
    })


    //===============number and dot=============
    function number(input){
        $(input).keypress(function(evt){
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[-\d\.]/;
            var objRegex= /^-?\d*[\.]?\d*$/;
            var val = $(evt.target).val();
            if(!regex.test(key) || !objRegex.test(val+key)|| !theEvent.keyCode ==46 || !theEvent.keyCode == 8){
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            };
        })
    }

    number('#length');
    number('#weight');
    number('#width');
    number('#height');

    //============find element by row-------===========
    function findRowNum(input)
    {
        $('tbody').delegate(input,'keydown',function(){
            var tr = $(this).parent().parent();
            number(tr.find(input));
        })
    }

    findRowNum('.quantity');
    findRowNum('.price');


  </script>


@endsection