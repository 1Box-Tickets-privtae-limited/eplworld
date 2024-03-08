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
                        <li>{{__('messages.all games')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<!-- Upcoming Matches Area Start -->
<section class="onebox-upcoming-mathces-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1><span>{{__('messages.all')}}</span> {{__('messages.games')}}</h1>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-md-9 col-sm-6 col-xs-6 widd_100">
                <div class="upcoming-sub_head">
                        <form id="tournament_form">
                            <div class="select">
                              <select name="tournament" id="tournament" class="form-control">
                                    <option value="">Filter by Tournment</option>
                                </select>
                            </div>
                        </form>

                    </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 widd_100">
                <div class="single-fixture-right-widget sub_btnn">
                    <form id="filter" onsubmit="event.preventDefault()">
                        <input type="search" name="keywords" value="{{ app('request')->input('keywords') }}" placeholder="{{__('messages.keywords')}}...">
                        <button type="submit" id="search">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row all_games"></div>

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
    {
        var tournament = $('#tournament').val();
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


</script>
@endpush('scripts')
