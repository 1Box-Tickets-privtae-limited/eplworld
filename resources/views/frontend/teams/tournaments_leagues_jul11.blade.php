@extends('layouts.app')
@section('content')

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
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
<section class="onebox-tournaments section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2>{{$tournament['tournament_name']}} {{__('messages.tickets')}} <img src="{{$tournament['tournament_image']}}" alt="tournament_image"></h2>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">

                <div class="upcoming-sub_heading">
                    <div class="onebox-sub-heading">
                        <h2>{{__('messages.upcoming')}} <span>{{__('messages.games')}}</span></h2>
                    </div>
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
                        <!-- <a href=""><i class="fas fa-plus"></i> Filter by month</a> -->
                    </div>
                </div>


                    @if($results)
                        @foreach($results as $list)
                            <div class="upcoming-teams-list">
                                <div class="col-md-4 col-sm-4 col-xs-4 full_widd_50 full_widd">
                                    <div class="row">
                                        <div class="upcoming-teams-match">
                                            <div class="team-list-image">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                                <img src="{{$list['team_image_a']}}">
                                                </a>
                                            </div>
                                            <div class="team-list-vs">
                                                <span>VS</span>
                                            </div>
                                            <div class="team-list-image">
                                                <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                                <img src="{{$list['team_image_b']}}">
                                                </a>
                                            </div>

                                            <div class="upcoming-teams-date">
                                                <p>{{$list['match_day']}}<p>
                                                <p><span>{{$list['match_date']}}</span></p>
                                                <p>{{$list['match_time']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-8 col-sm-8 col-xs-8 full_widd_50 full_widd">
                                    <div class="row">
                                        <div class="upcoming-teams-headings">
                                            <a href="{{url(app()->getLocale()).'/'.$list['slug']}}"><h2>{{$list['team_name_a']}} <span>vs</span> {{$list['team_name_b']}}</h2></a>
                                            <p>{{$tournament['tournament_name']}}</p>
                                            <p>{{$list['stadium_name']}}</p>
                                        </div>
                                        <div class="upcoming-book-btn">
                                            @if($list['request_type'] == "book")
                                                <h4>{{__('messages.tickets')}} {{__('messages.from')}} <span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></h4>
                                                <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn-book">{{__('messages.book now')}}</a>
                                            @else
                                            <a href="javascript:void(0)" class="onebox-btn-book" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')">{{__('messages.request now')}}</a>
                                            @endif
                                        </div>
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


            <div class="col-md-6">
                <div class="upcoming-sub_heading">
                    <div class="onebox-sub-heading">
                        <h2>{{$tournament['tournament_name']}} {{__("messages.team's")}}</h2>
                    </div>
                </div>
                <div class="upcoming-teams-details">
                    @if($teams)
                        @foreach($teams as $list)
                            <div class="team-view-details">
                                <div class="team-view-image">
                                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"><img src="{{$list['team_image']}}" alt="team_image"></a>
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


                </div>
            </div>
        </div>


        @if(trim(strip_tags($tournament['page_content'])))

        <div class="fc_tickets">

            {!!$tournament['page_content']!!}
        </div>
        @endif

    </div>
</section>
<!-----------Tournaments end --------------->

@endsection
@push('scripts')
 <script>
    $("#month_filter").on('change', function(){
        $('#filter_form').submit();
    });
</script>
@endpush('scripts')
