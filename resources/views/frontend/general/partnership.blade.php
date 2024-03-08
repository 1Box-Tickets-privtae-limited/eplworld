@extends('layouts.app')
@section('content')
     
    

<!-- seller profile Start -->
<section class="onebox-seller-area section_50">
    <div class="container">
        <style type="text/css">
            /*.register-form{
                    background: #fff;
                    padding: 25px;
                    margin-bottom: 30px;
                    height: auto !important;
            }
            .register-form h3{
                text-transform: uppercase;
                font-size: 20px;
                font-weight: bold;
            }*/

            .iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container{
                    right: unset !important;
                }
                .iti--separate-dial-code{
                    width: 100%;
                }
        </style>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">

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
                
            <div class="register-form onebox-seller-form">
                <h1 class="text-center">{{__('messages.partnership')}}</h1>
                <form method="post" action="{{url(app()->getLocale().'/partnership-enquiry')}}" id="partner-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row seller-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                <input class="txtOnly" type="text" value="{{ old('firstname') }}" name="firstname" id="firstname" placeholder="{{__('messages.first name')}}"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                <input class="txtOnly" type="text" placeholder="{{__('messages.last name')}}" value="{{ old('lastname') }}" name="lastname" required>
                            </div>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email"><b>{{__('messages.email address')}}</b><span class="error">*</span></label>
                                <input type="email" name="email" id="email" placeholder="{{__('messages.email address')}}"  value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row seller-form partner-phone_field">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="partner-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                <input type="hidden" name="dialing_code" id="partner-dialing-code">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <input  id="partner-mobile-no" data-rule-number="true" class="allow-numeric txt_right" type="tel" name="mobile_number" placeholder="{{__('messages.enter phone number')}}" value="{{ old('firstname',Session::get('mobile')) }}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required="">
                                    </div>
                                </div>
                                <label id="partner-mobile-no-error" class="error" for="partner-mobile-no"></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="organization"><b>{{__('messages.organization name')}}</b></label>
                                <input type="text" name="organization" id="organization" value="{{ old('organization') }}" placeholder="{{__('messages.organization name')}}" >
                            </div>
                        </div>
                    </div>   
                    <div class="row seller-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website"><b>{{__('messages.website')}}</b></label>
                                <input type="text" value="{{ old('website') }}" name="website" placeholder="{{__('messages.website')}}" id="website">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="select">
                                    <label for="partner-country">{{__('messages.select country')}}<span class="text-danger">*</span></label>
                                    <select name="country" id="partner-country" class="form-control" required>
                                        <option value="">{{__('messages.please select')}}...</option>
                                        @if($country))
                                            @foreach($country as $row)
                                             @if($row['id'] != 103 && $row['id'] != 1 && $row['id'] != 213))
                                                <option value="{{$row['id']}}" {{($row['id']==old('country') ?: []) ? 'selected': ''}}>{{$row['name']}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">{{__('messages.message')}}</label>
                                <textarea name="message" rows="5" cols="44">{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                              
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <label id="website-error" class="error" for="website">{{ $errors->first('g-recaptcha-response') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
        </div>
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
</section>
    <!-- seller profile End -->

@endsection
@push('scripts')

<script type="text/javascript">
    window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    };
    $("#partner-form").validate({
        messages: {
            firstname: {
                required: "{{__('messages.enter your first name')}}"
            },
            lastname: {
                required: "{{__('messages.enter your last name')}}"
            },
            email: {
                required: "{{__('messages.enter your email address')}}"
            },
            mobile_number: {
                required: "{{__('messages.enter phone number')}}"
            },
            organization: {
                required: "{{__('messages.enter organization name')}}"
            },
            website: {
                required: "{{__('messages.enter website name')}}"
            },
            country: {
                required: "{{__('messages.select country')}}"
            },
            message: {
                required: "{{__('messages.enter message')}}"
            }
        }
    });
    var add_dail_code = document.querySelector("#partner-mobile-no");
    window.intlTelInput(add_dail_code,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        'autoPlaceholder':'off',
         'initialCountry' : default_country   
    });
    add_dail_code.addEventListener("countrychange", function() {
      // do something with iti.getSelectedCountryData()
    //  $('#partner-phone').focus();
     $('#partner-dialing-code').val($('.partner-phone_field').find('.iti__selected-dial-code').text());
    });
    $('#partner-form').submit(function() { 
        $('#partner-dialing-code').val($('.partner-phone_field').find('.iti__selected-dial-code').text());
    });
</script>
@endpush('scripts')