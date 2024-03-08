@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                   <!--  <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.confirmation')}}</li>
                    </ul> -->
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
                            <p>Oops.</p>
                            <h3>Invalid Order number.</h3>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<!-- Event snippet for Purchase conversion page --> 
<script> gtag('event', 'conversion', { 'send_to': 'AW-964657763/LzFLCMvR9qoBEOOE_ssD', 'value': 1.0, 'currency': 'GBP', 'transaction_id': '' }); </script>
@endpush('scripts')