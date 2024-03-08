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
                        <li>{{__('messages.tournaments')}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1><span>{{__('messages.tournaments')}}</span></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->


<!---Tournamnets start--------->
<section class="onebox-match-gallery-area section_50">
    <div class="container">
        <div class="row">
            <div class="main-lates-matches" style='background: url("{{LOADER}}") no-repeat center; min-height: 500px; text-align: center;'>
            </div>
        </div>
    </div>
</section>
<!-----------Tournaments end --------------->
@endsection
@push('scripts')
 <script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{url(app()->getLocale().'/tournaments-ajax')}}",
            data: "",
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){
                $(".main-lates-matches").removeAttr("style");
                $('.main-lates-matches').html(data.html);
            }
        });
    });
</script>
@endpush('scripts')