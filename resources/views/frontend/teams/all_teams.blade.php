@extends('layouts.app')
@section('content')

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.all')}} {{__('messages.teams')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1><span>All Teams</h1>
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
            <form id="filter" onsubmit="event.preventDefault()">
                <div class="col-md-4 col-sm-4 col-xs-4 full_widdh">
                    <div class="single-fixture-right-widget">
                        <input type="search" class="search_keyword" name="search_keyword" value="{{ app('request')->input('search_keyword') }}" placeholder="{{__('messages.keywords')}}...">
                        <button type="button" id="search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 full_widdh">
                    <div class="single-fixture-select">
                    <select id="country"name="country">
                        @if($country)
                        <option value="">{{__('messages.please select')}}</option>
                        @foreach($country as $row)
                        <option value="{{$row['id']}}" 
                            @if($row['id'] == app('request')->input('country'))
                                selected="selected"
                            @endif
                        >{{$row['name']}} ({{$row['sortname']}})</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="single-fixture-all">
                        <input type="hidden" name="sort_by" id="sort_by" 
                        @if(empty(app('request')->input('sort_by')))
                            value="ASC"
                        @else
                            value="{{app('request')->input('sort_by')}}"
                        @endif
                        />
                        <P><span class="sort">{{__('messages.sort by')}} : A to Z <i class="fas fa-arrow-down"></i></span></P>
                    </div>
                </div>  
            </form>
        </div>
       
        
        <div class="row all_teams top-teams-div"></div>
        <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." ></div>
    </div>
</section>
<!-- Upcoming Matches Area End -->
@endsection
@push('scripts')
<script type="text/javascript">
    $('#country').on('change', function(e){
        load_data(9,1);
    });
    $('.sort').on('click', function(e){
        let sor = $('#sort_by').val();
        if(sor == "ASC"){
            $('#sort_by').val('DESC');
        }else if(sor == "DESC"){
            $('#sort_by').val('ASC');
        }
        load_data(9,1);
    });
    $('#search').on('click', function(e){
        load_data(9,1);
    });

    // getData();
    // function getData(){
    //     $.ajax({
    //         type: "POST",
    //         url: "{{url(app()->getLocale().'/all-teams-ajax')}}",
    //         data: $('#filter').serialize()+ '&_token=' + "{{ csrf_token() }}",
    //         // beforeSend: function() {
    //         //     // $("#state-list").addClass("loader");
    //         //     $(".full-loading").show();
    //         // },
    //         // error: function(jqXHR, textStatus, errorThrown) {
    //         //   $(".full-loading").hide();
    //         // },
    //         success: function(data){
    //             $(".full-loading").hide();
    //             $(".all_teams").removeAttr("style");
    //             $('.all_teams').html(data.html);
    //         }
    //     });
    // }


    var limit = 9; //The number of records to display per request
    var start = 1; //The starting pointer of the data
    var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active

    var loader = $('#load_data_message_a').html();

    function load_data(limit, start)
    {

        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale().'/all-teams-ajax')}}",
            data: $('#filter').serialize()+ '&_token=' + "{{ csrf_token() }}&limit=" + limit +"&page=" +start,
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
                    $('.all_teams').html("");
                }

                $('.all_teams').append(data.html);

                //console.log(data.html);
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
        if($(window).scrollTop() + $(window).height() > $(".all_teams").height() && action == 'inactive')
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