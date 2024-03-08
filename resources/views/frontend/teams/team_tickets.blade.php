@extends('layouts.app')
@section('content')
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box tournament_section">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.team tickets')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="bread-img-head">
                    <img src="{{$team['team_image']}}" alt="{{$team['team_name']}}" >
                    <h1>{{$team['team_name']}} @if($type == "home") {{__('messages.home Football tickets')}} @elseif($type == "away")  {{__('messages.away Football tickets')}} @else   {{__('messages.Football tickets')}} @endif</h1>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!-- Breadcromb Area End -->


<!----------Tickets list area start--------------->
<section class="onebox-tickets-list-area section_50">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="onebox-section-heading team-details">
                        <img src="{{$team['team_image']}}" alt="{{$team['team_name']}}">
                        <h1>{{$team['team_name']}}</h1>
                    </div>
                </div>
            </div>

           
            <div class="team_para_img">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="team_para">
                            <p>Paris Saint-Germain (PSG) has been making headlines since the beginning of the 2022 with the addition of Lionel Messi to their already star-studded team. Messi's arrival has brought much excitement and anticipation for what PSG can achieve this season.</p>
                        </div> -->
                    </div>
                    <div class="col-md-6">
                        <div class="team_tickets_img">
                            <img class="imggs" alt="{{$team['team_name']}}" src="{{$team['team_bg']}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            
                
        </div>
</section>
<!----------Tickets list area end----------------->


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
                <div id="football_tickets" class="topAirSlider owl-carousel owl-theme">

                          @if($results)
                          @php $i= 0 ;@endphp
                                @foreach($results as $key => $list)

                        @if($i==0)

                        <div class="item">
                            <div class="popular-tickets">
                                <div class="row">

                        @endif
                               

                                    <div class="col-md-4">
                                  
                                        <div class="col-md-12 nopad">
                                            <div class="popular-tickets-section">
                                                <div class="team-tickets">
                                                    <ul>
                                                        <li><img src="{{$list['team_image_a']}}" alt="{{$list['team_name_a']}}"></li>
                                                        <li><img src="{{$list['team_image_b']}}" alt="{{$list['team_name_a']}}"></li>
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
                       @if($i==5)
                                </div>
                            </div>
                        </div>

                        @endif
                          @php $i++; if($i==6) { $i=0;} ;@endphp
                                   @endforeach
                         @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="no-result-found">
                                    <i class="fas fa-search"></i>
                                    <h3>{{__('messages.no result found')}}!</h3>
                                </div>
                            </div>
                        </div>
                        @endif

                     
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<!----------Popular football ticket end------------>



<section class="popularteams section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="epl_section_about">
                    <div class="epl-about-left">
                        <div class="football-ticket-heading">
                            <h2>{{__('messages.Why')}}</h2>
                            <h1>{{__('messages.Book With Us')}}</h1>
                        </div>
                    </div>
                    <div class="epl_sec_list">
                        <div class="epl-about-right">
                            <div class="epl-about-right-con">
                                <img src="{{url('/')}}/public/img/new_img/customer_support.png">
                            </div>
                            <div class="epl-about-right-text">
                                <h3>{{strip_tags(__('messages.Friendly Customer Service'))}}</h3>
                            </div>
                        </div>

                        <div class="epl-about-right">
                            <div class="epl-about-right-con">
                                <img src="{{url('/')}}/public/img/new_img/secure_card.png">
                            </div>
                            <div class="epl-about-right-text">
                                <h3>{{strip_tags(__('messages.Last Minute Bookings Available'))}} </h3>
                            </div>
                        </div>

                        <div class="epl-about-right">
                            <div class="epl-about-right-con">
                                <img src="{{url('/')}}/public/img/new_img/bookings_avail.png">
                            </div>
                            <div class="epl-about-right-text">
                                <h3>{{strip_tags(__('messages.Secure Payment Methods'))}}</h3>
                            </div>
                        </div>

                        <div class="epl-about-right">
                            <div class="epl-about-right-con">
                               <img src="{{url('/')}}/public/img/new_img/fans.png">
                            </div>
                            <div class="epl-about-right-text">
                                <h3>{{strip_tags(__('messages.6 years online serving fans')) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="epl_section_popular">
                    <div class="football-ticket-heading">
                        <h2>{{__('messages.Most')}}</h2>
                        <h1>{{__('messages.Popular Teams')}}</h1>
                    </div>
                    <div class="epl-section-right" id="content_1">

                        @if($top_teams)
                        @foreach($top_teams as $team)
                         <a href="{{url(app()->getLocale().'/')}}/{{$team['url_key']}}"> 
                            <div class="epl_item">
                            <img src="{{$team['team_image']}}" alt="{{$team['team_name']}}">
                                <div class="epl_item_head">
                                    <h2>{{$team['team_name']}}</h2>
                                    <p>{{$team['total_match']}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @endif

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

 <script src="{{asset('/')}}public/js/jquery.mCustomScrollbar.min.js"></script>

<script>
    $(document).ready(function(){
        $("#football_teams").owlCarousel({
             @if(app()->getLocale() == "ar" ) rtl:true, @endif
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items: 4,
            itemsDesktop: [1000, 3],
            itemsDesktopSmall: [991, 3],
            itemsTablet: [767, 2],
            itemsMobile: [480, 1],
            nav: true,
            margin:20,
            pagination:true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });  
        $("#football_tickets").owlCarousel({
             @if(app()->getLocale() == "ar" ) rtl:true, @endif
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items: 1,
            itemsDesktop: [1000, 3],
            itemsDesktopSmall: [991, 3],
            itemsTablet: [767, 2],
            itemsMobile: [480, 1],
            nav: true,
            margin:20,
            pagination:true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });     
    });
</script>

 <script>
     $('#search').on('click', function(e){
        getData();
    });
    function getData(){
        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale().'/'.$team['url_key'].'/ajax')}}",
            data: $('#team-filter').serialize()+ '&_token=' + "{{ csrf_token() }}",
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){
                $('.onebox-tickets-list').html(data.html);
            }
        });
    }

    $("#tournament").on('change', function(){
        $('#tournament_form').submit();
    });
</script>

<script type="text/javascript">
$("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });        
</script>
@endpush('scripts')