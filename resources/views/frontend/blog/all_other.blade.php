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


<section class="onebox-blog-page-area section_25">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading-event">
                    <h1><span>{{__('messages.latest and greatest')}}</span></h1>
                        
                </div>
            </div>
        </div>
        
            <div class="row all_blog"></div>

                <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." >
            </div>

        </div>
    
     
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
            <div class="col-md-3">
                <div class="upcoming-event-blogs">
                    <div class="upcoming-match-blogs">
                        <div class="upcoming-match-teams-head">
                            <div class="row">
                                
                                <div class="col-sm-4 pad_five">
                                    <div class="upcoming-blog-head-image">
                                        <a href="{{ url(app()->getLocale().'/'.$row['team_slug_a']) }}">
                                            <img src="{{$row['team_image_a']}}" style="height:60px" alt="{{$row['team_name_a']}}">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="upcoming-blog-team-head-vs">
                                        <span>VS</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 pad_five">
                                    <div class="upcoming-blog-team-head-image">
                                        <a href="{{ url(app()->getLocale().'/'.$row['team_slug_b']) }}">
                                            <img src="{{$row['team_image_b']}}" style="height:60px" alt="{{$row['team_name_b']}}">
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
<script>

    var limit = 12; //The number of records to display per request
    var start = 1; //The starting pointer of the data
     var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active
     //getData();
     $('#search').on('click', function(e){
         load_data(limit,1);
    });
    // function getData(){
    //     $.ajax({
    //         type: "POST",
    //         url: "{{url(app()->getLocale().'/all-games-ajax')}}",
    //         data: $('#filter').serialize()+ '&_token=' + "{{ csrf_token() }}",
    //         beforeSend: function() {
    //             // $("#state-list").addClass("loader");
    //         },
    //         success: function(data){
    //             $(".all_blog").removeAttr("style");
    //             $('.all_blog').html(data.html);
    //         }
    //     });
    // }


  
   


    function load_data(limit, start)
    {

        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale().'/all-blogs-ajax')}}",
            data: { "_token" : "{{ csrf_token() }}",  "limit" :  limit , "page" : start   },
            beforeSend: function() {
                // $("#state-list").addClass("loader");
                $(".loading_img").show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              $(".loading_img").hide();
            },
            success: function(data){
                $(".loading_img").hide();

                
                if(start == 1){
                    $('.all_blog').html("");
                }

                $('.all_blog').append(data.html);


               // console.log(data.html);
                 if(data.html !="")
                {
                    //$('#load_data_message_a').remove();
                    action = 'inactive';
                }
                else
                {                
                    //$('#load_data_message_a').html(loader);
                    action = 'active';
                }
            }
        });


    }

    if(action == 'inactive')
    {
        action = 'active';
        load_data(limit, start);
    }

    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $(".all_blog").height() && action == 'inactive')
        {
            //lazzy_loader(limit);
            action = 'active';
            start = start + 1;
            setTimeout(function(){
                load_data(limit, start);
            }, 1000);
        }
    });


</script>
@endpush('scripts')