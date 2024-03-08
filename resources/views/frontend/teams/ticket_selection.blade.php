@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}/public/css/svgmap.css">
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

                    <div class="tooltip">
                        <a href="javascript:void(0)" class="reset_stadium reset_filter"><i class="fas fa-retweet"></i></a>
                        <span class="tooltiptext">{{__('messages.reset filter')}}</span>
                    </div>

                    <!-- <a href="javascript:void(0)" class="reset_stadium reset_filter"><i class="fas fa-retweet"></i></a> -->
                    <div id="mapsvg"></div>
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
                        <div class="scroll_section">
                            <div class="ticket_quantity select">
                                <select name="quantity" id="noofticket" class="form-control"> <i class="fas fa-sliders-h"></i>
                                    <option value="">{{__('messages.quantity')}}</option>
                                    @if($ticketQuantity)
                                        @for($i=1; $i<=$ticketQuantity;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    @endif                        
                                </select>
                            </div>
                            <div class="ticket_quality select">
                                <select name="types" id="allticktype" class="form-control">
                                    <option value="">{{__('messages.category')}}</option>
                                    @if($category)
                                        @foreach($category as $list)
                                            <option value="{{$list['ticket_category']}}">{{$list['seat_category']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                              <div class="ticket_quality1 filter_li seats_together_main" style="display: none;" data-type="seats_together" data-id="1">
                                <div class=" seats_together ">{{__('messages.seats together')}}</div>
                            </div>
                            @if($category)
                           @php $vip_exits = 0 ; $away_exits = 0 ; @endphp
                                @foreach($category as $list)
                                @if (str_contains(strtolower($list['seat_category']), 'vip') ||  str_contains(strtolower($list['seat_category']), 'كبار الشخصيات')  && $vip_exits == 0) 
                                <div class="filter_li ticket_quality1" data-id="{{$list['ticket_category']}}" data-type="sub_category">
                                    <div class="vip">{{__('messages.vip')}}</div>
                                </div>
                                @php $vip_exits = 1 ; @endphp
                                @endif
                                 @if (str_contains(strtolower($list['seat_category']), 'away')  || str_contains(strtolower($list['seat_category']), 'تذاكر فريق الضيف') && $away_exits == 0) 
                                     <div class="filter_li ticket_quality1" data-id="{{$list['ticket_category']}}" data-type="sub_category">
                                    <div class="away">{{__('messages.away')}}</div>
                                </div>
                                  @php $away_exits = 1 ; @endphp
                                @endif
                                @endforeach
                            @endif

                              <div class="filter_li ticket_quality1" data-id="1" data-type="price_with_fees" >
                                <div class="price_fees">{{__('messages.price with fees')}}</div>
                            </div>
                            <!-- <div class="ticket_value">
                                <p>{{__('messages.ticket prices are set by sellers and may be below or above face value')}}</p>
                            </div> -->
                        </div>
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
<!-- jQuery -->
    <script src="{{asset('/')}}/public/js/mapsvg-live.js?ver=2.1.2"></script>
    <script src="{{asset('/')}}/public/js/mousewheel.js?ver=2.4.8.1"></script>
    <script src="{{asset('/')}}/public/js/nanoscroller.js?ver=2.4.8"></script>

    <script type="text/javascript">
         $(function () {
            $("body").on("click",".add_to_cart_button",function(){
                var id = $(this).data('id');
                    
                    $(this).text('Loading..');
                    $(this).prop("disabled",true);
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
                 $("#add_to_cart_" + id).submit();
            });
       
        
          $('[data-toggle="tooltip"]').tooltip();
        })

    var full_block_data = {!!$full_block_data!!};
    var stadium_block_details = {!!$set_stadium_blocks!!};
    var stadium_cat_details = {!!$set_stadium_blocks_with_cat!!} ;
    var stadium_with_cat_name = {!!$set_stadium_cat_name!!} ;
    var ticket_price_info ={!!$ticket_price_info!!} ;
    var ticket_price_info_with_cat ={!!$ticket_price_info_with_cat!!} ;
    var current_category = 0;

    var stadium_active_block_details = {!!$set_active_stadium_blocks? $set_active_stadium_blocks :"[]"!!};

</script>

<script type="text/javascript">
   // get_ticket(1)
    var limit = 50;
    var start = 1; 
    var action = 'inactive'; 

     jQuery(document).ready(function () {
        //alert("test");
        var stadiumId = '{{$results['stadium_id']}}';
        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale())}}/get_stadium_id",
            data: {'stadium_id': stadiumId,"_token": "{{ csrf_token() }}",},
            success: function (response)
            {
                //var jsonObject = $.parseJSON(response);
                var jsonObject = JSON.parse(JSON.stringify(response))
                var status = jsonObject['status'];
                var object = jsonObject['Json'];
                var stadiumCode = object['map_code'];
                var stadiumValue = $.parseJSON(stadiumCode);
                if (status == 1) {
                    jQuery("#mapsvg").mapSvg(stadiumValue);
                    setTimeout(function () {
                        var svg_data = stadiumValue;
                        $.each(svg_data.regions, function (svg_itm, svg_val) {



                            if ($("#" + svg_val.id).attr("class")) {
                                var exist_class = $("#" + svg_val.id).attr("class");
                            } else {
                                var exist_class = "";
                            }

                            $("#" + svg_val.id).attr("class", exist_class + " " + svg_val.href.replace(/[^a-zA-Z0-9]/g, '').toLowerCase());
                             if(stadium_with_cat_name[svg_val.href]){
                            $("#" + svg_val.id).attr("data-cat", stadium_with_cat_name[svg_val.href][0]);
                            //$('.mapsvg-region').css('pointer-events', 'none');
                            }

                        });
                        $(".mapsvg-region").each(function () {
                            $(this).css('opacity', '1');//active-1
                            if (full_block_data == null) {
                                 $(".mapsvg-region").each(function () {
                                 $(this).css('opacity', '1');//active-1
                                 }); 

                            } else {
                                $('.mapsvg-region').css('pointer-events', '');
                                $.each(full_block_data, function (indx, itm) {
                                    if (itm != '') {
                                        $.each(itm, function (indx2, itm2) {
                                            $('#' + itm2).css('opacity', '1');
                                            $('#' + itm2).css('cursor', 'pointer');
                                        })
                                    }
                                });
                            }

                        });

                        //$('#content-l').css({'height': $('#Layer_1').innerHeight()});
                        var heightValue = parseInt($('#Layer_1').innerHeight() - 46);
                        //$('#content-l').css({'height': heightValue});
                        $(".statium_select_seat").removeAttr("style");
                        $("#mapsvg").css("visibility", "visible");



                      $.each(stadium_cat_details, function (indx, itm) {
                               
                                    $.each(itm, function (indx2, itm2) {
                                        $('#' + itm2).css({fill: stadium_block_details[itm2]});
                                        //$('#'+itm2).css('pointer-events', '');
                                        var sn_exst = 0;
                                        $.each(full_block_data, function (indx_s, itm_s) {
                                            if ($.inArray(itm2, itm_s) !== -1) {
                                                sn_exst++;
                                                //break;
                                            }
                                        });

                                        if (sn_exst > 0) {
                                            $('#' + itm2).css('opacity', '1');
                                            $('#' + itm2).css({fill: stadium_active_block_details[itm2]});
                                        } else {
                                            $('#' + itm2).css('opacity', '1');//active-1

                                        }

                                    });
                            });
                          

                    }, 2000);
                }
            }
        });

    });

    
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
        console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
     });

     $("body").on("click",".seat_avaiable",function () {
        var ava_category_id =  $(this).data('id');
        console.log(parseInt(ava_category_id));
        $('#ticket_block_id').val("");
        selectCategory(parseInt(ava_category_id));
     });

   function get_ticket(cat,page){
        var qty = $('#noofticket').val();
        var block_id = $('#ticket_block_id').val();
        if(page == 1){
            if(qty == "" && cat <= 0){
          
                $("#loading_2").removeClass("loading-bar-spinner spinner mt-5");
                $("#loading_2").addClass("progress_bar_val");
                $("#loading_2").html("<h3>{{__('messages.ticket progress maessage')}}</h3>"+
                        '<div class="progress">'+
                        '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0"  aria-valuemax="100" style="width:5%">5%</div>'+
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
        


          var seats_together =0;
        var sub_category = [];
        var price_with_fees =0;
       
        $(".filter_li.active").each(function() {
            var type = $(this).data('type');
            var id = $(this).data('id');
            if(type == "seats_together"){
                seats_together = id;
            }
            if(type == "sub_category"){
                sub_category.push(id);
            }
            if(type == "price_with_fees"){
                price_with_fees = id;
            }
        });

              
        $.ajax({
            url: "{{url(app()->getLocale().'/ticlet-selection-filter')}}",
            type: "post",
            dataType: "json",
            data: {"quantity":qty, "category":cat,"match_id":{{$results['m_id']}},"block_id":block_id,"_token":"{{ csrf_token() }}",'limit' : limit ,'page' : page, seats_together : seats_together, sub_category : sub_category, price_with_fees : price_with_fees },
            beforeSend: function(){
                 if(page == 1 &&   (cat > 0 || qty > 0  )  ){
                    if($(".tickets_dropdown").length > 0){
                          $('html, body').animate({
                                        scrollTop: $(".tickets_dropdown").offset().top
                            });
                      }
                   if(qty == "" && cat <= 0){
                        $('.progress-bar').animate({width: "40%"}, 100);
                        $('.progress-bar').text("40%");
                   }
               }
            },
            success: function(response) {

                if(qty == "" && cat <= 0){
                     $('.progress-bar').animate({width: "80%"}, 150);
                     $('.progress-bar').text("80%");
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

            /*
                if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                } 

                   $('html, body').animate({
                        scrollTop: $(".tickets_dropdown").offset().top
                    });
                  */}            
        });
     }

     function get_ticket_v1(cat){
        var qty = $('#noofticket').val();
        var block_id = $('#ticket_block_id').val();

        $("#loading_2").show();
        $('.tickets_details_list').html("");
        $.ajax({
            url: "{{url(app()->getLocale().'/ticlet-selection-filter')}}",
            type: "post",
            dataType: "json",
            data: {"quantity":qty, "category":cat,"match_id":{{$results['m_id']}},"block_id":block_id,"sourcetype"  : "{{@$sourcetype}}","_token":"{{ csrf_token() }}"},
            beforeSend: function(){
            
            if($(".tickets_dropdown").length > 0){
                     $('html, body').animate({
                            scrollTop: $(".tickets_dropdown").offset().top
                });
            }
         
            
        $('.progress-bar').animate({width: "40%"}, 100);
        $('.progress-bar').text("40%");

    },
            success: function(response) {

                

                

                 $('.progress-bar').animate({width: "80%"}, 150);
                 $('.progress-bar').text("80%");
            setTimeout(function(){
                $('.progress-bar').css({width: "100%"});
                $('.progress-bar').text("100%");
                setTimeout(function(){
                          if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                    $('.progress-bar').css({width: "0%"});
                    $('.progress-bar').text("0%");
                } 

                

                }, 500);
            }, 500);
            /*
                if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                } 

                   $('html, body').animate({
                        scrollTop: $(".tickets_dropdown").offset().top
                    });
                  */}            
        });
     }
     
     function get_ticket_old(cat){
        var qty = $('#noofticket').val();
        var block_id = $('#ticket_block_id').val();

        $("#loading_2").show();
        $('.tickets_details_list').html("");
        $.ajax({
            url: "{{url(app()->getLocale().'/ticlet-selection-filter')}}",
            type: "post",
            dataType: "json",
            data: {"quantity":qty, "category":cat,"match_id":{{$results['m_id']}},"block_id":block_id,"sourcetype"  : "{{@$sourcetype}}" ,"_token":"{{ csrf_token() }}" },
            success: function(response) {

                if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                } 

                  if($(".tickets_dropdown").length > 0){
                         $('html, body').animate({
                                scrollTop: $(".tickets_dropdown").offset().top
                    });
                }
                  }            
        });
     }

    


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

            console.log(value);
            current_category = 0;
            $(".seat_select_items").each(function (i) {
                $(this).show();
            });
            $.each(stadium_cat_details, function (indx, itm) {
                $.each(itm, function (indx2, itm2) {
                    //$('#'+itm2).css('opacity', '1');
                    $('#' + itm2).css({fill: stadium_block_details[itm2]});
                    var sn_exst = 0;
                    $.each(full_block_data, function (indx_s, itm_s) {
                        if ($.inArray(itm2, itm_s) !== -1) {
                            sn_exst++;
                            //break;
                        }
                    });

                    if (sn_exst > 0) {

                        $('#' + itm2).css('opacity', '1');
                        $('#' + itm2).css({fill: stadium_active_block_details[itm2]});
                    } else {
                       $('#' + itm2).css('opacity', '1');//active-1
                    }
                });
            });
            //$('.mapsvg-region').css('pointer-events', '');
        } else {
            var selectCategory = value;

            //console.log(selectCategory);
            var categoryId = stadium_with_cat_name[value][0];
            current_category = categoryId;
            $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
            //$(".mapsvg-region").css('pointer-events', 'none');
            $.each(stadium_cat_details, function (indx, itm) {
                if (parseInt(indx) == parseInt(categoryId)) {
                    $.each(itm, function (indx2, itm2) {
                        $('#' + itm2).css({fill: stadium_block_details[itm2]});
                        //$('#'+itm2).css('pointer-events', '');
                        var sn_exst = 0;
                        $.each(full_block_data, function (indx_s, itm_s) {
                            if ($.inArray(itm2, itm_s) !== -1) {
                                sn_exst++;
                                //break;
                            }
                        });

                        if (sn_exst > 0) {
                            $('#' + itm2).css('opacity', '1');
                            $('#' + itm2).css({fill: stadium_active_block_details[itm2]});
                        } else {
                          $('#' + itm2).css('opacity', '1');//active-1
                        }

                    });
                }
            });
        }

        var no_tckt = $("#noofticket").val();
        if (no_tckt != '') {
            var matchId = '{{$results['m_id']}}';
            get_ticket(selectCategory,1);
            
        } else {
            get_ticket(selectCategory,1)
        }
    }

    function showMouseOver(obj) {
        var mouseHover = obj.getAttribute('data-target');
        var categoryId = obj.getAttribute('data-ticketcategory');
        var matchId = obj.getAttribute('data-matchid');
        var blockColor = obj.getAttribute('color-code');
        var ticketsCount = obj.getAttribute('tickets');
        var mapId = obj.getAttribute('map-id');
        var blockId = obj.getAttribute('data-blockid');
        var dataClass = obj.getAttribute('data-class');
        var mouseHoverValue = mouseHover.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
        if (ticketsCount == 0) {
            return false;
        } else {
            $(".mapsvg-region").css('opacity', '1');//active-1
            $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
            if (blockId != "0") {
                $('#' + blockId).css('opacity', '1');
                $('#' + blockId).css({fill: stadium_block_details[blockId]});
                $('#' + blockId).css({fill: stadium_active_block_details[blockId]});
            } else {

                $.each(stadium_cat_details, function (indx, itm) {
                    if (parseInt(indx) == parseInt(categoryId)) {
                        $.each(itm, function (indx2, itm2) {
                            var sn_exst = 0;
                            $('#' + itm2).css({fill: stadium_block_details[itm2]});
                            $.each(full_block_data, function (indx_s, itm_s) {
                                if ($.inArray(itm2, itm_s) !== -1) {
                                    sn_exst++;
                                    //break;
                                }
                            });

                            if (sn_exst > 0) {
                                $('#' + itm2).css('opacity', '1');
                                $('#' + itm2).css({fill: stadium_active_block_details[itm2]});
                            } else {
                                $('#' + itm2).css('opacity', '1');//active-1
                            }
                        });
                    }
                });
                $.each(full_block_data,function(indx, itm){
                 if(parseInt(indx)==parseInt(categoryId)){
                 $.each(itm,function(indx2, itm2){
                 $('#'+itm2).css('opacity', '1');
                 $('#'+itm2).css({fill: stadium_block_details[itm2]});
                  $('#' + itm2).css({fill: stadium_active_block_details[itm2]});
                 });
                 }
                 });
            }
            // if (mapId) {
            //     //$('#seatid-'+mapId).css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');

            //     $('.seat_select_items[data-blockid="' + mapId + '"]').css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
            // } else {
            //     $('.' + mouseHoverValue).css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
            // }
            // $('.' + mouseHoverValue + '-button').children().css('background', '#d9d9d9');
        }

    }

    function hideMouseOver(obj) {
        var mouseHover = obj.getAttribute('data-target');
        var blockColor = obj.getAttribute('color-code');
        var areaid = obj.getAttribute('map-id');
        var ticketsCount = obj.getAttribute('tickets');
        var dataClass = obj.getAttribute('data-class');
        if (ticketsCount == 0) {
        } else {
            var mouseHoverValue = mouseHover.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
            $(".mapsvg-region").each(function () {
             $(this).css('opacity', '1');
             });
            if (parseInt(current_category) != 0) {
                $.each(stadium_cat_details, function (indx, itm) {
                    if (parseInt(indx) == parseInt(current_category)) {
                        $.each(itm, function (indx2, itm2) {
                            $('#' + itm2).css('opacity', '1');
                            $('#' + itm2).css({fill: stadium_block_details[itm2]});
                        });
                    }
                });
            } else {
                $.each(stadium_cat_details, function (indx, itm) {
                    $.each(itm, function (indx2, itm2) {
                        $('#' + itm2).css('opacity', '1');
                        $('#' + itm2).css({fill: stadium_block_details[itm2]});
                    });
                });
            }

            $(".mapsvg-region").each(function () {
                $(this).css('opacity', '1');//active-1
                if (full_block_data == null) {
                    $(".mapsvg-region").each(function () {
                        $(this).css('opacity', '1');//active-1
                    });
                } else {
                    $.each(full_block_data, function (indx, itm) {
                        if (itm != '') {
                            $.each(itm, function (indx2, itm2) {
                                 $('#' + itm2).css({fill: stadium_active_block_details[itm2]});
                                $('#' + itm2).css('opacity', '1');
                            })
                        }
                    });
                }

            });
            // $('.' + mouseHoverValue).css('background', '');
            // $('.' + mouseHoverValue + '-button').children().css('background', '#fff');
        }
    }


    $("body").on("click",".reset_stadium",function(){

            $('#ticket_block_id').val("");
            $("#allticktype").val("");
            $("#noofticket").val("");
            $("#allticktype").trigger("change");

             $.each(stadium_cat_details, function (indx, itm) {
                $.each(itm, function (indx2, itm2) {
                    //$('#'+itm2).css('opacity', '1');
                    $('#' + itm2).css({fill: stadium_block_details[itm2]});
                    var sn_exst = 0;
                    $.each(full_block_data, function (indx_s, itm_s) {
                        if ($.inArray(itm2, itm_s) !== -1) {
                            sn_exst++;
                            //break;
                        }
                    });

                    if (sn_exst > 0) {
                        $('#' + itm2).css('opacity', '1');
                    } else {
                       $('#' + itm2).css('opacity', '1');//active-1
                    }
                });
            });
    });


    function convertHex(hex, opacity) {
        hex = hex.replace('#', '');
        rgb = hex.replace(/[^\d,]/g, '').split(',');
        r = parseInt(rgb[0]);
        g = parseInt(rgb[1]);
        b = parseInt(rgb[2]);
        result = 'rgba(' + r + ',' + g + ',' + b + ',' + 0.25 + ')';
        return result;
    }
    function convertHexMap(hex, opacity) {
        hex = hex.replace('#', '');
        rgb = hex.replace(/[^\d,]/g, '').split(',');
        r = parseInt(rgb[0]);
        g = parseInt(rgb[1]);
        b = parseInt(rgb[2]);
        result = 'rgba(' + r + ',' + g + ',' + b + ')';
        return result;
    }

    $("body").on("click",".show-more",function () {
   
            if($(this).parents(".main_parent").find(".show-more-list").hasClass("show-more-height")) {
                $(this).html("{{__('messages.show less')}} -");
            } else {
                $(this).html("{{__('messages.show more')}} +");
            }

            $(this).parents(".main_parent").find(".show-more-list").toggleClass("show-more-height");
        });


      $("body").on("click",".filter_li",function(){
                $(this).toggleClass("active");       

                var cat = $('#allticktype').val();
                //  // console.log(cat);
                if(cat != null)
               // get_ticket(cat);
                selectCategory(cat);
            });

</script>
@endpush('scripts')