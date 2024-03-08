@if($results)
    @foreach($results as $list)
        <div class="col-md-3">
            <div class="other_event">
                <div class="other_event_img">
                    <img src="{{$list['event_image']}}" alt="{{$list['match_name']}}">
                </div>
                <div class="other_event_details clearfix">
                    <div class="other_event_cont">
                        <h4>{{$list['match_name']}}</h4>
                        <p>{{$list['stadium_name']}}</p>
                        <p><span>{{$list['match_date']}}<span></p>
                        <!-- <a href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')">{{__('messages.request now')}}</a> -->
                         @if($list['request_type'] == "book")
                        <h5>{{__('messages.tickets')}} {{__('messages.from')}}  <span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></h5>
                            <a href="{{url(app()->getLocale()).'/other-events-'.$list['slug']}}" class="onebox-btn">{{__('messages.book now')}}</a>
                    @else
                        <h5>&nbsp;</h5>
                        <a href="javascript:void(0)" data-url="{{url(app()->getLocale()).'/other-events-'.$list['slug']}}" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')">{{__('messages.request now')}}</a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else 
    <div class="col-md-12">
        <h3>{{__('messages.no events available')}}.</h3>
    </div>
@endif