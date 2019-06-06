<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="update_tracking_number_modal"
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
              <h5 class="modal-title" >Update tracking number of shipping no. <span class="shipping_id_number"></span></h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('updateTrackingNumber')}}">        
                @csrf
                    <input type="text" class="shipping_id" name="shipping_id" hidden>
                  <div class="row form-group">
                      <label class="col-md-4">Tracking number: </label>
                      <input type="text" class="form-control col-md-4" name="tracking_number">
                  </div>   
                  <div class="row form-group">
                      <label class="col-md-4">Carrier: </label>
                      <select class="form-control col-md-4" name="carrier" required>
                        <option></option>
                        @foreach($carriers as $carrier)
                        <option value="{{$carrier->carrier}}">{{ $carrier->carrier_name}}</option>
                        @endforeach
                      </select>
                  </div>                   
                  <button type="submit" class="btn btn-primary">Update</button>                  
                </form>                    
            </div>
         </div>
       </aside>