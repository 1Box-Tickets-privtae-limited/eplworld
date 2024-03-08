@extends('layouts.mobile')
@section('content')
     
     <!-- Slider Area Start -->
    <section class="onebox-slider-area">
        <div class="onebox-slide owl-carousel owl-theme" >
             @if($banners)
                @foreach($banners as $banKey => $list)
            <div class="onebox-main-slide item slide-item-{{($banKey+1)}}" style="background-image: url({{$list['image']}})">
                <div class="onebox-main-caption">
                    <div class="onebox-caption-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <p>{{$list['title']}}</p>
                                    <h1>{!!$list['description']!!}</h1>
        

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
            @endif
            
        </div>

        <div class="search_teams">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="search-section">
                            <form autocomplete="off" action="{{url(app()->getLocale().'/advance-search')}}"method="get">
                            <input  id="eventname" type="text" name="keywords" placeholder="{{__('messages.search box placeholder')}}">
                            <!-- <input type="submit" value="{{__('messages.search')}}"> -->
                            <button type="submit"><i class="fas fa-search"></i><span class="srch"> {{__('messages.search')}} </span></button>
                            </form>
                            <div class="home-search-div">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider Area End -->
    
    
    <!-- Gallery Masonary Page Start -->
    <section class="onebox-gallery-masonary">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="team_sec">
                        <div class="tabs">
                            <ul class="nav nav-pills hiddendiv">
                                <li class="active"><a data-toggle="pill" href="#home">{{__('messages.teams')}}</a></li>
                                <li><a data-toggle="pill" href="#menu1">{{__('messages.leagues')}}</a></li>
                                <li><a data-toggle="pill" href="#menu2">{{__('messages.cups')}}</a></li>
                            </ul>
          
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div id="TopAirLine" class="topAirSlider owl-carousel owl-theme">
                                    @if($teams)
                                        @foreach($teams as $list)
                                           <div class="item home-tab-link">
                                             <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}">
                                                <img src="{{$list['team_image']}}"
                                                ></a>
                                                <p class="no-underline">{{$list['team_name']}}</p>
                                                <a href="{{url(app()->getLocale())}}/{{$list['url_key']}}">{{__('messages.tickets')}}</a>
                                            </div>
                                          
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div id="TopAirLine_new" class="topAirSlider owl-carousel owl-theme">
                                    @if($teams)
                                        @foreach($leagues as $list)
                                         
                                            <div class="item home-tab-link">
                                                 <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">
                                                <img src="{{$list['tournament_image']}}"></a>
                                                <p>{{$list['tournament_name']}}</p>
                                                <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">{{__('messages.tickets')}}</a>
                                            </div>
                                          
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div id="TopAirLine_first" class="topAirSlider owl-carousel owl-theme">
                                    @if($teams)
                                        @foreach($cups as $list)
                                       
                                            <div class="item home-tab-link">
                                                 <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">
                                                <img src="{{$list['tournament_image']}}"> </a>
                                                <p>{{$list['tournament_name']}}</p>
                                                <a href="{{url(app()->getLocale()).'/'.$list['url_key']}}">{{__('messages.tickets')}}</a>
                                            </div>
                                       
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Masonary Page Start -->

    <div class="ajax-result"></div>
    <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." ></div>

<!-------------------newsletter start------------------------------>
<!-------------------newsletter start------------------------------>
<section class="onebox-notfound-area section_50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <!-- <h2>{{__('messages.subscribe')}} <span>& {{__('messages.connect with us')}}</span></h2> -->
                        <h2><span>{{__('messages.connect with us')}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="onebox-notfound">
                       <h4>{{__('messages.be the first to know about price changes, latest offers and fixture updates')}}</h4>
                        <form method="post" action="{{url(app()->getLocale().'/subscribe')}}" id="subscribe">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="email" placeholder="{{__('messages.enter your email address')}}" type="email" id="subscribe_email">
                            <button type="submit">
                                {{__('messages.submit')}}
                            </button>
                        </form>
                        <p id="subscribe_error" class="error"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style type="text/css">
        #subscribe_message  .confirm-img{ width: 100px; }
        #subscribe_message  .modal-content { padding: 30px; }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="subscribe_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
         
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-body text-center">
            <img src="{{url('public/img/confirm.png')}}" class="confirm-img" alt="">
            <h2 class="mt-3">Your email has been subscribed successfully.</h2>
            <div class="tick_book_btn mt-2"><button type="button" data-dismiss="modal" aria-label="Close">Close</button></div>
          </div>
          
        </div>
      </div>
    </div>

<!-------------------newsletter end--------------------------------->
<!-------------------newsletter end--------------------------------->
@endsection
@push('scripts')
 <script>
$(document).ready(function(){

 @if($redirect == "login")
$("#loginModal").trigger("click");
 @endif
 
     $(document).mouseup(function(e) 
        {
            var contai2ner = $(".home-search-div");

            // if the target of the click isn't the container nor a descendant of the container
            if (!contai2ner.is(e.target) && contai2ner.has(e.target).length === 0) 
            {
                contai2ner.hide();
            }
        });

    $.ajax({
        type: "GET",
        url: "{{url(app()->getLocale().'/home-ajax')}}",
        data: "",
        beforeSend: function() {
            $(".loading_img").show();
        },
        success: function(data){
            $(".loading_img").hide();
            $('.ajax-result').html(data.html);
            $(".hiddendiv").css("display", "block");
             var upcoming_date = $(".upcoming-date-time").data("date");
            if(upcoming_date  !== 'undefined'){
                upcoming_events(upcoming_date);
            }
        }
    });


     $(".onebox-slide").owlCarousel({
        @if(App::getLocale() == "ar") rtl: true,@endif
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
          responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true,
                loop:false
            }
        },
        nav: true,
        pagination:true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
  });   


        // $(".onebox-slide").on("translate.owl.carousel", function(){
        //     $(".onebox-main-slide h2, .onebox-main-slide p").removeClass("animated fadeInUp").css("opacity", "0");
        //     $(".onebox-main-slide .onebox-btn").removeClass("animated fadeInDown").css("opacity", "0");
        // });
        // $(".onebox-slide").on("translated.owl.carousel", function(){
        //     $(".onebox-main-slide h2, .onebox-main-slide p").addClass("animated fadeInUp").css("opacity", "1");
        //     $(".onebox-main-slide .onebox-btn").addClass("animated fadeInDown").css("opacity", "1");
        // });

       $("#TopAirLine").owlCarousel({
        @if(App::getLocale() == "ar") rtl: true,@endif
    items: 6,
    dots: true,
    nav: true,
    pagination:true,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:2,
            mouseDrag: true,
            touchDrag: true
        },
        480:{
            items:3,
            mouseDrag: true,
            touchDrag: true
        },
        750:{
            items:4,
            mouseDrag: true,
            touchDrag: true
        },
        1000:{
            items:6,
            dots: false,
            mouseDrag: false,
            touchDrag: false
        }
    }
});

    $("#TopAirLine_new").owlCarousel({
        @if(App::getLocale() == "ar") rtl: true,@endif
    items: 6,
    dots: true,
    nav: true,
    pagination:true,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:2,
            mouseDrag: true,
            touchDrag: true
        },
        480:{
            items:3,
            mouseDrag: true,
            touchDrag: true
        },
        750:{
            items:4,
            mouseDrag: true,
            touchDrag: true
        },
        1000:{
            items:6,
            dots: false,
            mouseDrag: false,
            touchDrag: false
        }
    }
});

    $("#TopAirLine_first").owlCarousel({
        @if(App::getLocale() == "ar") rtl: true,@endif
    items: 6,
    dots: true,
    nav: true,
    pagination:true,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:2,
            mouseDrag: true,
            touchDrag: true
        },
        480:{
            items:3,
            mouseDrag: true,
            touchDrag: true
        },
        750:{
            items:4,
            mouseDrag: true,
            touchDrag: true
        },
        1000:{
            items:6,
            dots: false,
            mouseDrag: false,
            touchDrag: false
        }
    }
});

//       function getTimeRemaining(endtime) {
//   const total = Date.parse(endtime) - Date.parse(new Date());
//   const seconds = Math.floor((total / 1000) % 60);
//   const minutes = Math.floor((total / 1000 / 60) % 60);
//   const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
//   const days = Math.floor(total / (1000 * 60 * 60 * 24));
  
//   return {
//     total,
//     days,
//     hours,
//     minutes,
//     seconds
//   };
// }

// function initializeClock(id, endtime) {
//   const clock = document.getElementById(id);
//   const daysSpan = clock.querySelector('.days');
//   const hoursSpan = clock.querySelector('.hours');
//   const minutesSpan = clock.querySelector('.minutes');
//   const secondsSpan = clock.querySelector('.seconds');

//   function updateClock() {
//     const t = getTimeRemaining(endtime);

//     daysSpan.innerHTML = t.days;
//     hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
//     minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
//     secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

//     if (t.total <= 0) {
//       clearInterval(timeinterval);
//     }
//   }

//   updateClock();
//   const timeinterval = setInterval(updateClock, 1000);
// }

// const deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
// initializeClock('clockdiv', deadline);


  $("#subscribe").validate({
        rules : {
            email : {
                required: true,
                email : true
            }
        },
        submitHandler: function(form) {
            $("#subscribe_error").hide();
            $("#subscribe_error").html("");
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status == 1){
                        //alert(response.message);
                        $("#subscribe_message").modal("show");
                        $("#subscribe_email").val("");
                    }
                    else{
                        $("#subscribe_error").html(response.message);
                        $("#subscribe_error").show();
                    }
                }            
            });
            return false;
        }
    });
});
      $('#eventname').keyup(function (e) {
       // if ($(this).val().length > 2) {
           // $(".home-search-div").empty();
            search();
       // }
    });

    function search() {
        var baseUrl = '{{url(app()->getLocale())}}/';
       // console.log(baseUrl);
        var title = $("#eventname").val();
            $.ajax({
                type: "post",
                url: baseUrl +  "search_data",
                data: {teamname : title ,  _token: "{{ csrf_token() }}",},
                dataType: "json",
                success: function (response) {
                    //console.log(response);
                    if ($("#eventname").val() != '' && response != '') {
                        $(".home-search-div").show();
                      
                        display = response;
                        var html_data = "";
                        $.each(display, function(i, member) {
                            // console.log(display[i]);
                            // console.log(i);
                            html_data += "<h3>"+i+"</h3>";
                            html_data += "<ul>";
                             $.each(display[i], function(i, data) {
                                //    console.log(data.name);
                            var url = "";
                            var name = data.name;
                            if(data.type =="Teams"){
                                // url  = baseUrl +"team-ticket/" + data.url +"/all";
                                 url  = baseUrl + data.url_key;
                            }
                            if(data.type =="Matches"){
                               //  url  = baseUrl +"tournaments/ticket/" + data.url;
                                   url  = baseUrl + data.url;
                                 name += " - "+data.date;
                            }
                            if(data.type =="Tournaments"){
                                 url  = baseUrl + data.url_key;
                            }
                            if(data.type =="Country"){
                                 url  = baseUrl +"advance-search?country=" + data.url;
                            }
                            if(data.type =="City"){
                                 url  = baseUrl +"advance-search?city=" + data.url;
                            }
                            if(data.type =="Stadium"){
                                 url  = baseUrl +"advance-search?stadium=" + data.url;
                            }
                            html_data += "<li><a href='"+url+"'>"+name+"</a></li>";
                            
                            });
                             html_data +="</ul>";

                        });
                        $(".home-search-div").html(html_data);
                        //$("#eventname").val("");
                    
                    }  else if ($("#eventname").val() != '') {
                        
                        $(".home-search-div").show();
                        $(".home-search-div ul").html("<li>No Data Found</li>");
                        //$("#eventname").val("");
                    } else {
                        $(".home-search-div").hide();
                    
                    
                    }
                    
                    
                }
            });
       


    }




    function hoverSearch(obj) {
        $('#dataurl').empty();
        $('#eventname').empty();
        var teamName = obj.getAttribute('data-value');
        var DataUrl = obj.getAttribute('data-url');
        $('#dataurl').val(DataUrl);
        $('#eventname').val(teamName);
    }
    
 $( "#event_name" ).submit(function( event ) {
        
         var dataurl = $('#dataurl').val();
         window.location.href = dataurl;
        
        return false;
    
    });
    
    
    
    $('.homesearch-section').click(function () {
        var dataurl = $('#dataurl').val();
        location.href = dataurl;
        $('#eventname').empty();
    });


   function upcoming_events(events_date){
        // Set the date we're counting down to
        var countDownDate = new Date(events_date).getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $("#clockdiv .days").html((days >=10 ? days : "0" + days) + ":");
            $("#clockdiv .hours").html((hours >=10 ? hours : "0" + hours) + ":");
            $("#clockdiv .minutes").html((minutes >=10 ? minutes : "0" + minutes) + ":");
            $("#clockdiv .seconds").html((seconds >=10 ? seconds : "0" + seconds) );
            // Display the result in the element with id="demo"
            // document.getElementById("clockdiv").innerHTML = days + "d " + hours + "h "
            // + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("clockdiv").innerHTML = "EXPIRED";
            }
        }, 1000);
}
</script>

@endpush('scripts')

