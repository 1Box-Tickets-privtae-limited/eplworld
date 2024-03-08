@extends('layouts.app')
@section('content')
     
    <style type="text/css">
        
    </style>
  <!-- Breadcromb Area Start -->

    <section class="onebox-breadcromb-area breadcromb-bg-image">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i>{{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.change password')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h1>{{__('messages.change password')}}</h1>
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
                    
                         @include('frontend.user.left-menu')
                   
                    <div class="col-md-8">

                        
                        

                        <div class="tab-pane active" >
                                    <div class="all_head">
                                        <h3>{{__('messages.change password')}}</h3>
                                    </div>
                                    <div class="profile_password">
                                        <div class="row seller-form">
                                            <div class="col-md-12">
                                <form method="post" action="{{url(app()->getLocale().'/change-password-post')}}" id="profile">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row seller-form mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="old_password"><b>{{__('messages.old password')}}</b><span class="error">*</span></label>
                                                <input type="password" placeholder="{{__('messages.enter old password')}}" name="old_password" id="old_password"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="new_pasword"><b>{{__('messages.new password')}}</b><span class="error">*</span></label>
                                                <input type="password" placeholder="{{__('messages.enter new password')}}" name="new_password"  id="new_pasword"   required>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="confirm_password"><b>{{__('messages.confirm password')}}</b><span class="error">*</span></label>
                                                <input type="password" placeholder="{{__('messages.enter confirm password')}}" name="confirm_password" id="confirm_password"  required>
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