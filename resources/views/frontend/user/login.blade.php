@extends('layouts.app')
@section('content')
     
    

    <!-- seller profile Start -->
    <section class="epl-login-page-area section_50">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="login_page_dtl">
                        <div class="login_imag">
                            <img src="{{url('/')}}/public/img/new_img/login_bg.png">
                        </div>
                        <div class="login_imag_11">
                            <img src="{{url('/')}}/public/img/new_img/logo.png">
                        </div>
                                 
                                <div class="login-page-box">
                                    <div class="login_div" >
                                    <div class="login-page-heading">
                                      <h3>{{__('messages.login')}}</h3>
                                    </div>
                                   <form  method="post" action="{{url(app()->getLocale().'/login-post')}}" id="form-login" >

                                     <div class="login-error" style="display:none">
                                        <div class="alert alert-danger" role="alert">
                                            <span class="sr-only">Error:</span>
                                            <span class="login-error-msg"></span>
                                        </div>
                                    </div>

                                        <div class="login-success"  style="display:none">
                                        <div class="alert alert-success" role="alert">
                                            <span class="sr-only">Success:</span>
                                            <span class="login-success-msg"></span>
                                        </div>
                                    </div>
                                    
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="account-form-group">
                                            <label for="email"><b>{{__('messages.email address')}}</b></label>
                                            <input type="email"  id="emailid" name="email" placeholder="{{__('messages.email address')}}"  value="{{isset($remember['username'])?$remember['username']:''}}" required >
                                        </div>
                                        <div class="account-form-group">
                                            <label for="pwd"><b>{{__('messages.password')}}</b></label>
                                            <input type="password" id="password" name="password" placeholder="{{__('messages.password')}}" value="{{isset($remember['password'])?$remember['password']:''}}" required >
                                        </div>
                                        <div class="forget_user">                              
                                            <label>
                                                <input name="remember" type="checkbox">
                                                {{__('messages.remember password')}}
                                            </label>
                                            <a  class="forget_password_click" href="javascript:void(0);">{{__('messages.forgot password')}}?</a>
                                        </div>
                                        <div class="submit_btn">
                                            <button type="submit">{{__('messages.login')}}</button>
                                        </div>
                                    </form>
                                    <div class="login-sign-up">
                                        <a href="{{ url(app()->getLocale().'/register')}}">{{__('messages.Dont have an account')}}? &nbsp;<span>{{__('messages.sign up')}}</span></a>
                                    </div>
                                        </form>
                                    </div>
                                    <div class="forget_password_div"  style="display:none">
                                         <div class="login-page-heading">
                                        <h3>{{__('messages.forget password')}}</h3>
                                        <p>{{__('messages.forgot password text')}}..</p>
                                    </div>

                                    <div class="forgot-error" style="display:none">
                                        <div class="alert alert-danger" role="alert">
                                            <span class="sr-only">Error:</span>
                                            <span class="forgot-error-msg"></span>
                                        </div>
                                    </div>

                                        <div class="forgot-success"  style="display:none">
                                        <div class="alert alert-success" role="alert">
                                            <span class="sr-only">Success:</span>
                                            <span class="forgot-success-msg"></span>
                                        </div>
                                    </div>
                                        <form id="forgot-password" method="post" action="{{url(app()->getLocale().'/forgot-password')}}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                                            <div class="row forget-pass">
                                                <div class="col-md-12">
                                                    <div class="account-form-group">
                                                        <label for="email">{{__('messages.e-mail')}}</label>
                                                        <input type="text" name="email" id="email" placeholder="{{__('messages.email address')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row forget-pass">
                                                <div class="col-md-12">
                                                <p>
                                                    <button type="submit">{{__('messages.submit')}}</button>
                                                </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                    </div>
                </div>
            </div>
        </div>
    </section> 
    <!-- seller profile End -->

@endsection
@push('scripts')
<script type="text/javascript">

	   $("#login").validate();

       $(".forget_password_click").on("click",function(){

            $(".forget_password_div").show();
            $(".login_div").hide();
       });

</script>
@endpush('scripts')