@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
<script src="https://js.stripe.com/v3/"></script>
<form action="{{ route('stripe.payment') }}" method="post" id="payment-form">
    @csrf
    @method('post')
    <div class="form-row">
        <label for="card-element">Credit or debit card</label>
       <div id="card-element"></div>
       <div id="card-errors" role="alert"></div>
    </div>
    <input type="hidden" name="amount" value="{{ $viewData['amount'] }}">
    <input type="hidden" name="order_id" value="{{ $viewData['order']->getId() }}">
    <button class="btn bg-primary btn-lg text-white mt-3" type="submit">Pay Now (${{ $viewData['amount'] }})</button>
 </form>

 <script>

     // Create a Stripe client
     var stripe = Stripe('pk_test_51KQKUqCVTGV96SgFLMYbt8TrEotVMZ8sKGC4ALBkcJ7AUWGNKLFYRCQ7cNO4NCdEz3OfmVcoM4nYdCn1hty8dMXC008AtOz1jG');

     // Create an instance of Elements
     var elements = stripe.elements();

     // Custom styling can be passed to options when creating an Element.
     // (Note that this demo uses a wider set of styles than the guide below.)
     var style = {
         base: {
             color: '#32325d',
             lineHeight: '24px',
             fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
             fontSmoothing: 'antialiased',
             fontSize: '16px',
             '::placeholder': {
                color: '#aab7c4'
             }
        },
        invalid: {
           color: '#fa755a',
           iconColor: '#fa755a'
        }
 };

 // Create an instance of the card Element
 var card = elements.create('card', {style: style});

 // Add an instance of the card Element into the `card-element` <div>
 card.mount('#card-element');

 // Handle real-time validation errors from the card Element.
 card.addEventListener('change', function(event) {
     var displayError = document.getElementById('card-errors');
     if (event.error) {
         displayError.textContent = event.error.message;
     } else {
       displayError.textContent = '';
     }
 });

 // Handle form submission
 var form = document.getElementById('payment-form');
 form.addEventListener('submit', function(event) {
       event.preventDefault();
       stripe.createToken(card).then(function(result) {
       if (result.error) {
           // Inform the user if there was an error
           var errorElement = document.getElementById('card-errors');
           errorElement.textContent = result.error.message;
       } else {
          // Send the token to your server
          stripeTokenHandler(result.token);
       }
    });
});
</script> 
@endsection