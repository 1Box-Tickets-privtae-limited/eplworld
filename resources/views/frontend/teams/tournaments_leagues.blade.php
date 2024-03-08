@extends('layouts.app')
@section('content')
@php
    use Jenssegers\Agent\Agent;
    $agent = new Agent();
    $mobile =  $agent->isMobile();
@endphp

<style type="text/css">
    .filter_team{margin: 10px 0 0;}
    .section_10{padding: 10px 0 40px;}
</style>
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box tournament_section">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.tournaments')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<!---Tournamnets start--------->
<section class="onebox-tournaments section_10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading head-background">
                    <h1>{{$tournament['tournament_name']}} {{__('messages.tickets')}} </h1>
                    <img src="{{$tournament['tournament_image']}}" alt="{{$tournament['tournament_name']}} {{__('messages.tickets')}}">
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="filter_section">
                    <p>{{__('messages.sort by')}}:</p>
                    <div class="upcoming-sub_head">
                        <form id="filter_form">
                            <div class="select">
                                <select name="month" id="month_filter" class="form-control">
                                    <option value="">{{__('messages.filter by month')}}</option>
                                    @if($months)
                                        @foreach($months as $month => $name)
                                            <option value="{{$month}}"
                                                @if(app('request')->input('month') == $month)
                                                    selected="selected"
                                                @endif
                                            >{{$name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </form>

                         @if($mobile)
                         <form id="team_form">
                            <div class="select">
                                <select name="team" id="team_filter" class="form-control">
                                @if($default_teams)
                                 <option value="" selected="selected">Filter by Team</option>
                                    @foreach($default_teams as $list)
                                <option value="{{$list['id']}}" 
                                @if($list['id'] == $selected_team)
                                                    selected="selected"
                                                @endif>{{$list['team_name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </form>
                        @endif
                        <!-- <a href=""><i class="fas fa-plus"></i> Filter by month</a> -->
                    </div>

                     @if(!$mobile)
                    <div class="upcoming-sub_head">
                        <form id="team_form">
                            <div class="select">
                                <select name="team" id="team_filter" class="form-control">
                                @if($default_teams)
                                 <option value="" selected="selected">Filter by Team</option>
                                    @foreach($default_teams as $list)
                                <option value="{{$list['id']}}" 
                                @if($list['id'] == $selected_team)
                                                    selected="selected"
                                                @endif>{{$list['team_name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
             
            <div class="col-md-6">
                <div class="upcome_game_details">

                    <div class="upcoming-sub_heading">
                        <div class="onebox-sub-heading">
                            <h2>
                                 @if($features_match)
                                <!-- {{__('messages.upcoming')}} --> Featured  <span>{{__('messages.games')}}</span>
                                @else
                                {{__('messages.upcoming')}} <span>{{__('messages.games')}}</span>
                                @endif

                            </h2>
                        </div>
                        
                    </div>


                    @if($features_match)
                        @foreach($features_match as $list)
                            <div class="upcoming-teams-list">
                                <div class="col-md-4 col-sm-4 col-xs-4 full_widd_50 full_widd">
                                    
                                        <div class="upcoming-teams-match">
                                            <div class="team-list-image">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                                <img src="{{$list['team_image_a']}}" alt="{{$list['team_name_a']}}">
                                                </a>
                                            </div>
                                            <!-- <div class="team-list-vs">
                                                <span>VS</span>
                                            </div> -->
                                            <div class="team-list-image">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                                <img src="{{$list['team_image_b']}}" alt="{{$list['team_name_b']}}" >
                                                </a>
                                            </div>

                                            <div class="upcoming-teams-date">
                                                <!-- <p>{{$list['match_day']}}<p> -->
                                                <p>{{$list['match_date']}}<br>
                                                {{$list['match_time']}}</p>                                    
                                            </div>
                                        </div>
                                
                                </div>
                                    <div class="col-md-8 col-sm-8 col-xs-8 full_widd_50 full_widd">
                                    
                                        <div class="upcoming-teams-headings">

                                            @php 
                                                $br = "";

                                                $teams_names = $list['team_name_a'].$list['team_name_b'];
                                                $teams_length = strlen($teams_names);
                                                if($teams_length > 25 && $mobile == true ){
                                                    $br = "<br/>";
                                                }
                                                @endphp


                                            <a href="{{url(app()->getLocale()).'/'.$list['slug']}}"><h2>{{$list['team_name_a']}} {!!$br!!}<span>vs</span>  {!!$br!!}{{$list['team_name_b']}}</h2></a>
                                            <p>{{$list['stadium_name']}}</p>
                                            <p><span>{{$tournament['tournament_name']}}</span></p>
                                            
                                        </div>
                                        <div class="upcoming-book-btn">
                                            @if($list['request_type'] == "book")
                                                <p>{{__('messages.tickets')}} {{__('messages.from')}} <span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></p>
                                                <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn-book">{{__('messages.book now')}}</a>
                                            @else
                                            <a class="onebox-btn-book"  href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},
'{{ $list['tbc_status'] == 0 ? date('Y-m-d',strtotime($list['match_date']))  : $list['match_date'] }}','{{ $list['tbc_status'] == 0 ? $list['match_time'] : "" }}')" class="onebox-btn">{{__('messages.request now')}}</a>   
                                            @endif
                                        </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    
       
                    @endif
                    @if(!empty($features_match))
                        <div class="upcoming-sub_heading">
                            <div class="onebox-sub-heading">
                                <h2>{{__('messages.upcoming')}} <span>{{__('messages.games')}}</span></h2>
                            </div>
                            <div class="upcoming-sub_head">
                          
                                <!-- <a href=""><i class="fas fa-plus"></i> Filter by month</a> -->
                            </div>
                        </div>

                @endif


                    @if($results)
                        @foreach($results as $list)
                            <div class="upcoming-teams-list">
                                <div class="col-md-4 col-sm-4 col-xs-4 full_widd">
                                    
                                        <div class="upcoming-teams-match">
                                            <div class="team-list-image_first">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                                <img src="{{$list['team_image_a']}}"  alt="{{$list['team_name_a']}}" >
                                                </a>
                                            </div>
                                            <!-- <div class="team-list-vs">
                                                <span>VS</span>
                                            </div> -->
                                            <div class="team-list-image_second">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                                <img src="{{$list['team_image_b']}}"  alt="{{$list['team_name_b']}}" >
                                                </a>
                                            </div>

                                            <div class="upcoming-teams-date">
                                                <!-- <p>{{$list['match_day']}}<p> -->
                                                <p>{{$list['match_date']}}<br>
                                                {{$list['match_time']}}</p>                                    
                                            </div>
                                        </div>
                                
                                </div>
                                    <div class="col-md-8 col-sm-8 col-xs-8 full_widd">
                                    
                                        <div class="upcoming-teams-headings">

                                            @php 
                                                $br = "";

                                                $teams_names = $list['team_name_a'].$list['team_name_b'];
                                                $teams_length = strlen($teams_names);
                                                if($teams_length > 25 && $mobile == true ){
                                                    $br = "<br/>";
                                                }
                                                @endphp


                                            <a href="{{url(app()->getLocale()).'/'.$list['slug']}}"><h2>{{$list['team_name_a']}} {!!$br!!}<span>vs</span>  {!!$br!!}{{$list['team_name_b']}}</h2></a>
                                            <p>{{$list['stadium_name']}}</p>
                                            <p><span>{{$tournament['tournament_name']}}</span></p>
                                            
                                        </div>
                                        <div class="upcoming-book-btn">
                                            @if($list['request_type'] == "book")
                                                <p>{{__('messages.tickets')}} {{__('messages.from')}} <span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></p>
                                                <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn-book">{{__('messages.book now')}}</a>
                                            @else
                                            <a class="onebox-btn-book"  href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},
'{{ $list['tbc_status'] == 0 ? date('Y-m-d',strtotime($list['match_date']))  : $list['match_date'] }}','{{ $list['tbc_status'] == 0 ? $list['match_time'] : "" }}')" class="onebox-btn">{{__('messages.request now')}}</a>   
                                            @endif
                                        </div>
                                   
                                </div>
                            </div>
                        @endforeach
                    
                    @else
                        <div class="upcoming-teams-list">
                            {{__('messages.no result found')}}
                        </div>
                    @endif
               
               </div>
            </div>
             
               
            <div class="col-md-6">
                <div class="upcome_game_detail">
                    <div class="upcoming-sub_heading">
                        <div class="onebox-sub-heading">
                            <h2>{{$tournament['tournament_name']}} {{__("messages.team's")}}</h2>
                        </div>
                        
                    </div>

                     @if($teams)
                            @foreach($teams as $list)
                         
                    <div class="upcoming-teams-details">
                        <div class="team-view-image-term">
                            <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_bg']}}"></a>
                        </div>
                        <div class="team-view-details-list">
                            <div class="team-view-details_log">
                                <a  class="no-underline" href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
                            </div>
                            <div class="team-view-content">
                                <a class="no-underline" href="{{url(app()->getLocale()).'/'.$list['url_key']}}">
                                    <h4>{{$list['team_name']}}</h4>
                                </a>
                                <p>{{$list['total_match']}} {{__('messages.listed')}} </p>
                                <div class="view-fixture">
                                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">{{__('messages.view detail')}} <i class="fas fa-arrow-circle-right" style="color: #5f1f74;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endforeach
                        @else
                            <div class="team-view-details">
                                {{__('messages.no result found')}}
                            </div>
                        @endif
            <!-- 
                <div class="upcoming-teams-details">
                    @if($teams)
                        @foreach($teams as $list)
                            <div class="team-view-details">
                                <div class="team-view-image">
                                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
                                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><p>{{$list['team_name']}}</p></a>
                                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">{{__('messages.view detail')}} <i class="fas fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="team-view-details">
                            {{__('messages.no result found')}}
                        </div>
                    @endif
             -->
                    </div>
                </div>
            </div>
        </div>
        

        <!-- @if(trim(strip_tags($tournament['page_content'])))

        <div class="fc_tickets">
                            
            {!!$tournament['page_content']!!}
        </div>
        @endif -->

    </div>        
</section>
<!-----------Tournaments end --------------->

@endsection
@push('scripts')
 <script>
    $("#month_filter").on('change', function(){
        $('#filter_form').submit();
    });
     $("#team_filter").on('change', function(){
        $('#team_form').submit();
    });
</script>
@endpush('scripts')