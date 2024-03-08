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
                            <li>{{__('messages.order')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->
    

    
 <section class="onebox-your-orders section_50">
        <div class="container">
            <div class="">
                    <div class="onebox-section-heading">
                        <h2> <span>{{__('messages.your orders')}}</span></h2>
                    </div>
            </div>
            <div class="">
                <div class="tab_sec orders" id="no-more-tables">
                      @if(@$results)
                <table class="toptable res_table_new table-responsive">
                  <tbody>
                    <tr class="accordion">
                      <th>{{__('messages.order no')}}</th>
                      <th>{{__('messages.event')}}</th>
                      <!-- <th>{{__('messages.ticket format')}}</th> -->
                      <th>{{__('messages.section')}}</th>
                      <th>{{__('messages.quantity')}}</th>
                      <th>{{__('messages.price')}}</th>
                      <th>{{__('messages.transaction date')}}</th>
                      <th>{{__('messages.status')}}</th>
                      <th>{{__('messages.e-tickets')}}</th>
                      <th>&nbsp;</th>
                    </tr>
                    
                  
                    @foreach($results as $row)

                    <tr class="row_clickable" data-href="{{url(app()->getLocale())}}/orders/{{md5($row['booking_no'])}}" style="cursor:pointer;">
                      <td data-label="{{__('messages.order no')}}:"><span class="order">#{{$row['booking_no']}}</span></td>
                      <td data-label="{{__('messages.event')}}:">
                        <div class="imagg"><img src="{{$row['team_image_a']}}">
                        <img src="{{$row['team_image_b']}}"></div>
                        <div class="txtt">
                        {{$row['match_name']}} <br> {{$row['country_name']}} ,{{$row['city_name']}}<br><span class="tr_date"><i class="fas fa-calendar-week"></i>{{\Carbon\Carbon::parse($row['match_date'])->format('d/m/Y')}} </span>&nbsp;<span class="tr_date"><i class="fas fa-clock"></i>{{$row['match_time']}}</span> 
                        </div>
                      </td>
                      <!-- @if($row['ticket_type'] == 1)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.season cards status')}}</td>
                      @endif
                      @if($row['ticket_type'] == 2)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.e-tickets')}}</td>
                      @endif
                      @if($row['ticket_type'] == 3)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.paper status')}}</td>
                      @endif
                      @if($row['ticket_type'] == 4)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.mobile')}}</td>
                      @endif
                       @if($row['ticket_type'] == '')
                      <td data-label="{{__('messages.ticket format')}}:"></td>
                      @endif
  -->           @if($mobile != 1)          
               <td data-label="{{__('messages.section')}}:">{{$row['seat_category']}} </td>
               @endif
                      <td data-label="{{__('messages.quantity')}}:">{{$row['quantity']}} </td>
                      <td data-label="{{__('messages.price')}}:">
                        <span class="ltr"><b>
                        @if(strtoupper($row['currency_type']) == 'GBP')
                         <i class="fas fa-pound-sign"></i> 
                         @endif
                         @if(strtoupper($row['currency_type']) == 'EUR')
                        <i class="fas fa-euro-sign"></i> 
                         @endif
                          @if(strtoupper($row['currency_type']) != 'GBP' && strtoupper($row['currency_type']) != 'EUR')
                        {{$row['currency_type']}}
                         @endif
                          {{number_format($row['total_amount'],2)}} 
                     </b></span></td>
                      <td data-label="{{__('messages.transaction date')}}:">{{$row['updated_at']}} </td>
                      @if($row['booking_status'] == 0)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.failed')}}</td>
                      @endif
                      @if($row['booking_status'] == 1)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.confirmed')}}</td>
                      @endif
                      @if($row['booking_status'] == 2)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.pending')}}</td>
                      @endif 
                      @if($row['booking_status'] == 3)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.cancelled')}}</td>
                      @endif
                      @if($row['booking_status'] == 4)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.shipped')}}</td>
                      @endif
                      @if($row['booking_status'] == 5)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.delivered')}}</td>
                      @endif
                      @if($row['booking_status'] == 6)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.downloaded')}}</td>
                      @endif
                      @if($row['booking_status'] == 7)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.not_initiated')}}</td>
                      @endif
                      @if($mobile != 1) 
                    <td data-label="{{__('messages.e-tickets')}}:" style="cursor: pointer;">
                          @if($row['ticket_type'] == 2)

                        @if(($row['delivery_status'] == 2 || $row['delivery_status'] == 4 || $row['delivery_status'] == 5 || $row['delivery_status'] == 6) && ($row['booking_status'] != 0 && $row['booking_status'] != 3 && $row['booking_status'] != 7))
                        <a href="{{url(app()->getLocale())}}/download/{{md5($row['booking_no'])}}"><span class="clrbs">Download Tickets</span></a>
                        @endif
                        @if(($row['delivery_status'] == 0 || $row['delivery_status'] == 1) && ($row['booking_status'] == 1 || $row['booking_status'] == 2 || $row['booking_status'] == 4) )
                        <span class="clrbs"><a href="#">{{__('messages.processing')}}</a></span>
                         @endif
                          @if(($row['booking_status'] == 0 || $row['booking_status'] == 3 || $row['booking_status'] == 7))
                          Not available
                         <!-- <span class="clrbs"><a href="#">{{__('messages.not available')}}</a></span> -->
                           @endif
                           @else
                            @if(($row['booking_status'] == 1 || $row['booking_status'] == 2 || $row['booking_status'] == 4) )
                        <span class="clrbs"><a href="#">{{__('messages.processing')}}</a></span>
                         @endif
                          @if(($row['booking_status'] == 0 || $row['booking_status'] == 3 || $row['booking_status'] == 7))
                          {{__('messages.not available')}}
                         <!-- <span class="clrbs"><a href="#">{{__('messages.not available')}}</a></span> -->
                           @endif
                       
                            @endif
                    </td>
                     @endif
                      <td  style="cursor: pointer;">
                        <a href="{{url(app()->getLocale())}}/orders/{{md5($row['booking_no'])}}">
                            <button class="btn_desk">{{__('messages.order details')}}</button>
                            <!-- <i class="fas fa-angle-double-right"></i> --><!-- <button class="btn_mobile">{{__('messages.view detail')}}</button> --></a></td>
                    </tr>
                    
                    @endforeach
                    
                    
                  </tbody>
                </table>
                 @else
                 <div>
                       <h3>{{__('messages.no orders available')}}</h3>
                    </div>
                    @endif
            </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
<script type="text/javascript">

</script>
@endpush('scripts')