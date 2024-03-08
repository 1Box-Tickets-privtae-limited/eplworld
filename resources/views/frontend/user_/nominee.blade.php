@extends('layouts.app')
@section('content')
     
    

<!-- seller profile Start -->
<section class="onebox-seller-area section_50">
    <div class="container">
        <!-- <style type="text/css">
            .register-form{
                    background: #fff;
                    padding: 25px;
                    margin-bottom: 30px;
                    height: auto !important;
            }
            .register-form h3{
                text-transform: uppercase;
                font-size: 20px;
                font-weight: bold;
            }
        </style> -->
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">

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
                <h3 class="text-center">
  
                {{__('messages.nominative details')}} - {{__('messages.ticket quantity')}} - {{count($tickets)}}</h3>
                <form method="post" action="{{url(app()->getLocale().'/update-nominee')}}" id="register">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                    
                        
                        @if(@$tickets)
                        @foreach($tickets as $row)
                        <div class="row seller-form">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-{{ $loop->iteration }}"><b> {{__('messages.first name')}}</b><span class="error">*</span></label>
                                <input type="text" name="first_name[]" id="first-{{ $loop->iteration }}" placeholder="{{__('messages.first name')}}" value="{{ $row['first_name'] }}"  required>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name-{{ $loop->iteration }}"><b> {{__('messages.last name')}}</b><span class="error">*</span></label>
                                <input type="text" name="last_name[]" id="last_name-{{ $loop->iteration }}" placeholder="{{__('messages.last name')}}" value="{{ $row['last_name'] }}"  required>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="nationality-{{ $loop->iteration }}"><b> {{__('messages.nationality')}}</b><span class="error">*</span></label>
                                <input type="text" name="nationality[]" id="nationality-{{ $loop->iteration }}" placeholder="{{__('messages.nationality')}}" value="{{ $row['nationality'] }}"  required>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="dob-{{ $loop->iteration }}"><b> {{__('messages.date of birth')}} </b><span class="error">*</span></label>
                                <input type="text" class="dob" name="dob[]" id="dob-{{ $loop->iteration }}" placeholder="DD/MM/YYY" value="{{ date('d-m-Y',strtotime($row['dob'])) }}"  required>
                            </div>
                        </div>
                         </div> 
                        @endforeach
                        @endif

                     
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
</section>
    <!-- seller profile End -->

@endsection
@push('scripts')
<script type="text/javascript">
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
</script>
@endpush('scripts')