<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
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
                <form method="POST" action="{{ route('createContact') }}">
                  @csrf
                              <div class="row">
                                <div class="col-md-6 pr-1">
                                  <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" name="contact" required>
                                  </div>
                                </div>                        
                          
                                <div class="col-md-6 pl-1">
                                  <div class="form-group">
                                    <label>Company name</label>
                                    <input type="text" class="form-control" name="company" >
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-3 pr-1">
                                  <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city">
                                  </div>
                                </div>
                                <div class="col-md-3 px-1">
                                  <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" class="form-control" name="province">
                                  </div>
                                </div>                        
                                <div class="col-md-2 px-1">
                                  <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="shipping_country_id" required>
                                      <option value=""></option>
                                      @foreach($shipping_countries as $country)
                                      <option value="{{$country->shipping_country_id}}">{{$country->country}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 px-1">
                                  <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" >
                                  </div>
                                </div>
                                <div class="col-md-2 pl-1">
                                  <div class="form-group">
                                    <label>Telephone no.</label>
                                    <input type="text" class="form-control" name="tel">
                                  </div>
                                </div>                        
                              </div>
                              <button class="btn btn-primary">Create</button>
                </form>              
            </div>
         </div>
       </aside>