@if(count($results))
    @foreach($results as $list)   
   @php //pr($list);@endphp
    @php 
        $quantity = $list['quantity'];
        $quantity2 = $list['quantity'];
    @endphp
    
    <div > 
        <form action="{{url('add-to-cart')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div   id="seatid-2964" data-ticketcategory="{{$list['ticket_category']}}" data-quantity="{{$quantity}}" data-class="{{$list['ticket_category']}}" map-id="" color-code="{{$list['block_color']}}" currency-price="0.00" class="seat_select_items  seat_select_block_items field {{$list['ticket_category']}}" data-target="{{$list['ticket_category']}}" data-blockid="0" data-matchid="{{$list['match_id']}}"   onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)" >
                <div class="col-md-4 pad_five">
                    <div class="tick_all_items">
                        <div class="tick_head">{{__('messages.location')}}</div>
                        <div class="tick_tier">{{$list['seat_category']}} <i class="fas fa-file-pdf"></i></div>
                        <div class="tick_text"><i class="fas fa-badge-dollar"></i> {{__('messages.this ticket is below market price')}}</div>
                    </div>
                </div>
                <div class="col-md-3 pad_five">
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
                <div class="col-md-1 pad_five">
                    <div class="tick_price">
                        <div class="tick_head">{{__('messages.price')}}</div>
                        <div class="tick_price_range">{{$list['currency_symbol'].' '.$list['price']}}</div>
                    </div>
                </div>
                <div class="col-md-4 pad_five">
                    <div class="tick_buy">
                        <div class="tick_view"><i class="fas fa-eye"></i> {{@$list['view_now']}} {{__('messages.viewing now')}}</div>
                            <input type="hidden" value="{{base64_encode($list['match_id'])}}" name="match_id"/>
                            <input type="hidden" value="{{base64_encode($list['s_no'])}}" name="sell_ticket_id"/>
                            <input type="hidden" value="{{base64_encode($list['stadium_id'])}}" name="stadium_id"/>
                            <div class="tick_book_btn"><button type="submit">{{__('messages.buy')}}</button></div>
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