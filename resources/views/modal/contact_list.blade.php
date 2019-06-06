<aside tag="aside" role="dialog"
        tabIndex="-1"
        aria-modal="true"
        class="modal-cover"
        id="contact_list_modal"
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
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Contact</th>
                              <th>Full Address</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>                          
                            @foreach($contacts as $contact)
                            <tr data-id="{{$contact->contact_id}}">
                              <td>{{ $contact->contact }}</td>
                              <td>{{ $contact->address}}, {{$contact->city}}, {{$contact->province}}, {{$contact->country}}</td>
                              <td><button class="btn btn-sm btn-info select_contact">Select</button></td>
                            </tr>
                            @endforeach                            
                          </tbody>
                        </table>
                     </div>                            
            </div>
         </div>
       </aside>