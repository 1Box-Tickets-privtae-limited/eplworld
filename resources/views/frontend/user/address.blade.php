@extends('layouts.app')
@section('content')
     
    <style type="text/css">
        .seller-form input{
            height:50px;
        }
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
                            <li>{{__('messages.my address')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h1>{{__('messages.my address')}}</h1>
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

                          <div class="tab-pane" id="address">
                                    <div class="all_head">
                                        <h3>{{__('messages.my address')}}</h3>
                                    </div>
                                    <div class="profile-address-div ">

                                           @if($results)
                                     @foreach($results as $row)
                           
                <div class="edit_address data_show_list" >
                    <div class="profile-form">
                        <h4>{{__('messages.Billing Address')}}</h4>
                        <p><span>{{$row['title']}} {{$row['name']}} {{$row['surname']}} </span></p>
                        <p>{{@$row['dialing_code']}} {{$row['phone']}}</p>
                        <p>{{@$row['email']}}</p>
                        <p>{{$row['address']}}</p>
                    </div>
                    <div class="profile-form">
                        <h4>{{__('messages.Delivery Address')}}</h4>
                        <p><span>{{$row['delivery_title']}} {{$row['delivery_first_name']}} {{$row['delivery_last_name']}} </span></p>
                         <p>{{@$row['delivery_dailing_code']}} {{$row['delivery_mobile']}}</p>
                        
                        <p>{{$row['delivery_email']}}</p>
                        <p>{{$row['delivery_address']}}</p>
                    </div>
                    <div class="profile-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form_submit mt-2">
                                    <input type="submit" value="{{__('messages.Edit')}}" class="edit_btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                   <div class="save_address data_show" style="display:none;">

                    <form action="{{url(app()->getLocale().'/update-address')}}" method="post" id="update-address">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="address_id" value="{{ base64_encode($row['id']) }}">

                    <div class="profile-form">
                        <h4>Billing Address</h4>
                                
                                <div class="row seller-form mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address_title"><b>{{__('messages.title')}}<span class="error">*</span></b></label>
                                           

                                            <select name="address_title" id="address_title" class="form-control" required="">
                                                <option value="">{{__('messages.title')}}</option>
                                                <option value="Mr"  {{$row["title"] == "Mr" ?   "selected" : "" }}>Mr</option>
                                                <option value="Mrs"  {{$row["title"] == "Mrs" ?   "selected" : "" }}>Mrs</option>
                                                <option value="Miss"  {{$row["title"] == "Miss" ?   "selected" : "" }}>Miss</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                   
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="fname"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.first name')}}" name="address_name" value="{{@$row['name']}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="lname"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.last name')}}" name="address_surname" value="{{@$row['surname']}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                            <input type="text" name="email" placeholder="{{__('messages.e-mail')}}"   value="{{@$row['email']}}"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="account-form-group" id="profile-dialing-id">
                                            <div class="form-group">
                                                <label for="prof-mobile">
                                                   {{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                                   <input type="hidden" name="dialing_code" value="{{@$row['dialing_code']}}" id="prof-dialing-code">
                                                <div class="col-md-12 nopad">
                                                    <input id="prof-mobile"  class="form-control allow-numeric" type="tel"  name="address_phone" placeholder="{{__('messages.enter phone number')}}" value="{{@$row['phone']}}"  required="" >
                                                </div>
                                                <label id="prof-mobile-error" class="error" for="prof-mobile"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form profile_phone_field">
                                </div>
                               
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="address"><b>{{__('messages.address')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.address')}}" name="address_address" value="{{@$row['address']}}" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="postal_code"><b>{{__('messages.postal code')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.postal code')}}" name="address_postal_code" value="{{@$row['postal_code']}}" required="">
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
                                                        @foreach($country as $row_a)
                                                        <option value="{{$row_a['id']}}" {{$row['country'] == $row_a['id'] ? "selected" :""}} >{{$row_a['name']}}</option>
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
                               <!--  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form_submit mt-2">
                                            <input type="submit" value="{{__('messages.submit')}}">
                                        </div>
                                    </div>
                                </div> -->
                        
                    </div>

                    <div class="profile-form">
                        <h4>Delievry Address</h4>
                            
                            <div class="row seller-form mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="delivery_title"><b>{{__('messages.title')}}<span class="error">*</span></b></label>
                                           

                                            <select name="delivery_title" id="delivery_title" class="form-control" required="">
                                                <option value="">{{__('messages.title')}}</option>
                                                <option value="Mr"  {{$row["delivery_title"] == "Mr" ?   "selected" : "" }}>Mr</option>
                                                <option value="Mrs"  {{$row["delivery_title"] == "Mrs" ?   "selected" : "" }}>Mrs</option>
                                                <option value="Miss"  {{$row["delivery_title"] == "Miss" ?   "selected" : "" }}>Miss</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_first_name"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.first name')}}" name="delivery_first_name" value="{{@$row['delivery_first_name']}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_last_name"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.last name')}}" name="delivery_last_name" value="{{@$row['delivery_last_name']}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder=""   value="{{@$row['delivery_email']}}" name="delivery_email"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="account-form-group" id="delivery-dialing-id">
                                            <div class="form-group">
                                                <label for="prof-mobile">
                                                   {{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                                   <input type="hidden" name="delivery_dailing_code" value="{{@$row['delivery_dailing_code']}}" id="delivery-dialing-code">
                                                <div class="col-md-12 nopad">
                                                    <input id="delivery-mobile"  class="form-control allow-numeric" type="tel"  name="delivery_mobile" placeholder="{{__('messages.enter phone number')}}" value="{{@$row['delivery_mobile']}}"  required="" >
                                                </div>
                                                <label id="prof-delivery_mobile-error" class="error" for="prof-delivery_mobile"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form profile_phone_field">
                                </div>
                               
                                <div class="row seller-form">
                                   <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="address"><b>{{__('messages.address')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.address')}}" name="delivery_address" value="{{$row['delivery_address']}}" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_postal_code"><b>{{__('messages.postal code')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.postal code')}}" name="delivery_postal_code" value="{{$row['delivery_postal_code']}}" required="">
                                        </div>
                                    </div>
                                </div>

                                 <div class="row seller-form">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="delivery_country"><b>{{__('messages.country')}}<span class="error">*</span></b></label>
                                                    <select name="delivery_country" id="delivery_country" class="form-control" required>
                                                        <option value="">{{__('messages.select country')}}</option>
                                                        @if($country)
                                                        @foreach($country as $row_a)
                                                        <option value="{{$row_a['id']}}" {{$row['delivery_country'] == $row_a['id'] ? "selected" :""}} >{{$row_a['name']}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                      
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="delivery_state"><b>{{__('messages.state')}}<span class="error">*</span></b></label>
                                                    <select name="delivery_state" id="delivery_state" class="form-control" required>
                                                        <option value="">{{__('messages.select state')}}</option>
                                                      
                                                    </select>
                                                </div>
                                            </div>
                        </div>
                        
                    </div>
                    <div class="profile-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form_submit mt-2">
                                    <input type="submit" value="Save" class="save_add_btn">
                                </div>
                            </div>
                        </div>
                    </div>
                      </form>

                </div>
          
                          

                                         @endforeach
                                    @else
                                        <div class="add_address data_hide">
                                            <p>No Adress Added</p>
                                            <div class="form_submit">
                                                <input type="submit" value="Add Address" class="edit_btn">
                                            </div>
                                        </div>

                                        <div class="save_address data_show" style="display:none;">

                                        <form action="{{url(app()->getLocale().'/add-address')}}" method="post" id="update-address">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          

                                    <div class="profile-form">
                                        <h4>Billing Address</h4>
                                                
                                                <div class="row seller-form mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="address_title"><b>{{__('messages.title')}}<span class="error">*</span></b></label>
                                                           

                                                            <select name="address_title" id="address_title" class="form-control" required="">
                                                                <option value="">{{__('messages.title')}}</option>
                                                                <option value="Mr"  >Mr</option>
                                                                <option value="Mrs"  >Mrs</option>
                                                                <option value="Miss"  >Miss</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                </div>
                   
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="fname"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.first name')}}" name="address_name" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="lname"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.last name')}}" name="address_surname" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                            <input type="text" name="email" placeholder=""   value=""  required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="account-form-group" id="profile-dialing-id">
                                            <div class="form-group">
                                                <label for="prof-mobile">
                                                   {{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                                   <input type="hidden" name="dialing_code" value="{{@$row['dialing_code']}}" id="prof-dialing-code">
                                                <div class="col-md-12 nopad">
                                                    <input id="prof-mobile"  class="form-control allow-numeric" type="tel"  name="address_phone" placeholder="{{__('messages.enter phone number')}}" value=""  required="" >
                                                </div>
                                                <label id="prof-mobile-error" class="error" for="prof-mobile"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form profile_phone_field">
                                </div>
                               
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="address"><b>Address</b><span class="error">*</span></label>
                                            <input type="text" placeholder="" name="address_address" value="{{@$row['address']}}" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="postal_code"><b>Postcode</b><span class="error">*</span></label>
                                            <input type="text" placeholder="Postcode" name="address_postal_code" value="" required="">
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
                                                        @foreach($country as $row_a)
                                                        <option value="{{$row_a['id']}}"  >{{$row_a['name']}}</option>
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
                               <!--  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form_submit mt-2">
                                            <input type="submit" value="{{__('messages.submit')}}">
                                        </div>
                                    </div>
                                </div> -->
                        
                    </div>

                    <div class="profile-form">
                        <h4>Delievry Address</h4>
                            
                            <div class="row seller-form mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="delivery_title"><b>{{__('messages.title')}}<span class="error">*</span></b></label>
                                           

                                            <select name="delivery_title" id="delivery_title" class="form-control" required="">
                                                <option value="">{{__('messages.title')}}</option>
                                                <option value="Mr"  >Mr</option>
                                                <option value="Mrs"  >Mrs</option>
                                                <option value="Miss"  >Miss</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_first_name"><b>{{__('messages.first name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.first name')}}" name="delivery_first_name" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_last_name"><b>{{__('messages.last name')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder="{{__('messages.last name')}}" name="delivery_last_name" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form">
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_email"><b>{{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                            <input type="text" placeholder=""   value="" name="delivery_email"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="account-form-group" id="delivery-dialing-id">
                                            <div class="form-group">
                                                <label for="delivery-mobile">
                                                   {{__('messages.phone number')}}<span class="text-danger">*</span></label>
                                                   <input type="hidden" name="delivery_dailing_code" value="{{@$row['delivery_dailing_code']}}" id="delivery-dialing-code">
                                                <div class="col-md-12 nopad">
                                                    <input id="delivery-mobile"  class="form-control allow-numeric" type="tel"  name="delivery_mobile" placeholder=""  required="" >
                                                </div>
                                                <label id="prof-delivery_mobile-error" class="error" for="prof-delivery_mobile"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row seller-form profile_phone_field">
                                </div>
                               
                                <div class="row seller-form">
                                   <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="address"><b>Address</b><span class="error">*</span></label>
                                            <input type="text" placeholder="" name="delivery_address" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 full_widd">
                                        <div class="form-group">
                                            <label for="delivery_postal_code"><b>Postcode</b><span class="error">*</span></label>
                                            <input type="text" placeholder="" name="delivery_postal_code" value="" required="">
                                        </div>
                                    </div>
                                </div>

                                 <div class="row seller-form">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="delivery_country"><b>{{__('messages.country')}}<span class="error">*</span></b></label>
                                                    <select name="delivery_country" id="delivery_country" class="form-control" required>
                                                        <option value="">{{__('messages.select country')}}</option>
                                                        @if($country)
                                                        @foreach($country as $row_a)
                                                        <option value="{{$row_a['id']}}"  >{{$row_a['name']}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                      
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="delivery_state"><b>{{__('messages.state')}}<span class="error">*</span></b></label>
                                                    <select name="delivery_state" id="delivery_state" class="form-control" required>
                                                        <option value="">{{__('messages.select state')}}</option>
                                                      
                                                    </select>
                                                </div>
                                            </div>
                        </div>
                        
                    </div>
                    <div class="profile-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form_submit mt-2">
                                    <input type="submit" value="Save" class="save_add_btn">
                                </div>
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
          
            
        </div>
</section>
    <!-- seller profile End -->

@endsection
@push('scripts')
<script type="text/javascript">


     $("body").on("change","#country",function(){
        var val = $(this).val();
        get_state(val);
    }); 

    function get_state(val,selected = ""){
       
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
                         var selected_text = "";
                        if(selected ){
                            if(item.id == selected){
                                selected_text =  "selected";
                            }
                        }
                        
                        option += "<option value='"+item.id+"'  "+selected_text+" >"+ item.name+"</option>"
                    });
                    $("#state").html(option);

                }
            });
    }

    @if(@$row['country'])
        get_state({{@$row['country']}},{{@$row['city']}});
    @endif


    $("body").on("change","#delivery_country",function(){
        var val = $(this).val();
        get_delivery_state(val);
    });

    function get_delivery_state(val,selected = ""){
       
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
                         var selected_text = "";
                        if(selected ){
                            if(item.id == selected){
                                selected_text =  "selected";
                            }
                        }
                        
                        option += "<option value='"+item.id+"'  "+selected_text+" >"+ item.name+"</option>"
                    });
                    $("#delivery_state").html(option);

                }
            });
    }


    @if(@$row['delivery_country'])
        get_delivery_state({{$row['delivery_country']}},{{$row['delivery_state']}});
    @endif


       $(document).ready(function() {
  $(".edit_btn").click(function() {
    $(".data_hide").hide();
    $(".data_show_list").hide();
    $(".data_show").show();
  });
  // $(".save_add_btn").click(function() {
  //   $(".data_show_hide").show();
  //    $(".data_show").hide();
  // });
  //$(".edit_add_btn").click(function() {
    //$(".data_hide").show();
     //$(".data_show").hide();
  //});
});

    $("#profile").validate();
    $("#address").validate();

    $("body").on("click",".profile-address-add",function(){
        $(".profile-address-div").toggle();
    });

    var add_dail_code = document.querySelector("#prof-mobile");
    window.intlTelInput(add_dail_code,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        @if(@$row['country_code']) 'initialCountry' : "{{@$row['country_code']}}", @endif
        'autoPlaceholder': 'off',
    });
    add_dail_code.addEventListener("countrychange", function() {
      // do something with iti.getSelectedCountryData()
      $('#prof-phone').focus();
    });


    var add_dail_code2 = document.querySelector("#delivery-mobile");
    window.intlTelInput(add_dail_code2,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        @if(@$row['dv_country_code']) 'initialCountry' : "{{@$row['dv_country_code']}}", @endif
        'autoPlaceholder': 'off',
    });
    add_dail_code2.addEventListener("countrychange", function() {
      // do something with iti.getSelectedCountryData()
      $('#delivery-mobile').focus();
    });

    $('#address').submit(function() { 
        $('#prof-dialing-code').val($('#profile-dialing-id').find('.iti__selected-dial-code').text());
        $('#delivery-dialing-code').val($('#delivery-dialing-id').find('.iti__selected-dial-code').text());

       
    });
    
    // $("form#address").on("change","#country",function(){
    //         var val = $(this).val();
    //         $.ajax({
    //             type: "POST",
    //             url: "{{url(app()->getLocale().'/get_state')}}",
    //             data: {'country_id' : val ,"_token": "{{ csrf_token() }}"},
    //             beforeSend: function() {
    //                 // $("#state-list").addClass("loader");
    //             },
    //             success: function(data){
                    
    //                 var option = "";
    //                 jQuery.each(data, function(index, item) {
    //                     option += "<option value='"+item.id+"'>"+ item.name+"</option>"
    //                 });
    //                 $("#state").html(option);

    //             }
    //         });
    // }); 

   
</script>
@endpush('scripts')