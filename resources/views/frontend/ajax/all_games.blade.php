@if($results)
    @foreach($results as $list)


    <div class="col-md-4 col-sm-6 col-xs-6 full_widd">
                                        <div class="col-md-12 nopad">
                                            <div class="popular-tickets-section">
                                                <div class="team-tickets">
                                                    <ul>
                                                        <li><a href="{{url(app()->getLocale()).'/'.$list['team_slug_a']}}">
                                                                <img src="{{$list['team_image_a']}}"  alt="{{$list['team_name_a']}}">
                                                            </a></li>
                                                        <li><a href="{{url(app()->getLocale()).'/'.$list['team_slug_b']}}">
                                                                <img src="{{$list['team_image_b']}}"  alt="{{$list['team_name_b']}}">
                                                            </a></li>
                                                    </ul>
                                                </div>
                                                <div class="team-tickets-content">
                                                    <a href="{{url(app()->getLocale()).'/'.$list['slug']}}"><h2>{{$list['team_name_a']}}<span>vs</span>{{$list['team_name_b']}}</h2></a>
                                                    <div class="popular-date-time">{{$list['match_date']}}  | {{$list['match_time']}}</div>
                                                    <p>{{$list['stadium_name']}}</p>
                                                    <p><span>{{$list['tournament_name']}}</span></p>
                                                    <div class="popular-view-btn">
                                                        <a href="{{url(app()->getLocale()).'/'.$list['slug']}}">{{__('messages.view tickets')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
       
    @endforeach
@elseif($page == 1 && count($results) == 0)
     <div class="col-md-12">
        <h4>{{__('messages.no result found')}}</h4>
    <div>
   
@endif