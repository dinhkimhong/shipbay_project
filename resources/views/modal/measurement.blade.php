<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="measurement_modal"
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
                      <h5>Your measurement:</h5>
                      <p>Length (inches): <span class="preview customer_length"></span></p>
                      <p>Width (inches): <span class="preview customer_width"></span></p>
                      <p>Height (inches): <span class="preview customer_height"></span></p>
                      <p>Weight (lbs): <span class="preview customer_weight"></span></p>
                      <p>Estimated Shipping Cost: <span class="preview estimated_shipping_cost"></span></p>
                    </div>
                    <div class="col-md">
                      <h5>Shipbay.us's Measurement:</h5>
                      <p>Length (inches): <span class="preview length"></span> <span class="preview length_photo"></span></p>
                      <p>Width (inches): <span class="preview width"></span> <span class="preview width_photo"></span></p>
                      <p>Height (inches): <span class="preview height"></span> <span class="preview height_photo"></span></p>
                      <p>Weight (lbs): <span class="preview weight"></span> <span class="preview weight_photo"></span></p>
                      <p>Actual Shipping Cost: <span class="preview measurement_actual_shipping_cost"></span></p>

                    </div>
                  </div>                  

                </section>
  
            </div>
         </div>
       </aside>