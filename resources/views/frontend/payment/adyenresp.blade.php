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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->
{{-- Hidden divs with data passed from the PHP server --}}
<div id="clientKey" class="hidden">{{$clientKey}}</div>
<input type="hidden" name="booking_no" id="booking_no" value="{{$booking_no}}">
<!-- Upcoming Matches Area Start -->
<section class="onebox-upcoming-mathces-area section_50">
    <div class="container">
        <div class="row">
           
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2><span>Please wait...</h2>
                </div>
            </div>
            <div class="top-teams-div"></div>
             <div class="text-center loading_img"><img src="{{url('public/img/loader.gif')}}" width="50px" alt="Loading..." ></div>
        </div>
        <div class="row">
            
        </div>
        <div class="clearfix"></div>
    </div>
</section>

<script src="{{ env('ADYEN_JS_URL') }}"
     integrity="{{ env('ADYEN_JS_INTEGRITY') }}"
     crossorigin="anonymous"></script>

<link rel="stylesheet"
     href="{{ env('ADYEN_CSS_URL') }}"
     integrity="{{ env('ADYEN_CSS_INTEGRITY') }}"
     crossorigin="anonymous">

<script type="text/javascript">
var POST_URL = "{{url(app()->getLocale().'/updateadyenresp')}}";
var csrf_token = "{{ csrf_token() }}";
var ENVIRONMENTAL = "{{ strtolower(env('ADYEN_ENVIRONMENTAL')) }}";
</script>

<script type="text/javascript" src="{{asset('/')}}/public/js/adyenImplementation.js?v=1.5"></script>
<!-- Upcoming Matches Area End -->
@endsection
@push('scripts')
