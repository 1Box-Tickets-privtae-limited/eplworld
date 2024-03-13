@extends('layouts.app')
@section('content')
<?php 


$user_country = Session::get('country');
$user_state = Session::get('state');
$premium_id = Session::get('premium_id');
//dd(session()->all());
$cart_id = Session::get('cart_id');
?>
<style type="text/css">
    .grey-color{
       color: #878686;
    }
    .buttonload {
  background-color: #04AA6D; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 24px; /* Some padding */
  font-size: 16px; /* Set a font-size */
}
/*.fa {
  margin-left: -12px;
  margin-right: 8px;
}*/

.iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container{
    right: unset !important;
}
.iti--separate-dial-code{
    width: 100%;
}
</style>


<!-- Breadcromb Area Start -->
<!-- <section class="onebox-breadcromb-area">
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
</section> -->
<!-- Breadcromb Area End -->



<section class="onebox-checkout-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="onebox-checkout-form-order-details">
                    <form>
                        <div class="row checkout-form">
                            <div class="col-md-8 col-sm-8 col-xs-6 full_widd vl">
                                <div class="place_order-details">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-8">                                     
                                            <div class="order-detail-txt">
                                    @if(@$results['event_type'] == "other")

                                       @php  
                                            $url = url(app()->getLocale().'/')/other-events-$results['slug'];  @endphp
                                     @else 
                                    @php  
                                        $url =  url(app()->getLocale().'/')."/".$results['slug'] @endphp
                                        @endif

                                                <a href="{{$url}}">
                                                @if(@$results['team_name_a'])
                                         <h4>{{$results['team_name_a']}} <span>VS</span> {{$results['team_name_b']}}</h4></a>
                                         @else
                                         <h4>{{@$match_details[0]}}
                                         @if(@$match_details[1]) <span>VS</span>@endif {{@$match_details[1]}}</h4></a>
                                         @endif

                                                @if(@$results['team_name_a'])
                                                <p>{{$results['tournament_name']}}</p>
                                                @else
                                                 <p>{{$results['category_name']}}</p>
                                                 @endif
                                                <div class="popular-date-time">{{$results['match_day']}} {{$results['match_date']}}   | {{$results['match_time'] ?", ". $results['match_time'] : ""}} </div>
                                                <p>{{$results['stadium_name']}} , {{$results['state_name']}}, {{$results['country_name']}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 padfive">
                                            <div class="order-img">
                                                 @if(@$results['team_name_a'])
                                                <img src="{{$results['team_image_a']}}" alt="">
                                                <img src="{{$results['team_image_b']}}" alt="">
                                             @else
                                             <img src="{{$results['event_image']}}" alt="">
                                             @endif
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="e_tickets">
                                                <h6>{{$results['seat_category']}}</h6>
                                                <ul>


                                                @if(@$results['row'])  <li><div class="ticket-sub-block tick_text"><b>{{__('messages.row')}}</b> : {{$results['row']}} </div></li>  @endif  

                                                @if(@$results['block_id'])  
                                          @php $block = explode("-",$results['block_id']);  @endphp
                                                <li><div class="ticket-sub-block tick_text"><b>{{__('messages.block')}}</b> : {{ end($block)}} </div></li>
                                                 @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8" id="ticket_price_data">
                                                <div class="order-detail-price">
                                                <p><span class="para_head">{{__('messages.price')}}: {{$results['no_ticket']}}</span> {{$results['no_ticket'] ==1 ? "Ticket" :"Ticket/s"}} at 
                                                <span class="span_ltr">{{$results['currency_symbol']}} {{$results['price']}}</span> {{$results['no_ticket'] ==1 ? "" :"each"}}</p>
                                                <p><span class="para_head">{{__('messages.fees & taxes')}}:</span> <span class="span_ltr">{{$results['tax_fees_with_symbol']}}</span></p>

                                                @if($results['premium_price_sym'])
                                                <p><span class="para_head">{{__('messages.Premium Price')}}:</span> <span class="span_ltr">{{$results['premium_price_sym']}}</span></p>
                                                @endif 
                                                 @if(@$results['coupon_stauts'] == 1) 
                                               <!--  <p><span class="para_head">{{__('messages.Coupon')}}:</span> <span class="span_ltr green">{{$results['discount_coupon']}}</span></p> -->
                                               @endif
                                                <h5>{{__('messages.total')}} : <span class="span_ltr">{{$results['total_amount_sys']}}</span></h5>

                                                @if($results['default_currency']) <p class="grey-color">{{__('messages.in the payment currency')}} : <span class="span_ltr">{{$results['default_currency']}}</span></p>
                                                @endif

                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ticket_reserved">
                                                 @if(@$results['ticket_type_image'])
                                                 <div class="tick_text"> <i class="fas fa-check-circle"></i>  {{$results['ticket_type_name']}}</div>
                          
                                                <p><i class="fas fa-check-circle"></i> {{__('messages.reserved')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6 full_widd padfive">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tick tick_padd">
                                              @if(count($results['ticket_details'])) 
                                     
                                            <p><span>{{__('messages.listing note(s)')}}</span></p>
                                            <div class="seller_notes_list">

                                              
                                          
                                                <ul>
                                                    @foreach($results['ticket_details'] as $row) 
                                                    <li>{{$row['ticket_name']}}</li>
                                                    @endforeach
                                                </ul>

                                                
                                            </div>
                                            @endif
                                           <!--  <p><span>Listing Notes:</span></p>
                                            <div class="seller_notes_list">
                                                <ul>
                                                    <li>Access to VIP Lounge</li>
                                                    <li>Ticket with meal</li>
                                                    <li>Tickets seated in pairs</li>
                                                </ul>
                                            </div> -->
                                        </div>
                                        <div class="ticket_mobile">
                                             @if($results['ticket_type']  ==2 || $results['ticket_type']  == 4 )  <p>{{__('messages.ticket will be sent to your email/mobile')}}</p> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="booking_project">
                    <div class="booking_checkbox" id="booking_checkbox">
                        <label>
                        <input type="checkbox" id="booking_protect" name="booking_protect" value="{{$cartId}}">
                        <span>{{__('messages.use booking protect system (+7% free)')}}</span>
                        </label>
                       
                    </div>
                    <div class="booking_img">
                        <img src="{{asset('/')}}/public/img/payment/logo_booking.png">
                    </div>
                </div>

                <div class="payment-order-details">
                    <h4>{{__('messages.contact information')}}</h4>
                    <div class="onebox-checkout-form-details">
                        <div class="step_1">
                            <p>Step 1 of 2</p>
                            <ul>
                                <li><div class="step_border_1"></li>
                                <li><div class="step_border_2"></li>
                            </ul>
                        </div>
                        <form id="billing" action="{{url(app()->getLocale().'/checkout-post')}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="booking_protect_id" id="booking_protect_id" value="">
                            <input type="hidden" name="cart_id" value="{{base64_encode($cartId)}}">
                            <input type="hidden" name="r_cart_coupon" id="r_cart_coupon" value="0">
                            <div class="row checkout-form">
                                <!-- <div class="col-md-2 col-sm-2 col-xs-12 full_widdh">
                                    <div class="form-group">
                                        <div class="select">
                                            <label for="title">{{__('messages.title')}}<span class="text-danger">*</span></label>
                                            <select name="title" id="title" class="form-control" required>
                                                <option value="">{{__('messages.select')}}</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                        <label for="name">{{__('messages.first name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="firstname" id="name" placeholder="{{__('messages.enter your first name')}}" autocomplete="off" value="{{Session::get('first_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                        <label for="name2">{{__('messages.last name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" id="name2" placeholder="{{__('messages.enter your last name')}}" autocomplete="off" value="{{Session::get('last_name')}}" required>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row checkout-form">
                                <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                        <label for="addr">{{__('messages.address')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="addr" placeholder="{{__('messages.enter your address')}}" value="{{Session::get('address')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                        <label for="code">{{__('messages.postcode')}}</label>
                                        <input type="text" class="input-box" id="code" name="postcode" placeholder="{{__('messages.enter postcode')}}" value="{{Session::get('post_code')}}" >
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row checkout-form"> -->
                               <!--  <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                        <div class="select">
                                            <label for="country">{{__('messages.select country')}}<span class="text-danger">*</span></label>
                                            <select name="country" id="country" class="form-control" required>
                                                <option value="">{{__('messages.select country')}}</option>
                                                @if($country)
                                                    @foreach($country as $row)
                                                        <option value="{{$row['id']}}"
                                                            @if($user_country == $row['id'])
                                                                selected="selected"
                                                            @endif data-sortname="{{$row['sortname']}}"
                                                        >{{$row['name']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                            <label for="city">{{__('messages.select city')}}</label>
                                             <input type="text" name="city" id="state" placeholder="Enter your city" value="{{Session::get('city')}}" required>
                                    </div>
                                </div> -->

                                <!-- <div class="col-md-6 col-sm-6 col-xs-6 full_widdh">
                                    <div class="form-group">
                                        <div class="select">
                                            <label for="city">{{__('messages.select city')}}
                                             
                                            </label>
                                                <select name="city" id="state" class="form-control" >
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
                                </div> -->
                            <!-- </div> -->
                            <div class="row checkout-form">
                                <div class="col-md-12 col-sm-12 col-xs-12 full_widdh">
                                    <div class="form-group">
                                        <div class="check_phone_field">
                                            <input type="hidden" id="check-dialing-code" name="dialling_code">
                                            <label for="check-mobile">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12 ltr ">
                                                    <input data-rule-number="true" name="phone_number" id="check-mobile" class="form-control allow-numeric" value="{{Session::get('mobile')}}" autocomplete="off"  required="" >
                                                </div>
                                                
                                            </div>
                                            <label id="check-mobile-error" class="error" for="check-mobile"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row checkout-form">
                                <div class="col-md-12 col-sm-12 col-xs-12 full_widdh">
                                    <div class="form-group">
                                        <label for="email">{{__('messages.email address')}}<span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" placeholder="{{__('messages.email address')}}"  value="{{Session::get('email')}}" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row checkout-form">
                                <div class="col-md-12 col-sm-12 col-xs-12 full_widdh">
                                    <div class="form-group">
                                        <label for="email">{{__('messages.confirm email address')}}<span class="text-danger">*</span></label>
                                        <input type="email" name="confirm_email" id="confirm_email" placeholder="{{__('messages.confirm email address')}}"  value="{{Session::get('email')}}" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row checkout-form">
                                <div class="col-md-12">
                                    <div class="content-group">
                                        <p>{{__('messages.use the above contact information to receive your tickets or for our team to contact you to arrange delivery if neccessary')}}</p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="subscribe" id="subscribe" value="1"  />{{__('messages.sign up to our newsletter and be the first to receive special offers')}}
                                    </label>
                                    </div>
                                     <label id="subscribe-error" class="error" for="subscribe" style="display: inline;"></label>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="terms" id="acceptTerms" value="1" required />{{__('messages.i have read and accept the and')}}  
                                        <a target="_blank" href="{{'https://www.1boxoffice.com/'.app()->getLocale().'/terms-and-conditions'}}">{{__('messages.terms and conditions')}}</a> {{__('messages.and')}} 
                                        <a target="_blank" href="{{'https://www.1boxoffice.com/'.app()->getLocale().'/legal-privacy-policy'}}">{{__('messages.privacy policy')}}</a>
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
                <div class="attendee_details" style="display: none;">
                    <h4>Attendee Details</h4>
                    <div class="attendee_section">
                         <form id="attendee_forms" action="{{url(app()->getLocale().'/attendee-post')}}" method="post" novalidate="novalidate">
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="bookings_id" id="bookings_id" value="">
                         @for ($i = 0; $i < $results['no_ticket']; $i++)
                         <label style="color:#e01a22;">{{__('messages.Ticket Holder')}} <?php echo ($i+1);?></label>
                        <div class="row checkout-form">
                     
                            <div class="col-md-6 full_widdh">
                                <div class="form-group">
                                    <label for="attendee_fname">{{__('messages.attendee first name')}}</label>
                                    <input type="text" name="attendee_firstname[]" id="attendee_fname-<?php echo $i;?>" placeholder="{{__('messages.attendee first name')}}" value="" >
                                </div>
                            </div>
                            <div class="col-md-6 full_widdh">
                                <div class="form-group">
                                    <label for="attendee_lname">{{__('messages.attendee last name')}}</label>
                                    <input type="text" name="attendee_lastname[]" id="attendee_lname-<?php echo $i;?>" placeholder="{{__('messages.attendee last name')}}" value="" >
                                </div>
                            </div>

                            <div class="col-md-6 full_widdh">
                                <div class="form-group">
                                    <label for="attendee_fname">{{__('messages.attendee birth date')}}</label>
                                    <input class="attendee_dob" type="text" name="dob[]" id="dob-<?php echo $i;?>" placeholder="{{__('messages.attendee birth date')}}"  value="" >
                                </div>
                            </div>
                            <div class="col-md-6 full_widdh">
                                <div class="form-group">
                                    <label for="attendee_lname">{{__('messages.attendee nationality')}}</label>
                                     <select name="nationality[]" id="nationality-<?php echo $i;?>" class="form-control" >
                                            <option value="">{{__('messages.select country')}}</option>
                                            @if(@$nationality)
                                                @foreach(@$nationality as $row)
                                                    <option value="{{$row['iso']}}"
                                                        @if($user_country == $row['iso'])
                                                            selected="selected"
                                                        @endif data-sortname="{{$row['label']}}"
                                                    >{{$row['label']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                </div>
                            </div>
                             
                        </div>
                         @endfor
                        <div class="row checkout-form">
                            <div class="col-md-12">
                                <div class="proceed-checkout">
                                    <button id="proceed-attendee" type="submit" disabled>{{__('messages.continue')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="payment_card_method" style="display: none;">
                    <h4>Payment Method</h4>
                    <div class="onebox-credit-details">
                        <div class="step_1">
                            <p>Step 2 of 2</p>
                            <ul>
                                <li><div class="step_border_1"></li>
                                <li><div class="step_border_1"></li>
                                <!-- <li><div class="step_border_3"></li> -->
                            </ul>
                        </div>

                        <div id="payment_div">
                            <div id="payment_form"></div>

                            <div class="onebox-checkout-form-payment">
                                <input type="hidden" name="booking_id" id="booking_id" value="">
                                <input type="hidden" name="booking_no" id="booking_no" value="">
                                <div id="dropin-container"></div>
                                                                                                                          
                            </div>
                        </div>

                        <div class="tick_guarantee">
                            <div class="guarantee_head"><img class="img-guarantee_head" src="{{url('/')}}/public/img/tick1.png">{{__('messages.100 ticket guarantee')}}</div>
                            <ul>
                                <li>{{__('messages.we back every order')}}</li>
                                <li>{{__('messages.tickets are original & valid')}}</li>
                                <li>{{__('messages.tickets will arrive in time for the event')}}</li>
                                <li>{{__('messages.full refund if the event is cancelled and not rescheduled')}}</li>
                                <li>{{__('messages.24/7 customer service all the way to your seat')}}</li>
                            </ul>
                        </div>

                        <!-- <div class="card_paid_method">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="checkoutForm3" checked="" autocompleted="" data-gtm-form-interact-field-id="2">
                                        <label class="form-check-label" for="checkoutForm3">
                                          Credit card
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card_imagg">
                                        <ul>
                                            <li><img src="{{asset('/')}}/public/img/Visa_Inc.png"></li>
                                            <li><img src="{{asset('/')}}/public/img/MasterCard_Log.png"></li>
                                            <li><img src="{{asset('/')}}/public/img/MasterCard_Log2.png"></li>
                                            <li><img src="{{asset('/')}}/public/img/MasterCard_Log3.png"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label>Card holder’s name</label> 
                                        <input type="text" class="form-control" placeholder="Card holder’s name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label>Card number</label>
                                        <div class="input-group"> 
                                            <input type="text" class="form-control" placeholder="Enter card number" />
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label><span class="hidden-xs">&nbsp;</span></label> 
                                            <input type="text" class="form-control" placeholder="MM" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label><span class="hidden-xs">&nbsp;</span></label> 
                                            <input type="text" class="form-control" placeholder="YYYY" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label><span class="hidden-xs">&nbsp;</span></label> 
                                            <input type="text" class="form-control" placeholder="CVV" /> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row checkout-form">
                                <div class="col-md-12">
                                    <div class="proceed-checkout">
                                        <button id="" type="submit">Review & Pay</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="google_pay">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="checkoutForm4" autocompleted="" data-gtm-form-interact-field-id="0">
                                            <label class="form-check-label" for="checkoutForm4">
                                              <img src="{{asset('/')}}/public/img/googlepay.svg"> Google Pay
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>


            </div>
            <div class="col-md-3">
                <div class="tickets_reserved">
                   <img src="{{asset('/')}}/public/img/tick_1.png">
                   <h4>{{__('messages.Your Ticket Is Reserved')}}</h4>
                    <p> {{__('messages.provides you a fast, efficient and complete ticket sharing environment for both buyers and sellers. The event you are about to attend is the guarantee of fun.')}}</p>
                </div>
                <div class="clearfix"></div>

                <div class="ticket_cnfm mob_hide">
                    <p>{{__('messages.checkout timing text')}}</p>
                    <p><span id="timer" class="timer_span"></span></p>
                    <!-- <button type="button" id="modal" class="btn btn-info btn-lg hide" data-toggle="modal" data-target="#session_modal">Open Modal</button> -->
                </div>

                <div class="clearfix"></div>
 
                <div class="our_partners">
                    <h4>{{__('messages.our partners')}}</h4>
                    <div class="card_logo">
                        <div class="partner_image">
                            <ul>
                                <li>
                                    <img class="img-responsive images1" src="{{url('/')}}/public/img/Visa_Inc.png">
                                </li>
                                <li>
                                    <img class="img-responsive images1" src="{{url('/')}}/public/img/Master_card.png">
                                </li>
                                <li>
                                    <img class="img-responsive images1" src="{{url('/')}}/public/img/union_pay.png">
                                </li>
                                <li>
                                    <img class="img-responsive images1" src="{{url('/')}}/public/img/jcb.png">
                                </li>
                                <li>
                                    <img class="img-responsive images1" src="{{url('/')}}/public/img/google_pay.png">
                                </li>
                                <li>
                                    <img class="img-responsive images1" src="{{url('/')}}/public/img/apple_pay.png">
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="partner_image"> 
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/fedex.png?v=1">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/mail.png?v=1">
                        </div>
                        <div class="pay_cards">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/visapng.png?v=1">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/master_cards.png?v=1">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/new_img/g_pay.png?v=1">
                            <img class="img-responsive images" src="{{asset('/')}}/public/img/our_partners/apple_pay.png?v=1">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>











 <section class="onebox-checkout-area section_50">
        <div class="container">
            <!-- <div class="row onebox-checkout">
                <div class="col-md-12">
                   @if(Session::get('user_token') =="")
                        <div class="sign_in">
                            <p>{{__('messages.already registered')}}? <a href="#" data-toggle="modal" data-target="#onebox-login-modal">{{__('messages.log in')}}</a></p>
                            <div class="social_login">
                                
                                <a href="{{url(app()->getLocale().'/auth/google?type=1')}}" class="sin_with_google"><i class="fab fa-google-plus-g"></i>{{__('messages.sign in with google')}}</a>
                               
                            </div>
                        </div>
                    @endif
                </div>
                </div> -->
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

  <!--Coupon code error modal-->
  <div class="modal fade" id="coupon_error_modal" role="dialog"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h2 class="modal-title">{{__('messages.coupon_error')}}?</h2>
        </div> 
        <div class="modal-body">
            <p>{{__('messages.coupon_error_message')}}</p>
            <p class="red_notice">{{__('messages.please note that these tickets may not be available at this price')}}.</p>
        </div>
        <div class="modal-footer">
            <button id="Cancelcoupon" class="buts_left">{{__('messages.Cancel')}}</button>
            <button id="continuebook" class="buts_right">{{__('messages.continue purchase')}}</button>
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>
      
    </div>
  </div>
  <!--Coupon code error modal-->
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
    <input type="hidden" id="clientKey" name="clientKey" value="{{ env('ADYEN_CLIENT_KEY') }}">
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
var POST_URL = "{{url(app()->getLocale().'/updateadyenresp')}}";
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
  /*merchantName: {
    merchantId: "BCR2DN6T57W5PPAV", // Unique identifier for the payment session.
    gatewayMerchantId: "1boxofficeECOM" // The payment session data.
  },*/
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
 @if($results['tournament'] != 19)
$('#payment_div').attr('style','pointer-events:auto;');
setTimeout(function(){
$('#payment_form')[0].click();
document.getElementById('payment_div').focus();
}, 20);
@else
$('#proceed-attendee').removeAttr('disabled');
//$('#skip-attendee').removeAttr('disabled');
$('#attendee_div').attr('style','pointer-events:auto;');
setTimeout(function(){
    $('#attendee_form')[0].click();
    document.getElementById('attendee_div').focus();

}, 20);  
@endif
}


</script>


@endif
@if(PAYMENT_METHOD =='stripe')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
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
         get_cart_data();
        
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

    $("body").on("click","#skip-attendee",function(e){
        e.preventDefault();
        $('#payment_div').attr('style','pointer-events:auto;');
        setTimeout(function(){
        $('#payment_form')[0].click();
        }, 20);  
    });

    $("body").on("change","#country",function(){
        var val = $(this).val();
        country_change(val);  
    }); 

    function country_change(val){
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
    }
    

    

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

$("#attendee_forms").validate({
        messages: {
            attendee_firstname: {
                required: "{{__('messages.enter your first name')}}"
            },
            attendee_lastname: {
                required: "{{__('messages.enter your last name')}}"
            },
            attendee_email: {
                required: "{{__('messages.enter your email address')}}"
            }
        },
        submitHandler: function(form) { 
              
            $('#proceed-attendee').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {

                    $('#proceed-attendee').html('Continue');

                    if(response.status == '1'){
                        $('#payment_div').attr('style','pointer-events:auto;');
                        setTimeout(function(){
                        $('#payment_form')[0].click();
                        }, 20);  
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


            console.log('submitHandler');
                var booking_protect = 0;
                if ($("#booking_protect").is(":checked")) {
                booking_protect = 1;
                }
                    $('#proceed-billing').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize() + '&booking_protect=' + booking_protect,
                success: function(response) {
                    $('#proceed-billing').html("{{__('messages.continue')}}");

                    if(response.status == 1){

                        $("#billing").toggle();
                        if(response.booking_id != '' && response.payment_method == 'stripe'){
                            $('#payment-form').attr('action',response.payment_url);
                            work(response.payment_url,response.payment_token);
                            $('#booking_id').val(response.booking_id);
                            if(response.tournament == '19'){
                            $('#proceed-attendee').removeAttr('disabled');
                            $('#skip-attendee').removeAttr('disabled');
                            $('#attendee_div').attr('style','pointer-events:auto;');
                            setTimeout(function(){
                                $('#attendee_form')[0].click();
                            }, 20);

                            }
                            else{

                            $('#pay').removeAttr('disabled');
                            $('#payment_div').attr('style','pointer-events:auto;');
                            setTimeout(function(){
                                $('#payment_form')[0].click();
                            }, 20);

                            }
                              
                        }
                        else if(response.booking_id != '' && response.payment_method == 'network'){
                          $('#network-payment').attr('action',response.payment_url);
                         $('#booking_id').val(response.booking_id);
                         $('#booking_no').val(response.booking_no);





                          if(response.tournament == '19'){
                            $('#proceed-attendee').removeAttr('disabled');
                            $('#skip-attendee').removeAttr('disabled');
                            $('#attendee_div').attr('style','pointer-events:auto;');
                            setTimeout(function(){
                                $('#attendee_form')[0].click();
                            }, 20);

                            }
                            else{

                         $('#networkpay').removeAttr('disabled');
                         $('#payment_div').attr('style','pointer-events:auto;');
                           setTimeout(function(){
                                $('#payment_form')[0].click();
                            }, 20);  
                            }
                        }
                         else if(response.booking_id != '' && response.payment_method == 'ETISALAT'){
                      
                        $('#etisalat-form').attr('action',response.payment_url);
                         $('#booking_id').val(response.booking_id);
                         $('#booking_no').val(response.booking_no);
                         $('#TransactionID').val(response.payment_token);
                          if(response.tournament == '19'){
                            $('#proceed-attendee').removeAttr('disabled');
                            $('#skip-attendee').removeAttr('disabled');
                            $('#attendee_div').attr('style','pointer-events:auto;');
                            setTimeout(function(){
                                $('#attendee_form')[0].click();
                            }, 20);

                            }
                            else{
                                 setTimeout(function(){
                                $('#etisalat-form').submit();
                            }, 20);
                            }
                          
                    }
                    else if(response.booking_id != '' && response.payment_method == 'ADYEN'){
                        $(".payment_card_method").show();
                      //console.log('');
                        $('#booking_id').val(response.booking_id);
                         $('#booking_no').val(response.booking_no);

                         if(response.tournament == '19'){
                            
                            $('#bookings_id').val(response.booking_id);
                            

                            }

                        var config = configure_adyen(response.sessionid,response.sessionData);
                         init_adyen(config);
                        
                    }

                    }
                    else if(response.status == -1){
                       /* $("#r_cart_coupon").val(1);
                        $("#coupon_error_modal").modal("show");*/
                        $("#remove_coupon").click();
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
$("#continuebook").click(function(){
    $("#billing").submit();
})
$("#Cancelcoupon").click(function(){
    $("#remove_coupon").click();
})
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
        $old = strtotime(date("m/d/Y H:i:s ",strtotime($results['current_time'])));
        $new = strtotime(date('m/d/Y, H:i:s',strtotime($results['expriy_datetime'])));
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

function get_cart_data(){
    $.ajax({
        url: "{{url(app()->getLocale().'/get-cart-data')}}",
        type: "GET",
        dataType: "json",
        success: function(response) { 

            if(response.success){
                $('#ticket_price_data').html(response.cart_ticket_price);
                $('#booking_checkbox').html(response.cart_ticket_protect);
            }
          
        }            
    });
}


$("body").on("click","#booking_protect",function(){
    var checked = $('input[name=booking_protect]:checked').length;
    var cart_id = $('input[name=booking_protect]').val();
    var loader  = "{{url('public/img/loader.gif')}}";
    
    $('#salesMessage').html('<img style="text-align:center;" src="'+loader+'" width="50px" alt="Loading..." >');
    //$('#booking_protect_id').val('');

    
    if (checked == 1) {
        var mychecked = 1;
    }
    else{
  /* $('#payment_div').attr('style','pointer-events:none;');
    setTimeout(function(){
    $('#billing_form')[0].click();
    }, 20);  */
    var mychecked  = "";
    $('#salesMessage').html('');
    } 

   
     $.ajax({
        url: "{{url(app()->getLocale().'/booking-protect')}}",
        type: "post",
        dataType: "json",
        data: {"_token": "{{ csrf_token() }}","cart_id" : cart_id,"checked" : mychecked},
        success: function(response) { 
            $('#salesMessage').html('');
            
            if(response.status == 0){
               
                $("#error_message").modal("show");
                $("#error_display").text(response.message);
                setTimeout(function(){
                window.location.reload();
                }, 2000);

              
            }
            else{
                window.location.reload();
            }
           /* if(response.status == 1){
                
               
                get_cart_data();
                if($('input[name=terms]:checked').length){
                $('#billing').submit();

                }
            }
            else{
                 get_cart_data();
                $("#error_message").modal("show");
                $("#error_display").text(response.message);
            }*/
        }           
    });

   
    })
</script>

<script>

        $(document).ready(function(){
            $(".promo_open").click(function(){
            $(".promo_close").toggle();
        });
        });


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
    // $('option[data-sortname="'+default_country+'"]').attr("selected", "selected");
    // var val = $("#country").val();
    // country_change(val)
@endif

    $("#submit_coupon").click(function() {
        $.ajax({
          type: "POST",
          url: "check_coupon",
          data: {
            discount_code: $('#booking_coupon').val(),
             "_token": "{{ csrf_token() }}",
          },
          success: function(odata) {
            data=jQuery.parseJSON(odata);
            if (data.status==1) {
                window.location.reload();
            }else{
                alert("Coupon code is invalid");
            }
          }
        });
    });
    $("#remove_coupon").click(function() {
         //if(confirm("Are you sure want to remove coupon ?")) {
        $.ajax({
          type: "POST",
          url: "remove_coupon",
          data: {
             "_token": "{{ csrf_token() }}",
          },
          success: function(odata) {
            data=jQuery.parseJSON(odata);
            if (data.status==1) {
                window.location.reload();
            }else{
                alert("Coupon code is invalid");
            }
          }
        });
        //}
    });

    $(".step_1").click(function(){
          $("#billing").toggle();
    });

    $( "#email, #confirm_email" ).on( "copy cut paste drop", function() {
            return false;
    });


</script>
@endpush('scripts')
