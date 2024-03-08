
@if($results)
    @foreach($results as $list)
        <div class="single-tickets-list">
            <div class="match-tickets-box">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="match-date">
                        <h4>{{$list['stadium_name']}}</h4>
                        <p>{{$list['tournament_name']}}</p>
                         @if($list['high_demand'] == "1")
                            <p><span><i class="far fa-fire"></i> {{__('messages.tickets are in high demand')}}</span></p>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 col-sm-9 col-xs-12">
                    <div class="match-tickets-box-left">
                    <div class="tickets-box-left-team">
                        <div class="tickets-box-team-text">
                            <h4><a href="#">{{$list['team_name_a']}}</a></h4>
                        </div>
                        <div class="tickets-box-team-img">
                            <img src="{{$list['team_image_a']}}" alt="{{$list['team_name_a']}}">
                        </div>
                    </div>
                    <div class="tickets-box-left-vs">
                        <p>{{$list['match_date']}}</p>
                        <p><span>{{$list['match_time']}}</span></p>
                    </div>
                    <div class="tickets-box-left-team right-box">
                        <div class="tickets-box-team-text">
                            <h4><a href="#">{{$list['team_name_b']}}</a></h4>
                        </div>
                        <div class="tickets-box-team-img">
                            <img src="{{$list['team_image_b']}}" alt="{{$list['team_name_b']}}">
                        </div>
                        
                    </div>
                    
                </div>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                        <div class="match-tickets-box-right">
                            @if($list['request_type'] == "book")
                                <p>{{__('messages.tickets')}} {{__('messages.from')}} <span class="dir_left"><span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></span></p>
                                <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn">{{__('messages.book now')}}</a>
                            @else
                                <a href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')" class="onebox-btn">{{__('messages.request now')}}</a> 
                            @endif
                        </div>
                </div>
            </div>
        </div>
    @endforeach
@else
<div class="row">
    <div class="col-md-12">
        <div class="no-result-found">
            <i class="fas fa-search"></i>
            <h3>{{__('messages.no result found')}}!</h3>
        </div>
    </div>
</div>
@endif
<div class="fc_tickets">
    {!!$team['page_content']!!}
</div>
                    