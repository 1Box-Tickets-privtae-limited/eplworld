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
                <div class="col-md-4 col-sm-3 col-xs-3 pad_five full_widd_50 full_widd">
                    <div class="tick_all_items">
                        <div class="tick_head">{{__('messages.location')}}</div>
                        <div class="tick_tier">{{$list['seat_category']}}
                        @if($list['ticket_type']  ==2 ) <i class="fas fa-file-pdf"></i>@endif</div>
                        <div class="tick_text"><i class="fas fa-badge-dollar"></i> {{__('messages.this ticket is below market price')}}</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 pad_five full_widd_50 full_widd">
                    <div class="tick_quan">
                        <div class="tick_head">{{__('messages.quantity')}}</div>
                        <div class="quan">

                           
                            <select name="quantity" class="form-control">
                                @if($list['split'] ==2)
                                     <option value="{{$quantity}}">{{$quantity}}</option>

                                @elseif($list['split'] ==4)
                                    @php $i = 0; $quantity2 = 0; @endphp
                                    @for ($i = 1; $i < $quantity + 1; $i++)

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
                        @if($quantity2 <= 5)
                            <div class="tick_text"><span>{{$quantity2}} {{__('messages.tickets remaining')}}</span></div>
                        @endif
                    </div>
                </div>
                <div class="col-md-1 col-sm-2 col-xs-2 pad_five full_widd_50 full_widd">
                    <div class="tick_price">
                        <div class="tick_head">{{__('messages.price')}}</div>
                        <div class="tick_price_range"><span class="span_ltr">{{$list['currency_symbol'].' '.$list['price']}}</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 full_widd_50 pad_five full_widd">
                    <div class="tick_buy">
                        <div class="tick_view"><i class="fas fa-eye"></i> {{@$list['view_now']}} {{__('messages.viewing now')}}</div>
                            <input type="hidden" value="{{base64_encode($list['match_id'])}}" name="match_id"/>
                            <input type="hidden" value="{{base64_encode($list['s_no'])}}" name="sell_ticket_id"/>
                            <input type="hidden" value="{{base64_encode($list['stadium_id'])}}" name="stadium_id"/>
                            <div class="tick_book_btn"><button type="button" data-id="{{$key}}" class="add_to_cart_button">{{__('messages.buy')}}</button></div>
                        <div class="tick_text"><span>{{__('messages.someone just booked a ticket')}}!</span></div>
                    </div>
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