@extends('layouts.app')
@section('content')

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>{{__('messages.Track Order')}}</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">

                <div class="onebox-section-heading">
                    <h1><span>{{__('messages.Track Order')}}</span></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->




<section class="onebox-track-order section_50">
    <div class="container">
        <div class="seller-form_new">
        <form id="track-order-details" action="{{url(app()->getLocale().'/track-order-details')}}" method="post">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('messages.Order Reference')}}</label>
                                <!--<input type="text" name="firstname" id="" placeholder="Enter Order Reference">-->
                                <input type="text" name="order_id" id="order_id" placeholder="{{__('messages.Enter Your Order Reference')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('messages.Email id')}}</label>
                               <!-- <input type="email" name="email" id="" placeholder="Enter Email ID">-->
                               <input type="email" name="email" id="email" placeholder="{{__('messages.enter your email address')}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('messages.Surname')}}</label>
                               <!-- <input type="text" name="surname" id="" placeholder="Enter Surname">-->
                               <input type="text" name="surname" id="surname" placeholder="{{__('messages.enter surname')}}" required>
                            </div>
                        </div>
                         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="check-status">
                      <!--  <a href="#">Check Status</a>-->
                          <button type="submit" class="chk_stats">{{__('messages.Check Status')}}</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="" id="tracking_info">
            
        </div>
        @if(app()->getLocale() == "en")
        <div class="track-order-details-new">
            <div class="row">
                <div class="col-md-6">
                <div class="tickets_arrive">
                    <h4>When Do My Ticket(s) Arrive? </h4>
                    <p>Tickets for football events are generally released by the clubs only in the week leading up to the match. Suppliers try to get all tickets dispatched as soon as possible, and you are advised by email when they are sent.</p>

                    <p>Deliveries also depend on the format of the ticket. These can either be regular physical tickets or in most cases, tickets tend to be released by the clubs in an electronic configuration. The most common ticket formats nowadays are either PDF files or Mobile Tickets.</p>

                    <p>In both cases, specific instructions are always emailed to the buyer depending on their ticket selection.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tickets_all">
                    <div class="pdf_ticket">
                        <div class="pdf_ticket_img">
                            <img src="../public/img/pdf_1.png">
                        </div>
                        <div class="pdf_tick_info">
                            <h4>PDF Tickets</h4>
                            <p>PDF tickets are usually sent out 24/48 hrs prior to the event date for our customers to print at home at their own convenience.</p>
                        </div>
                    </div>
                    <div class="pdf_ticket">
                        <div class="pdf_ticket_img">
                            <img src="../public/img/pdf_2.png">
                        </div>
                        <div class="pdf_tick_info">
                            <h4>Mobile Tickets</h4>
                            <p>Mobile Tickets are usually transferred 24/48 hrs before the match and, depending on the club or federation responsible to release them, our customers may be required to download an application in order to receive them and present them at the stadium gates.</p>
                        </div>
                    </div>
                    <div class="pdf_ticket">
                        <div class="pdf_ticket_img">
                            <img src="../public/img/pdf_3.png">
                        </div>
                        <div class="pdf_tick_info">
                            <h4>Paper Tickets</h4>
                            <p>Paper Tickets - we try to get all tickets dispatched within 3-5 days prior to the event and you are advised by email when they are sent. Once receiving notification of dispatch, you can expect them the following day for UK deliveries  </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                <div class="track-order-details">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tickets_arrive">
                                <h4>متى تصل تذكرتي؟  </h4>
                                <p>يتم إصدار تذاكر أحداث كرة القدم بشكل عام من قبل الأندية فقط في الأسبوع الذي يسبق المباراة. يحاول الموردون إرسال جميع التذاكر في أسرع وقت ممكن ، ويتم إعلامك عبر البريد الإلكتروني عند إرسالها.  </p>

                                <p>تعتمد عمليات التسليم أيضًا على تنسيق التذكرة. يمكن أن تكون هذه إما تذاكر مادية عادية أو في معظم الحالات، تميل الأندية إلى إصدار التذاكر بشكل إلكتروني. تنسيقات التذاكر الأكثر شيوعًا في الوقت الحاضر هي إما ملفات PDF أو تذاكر الهاتف المحمول. </p>

                                <p>في كلتا الحالتين ، يتم دائمًا إرسال تعليمات محددة عبر البريد الإلكتروني إلى المشتري اعتمادًا على اختيار التذكرة.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tickets_all">
                                <div class="pdf_ticket">
                                    <div class="pdf_ticket_img">
                                        <img src="../public/img/pdf_1.png">
                                    </div>
                                    <div class="pdf_tick_info">
                                        <h4>تذاكر PDF </h4>
                                        <p>عادةً ما يتم إرسال التذاكر بصيغة PDF قبل 24/48 ساعة من تاريخ الحدث ليتمكن عملاؤنا من طباعتها في المنزل في الوقت الذي يناسبهم.</p>
                                    </div>
                                </div>
                                <div class="pdf_ticket">
                                    <div class="pdf_ticket_img">
                                        <img src="../public/img/pdf_2.png">
                                    </div>
                                    <div class="pdf_tick_info">
                                        <h4>تذاكر الجوال</h4>
                                        <p>يتم عادةً نقل تذاكر الهاتف المحمول قبل المباراة بـ 24/48 ساعة ، واعتمادًا على النادي أو الاتحاد المسؤول عن إصدارها ، قد يُطلب من عملائنا تنزيل تطبيق لاستلامها وتقديمها على بوابات الملعب. </p>
                                    </div>
                                </div>
                                <div class="pdf_ticket">
                                    <div class="pdf_ticket_img">
                                        <img src="../public/img/pdf_3.png">
                                    </div>
                                    <div class="pdf_tick_info">
                                        <h4>تذاكر ورقية</h4>
                                        <p>التذاكر الورقية - نحاول إرسال جميع التذاكر في غضون 3-5 أيام قبل الحدث ويتم إعلامك عبر البريد الإلكتروني عند إرسالها. بمجرد تلقي إشعار الإرسال، يمكنك توقع تسليمه في اليوم التالي إلى المملكة المتحدة</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <!--    <div class="col-md-6">
                            <div class="sub_united_tickets1">
                                <div class="serial_num_img">
                                <img src="../public/img/pdf_1.png">
                                </div>

                                <div class="serial_txt_info">
                                    <h4>PDF tickets</h4>
                                    <p>
                                    PDF tickets are usually sent out 24/48 hrs prior to the event date for our customers to print at home at their own convenience.</p>
                                </div>
                            </div>
                            <div class="sub_united_tickets2">
                                <div class="serial_num_img">
                                <img src="../public/img/pdf_2.png">
                                </div>

                                <div class="serial_txt_info">
                                    <h4>Mobile Tickets</h4>
                                    <p>Mobile Tickets are usually transferred 24/48 hrs before the match and, depending on the club or federation responsible to release them, our customers may be required to download an application in order to receive them and present them at the stadium gates.</p>
                                </div>
                            </div>
                            <div class="sub_united_tickets3">
                                <div class="serial_num_img">
                                <img src="../public/img/pdf_3.png">
                                </div>

                                <div class="serial_txt_info">
                                    <h4>Paper Tickets</h4>
                                    <p>Paper Tickets - we try to get all tickets dispatched within 3-5 days prior to the event and you are advised by email when they are sent. Once receiving notification of dispatch, you can expect them the following day for UK deliveries  </p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>







@endsection
@push('scripts')
 <script>
    $(document).ready(function(){

       jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "Letters, numbers only please");

        $("#track-order-details").validate({
         rules: {
        order_id: {
            alphanumeric: true,
            minlength: 8,
            maxlength: 8,
        }
    },
        messages: {

            order_id: {
                required: "{{__('messages.enter your order id')}}",
                minlength: 'Please Enter your 8 characters order number',
            },
            email: {
                required: "{{__('messages.enter your email address')}}"
            },
            surname : {
                required: "{{__('messages.enter surname')}}"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status){
                        $("#tracking_info").html(response.html);
                    }
                }            
            });
            return false;
        }
    });
    });
</script>
@endpush('scripts')