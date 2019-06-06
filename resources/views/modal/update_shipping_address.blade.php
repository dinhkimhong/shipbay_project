<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="update_shipping_address_modal"
>
  <div class="modal-area">
            <button
              aria-label="Close Modal"
              aria-labelledby="close-modal"
              class="_modal-close"
            >
            <span id="close-modal" class="_hide-visual">
            Close
            </span>
            <svg class="_modal-close-icon" viewBox="0 0 40 40">
            <path d="M 10,10 L 30,30 M 30,10 L 10,30" />
            </svg>
            </button>
            <div class="modal-header">
              <h5 class="modal-title">Update address of registration no. <span class="preview add_registration_number"></span></h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('updateShippingAddress') }}">        
                @csrf

                  <input type="text" class="preview estimate_id" name="estimate_id" hidden>
                      <div style="border-bottom: 2px solid #249926">
                        <section class="p-3">
                          <p style="font-weight: bold; text-decoration: underline;">Shipper Information:</p>
                        <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control preview sender_name" name="sender_name" required>
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Adddress</label>
                                    <input type="text" class="form-control preview sender_address" name="sender_address"  required>  
                                  </div>
                              </div>            
                        </div>  
                        <div class="row">
                                  <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control preview sender_city" name="sender_city">
                                    </div>
                                  </div>
                                  <div class="col-md-3 px-1">
                                    <div class="form-group">
                                      <label>State</label>
                                      <input type="text" class="form-control preview sender_state" name="sender_state" >
                                    </div>
                                  </div>                        
                                  <div class="col-md-2 px-1">
                                    <div class="form-group">
                                      <label>Country</label>
                                      <input type="text" class="form-control preview sender_country" name="sender_country" readonly="true">
                                    </div>
                                  </div>
                                  <div class="col-md-2 px-1">
                                    <div class="form-group">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control preview sender_postal_code" name="sender_postal_code">
                                    </div>
                                  </div>
                                  <div class="col-md-2 pl-1">
                                    <div class="form-group">
                                      <label>Telephone no.</label>
                                      <input type="text" class="form-control preview sender_tel" name="sender_tel">
                                    </div>
                                  </div>                        
                        </div>                   
                      </section>
                    </div>



                      <div style="border-bottom: 2px solid #249926">
                        <section class="p-3">
                          <p style="font-weight: bold; text-decoration: underline;">Recipient Information:</p>
                        <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Contact </label>
                                    <input type="text" class="form-control preview contact" name="contact" required>
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Adddress</label>
                                    <input type="text" class="form-control preview shipping_address" name="shipping_address" required>  
                                  </div>
                              </div>            
                        </div>  
                        <div class="row">
                                  <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control preview city" name="city">
                                    </div>
                                  </div>
                                  <div class="col-md-3 px-1">
                                    <div class="form-group">
                                      <label>Province</label>
                                      <input type="text" class="form-control preview province" name="province">
                                    </div>
                                  </div>                        
                                  <div class="col-md-2 px-1">
                                    <div class="form-group">
                                      <label>Country</label>
                                        <input type="text" class="form-control preview shipping_country" name="shipping_country" readonly="true">
                                    </div>
                                  </div>
                                  <div class="col-md-2 px-1">
                                    <div class="form-group">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control preview postal_code" name="postal_code">
                                    </div>
                                  </div>
                                  <div class="col-md-2 pl-1">
                                    <div class="form-group">
                                      <label>Telephone no.</label>
                                      <input type="text" class="form-control preview tel" name="tel">
                                    </div>
                                  </div>                        
                        </div>
                  <button type="submit" class="btn btn-primary">Update</button>                  
                </form>                    
            </div>
         </div>
       </aside>