@extends('layouts.app')
@section('content')
     

         <!-- Breadcromb Area Start -->
    <section class="onebox-breadcromb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.order')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->
    

    
 <section class="onebox-your-orders section_50">
        <div class="container">
            <div class="">
                    <div class="onebox-section-heading">
                        <h2> <span>{{__('messages.your orders')}}</span></h2>
                    </div>
            </div>
            <div class="">
                <div class="tab_sec orders" id="no-more-tables">
                      @if(@$results)
                <table class="toptable res_table_new table-responsive">
                  <tbody>
                    <tr class="accordion">
                      <th>{{__('messages.order no')}}</th>
                      <th>{{__('messages.event')}}</th>
                      <!-- <th>{{__('messages.ticket format')}}</th> -->
                      <th>{{__('messages.section')}}</th>
                      <th>{{__('messages.quantity')}}</th>
                      <th>{{__('messages.price')}}</th>
                      <th>{{__('messages.transaction date')}}</th>
                      <th>{{__('messages.status')}}</th>
                      <th>{{__('messages.ticket status')}}</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                    
                  
                    @foreach($results as $row)

                    <tr class="row_clickable" data-href="{{url(app()->getLocale())}}/orders/{{md5($row['booking_no'])}}" style="cursor:pointer;">
                      <td data-label="{{__('messages.order no')}}:"><span class="order">#{{$row['booking_no']}}</span></td>
                      <td data-label="{{__('messages.event')}}:">
                        <div class="imagg"><img src="{{$row['team_image_a']}}">
                        <img src="{{$row['team_image_b']}}"></div>
                        <div class="txtt">
                        {{$row['match_name']}} <br> {{$row['country_name']}} ,{{$row['city_name']}}<br><span class="tr_date"><i class="fas fa-calendar-week"></i> @if($row['tbc_status'])
                                {{$row['tbc_status']}}
                            @else
                            {{\Carbon\Carbon::parse($row['match_date'])->format('d F Y')}} </span>&nbsp;<span class="tr_date"><i class="fas fa-clock"></i>{{$row['match_time']}}</span> 
                            @endif
                        </div>
                      </td>
                      <!-- @if($row['ticket_type'] == 1)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.season cards status')}}</td>
                      @endif
                      @if($row['ticket_type'] == 2)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.e-tickets')}}</td>
                      @endif
                      @if($row['ticket_type'] == 3)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.paper status')}}</td>
                      @endif
                      @if($row['ticket_type'] == 4)
                      <td data-label="{{__('messages.ticket format')}}:">{{__('messages.mobile')}}</td>
                      @endif
                       @if($row['ticket_type'] == '')
                      <td data-label="{{__('messages.ticket format')}}:"></td>
                      @endif
  -->           @if($mobile != 1)          
               <td data-label="{{__('messages.section')}}:">{{$row['seat_category']}} </td>
               @endif
                      <td data-label="{{__('messages.quantity')}}:">{{$row['quantity']}} </td>
                      <td data-label="{{__('messages.price')}}:">
                        <span class="ltr"><b>
                        @if(strtoupper($row['currency_type']) == 'GBP')
                         <i class="fas fa-pound-sign"></i> 
                         @endif
                         @if(strtoupper($row['currency_type']) == 'EUR')
                        <i class="fas fa-euro-sign"></i> 
                         @endif
                          @if(strtoupper($row['currency_type']) != 'GBP' && strtoupper($row['currency_type']) != 'EUR')
                        {{$row['currency_type']}}
                         @endif
                          {{number_format($row['total_amount'],2)}} 
                     </b></span></td>
                      <td data-label="{{__('messages.transaction date')}}:">{{\Carbon\Carbon::parse($row['updated_at'])->format('d F Y')}} </td>
                      @if($row['booking_status'] == 0)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.failed')}}</td>
                      @endif
                      @if($row['booking_status'] == 1)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.confirmed')}}</td>
                      @endif
                      @if($row['booking_status'] == 2)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.pending')}}</td>
                      @endif 
                      @if($row['booking_status'] == 3)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.cancelled')}}</td>
                      @endif
                      @if($row['booking_status'] == 4)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.shipped')}}</td>
                      @endif
                      @if($row['booking_status'] == 5)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.delivered')}}</td>
                      @endif
                      @if($row['booking_status'] == 6)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.downloaded')}}</td>
                      @endif
                      @if($row['booking_status'] == 7)
                      <td data-label="{{__('messages.status')}}:">{{__('messages.not_initiated')}}</td>
                      @endif
                      @if($mobile != 1) 
                    <td  data-label="{{__('messages.e-tickets')}}:" style="cursor: pointer;">
                          @if($row['ticket_type'] == 2)

                        @if(($row['delivery_status'] == 2 || $row['delivery_status'] == 4 || $row['delivery_status'] == 5 || $row['delivery_status'] == 6) && ($row['booking_status'] != 0 && $row['booking_status'] != 3 && $row['booking_status'] != 7))
                        <a href="{{url(app()->getLocale())}}/download/{{md5($row['booking_no'])}}"><span class="clrbs">Download Tickets</span></a>
                        @endif
                        @if(($row['delivery_status'] == 0 || $row['delivery_status'] == 1) && ($row['booking_status'] == 1 || $row['booking_status'] == 2 || $row['booking_status'] == 4) )
                        <span class="clrbs"><a href="#">{{__('messages.processing')}}</a></span>
                         @endif
                          @if(($row['booking_status'] == 0 || $row['booking_status'] == 3 || $row['booking_status'] == 7))
                          Not available
                         <!-- <span class="clrbs"><a href="#">{{__('messages.not available')}}</a></span> -->
                           @endif
                           @else
                            @if(($row['booking_status'] == 1 || $row['booking_status'] == 2 || $row['booking_status'] == 4) )
                        <span class="clrbs"><a href="#">{{__('messages.processing')}}</a></span>
                         @endif
                          @if(($row['booking_status'] == 0 || $row['booking_status'] == 3 || $row['booking_status'] == 7))
                          {{__('messages.not available')}}
                         <!-- <span class="clrbs"><a href="#">{{__('messages.not available')}}</a></span> -->
                           @endif
                       
                            @endif
                    </td>
                     @endif
                      <td style="width: 120px"  style="cursor: pointer;">
                        <a href="{{url(app()->getLocale())}}/orders/{{md5($row['booking_no'])}}">
                            <button class="btn_desk">{{__('messages.order details')}}</button>
                            <!-- <i class="fas fa-angle-double-right"></i> --><!-- <button class="btn_mobile">{{__('messages.view detail')}}</button> --></a></td>

                             <td class="disablelink"  style="cursor: pointer;">

                        <a href="javascript:void(0)" class="open_chat btn {{$row['message_count'] > 0 ? 'btn-success' : 'btn-danger'}}" data-id="{{$row['booking_no']}}" data-no="{{$row['booking_no']}}">
                           <i class="fa fa-comments"></i>
                        @if($row['message_count'] > 0)    <span class="badge">{{$row['message_count']}}</span>@endif
                        </a>

                    </td>

                    </tr>
                    
                    @endforeach
                    
                    
                  </tbody>
                </table>
                 @else
                 <div>
                       <h3>{{__('messages.no orders available')}}</h3>
                    </div>
                    @endif
            </div>
            </div>
        </div>
    </section>


      <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="row">
                        <div class="col-md-8 col-xs-8">
                            <h3 class="panel-title"><span class="fa fa-comment"></span> Chat - <span class="message_id_html"></span></h3>
                        </div>
                        <div class="col-md-4 col-xs-4" style="text-align: right;">
                            <a href="#"><span id="minim_chat_window" class="fa fa-minus icon_minim"></span></a>
                            <a href="#"><span class="fa fa-times icon_close" data-id="chat_window_1"></span></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    <p class="text-center msg_loading">Loading....</p>
                </div>
                <div class="panel-footer">
                    <form method="post" action="" id="chats_form">
                         @csrf
                        <input type="hidden" id="message_id" class="message_id" name="id" value="">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control  chat_input chat_message" name="message"  placeholder="Write your message here..." required autocomplete="off" />
                            <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-sm" id="btn-chat">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
   


<style type="text/css">.col-md-2, .col-md-10{
    padding:0;
}
.panel{
    margin-bottom: 0px;
}
.chat-window{
    bottom:0;
    right: 0;
    position:fixed;
    float:right;
    margin-left:10px;
    z-index: 10000000;
    display: none;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.icon_minim{
    padding:2px 10px;
}
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
  min-height: 300px;
}


.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.chat_input{

    height: auto;
}

.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.messages {
  background: white;
  padding: 8px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.msg_receive{
    background: #05728f ;
   
     color: #FFF;
}
.sender_new_message{
    background: #767171;
}

.new_message{
    background: #B00505;
}
.messages > p {
    font-size: 13px;
        line-height: normal;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}

.avatar {
    position: relative;
}
.base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}





.msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}</style>
@endsection
@push('scripts')
<script type="text/javascript">


$(document).ready(function(){

        $(document).on('click', '.open_chat', function (e) {
            $(".chat-window").show();
            var open_chat_id  = $(this).attr('data-id');
            var booking_no  = $(this).attr('data-no');
            //alert(open_chat_id);
            $(".message_id").val(open_chat_id);
            $(".message_id_html").html(booking_no);
           fetch_user()
       });
       setInterval(function () { if($(".chat-window:visible").length > 0) fetch_user(2) }, 5000);



       $("#chats_form").validate({
          submitHandler: function (form) {
            console.log(form);
          $.ajax({
                url: "{{url(App::getLocale().'/save-chat')}}",
                method:"POST",
                data : $(form).serialize(),
                dataType: 'json',
                success:function(data){
                    var chat_message  = $(".chat_message").val();
                    var current_time = new Date().toLocaleString() ;
                    var _new_message = "";

                    $(".start_new").html("");

                    _new_message += '<div class="row msg_container base_sent"> <div class="col-md-10 col-xs-10"> <div class="messages msg_receive text-right sender_new_message_11"> <p>'+chat_message +' </p><time datetime="'+current_time+'">'+current_time+'</time>  </div> </div><div class="col-md-2 col-xs-2 avatar"> <img src="{{url("public/img/man-user.png")}}" class=" img-responsive "> </div></div>';
                    $(".msg_container_base").append(_new_message);

                    $(".chat_message").val("");


                     var div = $(".msg_container_base");
                    div.scrollTop(div.prop('scrollHeight'));
                   return false;
                }
            });
          return false;

          }
     });

       $(document).on('click', '#new_chat', function (e) {
            save_message(id,message_id)
       });


     function fetch_user(status = 1)
     {
        var message_id = $("#message_id").val() ;
        console.log(message_id);
        $.ajax({
            url: "{{url(App::getLocale().'/get-chats')}}",
            method:"GET",
            data : { status : status , booking_id : message_id },
            dataType: 'json',
            success:function(data){
              
                var _new_message = "";
                if(data.message.length > 0){
                    $.each(data.message, function(i, item) {
                        //console.log(item.send_by);
                         if(status == 2)
                        var new_message_message = "new_message_11";
                    else
                         var new_message_message = "";
                       if(item.send_by ==  1) { 
                            _new_message += '<div class="row msg_container base_sent"> <div class="col-md-10 col-xs-10"> <div class="messages msg_receive  text-right '+new_message_message+'"> <p>'+item.message +' </p><time datetime="'+item.updated_at+'">  '+item.created_at+'</time>  </div></div><div class="col-md-2 col-xs-2 avatar"> <img src="{{url("public/img/man-user.png")}}" class=" img-responsive "> </div></div>';
                        }
                       else{  
                              _new_message += '<div class="row msg_container base_receive"> <div class="col-md-2 col-xs-2 avatar"> <img src="{{url("public/img/customer-service.png")}}" class=" img-responsive "> </div>  <div class="col-md-10 col-xs-10"> <div class="messages msg_sent  '+new_message_message+'"> <p>'+item.message +' </p><time datetime="'+item.updated_at+'">  '+item.updated_at+'</time>  </div></div></div>';
                        }


                        
                    });
                    $(".msg_loading").hide();
                    $(".msg_container_base").append(_new_message);
                     var div = $(".msg_container_base");
                    div.scrollTop(div.prop('scrollHeight'));
                }
                else if(status == 2){

                }
                else{
                     
                     $(".msg_container_base").html("<p class='text-center start_new'>Start a new chats</p>");
                }
            }
            });
    }
});

$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).hide();
});

$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('fa-minus').addClass('fa-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('fa-plus').addClass('fa-minus');
    }
});
</script>
@endpush('scripts')