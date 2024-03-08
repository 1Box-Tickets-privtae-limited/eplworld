 <!--About Area Start -->
<section class="onebox-about-area section_50">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="onebox-about-right">
                    <div class="onebox-section-heading">
                        <h2><span>{{__('messages.top games')}}</span></h2>
                    </div>
                    @if($top_matchs)
                        @foreach($top_matchs as $list)
                            <div class="col-md-3">
                                <div class="single-upcoming-match">
                                    <div class="upcoming-match-box">
                                        <div class="upcoming-teams-head">
                                            <div class="row">
                                                <div class="col-sm-4 pad_five">
                                                    <div class="team-head-image">
                                                        <a href="{{url(app()->getLocale()).'/'.$list['team_slug_a']}}">
                                                            <img src="{{$list['team_image_a']}}" style="height:60px" alt="team image">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="team-head-vs">
                                                        <span>VS</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 pad_five">
                                                    <div class="team-head-image">
                                                        <a href="{{url(app()->getLocale()).'/'.$list['team_slug_b']}}">
                                                            <img src="{{$list['team_image_b']}}" style="height:60px" alt="team image">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{url(app()->getLocale()).'/'.$list['slug']}}"><h2>{{$list['team_name_a']}}<span>VS</span>{{$list['team_name_b']}}</h2></a>
                                        <div class="upcoming-teams-texts">
                                            <p><span>{{$list['match_date']}}</span></p>
                                            <!-- <p>Camp nou</p> -->
                                            <p>{{$list['tournament_name']}}</p>  
                                            <p>{{$list['stadium_name']}}</p>                                   
                                            
                                        </div>
                                        @if($list['request_type'] == "book")
                                            <h4>{{__('messages.tickets')}} {{__('messages.from')}}  <span class="dir_left"><span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></span></h4>
                                        @else
                                            <h4>&nbsp;</h4>
                                        @endif
                                        <div class="upcoming-match-btn">
                                            @if($list['request_type'] == "book")
                                                <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn">{{__('messages.book now')}}</a>
                                            @else 
                                                <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn">{{__('messages.request now')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="upcoming-match-btn-view-all">
                    <a href="{{url(app()->getLocale().'/all-games-tickets')}}" class="onebox-btn">{{__('messages.view all match')}}</a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- About Area End -->
<!-- Last Match Result Area Start -->
@if($upcoming)
    <section class="onebox-last-match-result section_50">
        <div class="container">
            <div class="row">
                <div class="last-match-box">
                    <div class="col-md-4">
                        <div class="last-match-result-one last-match-result">
                                <div class="result-details">
                                    <div class="last-match-logo">
                                        <a href="{{url(app()->getLocale().'/')}}/{{$upcoming['team_slug_a']}}"><img src="{{$upcoming['team_image_a']}}" alt="upcoming image" /></a>
                                        <h3 class="result-details-left">
                                        <a>{{$upcoming['team_name_a']}}</a>
                                    </h3>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="last-match-score">
                            <p><span>{{$upcoming['match_date']}}</span></p>
                            <h2>{{$upcoming['match_time']}}</h2>
                            <p>{{$upcoming['stadium_name']}}</p>
                        </div>

                        <div class="view-all-result">
                        <a href="{{url(app()->getLocale().'/')}}/{{$upcoming['slug']}}" class="onebox-btn">{{__('messages.ticket info')}}</a>
                        </div>
                        <div class="upcoming-date-time" data-date="{{$upcoming['match_date']}} {{$upcoming['match_time']}}:00"></div>
                        <!-- <div id="clockdiv" class="mt-3">
                          <div>
                            <span class="days">15:</span>
                            <div class="smalltext">Days </div>
                          </div>
                          <div>
                            <span class="hours">00:</span>
                            <div class="smalltext">Hours</div>
                          </div>
                          <div>
                            <span class="minutes">00:</span>
                            <div class="smalltext">Minutes</div>
                          </div>
                          <div>
                            <span class="seconds">00</span>
                            <div class="smalltext">Seconds</div>
                          </div>

                        </div>  -->

                    </div>
                    <div class="col-md-4">
                        <div class="last-match-result-one last-match-result">
                                <div class="result-details">
                                    <div class="last-match-logo">
                                        <a href="{{url(app()->getLocale().'/')}}/{{$upcoming['team_slug_b']}}"><img src="{{$upcoming['team_image_b']}}" alt="logo" /></a>
                                        <h3 class="result-details-left">
                                        <a>{{$upcoming['team_name_b']}}</a>
                                    </h3>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endif
<!-- Last Match Result Area End -->
    
    
<!-- Upcoming Matches Area Start -->
<section class="onebox-upcoming-mathces-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2><span>{{__('messages.top teams')}}</span></h2>
                    <!--   <div class="title-line-one"></div>
                    <div class="title-line-two"></div> -->
                </div>
            </div>
        </div>
        <div class="row">
            @if($top_teams)
                @foreach($top_teams as $list)
                    <div class="col-md-4">
                        <div class="top_teams">
                            <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">
                            <div class="top_team_img">
                                <img src="{{@$list['team_bg']}}" alt="{{$list['team_name']}}">
                            </div>
                        </a>
                        <div class="top_team_details clearfix">
                            <div class="top_team_img_log">
                            <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
                            </div>
                            <div class="top_team_cont">
                            <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"> <h4>{{$list['team_name']}}</h4></a>
                            <p>{{$list['total_match']}} {{__('messages.listed')}} </p>
                            <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">{{__('messages.view fixtures')}}</a>
                            </div>
                        </div>
                            <div class="team_match_status clearfix" style="background-color: {{@$list['team_color']}};"> 
                                @if($list['match_name']) 
                                 <a href="{{url(app()->getLocale()).'/'.$list['match_slug']}}"><p>{{__('messages.upcoming match')}}</p>
                            <p>{{$list['match_name']}}</span></p></a>
                            @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            
        </div>     
        <div class="col-md-12">
            <div class="upcoming-match-btn-view-all">
                <a href="{{url(app()->getLocale().'/teams')}}" class="onebox-btn">{{__('messages.view all teams')}}</a>
            </div>
        </div>
    </div>
</section>
<!-- Upcoming Matches Area End -->

<!---Tournamnets start--------->
<section class="onebox-match-gallery-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2><span>{{__('messages.tournaments')}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="main-lates-matches">
                @if($tournaments)
                    @foreach($tournaments as $list)
                        <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}" class="item">
                            <span class="teams-wrap">
                                <span class="team">
                                    <div class="single-match-gallery-text">
                                        <h4>{{$list['total_team']}} {{__('messages.teams')}}</h4>
                                        <p>{{$list['total_match']}} {{__('messages.listed')}}</p>
                                    </div>
                                </span>
                                <span class="score">
                                    <span>
                                        <img src="{{$list['tournament_image']}}" alt="team-image">
                                    </span>
                                </span>
                                <span class="team1">
                                    <div class="single-match-gallery-book">
                                        @if($list['request_type'] == "book")
                                            <h4>{{__('messages.ticket starting')}}</h4>
                                            <p><span>{{__('messages.from')}} <span class="span_ltr">{{$list['currency_symbol'].' '.$list['ticket_price']}}</span></span></p>
                                        @else
                                            <p><span>{{__('messages.request now')}}</span></p>
                                        @endif
                                    </div>
                                </span>
                            </span>
                        </a>
                    @endforeach
                @endif
                </div>
                <div class="col-md-12">
                    <div class="upcoming-match-btn-view-all">
                        <a href="{{url(app()->getLocale().'/tournament-tickets/')}}" class="onebox-btn">{{__('messages.show all tournaments')}} </a>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-----------Tournaments end -------------