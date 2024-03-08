@extends('layouts.app')
@section('content')
     
    

<!-- seller profile Start -->
<section class="onebox-seller-area section_50">
    <div class="container">
        
        <div class="row">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-12">

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
                <h3 class="text-center">Order No : #{{$booking[0]['booking_no']}}</h3>
                 @if($mobile == true)
                <h3 class="text-center">
                {{$matches[0]['match_name']}}</h3> 
                <h3 class="text-center">{{$matches[0]['tournament_name'] }}</h3>
                 @else
                 <h3 class="text-center">
                {{$matches[0]['match_name']}} - {{$matches[0]['tournament_name'] }}</h3> 
                @endif
               <p>  @if($matches[0]['tbc_status'])
                        {{$matches[0]['tbc_status']}}
                    @else  {{ date("d/m/Y h:m", strtotime($matches[0]['match_date']))}} {{$matches[0]['match_time']}} {{date("l", strtotime($matches[0]['match_date'])) }} @endif </p>
                <p>{{$matches[0]['stadium_name']}} , {{$matches[0]['city_name'] , $matches[0]['country_name'] }}</p>
           
                 <h4 class="text-center">
  
                {{__('messages.nominative details')}} - {{__('messages.ticket quantity')}} - {{count($tickets)}}</h4>
                <form method="post" action="{{url(app()->getLocale().'/update_applynominee')}}" id="update_applynominee">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                    
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                        @if(@$tickets)
                        @foreach($tickets as $row)
                        <div class="row seller-form">

                          <div class="col-md-2 col-sm-2 col-xs-6 full_widd">
                            <div class="form-group">
                                @if($mobile == false)
                                <label for="first-{{ $loop->iteration }}"><b> Ticket No </b></label>
                                

                                <input type="text" value="{{ $loop->iteration }}"  readonly disabled style="border: none;
    background: #FFF;
    padding: 0;
    padding: 10px 0;">

                                @else
                                <label for="first-{{ $loop->iteration }}"><b> Ticket No {{ $loop->iteration }}</b></label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 full_widd">
                            <div class="form-group">
                                <label for="first-{{ $loop->iteration }}"><b> {{__('messages.first name')}} (English)</b><span class="error">*</span></label>
                                <input class="allow_english" type="text" name="first_name[]" id="first-{{ $loop->iteration }}" placeholder="{{__('messages.first name')}}" value="{{ $row['first_name'] }}"  onkeypress="ValidateKey(event)" onpaste="return false;" required>
                            </div>
                        </div>
                         <div class="col-md-3 col-sm-3 col-xs-6 full_widd">
                            <div class="form-group">
                                <label for="last_name-{{ $loop->iteration }}"><b> {{__('messages.last name')}} (English)</b><span class="error">*</span></label>
                                <input class="allow_english" type="text" name="last_name[]" id="last_name-{{ $loop->iteration }}" placeholder="{{__('messages.last name')}}" value="{{ $row['last_name'] }}" onkeypress="ValidateKey(event)" onpaste="return false;" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6 full_widd">
                            <div class="form-group">
                                <label for="email-{{ $loop->iteration }}"><b> {{__('messages.e-mail')}}</b><span class="error">*</span></label>
                                <input type="email" name="email[]" id="email-{{ $loop->iteration }}" placeholder="{{__('messages.e-mail')}}" value="{{ $row['email'] }}" onpaste="return false;" required>
                            </div>
                        </div>
                        
                        
                         </div> 

                         <hr>
                        @endforeach
                        @endif
                    </div></div>
                     
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
       <!--  @if($ticket_count == 0)
        @if(!Session::has('success') && !Session::has('error'))
         <br>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            <strong>
                              You have been updated Attendees details already.
                            </strong>
                        
                        </div>
                    </div>
                </div>
        @endif
         @endif -->
    </div>
</div>
        </div>
</section>
    <!-- seller profile End -->

@endsection
@push('scripts')
<script type="text/javascript">

    $('.allow_english').bind('keyup blur', function () {
    $(this).val($(this).val().replace(/[^A-Za-z]/g, ''))
});
    
    function ValidateKey (e) {  // Accept only alpha numerics, no special characters 
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}

  

    $("#register").validate();
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

      $(function () {
        var dateNow = new Date();
            
            @foreach($tickets as $row)
            @if(@$row['first_name'])
            $('#dob-{{ $loop->iteration }}').datetimepicker({
            //format: 'L',
            format: 'D-MM-yyyy',
            //locale: "{{app()->getLocale()}}",
            //  maxDate: moment(),
            icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-clock-o",
            clear: "fa fa-trash-o"
            }
            });
            @endif
            @endforeach


             setTimeout(function() { 
       
        $('.dob').datetimepicker({
            //format: 'L',
            format: 'D-MM-yyyy',
            //locale: "{{app()->getLocale()}}",
              maxDate: moment(),
            icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-clock-o",
            clear: "fa fa-trash-o"
            }
            });

    }, 500);

            

              });

      $("#update_applynominee").validate({
               rules: {
        first_name[]: {
            required: true
        }, 
        last_name[]: {
            required: true
        }
        email[]: {
            required: true,
            email: true
        }
    },
            messages: {
                first_name[]: {
                    required: "Enter the First name"
                },
                last_name[]: {
                    required: "Enter the Last name"
                },
                email[]: {
                    required: "Enter the Email Address"
                }
            },
            submitHandler: function(form) {
            $("#update_applynominee").submit();
            }
        });
</script>
@endpush('scripts')