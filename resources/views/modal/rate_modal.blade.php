	<div class="modal" tabindex="-1" role="find_rate" id="find_rate">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Estimated Rate</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body"> 
	      	<div class="form-group row">
		        <label class="col-sm-7 form-label">Your rate will be (in USD):</label>
		        <input type="text" class="col-sm-3 form-control" id="shipping_cost" readonly="true">
		    </div>
		    <a class="btn btn-primary" href="{{route('login')}}">Register package</a>
		    <p class="pt-3" style="margin-top:20px; border-top: 1px solid grey">
				Our rate is all inclusive door to door rate. All include following.<br>
				- Any remote charges<br>
				- Custom clearance fee<br>
				- UPS Inbound Fee to our warehouse within US<br><br>

				We beat anyone's shipping rate. If you find any cheaper rate, tell us and we will match their price. That's how confident we are on our shipping rate and services.
			</p> 
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>