@if($results)

  <div class="row">
            <div class="top-teams-div">


    @foreach($results as $list) 



                <div class="col-md-4 col-sm-6 col-xs-6 full_widd">
                    <div class="top_teams">
                        <div class="top_team_img" style="height: 181px;">
                               <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}"><img src="{{$list['team_bg']}}" alt="{{$list['team_name']}}"></a>
                        </div>
                        <div class="top_team_details">
                            <div class="top_team_img_log">
                                <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}"><img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
                            </div>
                            <div class="top_team_cont">
                           <a class="no-underline" href="{{url(app()->getLocale())}}/{{$list['url_key']}}"><h4>{{$list['team_name']}}</h4></a>
                              <p>{{$list['total_match']}} {{__('messages.listed')}} </p>
                            <div class="all_match">
                                <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}">{{__('messages.See All Matches')}}</a>
                            </div>

                            <div class="team_match_status"> 
                                <p>{{__('messages.upcoming match')}}</p>
                                <p><a href="{{url(app()->getLocale().'/'.$list['match_slug'])}}">{{@$list['team_name_a']}} <span>VS</span> {{@$list['team_name_b']}}</a></p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
     
                
        
  
    @endforeach
     </div>
      </div>
@elseif($page == 1 && count(@$results) == 0)
     <div class="col-md-12">
        <h4>{{__('messages.no result found')}}</h4>
    <div>
   
@endif