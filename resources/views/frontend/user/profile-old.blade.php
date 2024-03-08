@extends('layouts.app')
@section('content')
     

         <!-- Breadcromb Area Start -->
    <section class="onebox-breadcromb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                            <li>/</li>
                            <li>Profile</li>
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

        	<form method="post" action="{{url('profile-update')}}" id="profile">
            <div class="row onebox-seller">
                <div class="col-md-6">
                <div class="onebox-seller-form">
                <h3>Personal Information</h3>
                    

                    	


                    	   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row seller-form mt-3">
                            <div class="col-md-6">
                                <label for="fname"><b>First Name</b><span class="error">*</span></label>
                                <input type="text" placeholder="First Name" name="first_name" value="{{$user['first_name']}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname"><b>Last Name</b><span class="error">*</span></label>
                                <input type="text" placeholder="Last Name" name="last_name" value="{{$user['last_name']}}" required>
                            </div>
                        </div>
                        <div class="row seller-form">
                            <div class="col-md-12">
                                <label for="email"><b>Email</b><span class="error">*</span></label>
                                <input type="text" placeholder="trade@1boxoffice.ae"  readonly value="{{$user['email']}}"  required>
                            </div>
                        </div>
                        <div class="row seller-form">
                            <div class="col-md-6">
                                <label for="areacode"><b>Area Code</b><span class="error">*</span></label>
                                <select name="dialing_code" id="areacode" class="form-control">
                                <option value="">Select Country</option>
                                @if($country)
                                @foreach($country as $row)
                                <option value="+{{$row['phonecode']}}" {{ str_replace("+","",$user['dialing_code']) == $row['phonecode'] ? "selected"  : ""}}>+{{$row['phonecode']}}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                        <div class="col-md-6">
                            <label for="phone"><b>Mobile</b><span class="error">*</span></label>
                            <input type="text" placeholder="000XXXXX" value="{{@$user['mobile']}}" name="mobile" required>
                        </div>
                        </div>
                        <h4 class="mt-1 profile-sm-title">Change Password</h4>
                        <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="first_name"><b>New Password<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Password" name="password" autocomplete="off" >
                                </div>
                            
                                <div class="col-md-6">
                                    <label for="last_name"><b>Confirm Password<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Confirm Password" name="confirm_password"   autocomplete="off" >
                                </div>
                            </div>

                         <div class="checkbox">
						    <label>
						      <input type="checkbox" value="1" {{$user["newsletter"] == 1 ?  "checked"  : "" }} name="newsletter"> Subscribe to our newsletter  to receive  exclusive offers
						    </label>
						  </div>
                       

                       
                 
                </div>
                </div>



                <div class="col-md-6">
                    <div class="onebox-seller-form seller-form-right margin-top">
                        <h3>Address</h3>
                       
                            <div class="row seller-form mt-3">
                                <div class="col-md-12">
                                    <label for="address_title"><b>Title<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Title" id="address_title" name="address_title" value="{{@$address['title']}}" required>
                                </div>
                            </div>
                            <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="address_name"><b>First Name<span class="error">*</span></b></label>
                                    <input type="text" placeholder="First Name" id="address_name" name="address_name" value="{{@$address['name']}}"  required>
                                </div>
                            
                                <div class="col-md-6">
                                    <label for="address_surname"><b>Last Name<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Last Name" id="address_surname" name="address_surname" value="{{@$address['surname']}}"  required>
                                </div>
                            </div>

                             <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="address_address"><b>Address<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Address" id="address_address" name="address_address" value="{{@$address['address']}}"  required>
                                </div>
                          
                                <div class="col-md-6">
                                    <label for="address_postal_code"><b>Postal Code<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Postal Code" id="address_postal_code" name="address_postal_code" value="{{@$address['postal_code']}}"  required>
                                </div>
                            </div>



                            <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="country"><b>Country<span class="error">*</span></b></label>
                                   	<select name="address_country" id="country" class="form-control">
		                                <option value="">Select Country</option>
		                                @if($country)
		                                @foreach($country as $row)
		                                <option value="{{$row['id']}}" {{@$address['country'] == $row['id'] ? "selected"  : ""}}>{{$row['name']}}</option>
		                                @endforeach
		                                @endif
	                                </select>
                                </div>
                          
                                <div class="col-md-6">
                                    <label for="address_state"><b>State<span class="error">*</span></b></label>
                                   	<select name="address_state" id="state" class="form-control">
		                                <option value="">Select State</option>
		                                @if(@$states)
		                                @foreach($states as $row)
		                                <option value="{{$row['id']}}" {{@$address['city'] == $row['id'] ? "selected"  : ""}} >{{$row['name']}}</option>
		                                @endforeach
		                                @endif
	                                </select>
                                </div>
                            </div>

                             <div class="row seller-form mt-2">

                             	<div class="col-md-6">
                                <label for="address_dialing_code"><b>Area Code</b><span class="error">*</span></label>
                                <select name="address_dialing_code" id="address_dialing_code" class="form-control">
	                                <option value="">Select Area Code</option>
	                                @if($country)
	                                @foreach($country as $row)
	                                <option value="+{{$row['phonecode']}}" {{ str_replace("+","",$user['dialing_code']) == @$address['dialing_code'] ? "selected"  : ""}}>+{{$row['phonecode']}}</option>
	                                @endforeach
	                                @endif
	                                </select>
	                            </div>

                                <div class="col-md-6">
                                    <label for="address_phone"><b>Mobile<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Mobile Number" id="address_phone" name="address_phone" value="{{@$address['phone']}}"  required>
                                </div>
                            </div>

                          
                       
                    </div>
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
				url: "{{url('get_state')}}",
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