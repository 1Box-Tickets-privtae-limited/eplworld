  
    @if(@$blogs)
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
                                        <a href="#"><i class="fas fa-share-alt"></i></a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        @endif