@if($results)
    @foreach($results as $list) 
    <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
        <div class="top_teams">
            <div class="top_team_img" style="height: 181px;">
                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_bg']}}" alt="{{$list['team_name']}}"></a>
            </div>
        <div class="top_team_details">
            <div class="top_team_img_log">
                <a class="no-underline" href="{{url(app()->getLocale()).'/'.$list['url_key']}}"> <img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
            </div>
            <div class="top_team_cont">
            <a class="no-underline" href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><h4>{{$list['team_name']}}</h4></a>
            <p>1 Listed</p>
            <!-- <p>{{$list['total_match']}} {{__('messages.games listed')}} </p> -->
            <!-- @if($list['request_type'] == "book")
                <p><span>{{__('messages.ticket starting')}} {{__('messages.from')}} <span class="span_ltr">{{$list['currency_symbol'].' '.$list['ticket_price']}}</span><span></p>
            @else
            
            @endif -->

            <div class="all_match"><a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">See All Matches</a></div>

            <div class="team_match_status"> 
                <p>{{__('messages.upcoming match')}}</p>
                <p><a href="#">Arsenal <span>vs</span> Bayern Munich</a></p>
            <!-- <p><a href="{{url(app()->getLocale().'/'.$list['match_slug'])}}">{{@$list['team_name_a']}} <span>VS</span> {{@$list['team_name_b']}}</a></p> -->
            </div>
            </div>
        </div>
            
        </div>
    </div>
    @endforeach
@else
    {{__('messages.no result found')}}
@endif