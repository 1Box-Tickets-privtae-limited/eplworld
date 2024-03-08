@extends('layouts.app')
@section('content')
    
<section class="onebox-breadcromb-area breadcromb-bg-image-new "  style="    background-image: url({{$result['blog_large']}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li><a href="{{url(app()->getLocale().'/blog')}}">{{__('messages.blog')}}</a></li>
                        <li>/</li>
                        <li>{{$result['blog_title']}}</li>
                    </ul>
                </div>
                <div class="latest-blogs"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="breadcumb-imgg"></div>
            </div>
        </div>
    </div>
</section>


<section class="blog_detail_page">
    <div class="container">
        <div class="blogs_details">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="blog_social">
                        <div class="sharethis-inline-share-buttons"></div>
                        
                      <!--   <ul class="blog-footer-social">
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/1boxofficeservices/" class="fb"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/1boxoffice/" class="inst"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/1boxoffice/" class="inst"><i class="fab fa-instagram"></i></a>
                                </li>
                        </ul> -->
                    </div>
                    <div class="blog_leagues">
                        <ul>
                            <li><a href=""><span>{{$result['category_name']}}</span></a></li>
                            <li><p>{{$result['created_date']}} <!-- {{$result['created_time']}}  --> </p></li>
                        </ul>
                    </div>

                    <div class="blog_page_details">
                        <h1>{{$result['blog_title']}}</h1>

                        <p>{!!$result['blog_description']!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(@$blogs)
<section class="onebox-blog-page-area section_25">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading-event">
                    <h2><span>{{__('messages.latest and greatest')}}</span></h2>
                    
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $row)
            <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                <div class="single-latest-post">
                    <a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}"><img src="{{$row['blog_small']}}" alt="{{$row['blog_title']}}"></a>
                    <div class="single-post-text">
                        <h3><a href="{{url(app()->getLocale().'/blog/'.$row['blog_slug'])}}">{{$row['blog_title']}}</a></h3>
                        <p>{{ substr(strip_tags($row['blog_short_description']),0,100)}}</p>
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
    </div>
</section>
@endif

@endsection
@push('scripts')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6304be767db1160019f426f6&product=inline-share-buttons" async="async"></script>
<script type="text/javascript">

    
</script>
@endpush('scripts')
