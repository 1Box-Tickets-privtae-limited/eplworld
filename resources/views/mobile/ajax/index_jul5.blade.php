
    

  @if($top_matchs)
    <!-- About Area Start -->
    <section class="onebox-about-area section_50">
        <div class="container">
            <div class="onebox-about-right">
                <div class="onebox-section-heading">
                           <h2><span>{{__('messages.top')}}</span> {{__('messages.games')}}</h2>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                            @foreach($top_matchs as $list)
                            <div class="single-upcoming-match">
                                <div class="upcoming-match-box">
                                    <div class="upcoming-teams-head">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="team-head-image">
                                                    <a href="{{url(app()->getLocale()).'/'.$list['slug']}}">
                                                        <img src="{{$list['team_image_a']}}" alt="{{@$list['team_name_a']}}">
                                                    </a>
                                                    <h2>{{@$list['team_name_a']}}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 pad_five">
                                                <div class="upcoming-teams-texts team-head-vs">
                                                    <p><span>{{$list['match_date_sort']}}</span></p> 
                                                    <p>{{$list['stadium_name']}}</p>
                                                                                      
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="team-head-image">
                                                    <a href="{{url(app()->getLocale()).'/'.$list['slug']}}">
                                                        <img src="{{$list['team_image_b']}}" alt="{{@$list['team_name_b']}}">
                                                    </a>
                                                    <h2>{{@$list['team_name_b']}}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="upcoming-teams-stadium">
                                                    <p>{{$list['tournament_name']}}</p>   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6 padd_mobile">
                                                <div class="ticket_prices">
                                                  @if($list['min_price'])  <h4>{{__('messages.tickets')}} {{__('messages.from')}}  <span class="dir_left"><span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}} </span></span> </h4>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 padd_mobile_new">
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
                                    
                                </div>
                            </div>
                      
                            @endforeach
                    </div>
                </div>
               
                <div class="row">
                     <div class="col-xs-12">
                        <div class="upcoming-match-btn-view-all">
                            <a href="{{url(app()->getLocale().'/all-games-tickets')}}" class="onebox-btn">{{__('messages.view all match')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
    @endif
    @if($upcoming)
    <!-- Last Match Result Area Start -->
    <section class="onebox-last-match-result section_50">
        <div class="container">
            <div class="row">
                <div class="last-match-box">
                    <div class="col-md-4 col-sm-4 col-xs-3">
                        <div class="last-match-result-one last-match-result">
                                <div class="result-details">
                                    <div class="last-match-logo">
                                        <a><img src="{{$upcoming['team_image_a']}}" alt="upcoming image" /></a>
                                            <h3 class="result-details-left">
                                            <a>{{$upcoming['team_name_a']}}</a>
                                    </h3>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="last-match-score">
                            <p><span>{{$upcoming['match_date']}}</span></p>
                                <h2>{{$upcoming['match_time']}}</h2>
                                <p>{{$upcoming['stadium_name']}}</p>
                        </div>

                        <div class="view-all-result">
                            <a href="{{url(app()->getLocale().'/tournaments/ticket/')}}/{{$upcoming['slug']}}" class="onebox-btn">{{__('messages.ticket info')}}</a>
                        </div>


                   <!--  <div id="clockdiv">
                      <div>
                        <span class="days">15:</span>
                        <div class="smalltext">Days </div>
                      </div>
                      <div>
                        <span class="hours">00:</span>
                        <div class="smalltext">Hours</div>
                      </div>
                      <div>
                        <span class="minutes">00</span>
                        <div class="smalltext">Minutes</div>
                      </div>

                    </div> -->

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-3">
                        <div class="last-match-result-one last-match-result">
                                <div class="result-details">
                                    <div class="last-match-logo">
                                        <a><img src="{{$upcoming['team_image_b']}}" alt="logo" /></a>
                                            <h3 class="result-details-left">
                                            <a>{{$upcoming['team_name_b']}}</a>
                                    </h3>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                         <!--  <div class="upcoming-date-time" data-date="{{$upcoming['match_date']}} {{$upcoming['match_time']}}:00"></div>
                        <div id="clockdiv" class="mt-3">
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

                        </div> --> 
                    </div>
                </div>
            </div>
            <div class="mt-5"></div>
        </div>
    </section>
    <!-- Last Match Result Area End -->
    @endif
    @if($top_teams)
    <!-- Upcoming Matches Area Start -->
    <section class="onebox-upcoming-mathces-area section_50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h2><span>{{__('messages.top')}}</span> {{__('messages.teams')}}</h2>
                      <!--   <div class="title-line-one"></div>
                        <div class="title-line-two"></div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                 
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @foreach($top_teams as $list)
                    <div class="top_teams">
                       
                        <div class="top_team_details clearfix">
                            <div class="top_team_img_log">
                                  <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
                            </div>
                            <div class="top_team_cont">
                                <h4>{{$list['team_name']}}</h4>
                                <p>{{$list['total_match']}} {{__('messages.listed')}} </p>
                                <div class="fixtures">
                                  <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">{{__('messages.view fixtures')}}</a>
                            </div>
                                
                            </div>
                            
                        </div>
                        <div class="team_match_status clearfix" style="background-color: {{@$list['team_color']}};" > 
                            @if($list['match_name'])  <p>{{__('messages.upcoming match')}}</p>
                                <p>{{$list['match_name']}}</p>@endif
                        </div>
                        
                    </div>
                     @endforeach
                </div>
               
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="upcoming-match-btn-view-all">
                     <a href="{{url(app()->getLocale().'/teams')}}" class="onebox-btn">{{__('messages.view all teams')}}</a>
                    </div>
                </div>
            </div>

                
        </div>
    </section>

    @endif


    <!-- Upcoming Matches Area End -->
    

     @if($tournaments)
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
                <div class="col-md-12">

                    <div class="main-lates-matches">
                        @foreach($tournaments as $list)
                        <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}" class="item">
                            <span class="teams-wrap">
                                <span class="score">
                                    <span>
                                   <img src="{{$list['tournament_image']}}" alt="{{$list['tournament_name']}} ">
                                    </span>
                                </span>
                                <span class="team">
                                    <div class="single-match-gallery-text">
                                          @if($list['total_match'] > 0)
                                            <h4>{{$list['total_match']}}  {{ $list['total_match']  >1 ? __('messages.events') :  __('messages.event')}}</h4>
                                           @if($list['ticket_available'] > 0)  
                                            <p>{{$list['ticket_available']}} {{ $list['ticket_available']  > 1 ? __('messages.tickets listed') :  __('messages.ticket listed')}}</p>
                                            @endif
                                            @endif
                                    </div>
                                </span>
                                
                                <span class="team1">
                                    <div class="single-match-gallery-book">
                                      @if($list['request_type'] == "book")
                                                <h4>{{__('messages.ticket starting')}}</h4>
                                                <p><span>{{__('messages.from')}} <span class="span_ltr">{{$list['currency_symbol'].' '.$list['ticket_price']}}</span></span></p> 
                                                <!-- <p></p> -->
                                            @else
                                                <p><span>{{__('messages.request now')}}</span></p>
                                            @endif
                                    </div>
                                </span>
                            </span>
                        </a>
                        @endforeach
     
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                            <div class="upcoming-match-btn-view-all">
                                         <a href="{{url(app()->getLocale().'/tournament-tickets/')}}" class="onebox-btn">{{__('messages.show all tournaments')}} </a>
                                    </div>
                        </div>
                </div>
        </div>
    </section>
    <!-----------Tournaments end --------------->
    @endif