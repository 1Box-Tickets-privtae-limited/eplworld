


<div class="tournaments_all">
    @if($results)
         @foreach($results as $list)
    <div class="col-md-6">
        <div class="tournament_lists">
            <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">
                <div class="all_ticket_list">
                    <div class="event_lists">

                        @if($list['total_match'] > 0)
                    <h4>{{$list['total_match']}}  {{ $list['total_match']  >1 ? __('messages.events tournaments') :  __('messages.event')}}</h4>

                       @if($list['ticket_available'] > 0)  
                        <p><span class="span_ltr">{{$list['ticket_available']}}</span> {{ $list['ticket_available']  > 1 ? __('messages.tickets listed') :  __('messages.ticket listed')}}</span></p>
                        @else
                        <p> &nbsp;</p>
                         @endif
                          
                        
                        @endif
                    </div>
                    <div class="ticket_starting">
                         @if($list['total_match'] == "0")
                          <h4>  &nbsp;</h4>
                            @elseif($list['request_type'] == "book")
                        <h4>{{__('messages.from')}} <span class="span_ticket_val">{{$list['currency_symbol'].' '.$list['ticket_price']}}</span></h4>
                        <p>{{__('messages.ticket starting')}}</p>
                         @else
                            <p><span>{{__('messages.request now')}}</span></p>
                        @endif
                    </div>
                </div>
                <div class="event_img_all">
                    <div class="all_eve_imgg">
                        <img src="{{$list['tournament_image']}}" alt="{{@$list['tournament_name']}}" >
                    </div>
                </div>
            </a>
        </div>
    </div>
        @endforeach
    @else
        {{__('messages.no result found')}}
    @endif 

</div>
