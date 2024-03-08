@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
        .confirm-title{
             margin-top: 10px;
             margin-bottom: 10px;
        }
</style>
<script type="text/javascript">
      dataLayer.push({
    'event':'sign_up',
    'enhanced_conversion_data': {
      "email": "{{$_GET['email']}}",   
      "phone_number": "{{$_GET['phone_number']}}",
    }
  })
</script>
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                         <li>{{__('messages.Ticket Request Confirmation')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->


 <section class="onebox-checkout-order section_50">
        <div class="container">
            <div class="row">
          
                <div class="col-md-12">
                    <div class="onebox-checkout-order-confirm">
                       
                       <div class="order_placed">
                             @if(@$status == 1)
                      
                            <h3><i class="far fa-check-circle"></i></h3>
                            <h3 class="confirm-title"> {{__('messages.Ticket Request Thankyou')}}</h3>
                            <h4  class="confirm-desc"> {{__('messages.Ticket Request Description')}}</h4>
                              @endif
                               @if(@$status == 2)
                            <h3><i class="far fa-times" style="background:red;padding: 10px 15px;"></i></h3>
                            <h3 class="confirm-title">Sorry.Unable to submit your request at the moment.Please try again.</h3>
                            @endif
                        </div>
                       
                      
                     </div>
                 </div>
             </div>
         </div>
     </section>
<!-- Upcoming Matches Area Start -->
<section class="onebox-upcoming-mathces-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2><span>Recommended Matches</span></h2>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                  
                </div>
            </div>
        </div>
        
        <div class="row all_games"></div>
              <div class="col-md-12">
                <div class="upcoming-match-btn-view-all">
                    <a href="{{url(app()->getLocale().'/'.$tournament_url_key)}}" class="onebox-btn">{{__('messages.view more')}}</a>
                </div>
            </div>
         <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." ></div>

    </div>
</section>
@endsection
@push('scripts')
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
    //             $(".all_games").removeAttr("style");
    //             $('.all_games').html(data.html);
    //         }
    //     });
    // }

$('#tournament').on('change',function(){

    load_data(1000, 1);
  })
  
   


    function load_data(limit, start)
    {   var limit = 8;
        var tournament = "{{$tournament}}";
        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale().'/all-games-ajax')}}",
            data: $('#filter').serialize()+ '&_token=' + "{{ csrf_token() }}&limit=" + limit +"&page=" +start+"&tournament=" +tournament,
            beforeSend: function() {
                // $("#state-list").addClass("loader");
                $(".loading_img").show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              $(".loading_img").hide();
            },
            success: function(data){
                $(".loading_img").hide();

                var tournaments = data.tournaments;
                if(data.tournaments){
                 var tournament_options = '<option value="">Filter by Tournment</option>';
                $.each(data.tournaments, function(key,val) {
                    var selected = "";
                if(data.selected_tournment == val.tournament_id){
                    selected = "selected = 'selected'";
                }
                tournament_options += '<option value="'+val.tournament_id+'" '+selected+'>'+val.tournament_name+'</option>';
                });
                $('#tournament').html(tournament_options);
               }
               
                if(start == 1){
                    $('.all_games').html("");
                }

                $('.all_games').append(data.html);

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
/*
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $(".all_games").height() && action == 'inactive')
        {
            //lazzy_loader(limit);
            action = 'active';
            start = start + 1;
            setTimeout(function(){
                load_data(limit, start);
            }, 1000);
        }
    });
*/

</script>
@endpush('scripts')
