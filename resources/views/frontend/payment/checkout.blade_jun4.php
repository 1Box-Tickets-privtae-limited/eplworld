@extends('layouts.app')
@section('content')
<?php 
$user_country = Session::get('country');
$user_state = Session::get('state');
?>
<style type="text/css">
    .buttonload {
  background-color: #04AA6D; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 24px; /* Some padding */
  font-size: 16px; /* Set a font-size */
}
.fa {
  margin-left: -12px;
  margin-right: 8px;
}

.iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container{
    right: unset !important;
}
.iti--separate-dial-code{
    width: 100%;
}

</style>
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.payment')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

 <section class="onebox-checkout-area section_20 ">
        <div class="container">
            <div class="row onebox-checkout">
                <div class="col-md-12">
                   @if(Session::get('user_token') =="")
                        <div class="sign_in">
                            <p>{{__('messages.already registered')}}? <a href="#" data-toggle="modal" data-target="#onebox-login-modal">{{__('messages.log in')}}</a></p>
                            <div class="social_login">
                                
                                <a href="{{url(app()->getLocale().'/auth/google?type=1')}}" class="sin_with_google"><i class="fab fa-google-plus-g"></i>{{__('messages.sign in with google')}}</a>
                                <a href="{{url(app()->getLocale().'/auth/facebook?type=1')}}" class="sin_with_facebook"><i class="fab fa-facebook-f"></i>{{__('messages.sign in with facebook')}}</a>
                            </div>
                        </div>
                    @endif
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="header" id="myHeader">
                            <div class="content">
                                <div class="ticket_cnfm">
                                    <p>{{__('messages.checkout timing text')}}</p>
                                    <p><span id="timer" class="timer_span"></span></p>
                                    <button type="button" id="modal" class="btn btn-info btn-lg hide" data-toggle="modal" data-target="#session_modal">Open Modal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-8">
                    <div class="onebox-checkout-form-order-details">
                        <!-- <h3>Place Order</h3> -->
                        <form>
                          <div class="row checkout-form">
                            <div class="col-md-7 col-sm-7 col-xs-6 full_widd">
                                <div class="place_order-details">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="order-detail-txt">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$results['slug']}}"><h4>{{$results['match_name']}}</h4></a>
                                                <p>{{$results['tournament_name']}}</p>
                                        <p><span>{{date('D', strtotime($results['match_date']))}} {{$results['match_date']}}, {{$results['match_time']}}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 padfive">
                                            <div class="order-img">
                                                <img src="{{asset('/')}}/public/img/soccer_ball.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="order-detail-price">
                                                <p><span class="para_head">{{__('messages.price')}}: {{$results['no_ticket']}}</span> {{$results['no_ticket'] ==1 ? "Ticket" :"Ticket/s"}} at 
                                                    <span class="span_ltr">{{$results['currency_symbol']}} {{$results['price']}}</span> each</p>
                                                <p><span class="para_head">{{__('messages.fees & taxes')}}:</span> <span class="span_ltr">{{$results['tax_fees_with_symbol']}}</span></p>
                                                <h5>{{__('messages.total')}} : <span class="span_ltr">{{$results['total_amount_sys']}}</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ticket_reserved">
                                                @if($results['ticket_type']  ==2 )
                                                <p><i class="fas fa-check-circle"></i> {{__('messages.e-tickets')}}</p> 
                                                <p><i class="fas fa-check-circle"></i> {{__('messages.reserved')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="vl"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6 full_widd padfive">
                                <div class="place_order-details-code">
                                    <p><span>{{$results['stadium_name']}}</span></p>
                                    <p>{{$results['state_name']}}, {{$results['country_name']}}</p>
                                    <h6>{{$results['seat_category']}}</h6>
                                    <img src="{{asset('/')}}/public/img/qr.png">
                                  @if($results['ticket_type']  ==2 )  <p>{{__('messages.ticket will be sent to your email/mobile')}}</p> @endif
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- <div class="clearfix"></div>
                    <div class="booking_project">
                        <div class="booking_checkbox">
                            <label>
                            <input type="checkbox" name="checkbox" value="no">
                            <span>{{__('messages.use booking project system (+7% free)')}}</span>
                            </label>
                        </div>
                        <div class="booking_img">
                            <img src="{{asset('/')}}/public/img/payment/logo_booking.png">
                        </div>
                    </div> -->
                    <div class="clearfix"></div>



                    <div class="row sign_in_mobile">
                <div class="col-md-12">
                   @if(Session::get('user_token') =="")
                        <div class="sign_in_mob">
                            <p>{{__('messages.already registered')}}? <a href="#" data-toggle="modal" data-target="#onebox-login-modal">{{__('messages.log in')}}</a></p>
                            <div class="social_login">
                                
                                <a href="{{url(app()->getLocale().'/auth/google?type=1')}}" class="sin_with_google"><i class="fab fa-google-plus-g"></i>{{__('messages.sign in with google')}}</a>
                                <a href="{{url(app()->getLocale().'/auth/facebook?type=1')}}" class="sin_with_facebook"><i class="fab fa-facebook-f"></i>{{__('messages.sign in with facebook')}}</a>
                            </div>
                        </div>
                    @endif
                </div>
                </div>


                    <div class="payment-order-details">

                        <div class="faq--wrapper">
                                <!-- <h3 class="main-title">Booking and Delivery</h3> -->
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title" id="billing_form">
                                            <h3>{{__('messages.billing details')}}</h3>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <div class="onebox-checkout-form-details">
                                               <form id="billing" action="{{url(app()->getLocale().'/checkout-post')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="cart_id" value="{{base64_encode($cartId)}}">
                        <div class="row checkout-form">
                            <div class="col-md-2">
                                <div class="select">
                                    <label for="title">{{__('messages.title')}}</label>
                                    <select name="title" id="title" class="form-control" required>
                                        <option value="">{{__('messages.select')}}</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name">{{__('messages.first name')}}</label>
                                <input type="text" name="firstname" id="name" placeholder="{{__('messages.enter your first name')}}" value="{{Session::get('first_name')}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name2">{{__('messages.last name')}}</label>
                                <input type="text" name="lastname" id="name2" placeholder="{{__('messages.enter your last name')}}" value="{{Session::get('last_name')}}" required>
                            </div>
                        </div>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="addr">{{__('messages.address')}}</label>
                                <input type="text" name="address" id="addr" placeholder="{{__('messages.enter your address')}}" value="{{Session::get('address')}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="code">{{__('messages.postcode')}}</label>
                                <input type="text" class="input-box" id="code" name="postcode" placeholder="{{__('messages.enter postcode')}}" value="{{Session::get('post_code')}}" required>
                            </div>
                        </div>

                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <div class="select">
                                    <label for="country">{{__('messages.select country')}}</label>
                                    <select name="country" id="country" class="form-control" required>
                                        <option value="">{{__('messages.select country')}}</option>
                                        @if($country)
                                            @foreach($country as $row)
                                                <option value="{{$row['id']}}"
                                                    @if($user_country == $row['id'])
                                                        selected="selected"
                                                    @endif
                                                >{{$row['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="select">
                                    <label for="city">{{__('messages.select city')}}</label>
                                        <select name="city" id="state" class="form-control" required>
                                            <option value="">{{__('messages.please select')}}...</option>
                                             @if($states)
                                                @foreach($states as $row)
                                                    <option value="{{$row['id']}}"
                                                        @if($user_state == $row['id'])
                                                            selected="selected"
                                                        @endif
                                                    >{{$row['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                            </div>
                        </div>

                        <div class="row checkout-form">
                            <div class="col-md-6 ">
                                <div class="check_phone_field ">
                                    <input type="hidden" id="check-dialing-code" name="dialling_code">
                                    <label for="check-mobile">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 ltr ">
                                            <input data-rule-number="true" name="phone_number" id="check-mobile" class="form-control allow-numeric" value="{{Session::get('mobile')}}"  required="" >
                                        </div>
                                        
                                    </div>
                                    <label id="check-mobile-error" class="error" for="check-mobile"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email">{{__('messages.e-mail')}}</label>
                                <input type="email" name="email" id="email" placeholder="{{__('messages.email address')}}"  value="{{Session::get('email')}}" required>
                            </div>
                        </div>
                         <div class="row">
                          <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="terms" id="acceptTerms" value="1" required />{{__('messages.i have read and accept the and')}}  
                                        <a target="_blank" href="{{url(app()->getLocale().'/terms-and-conditions')}}">{{__('messages.terms and conditions')}}</a> {{__('messages.and')}} 
                                        <a target="_blank" href="{{url(app()->getLocale().'/legal-privacy-policy')}}">{{__('messages.privacy policy')}}</a>
                                    </label>
                                    </div>
                                     <label id="terms-error" class="error" for="terms" style="display: inline;"></label>
                                </div>
                        </div>
                        <div class="row checkout-form">
                            <div class="col-md-12">
                                <div class="proceed-checkout">
                                    <button id="proceed-billing" type="submit">{{__('messages.continue')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if(PAYMENT_METHOD =='ETISALAT')
                         <form id="etisalat-form" method="post" action="{{url(app()->getLocale().'/')}}/Paymentfail" >
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="error" value="error">
                            <input type="hidden" name="booking_id" id="booking_id" value="">
                            <input type="hidden" name="booking_no" id="booking_no" value="">
                             <input type="hidden" name="TransactionID" id="TransactionID" value="">
                         </form>
                         @endif
                                    <div class="faq--item"  id="payment_div" style="pointer-events:none;">
                                        <div class="faq-title" id="payment_form">
                                            <h3>{{__('messages.payment method')}}</h3>
                                            <!-- <h6 class="title">{{__('messages.payment method')}}</h6>-->
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <div class="onebox-checkout-form-payment">
                                                 @if(PAYMENT_METHOD =='network')
                                                <form role="form" action="" method="post" class="stripe-payment"
                            id="network-payment" onSubmit="return validate();">
                            @csrf
                            <input type="hidden" name="booking_id" id="booking_id" value="">
                             <input type="hidden" name="booking_no" id="booking_no" value="">
                            <div class="row checkout-form">
                                <div class="col-xs-12">
                                    <h4 class="">{{__('messages.payment details')}}</h4>
                                        <div class="inlineimage"> 
                                        <img class="img-responsive images" src="{{asset('/')}}/public/img/payment/visa.png">
                                        <img class="img-responsive images" src="{{asset('/')}}/public/img/payment/mastercard.png">
                                        <img class="img-responsive images" src="{{asset('/')}}/public/img/payment/verif_visa.png">
                                        <img class="img-responsive images" src="{{asset('/')}}/public/img/payment/visa_electron.png">
                                        <img class="img-responsive images" src="{{asset('/')}}/public/img/payment/mc_secure.png">
                                        <img class="img-responsive images" src="{{asset('/')}}/public/img/payment/delta.png">
                                        </div>
                                </div>
                            </div>
                            <div class="row checkout-form">
                                <div class="col-xs-12">
                                    <div class="form-group required"> 
                                    <label>{{__("messages.card holder's name")}}</label> 
                                    <input type="text" id="card-holder-name" name="card_holder_name" class="form-control card-name"  placeholder="{{__('messages.card owner name')}}" /> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row checkout-form">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.card number')}}</label> 
                                    <input type="text" id="card-number" name="card_number" class="form-control card-num" placeholder="{{__('messages.card number')}}" /> 
                                    </div>
                                </div>
                              
                                <div class="col-md-2 col-sm-4 col-xs-4 pad_five">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.exp. month')}}</label>
                                    <input type="text"  id="expiryMonth" name="expiryMonth" class="form-control card-expiry-month" placeholder="{{__('messages.mm')}}" /> 
                                    </div>
                                </div>
                                 <div class="col-md-2 col-sm-4 col-xs-4 pad_five">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.exp. year')}}</label>
                                    <input type="text"  id="expiryYear" name="expiryYear" class="form-control card-expiry-year" placeholder="YYYY" /> 
                                    </div>
                                </div>
                                  <div class="col-md-2 col-sm-4 col-xs-4 pad_five">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.cvv')}}</label> 
                                    <input type="text" id="cvv" name="cvv"  class="form-control card-cvc" placeholder="CVC" /> 
                                    </div>
                                </div>
                              
                            </div>

                            <div class="row checkout-form">
                                <div class="col-xs-12"> 
                                    <div class="proceed-checkout">
                                        <button class="btn btn-success btn-lg btn-block" id="networkpay" disabled type="submit">{{__('messages.pay')}}</button>
                                    </div>
                                </div>
                            </div>
                              <div class='checkout-form row'>
                                <div class='col-md-12 hide error form-group'>
                                    <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                </div>
                            </div>
                        </form>
                        @endif
                         
                        @if(PAYMENT_METHOD =='stripe')
                         <form id="payment-form" action="{{url(app()->getLocale().'/')}}/Paymentfail" >
        <!-- <h2 class="align_payment">Payment Method</h2> -->
        <input type="hidden" name="error" value="error">
        <input type="hidden" name="payment_intent" id="payment_intent" value="">
        
        <!-- <label for="payment-element">Payment details</label> -->
        <div id="payment-element">
          <!-- Elements will create input elements here -->
        </div>
        
        <!-- We'll put the error messages in this element -->
        <div id="payment-errors" role="alert"></div>
        <div id="payment-message" class="hidden"></div>
       <!--  <button class="btn btn-success" id="submit"><div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span></button> -->
         <div class="row checkout-form">
                                <div class="col-xs-12"> 
                                    <div class="proceed-checkout">
                                        <button class="btn btn-success btn-lg btn-block" id="pay" disabled type="submit">{{__('messages.pay')}}</button>
                                    </div>
                                </div>
                            </div>
      </form>
      @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="tickets_reserved">
                       <img src="{{asset('/')}}/public/img/tick.png">
                       <h4>{{__('messages.your tickets is reserved')}}</h4>
                        <p>{{__('messages.checkout your ticket reserved text')}}</p>
                   </div>
                   <div class="clearfix"></div>
                   <div class="ticket_cnfm mob_hide">
                        <p>{{__('messages.checkout timing text')}}</p>
                        <p><span id="timer" class="timer_span"></span></p>
                        <button type="button" id="modal" class="btn btn-info btn-lg hide" data-toggle="modal" data-target="#session_modal">Open Modal</button>
                    </div>
                    <div class="clearfix"></div>

                   
                   <div class="our_partners">
                    <h4>{{__('messages.our partners')}}</h4>
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
 <div class="modal fade" id="session_modal" role="dialog"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h2 class="modal-title">{{__('messages.your time is up! would you like to release your tickets')}}?</h2>
        </div>
        <div class="modal-body">
            <p>{{__('messages.if you choose release these tickets, they will become available for others to buy')}}</p>
            <p class="red_notice">{{__('messages.please note that these tickets may not be available at this price')}}.</p>
        </div>
        <div class="modal-footer">
            <button id="releaseHome" class="buts_left">{{__('messages.release my tickets')}}</button>
            <button id="continueTicket" class="buts_right">{{__('messages.continue purchase')}}</button>
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>
      
    </div>
  </div>
  
  <style type="text/css">
        #error_message  .confirm-img{ width: 100px; }
        #error_message  .modal-content { padding: 30px; }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="error_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
         
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-body text-center">
           <!--  <img src="{{url('public/img/confirm1.png')}}" class="confirm-img" alt=""> -->
            <h2 class="mt-3" id="error_display"></h2>
            <div class="tick_book_btn mt-2"><button type="button" data-dismiss="modal" aria-label="Close">Close</button></div>
          </div>
          
        </div>
      </div>
    </div>

    @endsection
    @push('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
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
        
        
        $("#billing_form").trigger('click');
      /*  var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
             
             var $form = $(".stripe-payment");
             var $form = $(".stripe-payment"),
               inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                //Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.setPublishableKey("{{ env('STRIPE_KEY') }}");
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });*/

        /*function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id']; 
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }*/

    });

	$("body").on("change","#country",function(){
        var val = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale().'/get_state')}}",
            data: {'country_id' : val ,"_token": "{{ csrf_token() }}"},
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){
                
                var option = "";
                jQuery.each(data, function(index, item) {
                    option += "<option value='"+item.id+"'>"+ item.name+"</option>"
                });
                $("#state").html(option);

            }
        });
	});	

    

     $("#network-payment").validate({
        messages: {
            card_holder_name: {
                required: "Enter card holder Name."
            },
            card_number: {
                required: "Enter card Number."
            },
            expiryMonth: {
                required: "Enter Expiry Month."
            },
            expiryYear: {
                required: "Enter Expiry Year."
            },
            CVC: {
                required: "Enter CVV."
            }
        },
        submitHandler: function(form) {
            
            $('#networkpay').html('<i class="fa fa-spinner fa-spin"></i> Processing');
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status == 1){
                        window.location.href = response.payment_url;
                    }
                    else{
                        $("#error_message").modal("show");
                        $("#error_display").text(response.message);
                    }
                    
                }            
            });
            return false;
        }
    });


    $("#billing").validate({
        messages: {
            title: {
                required: "{{__('messages.select title')}}"
            },
            firstname: {
                required: "{{__('messages.enter your first name')}}"
            },
            lastname: {
                required: "{{__('messages.enter your last name')}}"
            },
            address: {
                required: "{{__('messages.enter your address')}}"
            },
            postcode : {
                required: "{{__('messages.enter postcode')}}"
            },
            country : {
                required: "{{__('messages.select country')}}"
            },
            city : {
                required: "{{__('messages.select city')}}"
            },
            phone_number: {
                required: "{{__('messages.enter phone number')}}"
            },
            email: {
                required: "{{__('messages.enter your email address')}}"
            },
            terms : {
                required: "{{__('messages.please accept the terms and constions')}}"
            }
        },
        submitHandler: function(form) {

            $('#proceed-billing').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {
                    $('#proceed-billing').html("{{__('messages.continue')}}");

                    if(response.status == 1){
                        if(response.booking_id != '' && response.payment_method == 'stripe'){
                            $('#payment-form').attr('action',response.payment_url);
                            work(response.payment_url,response.payment_token);
                            $('#booking_id').val(response.booking_id);
                            $('#pay').removeAttr('disabled');
                            $('#payment_div').attr('style','pointer-events:auto;');
                            setTimeout(function(){
                                $('#payment_form')[0].click();
                            }, 20);  
                        }
                        else if(response.booking_id != '' && response.payment_method == 'network'){
                          $('#network-payment').attr('action',response.payment_url);
                         $('#booking_id').val(response.booking_id);
                         $('#booking_no').val(response.booking_no);
                         $('#networkpay').removeAttr('disabled');
                         $('#payment_div').attr('style','pointer-events:auto;');
                           setTimeout(function(){
                                $('#payment_form')[0].click();
                            }, 20);  
                        }
                         else if(response.booking_id != '' && response.payment_method == 'ETISALAT'){
                      
                        $('#etisalat-form').attr('action',response.payment_url);
                         $('#booking_id').val(response.booking_id);
                         $('#booking_no').val(response.booking_no);
                         $('#TransactionID').val(response.payment_token);
                          setTimeout(function(){
                                $('#etisalat-form').submit();
                            }, 20); 
                    }

                    }
                    
                    else{

                        $("#error_message").modal("show");
                        $("#error_display").text(response.message);
                    }

                }            
            });
            return false;
        }
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
    var timerData = [];
    function secondPassed(row) {
        var seconds = timerData[row].remaining;
        var minutes = Math.round((seconds - 30) / 60);
        var remainingSeconds = seconds % 60;
    
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }
        if(seconds == 60){
            $("#session_modal").modal({ backdrop: 'static',
            keyboard: false});
            seconds--;
             $(".timer_span").html(minutes + ":" + remainingSeconds)
            //document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;

        }
        else if (seconds <= 0) {
           // console.log("-----------");
            clearInterval(timerData[row].timerId);
            release_ticket();

        } else {
            seconds--;
            $(".timer_span").html(minutes + ":" + remainingSeconds)
            //document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;
        }
        timerData[row].remaining = seconds;
    }
    function timer(row, min) {
            timerData[row] = {
                    remaining:min,
                    timerId: setInterval(function () { secondPassed(row); }, 1000)
                };
            var sec=timerData[row].timerId;
    }

    <?php
        $itemid = array();
        $old = strtotime(date("m/d/Y h:i:s ",strtotime($results['current_time'])));
        $new = strtotime(date('m/d/Y, h:i:s',strtotime($results['expriy_datetime'])));
        $time = ($new - $old);
    
    ?>

    timer(<?php echo "1"; ?>,<?php echo $time; ?>);

$("#releaseHome").on("click",function(){
        release_ticket();
});

$("#continueTicket").on("click",function(){
    
    $("#session_modal").modal('hide');
     $.ajax({
        url: "{{url(app()->getLocale().'/update-cart')}}",
        type: "post",
        dataType: "json",
        data: {"_token": "{{ csrf_token() }}"},
        success: function(response) { 

            if(response.status == 1){
                console.log(response.time);
                timer(<?php echo "1"; ?>,response.time);
                //document.location.href= "{{url('/')}}";
            }
            else{
                alert(response.message);
            }
        }            
    });
});

function release_ticket(){
    $.ajax({
        url: "{{url(app()->getLocale().'/delete-cart')}}",
        type: "post",
        dataType: "json",
        data: {"_token": "{{ csrf_token() }}"},
        success: function(response) { 

            if(response.status == 1){
                document.location.href= "{{url(app()->getLocale())}}";
            }
            else{
                alert(response.message);
            }
        }            
    });
}
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

</script>
@endpush('scripts')