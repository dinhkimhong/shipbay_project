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
                <form>
                  @csrf
                  <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Contact</label>
                              <select class="form-control" name="contact_id" >
                                <option value=""></option>
                                @foreach($contacts as $contact)
                                <option value="{{$contact->contact_id}}">{{$contact->contact}}</option>
                                @endforeach
                              </select>                 
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label>Adddress</label>
                              <input type="text" class="form-control" name="shipping_address">  
                            </div>
                        </div>            
                    </div>  

                    <div class="row">
                          <div class="table-responsive">
                        <table class="table">
                              <thead>
                                  <tr>
                                      <th>Category</th>
                                      <th>Item</th>
                                      <th>Unit</th>
                                      <th>Quantity</th>
                                      <th>Unit Cost</th>
                                      <th>Total Cost</th>
                                      <th><button class="btn btn-primary" id="btn_add_item">Add</button></th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><select class="form-control" name="category_id[]" >
                                      <option value=""></option>
                                      @foreach($categories as $category)
                                      <option value={{$category->category_id}}>{{$category->category}}</option>
                                      @endforeach
                                      </select>
                                  </td>
                                  <td><input type="text" class="form-control" name="item[]"></td>
                                  <td><input type="text" class="form-control" name="unit[]"></td>
                                  <td><input type="number" class="form-control" name="quantity[]"></td>
                                  <td><input type="number" class="form-control" name="price[]"></td>
                                  <td>123456</td>
                                  <td></td>
                  
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colSpan="5">Total</td>
                                  <td colSpan="1">123456</td>
                                </tr>
                                <tr>
                                  <td colSpan="5">Shipping cost</td>
                                  <td colSpan="1">123456</td>
                                </tr>
                              </tfoot>
                          </table>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2">Size</label>
                      <input type="number" class="form-control col-md-2" name="length" placeholder="length...">
                      <input type="number" class="form-control col-md-2" name="width" placeholder="width...">
                      <input type="number" class="form-control col-md-2" name="height" placeholder="height...">
                      <input type="number" class="form-control col-md-2" name="volume" readonly="true">

                    </div>
                      <div class="form-group row">
                        <label class="col-md-2">Weight</label>
                        <input type="number" class="form-control col-md-2" name="height">
                    </div>

                </form>              
            </div>
         </div>
       </aside>