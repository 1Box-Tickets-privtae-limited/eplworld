@extends('layouts.app')
@section('content')
<?php 
$user_country = Session::get('country');
$user_state = Session::get('state');
?>
 <style type="text/css">
    #session_modal .modal-content{padding:40px;text-align:center;display:block;}
    #session_modal .modal-content h2{font-size: 26px;font-weight:700;color:#1c1c1c;margin-bottom:20px}
    #session_modal .modal-content p{font-size: 16px;font-weight:400;color:#1c1c1c;margin-bottom:6px}
    #session_modal .modal-content p.red_notice{color:#ec1c25}
    #session_modal .modal-content .modal-footer{border-top:0;padding-top:20px;text-align:center;width:80%;margin:0 auto;}
    #session_modal .modal-content .modal-footer .buts_left{background:#ec1c25;color:#fff;border-color:#ec1c25;padding: 10px 20px;margin: 0 10px;}
    #session_modal .modal-content .modal-footer .buts_left:hover{background:#000;color:#fff;border-color:#000;}
    #session_modal .modal-content .modal-footer .buts_right{background:#31a2e8;color:#fff;border-color:#31a2e8;padding: 10px 20px;margin: 0 10px;}
    #session_modal .modal-content .modal-footer .buts_right:hover{background:#000;color:#fff;border-color:#000;}
  </style>
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.payment')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

 <section class="onebox-checkout-area section_50">
        <div class="container">
            <div class="row onebox-checkout">
                <div class="col-md-12">
                   @if(Session::get('user_token') =="")
                        <div class="sign_in">
                            <p>{{__('messages.already registered')}}? <a href="#" data-toggle="modal" data-target="#onebox-login-modal">{{__('messages.log in')}}</a></p>
                            <div class="social_login">
                                
                                <a href="{{url('/auth/google?type=1')}}" class="sin_with_google"><i class="fab fa-google-plus-g"></i>{{__('messages.sign in with google')}}</a>
                                <a href="{{url('auth/facebook?type=1')}}" class="sin_with_facebook"><i class="fab fa-facebook-f"></i>{{__('messages.sign in with facebook')}}</a>
                            </div>
                        </div>
                    @endif
                </div>
                </div>
                <div class="col-md-8">
                    <div class="onebox-checkout-form-order-details">
                        <!-- <h3>Place Order</h3> -->
                        <form>
                          <div class="row checkout-form">
                            <div class="col-md-7">
                                <div class="place_order-details">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="order-detail-txt">
                                                <h4>{{$results['match_name']}}</h4>
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
                                        <div class="col-md-9">
                                            <div class="order-detail-price">
                                                <p><span>{{__('messages.price')}}:</span> {{$results['no_ticket']}} Ticket/s at {{$results['currency_symbol']}} {{$results['price']}} each</p>
                                                <p><span>{{__('messages.fees & taxes')}}:</span> {{$results['tax_fees_with_symbol']}}</p>
                                                <h5>{{__('messages.total')}} : {{$results['total_amount_sys']}} </h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="ticket_reserved">
                                                <p>{{__('messages.e-tickets')}}</p>
                                                <p>{{__('messages.reserved')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="vl"></div>
                            </div>
                            <div class="col-md-4 padfive">
                                <div class="place_order-details-code">
                                    <p><span>{{$results['stadium_name']}}</span></p>
                                    <p>{{$results['state_name']}}, {{$results['country_name']}}</p>
                                    <h6>{{$results['seat_category']}}</h6>
                                    <img src="{{asset('/')}}/public/img/qr.png">
                                    <p>{{__('messages.ticket will be sent to your email/mobile')}}</p>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
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
                    </div>
                    <div class="clearfix"></div>
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
                                               <form id="billing" action="{{url('/checkout-post')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="cart_id" value="{{base64_encode($cartId)}}">
                        <div class="row checkout-form">
                            <div class="col-md-2">
                                <label for="title">{{__('messages.title')}}</label>
                                <select name="title" id="title" class="form-control" required>
                                    <option value="">{{__('messages.select')}}</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="name">{{__('messages.first name')}}</label>
                                <input type="text" name="firstname" id="name" placeholder="{{__('messages.enter your first name')}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name2">{{__('messages.last name')}}</label>
                                <input type="text" name="lastname" id="name2" placeholder="{{__('messages.enter your last name')}}" required>
                            </div>
                        </div>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="addr">{{__('messages.address')}}</label>
                                <input type="text" name="address" id="addr" placeholder="{{__('messages.enter your address')}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="code">{{__('messages.postcode')}}</label>
                                <input type="text" class="input-box" id="code" name="postcode" placeholder="{{__('messages.enter postcode')}}" required>
                            </div>
                        </div>

                        <div class="row checkout-form">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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

                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <div class="check_phone_field">
                                    <label for="check-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                    <div class="col-md-3 nopad">
                                        <input name="dialling_code" type="tel" id="check-dialing-code" class="form-control">
                                    </div>
                                    <div class="col-md-9 nopad">
                                        <input data-rule-number="true" class="allow-numeric" type="tel" id="phone" name="phone_number" placeholder="{{__('messages.enter phone number')}}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required=""> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email">{{__('messages.e-mail')}}</label>
                                <input type="email" name="email" id="email" placeholder="{{__('messages.email address')}}" required>
                            </div>
                        </div>
                         <div class="row">
                          <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="terms" id="acceptTerms" value="1" required />{{__('messages.i have read and accept the and')}}  
                                        <a target="_blank" href="">{{__('messages.terms and conditions')}}</a> {{__('messages.and')}} 
                                        <a target="_blank" href="{{url('privacy-policy')}}">{{__('messages.privacy policy')}}</a>
                                    </label>
                                    </div>
                                </div>
                        </div>
                        <div class="row checkout-form">
                            <div class="col-md-12">
                                <div class="proceed-checkout">
                                    <button type="submit">{{__('messages.continue')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="faq--item"  id="payment_div" style="pointer-events:none;">
                                        <div class="faq-title" id="payment_form">
                                            <h3>{{__('messages.payment method')}}</h3>
                                            <!-- <h6 class="title">{{__('messages.payment method')}}</h6>-->
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <div class="onebox-checkout-form-payment">
                                                <form role="form" action="{{ route('make-payment') }}" method="post" class="stripe-payment"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="stripe-payment" onSubmit="return validate();">
                            @csrf
                            <input type="hidden" name="booking_id" id="booking_id" value="">
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
                                    <input type="text" id="card-holder-name" class="form-control card-name"  placeholder="{{__('messages.card owner name')}}" /> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row checkout-form">
                                <div class="col-xs-5">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.card number')}}</label> 
                                    <input type="text" id="card-number" class="form-control card-num" placeholder="{{__('messages.card number')}}" /> 
                                    </div>
                                </div>
                              
                                <div class="col-xs-3">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.exp. month')}}</label>
                                    <input type="text"  id="expiryMonth"  class="form-control card-expiry-month" placeholder="{{__('messages.mm')}}" /> 
                                    </div>
                                </div>
                                 <div class="col-xs-2">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.exp. year')}}</label>
                                    <input type="text"  id="expiryYear" class="form-control card-expiry-year" placeholder="YYYY" /> 
                                    </div>
                                </div>
                                  <div class="col-xs-2">
                                    <div class="form-group required"> 
                                    <label>{{__('messages.cvv')}}</label> 
                                    <input type="text" id="cvv"  class="form-control card-cvc" placeholder="CVC" /> 
                                    </div>
                                </div>
                              
                            </div>

                            <div class="row checkout-form">
                                <div class="col-xs-12"> 
                                    <div class="proceed-checkout">
                                       <!--  <a href="#">Review and pay</a> -->
                                        <button class="btn btn-success btn-lg btn-block" id="pay" disabled type="submit">{{__('messages.pay')}}</button>
                                    </div>
                                </div>
                            </div>
                              <div class='checkout-form row'>
                                <div class='col-md-12 hide error form-group'>
                                    <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                </div>
                            </div>
                        </form>
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
                   <div class="ticket_cnfm">
                       <p>{{__('messages.checkout timing text')}}</p>
                       <p><span id="timer"></span></p>
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
  
    @endsection
    @push('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('/')}}/public/js/jquery-creditcardvalidator/jquery.creditCardValidator.js"></script>
<script type="text/javascript">

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
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
             
             var $form = $(".stripe-payment");
            /* var $form = $(".stripe-payment"),
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
            });*/

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

        });

        function stripeRes(status, response) {
            if (response.error) {
             /*   $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);*/
            } else {
                var token = response['id']; 
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

	$("body").on("change","#country",function(){
        var val = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{url('get_state')}}",
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
    $("#billing").validate({
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {

                    if(response.status == 1){
                        if(response.booking_id != ''){
                            $('#booking_id').val(response.booking_id);
                            $('#pay').removeAttr('disabled');
                            $('#payment_div').attr('style','pointer-events:auto;');
                            setTimeout(function(){
                                $('#payment_form')[0].click();
                            }, 20);
                            
                           
                            
                        }
                        /*$('.onebox-checkout-form-payment').removeClass('hide');
                        $('.onebox-checkout-form-details').addClass('hide');*/
                    }
                    else{
                        $('.login-error').show();
                        $(".login-error-msg").html(response.message);
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
        if (seconds <= 0) {
             $("#session_modal").modal({ backdrop: 'static',
    keyboard: false});
            clearInterval(timerData[row].timerId);
        } else {
            seconds--;
             document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;
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
        $old = strtotime(date("m/d/Y h:i:s ", time()));
        $new = strtotime(date('m/d/Y, h:i:s',strtotime($results['expriy_datetime'])));
        $time = ($new - $old);
    
    ?>

    timer(<?php echo "1"; ?>,<?php echo $time; ?>);

$("#releaseHome").on("click",function(){
     $.ajax({
        url: "{{url('delete-cart')}}",
        type: "post",
        dataType: "json",
        data: {"_token": "{{ csrf_token() }}"},
        success: function(response) { 

            if(response.status == 1){
                document.location.href= "{{url('/')}}";
            }
            else{
                alert(response.message);
            }
        }            
    });
});

$("#continueTicket").on("click",function(){
    
    $("#session_modal").modal('hide');
     $.ajax({
        url: "{{url('update-cart')}}",
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
</script>
@endpush('scripts')