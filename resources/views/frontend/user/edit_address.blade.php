@extends('layouts.app')
@section('content')
     
    <style type="text/css">
        .seller-form input{
            height:50px;
        }
    </style>
    <script>
        default_country = "{{$results['country_code']}}";
    </script>
    <!-- Breadcromb Area Start -->
    <section class="onebox-breadcromb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.my address')}}</li>
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
                          <h3>{{__('messages.my address')}}</h3>
                          <hr>
                           @if($results)
                            <div class="">
                                <form action="{{url(app()->getLocale().'/update-address')}}" method="post" id="update-address">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="address_id" value="{{ base64_encode($results['id']) }}">
                                <div class="row seller-form mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address_title"><b>{{__('messages.title')}}<span class="error">*</span></b></label>
                                           

                                            <select name="address_title" id="address_title" class="form-control" required="">
                                                <option value="">{{__('messages.title')}}</option>
                                                <option value="Mr"  {{$results["title"] == "Mr" ?   "selected" : "" }}>Mr</option>
                                                <option value="Mrs"  {{$results["title"] == "Mrs" ?   "selected" : "" }}>Mrs</option>
                                                <option value="Miss"  {{$results["title"] == "Miss" ?   "selected" : "" }}>Miss</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row seller-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_name"><b>{{__('messages.first name')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.first name')}}" id="name" name="address_name" id="address_name"  value="{{$results['name']}}" required>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_surname"><b>{{__('messages.last name')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.last name')}}" id="surname" name="address_surname" id="address_surname" value="{{$results['surname']}}" required>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row seller-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_address"><b>{{__('messages.address')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.address')}}" id="address" name="address_address" id="address_address" value="{{$results['address']}}" required>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_postal_code"><b>{{__('messages.postal code')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.postal code')}}" id="postal_code" name="address_postal_code" id="address_postal_code" value="{{$results['postal_code']}}" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="row seller-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country"><b>{{__('messages.country')}}<span class="error">*</span></b></label>
                                            <select name="country" id="country" class="form-control" required>
                                                <option value="">{{__('messages.select country')}}</option>
                                                @if($country)
                                                @foreach($country as $row)
                                                <option value="{{$row['id']}}"
                                                    @if($row['id'] == $results['country'])
                                                    selected="selected"
                                                    @endif
                                                >{{$row['name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-6 state">
                                        <div class="form-group">
                                            <label for="address_state"><b>{{__('messages.state')}}<span class="error">*</span></b></label>
                                            <select name="state" id="state" class="form-control" required>
                                                <option value="">{{__('messages.select state')}}</option>
                                                @if($states)
                                                @foreach($states as $row)
                                                <option value="{{$row['id']}}"
                                                    @if($row['id'] == $results['city'])
                                                    selected="selected"
                                                    @endif
                                                >{{$row['name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row seller-form">

                                    <div class="col-md-6">

                                     <div class="form-group">
                                        <label for="edit-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                            <input name="dialing_code" type="hidden" id="edit-dialing-code" value="{{$results['dialing_code']}}"> 
                                            <input data-rule-number="true" class="allow-numeric" type="tel" id="profile-phone" name="address_phone" placeholder="{{__('messages.enter phone number')}}" value="{{$results['phone']}}" required >
                                          
                                    </div>
                                         <label id="profile-phone-error" class="error" for="profile-phone"></label>
                                     </div>

                                <!--  <div class="col-md-6 edit_phone_field">
                                        <div class="account-form-group">
                                            <label for="edit-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                            <div class="col-md-3 nopad">
                                                <input name="dialing_code" type="tel" id="edit-dialing-code" class="form-control">
                                            </div>
                                            <div class="col-md-9 nopad">
                                                <div class="account-form-group">
                                                <input  data-rule-number="true" class="allow-numeric" type="tel" id="profile-phone" name="address_phone" placeholder="{{__('messages.enter phone number')}}" value="{{$results['phone']}}" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                      <!-- <div class="col-md-6">

                                     <div class="form-group edit_phone_field">
                                        <label for="edit-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                            <input name="dialing_code" type="hidden" id="edit-dialing-code" value="{{$results['dialing_code']}}"> 
                                            <input data-rule-number="true" class="allow-numeric" type="tel" id="profile-phone" name="address_phone" placeholder="{{__('messages.enter phone number')}}" value="{{$results['phone']}}" required >
                                          
                                    </div>
                                         <label id="profile-phone-error" class="error" for="profile-phone"></label>
                                     </div> -->
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
                            @endif
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
    $("#edit-address").validate();
  
    var req_dail_code = document.querySelector("#profile-phone");
    window.intlTelInput(req_dail_code,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
          'initialCountry' : default_country,
        'autoPlaceholder': 'off',
    });
    req_dail_code.addEventListener("countrychange", function() {
      // do something with iti.getSelectedCountryData()
      $('#profile-phone').focus();
    });
    $('#update-address').submit(function() {
        $('#edit-dialing-code').val($('.edit_phone_field').find('.iti__selected-dial-code').text());
    });

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