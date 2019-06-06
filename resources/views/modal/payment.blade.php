<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="payment_modal"
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
              <h5 class="modal-title" >Payment of registration no. <span class="estimate_number"></span></h5>
            </div>
            <div class="modal-body">          
                <form method="POST" action="{{ route('charge') }}" id="payment-form">
                  @csrf
                  <div class="form-row">
                    <input type="text" class="form-control registration_number" name="estimate_id" readonly="true" hidden>

                    <input type="number" class="form-control shipping_cost" name="shipping_cost" readonly="true" hidden>

                    <div id="card-element" class="form-control">
                      <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                  </div>

                  <button class="btn btn-primary strong">Pay $<span class="shipping_cost_btn"></span></button>

                </form>              
            </div>
         </div>
</aside>