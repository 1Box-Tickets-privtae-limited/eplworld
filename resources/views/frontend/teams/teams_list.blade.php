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
                        <li>{{__('messages.all')}} {{__('messages.teams')}}</li>
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
                    <h1><span>{{__('messages.all')}}</span> {{__('messages.teams')}}</h1>
                    <!--   <div class="title-line-one"></div>
                    <div class="title-line-two"></div> -->
                </div>
            </div>
        </div>
       
        <div class="row">
            @if($results)
                    @foreach($results as $list) 
                    <div class="col-md-4">
                        <div class="top_teams">
                           
                            <div class="top_team_details clearfix">
                                <div class="top_team_img_log">
                                    <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}"><img src="{{$list['team_image']}}" alt="{{$list['team_name']}}"></a>
                                </div>
                                <div class="top_team_cont">
                                <h4>{{$list['team_name']}}</h4>
                                <p>{{$list['total_match']}} {{__('messages.listed')}} </p>
                                @if($list['request_type'] == "book")
                                    <p><span>{{__('messages.tickets starting from')}} {{$list['currency_symbol'].' '.$list['ticket_price']}}<span></p>
                                @else
                                 <p>&nbsp;</p>
                                @endif
                                <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}">{{__('messages.view fixtures')}}</a>
                                </div>
                            </div>
                            <div class="team_match_status clearfix"  style="background-color: {{@$list['team_color']}};"> 
                               @if($list['total_match']) <p>{{__('messages.upcoming match')}}</p>
                                <p><a href="{{url(app()->getLocale().'/'.$list['match_slug'])}}">{{$list['match_name']}}</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @elseif($page == 1 && count(@$results) == 0)
                     <div class="col-md-12">
                        <h4>{{__('messages.no result found')}}</h4>
                    <div>
                   
                @endif
        </div>
        
    </div>
</section>
<!-- Upcoming Matches Area End -->
@endsection
@push('scripts')
<script type="text/javascript">
   


</script>
@endpush('scripts')