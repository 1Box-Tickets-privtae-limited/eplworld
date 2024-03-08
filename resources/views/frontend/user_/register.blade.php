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
                            <h3 class="text-center">Register</h3>
                            <form method="post" action="{{url(app()->getLocale().'/register-post')}}" id="register">

                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row seller-form mt-3">
                            <div class="col-md-6">
                                <label for="fname"><b>First Name</b><span class="error">*</span></label>
                                <input type="text" placeholder="First Name" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname"><b>Last Name</b><span class="error">*</span></label>
                                <input type="text" placeholder="Last Name" name="last_name"  required>
                            </div>
                        </div>
                        <div class="row seller-form">
                            <div class="col-md-12">
                                <label for="email"><b>Email</b><span class="error">*</span></label>
                                <input type="email" name="email" id="email" placeholder="trade@1boxoffice.ae"  required>
                            </div>
                        </div>
                        <div class="row seller-form">
                            <div class="col-md-6">
                                <label for="areacode"><b>Area Code</b><span class="error">*</span></label>
                                <select name="dialing_code" id="areacode" class="form-control" required>
                                <option value="">Select Country</option>
                                @if($country)
                                @foreach($country as $row)
                                <option value="+{{$row['phonecode']}}" >+{{$row['phonecode']}}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                        <div class="col-md-6">
                            <label for="mobile"><b>Mobile</b><span class="error">*</span></label>
                            <input type="text" placeholder="000XXXXX" value="" name="mobile" required>
                        </div>
                        </div>
                        

                        <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="address"><b>Address<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Address" id="address" name="address" value=""  required>
                                </div>
                          
                                <div class="col-md-6">
                                    <label for="postal_code"><b>Postal Code<span class="error">*</span></b></label>
                                    <input type="text" placeholder="Postal Code" id="postal_code" name="postal_code" value=""  required>
                                </div>
                            </div>



                            <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="country"><b>Country<span class="error">*</span></b></label>
                                    <select name="country" id="country" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @if($country)
                                        @foreach($country as $row)
                                        <option value="{{$row['id']}}" >{{$row['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                          
                                <div class="col-md-6">
                                    <label for="state"><b>State<span class="error">*</span></b></label>
                                    <select name="state" id="state" class="form-control" required>
                                        <option value="">Select State</option>
                                        
                                    </select>
                                </div>
                            </div>


                        <div class="row seller-form">
                                <div class="col-md-6">
                                    <label for="password"><b> Password<span class="error">*</span></b></label>
                                    <input type="password" placeholder="Password" name="password" id="password" autocomplete="off" required >
                                </div>
                            
                                <div class="col-md-6">
                                    <label for="confirm_password"><b>Confirm Password<span class="error">*</span></b></label>
                                    <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password"   autocomplete="off"  required>
                                </div>
                            </div>



                         <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" name="newsletter"> Subscribe to our newsletter  to receive  exclusive offers
                            </label>
                          </div>

                             <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" name="terms" required>I agree to the <a href="#">Terms &amp; Conditions</a></label><br>
                              <label id="terms-error" class="error" for="terms"></label>
                            </label>
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