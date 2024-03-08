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
                        <h2>{{__('messages.your')}} <span>{{__('messages.orders')}}</span></h2>
                    </div>
            </div>
            <div class="">
                <div class="tab_sec orders" id="no-more-tables">
                      @if(@$results)
                <table class="toptable res_table_new table-responsive">
                  <tbody>
                    <tr class="accordion">
                      <th>{{__('messages.order')}} #</th>
                      <th>{{__('messages.event')}}</th>
                      <th>{{__('messages.ticket format')}}</th>
                      <th>{{__('messages.tickets type')}}</th>
                      <th>{{__('messages.qty')}}</th>
                      <th>{{__('messages.price')}}</th>
                      <th>{{__('messages.transaction date')}}</th>
                      <th>{{__('messages.status')}}</th>
                      <th>&nbsp;</th>
                    </tr>
                    
                  
                    @foreach($results as $row)

                    <tr>
                      <td data-label="Order:"><span class="order">#{{$row['booking_no']}}</span></td>
                      <td data-label="Transaction date:">{{$row['match_name']}} <br> {{$row['country_name']}} ,{{$row['city_name']}}<br><span class="tr_date"><i class="fas fa-calendar-week"></i>{{\Carbon\Carbon::parse($row['match_date'])->format('d/m/Y')}} </span>&nbsp;<span class="tr_date"><i class="fas fa-clock"></i>{{$row['match_time']}}</span> </td>
                      @if($row['ticket_type'] == 1)
                      <td data-label="Payment Status:">{{__('messages.season cards status')}}</td>
                      @endif
                      @if($row['ticket_type'] == 2)
                      <td data-label="Payment Status:">{{__('messages.e-tickets')}}</td>
                      @endif
                      @if($row['ticket_type'] == 3)
                      <td data-label="Payment Status:">{{__('messages.paper status')}}</td>
                      @endif
                      @if($row['ticket_type'] == 4)
                      <td data-label="Payment Status:">{{__('messages.mobile')}}</td>
                      @endif
                       @if($row['ticket_type'] == '')
                      <td data-label="Payment Status:"></td>
                      @endif
                      <td data-label="Buyer Name:">{{$row['seat_category']}} </td>
                      <td data-label="Buyer Name:">{{$row['quantity']}} </td>
                      <td data-label="Order Total:"><b>
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
                     </b></td>
                      <td data-label="Buyer Name:">{{$row['updated_at']}} </td>
                      @if($row['booking_status'] == 0)
                      <td data-label="Payment Status:">{{__('messages.failed')}}</td>
                      @endif
                      @if($row['booking_status'] == 1)
                      <td data-label="Payment Status:">{{__('messages.confirmed')}}</td>
                      @endif
                      @if($row['booking_status'] == 2)
                      <td data-label="Payment Status:">{{__('messages.pending')}}</td>
                      @endif 
                      @if($row['booking_status'] == 3)
                      <td data-label="Payment Status:">{{__('messages.cancelled')}}</td>
                      @endif
                      @if($row['booking_status'] == 4)
                      <td data-label="Payment Status:">{{__('messages.shipped')}}</td>
                      @endif
                      @if($row['booking_status'] == 5)
                      <td data-label="Payment Status:">{{__('messages.delivered')}}</td>
                      @endif
                      @if($row['booking_status'] == 6)
                      <td data-label="Payment Status:">{{__('messages.downloaded')}}</td>
                      @endif
                      @if($row['booking_status'] == 7)
                      <td data-label="Payment Status:">{{__('messages.not_initiated')}}</td>
                      @endif
                      <td data-label="View Details:" style="cursor: pointer;">
                        <a href="{{url(app()->getLocale())}}/orders/{{md5($row['booking_no'])}}"><i class="fas fa-angle-double-right"></i><button class="btn_mobile">Click Here</button></a></td>
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