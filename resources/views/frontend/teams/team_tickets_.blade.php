@extends('layouts.app')
@section('content')

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.team tickets')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bread-img-head">
                    <img src="{{$team['team_image']}}">
                    <h3>{{$team['team_name']}} @if($type == "home") {{_('messages.home tickets')}} @elseif($type == "away")  {{_('messages.away tickets')}} @else   {{__('messages.tickets')}} @endif</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<!----------Tickets list area start--------------->
<section class="onebox-tickets-list-area section_50">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h2>Team <span>tickets</span></h2>
                    </div>
                </div>
            </div> -->

            <div class="row">
                
                <div class="col-md-8">
                    <div class="sub_head">
                        <a href="{{url('team-ticket').'/'.$team_name.'/all'}}" @if($type == "all")class="active"@endif >{{__('messages.all tickets')}}</a>
                        <a href="{{url('team-ticket').'/'.$team_name.'/home'}}"@if($type == "home")class="active"@endif>{{$team['team_name']}} {{__('messages.home tickets')}}</a>
                        <a href="{{url('team-ticket').'/'.$team_name.'/away'}}"@if($type == "away")class="active"@endif>{{$team['team_name']}} {{__('messages.away tickets')}}</a>
                    </div>
                </div>
                     

                <div class="col-md-4">
                    <div class="single-fixture-right-widget">
                            <form method="get">
                                <input type="search" name="search" value="{{ app('request')->get('search')}}" placeholder="{{__('messages.keywords')}}...">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="onebox-tickets-list">
                        @if($results)
                            @foreach($results as $list)
                                <div class="single-tickets-list">
                                    <div class="match-tickets-box">
                                        <div class="col-md-3">
                                            <div class="match-date">
                                                <h4>{{$list['stadium_name']}}</h4>
                                                <p>{{$list['tournament_name']}}</p>
                                                <p><span><i class="far fa-fire"></i> {{__('messages.tickets are in high demand')}}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="match-tickets-box-left">
                                            <div class="tickets-box-left-team">
                                                <div class="tickets-box-team-text">
                                                    <h4><a href="#">{{$list['team_name_a']}}</a></h4>
                                                </div>
                                                <div class="tickets-box-team-img">
                                                    <img src="{{$list['team_image_a']}}">
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
                                                    <img src="{{$list['team_image_b']}}">
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="match-tickets-box-right">
                                                    @if($list['request_type'] == "book")
                                                        <p>{{__('messages.tickets')}} {{__('messages.from')}} <span>{{$list['currency_symbol'].' '.$list['min_price']}}</span></p>
                                                        <a href="{{url('tournaments/ticket')}}/{{$list['slug']}}" class="onebox-btn">{{__('messages.book now')}}</a>
                                                    @else
                                                        <a href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')" class="onebox-btn">{{__('messages.request now')}}</a> 
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="fc_tickets">
                            {!!$team['page_content']!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!----------Tickets list area end----------------->
@endsection