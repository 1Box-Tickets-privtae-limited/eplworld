@extends('layouts.app')
@section('content')
     

         <!-- Breadcromb Area Start -->
    <section class="onebox-breadcromb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.orders')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->
    

    
 <section class="onebox-order-info section_50">
        <div class="container">
            <div class="">
                <div class="sub_heading">
                    <div class="onebox-order-heading">
                        <h2>{{__('messages.order')}} <span>{{__('messages.info')}}</span></h2>
                    </div>
                    
                    <div class="sub_head">

                        <a href="{{url(app()->getLocale().'/nominee/')}}/{{md5($results['bg_id'])}}">{{__('messages.update nominee')}}</a>
                    </div>
                </div>
            </div>

             <h3>{{__('messages.order information')}}</h3>
            <div class="">

                <div class="table_section" id="no-more-tables">
                   <table class="toptable res_table_new table-responsive">
                        <tbody>
                            <tr class="accordion">
                                <th>{{__('messages.order id')}}</th>
                                <th>{{__('messages.confirmation id')}}</th>
                                <th>{{__('messages.order status')}}</th>
                                <th>{{__('messages.order date and time')}}</th>
                                <th>{{__('messages.ticket format')}}</th>
                                 @if(count($active_tickets) > 0)<th>{{__('messages.e-tickets')}}</th>
                                 @endif
                            </tr>
                            <tr>
                                <td data-label="{{__('messages.order id')}}:">
                                    <span class="order_id">#{{$results['booking_no']}}</span>
                                </td>
                                 <td data-label="{{__('messages.confirmation id')}}:">
                                    <span class="order_id">{{$results['booking_confirmation_no'] ? "#".$results['booking_confirmation_no']  : "NA"}}</span>
                                </td>
                                @if($results['booking_status'] == 1)
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.confirmed')}}</span>
                                </td>
                                @endif
                                  @if($results['booking_status'] == 0)
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.failed')}}</span>
                                </td>
                                @endif
                                  @if($results['booking_status'] == 2)
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.pending')}}</span>
                                </td>
                                @endif
                                 @if($results['booking_status'] == 3)
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.cancelled')}}</span>
                                </td>
                                @endif
                                 @if($results['booking_status'] == 4)
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.shipped')}}</span>
                                </td>
                                @endif
                                 @if($results['booking_status'] == 5)
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.delivered')}}</span>
                                </td>
                                @endif
                                 @if($results['booking_status'] == '6')
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.downloaded')}}</span>
                                </td>
                                @endif
                                 @if($results['booking_status'] == '7')
                                 <td data-label="{{__('messages.order status')}}:">
                                    <span class="">{{__('messages.not_initiated')}}</span>
                                </td>
                                @endif
                                <!-- <td data-label="Delivery Status:">
                                    <i class="fas fa-cloud-download-alt"></i> Downloaded
                                </td> -->
                                <td data-label="{{__('messages.order date and time')}}:">
                                    <span class="tr_date">
                                    <i class="fas fa-calendar-week"></i>{{\Carbon\Carbon::parse($results['payment_date'])->format('d/m/Y')}} </span>
                                    <span class="tr_date">
                                    <i class="fas fa-clock"></i>{{\Carbon\Carbon::parse($results['payment_date'])->format('h:m:s')}} </span>
                                </td>
                           @if($results['ticket_type'] == 1)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.season cards status')}}</td>
                           
                              @elseif($results['ticket_type'] == 2)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.e-tickets')}}</td>
                            
                              @elseif($results['ticket_type'] == 3)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.paper status')}}</td>
                            
                              @elseif($results['ticket_type'] == 4)
                              <td data-label="{{__('messages.e-tickets')}}:">{{__('messages.mobile')}}</td>
                          
                             @endif

<!-- 
                             elseif($etickets[0]['ticket_file'] == '')
                                <td data-label="">{{__('messages.not available')}}</td> -->

                             @if(count($active_tickets) > 0)
                                <td data-label="" style="cursor: pointer;"><span class="clrb"><a href="{{url(app()->getLocale())}}/download/{{md5($results['booking_no'])}}">Download ({{count($active_tickets)}} / {{$results['quantity']}} Tickets)</a></span></td>
                             @endif
                        <!--   @if(count($active_tickets) <= 0)
                          <td style="cursor: pointer;">{{__('messages.not available')}}</td>
                           @endif -->

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h3>{{__('messages.ticket information')}}</h3>
            <div class="">

                <div class="table_section" id="no-more-tables">
                    <table class="toptable res_table_new table-responsive">
                        <tbody>
                            <tr class="accordion">
                                <th>{{__('messages.statdium')}}</th>
                                <th>{{__('messages.section')}}</th>
                                <th>{{__('messages.row')}}</th>
                                <th>{{__('messages.block')}}</th>
                                <th>{{__('messages.price')}}</th>
                                <th>{{__('messages.quantity')}}</th>
                                <th>{{__('messages.total')}}</th>
                            </tr>
                            <tr>
                                <td data-label="{{__('messages.statdium')}}:">
                                   {{$results['stadium_name']}}
                                </td>
                                 <td data-label="{{__('messages.section')}}:">
                                   {{$results['seat_category']}}
                                </td>
                                 <td data-label="{{__('messages.row')}}:">
                                   {{$results['row'] ? $results['row'] :  "NA"}}
                                </td>
                                 <td data-label="{{__('messages.block')}}:">
                                   {{$results['block_id'] ?  $results['block_id'] : "NA"}}
                                </td>
                                <td data-label="{{__('messages.price')}}:">
                                    @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif {{number_format($results['price'],2)}} 
                                </td>
                                <td data-label="{{__('messages.quantity')}}:">
                                   {{$results['quantity']}}
                                </td>
                                 <td data-label="{{__('messages.total')}}:">
                                    @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif

                                   {{number_format($results['sub_total'],2)}} 
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-6">
                   
                    <div class="status_item">
                         <h3>{{__('messages.ticket information')}}</h3>
                        <div class="details">
                            <div class="col-md-5">
                                <div class="img">
                                 <img src="{{url('/')}}/{{str_replace('/uploads/stadium/','',$results['stadium_map']) }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                            <h4>{{$results['match_name']}}</h4>
                            <p>{{$results['country_name']}},{{$results['city_name']}}</p>
                            <p>
                            <span class="tr_date">
                            <i class="fas fa-calendar-week"></i>{{$results['match_date']}} </span>
                            <span class="tr_date">
                            <i class="fas fa-clock"></i>{{$results['match_time']}} </span>
                            </p>
                            <!-- <p>
                            <span class="">Code : 7903</span>
                            </p>
                            <p>
                            <span class="">Section: 2</span>
                            </p> -->

                            <p>{{__('messages.block')}}: <?php 
                                        if($results['ticket_block'] != 0){
                                        echo $results['block_id'];
                                        }
                                        else{
                                        echo "Any";
                                        }
                                        ?></p>
                            <p>
                            <span class="">{{__('messages.section')}}: {{$results['seat_category']}}</span>
                            </p>
                            @if(@$results['ticket_notes'])
                            <p>
                              <span class="">{{__('messages.seller note')}}:  
                                @foreach(@$results['ticket_notes'] as $row)
                                <img src="{{$row['icon']}}"  style="width: 24px" height="14px" alt=""> {{$row['text']}} <br>
                                @endforeach
                              </span>
                             </p>
                              @endif

                            <table>
                                <tbody>
                                    <tr>
                                        <td>{{__('messages.price')}}</td>
                                        <td>
                                        @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['price'],2)}} </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('messages.quantity')}}</td>
                                        <td>{{$results['quantity']}}</td>
                                    </tr>
                                    <tr>
                                        <td> {{__('messages.total')}}</td>
                                        <td>
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['ticket_amount'],2)}}</td>
                                    </tr>
                                     <tr>
                                        <td>{{__('messages.taxes/fee')}}</td>
                                        <td>
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['seller_fee'] + $results['store_fee'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('messages.sub total')}}</td>
                                        <td>
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                    <i class="fas fa-pound-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) == 'EUR')
                                    <i class="fas fa-euro-sign"></i> 
                                    @endif
                                    @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                    {{$results['currency_type']}}
                                    @endif
                                        {{number_format($results['total_amount'],2)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>

                        
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   
                    <div class="tick_info">
                         <h3>{{__('messages.payment information')}}</h3>
                        <div class="details">
                            <table>
                                    <tbody>
                                        <tr>
                                            <td>{{__('messages.payment status')}}</td>
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
                                            <td>{{__('messages.transaction id')}}</td>
                                            <td>{{$results['transcation_id']}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('messages.transaction amount')}}</td>
                                            <td>
                                            @if(strtoupper($results['currency_type']) == 'GBP')
                                        <i class="fas fa-pound-sign"></i> 
                                        @endif
                                        @if(strtoupper($results['currency_type']) == 'EUR')
                                        <i class="fas fa-euro-sign"></i> 
                                        @endif
                                        @if(strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                        {{$results['currency_type']}}
                                        @endif
                                            {{number_format($results['total_payment'],2)}}</td>
                                        </tr>
                                    </tbody>
                            </table>
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