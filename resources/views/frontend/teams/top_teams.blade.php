@extends('layouts.app')
@section('content')

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"> {{__('messages.home')}}</a></li>
                        <li>>></li>
                        <li> {{__('messages.top teams')}}</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1><span>{{__('messages.top teams')}}</span></h1>
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

            <div class="top-teams-div"></div>
             <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." ></div>
        </div>
        <div class="row">
            
        </div>
        <div class="clearfix"></div>
        
        <!-- <div class="col-md-12">
            <div class="upcoming-match-btn-view-all">
                <a href="{{url('all-teams')}}" class="onebox-btn">View All Match</a>
            </div>
        </div> -->
    </div>
</section>
<!-- Upcoming Matches Area End -->
@endsection
@push('scripts')
 <script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "{{url(app()->getLocale().'/top-teams-ajax')}}",
            data: "",
             beforeSend: function() {
                // $("#state-list").addClass("loader");
                $(".loading_img").show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              $(".loading_img").hide();
            },
           
            success: function(data){
                $(".loading_img").hide();
                $('.top-teams-div').html(data.html);
            }
        });
    });
</script>
@endpush('scripts')