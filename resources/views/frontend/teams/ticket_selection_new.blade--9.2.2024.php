@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/css/svgmap.css">
<style type="text/css">
   /* svg{
            transform: scale(1) !important;
    }*/

    path{
         -moz-transition: all 0.5s ease;  /* FF4+ */
            -o-transition: all 0.5s ease;  /* Opera 10.5+ */
            -webkit-transition: all 0.5s ease;  /* Saf3.2+, Chrome */
            -ms-transition: all 0.5s ease;  /* IE10? */
            transition: all 0.5s ease;
    }
    .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}

.svg-stadium g text {
    fill: #000 !important;
    font-family: 'Poppins' !important;
    font-weight: 500 !important;
    stroke: transparent;
}

.svg-stadium rect, .svg-stadium g, .svg-stadium path {
    cursor: pointer !important;
}
.block{ stroke:#CCC !important; opacity:0.3 }

.hover .block
    {
        fill: #f8f8f8 !important;
    }

</style>
</style>
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.ticket selection')}}</li>
                    </ul>
                </div>
            </div>
        </div>

      
    </div>
</section>
<!-- Breadcromb Area End -->

@if($results['match_status'] == 1)


<section class="ticket-star-rating">
    <div class="container">
        <div class="star_rate">

            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <div class="last-match-result-one last-match-result">
                        <div class="result-details">
                            <div class="last-match-logo">
                                <a href="{{url(app()->getLocale().'/')}}/{{$results['team_slug_a']}}"><img src="{{$results['team_image_a']}}" style="height:140px" alt="{{$results['team_name_a']}}"></a>
                                <h3 class="result-details-left">
                                <a href="{{url(app()->getLocale().'/')}}/{{$results['team_slug_a']}}">{{$results['team_name_a']}}</a>
                            </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="v_s">vs</div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <div class="last-match-result-one last-match-result">
                            <div class="result-details">
                                <div class="last-match-logo">
                                    <a href="{{url(app()->getLocale().'/')}}/{{$results['team_slug_b']}}"><img src="{{$results['team_image_b']}}" style="height:140px" alt="{{$results['team_name_b']}}"></a>
                                    <h3 class="result-details-left">
                                    <a href="{{url(app()->getLocale().'/')}}/{{$results['team_slug_b']}}">{{$results['team_name_b']}}</a>
                                </h3>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

           
            <div class="row">
                <div class="star_ratings">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="ticket_guarantee">
                            <div class="popular-date-time">{{$results['match_date']}}  | {{$results['match_time']}}</div>
                            <p>{{$results['stadium_name']}}</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="ticket_guarantee_view">
                        <p>{{$results['tournament_name']}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="ticket_guarantee_rig">
                            <div class="rating_star">
                                <p>{{__('messages.stars rated')}}</p>
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





@else
<div class="mt-5"></div>
@endif
<!----------Tickets list area start--------------->
<section class="onebox-tickets-selection section_50">
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="onebox-selection-heading">
                    <h2>Tickets <span>Selection</span></h2>
                </div>
            </div>
        </div> -->


        <div class="row column_mobile">
            <div class="col-md-5 position_stct" style="position: sticky; top: 20px;" >
                <h5 class="avail_tick">{{$results['stadium_name']}}</h5>
                <div class="ticket_select_img">

                    <div class="zoom-control" style="position: absolute;right: 10px;z-index: 1000;">
                              @if($mobile_view != 1)
                              <div id="zoom-out" class="map-zoom-out zoom-decrement1 btn "><i class="fa fa-minus"></i></div>
                                <div id="zoom-in" class="map-zoom-in zoom-increment1 btn "><i class="fa fa-plus"></i></div>
                            @endif
                                <div id="zoom-reset" class="map-zoom-out zoom-reset1 btn "><i class=" fas fa-sync"></i></div>
                           </div>

                           <div id="mobile-zoom-svg-1">
                                        <div id="svgStadium">

                                              <img src="{{$stadium['stadium_image']}}" id="map_svg">

                                    </div>
                                </div>


                       <!-- <h4>This map is for illustrative purpose only, actual seats may very depending on allocation by official organisers</h4> -->
                       <h4>{{__('messages.this map is for illustrative purpose only, actual seats may very depending on allocation by official organisers')}}</h4>


                    <div class="select_sec">
                  
                        @if($category)
                        <h4>{{__("messages.select a section that you like to be seated in")}}</h4>
                        <ul>

                                @foreach($category as $list)
                                @if($list['seat_category'])
                                    <li>
                                        <a href="javascript:void(0)" class="seat_avaiable" data-id="{{$list['stadium_seat_id']}}">
                                            <span class="seat_color"  style="background:{{$list['block_color']}} ;"></span>{{$list['seat_category']}}
                                        </a>
                                    </li>
                                    @endif
                                @endforeach  
                        </ul>
                         @endif
                    </div> 
                </div>

                

                <div class="mobile_view">
                    <div class="booking-project">
                        <p>{{__('messages.ticket refund protection')}}</p>
                        <img src="{{asset('/')}}/public/img/booking-protect.png" alt="Booking Protect">
                    </div>
                </div>                
                
                <!-- <div class="stadium_para">
                    {!!$results['description'] !!}
                </div> -->
                <div class="stadium_para_notes">
                    <h4>{{__('messages.please note')}}</h4>
                    <ul>
                        <li>{{__('messages.event date and time are subject to change - check with the venue for start times and/or age restrictions.')}}</li>
                        <li>{{__('messages.all sales are final')}}</li>
                        <li>{{__('messages.no cancellations')}}</li>
                        <li>{{__('messages.100 ticket guarantee')}}</li>
                    </ul>
                    
                </div>
            </div>
            <div class="col-md-7 ticket_list">
                <h5 class="avail_tick">{{__('messages.available tickets')}}</h5>
                @if($results['match_status'] == 1)

                     @if(@$results['total_quantity'] > 0  && @$results['total_quantity'] <= 15)
                    <div class="onebox-tickets-boook_details">
                        <div class="tickets_left">
                             <p><!-- 
                                @php 

                                $ticket_count_alert =  __('messages.only tickets left for this event')  ;
                                @endphp
                                {!! str_replace("{%COUNT%}",$results['total_quantity'],$ticket_count_alert) !!}
                               <i class="fas fa-fire"></i></p> -->
                        </div>
                    </div>
                    @endif

                    @if(@$results['total_quantity'] > 0)
                    <input type="hidden" name="ticket_block_id" id="ticket_block_id">
                    <div class="tickets_dropdown">
                        <div class="ticket_quantity select">

                            <select name="quantity" id="noofticket" class="form-control"> <i class="fas fa-sliders-h"></i>
                                <option value="">{{__('messages.ticket quantity')}}</option>
                                @if($ticketQuantity)
                                    @for($i=1; $i<=$ticketQuantity;$i++)
                                        <option value="{{$i}}">{{$i}}</value>
                                    @endfor
                                @endif                        
                            </select>
                        </div>
                        <div class="ticket_quality select">
                            <select name="types" id="allticktype" class="form-control">
                                <option value="">{{__('messages.ticket types')}}</option>
                                @if($category)
                                    @foreach($category as $list)
                                        <option value="{{$list['ticket_category']}}">{{$list['seat_category']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- <div class="ticket_value">
                            <p>{{__('messages.ticket prices are set by sellers and may be below or above face value')}}</p>
                        </div> -->
                    </div>

                     <div class="tickets_details_list"></div>
                     
                   <div class="row">
                        <div class="col-md-12 ">
                            <div class="progress_bar_val" id="loading_2">
    <h3>{{__('messages.ticket progress maessage')}}</h3>
    <img class="img-responsive images" src="{{asset('/')}}/public/img/stadiums.png?v=1" alt="Stadium Loading">
 <!--    <p><span>Less than 3% of total tickets in the venue currently available on our site <i class="fa fa-info-circle" aria-hidden="true"></i></span></p> -->
<div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:5%">
        5%
    </div>
  </div>
</div>
                         <!-- <div  class="loading-bar-spinner spinner mt-5" id="loading_2"><div class="spinner-icon"></div></div> -->
                     </div>
                    </div>
                   

                    @else
                        <div class="no_ticket_found">
                        <p class="text-center">
                            {{__('messages.currently no ticket amount')}}
                           
                        </p>
                        <p class="text-center"><a href="javascript:void(0)" onClick="requestNow({{$results["m_id"]}},'{{$results["match_date"]}}','{{$results["match_time"]}}')" class="onebox-btn request_btn">{{__('messages.request now')}}</a> </p>
                    </div>
                    @endif

                    @else

                    <div class="no_ticket_found">
                        <p class="text-center">
                             Currently there are no available tickets for this event. If you are looking any upcoming matches 

                              <p class="text-center"><a class="onebox-btn " href="{{url(app()->getLocale().'/advance-search')}}"> Click Here</a></p>
                        </p>
                       
                    </div>
                    @endif
                   
            </div>
        </div>
    </div>
</section>
<!----------Tickets list area end----------------->

<div class="stadium_para_mobile">
    <div class="container">
        <div class="stadium_para_txt">
                {!!$results['description'] !!}
        </div>
    </div>
</div>



<section class="epl-about-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="epl-about-left">
                    <div class="football-ticket-heading">
                        <h2>{{__('messages.Why')}}</h2>
                        <h1>{{__('messages.Book With Us')}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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

<!----------------about us section start---------->
<section class="onebox-about-us section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-about-us-sec">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6 full_widd">
                            <div class="delievry_partners">
                                <p>{{__('messages.Our Delivery Partners')}}</p>
                                <div class="single-about-right-text">
                                    <div class="col-md-6">
                                        <div class="fedex_img">
                                            <img src="{{url('/')}}/public/img/our_partners/fedex.png?v=1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mail_royal">
                                            <img src="{{url('/')}}/public/img/our_partners/mail.png?v=1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6 full_widd">
                            <div class="delievry_partners">
                                <p>{{__('messages.Secure Online Processing')}}</p>
                                <div class="single-about-right-text">
                                    <p>{!!__('messages.Transactions on the site are protected with up to 256-bit Secure Sockets Layer encryption.')!!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-6 full_widd">
                            <div class="delievry_partners">
                                <p>{{__('messages.Accepted Payment Methods')}}</p>
                                <div class="single-about-right-text pay_methods">
                                    <ul>
                                        <li><img src="{{url('/')}}/public/img/our_partners/visapng.png?v=1"></li>
                                        <li><img src="{{url('/')}}/public/img/our_partners/master_cards.png?v=1"></li>
                                        <li><img src="{{url('/')}}/public/img/new_img/g_pay.png"></li>
                                        <li><img src="{{url('/')}}/public/img/our_partners/apple_pay.png?v=1"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!----------------about us section end---------->



<div style="display: none;" class="">
<!--   @php 
    $sourcetype = "";
    if(@$_SERVER['HTTP_TRUE_CLIENT_IP'] == "49.37.201.150"){
     
    }
  @endphp -->
</div>
@endsection
@push('scripts')



    <script type="text/javascript">
        var mobile_view = {{$mobile_view}};
    </script>
    <script src="{{url('public/js/umd_popper.min.js')}}"></script>
<script src="{{url('public/js/tippy.js')}}"></script>

<script type="text/javascript" src="{{url('public/js/svg-load.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/panzoom.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/panzoom.js')}}"></script>
@if($mobile_view != 1)
<script type="text/javascript" src="{{url('public/js/map-zoom.js?v=1.7')}}"></script>
@endif

 <script type="text/javascript">
    var mobile_view = {{$mobile_view}};

    var stadium_json = {!!@$stadium['map_code']!!};
    var currentFilter = [];
    var currentBlock = "";
    // Map Initial 
    $('#map_svg').inlineSvg();

    function load_category(json_data){
        $.each(json_data, function (indx, itm) {
            $('[data-section="'+itm.full_block_name+'"] .block').css('fill',itm.block_color);
            $('[data-section="'+itm.full_block_name+'"] .block').attr("data-category-id",itm.category);
            $('[data-section="'+itm.full_block_name+'"] .block').attr("data-color",itm.block_color);
            if(itm.price){
                $('[data-section="'+itm.full_block_name+'"]').addClass("dark").attr("data-price",itm.price);
            }      
        });
    }

    setTimeout(function () {
        load_category(stadium_json);
    },800);

   function load_block(){
        $(".dark").each(function(i,val) {

            var tf = $(this).attr("id",'ii-'+i) ;

            var tf = $(this).find("text").attr("transform");
            // console.log(tf);
            var st_c = $(this).find(".block").attr("data-color");
            var bbox = $(this).find("text")[0].getBBox();
            var width = bbox.width;
            var height = bbox.height;
            height =   Math.round(bbox.height);
            var boxHeight = height - 4 ;
            var st = '<circle transform="'+tf+'"  class="circle-style" cx="'+boxHeight+'"  r="6" fill="'+st_c+'"  cx="'+boxHeight+'"  />';
            this.insertAdjacentHTML( 'beforeend', st );


            var section_cat =  $(this).attr('data-section').split('_')[0];

            var cat_ids = $(this).find('[data-category-id]').attr('data-category-id') ; 


            var data_filter = stadium_json.filter(function(item){
 
                    return item.category == cat_ids ;         
                })
            var data_category ="";
            if(data_filter.length >0){
                 data_category =  data_filter[0]['seat_category'];
            }



            // console.log( $(this).attr('data-section'));
            var section =     $(this).attr('data-section').trim().toLowerCase().replaceAll(section_cat.trim().toLowerCase(), "");

            var price =   $(this).attr('data-price');
            var class123 = $(this).parent().data('category');
        
            var tol_cc  =  '<div class='+class123+'><span style="font-size:12px"><b style="font-size:12px">'+data_category+'</b></span>\
            </br><span class=""> Section : '+section.trim().toUpperCase().replaceAll("_", " ")+'</span>\
            </br><span class=""><b>From '+price+'</b></span></div>';

            tippy('#ii-'+i, {
              content: tol_cc,
               allowHTML: true
            });


        });
        
        /**** tooltip */
        // $('.dark').tooltip({
        //     title:   function() {
        //         var section_cat =  $(this).attr('data-section').split('_')[0];

        //         var cat_ids = $(this).find('[data-category-id]').attr('data-category-id') ; 


        //         var data_filter = stadium_json.filter(function(item){
     
        //                 return item.category == cat_ids ;         
        //             })
        //         var data_category ="";
        //         if(data_filter.length >0){
        //              data_category =  data_filter[0]['seat_category'];
        //         }

        //         // console.log( $(this).attr('data-section'));
        //         var section =     $(this).attr('data-section').trim().toLowerCase().replaceAll(section_cat.trim().toLowerCase(), "");

        //         var price =   $(this).attr('data-price');
        //         var class123 = $(this).parent().data('category');
            
        //         return '<div class='+class123+'><span style="font-size:12px"><b style="font-size:12px">'+data_category+'</b></span>\
        //         </br><span class=""> Section : '+section.trim().toUpperCase().replaceAll("_", " ")+'</span>\
        //         </br><span class=""><b>From '+price+'</b></span></div>';
        //     },
        //     html: true,
        //     placement: 'top',
        //     content:"content", container:".ticket_left_selection"
        // });
    }
    setTimeout(function(){
        // console.log("-----");
        // console.log($(".dark").length);
        load_block();
    }, 1000);

     $("body").on("click","[data-section]",function(){
        $("#ticket_block_id").val("");
        if($(this).hasClass("dark")){

            var b_id = $(this).attr('data-section').split("_").pop();
            $("#ticket_block_id").val(b_id)

            currentBlock = $(this).attr('data-section');
        }
        else{
            currentBlock ="";
        }
        var cd_id = $(this).find(".block").attr("data-category-id");
        get_ticket(cd_id,1);

        $('[data-section]').addClass("hover");

          //$('[data-category-id='+ cd_id +']').parents("[data-section]").removeClass("hover");
         currentFilter =[]
         currentFilter.push(cd_id);
        unhover();

       //  $(this)

     });

    $(document).on('mouseleave', '.svg-stadium', function () {
       if(currentFilter.length > 0 ){
            $('[data-section]').addClass("hover");
        }
          unhover();
        if(currentFilter.length  ==0){
             $('[data-section]').removeClass("hover");
        }
    });


    $(document).on('mouseenter', '.svg-stadium [data-section]', function () {
       
        $('[data-section]').addClass('hover');
        var $this = $(this);
        var cg_id = $(this).find(".block").attr("data-category-id");

        $("[data-category-id="+cg_id+"]").parents("[data-section]").removeClass('hover');
      // unhover();

            if(currentBlock){
            var val = currentBlock;
            //// console.log($("#ticket_block_id").val());
            $('[data-section='+ val +']').removeClass("hover");
         }
         else{
         $.each(currentFilter, function (i,val) {
                     $('[data-category-id='+ val +']').parents("[data-section]").removeClass("hover");
                }); 
     }

    });

    function unhover() {
         if(currentBlock){
            var val = currentBlock;
            //// console.log($("#ticket_block_id").val());
            $('[data-section='+ val +']').removeClass("hover");
         }
         else{
          
            if(currentFilter.length > 0 ){
                    $.each(currentFilter, function (i,val) {
                     $('[data-category-id='+ val +']').parents("[data-section]").removeClass("hover");
                }); 
            }
            else{
                $("[data-section]").removeClass("hover");
            }
            
 
         }

 }
         
</script>

<script type="text/javascript">


      $(function () {
            $("body").on("click",".add_to_cart_button",function(){
                var id = $(this).data('id');
                     
                    $(this).text('Loading..');
                    $(this).prop("disabled",true);
                    var that =  $(this);
                 $("#add_to_cart_" + id).validate({
                      submitHandler: function (form) {
                      
                        $.ajax({
                            url: "{{url(app()->getLocale().'/add-to-cart')}}",
                            type: "post",
                            dataType: "json",
                            data:  $("#add_to_cart_" + id).serialize(),
                             error: function (error) {

                               alert("Ticket Not unavailable");
                                 $(that).text("No Tickets");
                            },
                            success: function(response) {
                                if(response.status == 1){
                                   window.location.href = "{{url(app()->getLocale().'/checkout')}}";
                                }
                                else{
                                    alert("Sorry.Ticket is not available.Please choose another ticket");
                                      $(that).text("No Tickets");
                                    // console.log(response);
                                }

                            }            
                        }); 
                        return false;
                      }
                 });
                 $("#add_to_cart_" + id).submit();
            });
        
        });

   // get_ticket(1)
    var limit = 10;
    var start = 1; 
    var action = 'inactive'; 

    if(action == 'inactive')
    {
        action = 'active';
        get_ticket(0, start);
    }

     $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $(".ticket_list").height() && action == 'inactive')
        {
            //lazzy_loader(limit);
            action = 'active';
            start = start + 1;
            setTimeout(function(){
                var cat = $("#allticktype").val();
                get_ticket(cat , start);
            }, 1000);
        }
    });


     $('#noofticket, #allticktype').change(function(){
        var cat = $('#allticktype').val();
      //  // console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
     });

     $("body").on("click",".seat_avaiable",function () {


        var ava_category_id =  $(this).data('id');
         currentFilter =[];
         currentFilter.push(ava_category_id);
         // $("[data-category-id="+ava_category_id+"]").parents("[data-section]").removeClass('hover');
          $('[data-section]').addClass("hover");
        unhover()
        // console.log(parseInt(ava_category_id));
       // $('#ticket_block_id').val("");
        selectCategory(parseInt(ava_category_id));
     });

   function get_ticket(cat,page){
    var timer_load = "";
        var qty = $('#noofticket').val();
        var block_id = $('#ticket_block_id').val();
        if(page == 1){
            if(qty == "" && cat <= 0){
                $("#loading_2").removeClass("loading-bar-spinner spinner mt-5");
                $("#loading_2").addClass("progress_bar_val");
                $("#loading_2").html("<h3>{{__('messages.ticket progress maessage')}}</h3>"+
                        '<div class="progress">'+
                        '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="10"  aria-valuemax="100" style="width:10%">10%</div>'+
                        '</div>');
            }
            else{
                $("#loading_2").removeClass("progress_bar_val");
                // $("#loading_2").addClass("loading-bar-spinner spinner mt-5");
                $("#loading_2").html('<div class="loading-bar-spinner spinner mt-5"><div class="spinner-icon"></div></div><h5 class="text-center">{{__("messages.Please Wait We Are Loading More Tickets")}}</h5>');
            }
            $("#loading_2").show();
            $('.tickets_details_list').html("");
        }
        else{
             $("#loading_2").show();
            $("#loading_2").removeClass("progress_bar_val");
            // $("#loading_2").addClass("loading-bar-spinner spinner mt-5");
            $("#loading_2").html('<div class="loading-bar-spinner spinner mt-5"><div class="spinner-icon"></div></div><h5 class="text-center">{{__("messages.Please Wait We Are Loading More Tickets")}}</h5>');
        }
               
            
        if(page == 1){
            let percent = 10;
            
              timer_load = setInterval(() => {
              var div =  $('.progress-bar');
              percent += 10;
               $('.progress-bar').css({width: percent + "%"}, 100).text(percent + "%");
              if ( percent >= 90 ) clearInterval(timer_load);
             }, 1000);
        }  

       
        $.ajax({
            url: "{{url(app()->getLocale().'/ticlet-selection-filter')}}",
            type: "post",
            dataType: "json",
            data: {"quantity":qty, "category":cat,"match_id":{{$results['m_id']}},"block_id":block_id,"_token":"{{ csrf_token() }}",'limit' : limit ,'page' : page },
            beforeSend: function(){
                if(page == 1){
                    if($(".tickets_dropdown").length > 0){
                        // $('html, body').animate({
                        //         scrollTop: $(".tickets_dropdown").offset().top
                        // });
                    }
                    if(qty == "" && cat <= 0){
                        // $('.progress-bar').animate({width: "40%"}, 100);
                        // $('.progress-bar').text("40%");
                    }
               }
            },
            error: function (error) {
                $("#loading_2").hide();
                 $('.tickets_details_list').append("<h3 class='text-center'>Sorry Server Error</h3>");
            },
            success: function(response) {
                clearInterval(timer_load);
                //  percent = 80;
                if(qty == "" && cat <= 0){
                    // $(".progress-bar").animate({width: "80%"}, 150);
                    // $(".progress-bar").text("80%");
                     setTimeout(function(){
                        $('.progress-bar').css({width: "100%"});
                        $('.progress-bar').text("100%");
                        setTimeout(function(){
                            if(response.success == true && response.html != ""){
                                $("#loading_2").hide();
                                if( page  == 1 ){
                                    $('.tickets_details_list').html(response.html);
                                }
                                else{
                                    if(response.count > 0){
                                    $('.tickets_details_list').append(response.html);
                                    }
                                }

                                $('.progress-bar').css({width: "0%"});
                                $('.progress-bar').text("0%");
                            } 
                             if(response.count > 0){
                                action = 'inactive';
                            }
                            else{         
                                action = 'active';
                            }

                               $(".exp-time-desk").each(function() {
                                    var sec = $(this).attr("data-sec");
                                    var id = $(this).attr("data-id");
                                 // // console.log(id + "-" + sec);
                                    timer(id, sec)
                                }); 

                            /* if(response.html !=""){
                                //$('#load_data_message_a').remove();
                                action = 'inactive';
                            }
                            else{                
                                //$('#load_data_message_a').html(loader);
                                action = 'active';
                            }*/

                        }, 500);
                    }, 500);
                }
                else{
                    if(response.success == true && response.html != ""){

                        $("#loading_2").hide();

                         if( page  == 1 ){
                            $('.tickets_details_list').html(response.html);
                        }
                        else{
                            if(response.count > 0){
                            $('.tickets_details_list').append(response.html);
                            }
                        }

                         if(response.count > 0){
                                    action = 'inactive';
                                }
                                else{         
                                    action = 'active';
                                }
                }  
                 }

                // console.log(response.block_lists);
                
                 // if(response.block_lists.length){
                 //     $.each(response.block_lists, function (indx, itm) {
                 //        $('[data-section="'+itm.full_block_name+'"]').addClass("dark").attr("data-price",itm.price);   
                 //    });
                 // }
                setTimeout(function(){
                    load_block();
                }, 100);

                 /*
                if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                } 

                   $('html, body').animate({
                        scrollTop: $(".tickets_dropdown").offset().top
                    });
                  */
            }            
        });
     }

     $("body").on("click","#zoom-reset",function(){
            $("#ticket_block_id").val("");
            currentBlock = "";
            currentFilter = [];
            $('[data-section]').removeClass("hover");
            start  = 1;
            get_ticket(0,start);
           
     });

    function selectType(value) {
        if (value != 0) {
            $(".seat_select_items").hide();
        } else {
            $(".seat_select_items").show();
        }
        selectCategory(value);
    }

     function selectCategory(value) {

        $("#allticktype").val(value);
       // $("#ticket_block_id").val("");
       
        if (value == 0) {

            // console.log(value);
            current_category = 0;
  
            //$('.mapsvg-region').css('pointer-events', '');
        } else {
            var selectCategory = value;
        }

        var no_tckt = $("#noofticket").val();
        if (no_tckt != '') {
            var matchId = '{{$results['m_id']}}';
            get_ticket(selectCategory,1);
            
        } else {
            get_ticket(selectCategory,1)
        }


}

    $("body").on("click",".show-more",function () {
   
            if($(this).parents(".main_parent").find(".show-more-list").hasClass("show-more-height")) {
                $(this).html("{{__('messages.show less')}} -");
            } else {
                $(this).html("{{__('messages.show more')}} +");
            }

            $(this).parents(".main_parent").find(".show-more-list").toggleClass("show-more-height");
        });

    var timerData = [];
    function secondPassed(row) {
        var seconds = timerData[row].remaining;
        var minutes = Math.round((seconds - 30) / 60);
        var remainingSeconds = seconds % 60;
        //// console.log(remainingSeconds);
        // if(remainingSeconds == 20  || remainingSeconds == 40 ){
        //   get_ticket_qunatity(row);
      
        // }

       // if(remainingSeconds == 30  || remainingSeconds == 59  ){
       //       get_ticket_qunatity(row,1);
       
       // }
        if(seconds == 0){
             get_ticket_qunatity(row,0);
            
        }
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }

        seconds--;
           
        $("#desk-" +  row ).html(minutes + ":" + remainingSeconds)
       // $("#mob-" +  row ).html(minutes + ":" + remainingSeconds)
          
        timerData[row].remaining = seconds;
       
    }

    function timer(row, min) {
        //// console.log( row  +"-------" + min);
        timerData[row] = {
                remaining: min   ,
                timerId: setInterval(function () { secondPassed(row); }, 1300)
            };
        var sec=timerData[row].timerId;
    }


    function get_ticket_qunatity(ticket_id,num){
         $.ajax({
            type: "POST",
             dataType: "json",
            url: "{{url(app()->getLocale())}}/match-ticket-details",
            data: {'match_id':  "{{$results['m_id']}}","ticket_id" : ticket_id ,"_token": "{{ csrf_token() }}",},
            success: function (response)
            {

            $("#seatid-" + ticket_id).find(".quantity_ticket").html(response.options);

               if(response.quantity > 10){
                    $("#seatid-" + ticket_id).find(".remaining-count").remove();
               }
               // // console.log(response.total_blocked);
                if(response.total_blocked > 0){

                     $("#seatid-" + ticket_id).find(".buyer_choosen").html(response.total_blocked);
                     $("#seatid-" + ticket_id).find(".total_tickets").html(response.total_quantity);
                     //alert(response.expire_time);
                     if(num == 0) {timer(ticket_id,response.expire_time ); }
                 }
                 else{
                   $("#seatid-" + ticket_id).find(".buyer_active").remove();
                    $(".exp-time-desk").remove();

                       clearInterval(timerData[ticket_id].timerId);
                       $("#seatid-" + ticket_id).find(".remaining-count span").html( response.total_quantity + " {{__('messages.tickets remaining')}}")
                 }
                    // console.log(num);
                if(response.quantity > 0){
                    $("#seatid-" + ticket_id).removeClass('disabledbutton');

                }

                else if(num  == 1 && response.quantity == 0 && response.total_blocked > 0  ){
                   

                }
                else{
                    $("#seatid-" + ticket_id).remove();
                }

                
              
                
            }
        });
    }


    function showMouseOver(obj) {

        var categoryId = obj.getAttribute('data-ticketcategory');
      
        var blockColor = obj.getAttribute('color-code');
        var dataClass = obj.getAttribute('data-class');
        var ticketsCount = obj.getAttribute('tickets');
       

        var blockId = obj.getAttribute('data-full-block-id');
        
         

            // console.log(blockId);

                $('[data-section]').addClass("hover");
               
                if (blockId != "0") {
                    $('[data-section="'+blockId+'"]').removeClass('hover');
                   
                } else {

                 if($("[data-category-id="+categoryId+"]").length > 0){
                      $("[data-category-id="+categoryId+"]").parents("[data-section]").removeClass('hover');
                }
                 else{
                         $("[data-section]").removeClass('hover');
                    }
                    
             }
       

    }


    function hideMouseOver(obj) {
        //console.log("obj")
             unhover()
        
    }


</script>
@endpush('scripts')