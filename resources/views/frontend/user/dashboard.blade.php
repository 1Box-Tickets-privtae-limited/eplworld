@extends('layouts.app')
@section('content')
     
    <style type="text/css">
        
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

                <div class="row profile">
                    <div class="col-md-3">
                        <div class="tabs_faq">

                            <ul class="nav nav-tabs tabs-left">
                                <li class="active">
                                    <a href="#profile" data-toggle="tab"><i class="fas fa-chart-line"></i>Profile</a>
                                </li>
                                <li>
                                    <a href="#myorders" data-toggle="tab"><i class="fas fa-list"></i>{{__('messages.my orders')}}</a>
                                </li>
                                <li>
                                    <a href="#myaddress" data-toggle="tab"><i class="fas fa-list"></i>{{__('messages.my address')}} </a>
                                </li>
                                <li>
                                    <a href="#changepassword" data-toggle="tab"><i class="fas fa-lock"></i>{{__('messages.change password')}}</a>
                                </li>
                                <li>
                                    <a href="{{url(app()->getLocale().'/logout')}}" data-toggle="tab"><i class="fas fa-sign-out"></i>{{__('messages.logout')}}</a>
                                </li>
                            </ul>


                            <!-- Nav tabs -->
                            <!-- <ul class="nav nav-tabs tabs-left">
                                <li class="active">
                                    <a href="{{url(app()->getLocale().'/dashboard')}}">
                                    <i class="fas fa-chart-line"></i>
                                    Profile </a>
                                </li>
                                <li>
                                    <a href="{{url(app()->getLocale().'/orders')}}">
                                    <i class="fas fa-list"></i>
                                    {{__('messages.my orders')}} </a>
                                </li>
                                <li>
                                    <a href="{{url(app()->getLocale().'/address')}}">
                                    <i class="fas fa-list"></i>
                                    {{__('messages.my address')}} </a>
                                </li>
                                <li>
                                    <a href="{{url(app()->getLocale().'/change-password')}}">
                                    <i class="fas fa-lock"></i>
                                    {{__('messages.change password')}} </a>
                                </li>
                                <li>
                                    <a href="{{url(app()->getLocale().'/logout')}}">
                                    <i class="fas fa-sign-out"></i>
                                    {{__('messages.logout')}} </a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tabs_profile_content">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <div class="profile_head">
                                      <h3>{{__('messages.profile')}}</h3>
                                    </div>
                                    <div class="profile-content">
                                        <div class="profile-form">
                                            <div class="profile-userpic">
                                                <img src="{{url('public/img/new_img/user_log.png')}}" class="img-responsive" alt="">
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
                                <div class="tab-pane" id="myorders">
                                    2
                                </div>
                                <div class="tab-pane" id="myaddress">
                                    3
                                </div>
                                <div class="tab-pane" id="changepassword">
                                    4
                                </div>
                                <div class="tab-pane" id="logout">
                                    5
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- <div class="col-md-9">
                        <div class="profile_head">
                            <h3>Profile</h3>
                        </div>
                        <div class="profile-content">
                            <div class="profile-form">
                                <form method="post" action="{{url(app()->getLocale().'/profile-update')}}" id="profile">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row seller-form mt-3">
                                        <div class="col-md-6">
                                            <label for="fname"><b>First Name</b><span class="error">*</span></label>
                                            <input type="text" placeholder="First Name" name="first_name" value="{{@$user['first_name']}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lname"><b>Last Name</b><span class="error">*</span></label>
                                            <input type="text" placeholder="Last Name" name="last_name" value="{{@$user['last_name']}}" required>
                                        </div>
                                    </div>
                                    <div class="row seller-form">
                                        <div class="col-md-12">
                                            <label for="email"><b>Email</b><span class="error">*</span></label>
                                            <input type="text" placeholder="trade@1boxoffice.ae"  readonly value="{{@$user['email']}}"  required>
                                        </div>
                                    </div>
                                    <div class="row seller-form">
                                        <div class="col-md-6">
                                            <label for="areacode"><b>Area Code</b><span class="error">*</span></label>
                                            <select name="dialing_code" id="areacode" class="form-control">
                                            <option value="">Select Country</option>
                                            @if($country)
                                            @foreach($country as $row)
                                            <option value="+{{$row['phonecode']}}" {{ str_replace("+","",@$user['dialing_code']) == $row['phonecode'] ? "selected"  : ""}}>+{{$row['phonecode']}}</option>
                                            @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    <div class="col-md-6">
                                        <label for="phone"><b>Mobile</b><span class="error">*</span></label>
                                        <input type="text" placeholder="000XXXXX" value="{{@@$user['mobile']}}" name="mobile" required>
                                    </div>
                                    </div>
                                   

                                     <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" {{$user["newsletter"] == 1 ?  "checked"  : "" }} name="newsletter"> Subscribe to our newsletter  to receive  exclusive offers
                                        </label>
                                      </div>

                                       <div class="row">
                                <div class="col-md-12">
                                    <div class="form_submit">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </div>

                                   </form>

                       
                 
                        </div>
                        </div>
                    </div> -->
                </div>
          
        	
        </div>
</section>
    <!-- seller profile End -->

@endsection
@push('scripts')
<script type="text/javascript">

	$("#profile").validate();

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