@extends('layouts.app')
@section('content')

    <style type="text/css">
        .iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container{
            right: unset !important;
        }
        .iti--separate-dial-code{
            width: 100%;
        }
    </style>
    <!-- Breadcromb Area Start -->

    <section class="onebox-breadcromb-area breadcromb-bg-image">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i>{{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.dashboard')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->


    <!-- seller profile Start -->
    <section class="onebox-seller-area ">
        <div class="container">

             @if(Session::has('error'))

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <strong>
                                    {{ Session::get('error') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                @endif

                @if(Session::has('success'))

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">
                                <strong>
                                  {{Session::get('success')}}
                                </strong>

                            </div>
                        </div>
                    </div>
                @endif



                <div class="row">
                    @include('frontend.user.left-menu')
                    <div class="col-md-8">
                        <!-- Tab panes -->
                        <div class="tabs_faq_content">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <div class="all_head">
                                        <h3>Profile</h3>
                                    </div>
                                    <div class="profile-content">
                                        <div class="profile-form">
                                            <div class="profile-userpic">
                                                <img src="{{url('public/img/new_img/user_log.png')}}" class="img-responsive" alt="user_log">
                                            </div>
                                            <form method="post" action="{{url(app()->getLocale().'/profile-update')}}" id="profile" autocomplete="off">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="row seller-form mt-3">
                                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                                        <div class="form-group">
                                                            <label for="fname"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                                            <input type="text" placeholder="{{__('messages.first name')}}" name="first_name" value="{{@$user['first_name']}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                                        <div class="form-group">
                                                            <label for="lname"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                                            <input type="text" placeholder="{{__('messages.last name')}}" name="last_name" value="{{@$user['last_name']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row seller-form">
                                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                                        <div class="form-group">
                                                            <label for="email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                                            <input type="text" placeholder=""  readonly value="{{@$user['email']}}"  required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                                        <div class="account-form-group" id="profile-dialing-id">
                                                            <div class="form-group">
                                                                <label for="prof-mobile">
                                                                   {{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                                                   <input type="hidden" name="dialing_code" value="{{@$user['dialing_code']}}" id="profile-dialing-code">
                                                                <div class="col-md-12 nopad">
                                                                    <input id="prof-mobile"  class="form-control allow-numeric" type="text"  name="mobile" placeholder="{{__('messages.enter phone number')}}" value="{{@$user['mobile']}}"   required="" >
                                                                </div>
                                                                <label id="prof-mobile-error" class="error" for="prof-mobile"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row seller-form">
                                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                                        <div class="form-group">
                                                            <label for="address"><b>{{__('messages.address')}}</b><span class="error">*</span></label>
                                                            <input type="text" placeholder="{{__('messages.address')}}" name="address" value="{{@$user['address']}}" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                                        <div class="form-group">
                                                            <label for="postcode"><b>{{__('messages.postal code')}}</b><span class="error">*</span></label>
                                                            <input type="text" placeholder="{{__('messages.postal code')}}" name="postcode" value="{{@$user['code']}}" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row seller-form">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country"><b>{{__('messages.country')}}<span class="error">*</span></b></label>
                                                            <select name="country" id="country" class="form-control" required>
                                                                <option value="">{{__('messages.select country')}}</option>
                                                                @if($country)
                                                                @foreach($country as $row)
                                                                <option value="{{$row['id']}}" {{$user['country'] == $row['id'] ? "selected" :""}} >{{$row['name']}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address_state"><b>{{__('messages.state')}}<span class="error">*</span></b></label>
                                                            <select name="state" id="state" class="form-control" required>
                                                                <option value="">{{__('messages.select state')}}</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form_submit mt-2">
                                                            <input type="submit" value="{{__('messages.submit')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
</section>
<?php //echo "<pre>";print_r($_SERVER);?>

    <!-- seller profile End -->
<!-- {{$user['country_code']}}
 -->@endsection
@push('scripts')
<script type="text/javascript">

    $("#profile").validate();
    var req_dail_code = document.querySelector("#prof-mobile");
         console.log(default_country);
         window.intlTelInput(req_dail_code,{
            'separateDialCode':true,
            'preferredCountries': [default_country],
            'autoPlaceholder': 'off',
         @if($user['country_code']) 'initialCountry' : "{{$user['country_code']}}" @else  'initialCountry' :  default_country  @endif
         });

    req_dail_code.addEventListener("countrychange", function() {
        $('#profile #profile-dialing-code').val($('#profile .iti__selected-dial-code').text());
      // do something with iti.getSelectedCountryData()
     // $('#profile-phone').focus();
    });
    $('#profile').submit(function() {

        $('#profile-dialing-id #profile-dialing-code').val($('#profile .iti__selected-dial-code').text());
    });
    $("body").on("change","#country",function(){
        var val = $(this).val();
        get_state(val);
    });

    function get_state(val,selected = ""){

        $.ajax({
                type: "POST",
                url: "{{url(app()->getLocale().'/get_state')}}",
                data: {'country_id' : val ,"_token": "{{ csrf_token() }}"},
                beforeSend: function() {
                    // $("#state-list").addClass("loader");
                },
                success: function(data){

                    var option = "";
                    jQuery.each(data, function(index, item) {
                         var selected_text = "";
                        if(selected ){
                            if(item.id == selected){
                                selected_text =  "selected";
                            }
                        }

                        option += "<option value='"+item.id+"'  "+selected_text+" >"+ item.name+"</option>"
                    });
                    $("#state").html(option);

                }
            });
    }

    @if(@$user['country'])
        get_state({{$user['country']}},{{$user['city']}});
    @endif


</script>
<script type="text/javascript">
   $(document).ready(function() {
  $(".edit_btn").click(function() {
    $(".data_hide").hide();
    $(".data_show").show();
  });
  $(".save_add_btn").click(function() {
    $(".data_show_hide").show();
     $(".data_show").hide();
  });
  //$(".edit_add_btn").click(function() {
    //$(".data_hide").show();
     //$(".data_show").hide();
  //});
});
</script>

@endpush('scripts')

