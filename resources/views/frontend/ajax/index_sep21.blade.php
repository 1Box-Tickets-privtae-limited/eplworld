<!--------- Popular football ticket start------------->
<section class="football-ticket-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="football_ticket">
                    <div class="football-ticket-heading">
                        <h2>{{__('messages.Most Popular')}}</h2>
                        <h1>{{__('messages.Football tickets')}}</h1>
                    </div>
                    <div id="football_tickets" class="">

                            <div class="popular-tickets">
                                <div class="row">

                        @if($top_matchs) @php $i= 0 ;@endphp
                                         @foreach($top_matchs as $list)


                                    <div class="col-md-4 col-sm-6 col-xs-6 full_widd">
                                        <div class="col-md-12 nopad">
                                            <div class="popular-tickets-section">
                                                <div class="team-tickets">
                                                    <ul>
                                                        <li><a href="{{url(app()->getLocale()).'/'.$list['team_slug_a']}}">
                                                                <img src="{{$list['team_image_a']}}"  alt="{{$list['team_name_a']}}">
                                                            </a></li>
                                                        <li><a href="{{url(app()->getLocale()).'/'.$list['team_slug_b']}}">
                                                                <img src="{{$list['team_image_b']}}"  alt="{{$list['team_name_b']}}">
                                                            </a></li>
                                                    </ul>
                                                </div>
                                                <div class="team-tickets-content">
                                                    <a href="{{url(app()->getLocale()).'/'.$list['slug']}}"><h2>{{$list['team_name_a']}}<span>vs</span>{{$list['team_name_b']}}</h2></a>
                                                    <div class="popular-date-time">{{$list['match_date']}}  | {{$list['match_time']}}</div>
                                                    <p class="stad_name_show">{{$list['stadium_name']}}</p>
                                                    <p><span>{{$list['tournament_name']}}</span></p>
                                                    <div class="popular-view-btn">
                                                        <a href="{{url(app()->getLocale()).'/'.$list['slug']}}">{{__('messages.view tickets')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                      @endforeach
                         @else
                                    @endif
                                    
                                </div>
                            </div>              
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!----------Popular football ticket end------------>





<section class="epl-about-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="epl-about-left">
                    <div class="football-ticket-heading">
                        <h2>{{__('messages.Why')}}</h2>
                        <h1>{{__('messages.Book With Us')}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="epl-about-book">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="epl-about-right">
                                <div class="epl-about-right-con">
                                    <img src="{{asset('/')}}/public/img/new_img/customer_support.png">
                                </div>
                                <div class="epl-about-right-text">
                                    <h3>{!!__('messages.Friendly Customer Service')!!}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="epl-about-right">
                                <div class="epl-about-right-con">
                                    <img src="{{asset('/')}}/public/img/new_img/bookings_avail.png">
                                </div>
                                <div class="epl-about-right-text">
                                    <h3>{!!__('messages.Last Minute Bookings Available')!!}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="epl-about-right">
                                <div class="epl-about-right-con">
                                    <img src="{{asset('/')}}/public/img/new_img/secure_card.png">
                                </div>
                                <div class="epl-about-right-text">
                                    <h3>{!!__('messages.Secure Payment Methods')!!}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="epl-about-right">
                                <div class="epl-about-right-con">
                                   <img src="{{asset('/')}}/public/img/new_img/fans.png">
                                </div>
                                <div class="epl-about-right-text">
                                    <h3>{!!__('messages.6 years online serving fans')!!}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="epl-popular-teams section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="most-popular">
                    <div class="football-ticket-heading">
                        <h2>{{__('messages.Most')}}</h2>
                        <h1>{{__('messages.Popular Teams')}}</h1>
                    </div>

                    <div id="football_teams" class="topAirSlider owl-carousel owl-theme">

                         @if($top_teams)
                            @foreach($top_teams as $key =>  $list)
                            <div class="item {{ $key == 0 ?  'active' : '' }}">
                                <div class="popular_teams">
                                    <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}"> <img src="{{@$list['team_image']}}" alt="{{$list['team_name']}}">
                                    <h2>{{$list['team_name']}}</h2>
                                    <p>{{$list['total_match']}} {{__('messages.listed')}}</p>
                                     </a>
                                </div>
                            </div>
                             @endforeach
                         @endif

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    $(document).ready(function(){
        jQuery("#football_teams").owlCarousel({
             @if(app()->getLocale() == "ar" ) rtl:true, @endif
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 4
    },

    1366: {
      items: 4
    }
  }
});


        // $("#football_teams").owlCarousel({
        //     autoPlay: 3000, //Set AutoPlay to 3 seconds
        //     items: 4,
        //     itemsDesktop: [1000, 3],
        //     itemsDesktopSmall: [991, 3],
        //     itemsTablet: [767, 2],
        //     itemsMobile: [480, 1],
        //     nav: true,
        //     margin:20,
        //     pagination:true,
        //     navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        // });  
        // $("#football_tickets").owlCarousel({
        //      @if(app()->getLocale() == "ar" ) rtl:true, @endif
        //     autoPlay: 3000, //Set AutoPlay to 3 seconds
        //     items: 1,
        //     itemsDesktop: [1000, 3],
        //     itemsDesktopSmall: [991, 3],
        //     itemsTablet: [767, 2],
        //     itemsMobile: [480, 1],
        //     nav: true,
        //     margin:20,
        //     pagination:true,
        //     navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        // });     
    });
</script>