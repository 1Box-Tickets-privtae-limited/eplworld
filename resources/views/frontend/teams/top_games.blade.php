@extends('layouts.app')
@section('content')
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> home</a></li>
                        <li>/</li>
                        <li>Top Games</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<!-- Upcoming Matches Area Start -->
<section class="onebox-upcoming-mathces-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2><span>Top</span> Games</h2>
                </div>
            </div>
        </div>
        <div class="row"> 
            @if($results)
                @foreach($results as $list)
                    <div class="col-md-3">
                        <div class="single-upcoming-match">
                            <div class="upcoming-match-box">
                                <div class="upcoming-teams-head">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="team-head-image">
                                                <a>
                                                    <img src="{{$list['team_image_a']}}" style="height:60px" alt="team image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="team-head-vs">
                                                <span>VS</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="team-head-image">
                                                <a>
                                                    <img src="{{$list['team_image_b']}}" style="height:60px" alt="team image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2>{{$list['match_name']}}</h2>
                                <div class="upcoming-teams-texts">
                                    <p><span>{{$list['match_date']}}</span></p>
                                    <!-- <p>Camp nou</p> -->
                                    <p>{{$list['tournament_name']}}</p>    
                                    <p>{{$list['stadium_name']}}</p>                                
                                    
                                </div>
                                @if($list['request_type'] == "book")
                                    <h4>Tickets From  <span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></h4>
                                    <div class="upcoming-match-btn">
                                        <a href="{{url(app()->getLocale().'/tournaments/ticket/')}}/{{$list['slug']}}" class="onebox-btn">Book Now</a>
                                    </div>
                                @else
                                    <div class="upcoming-match-btn">
                                        <a href="javascript:void(0)" onClick="requestNow({{$list['m_id']}})" class="onebox-btn">Request Now</a>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            
        </div>
    </div>
</section>
@endsection

