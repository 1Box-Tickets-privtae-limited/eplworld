@if($results)
    @foreach($results as $list)
        <div class="col-md-3">
            <div class="other_event">
                <div class="other_event_img">
                    <img src="{{$list['event_image']}}" alt="Arsenal">
                </div>
                <div class="other_event_details clearfix">
                    <div class="other_event_cont">
                        <h4>{{$list['match_name']}}</h4>
                        <p>{{$list['stadium_name']}}</p>
                        <p><span>{{$list['match_date']}}<span></p>
                        <a href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')">{{__('messages.request now')}}</a>
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