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
                        <li>{{__('messages.contact us')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->
<!-- seller profile Start -->
<section class="onebox-seller-area section_50">
    <div class="container">
        <style type="text/css">
           /* .register-form{
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
                <h1 class="text-center">{{__('messages.contact us')}}</h1>
                <form method="post" action="{{url(app()->getLocale().'/contact-us')}}" id="contactus-form">
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
                    
                    <div class="row seller-form contactus-phone_field">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactus-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                <div class="col-md-3 nopad">
                                    <input name="dialing_code" type="tel" id="contactus-dialing-code">
                                </div>
                                <div class="col-md-9 nopad">
                                    <input  data-rule-number="true" class="allow-numeric" type="tel" id="contactus-phone" name="mobile_number" placeholder="{{__('messages.enter phone number')}}" value="{{Session::get('mobile')}}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required="">
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactus-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                    <input name="dialing_code" type="hidden" id="contactus-dialing-code">
                                    <input data-rule-number="true" class="allow-numeric" type="tel" id="contactus-phone" name="mobile_number" placeholder="{{__('messages.enter phone number')}}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required >
                                    <label id="contactus-phone-error" class="error" for="contactus-phone"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactus-country">{{__('messages.select country')}}<span class="text-danger">*</span></label>
                                <select name="country" id="contactus-country" class="form-control" required>
                                    <option value="">{{__('messages.please select')}}...</option>
                                    @if($country))
                                        @foreach($country as $row)
                                            <option value="{{$row['id']}}" {{($row['id']==old('country') ?: []) ? 'selected': ''}}>{{$row['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
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

  
        <div class="col-md-12">
            <div class="form_submit">
                <input type="submit" value="{{__('messages.submit')}}">
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
	$("#contactus-form").validate({
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
            mobile_number : {
                required: "{{__('messages.enter phone number')}}"
            },
            country: {
                required: "{{__('messages.select country')}}"
            }
        }
    });
    var add_dail_code = document.querySelector("#contactus-phone");
    window.intlTelInput(add_dail_code,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        'autoPlaceholder': 'off',
    });
    add_dail_code.addEventListener("countrychange", function() {
      // do something with iti.getSelectedCountryData()
      $('#contactus-phone').focus();
    });
    $('#contactus-form').submit(function() { 


         $('#contactus-dialing-code').val($('.contactus-phone_field').find('.iti__selected-dial-code').text());
    });
</script>
@endpush('scripts')