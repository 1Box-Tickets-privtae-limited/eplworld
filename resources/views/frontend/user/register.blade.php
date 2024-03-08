@extends('layouts.app')
@section('content')
     
    

    <!-- seller profile Start -->
    <section class="onebox-seller-area section_50">
        <div class="container">

                
                <style type="text/css">
                /*    .register-form{
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
                            <h3 class="text-center">{{__('messages.sign up')}}</h3>
                        

                       
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

                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row seller-form mt-3">
                            <div class="col-md-6">
                                <label for="fname"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                <input type="text" placeholder="{{__('messages.first name')}}" name="firstname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                <input type="text" placeholder="{{__('messages.last name')}}" name="lastname"  required>
                            </div>
                        </div>
                        <div class="row seller-form">

                             <div class="col-md-6">
                                    <div class="account-form-group reg-phone_field">
                                        <label for="dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                        <input type="hidden" name="dialing_code" id="register_dialing_code">
                                        <div class="col-md-12 col-xs-12 nopad">
                                            <input data-rule-number="true" class="allow-numeric" type="tel" id="register_phone" name="phone" placeholder="{{__('messages.enter phone number')}}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required >
                                           
                                        </div>
                                        <label id="register_phone-error" class="error" for="register_phone"></label>
                                        
                                    </div>
                                </div>
                                
                            <div class="col-md-6">
                                <label for="email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                <input type="email" name="email" id="email" placeholder="{{__('messages.e-mail')}}"  required>
                            </div>
                        
                               
                        </div>

                        <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="address"><b>{{__('messages.street address')}}<span class="error">*</span></b></label>
                                    <input type="text" placeholder="{{__('messages.street address')}}" id="address" name="address" value=""  required>
                                </div>
                          
                                <div class="col-md-6">
                                    <label for="postal_code"><b>{{__('messages.zip/postal code')}}<span class="error">*</span></b></label>
                                    <input type="text" placeholder="{{__('messages.zip/postal code')}}" id="postal_code" name="postcode" value=""  required>
                                </div>
                            </div>



                            <div class="row seller-form">
                                <div class="col-md-6">
                                    <!-- <label for="country"><b>Country<span class="error">*</span></b></label> -->
                                    <label for="country">{{__('messages.select country')}}<span class="text-danger">*</span></label>
                                            <select name="country" id="reg_country" class="form-control" required>
                                                <option value="">{{__('messages.please select')}}...</option>
                                        @if($country)
                                        @foreach($country as $row)
                                        <option value="{{$row['id']}}" >{{$row['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                          
                                <div class="col-md-6">
                                    <label for="city">{{__('messages.select city')}}<span class="text-danger">*</span></label>
                                    <select name="city" id="reg_state" class="form-control" required>
                                        <option value="">{{__('messages.please select')}}...</option>
                                        
                                    </select>
                                </div>
                            </div>


                        <div class="row seller-form sep_division">
                                <div class="col-md-6">
                                    <label for="password"><b> {{__('messages.password')}}<span class="error">*</span></b></label>
                                    <input type="password" placeholder="{{__('messages.password')}}" name="password" id="password" autocomplete="off" required >
                                </div>
                            
                                <div class="col-md-6">
                                    <label for="confirm_password"><b>{{__('messages.confirm password')}}<span class="error">*</span></b></label>
                                    <input type="password" placeholder="{{__('messages.confirm password')}}" id="confirm_password" name="confirm_password"   autocomplete="off"  required>
                                </div>
                            </div>



                         <!-- <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" name="newsletter"> Subscribe to our newsletter  to receive  exclusive offers
                            </label>
                          </div>
 -->
                             <div class="checkbox">
                            <label>
                             <input type="checkbox" id="aggree" value="1" name="aggree" required>{{__('messages.i have read and accept the and')}} 
                                                <a target="_blank" href="{{('https://www.1boxoffice.com/'.app()->getLocale().'/terms-and-conditions')}}">{{__('messages.terms and conditions')}}</a> {{__('messages.and')}} <a target="_blank" href="{{('https://www.1boxoffice.com/'.app()->getLocale().'/legal-privacy-policy')}}">{{__('messages.privacy policy')}}</a></label>
                                                <label id="aggree-error" class="error" for="aggree"></label>
                            
                          </div>
                          <div class="row seller-form">
                          <div class="col-md-12">
                                    <div class="form_submit">
                                        <input type="submit" value="{{__('messages.sign up')}}">
                                    </div>
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

	$("#register").validate({ rules : {
            password : {
                minlength : 6
            },
            confirm_password : {
                minlength : 6,
                equalTo : '[name="password"]'
            }
        }});

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