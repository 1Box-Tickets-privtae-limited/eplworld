@extends('layouts.app')
@section('content')
    
<section class="onebox-breadcromb-area bg_white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcromb-box">
                            <ul>
                                <li><a href="{{ url('/')}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                                <li>/</li>
                                <li> {{__('messages.blog')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
</section>

@if($news)
<section class="onebox-blog-page-area section_50 bg_white section_nopadd">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1><span>Latest Posts</span></h1>
                    
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($news as $key => $row)
            @if($key  == 0 )
            <div class="col-md-6 col-sm-6 col-xs-12 full_widd">
                <div class="single-post-news">
                    <div class="single-post-news-image_new">
                        <a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}"><img src="{{$row['blog_large']}}" alt="{{$row['blog_title']}}"></a>
                    </div>
                    <div class="single-post-news-text">
                        <p><span>{{$row['category_name']}}</span></p>
                        <div class="background_trans">
                            <h3><a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}">{{$row['blog_title']}}</a></h3>
                            <p>{{ substr(strip_tags($row['blog_short_description']),0,150)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else  

               @if($key > 0)
                <div class="col-md-6 col-sm-6 col-xs-12 full_widd">
                    <div class="row">
                @endif
                        <div class="col-md-12">
                                <div class="single-post-news mrg_btm">
                                <div class="single-post-news-image">
                                    <a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}"><img src="{{$row['blog_medium']}}" alt="{{$row['blog_title']}}"></a>
                                </div>
                                <div class="single-post-news-text">
                                    <p><span>{{$row['category_name']}}</span></p>
                                    <div class="background_trans">
                                        <h3><a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}">{{$row['blog_title']}}</a></h3>
                                    </div>
                            
                                </div>
                            </div>
                        </div>
                @if($key > 0)
                    </div>
                </div>
                @endif
                @endif
             @endforeach
        </div>
    </div>
</section>
@endif

<section class="onebox-blog-page-area section_25">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading-event">
                    <h2><span>{{__('messages.latest and greatest')}}</span></h2>
                    
                </div>
            </div>
        </div>
        @if($blogs)
        <div class="row">
            @foreach($blogs as $row)
            <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                <div class="single-latest-post">
                    <a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}"><img src="{{$row['blog_small']}}" alt="{{$row['blog_title']}}"></a>
                    <div class="single-post-text">
                        <h3><a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}">{{$row['blog_title']}}</a></h3>
                        <p>{{ substr(strip_tags($row['blog_short_description']),0,150)}}</p>
                        <div class="post-text-bottom">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <div class="admin-image">
                                        <ul>
                                            <li><a href="#">{{$row['created_date']}}</a></li>
                                            <!-- <li><a href="#">{{$row['created_time']}}</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                 <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="sharethis-inline-share-buttons" data-url="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}" data-title="{{$row['blog_title']}}"></div>
                                   
                                </div>
                                <!-- <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="admin-image-right">
                                    
                                        <div class="sharethis-inline-share-buttons"></div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        

        <div class="row">
            <div class="col-md-12">
                <div class="upcoming-match-btn-view-all">
                    <a href="{{url(app()->getLocale().'/blog/all')}}" class="onebox-btn">{{__('messages.view all news')}}</a>
                </div>
        </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">No Blogs Found</h3>
        </div>
        </div>
         @endif
    </div>
</section>

    



@if($upcoming)
 <section class="onebox-blog-upcoming-events-teams section_25">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading-event">
                    <h2><span>{{__('messages.top games')}}</span></h2>
                    
                </div>
            </div>
        </div>
        <div class="row">
          
             @foreach($upcoming as $row)
            <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                <div class="upcoming-event-blogs">
                    <div class="upcoming-match-blogs">
                        <div class="upcoming-match-teams-head">
                            <div class="row">
                                
                                <div class="col-md-4 col-sm-4 col-xs-4 pad_five">
                                    <div class="upcoming-blog-head-image">
                                        <a href="{{ url(app()->getLocale().'/'.$row['team_slug_a']) }}">
                                            <img src="{{$row['team_image_a']}}" style="height:60px" alt="{{$row['team_image_a']}}">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="upcoming-blog-team-head-vs">
                                        <span>VS</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 pad_five">
                                    <div class="upcoming-blog-team-head-image">
                                        <a href="{{ url(app()->getLocale().'/'.$row['team_slug_b']) }}">
                                            <img src="{{$row['team_image_b']}}" style="height:60px" alt="{{$row['team_image_b']}}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href=""><h2><a href="{{ url(app()->getLocale().'/'.$row['slug']) }}">{{$row['team_name_a']}} <span>VS</span> {{$row['team_name_b']}}</a></h2></a>
                        <div class="upcoming-blog-teams-texts">
                            <p><span>{{$row['match_date']}}</span></p>
                      
                            <p>{{$row['tournament_name']}} </p>  
                            <p>{{$row['stadium_name']}} </p>                                   
                            
                        </div>
                    @if($row['request_type'] == "book")
                            <h4>{{__('messages.tickets')}} {{__('messages.from')}}  <span class="span_ltr">{{$row['currency_symbol'].' '.$row['min_price']}}</span></h4>
                            <div class="upcoming-match-btn">
                                <a href="{{url(app()->getLocale()).'/'.$row['slug']}}" class="onebox-btn">{{__('messages.book now')}}</a>
                            </div>
                        @else
                            <h4>&nbsp;</h4>
                            <div class="upcoming-match-btn">

                                    <a href="javascript:void(0)" onClick="requestNow({{$row['m_id']}},'{{date('Y-m-d',strtotime($row['match_date']))}}','{{$row['match_time']}}')" class="onebox-btn">{{__('messages.request now')}}</a>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
         
           
        </div>
    </div>
</section>
@endif


@endsection
@push('scripts')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6304be767db1160019f426f6&product=inline-share-buttons" async="async"></script>
@endpush('scripts')