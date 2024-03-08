@extends('layouts.app')
@section('content')
     
    <style type="text/css">
        .seller-form input{
            height:50px;
        }
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
                            <div class="profile-address-add">
                                <a href="javascript:void(0)"><i class="fas fa-plus-circle"></i> {{__('messages.add new address')}}</a>
                            </div>
                            <div class="profile-address-div" style="display: none;">
                                <form action="{{url(app()->getLocale().'/add-address')}}" method="post" id="address">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row seller-form mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address_title"><b>{{__('messages.title')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.title')}}" id="title" name="address_title" id="address_title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_name"><b>{{__('messages.first name')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.first name')}}" id="name" name="address_name" id="address_name"  required>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_surname"><b>{{__('messages.last name')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.last name')}}" id="surname" name="address_surname" id="address_surname"  required>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row seller-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_address"><b>{{__('messages.address')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="{{__('messages.address')}}" id="address" name="address_address" id="address_address"  required>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_postal_code"><b>{{__('messages.postal code')}}<span class="error">*</span></b></label>
                                            <input type="text" placeholder="Postal Code" id="postal_code" name="address_postal_code" id="address_postal_code"  required>
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
                                                <option value="{{$row['id']}}" >{{$row['name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_state"><b>{{__('messages.state')}}<span class="error">*</span></b></label>
                                            <select name="state" id="state" class="form-control" required>
                                                <option value="">{{__('messages.select state')}}</option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row seller-form mt-2 add-phone_field">
                                    <div class="col-md-6">
                                        <div class="account-form-group">
                                            <label for="add-dialing-code">{{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                            <div class="col-md-3 nopad">
                                                <input name="dialing_code" type="tel" id="add-dialing-code" class="form-control">
                                            </div>
                                            <div class="col-md-9 nopad">
                                                <div class="account-form-group">
                                                <input  data-rule-number="true" class="allow-numeric" type="tel" id="profile-phone" name="address_phone" placeholder="{{__('messages.enter phone number')}}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required="">
                                                </div>
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
                            @if($results)
                            @foreach($results as $row)
                            <div class="profile-address">

                                <p><strong>{{$row['name']}} {{$row['surname']}} ({{$row['phone']}})</strong><p>
                                <p>{{$row['address']}}</p>
                                <p>{{$row['postal_code']}}</p>
                                <p><a href="{{url(app()->getLocale().'/edit-address', base64_encode($row['id']))}}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a> <a href="{{url(app()->getLocale().'/delete-address', $row['id'])}}" class="btn btn-danger btn-xs" ><i class="fas fa-trash"></i></a></p>
                            </div>
                            @endforeach
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
    $("#address").validate();

    $("body").on("click",".profile-address-add",function(){
        $(".profile-address-div").toggle();
    });

    var add_dail_code = document.querySelector("#add-dialing-code");
    window.intlTelInput(add_dail_code,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        'autoPlaceholder': 'off',
    });
    add_dail_code.addEventListener("countrychange", function() {
      // do something with iti.getSelectedCountryData()
      $('#profile-phone').focus();
    });
    $('#address').submit(function() { 
        $('#add-dialing-code').val($('.add-phone_field').find('.iti__selected-dial-code').text());
    });
    
	$("form#address").on("change","#country",function(){
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