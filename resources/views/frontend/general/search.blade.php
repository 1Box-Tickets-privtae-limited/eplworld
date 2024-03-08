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
                        <li>{{__('messages.advanced search')}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1>{{__('messages.advanced search')}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<!-- Notfound Area Start -->
<section class="onebox-advanced-search section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="filter_sec">
                    <h3>{{__('messages.filter by')}}</h3>
                    <a href="javascript:void(0)" class="pull-right" id="reset_filters">{{__('messages.clear all')}}</a>
                </div>
                <div class="filter-sec-box">
                    <form method="post" id="advanced-search" action="{{url(app()->getLocale().'/search')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group filter-search-result">
                                    <label for="keywords">{{__('messages.keywords')}}</label>
                                    <a href="javascript:void(0)" onClick="clearInput('keywords')">{{__('messages.clear')}}</a>
                                    <input type="search" name="keywords" id="keywords" value="{{ request()->get('keywords')}}" placeholder="{{__('messages.keywords')}}...">
                                    <!-- <button type="submit" class="search-button">
                                        <i class="fa fa-search"></i>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                    <div class="select">
                                        <label for="country">{{__('messages.destination')}}</label>
                                        <a href="javascript:void(0)" onClick="clearInput('country')">{{__('messages.clear')}}</a>
                                        <select name="country" id="country" class="form-control">
                                            @if($country)
                                                <option value="">{{__('messages.select country')}}</option>
                                                @foreach($country as $row)
                                                    <option value="{{$row['id']}}" {{($row['name'] == request()->get('country')?"selected=selected":"")}}>{{$row['name']}} ({{$row['sortname']}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                    <label for="country">Dates</label>
                                    <a href="">clear</a>
                                    <select name="ticket category" id="ticket-category" class="form-control">
                                        <option value="category">Please select...</option>
                                        <option value="category">Single-category</option>
                                        <option value="category">Single-category</option>
                                        <option value="category">Single-category</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                    <label for="country">{{__('messages.start date')}}</label>
                                    <a href="javascript:void(0)" onClick="clearInput('start_date')">{{__('messages.clear')}}</a>
                                    <input type="text" name="start_date" id="start_date" min="{{ date('Y-m-d'); }}" placeholder="{{__('messages.start date')}}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                    <label for="country">{{__('messages.end date')}}</label>
                                    <a href="javascript:void(0)" onClick="clearInput('end_date')">{{__('messages.clear')}}</a>
                                    <input type="text" name="end_date" id="end_date" placeholder="{{__('messages.end date')}}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                    <div class="select">
                                        <label for="tournament">{{__('messages.tournaments')}}</label>
                                        <a href="javascript:void(0)" onClick="clearInput('tournament')">{{__('messages.clear')}}</a>
                                        <select name="tournament" id="tournament" class="form-control">
                                            <option value="">{{__('messages.all')}} {{__('messages.tournaments')}}</option>
                                            @if($tournaments)
                                                @foreach($tournaments as $list)
                                                    <option value="{{$list['t_id']}}">{{$list['tournament_name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                    <div class="select">
                                        <label for="teams">{{__('messages.teams')}}</label>
                                        <a href="javascript:void(0)" onClick="clearInput('teams')">{{__('messages.clear')}}</a>
                                        <select name="teams" id="teams" class="form-control">
                                            <option value="">{{__('messages.all')}} {{__('messages.teams')}}</option>
                                            @if($team_lists)
                                                @foreach($team_lists as $list)
                                                    <option value="{{$list['id']}}">{{$list['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-form">
                            <div class="col-md-12">
                                <p>
                                    <button type="submit">{{__('messages.search')}}</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="advanced-sort">
                    <div class="sort_by">
                        <p>{{__('messages.sort by')}}:</p>
                    </div>
                    <div class="date_drop">
                        <div class="select">
                            <select name="sort_by" id="sort_by" class="form-control">
                                <option value="">{{__('messages.select')}}</option>
                                <option value="date_asc">{{__('messages.ascending')}}</option>
                                <option value="date_desc">{{__('messages.descending')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="adv_search_result" ></div>
                <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." ></div>
            </div>
        </div>
    </div>
</section>
<!-- Notfound Area end -->
@endsection
@push('scripts')
    <script type="text/javascript">

        var limit = 10; 
        var start = 1; 
        var action = 'inactive';

        $(function () {
            $('#start_date').datetimepicker({
                //format: 'L',
                format: 'D-MM-yyyy',
                //locale: "{{app()->getLocale()}}",
                minDate: moment(),
                 icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-clock-o",
        clear: "fa fa-trash-o"
    }
            });
            $('#end_date').datetimepicker({
                useCurrent: false,
                format: 'D-MM-yyyy',

                 icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-clock-o",
        clear: "fa fa-trash-o"
    }
                //locale: "{{app()->getLocale()}}"
            });
            $("#start_date").on("dp.change", function (e) {
                $('#end_date').data("DateTimePicker").minDate(e.date);
            });
            $("#end_date").on("dp.change", function (e) {
                $('#start_date').data("DateTimePicker").maxDate(e.date);
            });
        });  

        function clearInput(input){
            if(input == "country" || input == "tournament"){
                $('#'+input).prop('selectedIndex',0);
            }else{
                $('#'+input).val('');
            }
        }
        $(document).ready(function() {
            // load_data(limit,1);
            $('#reset_filters').click(function () {
                var url = window.location.href;
                var a = url.indexOf("?");
                var b =  url.substring(a);
                var c = url.replace(b,"");
                url = c;
                window.location.href = url;
                // $("#advanced-search").trigger("reset");
                // load_data(limit,1);
            });
            $('#search-button').click(function() {
                $('#advanced-search').submit();
            });
            $('#advanced-search').submit( function(e){
                e.preventDefault();
                load_data(limit,1);
            });
            $('#sort_by').change(function() {
                load_data(limit,1);
            });


              var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active


            function load_data(limit, start)
            {
                tournament = $('#tournament').val();
                country    = $('#country').val()
                keywords   = $('#keywords').val();
                sort_by    = $('#sort_by').val(); 
                city       = "{{ request()->get('city')}}",
                start_date = $('#start_date').val(); 
                end_date   = $('#end_date').val(); 
                teams      = $('#teams').val(); 
                stadium    = "{{ request()->get('stadium')}}",
                $.ajax({
                    type: "POST",
                    url: "{{url(app()->getLocale().'/advance-search')}}",
                    data: {'tournament': tournament,"country": country,"keywords":keywords,"sort_by":sort_by,"city":city,"start_date":start_date,"end_date":end_date,"stadium":stadium,"_token": "{{ csrf_token() }}",limit : limit , page : start ,"teams" : teams },
                    beforeSend: function() {
                        // $("#state-list").addClass("loader");
                        $(".loading_img").show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                      $(".loading_img").hide();
                    },
                    success: function(response){
                        $(".loading_img").hide(); 
                        if(response.success == true)
                        {   
                            //$('#adv_search_result').html(response.html);

                            if(start == 1){
                                $('#adv_search_result').html("");
                            }

                            $('#adv_search_result').append(response.html);

                           // console.log(data.html);
                             if(response.html !="")
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
       });

    </script>
@endpush('scripts')
