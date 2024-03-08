@if(count($results))
    @foreach($results as  $key => $list)   
   @php //pr($list);@endphp
    @php 
        $quantity = $list['quantity'];
        $quantity2 = $list['quantity'];
    @endphp
<form action="{{url(app()->getLocale().'/add-to-cart')}}" method="post" class="add_to_cart" id="add_to_cart_{{$key}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="seat_select_items  seat_select_block_items {{$list['ticket_category']}}"  id="seatid-2964" data-ticketcategory="{{$list['ticket_category']}}" data-quantity="{{$quantity}}" data-class="{{$list['ticket_category']}}" map-id="" color-code="{{$list['block_color']}}" currency-price="0.00" class="seat_select_items  seat_select_block_items field {{$list['ticket_category']}}" data-target="{{$list['ticket_category']}}" data-blockid="{{@$list['block_id']? $list['block_id'] : 0 }}" data-matchid="{{$list['match_id']}}"  data-full-block-id="{{@$list['full_block_name']? $list['full_block_name'] : 0 }}" onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)" >
    <div class="row" >

        @if(@$list['view_now'] > 450)
        <div class="col-md-12 nopad">
            <div class="tick_text txt-rit"><span>{{__('messages.someone just booked a ticket')}}!</span></div>
        </div>    
        @endif

       
        <div class="col-md-5 col-sm-4 col-xs-12 full_widd_pricess pad_five_new_1">
            <div class="col-md-12 col-sm-12 col-xs-7 no_padds fl_widt no_padd_s">
                <div class="tick_all_items">
                    <div class="tick_head">{{__('messages.location')}}</div>
                    <div class="tick_tier" style="color: {{$list['block_color']}};">{{$list['seat_category']}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-8 col-xs-12 full_widd_pricess pad_five_new_1">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-3"> 
                    <div class="tick_quan">
                    <div class="tick_head">{{__('messages.quantity')}}</div>
                                <div class="quan select">

                                 
                                    <select name="quantity" class="form-control" data-id="{{$list['split']}}">
                                        @if($list['split'] == 2)
                                        @php $quantity2 = 100 @endphp
                                             <option value="{{$quantity}}">{{$quantity}}</option>
                                        @elseif($list['split'] == 4)
                                            @for($i=1;$i<=$quantity;$i++)

                                            @php 
                                            if($i == ($quantity - 1)){
                                                continue;
                                            }
                                            @endphp

                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor

                                        @elseif($list['split'] ==3)

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
                    </div>       
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 no_padds">
                    <div class="tick_price">
                    <div class="tick_head">{{__('messages.price')}}</div>
                                <div class="tick_price_range"><span class="span_ltr">{{$list['currency_symbol'].' '.$list['price']}}</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-5">
                    <div class="tick_buy">
                        <div class="tick_view hidden-xs"> &nbsp;</div>
                        <div class="tick_book_btn">

                        <input type="hidden" value="{{base64_encode($list['match_id'])}}" name="match_id"/>
                                        <input type="hidden" value="{{base64_encode($list['s_no'])}}" name="sell_ticket_id"/>
                                        <input type="hidden" value="{{@$list['tixstock_id']}}" name="tixstock_id"/>
                                         <input type="hidden" value="{{@$list['oneclicket_id']}}" name="oneclicket_id"/>
                                        <input type="hidden" value="{{base64_encode($list['stadium_id'])}}" name="stadium_id"/>
                                     

                            <button type="button"   data-id="{{$key}}"  class="add_to_cart_button ">{{__('messages.buy')}}</button>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row_block_section">
                <div class="e_tickets">
                    <ul>
                        <li>
                            <div class="tick_text_blk"> 
                            @if(@$list['ticket_type_image'])

                            <img src="{{$list['ticket_type_image']}}"  width="20px" alt="{{$list['ticket_type_name']}}"> <span class="mob_hd">{{$list['ticket_type_name']}}</span>

                               @endif
                            </div>
                        </li>
                        @if(@$list['home_town'])
                        <li><div class="ticket-sub-block tick_text">  
                            @php if ($list['home_town'] == '0') {
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

                            {{$section}} {{__('messages.section')}}</div></li>
                            @endif

                        

                      @if($list['row'])  <li><div class="ticket-sub-block tick_text"><b>{{__('messages.row')}}</b> : {{$list['row']}} </div></li>
                      @endif

                       @if(@$list['block_id'])
                        @php
                           $block_array =  explode("-",$list['block_id']); 
                           $block =  end($block_array);
                        @endphp
                        <li><div class="ticket-sub-block tick_text"><b>{{__('messages.block')}}</b> : {{ $block ? $block : "" }} </div></li>
                        
                        @endif

                       
                    </ul>
                </div>
                <div class="remaining-count"><span>  @if($quantity <= 10)
                                    <div class="tick_text remaining-count"><span>{{$quantity}} {{__('messages.tickets remaining')}}</span></div>
                                @endif</span></div>
            </div>
        </div>
    </div>

    @if(count($list['ticket_details'])) 
                      
    <div class="row">
        <div class="col-md-12">
            <div class="seller_note_s">
                <ul>
                @foreach($list['ticket_details'] as $row) 
                <li><div class="tick tick_padd"><i class="fas fa-caret-right"></i> {{$row['ticket_name']}}</div></li>
               
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>

</form>
@endforeach
@else
    <div class="seat_select_block_items">
        There Are No Tickets Matching Your Criteria
    </div>
@endif
