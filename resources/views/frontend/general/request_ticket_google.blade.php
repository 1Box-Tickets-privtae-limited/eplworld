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
                        <li>Request Ticket</li>
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
                <!-- <div class="onebox-section-heading">
                <h2><span>Privacy</span> Policy</h2>
                </div> -->
                </div>

                <div class="about_us">
                   SUCCESS
                </div>
            </div>
        </div>
    </section>
    <!-- Upcoming Matches Area End -->
    @endsection
