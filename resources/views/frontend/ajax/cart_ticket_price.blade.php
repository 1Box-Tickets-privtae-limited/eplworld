<div class="order-detail-price">
<p><span class="para_head">{{__('messages.price')}}: {{$results['no_ticket']}}</span> {{$results['no_ticket'] ==1 ? "Ticket" :"Ticket/s"}} at 
<span class="span_ltr">{{$results['currency_symbol']}} {{$results['price']}}</span> {{$results['no_ticket'] ==1 ? "" :"each"}}</p>
<p><span class="para_head">{{__('messages.fees & taxes')}}:</span> <span class="span_ltr">{{$results['tax_fees_with_symbol']}}</span></p>
@if($results['booking_delivery_price'])
<p><span class="para_head">{{__('messages.Delivery Price')}}:</span> <span class="span_ltr">{{$results['booking_delivery_price_sym']}}</span></p>
@endif 
@if($results['premium_price_sym'])
<p><span class="para_head">{{__('messages.Premium Price')}}:</span> <span class="span_ltr">{{$results['premium_price_sym']}}</span></p>
@endif 
@if(!empty($results['coupon_code']))
<p><span class="para_head">{{__('messages.Coupon')}}:</span> <span class="span_ltr green">{{$results['discount_coupon']}}</span></p>
@endif
<h5>{{__('messages.total')}} : <span class="span_ltr">{{$results['total_amount_sys']}}</span></h5>
@if($results['default_currency']) <p class="grey-color">{{__('messages.in the payment currency')}} : <span class="span_ltr">{{$results['default_currency']}}</span></p>
@endif
</div>