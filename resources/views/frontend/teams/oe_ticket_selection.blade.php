@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}/public/css/svgmap.css">
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

        <div class="row">
            <div class="last-match-box">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="last-match-result-one last-match-result">
                           
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 pad_five">
                    <div class="last-match-score match_ticket_selection">
                        <h1>{{$results['match_name']}}</h1>
                        <h2>{{$results['category_name']}}</h2>
                        <h3>{{$results['match_date']}}</h3>
                        <p>{{$results['match_time']}}</p>
                        <h4>{{$results['stadium_name']}}</h4>

                    </div>

                </div>
                
                 @if(@$results['top_games'] == 1)<div class="top_event">{{__('messages.top event')}}</div>
                 @endif
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

@if($results['match_status'] == 1)
<!-------------------star rating----------------------------->
<section class="ticket-star-rating">
    <div class="container">
        <div class="star_rate">
            <div class="row">
                <div @if(@$results['high_demand'] != '1' && @$results['almost_sold'] != '1') class="col-md-12 col-sm-12 col-xs-12 text-center" @else   class="col-md-3 col-sm-3 col-xs-12"@endif>
                    <div class="rating_star">
                        <p><span>5</span> {{__('messages.stars rated')}}</p>
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                     @if(@$results['high_demand'] == '1') <div class="ticket_demand">
                        <h2>{{__('messages.tickets are in high demand')}}!</h2>
                        <h2><span>{{__("messages.don't miss a chance")}}!</span></h2>
                    </div>@endif
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    @if(@$results['almost_sold'] == '1') 
                    <div class="sold_out">
                         <p>{{__("messages.tickets are")}} <br>{{__("messages.almost sold out")}}!</p>
                    </div>
                    @endif
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="ticket_guarantee">
                <p><span>100%</span> {{__("messages.ticket guarantee")}}!</p>
                </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="ticket_guarantee_view">
                <p><i class="fas fa-eye"></i> {{@$results['view_per_hour']}} {{__("messages.views this hour")}}</p>
                </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="ticket_guarantee_rig">
                <p><span>100%</span> {{__("messages.money back guarantee")}}!</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--------------------star rating---------------------------->
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
            <div class="col-md-5">

                <div class="ticket_select_img">
                    <div id="mapsvg"></div>
                </div>

                <div class="select_sec">
                    @if($category)
                    <h4>{{__("messages.select a section that you like to be seated in")}}</h4>
                    <ul>

                            @foreach($category as $list)
                            @if($list['seat_category'])
                                <li>
                                    <a href="javascript:void(0)" onclick="selectCategory('{{$list['stadium_seat_id']}}')">
                                        <span class="seat_color"  style="background:{{$list['block_color']}}"></span>{{$list['seat_category']}}
                                    </a>
                                </li>
                                @endif
                            @endforeach  
                    </ul>
                     @endif
                </div> 

                <div class="mobile_view">
                    <div class="booking-project">
                        <p>{{__('messages.ticket refund protection')}}</p>
                        <img src="{{asset('/')}}/public/img/booking-protect.png">
                    </div>
                </div>                
                
                <div class="stadium_para">
                    {!!$results['description'] !!}
                </div>
                <div class="stadium_para_notes">
                    <h4>Please Note</h4>
                    <ul>
                        <li> <i class="fas fa-check"></i> Event date and time are subject to change - Check with the venue for start times and/or age restrictions.</li>
                        <li> <i class="fas fa-check"></i> All sales are final</li>
                        <li> <i class="fas fa-check"></i> No cancellations</li>
                        <li> <i class="fas fa-check"></i> 100% Ticket guarantee</li>
                    </ul>
                    
                </div>
            </div>
            <div class="col-md-7">

                @if($results['match_status'] == 1)

                     @if(@$results['total_quantity'] > 0  && @$results['total_quantity'] <= 15)
                    <div class="onebox-tickets-boook_details">
                        <div class="tickets_left">
                             <p>
                                @php 

                                $ticket_count_alert =  __('messages.only tickets left for this event')  ;
                                @endphp
                                {!! str_replace("{%COUNT%}",$results['total_quantity'],$ticket_count_alert) !!}
                               <i class="fas fa-fire"></i></p>
                        </div>
                    </div>
                    @endif

                    @if(@$results['total_quantity'] > 0)
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
                        <div class="ticket_value">
                            <p>{{__('messages.ticket prices are set by sellers and may be below or above face value')}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                         <div  class="loading-bar-spinner spinner mt-5" id="loading_2"><div class="spinner-icon"></div></div>
                     </div>
                    </div>
                    <div class="tickets_details_list"></div>

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


<!----------------about us section start---------->
<section class="onebox-about-us section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-about-us-sec">
                    <div class="onebox-section-heading">
                        <h2>{{__('messages.why')}} <span>{{__('messages.us')}}?</span></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                            <div class="single-about-right">
                                <div class="single-about-right-con">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="single-about-right-text">
                                    <h3>{{__('messages.16 years online')}}</h3>
                                    <p>{{__('messages.We have been online since 2006 helping fans')}}.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                            <div class="single-about-right">
                                <div class="single-about-right-con">
                                    <i class="fas fa-lock-alt"></i>
                                </div>
                                <div class="single-about-right-text">
                                    <h3>{{__('messages.ssl secure checkout')}}</h3>
                                    <p>{{__('messages.we use high levels of data encryption here and do not share your data with any third party vendors')}}!.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                            <div class="single-about-right">
                                <div class="single-about-right-con">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="single-about-right-text">
                                    <h3>{{__('messages.fast secure delivery')}}</h3>
                                    <p>{{__('messages.all tickets are guarenteed to be delivered on time so you dont miss the events')}}!.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 full_widd">
                            <div class="single-about-right">
                                <div class="single-about-right-con">
                                    <i class="fas fa-shield-check"></i>
                                </div>
                                <div class="single-about-right-text">
                                    <h3>{{__('messages.100% ticket guarantee')}}</h3>
                                    <p>{{__('messages.your tickets are guaranteed no matter what')}}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="booking-project">
                                <p>{{__('messages.ticket refund protection')}}</p>
                                <img src="{{asset('/')}}/public/img/booking-protect.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!----------------about us section end---------->




@endsection
@push('scripts')




<!-- jQuery -->
    <script src="{{asset('/')}}/public/js/mapsvg.js?ver=2.4.843343342222"></script>
    <script src="{{asset('/')}}/public/js/mousewheel.js?ver=2.4.8"></script>
    <script src="{{asset('/')}}/public/js/nanoscroller.js?ver=2.4.8"></script>

    <script type="text/javascript">
         $(function () {
            $("body").on("click",".add_to_cart_button",function(){
                var id = $(this).data('id');
         
                 $("#add_to_cart_" + id).validate({
                      submitHandler: function (form) {
                      
                        $.ajax({
                            url: "{{url(app()->getLocale().'/add-to-cart')}}",
                            type: "post",
                            dataType: "json",
                            data:  $("#add_to_cart_" + id).serialize(),
                            success: function(response) {
                               window.location.href = "{{url(app()->getLocale().'/checkout')}}";
                            }            
                        }); 
                        return false;
                      }
                 });
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
</script>

<script type="text/javascript">
   // get_ticket(1)
    get_ticket(0)
     $('#noofticket, #allticktype').change(function(){
        var cat = $('#allticktype').val();
        console.log(cat);
        if(cat != null)
       // get_ticket(cat);
        selectCategory(cat);
     });

     function get_ticket(cat){
        var qty = $('#noofticket').val();
        $("#loading_2").show();
        $('.tickets_details_list').html("");
        $.ajax({
            url: "{{url(app()->getLocale().'/ticlet-selection-filter')}}",
            type: "post",
            dataType: "json",
            data: {"quantity":qty, "category":cat,"match_id":{{$results['m_id']}},"_token":"{{ csrf_token() }}"},
            success: function(response) {
                if(response.success == true && response.html != ""){
                    $("#loading_2").hide();
                    $('.tickets_details_list').html(response.html);
                } 
            }            
        });
     }

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
                console.log(object.stadium_image);
                if (status == 1) {
                    if(object.stadium_image.indexOf('svg') != -1){

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
                            $("#" + svg_val.id).attr("data-cat", stadium_with_cat_name[svg_val.href][0]);
                            //$('.mapsvg-region').css('pointer-events', 'none');

                        });
                        $(".mapsvg-region").each(function () {
                            //$(this).css('opacity', '0.5');
                            if (full_block_data == null) {
                                /* $(".mapsvg-region").each(function () {
                                 $(this).css('opacity', '0.5');
                                 }); */

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
                                        } else {
                                           // $('#' + itm2).css('opacity', '0.5');
                                        }

                                    });
                            });
                          

                    }, 2000);
                }
                else{
                    jQuery("#mapsvg").html("<img src='"+object.stadium_image+"'>");
                }
                }
            }
        });

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
                    } else {
                       // $('#' + itm2).css('opacity', '0.5');
                    }
                });
            });
            //$('.mapsvg-region').css('pointer-events', '');
        } else {
            var selectCategory = value.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();

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
                        } else {
                            //$('#' + itm2).css('opacity', '0.5');
                        }

                    });
                }
            });
        }

        var no_tckt = $("#noofticket").val();
        if (no_tckt != '') {
            var matchId = '{{$results['m_id']}}';
            get_ticket(selectCategory);
            
        } else {
            get_ticket(selectCategory)
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
            //$(".mapsvg-region").css('opacity', '0.5');
            $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
            if (blockId != "0") {
                $('#' + blockId).css('opacity', '1');
                $('#' + blockId).css({fill: stadium_block_details[blockId]});
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
                            } else {
                               // $('#' + itm2).css('opacity', '0.5');
                            }
                        });
                    }
                });
                /*$.each(full_block_data,function(indx, itm){
                 if(parseInt(indx)==parseInt(categoryId)){
                 $.each(itm,function(indx2, itm2){
                 $('#'+itm2).css('opacity', '1');
                 $('#'+itm2).css({fill: stadium_block_details[itm2]});
                 });
                 }
                 });*/
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
            /*$(".mapsvg-region").each(function () {
             $(this).css('opacity', '1');
             });*/
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
               // $(this).css('opacity', '0.5');
                if (full_block_data == null) {
                    $(".mapsvg-region").each(function () {
                        //$(this).css('opacity', '0.5');
                    });
                } else {
                    $.each(full_block_data, function (indx, itm) {
                        if (itm != '') {
                            $.each(itm, function (indx2, itm2) {
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
</script>
@endpush('scripts')