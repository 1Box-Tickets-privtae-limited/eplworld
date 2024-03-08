<style type="text/css">
    .show-more-height { 
      height: 45px;
      overflow:hidden; 
    }
</style>

@if(count($results))
    @foreach($results as  $key => $list)   
   @php //pr($list);@endphp
    @php 
        $quantity = $list['quantity'];
        $quantity2 = $list['quantity'];
    @endphp
    
    <div > 
        <form action="{{url(app()->getLocale().'/add-to-cart')}}" method="post" class="add_to_cart" id="add_to_cart_{{$key}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div   id="seatid-2964" data-ticketcategory="{{$list['ticket_category']}}" data-quantity="{{$quantity}}" data-class="{{$list['ticket_category']}}" map-id="" color-code="{{$list['block_color']}}" currency-price="0.00" class="seat_select_items  seat_select_block_items field {{$list['ticket_category']}}" data-target="{{$list['ticket_category']}}" data-blockid="0" data-matchid="{{$list['match_id']}}"   onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)" >
                <div class="col-md-3 col-sm-3 col-xs-4 full_widd_price pad_five ">
                    <div class="tick_all_items">
                        <div class="tick_head">{{__('messages.location')}}</div>
                        <div class="tick_tier">{{$list['seat_category']}}
                       
                          
                       </div>
                        @if(@$list['ticket_type_image'])
                           <div class="tick_text"> <img src="{{$list['ticket_type_image']}}" alt="" width="24px" /> {{$list['ticket_type_name']}}</div>
                           @endif
                           @if(@$list['home_town'])
                           <div class="tick_text">@php
                            if ($list['home_town'] == '0') {
                            $section=  "Any";
                            }
                            else if ($list['home_town'] == '1') {
                            $section=  "Home";
                            }
                            else if ($list['home_town'] == '2') {
                            $section=  "Away";
                            }
                            else{
                            $section=  $list['home_town'];
                            } @endphp
                            {{$section}} {{__('messages.section')}}</div>
                           @endif
                       <!--  <div class="tick_text"><i class="fas fa-badge-dollar"></i> {{__('messages.this ticket is below market price')}}</div> -->
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-4 full_widd_price pad_five">
                    <div class="tick_quan">
                        <div class="tick_head">{{__('messages.quantity')}}</div>
                        <div class="quan select">

                         
                            <select name="quantity" class="form-control">
                                @if($list['split'] == 2)
                                @php $quantity2 = 100 @endphp
                                     <option value="{{$quantity}}">{{$quantity}}</option>
                                @elseif($list['split'] == 3)

                                    @php $i = 0; $quantity2 = 0;
                                        if ($quantity % 2 != 0) { $quantity2++; @endphp
                                         <option value="1">1</option>
                                        @php } @endphp
                                    @for ($i = 1; $i <= $quantity; $i++)
                                        @if($i % 2 === 0)
                                            @php $quantity2++;@endphp
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endif
                                    @endfor

                                @elseif($list['split'] ==4)

                                    @php $i = 0; $quantity2 = 0; @endphp
                                    @for ($i = 1; $i <= $quantity; $i++)
                                        @if($i % 2 === 0)
                                            @php $quantity2++;@endphp
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endif
                                    @endfor

                                @else
                                    @for($i=1;$i<=$quantity;$i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                        <!-- @if($quantity2 <= 10)
                            <div class="tick_text"><span>{{$quantity2}} {{__('messages.tickets remaining')}}</span></div>
                        @endif
 -->
                        
                    </div>

                     @if($quantity <= 10)
                            <div class="tick_text remaining-count"><span>{{$quantity}} {{__('messages.tickets remaining')}}</span></div>
                        @endif
                </div>
                <div class="col-md-6 col-sm-6 col-xs-4 full_widd_price pad_five">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="tick_price">
                                <div class="tick_head">{{__('messages.price')}}</div>
                                <div class="tick_price_range"><span class="span_ltr">{{$list['currency_symbol'].' '.$list['price']}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="tick_buy">
                                 <div class="tick_view hidden-xs"> &nbsp;<!--  <i class="fas fa-eye"></i> {{@$list['view_now']}} {{__('messages.viewing now')}}--></div> 
                                        <input type="hidden" value="{{base64_encode($list['match_id'])}}" name="match_id"/>
                                        <input type="hidden" value="{{base64_encode($list['s_no'])}}" name="sell_ticket_id"/>
                                        <input type="hidden" value="{{base64_encode($list['stadium_id'])}}" name="stadium_id"/>
                                        <div class="tick_book_btn"><button type="button" data-id="{{$key}}" class="add_to_cart_button">{{__('messages.buy')}}</button></div>
                                       @if(@$list['view_now'] > 450)
                                    <div class="tick_text"><span>{{__('messages.someone just booked a ticket')}}!</span></div>@endif
                                </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-4  pad_five">
                    
                </div> -->
                
            </div>
            
              
            <div class="col-md-12 nopad main_parent">
                    <div class="meal_package ">
                        <div class="show-more-height show-more-list">
                        @if(count($list['ticket_details'])) 
                          @foreach($list['ticket_details'] as $row)
                        <div class="col-md-4 col-xs-6 pad_five full_widd">
                            <div class="tick">
                                <img src="{{$row['ticket_image']}}">
                                <h5 for="vehicle1">{{$row['ticket_name']}}</h5>
                            </div>
                        </div>
                         @endforeach
                           @endif
                       </div>
                     @if(count($list['ticket_details']) > 3)    <div class="show-more">{{__('messages.show more')}} + </div>
                     @endif
                    </div>
                    
                </div>
               
          
        </form> 
    </div>
    @endforeach
@else
    <div class="seat_select_block_items">
        There Are No Tickets Matching Your Criteria
    </div>
@endif