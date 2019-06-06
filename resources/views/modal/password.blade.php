<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="password_modal"
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
                <form method="POST" action="{{ route('updatePassword')}}">        
                @csrf
                  <div class="form-group row">
                      <label class="col-form-label col-md-3">Old password: </label>
                      <input type="password" class="form-control col-md-3" value="abcdef" readonly="true">
                  </div> 
                  <div class="form-group row">
                      <label class="col-form-label col-md-3" for="new_password">New password: </label>
                      <input type="password" class="form-control col-md-3" id="new_password" name="new_password" value="{{old('new_password')}}" required>
                  </div> 
                  <div class="form-group row">
                      <label class="col-form-label col-md-3" for="confirm_password">Confirm password: </label>
                      <input type="password" class="form-control col-md-3" id="confirm_password" name="confirm_password" value="{{ old('confirm_password')}}" required>
                  </div>                       
                  <button class="btn btn-primary">Update</button>                            
                </form>  
  
            </div>
         </div>
       </aside>
