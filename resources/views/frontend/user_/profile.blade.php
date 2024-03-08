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
    <section class="onebox-breadcromb-area">
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

                <div class="row profile">
                    <div class="col-md-3">
                         @include('frontend.user.left-menu')
                    </div>
                    <div class="col-md-9">
                        <div class="profile-content">
                          <h3>{{__('messages.profile')}}</h3>
                          <hr>
                            <div class="profile-form">
                                <form method="post" action="{{url(app()->getLocale().'/profile-update')}}" id="profile" autocomplete="off">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row seller-form mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                                <input type="text" placeholder="{{__('messages.first name')}}" name="first_name" value="{{@$user['first_name']}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                                <input type="text" placeholder="{{__('messages.last name')}}" name="last_name" value="{{@$user['last_name']}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row seller-form">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                                <input type="text" placeholder=""  readonly value="{{@$user['email']}}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-group" id="profile-dialing-id">
                                                <div class="form-group">
                                                    <label for="prof-mobile">
                                                       {{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                                       <input type="hidden" name="dialing_code" value="{{@$user['dialing_code']}}" id="profile-dialing-code">
                                                    <div class="col-md-12 nopad">
                                                        <input id="prof-mobile"  class="form-control allow-numeric" type="tel"  name="mobile" placeholder="{{__('messages.enter phone number')}}" value="{{@$user['mobile']}}"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required="" >
                                                    </div>
                                                    <label id="prof-mobile-error" class="error" for="prof-mobile"></label>
                                                </div>
                                               <!--  <div class="col-md-9 nopad">
                                                    <div class="account-form-group">
                                                    <input  data-rule-number="true" class="allow-numeric" type="tel" id="profile-phone" name="mobile" placeholder="{{__('messages.enter phone number')}}" value="{{@$user['mobile']}}"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required="">
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
 
                                    </div>
                                    <div class="row seller-form profile_phone_field">
                                                                           </div>
                                   

                                     <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" {{$user["newsletter"] == 1 ?  "checked"  : "" }} name="newsletter"> {{__('messages.subscribe to our newsletter to receive exclusive offers')}}
                                        </label>
                                      </div>

                                       <div class="row">
                                            <div class="col-md-12">
                                                <div class="form_submit">
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
</section>

                        
    <!-- seller profile End -->
{{$user['country_code']}}
@endsection
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
                        option += "<option value='"+item.id+"'>"+ item.name+"</option>"
                    });
                    $("#state").html(option);

                }
            });
    }); 

</script>


@endpush('scripts')

