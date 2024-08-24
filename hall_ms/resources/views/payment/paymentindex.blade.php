<x-studentlayout>
<h1>Payment</h1>
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
  <div class="col">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Upload Receipt
</button>
</div>
<div class="col">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
  Make Payment with paystack
</button>
</div>
</div>





</div>
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Payment Receipt</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{route('payment.store')}}" class="payment" enctype="multipart/form-data">
        @csrf
       
        <!-- Amount -->
         @foreach($bookings as $booking)
         <!-- User name and id -->
        <div class="col">
            <!-- User ID (hidden) -->
        <input type="hidden" name="user_id" value="{{ $booking->user->id }}">
        
        <!-- Booking ID (hidden) -->
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        
        <label for="" class="form-label">Name</label>
        
        <input class="form-control" type="text" value="{{$booking->user->name }}" aria-label="Disabled input example" disabled readonly>
             </div>
             <div class="">
             <label for="" class="form-label">Name of Hall</label>
               <input class="form-control" type="text" value="{{$booking->hall->name }} {{$booking->hall->block }} " aria-label="Disabled input example" disabled readonly>
        </div>
             <div class="">
             <label for="" class="form-label">Room Number</label>
        <input class="form-control" type="text" value="{{$booking->room->number }}" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="">
        <label for="" class="form-label">Amount</label>
        <input class="form-control" type="text" value="{{$booking->room->price }}" aria-label="Disabled input example" disabled readonly>
        <input class="form-control" type="hidden" name="amount" value="{{ $booking->room->price }}">   
    </div>
        <div class="">
        <label for="" class="form-label">Room Status</label>
        <input class="form-control" type="text" value="{{$booking->status }}" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="mt-0">
        <label for="" class="form-label">Channel</label>
        <input class="form-control" type="text" value="Bank" aria-label="Disabled input example" disabled readonly>
        </div>

    
        @endforeach
        <!--upload-->
        <label for="" class="form-label mt-1">Upload Payment Receipt</label>
        <div class="input-group mb-3 mt-3">
        <input type="file" class="form-control" id="image" name="image">
        <label class="input-group-text" for="image">Upload</label>   
        </div>
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
</form>





<!--Payment Method-->
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Paystack</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      @foreach($bookings as $booking)
      <div class="">
          <label for="" class="form-label">Name</label>
        
             <input class="form-control" type="text" value="{{$booking->user->name }}" aria-label="Disabled input example" disabled readonly>
             </div>
             <div class="">
             <label for="" class="form-label">Name of Hall</label>
               <input class="form-control" type="text" value="{{$booking->hall->name }} {{$booking->hall->block }} " aria-label="Disabled input example" disabled readonly>
             </div>
             <div class="">
             <label for="" class="form-label">Room Number</label>
        <input class="form-control" type="text" value="{{$booking->room->number }}" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="">
        <label for="" class="form-label">Amount</label>
        <input class="form-control" type="text" value="{{$booking->room->price }}" aria-label="Disabled input example" disabled readonly>
        <input class="form-control" type="hidden"  value="{{ $booking->room->price }}">   
        </div>
        <div class="">
        <label for="" class="form-label">Room Status</label>
        <input class="form-control" type="text" value="{{$booking->status }}" aria-label="Disabled input example" disabled readonly>
        </div>
        
      
<form action="{{ route('payment.initialize') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $booking->user->id }}">
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    <input type="hidden" name="amount" value="{{ $booking->room->price }}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
        <button type="submit" name="pay_now" id="pay-now" title="Pay now" class="btn btn-primary">Pay now</button>
      </form>
@endforeach 
      </div>
    </div>
  </div>
</div>
</div>

<!-- <h2>Product: Laptop</h2>
<h3>Price: 15 </h3>
<form id="paymentForm"> 
  <div class="form-submit">
  <button type="submit" onclick="payWithPaystack()" class="btn btn-primary">Pay with PayStack</button>
  </div>
</form> -->

<!-- <script src="https://js.paystack.co/v2/inline.js"></script>
<script>
    const paymentForm = documnet.getElementId('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    function payWithPaystack(e){
      e.preventDefault();
      let handler = PaystackPop.setup({
        key: "{{ env('PAYSTACK_PUBLIC_KEY')}}",
        email: "",
        amount: 1500,
        metadata: {
          custom_fields: [{
            display_name: "Laptop",
            variable_name: "laptop",
            value: "Laptop"
          },
          {
            display_name: "Mobile",
            variable_name: "mobile",
            value: "mobile"
          }
        ]
        }, 
        onClose: function(){
          alert('Window closed.');
        },
        callback: function(response){
            window.location.href = "{{ route('callback') }}" + response.redirecturl;
        }
      });
      handler.openIframe();
    } 

</script>-->
</x-studentlayout>
