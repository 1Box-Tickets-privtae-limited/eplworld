@extends('layouts.app')
@section('content')
     

         <!-- Breadcromb Area Start -->
    <section class="onebox-breadcromb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.reset password')}}</li>
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

            @if(Session::has('rest_success'))

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            <strong>
                                {{Session::get('rest_success')}}
                            </strong>
                        
                        </div>
                    </div>
                </div>
            @endif
                
            <div class="register-form onebox-seller-form">
                <h3 class="text-center">{{__('messages.reset password')}}</h3>
                <form method="post" action="{{url(app()->getLocale().'/reset-password-post')}}" id="reset_password">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="new-password"><b>{{__('messages.new password')}}</b><span class="error">*</span></label>
                            <input type="password" name="new_password" id="new_password" placeholder="{{__('messages.enter new password')}}"  required>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="confirm-password"><b>{{__('messages.confirm password')}}</b><span class="error">*</span></label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="{{__('messages.enter confirm password')}}"  required>
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
	$("#reset_password").validate({
        rules : {
            confirm_password : {
                equalTo : '#new_password'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {
                    //alert(response.status);
                    if(response.status == 1){
                        //window.location.reload();
                        window.location.href = "{{url(app()->getLocale())}}";
                    }
                    else{
                        //window.location.href = "{{url(app()->getLocale())}}";
                    }
                   
                }            
            });
            return false;
        }
    });
</script>
@endpush('scripts')