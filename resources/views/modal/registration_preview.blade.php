<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="preview_estimate_modal"
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

            <div class="modal-body">
                <section>
                <div class="row">
                    <div class="col-md">
                      <p style="font-weight: bold; text-decoration: underline;">Sender:</p>
                      <p id="sender_preview"></p>
                      <p id="sender_address_preview"></p>
                      <p id="sender_country_preview"></p>
                      <p>Tel: <span id="sender_tel_preview"></span></p>
                    </div>
                    <div class="col-md">
                      <p style="font-weight: bold; text-decoration: underline;">Receiver:</p>
                      <p id="contact_preview"></p>
                      <p id="address_preview"></p>
                      <p id="country_preview"></p>
                      <p>Tel: <span id="tel_preview"></span></p>
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
                                  <tbody id="item_preview">
                           
                                    
                      
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colSpan="4">Total</td>
                                      <td colSpan="1" class="text-right" id="total_amount_preview"></td>
                                    </tr>
                                    <tr>
                                      <td colSpan="4">Shipping cost</td>
                                      <td colSpan="1" class="text-right" id="shipping_cost_preview"></td>
                                    </tr>
                                  </tfoot>
                              </table>
                          </div>
                         <p>Size (inches): <span id="size_preview"></span></p>
                         <p>Volume: <span id="volume_preview"></span></p>
                         <p>Weight (lbs): <span id="weight_preview"></span></p>
                         <p>Note: <span id="note_preview"></span><p>

                      
              </section>   
              <button type="submit" class="btn btn-primary" id="btn_add_estimate">Register</button>

            </div>
         </div>
       </aside>