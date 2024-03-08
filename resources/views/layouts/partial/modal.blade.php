

    <!----modal popup-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">{{__('messages.your time is up! would you like to release your tickets')}}?</h2>
                    </div>
                    <div class="modal-body">
                        <p>{{__('messages.if you choose release these tickets, they will become available for others to buy')}}</p>
                        <p class="red_notice">{{__('messages.please note that these tickets may not be available at this price')}}.</p>
                    </div>
                    <div class="modal-footer">
                        <button id="releaseHome" class="buts_left">{{__('messages.release my tickets')}}</button>
                        <button id="continueTicket" class="buts_right">{{__('messages.continue purchase')}}</button>
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
    <!----modal popup-->
    <div class="modal fade onebox-auth-modal" id="onebox-login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog  " role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="oneboxlogin-popup">
                            <div class="login-page-box">
                    <div class="login-page-heading">
                        <h3>{{__('messages.sign in')}}</h3>
                        <p>{{__('messages.if you have an account with us, please log in')}}</p>
                    </div>
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
                   <!--  <form  method="post" action="{{url(app()->getLocale().'/login')}}" id="form-login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row login-form">
                           
                                 <div class="col-md-12 full_width_ar">
                                <div class="social_gl">
                                    <a href="https://1boxoffice.com/en/auth/google" class="gl-login">
                                    <i class="fab fa-google"></i>
                                    {{__('messages.sign in with google')}}
                                </a>
                                </div>
                            </div>
                  <div class="col-md-6 full_width_ar">
                                <div class="social_fb">
                                    <a href="https://1boxoffice.com/en/auth/facebook" class="fb-login">
                                    <i class="fab fa-facebook"></i>
                                    {{__('messages.sign in with facebook')}}
                                </a>
                                </div>
                            </div> 
                        </div>

                        <div class="row login-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                <label for="emailid">{{__('messages.email address')}}</label>
                                <input type="email" class="form-control" id="emailid" name="email" placeholder="{{__('messages.email address')}}" 
                                value="{{isset($remember['username'])?$remember['username']:''}}" required >
                            </div>
                            </div>
                        </div>
                        <div class="row login-form">
                            <div class="col-md-12">
                                <div class="account-form-group">
                                <label>{{__('messages.password')}}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{__('messages.password')}}" value="{{isset($remember['password'])?$remember['password']:''}}" required >
                            </div>
                            </div>
                        </div>
                        <div class="row login-form">
                            <div class="col-md-12">
                                <p>
                                <label>
                                    <input name="remember" type="checkbox">
                                    {{__('messages.remember password')}}
                                </label>
                            </p>
                            </div>
                        </div>
                        <div class="row login-form">
                            <div class="col-md-12">
                                <p>
                                <button type="submit">{{__('messages.sign in')}}</button>
                            </p>
                            </div>
                        </div>
                        <p class="sign_up">
                            <a href="javascript:void(0)"  class="create_account"  >{{__('messages.create a new account')}}</a>
                            <!-- <button type="submit">{{__('messages.sign up')}}</button> -->
                        </p>
                        <p class="forgot">
                            <a href="#" data-toggle="modal" data-target="#onebox-forget-modal">{{__('messages.forgot password')}}?</a>
                        </p>
                    </form> -->
                    <!-- <div class="login-sign-up">
                        <a href="register.html">Do you need an account?</a>
                    </div> -->
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   <!--  <div class="modal fade onebox-auth-modal" id="onebox-register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog  " role="document">
            <div class="modal-content">
               <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                     <div class="signup-page-box">
                        <div class="signup-page-heading">
                            <h3>{{__('messages.sign up')}}</h3>
                            <p>{{__('messages.please enter the following information to create your account')}}</p>
                        </div>
                        <div class="register-error" style="display:none">
                            <div class="alert alert-danger" role="alert">
                                <span class="sr-only">Error:</span>
                                <span class="register-error-msg"></span>
                            </div>
                        </div>

                            <div class="register-success"  style="display:none">
                            <div class="alert alert-success" role="alert">
                                <span class="sr-only">Success:</span>
                                <span class="register-success-msg"></span>
                            </div>
                        </div>


                        <form method="post" action="{{url(app()->getLocale().'/register-post')}}" id="user-register" autocomplete="off">

                        <div class="row login-form">
                           
                                 <div class="col-md-12 full_width_ar">
                                <div class="social_gl">
                                    <a href="https://1boxoffice.com/en/auth/google" class="gl-login">
                                    <i class="fab fa-google"></i>
                                    {{__('messages.sign in with google')}}
                                </a>
                                </div>
                            </div>
                         
                        </div>
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row signup-form">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label for="name">{{__('messages.first name')}}<span class="text-danger">*</span></label>
                                        <input class="txtOnly" type="text" name="firstname" id="name" placeholder="{{__('messages.enter your first name')}}" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label class="txtOnly" for="lastname">{{__('messages.last name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" id="lastname" placeholder="{{__('messages.enter your last name')}}" required />
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row signup-form">
                                <div class="col-md-12">
                                    <div class="account-form-group">
                                        <label for="emailaddress">{{__('messages.e-mail')}}<span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="emailaddress" placeholder="{{__('messages.email address')}}" required />
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row signup-form">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label for="addr">{{__('messages.street address')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="addr" placeholder="{{__('messages.enter your address')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label for="code">{{__('messages.zip/postal code')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="input-box" id="code" name="postcode" placeholder="{{__('messages.enter postcode')}}" required>
                                    </div>
                                </div>
                            </div> 
                            <div class="row signup-form">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <div class="select">
                                            <label for="country">{{__('messages.select country')}}<span class="text-danger">*</span></label>
                                            <select name="country" id="reg_country" class="form-control" required>
                                                <option value="">{{__('messages.please select')}}...</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <div class="select">
                                            <label for="city">{{__('messages.select city')}}<span class="text-danger">*</span></label>
                                            <select name="city" id="reg_state" class="form-control" required>
                                                <option value="">{{__('messages.please select')}}...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row signup-form">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label for="reg-password">{{__('messages.password')}}<span class="text-danger">*</span></label>
                                        <input type="password" placeholder="{{__('messages.password')}}" id="reg-password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label for="password_confirm">{{__('messages.confirm password')}}<span class="text-danger">*</span></label>
                                        <input type="password" placeholder="{{__('messages.password')}}" id="password_confirm" name="password_confirm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row signup-form">
                                <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="acceptTerms" value="1" name="aggree" required>{{__('messages.i have read and accept the and')}} 
                                                <a target="_blank" href="{{url(app()->getLocale().'/terms-and-conditions')}}">{{__('messages.terms and conditions')}}</a> {{__('messages.and')}} <a target="_blank" href="{{url(app()->getLocale().'/legal-privacy-policy')}}">{{__('messages.privacy policy')}}</a></label>
                                                <label id="aggree-error" class="error" for="aggree"></label>
                                        </div>
                                    </div>
                            </div>
                            <div class="row signup-form">
                                <div class="col-md-12">
                                    <p>
                                        <button type="submit">{{__('messages.sign up')}}</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <div class="modal fade onebox-auth-modal" id="onebox-forget-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
         <div class="modal-dialog  " role="document">
            <div class="modal-content">
               <div class="modal-body"> 
                     <div class="forget-page-box">
                        <div class="back_page">
                            <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close"><i class="fas fa-long-arrow-left"></i> {{__('messages.back')}}</a>
                        </div>
                        <div class="forget_password">
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

    <div class="modal fade onebox-auth-modal request_modal" id="onebox-request-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
         <div class="modal-dialog  " role="document">
            <div class="modal-content" id="req-model-content">
                  <form id="req-form" method="post" action="{{url(app()->getLocale().'/request-ticket-post')}}">
                <div class="modal-header req_tick">
                    <h3>{{__('messages.request ticket')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body request_all">

                    <div class="team-tickets-content">
                        <div class="float-left" id="">
                            <a href="#"><h2 class="rt-event-name"></h2></a>
                            <div class="popular-date-time "><span class="rt-event-date"></span> | <span class="rt-event-time"></span></div>
                        </div>
                        <div class="float-right">
                            <p class="rt-event-stadium"></p>
                                                    <p><span class="rt-event-tournament"></span></p>
                        </div>
                                                </div>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> -->
                      <div class="request-ticket-box">
                        <!-- <div class="request-page-heading">
                            <h3>{{__('messages.request ticket')}}</h3>
                            <p>{{__('messages.please enter the following information')}}</p>
                        </div> -->
                        <div class="req-ticket-error" style="display:none">
                            <div class="alert alert-danger" role="alert">
                                <span class="sr-only">Error:</span>
                                <span class="req-ticket-error-msg"></span>
                            </div>
                        </div>

                            <div class="req-ticket-success"  style="display:none">
                            <div class="alert alert-success" role="alert">
                                <span class="sr-only">Success:</span>
                                <span class="req-ticket-success-msg"></span>
                            </div>
                        </div>
                      
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="request_type" value="1">
                            <input type="hidden" name="tournment" id="tournment" value="">
                            <div class="row request-form" style="display:none">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <div class="select">
                                            <label for="country">{{__('messages.event name')}}<!-- <span class="text-danger">*</span> --></label>

                                            <input type="text" name="event_id" id="selectevent" value="">
                                           <!--  <select name="event_id" id="selectevent" class="form-control" onChange="eventCategory(this.value)" required style="pointer-events: none;">
                                                <option value="">{{__('messages.please select')}}...</option>
                                                
                                            </select> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                            <label for="date">{{__('messages.event date')}}<!-- <span class="text-danger">*</span> --></label>
                                            <input type="text" min="{{date('Y-m-d\TH:i')}}" name="date" id="date" required disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row request-form">
                                
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                            <label for="fullname">{{__('messages.your name')}}<span class="text-danger">*</span></label>
                                            <input class="txtOnly" type="text" name="full_name" id="fullname" placeholder="{{__('messages.enter your name')}}"  value="{{Session::get('first_name') ? Session::get('first_name').' '.Session::get('last_name')  : ''}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <div class="select">
                                            <label for="req-country">{{__('messages.select country')}}<span class="text-danger">*</span></label>
                                            <select name="country" id="req-country" class="form-control" required>
                                                <option value="">{{__('messages.please select')}}...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row request-form req-phone_field">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label for="req-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>

                                         <input type="hidden" name="dialing_code"  class="form-control" placeholder="" id="req-dialing-code">
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12 ltr">
                                               
                                                
                                                <input  data-rule-number="true" class="allow-numeric" type="tel" id="req-phone" name="phone" placeholder="{{__('messages.enter phone number')}}" value="{{Session::get('mobile')}}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required="">
                                                </div>
                                        
                                        </div>
                                        <label id="req-phone-error" class="error" for="req-phone"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <label>{{__('messages.email address')}}<span class="text-danger">*</span></label>
                                        <input type="email" placeholder="{{__('messages.email address')}}" name="email" value="{{Session::get('email')}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row request-form">
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <div class="select">
                                            <label for="ticket-category">{{__('messages.ticket category')}}</label>
                                            <select name="category" id="ticket-category" class="form-control" >
                                                <option value="">{{__('messages.please select')}}...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="account-form-group">
                                        <div class="select">
                                            <label for="req-quantity">{{__('messages.choose quantity')}}<span class="text-danger">*</span></label>
                                            <select name="quantity" id="req-quantity" class="form-control" required>
                                                @for($i=1;$i<=10;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row request-form">
                                <div class="col-md-12">
                                    <div class="account-form-group">
                                        <label>{{__('messages.special request')}}</label>
                                        <textarea cols="44" name="special_request" placeholder="{{__('messages.special request')}}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row request-form">
                                <div class="col-md-12">
                                    <p>
                                    <button type="submit">{{__('messages.submit')}}</button>
                                </p>
                                </div>
                            </div> -->
                       
                    </div>
                </div>
                <div class="modal-footer submit_bttns">
                  <button type="button" class="btn btn-cancel" data-dismiss="modal" fdprocessedid="bgs74">Cancel</button>
                  <button type="submit" class="btn btn-success" fdprocessedid="zo2h2k">Submit</button>
                </div>
                 </form>
            </div>
        </div>
    </div>
    <style type="text/css">
        #activation_message  .confirm-img{ width: 100px; }
        #activation_message  .modal-content { padding: 30px; }
    </style>
    @if(Session::has('activation-message')  || Session::has('rest_success'))
        <div class="modal fade in" id="activation_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body text-center">
                        <img src="{{url('public/img/confirm1.png')}}" class="confirm-img" alt="Confirm">
                        <h2 class="mt-3">{{Session::get('activation-message')}}{{Session::get('rest_success')}}.</h2>
                        <div class="tick_book_btn mt-2"><button type="button" data-dismiss="modal" aria-label="Close">Close</button></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    

    <!-- Modal -->
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
         
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-body text-center">
            <img src="{{url('public/img/confirm1.png')}}" width="80px" class="confirm-img" alt="Confirm">
            <h2 class="mt-3 success_message"></h2>
            <div class="tick_book_btn mt-2"><button type="button" data-dismiss="modal" aria-label="Close">Close</button></div>
          </div>
          
        </div>
      </div>
    </div>