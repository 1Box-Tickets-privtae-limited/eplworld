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
                        <li>{{__('messages.all games')}}</li>
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
                    <h1><span>{{__('messages.all')}}</span> {{__('messages.games')}}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="single-fixture-right-widget">
                    <form id="filter" onsubmit="event.preventDefault()">
                        <input type="search" name="keywords" value="{{ app('request')->input('keywords') }}" placeholder="{{__('messages.keywords')}}...">
                        <button type="submit" id="search">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
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
                                <div class="team-head-image" style="height:70px" >
                                    <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_a']}}">
                                        <img src="{{$list['team_image_a']}}" style="height:60px" alt="{{$list['team_image_a']}}">
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
                                    <a href="{{url(app()->getLocale().'/')}}/{{$list['team_slug_b']}}">
                                        <img src="{{$list['team_image_b']}}" style="height:60px" alt="{{$list['team_image_b']}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url(app()->getLocale().'/')}}/{{$list['slug']}}"><h2>{{$list['team_name_a']}} <span>VS</span> {{$list['team_name_b']}}</h2></a>
                    <div class="upcoming-teams-texts">
                        <p><span>{{$list['match_date']}}</span></p>
                        <!-- <p>Camp nou</p> -->
                        <p>{!!($list['tournament_name'])?$list['tournament_name']: "&nbsp;"!!}</p>  
                        <p>{!! ($list['stadium_name'])?$list['stadium_name']: "&nbsp;" !!}</p>                                
                        
                    </div>
                    @if($list['request_type'] == "book")
                        <h4>{{__('messages.tickets')}} {{__('messages.from')}}  <span class="span_ltr">{{$list['currency_symbol'].' '.$list['min_price']}}</span></h4>
                        <div class="upcoming-match-btn">
                            <a href="{{url(app()->getLocale()).'/'.$list['slug']}}" class="onebox-btn">{{__('messages.book now')}}</a>
                        </div>
                    @else
                        <h4>&nbsp;</h4>
                        <div class="upcoming-match-btn">

                                <a href="javascript:void(0)" onClick="requestNow({{$list['m_id']}},'{{date('Y-m-d',strtotime($list['match_date']))}}','{{$list['match_time']}}')" class="onebox-btn">{{__('messages.request now')}}</a>

                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    @endforeach
        @elseif($page == 1 && count($results) == 0)
             <div class="col-md-12">
                <h4>{{__('messages.no result found')}}</h4>
          </div>
           
        @endif
      

    </div>
</section>
@endsection
@push('scripts')
 <script>

  

</script>
@endpush('scripts')
