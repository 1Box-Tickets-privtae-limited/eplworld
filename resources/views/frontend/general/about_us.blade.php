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
                        <li>About us</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                    <div class="onebox-section-heading">
                    <h1><span>About</span> 1BoxOffice</h1>
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
                <div class="col-md-6">
                    <div class="about_content">
                        <p><b>We have customer service around the world 1boxoffice Services is a privately owned company founded in 2006 in Dubai, United Arab Emirates with an affiliated office in Beirut, Lebanon and London, United Kingdom.</b></p>
                        <p>The tremendous success of the company has become widely known and the expansion was so rapid that 1boxoffice Services now holds branches in Kuwait and Spain as well as representative offices in Kingdom of Saudi Arabia. Italy and Poland.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_img">
                        <div class="merg_img">
                            <img src="http://site.1boxoffice.co//public/img/new_img/soccer.png" alt="soccer">
                        </div>
                        <div class="merg_img_box">
                            <img src="http://site.1boxoffice.co//public/img/new_img/boxoffice.png" alt="boxoffice">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<section class="epl-about-us-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="epl-about-left">
                    <div class="football-ticket-heading">
                        <p>We have customer service around the world 1boxoffice Services is a privately owned company founded in 2006 in Dubai, United Arab Emirates with an affiliated office in Beirut, Lebanon and London, United Kingdom.</p>
                        <p>The tremendous success of the company has become widely known and the expansion was so rapid that 1boxoffice Services now holds branches in Kuwait and Spain as well as representative offices in Kingdom of Saudi Arabia. Italy and Poland.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Upcoming Matches Area End -->
    @endsection
