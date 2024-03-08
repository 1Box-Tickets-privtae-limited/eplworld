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
                          <h3>Profile</h3>
                          <hr>
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
                    </div>
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