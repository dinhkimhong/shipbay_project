<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="preview_shipping_modal"
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
              <h5 class="modal-title" >Preview shipping no. <span class="preview shipping_id_number"></span></h5>
            </div>

            <div class="modal-body pt-3">
                <section>
                <div class="row">
                    <div class="col-md">
                      <p style="font-weight: bold">Sender:</p>
                      <p class="preview sender_contact"></p>
                      <p class="preview sender_address"></p>
                      <p class="preview sender_address_2"></p>
                    </div>
                    <div class="col-md">
                      <p style="font-weight: bold">Receiver:</p>
                      <p class="preview receiver_contact"></p>
                      <p class="preview receiver_address"></p>
                      <p class="preview receiver_address_2"></p>
                    </div>
                  </div>                  

                </section>

                <section>
                          <div class="table-responsive">
                            <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Category</th>
                                          <th style="width: 40%">Item</th>
                                          <th>Quantity</th>
                                          <th>Unit Price</th>
                                          <th>Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody class="preview items">                                    
                      
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colSpan="4">Total</td>
                                      <td colSpan="1" class="preview total_amount"></td>
                                    </tr>
                                    <tr>
                                      <td colSpan="4">Shipping cost</td>
                                      <td colSpan="1" class="preview shipping_cost"></td>
                                    </tr>
                                  </tfoot>
                              </table>
                          </div>
                        
                         <p>Size (inches): <span class="preview length"></span> x <span class="preview width"></span> x <span class="preview height"></span></p>  
                         <p>Weight (lbs): <span class="preview weight"></span></p>
                         <p>Note to courier:<span class="preview note"></span></p>

                      
              </section>   
            </div>
         </div>
       </aside>