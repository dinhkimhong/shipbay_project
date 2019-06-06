<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="question_modal"
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
              <h5 class="modal-title" >Question regarding to registration no. <span class="estimate_number"></span></label></h5>
            </div>                               
            <div class="modal-body">
                <form method="POST" action="{{ route('emailQuestion')}}">        
                  @csrf
                  <input type="text" class="estimate_id" name="estimate_id" hidden>
                  <div class="form-group col-md-12">
                      <textarea class="form-control" row="5" name="question" placeholder="Input your question here..." required="true"></textarea>
                  </div>                  
                  <button class="btn btn-primary">Send</button>                            
                </form>  
  
            </div>
         </div>
       </aside>
