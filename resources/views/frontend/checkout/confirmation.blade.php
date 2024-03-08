@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Breadcromb Area Start -->
<!-- <section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.confirmation')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Breadcromb Area End -->


<section class="onebox-checkout-order section_50">
        <div class="container">
            <div class="order_placed_sec">
                <div class="row">
                    <div class="col-md-12">

                       
                         <div class="onebox-checkout-order-confirm">


                        @if($booking['booking_status'] == 1)  
                        <div class="order_placed">
                                <p>{{__('messages.dear')}} {{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}},</p>
                                <i class="fas fa-check-circle"></i>
                                <h3>{{__('messages.your order has been placed')}}!</h3>
                                <p><span class="choose_txt">{{__("messages.thank you for choosing 1BOXOFFICE! an email confirmation on it's way to")}} : <b>{{$booking['email']}}</b> </p>
                            
                            </div>
                         @endif
                          @if($booking['booking_status'] == 0)  

                          <div class="order_placed">
                                <p>{{__('messages.dear')}} {{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}},</p>
                               <i class="far fa-warning" style="background-color: #f44336;"></i>
                                <h3>{{__('messages.your order has been failed')}} !</h3>
                                <p><span class="choose_txt">{{$booking['message']}} </p>
                            
                            </div>

                    
                         @endif
                          @if($booking['booking_status'] == 2)  

                            <div class="order_placed">
                                <p>{{__('messages.dear')}} {{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}},</p>
                              <i class="far fa-warning" style="background-color: #ffeb3b;"></i>
                              <h3>{{__('messages.your order is pending')}} !</h3>
                                 <p><span class="choose_txt">{{__("messages.thank you for choosing 1BOXOFFICE! an email confirmation on it's way to")}} : <b>{{$booking['email']}} .</b></span> </p>
                            <p><span class="choose_txt">{{__('messages.please check your mail frequently for order confirmation')}}. </span></p>
                            
                            </div>


                         @endif
                     </div>
                    </div>
                </div>

                <div class="order_infor">
                    <h5>{{__('messages.order information')}}</h5>
                    <div class="order_informations">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="order_s">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td><b>{{__('messages.order number')}}:</b></td>  
                                            <td>{{$booking['booking_no']}}</td>  
                                        </tr>
                                        <tr>
                                                <td><b>{{__('messages.customer name')}}:</b></td>
                                                <td>{{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{{__('messages.payment method')}}:</b></td>  
                                            <td>Online payment card processed</td>      
                                             
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="order_s">
                                    <table>
                                        <tbody>
                                        <tr>
                                              <td><b>{{__('messages.number of tickets')}}:</b></td>
                                                <td>{{$booking['quantity']}}</td>           
                                        </tr>
                                        <tr>
                                            <td><b>{{__('messages.total charge')}}:</b></td>
                                <td><b>{{strtoupper($booking['currency_code'])}} {{$booking['total_payment']}}</b></td>
                                        </tr>
                                       @if($booking['booking_status'] == 1)  
                                        <tr>
                                        <td><b>{{__('messages.booking status')}}:</b></td>
                                        <td>Confirmed</td>
                                        </tr>
                                         @endif
                                        @if($booking['booking_status'] == 0)  
                                        <tr>
                                        <td><b>{{__('messages.booking status')}}:</b></td>
                                        <td>Failed</td>
                                        </tr>
                                        @endif
                                        @if($booking['booking_status'] == 2)  
                                        <tr>
                                        <td><b>{{__('messages.booking status')}}:</b></td>
                                        <td>Pending</td>
                                        </tr>
                                         @endif
                                         <tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ticket_info">
                    <h5>Ticket information</h5>
                    <div class="ticket_info_details">
                        <div class="onebox-checkout-form-order-details">
                            <form>
                                <div class="row checkout-form">
                                    <div class="col-md-8 col-sm-8 col-xs-6 full_widd vl">
                                        <div class="place_order-details">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-8">                                     
                                                    <div class="order-detail-txt">
                                                        <a href="">
                                                        <h4>{{$booking['match_name']}}</h4></a>
                                                        <p>{{$booking['tournament_name']}}</p>
                                                        <div class="popular-date-time">{{$booking['match_date']}}  | {{$booking['match_time']}}</div>
                                                        <p>{{$booking['stadium_name']}},{{$booking['city_name']}},{{$booking['country_name']}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4 padfive">
                                                    <div class="order-img">
                                                        <img src="{{$booking['team_image_a']}}" alt="">
                                                        <img src="{{$booking['team_image_b']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="e_tickets">
                                                        <h6>{{$booking['seat_category']}}</h6>
                                                        <ul>

                                                        @if($booking['row'])
                                                        <li><div class="ticket-sub-block tick_text"><b>{{__('messages.row')}}</b> : {{$booking['row']}} </div></li>
                                                        @endif
                                                        @if($booking['ticket_block'])
                                                        <li><div class="ticket-sub-block tick_text"><b>{{__('messages.block')}}</b> : {{$booking['ticket_block']}}</div></li>
                                                           @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="order-detail-price">
                                                        <!-- <p><b>Price:</b> 2 Ticket/s at £ 151.50 each</p>
                                                        <p>Fees &amp; Taxes: £ 39.39 each</p> -->
                                                        <h5>{{__('messages.total')}} : <span class="span_ltr">{{strtoupper($booking['currency_code'])}} {{$booking['total_payment']}}</span></h5>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <div class="ticket_reserved">
                                                        <p> <i class="fas fa-check-circle"></i> E-Tickets</p>
                                                        <p><i class="fas fa-check-circle"></i> Reserved Seats</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6 full_widd padfive">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tick tick_padd">
                                                    <p><span>Listing Notes:</span></p>
                                                    <div class="seller_notes_list">

                                                      
                                         @if(@$booking['ticket_details'])

                                         @php $ticket_details =  explode(",",$booking['ticket_details']); @endphp

                                                        <ul>
                                                         @foreach($ticket_details as $row_details)
                                                        <li>{{$row_details}}</li>
                                                        @endforeach
                                                            
                                                        </ul>
                                                 @endif
                                                    </div>
                                                    <!-- <p><span>Listing Notes:</span></p>
                                                    <div class="seller_notes_list">
                                                        <ul>
                                                            <li>Access to VIP Lounge</li>
                                                            <li>Ticket with meal</li>
                                                            <li>Tickets seated in pairs</li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                                <!-- <div class="ticket_mobile">
                                                    <p>Ticket will be sent to your Email/Mobile</p>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="checkout-order-confirm">
                    <a href="{{url(app()->getLocale())}}">{{__('messages.continue shopping')}}</a>
                </div>

            </div>
        </div>
</section>









@endsection
@push('scripts')

@endpush('scripts')