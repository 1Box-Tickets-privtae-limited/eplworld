@extends('layouts.app')
@section('content')
<style type="text/css">
    .buttonload {
  background-color: #04AA6D; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 24px; /* Some padding */
  font-size: 16px; /* Set a font-size */
}

.iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container{
    right: unset !important;
}
.iti--separate-dial-code{
    width: 100%;
}

</style>



 <section class="onebox-checkout-area section_20 ">
        <div class="container">

  
                <div class="row">
                <div class="col-md-8">
                    <div class="payment-order-details">

                        <div class="faq--wrapper">
                                <div class="faq--area">
                       
           
                                    <div class="faq--item"  id="payment_div" style="pointer-events:none;">
                                        <div class="faq-title" id="payment_form">
                                            <h3>Payment Method - {{PAYMENT_METHOD}}</h3>
                                            <!-- <h6 class="title">{{__('messages.payment method')}}</h6>-->
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <div class="onebox-checkout-form-payment">
                                                @if(PAYMENT_METHOD =='ADYEN')
                                                <input type="hidden" name="booking_id" id="booking_id" value="{{$response['booking_id']}}">
                                                <input type="hidden" name="booking_no" id="booking_no" value="{{$response['booking_no']}}">
                                                <div id="dropin-container"></div>
                                                @endif
                                                
                         
                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="our_partners">
                    <h4>Our Partners</h4>
                       <div class="partner_image"> 
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/network.png">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/fedex.png">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/trustpilot.png">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/mail.png">
                        </div>
                   </div>
                </div>
            </div>
            </div>
        </div>
    </section>

  
  <style type="text/css">
        #error_message  .confirm-img{ width: 100px; }
        #error_message  .modal-content { padding: 30px; }
    </style>


    @endsection
    @push('scripts')
@if(PAYMENT_METHOD =='ADYEN')
<script src="{{ env('ADYEN_JS_URL') }}"
     integrity="{{ env('ADYEN_JS_INTEGRITY') }}"
     crossorigin="anonymous"></script>

<link rel="stylesheet"
     href="{{ env('ADYEN_CSS_URL') }}"
     integrity="{{ env('ADYEN_CSS_INTEGRITY') }}"
     crossorigin="anonymous">
<script type="text/javascript">
var POST_URL = "{{url('paymentresp')}}";
var csrf_token = "{{ csrf_token() }}";
var ENVIRONMENTAL = "{{ strtolower(env('ADYEN_ENVIRONMENTAL')) }}";
</script>

<script type="text/javascript" src="{{asset('/')}}/public/js/adyenImplementation.js?v=1.5"></script>

<script type="text/javascript"> 

function configure_adyen(id,sessionData){


    const configuration = {
  environment: "{{ strtolower(env('ADYEN_ENVIRONMENTAL')) }}", // Change to 'live' for the live environment.
  clientKey: "{{ env('ADYEN_CLIENT_KEY') }}", // Public key used for client-side authentication: https://docs.adyen.com/development-resources/client-side-authentication
  analytics: {
    enabled: true // Set to false to not send analytics data to Adyen.
  },
  session: {
    id: id, // Unique identifier for the payment session.
    sessionData: sessionData // The payment session data.
  },
  onPaymentCompleted: (result, component) => { //alert('onPaymentCompleted');
  
  update_adyenresponse(result);
//console.log(result);
  //window.location.href = "https://phplaravel-775269-2637193.cloudwaysapps.com/adyen/checkout.php";
      
  },
  onError: (error, component) => { 
   console.log('error',error);
  //alert('onError');
      //console.log(error.name, error.message, error.stack, component);
        $("#error_message").modal("show");
        $("#error_display").text(error.name +' -'+error.message);
  },
  // Any payment method specific configuration. Find the configuration specific to each payment method:  https://docs.adyen.com/payment-methods
  // For example, this is 3D Secure configuration for cards:
  paymentMethodsConfiguration: {
    card: {
      hasHolderName: false,
      holderNameRequired: false,
      billingAddressRequired: false
    }
  }
};console.log('configuration',configuration);
return configuration;
}

async function init_adyen(configuration) { 
 // Create an instance of AdyenCheckout using the configuration object.
const checkout = await AdyenCheckout(configuration);

// Create an instance of Drop-in and mount it to the container you created.
const dropinComponent = checkout.create('dropin').mount('#dropin-container');
$('#payment_div').attr('style','pointer-events:auto;');
setTimeout(function(){
$('#payment_form')[0].click();
}, 20);  
}


</script>


@endif

<script src="{{asset('/')}}/public/js/jquery-creditcardvalidator/jquery.creditCardValidator.js"></script>
<script type="text/javascript">


function work(url,token){ 
     const stripe = Stripe("{{ env('STRIPE_KEY') }}"
, {
          apiVersion: '2020-08-27',
        });

        const elements = stripe.elements({
          clientSecret: token
        });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        const paymentForm = document.querySelector('#payment-form');
        paymentForm.addEventListener('submit', async (e) => {
          // Avoid a full page POST request.
          e.preventDefault();

          // Disable the form from submitting twice.
          paymentForm.querySelector('button').disabled = true;

          // Confirm the card payment that was created server side:
          const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
              return_url: url
            }
          });
          if(error) {
           // addMessage(error.message);
          // alert(error.message);
          $('#payment_intent').val(error.message);
            document.getElementById('payment-form').submit();

            // Re-enable the form so the customer can resubmit.
            paymentForm.querySelector('button').disabled = false;
            return;
          }
        });
  }
    function validate(){
    var valid = true;    
       /* $(".error").hide();
        $(".error").html('');*/
     $(".error").addClass('hide');
    var message = "";

    var cardHolderNameRegex = /^[a-z ,.'-]+$/i;
    var cvvRegex = /^[0-9]{3,3}$/;
    
    var cardHolderName = $("#card-holder-name").val();
    var cardNumber = $("#card-number").val();
    var cvv = $("#cvv").val();
    var expiryMonth = $("#expiryMonth").val();
    var expiryYear = $("#expiryYear").val();

    if(cardHolderName == "" || cardNumber == "" || cvv == "" || expiryMonth == "" || expiryYear == "") {
           message  += "<div class='alert-danger alert'>Fill the above card details to proceed.</div>";  
           if(cardHolderName == "") {
               $("#card-holder-name").css('background-color','#FFFFDF');
           }
           if(cardNumber == "") {
               $("#card-number").css('background-color','#FFFFDF');
           }
           if (cvv == "") {
               $("#cvv").css('background-color','#FFFFDF');
           }
           if (expiryMonth == "") {
               $("#expiryMonth").css('background-color','#FFFFDF');
           }
           if (expiryYear == "") {
               $("#expiryYear").css('background-color','#FFFFDF');
           }
       valid = false;
    }
    
    if (cardHolderName != "" && !cardHolderNameRegex.test(cardHolderName)) {
        message  += "<div class='alert-danger alert'>Card Holder Name is Invalid</div>";    
            $("#card-holder-name").css('background-color','#FFFFDF');
            valid = false;
    }
    
    if(cardNumber != "") {
            $('#card-number').validateCreditCard(function(result){
            if(!(result.valid)){
                    message  += "<div class='alert-danger alert'>Card Number is Invalid</div>";    
                    $("#card-number").css('background-color','#FFFFDF');
                    valid = false;
            }
        });
    }
    
    if (cvv != "" && !cvvRegex.test(cvv)) {
        message  += "<div class='alert-danger alert'>CVV is Invalid</div>";    
        $("#cvv").css('background-color','#FFFFDF');
            valid = false;
    }

    if (expiryMonth != "") {
          if (expiryMonth.length != 2 || !$.isNumeric(expiryMonth)) {
        message  += "<div class='alert-danger alert'>Expiry Month is Invalid</div>";    
        $("#expiryMonth").css('background-color','#FFFFDF');
            valid = false;
        }
    }

     if (expiryYear != "") {
        if(expiryYear.length != 4 || !$.isNumeric(expiryYear)){
        message  += "<div class='alert-danger alert'>Expiry Year is Invalid</div>";    
        $("#expiryYear").css('background-color','#FFFFDF');
            valid = false;
        }
    }
    
    if(message != "") {
         $(".error").removeClass('hide');
        $(".error").show();
        $(".error").html(message);
    }
    return valid;
}

    $(function () {
        
          var config = configure_adyen("{{$response['sessionid']}}","{{$response['sessionData']}}");
          init_adyen(config);

          $('#payment_form')[0].click();
      

    });



$('#card-number').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

$('#expiryMonth').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

$('#expiryMonth').keypress(function() {
     
     if($(this).val().length >= 2) {
        $(this).val($(this).val().slice(0, 2));
        return false;
    }
});

$('#expiryYear').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

$('#expiryYear').keypress(function() {
     
     if($(this).val().length >= 4) {
        $(this).val($(this).val().slice(0, 4));
        return false;
    }
});


$('#cvv').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

$('#cvv').keypress(function() {
     
     if($(this).val().length >= 3) {
        $(this).val($(this).val().slice(0, 3));
        return false;
    }
});


$('#card-holder-name').bind('copy paste cut',function(e) {
    e.preventDefault(); 
  });
$( "#card-holder-name" ).keypress(function(e) { console.log("siva");
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                   
                });
    

</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

var check_dail_code = document.querySelector("#check-mobile");
window.intlTelInput(check_dail_code,{
    'separateDialCode':true,
    'preferredCountries': [default_country],
    'autoPlaceholder':'off',
    'initialCountry' : default_country
});

check_dail_code.addEventListener("countrychange", function() {
    // do something with iti.getSelectedCountryData()
    // $('#phone').focus();
    $("#check-dialing-code").val($('#billing .iti__selected-dial-code').text());
});

@if(empty($user_country))
    $('option[data-sortname="'+default_country+'"]').attr("selected", "selected");
    var val = $("#country").val();
    country_change(val)
@endif

</script>
@endpush('scripts')