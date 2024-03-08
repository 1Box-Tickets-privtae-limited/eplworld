@extends('layouts.app')
@section('content')
     
    

<!-- seller profile Start -->
<section class="onebox-seller-area section_50">
    <div class="container">
        <style type="text/css">
           /* .register-form{
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
                <h3 class="text-center">Request Ticket</h3>
                <form method="post" action="{{url(app()->getLocale().'/request-ticket-post')}}" id="register">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="request_type" value="1">
                    <div class="row seller-form mt-3">
                        <div class="col-md-12">
                            <label for="event"><b>Event Name</b><span class="error">*</span></label>
                            <select name="event_id" id="event" class="form-control" required>
                                <option value="">Select Event</option>
                                @if($events)
                                    @foreach($events as $row)
                                        <option value="{{$row['m_id']}}" 
                                        @if($requestId == $row['m_id'])
                                            selected="selected"
                                        @endif>
                                        {{$row['match_name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-6">
                            <label for="date"><b>Event Data</b><span class="error">*</span></label>
                            <input type="date" name="event_date" id="date" placeholder=""  required>
                        </div>
                        <div class="col-md-6">
                            <label for="name"><b>Full Name</b><span class="error">*</span></label>
                            <input type="text" placeholder="Full name" value="" name="full_name" required>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="email"><b>Email</b><span class="error">*</span></label>
                            <input type="email" name="email" id="email" placeholder="trade@1boxoffice.ae"  required>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="country"><b>Country</b><span class="error">*</span></label>
                            <select name="country" id="country" class="form-control" required>
                            <option value="">Select Country</option>
                            @if($country)
                            @foreach($country as $row)
                            <option data-dialingcode="{{$row['phonecode']}}" value="{{$row['id']}}">{{$row['name']}}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-6">
                            <label for="areacode"><b>Country Dailing Code</b><span class="error">*</span></label>
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
                            <label for="mobile_number"><b>Mobile Number</b><span class="error">*</span></label>
                            <input type="text" name="mobile_number" id="mobile_number"  required>
                        </div>
                    
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="category"><b>Category</b><span class="error">*</span></label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">Select Category</option>
                            </select>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="quantity"><b>Quantity</b><span class="error">*</span></label>
                            <select name="quantity" id="quantity" class="form-control" required>
                                @for($i=1;$i<=10;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row seller-form">
                        <div class="col-md-12">
                            <label for="special_request"><b>Special Request</b></label>
                            <textarea rows="5" cols="10"  id="special_request" name="special_request"></textarea>
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
        </div>
</section>
    <!-- seller profile End -->

@endsection
@push('scripts')
<script type="text/javascript">
	$("#register").validate();
    $("body").on("change","#country",function(){
        var dailcode = $(this).find(':selected').data('dialingcode')
        $("#areacode option[value='+"+dailcode+"']").prop('selected', true);
    });
    $("body").on("change","#event",function(){
        var val = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{url(app()->getLocale().'/category-list')}}",
            data: {'match_id' : val ,"_token": "{{ csrf_token() }}"},
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){
                var option = "<option value=''>Select Category</option>";
                jQuery.each(data, function(index, item) { console.log(item);
                    option += "<option value='"+item.s_no+"'>"+ item.seat_category+"</option>"
                });
                $("#category").html(option);

            }
        });
	});	
</script>
@endpush('scripts')