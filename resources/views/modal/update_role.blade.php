<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="update_role_modal"
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
              <h5 class="modal-title" >Update Role</h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('updateCustomerRole')}}">        
                @csrf
                    <input type="text" class="form-control user_id" name="user_id" hidden>
                    <div class="form-group row">
                      <label class="col-md-1">Name: </label>
                      <input type="text" class="form-control col-md-4 name" readonly="true">
                    </div>                       
                    <div class="form-group row">
                      <label class="col-md-1">Email: </label>
                      <input type="text" class="form-control col-md-4 email" readonly="true">
                    </div>   
                    <div class="form-group row">
                      <label class="col-md-1">Role: </label>
                      <select class="form-control col-md-2" name="role_id" required>
                        <option></option>
                        @foreach($roles as $role)
                        <option value="{{$role->role_id}}">{{ $role->role}}</option>
                        @endforeach
                      </select>
                  </div>   
                  <button type="submit" class="btn btn-primary">Update</button>                  
                </form>                    
            </div>
         </div>
       </aside>