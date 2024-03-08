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
                        <li>{{__('messages.other events')}}</li>
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
                   <h1><span>{{__('messages.other')}}</span> {{__('messages.events')}}</h1>
                    <!--   <div class="title-line-one"></div>
                    <div class="title-line-two"></div> -->
                </div>
            </div>
        </div>

        <div class="row other_events" style='background: url("{{LOADER}}") no-repeat center; min-height: 500px; text-align: center;'>
            
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Upcoming Matches Area End -->
@endsection
@push('scripts')
 <script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{url(app()->getLocale().'/other-events-ajax')}}",
            data: "",
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){
                 $(".other_events").removeAttr("style");
                $('.other_events').html(data.html);
            }
        });
    });
</script>
@endpush('scripts')