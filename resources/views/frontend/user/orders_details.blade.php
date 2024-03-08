@extends('layouts.app')
@section('content')
     

      <!-- Breadcromb Area Start -->

    <section class="onebox-breadcromb-area breadcromb-bg-image">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i>{{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.orders')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h1>{{__('messages.orders')}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->

    

    
 <section class="onebox-my-order-info section_50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="my_orders_heading">
                        <div class="order_head">
                            <h3>{{__('messages.my orders')}}</h3>
                        </div>
                        <div class="order_sub_heading" data-status="{{$results['booking_status']}}">
                  
                            @if($results['booking_status'] == 1 || $results['booking_status'] == 4 || $results['booking_status'] == 5 || $results['booking_status'] == 6)
                            <div class="update_attendees">
                                <a href="{{url(app()->getLocale().'/nominee/')}}/{{md5($results['bg_id'])}}">{{__('messages.update nominee')}}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    

                    <div class="my_orders_detils_all">
                        <div class="my_order_informations">
                            <div class="order_inform">
                                <p>{{__('messages.order information')}}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="my_order_s">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td><b>{{__('messages.order id')}}: </b></td>  
                                                    <td><span class="clr_grey"><a href="">#{{$results['booking_no']}}</a></span></td>  
                                                </tr>
                                                <tr>
                                                    <td><b>{{__('messages.order status')}}:</b></td>  
                                                    <td>@if($results['booking_status'] == 1)
                                 
                                    <span class="">{{__('messages.confirmed')}}</span>
                                
                                @endif
                                  @if($results['booking_status'] == 0)
                                 
                                    <span class="">{{__('messages.failed')}}</span>
                                
                                @endif
                                  @if($results['booking_status'] == 2)
                                 
                                    <span class="">{{__('messages.pending')}}</span>
                                
                                @endif
                                 @if($results['booking_status'] == 3)
                                 
                                    <span class="">{{__('messages.cancelled')}}</span>
                                
                                @endif
                                @if(count($active_tickets) > 0)
                                 @if($results['booking_status'] == 4)
                                 
                                    <span class="">{{__('messages.shipped')}}</span>
                                
                                @endif
                                 @if($results['booking_status'] == 5 || $results['delivery_status'] == '6')
                                 
                                    <span class="">{{__('messages.delivered')}}</span>
                                
                                @endif
                                 @if($results['booking_status'] == '6')
                                 
                                    <span class="">{{__('messages.downloaded')}}</span>
                                
                                @endif
                                 @if($results['booking_status'] == '7')
                                 
                                    <span class="">{{__('messages.not_initiated')}}</span>
                                
                           
                                @endif @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="order_s">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td><b>{{__('messages.order date and time')}}:</b></td>
                                                    <td>{{\Carbon\Carbon::parse($results['payment_date'])->format('d F Y')}} </td>           
                                                </tr>
                                                <tr>
                                                    <td><b>{{__('messages.ticket format')}}: </b></td>
                                                   @if(!$mobile)
                           @if($results['ticket_type'] == 1)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.season cards status')}}</td>
                           
                              @elseif($results['ticket_type'] == 2)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.e-tickets')}}</td>
                            
                              @elseif($results['ticket_type'] == 3)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.paper status')}}</td>
                            
                              @elseif($results['ticket_type'] == 4)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.mobile')}}</td>
                            @endif
                             @endif

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="order_s">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td><b>{{__('messages.ticket delivery date')}}:</b></td>
                                                    <td>@if($results['tbc_status'])
                                {{$results['tbc_status']}}
                            @else {{date('d F Y', strtotime('-1 day', strtotime($results['match_date'])))}}@endif</td>           
                                                </tr>
                                                <tr>
                                                    <td><b>{{__('messages.ticket status')}}:</b></td>
                                                    <td data-label=""> @if($results['ticket_type'] == 2 && count($active_tickets) > 0)

                        @if(($results['delivery_status'] == 2 || $results['delivery_status'] == 4 || $results['delivery_status'] == 5 || $results['delivery_status'] == 6) && ($results['booking_status'] != 0 && $results['booking_status'] != 3 && $results['booking_status'] != 7))
                       
                        <a href="{{url(app()->getLocale())}}/download/{{md5($results['booking_no'])}}"><span class="clrbs">Download Tickets</span></a>
                        <input type="hidden" name="test" value="<?php echo count($active_tickets);?>">
                        @endif
                        @if(($results['delivery_status'] == 0 || $results['delivery_status'] == 1) && ($results['booking_status'] == 1 || $results['booking_status'] == 2 || $results['booking_status'] == 4) )
                        <span class=""><a href="#">{{__('messages.processing')}}</a></span>
                         @endif
                          @if(($results['booking_status'] == 0 || $results['booking_status'] == 3 || $results['booking_status'] == 7))
                          Not available
                         <!-- <span class="clrbs"><a href="#">{{__('messages.not available')}}</a></span> -->
                           @endif
                           @else
                            @if(($results['booking_status'] == 1 || $results['booking_status'] == 2 || $results['booking_status'] == 4) )
                        <span class=""><a href="#">{{__('messages.processing')}}</a></span>
                         @endif
                          @if(($results['booking_status'] == 0 || $results['booking_status'] == 3 || $results['booking_status'] == 7 || $results['delivery_status'] == '6'))
                        <!--   {{__('messages.not available')}} -->
                         <!-- <span class="clrbs"><a href="#">{{__('messages.not available')}}</a></span> -->
                           @endif
                       
                            @endif</td>          
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my_order-details">
                            <div class="tick_inform">
                                <p>{{__('messages.ticket information')}}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-8 full_widd"> 
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="my_order-img">
                                                <img src="{{$results['team_image_a']}}" alt="">
                                                <img src="{{$results['team_image_b']}}" alt="">
                                            </div>                
                                        </div>
                                        <div class="col-md-9">
                                            <div class="my_order-tickets-content">
                                                <a href="#"><h2>{{$results['match_name']}}</h2></a>
                                                <p>{{$results['tournament_name']}}</p>
                                                <div class="popular-date-time">@if($results['tbc_status'])
                                                {{$results['tbc_status']}}
                                                @else
                                                {{\Carbon\Carbon::parse($results['match_date'])->format('d F Y')}} | 
                                                {{$results['match_time']}} 
                                                @endif </div>
                                                <p>{{$results['country_name']}},{{$results['city_name']}}</p>
                                                <div class="e_tickets">
                                                    <h6>{{$results['seat_category']}}</h6>
                                                    <ul>
                                                    <li><div class="ticket-sub-block tick_text"><b>Block</b> : {{$results['ticket_block'] ?  $results['ticket_block'] : "NA"}} </div>
                                                    </li><li><div class="ticket-sub-block tick_text"><b>Row</b> : {{$results['row'] ? $results['row'] :  "NA"}} </div></li>
                                                    </ul>
                                                </div>
                                                <div class="seller_note_s">@if(@$results['ticket_notes'])
                                                    <ul>

                                             @foreach(@$results['ticket_notes'] as $row)
                                                        <li><div class="tick tick_padd"><i class="fas fa-caret-right"></i> {{$row['text']}}</div></li>
                                                         @endforeach
                                                    </ul>
                                                    @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 padfive full_widd">
                                    <div class="order_status_all">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td><b>{{__('messages.payment status')}}: </b></td>
                                                   
                                                    @if($results['payment_status'] == 0)
                                                    <td data-label="Order:">
                                                   {{__('messages.failed')}}
                                                    </td>
                                                    @endif
                                                    @if($results['payment_status'] == 1)
                                                    <td data-label="Order:">
                                                   {{__('messages.success')}}
                                                    </td>
                                                    @endif
                                                    @if($results['payment_status'] == 2)
                                                    <td data-label="Order:">
                                                    {{__('messages.pending')}}
                                                    </td>
                                                    @endif
                                                    @if($results['payment_status'] == 3)
                                                    <td data-label="Order:">
                                                    {{__('messages.reversed')}}
                                                    </td>
                                                    @endif
                                                    @if($results['payment_status'] == 4)
                                                    <td data-label="Order:">
                                                    {{__('messages.canceled')}}
                                                    </td>
                                                    @endif       
                                                </tr>
                                                <tr>
                                            <td><b>{{__('messages.transaction amount')}}</b></td>
                                            <td><span dir="ltr">
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                                <i class="fas fa-pound-sign"></i>
                                                @endif
                                                @if(strtoupper($results['currency_type']) == 'EUR')
                                                <i class="fas fa-euro-sign"></i>
                                                @endif
                                                @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                                {{$results['currency_type']}}
                                                @endif
                                                    {{number_format($results['total_payment'],2)}}</span></td>
                                                <tr>
                                        <td><b>{{__('messages.price')}}</b></td>
                                        <td><span dir="ltr">
                                        @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['price'],2)}} </span></td>
                                    </tr>
                                    <tr>
                                        <td><b>{{__('messages.quantity')}}</b></td>
                                        <td><span class="qty">{{$results['quantity']}}</span></td>
                                    </tr>
                                    <tr>
                                        <td> <b>{{__('messages.total')}}</b></td>
                                        <td><span dir="ltr">
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['ticket_amount'],2)}}</span></td>
                                    </tr>
                                     <tr>
                                        <td><b>{{__('messages.taxes/fee')}}</b></td>
                                        <td><span dir="ltr">
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['partner_fee'] + $results['store_fee'],2)}} </span></td>
                                    </tr>
                                    <tr>
                                        <td><b>{{__('messages.sub total')}}</b></td>
                                        <td><span dir="ltr">
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i>
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['total_amount'],2)}} </span></td>
                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

             

@endsection
@push('scripts')
<script type="text/javascript">

</script>
@endpush('scripts')