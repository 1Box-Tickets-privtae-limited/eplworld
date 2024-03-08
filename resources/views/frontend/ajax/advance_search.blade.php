@if($results)
    @foreach($results as $list)
  
        <div class="search_result">
            <!-- <div class="col-md-3 col-sm-3 col-xs-4 pad_five">
                <div class="teams-search-date">
                    <p>{{$list['day']}}</p>
                    <p><span>{{$list['date']}}</span></p>
                    <p>{{$list['time']}}</p>                                    
                </div>
            </div> -->
            <div class="col-md-8 col-sm-8 col-xs-8 pad_five">
                <div class="teams-search-headings">
                    <h2>{{$list['team_name_a']}} <span class="vs_team">vs</span> {{$list['team_name_b']}}</h2>
                    <div class="popular-date-time">{{$list['date']}}  | {{$list['time']}}</div>
                    <!-- <div class="teams-search-date">
                        <p><span></span></p>
                        <p></p> 
                    </div> -->
                    <p>{{$list['stadium_name']}}</p>
                    <p>{{$list['tournament_name']}}</p>
                    <!-- <p>{{$list['country_name']}}</p> -->

                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="search-book-btn">
                    <a href="{{url(app()->getLocale()).'/'.$list['url']}}" class="onebox-btn-book">{{__('messages.view tickets')}}</a>
                </div>
            </div>
        </div>
    @endforeach
@elseif($page == 1 && count($results) == 0)
     <div class="col-md-12">
        <h4>{{__('messages.no result found')}}</h4>
    <div>
   
@endif
