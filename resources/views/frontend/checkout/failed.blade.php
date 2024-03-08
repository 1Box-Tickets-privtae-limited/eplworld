@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
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
</section>
<!-- Breadcromb Area End -->
 <section class="onebox-checkout-order section_50">
        <div class="container">
            <div class="row">
               <!--  @if (Session::has('error'))
                <div class="alert alert-danger text-center">
                <p>{{ Session::get('error') }}</p>
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
                </div>
                @endif -->
                <div class="col-md-12">
                    <div class="onebox-checkout-order-confirm">
                        @if($booking['booking_status'] == 1)  
                        <div class="order_placed">
                            <p>{{__('messages.dear')}} {{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}},</p>
                            <h3><i class="far fa-check-circle"></i>{{__('messages.your order has been placed')}}!</h3>
                            <p>{{__("messages.thank you for choosing 1BOXOFFICE! an email confirmation on it's way to")}} : <b>{{$booking['email']}}</b> </p>
                            <p>{{__('messages.order number')}} : <span>{{$booking['booking_no']}}</span></p>
                        </div>
                         @endif
                          @if($booking['booking_status'] == 0)  
                        <div class="order_placed">
                            <p>Dear {{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}},</p>
                            <h3><i class="far fa-warning" style="background-color: #f44336;"></i>{{__('messages.your order has been failed')}} !</h3>
                            <p>{{$booking['message']}}</b> </p>
                            <p>{{__('messages.order number')}} : <span>{{$booking['booking_no']}}</span></p>
                        </div>
                         @endif
                          @if($booking['booking_status'] == 2)  
                        <div class="order_placed">
                            <p>Dear {{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}},</p>
                            <h3><i class="far fa-warning" style="background-color: #ffeb3b;"></i>{{__('messages.your order is pending')}} !</h3>
                            <p>{{__("messages.thank you for choosing 1BOXOFFICE! an email confirmation on it's way to")}} : <b>{{$booking['email']}} .</b> </p>
                            <p>{{__('messages.please check your mail frequently for order confirmation')}}. </p>
                            <p>{{__('messages.order number')}} : <span>{{$booking['booking_no']}}</span></p>
                        </div>
                         @endif
                        <div class="order_information">
                            <table>
                            <tr>
                            <th>{{__('messages.order information')}}</th>
                            <th></th>
                            </tr>
                            <tr>
                            <td><b>{{__('messages.customer name')}}:</b></td>
                            <td>{{$booking['buyer_first_name']}} {{$booking['buyer_last_name']}}</td>
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
                            <td><b>{{__('messages.order number')}}:</b></td>  
                            <td>{{$booking['booking_no']}}</td>      
                            </tr>
                           <!--  <tr>
                            <td><b>{{__('messages.confirmation number')}}:</b></td>  
                            <td>{{$booking['booking_confirmation_no']}}</td>      
                            </tr>   -->
                            <tr>
                            <td><b>{{__('messages.payment method')}}:</b></td>  
                            <td>Online payment card processed</td>      
                            </tr>  
                           <!--  <tr>
                            <td><b>{{__('messages.payment txn number')}}:</b></td>  
                            <td>{{$booking['transcation_id']}}</td>      
                            </tr>  --> 
                            <tr>
                            <td><b>{{__('messages.number of tickets')}}:</b></td>
                            <td>{{$booking['quantity']}}</td>
                            </tr>
                            <tr>
                                <td><b>{{__('messages.total charge')}}:</b></td>
                                <td><b>{{strtoupper($booking['currency_code'])}} {{$booking['total_payment']}}</b></td>
                            </tr>
                          <!--   <tr>
                                <td><b>{{__('messages.refund policy apply')}}:</b></td>
                                <td>Yes <i class="fas fa-check" style="color: green;"></i></td>
                            </tr> -->
                            </table>
                        </div>

                        <div class="ticket_information">
                        <table>
                        <tr>
                        <th>{{__('messages.ticket information')}}</th>
                        <th></th>
                        </tr>
                        <tr>
                        <td><b>{{__('messages.event')}}:</b></td>
                        <td>{{$booking['match_name']}}</td>
                        </tr>
                        <tr>
                        <td><b>{{__('messages.ticket category')}}:</b></td>  
                        <td>{{$booking['seat_category']}}</td>      
                        </tr>  
                        <tr>
                        <td><b>{{__('messages.ticket(s)')}}:</b></td>
                        <td>Block: , Row: , <span class="tickets_clr">({{$booking['quantity']}} Ticket(s))</span></td>
                        </tr>
                          @if(@$booking['ticket_details'])
                        <tr>
                            <td><b>{{__('messages.listing note(s)')}}:</b></td>
                            <td> {{$booking['ticket_details']}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><b>{{__('messages.venue')}}:</b></td>
                            <td>{{$booking['stadium_name']}},{{$booking['city_name']}},{{$booking['country_name']}}</td>
                        </tr>
                        <tr>
                            <td><b>{{__('messages.date')}}:</b></td>
                            <td>{{$booking['match_date']}} {{$booking['match_time']}}</td>
                        </tr>
                        </table>
                    </div>
                    
                        <div class="checkout-order-confirm">
                            <a href="{{url(app()->getLocale())}}">{{__('messages.continue shopping')}}</a>
                        </div>

                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<!-- Event snippet for Purchase conversion page --> 
<script> gtag('event', 'conversion', { 'send_to': 'AW-964657763/LzFLCMvR9qoBEOOE_ssD', 'value': 1.0, 'currency': 'GBP', 'transaction_id': '' }); </script>
@endpush('scripts')