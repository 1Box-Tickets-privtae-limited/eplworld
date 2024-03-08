@extends('layouts.app')
@section('content')
     
 <!-- Breadcromb Area Start -->
    <section class="onebox-breadcromb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="#"><i class="fa fa-home"></i> home</a></li>
                            <li>/</li>
                            <li>404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->
    
    <!-- Notfound Area Start -->
    <section class="onebox-notfound-area section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="onebox-notfound">
                        <h2>4<img src="{{url('/')}}/public/img/ball.png" alt="" >4</h2>
                        <h5>Page not found</h5>
                        <a href="{{url(app()->getLocale())}}" class="onebox-btn">back to home page</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Notfound Area end -->

@endsection
@push('scripts')
<script type="text/javascript">
</script>
@endpush('scripts')
