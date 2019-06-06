<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="update_payment_modal"
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
              <h5 class="modal-title" >Update payment of shipping no. <span class="shipping_id_number"></span></h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('updatePayment')}}">        
                @csrf
                    <input type="text" class="shipping_id" name="shipping_id" hidden>
                  <div class="row">
                      <label class="col-md-2">Paid:</label>
                      <input type="checkbox" name="paid" value="true">
                  </div>   
                  <button type="submit" class="btn btn-primary">Update</button>                  
                </form>                    
            </div>
         </div>
       </aside>