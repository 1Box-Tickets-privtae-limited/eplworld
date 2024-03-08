@extends('layouts.app')
@section('content')
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area breadcromb-bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"> home</a></li>
                        <li>>></li>
                        <li>FAQ</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1>Faq’s/Help</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->
@if(Session::get('locale') == "en")
<section class="faq-section section_50">
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h1>Frequently asked questions</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sticky-menu">
                    <div class="faq-menu">
                        <ul id="faq-menu">
                            <li class="nav-item">
                                <a class="nav-link active" href="#company"><i class="fas fa-ticket"></i> Booking and Delivery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#freelancer"><i class="fas fa-credit-card"></i>Season cards / Electronic cards</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account"><i class="fas fa-exchange"></i>Refunds, exchanges, cancelations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pricing"><i class="fas fa-tag"></i>Ticket seating and pricing</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="mt-70 mt-lg-0">
                    <div class="faq--wrapper" id="company">
                        <h3 class="main-title"><i class="fas fa-ticket"></i> Booking and Delivery</h3>
                        <div class="faq--area">
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">I have just purchased a ticket online, what am I supposed to receive and what will happen next?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>In the next few minutes you will receive an automated e-mail message which means that we have received your order details and it is confirmed. Prior to the event date you will receive another e-mail with all of the details we need to insure the delivery of your tickets. Once the delivery details have been confirmed we will start to deliver your tickets accordingly. Every order is processed right away. Should you have any questions or enquiries, before or after ordering, we would be more than happy to speak with you.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Do you only deliver tickets to hotels or can I give you my residential address?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Depending on what kind of ticket you have purchased we can deliver to any type of address. However if you have purchased tickets that will be in the form or an “Electronic card” then we will only deliver to a hotel address in the event city, as we will need to collect the “electronic cards” back from you after the game. Alternatively we can arrange a meeting / collection point at the venue on the day of the gam</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">What if I have not booked a hotel yet?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>If you do not have the hotel details yet, you can still place your order and submit the hotel details at a later stage. In order to ensure delivery this must be done 3 working days prior to the event date. If done after this date we may arrange a venue pick up for your tickets. Our customer service team will stay in touch with you and to ensure safe delivery of your tickets.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">How do I get my tickets?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>We usually deliver your tickets to your Hotel delivery address, the evening before the event date. The delivery is made by local courier services or by our delivery agents by hand. Please make sure the delivery information provided is correct as we will not be responsible for incorrect addresses.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Should I inform the hotel that I am expecting a delivery?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Yes, you should always inform the hotel reception or concierge desk that you are expecting a delivery. Some hotels refuse to accept deliveries for unknown guest names, so you need to make sure the name you have provided us is the same to which you have used to reserve your hotel room.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">I am not staying in a hotel or I am staying out of the event city location?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>In some cases we will set a central pick-up spot, for customers who have no hotel reservations or their hotel is located outside of the event city. You will receive the full pick-up details by e-mail, if we have to arrange a venue pick up for your tickets. When we say"pick up at the venue or venue collection", you still need to get the full instructions from us as to the exact location and time which we will communicated to you by email and over the phone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq--wrapper" id="freelancer">
                        <h3 class="main-title"><i class="fas fa-credit-card"></i>Season cards / Electronic cards</h3>
                        <div class="faq--area">
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">I have received cards and not paper tickets for my event?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>You have received member season cards or electronic cards, which you will have to use to scan at the gate of the stadium to gain entrance. Prior to receiving the electronic card (member’s season card) a member of our staff would have contacted you making you aware of the use and the safe return for the electronic cards. If you require additional help please contact the 1Boxoffice team.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">The cards I have received have different names on them?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>The names that are on the cards are of those of the original owner of the member’s season card. As some events are strictly members only we have provided you with membership cards of members that have decided not to attend. These cards do not belong to you and you will have to return back the cards after the game. Full instructions will be provided in you in the delivery envelope and sent by email for your review prior to delivery.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">How do I find my seat location if I have received members season cards?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Each card should have printed details of your seat location. If there is nothing printed on the cards then on a separate sheet of paper, which will be included in your delivery envelope will have the seat location for each of the cards received. If you require additional help please contact the 1Boxoffice team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq--wrapper" id="account">
                        <h3 class="main-title"><i class="fas fa-exchange"></i>Refunds, exchanges, cancelations</h3>
                        <div class="faq--area">
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Can I cancel or exchange my tickets, for any reason, after I have placed an order?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>As per our terms and conditions, we do not offer any refund or exchanges for any reason. You should make sure prior to booking your event tickets that you are able to attend.</p>
                                </div>
                            </div>
                            <div class="faq--item open active">
                                <div class="faq-title">
                                    <h6 class="title">What happens if an event is postponed or cancelled?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>On rare occasions, an event is postponed or cancelled. Although it is not in our hands, we will try to inform you promptly. However it is your responsibility to check with the event venue or local media to ensure that you arrive at the correct time and on the correct date. If an event is rescheduled, tickets will often be valid for the new date and you will not in any circumstances be entitled to a refund for a re-scheduled event. In case the event is cancelled altogether – we'll request a refund from the event's organizers. Excluding football matches which cannot be refunded in all cases. If the organizers of the event do offer a refund in the event of a cancellation, to be entitled to a refund you must send to us (via a secure and traceable courier service) the original tickets purchased via the Website and within the time frame communicated to you by us. In that case, only the original face value of the ticket will be refunded as services of obtaining the tickets by 1Boxoffice Services would have been fully filled.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq--wrapper" id="pricing">
                        <h3 class="main-title"><i class="fas fa-tag"></i>Ticket seating and pricing</h3>
                        <div class="faq--area">
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Where exactly will I sit?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>The ticket categories we can offer are specified in each event page. You should use our seating map to help guide you of the area your tickets will be located in. We give as much information as we have. We will always supply the best available tickets, but cannot give any specific indication or guarantee about the exact seat location. Please remember that most of the events we sell tickets to are sold-out or are member only events.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Can you guarantee that we will sit together?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>If not written differently, we are committed to seat you at least in pairs. If there is a listing for more than 2 seats and it says seated together than your tickets will be together. If the ticket option has nothing mentioned and you are three or more, we will do our best to seat you together, but we do not guarantee it unless written on the ticket option you have purchased. If you MUST sit together, kindly check availability with our customer service team, by phone or email. In most cases we will be able to confirm a specific request but prices may differ to that on the website. Please note that in some stadiums (most notably Barcelona's "Camp Nou") seating together includes diagonal or perpendicular adjoined seats.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Why are tickets prices higher than their face value (Price printed on ticket)?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>1Boxoffice Services operates within the secondary market in which the availability of the tickets and their pricing are determined and differs by market's supply and demand. Therefore, in high profile or sold out events it is expected that the selling price of the tickets will be much higher than their face value (Original price). In addition, Please note that in most cases we purchase the tickets at a price much higher than their face value while adding just a modest handling fee to reflect the various costs we have in order to process your order, among which: maintaining and updating our multilingual website, keeping a network of representatives and suppliers, purchasing season tickets,not to mention providing unsurpassed customer service. We do our best to keep our prices competitive while offering you a wide range of tickets accompanied by an excellent customer service.</p>
                                </div>
                            </div>

                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Can I buy tickets that are personalized with someone else's name on them?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Yes, 1BoxOffice allows third party sellers, including individuals, to sell tickets on its platform. In some instances the original purchaser's name may be printed on your tickets. The tickets are valid. Your name does not need to match the name printed on the ticket to gain entry to the event.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-4">
                <div class="tabs_faq">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#booking" data-toggle="tab"><i class="fas fa-ticket"></i> Booking and Delivery</a></li>
                        <li><a href="#season" data-toggle="tab"><i class="fas fa-credit-card"></i> Season cards / Electronic cards</a></li>
                        <li><a href="#refunds" data-toggle="tab"><i class="fas fa-exchange"></i> Refunds, exchanges, cancelations</a></li>
                        <li><a href="#ticket" data-toggle="tab"><i class="fas fa-tag"></i> Ticket seating and pricing</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Tab panes -->
                <div class="tabs_faq_content">
                    <div class="tab-content">
                        <div class="tab-pane active" id="booking">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item open active">
                                        <div class="faq-title">
                                            <h6 class="title">I have just purchased a ticket online, what am I supposed to receive and what will happen next?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>In the next few minutes you will receive an automated e-mail message which means that we have received your order details and it is confirmed. Prior to the event date you will receive another e-mail with all of the details we need to insure the delivery of your tickets. Once the delivery details have been confirmed we will start to deliver your tickets accordingly. Every order is processed right away. Should you have any questions or enquiries, before or after ordering, we would be more than happy to speak with you.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Do you only deliver tickets to hotels or can I give you my residential address?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>Depending on what kind of ticket you have purchased we can deliver to any type of address. However if you have purchased tickets that will be in the form or an “Electronic card” then we will only deliver to a hotel address in the event city, as we will need to collect the “electronic cards” back from you after the game. Alternatively we can arrange a meeting / collection point at the venue on the day of the gam</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">What if I have not booked a hotel yet?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>If you do not have the hotel details yet, you can still place your order and submit the hotel details at a later stage. In order to ensure delivery this must be done 3 working days prior to the event date. If done after this date we may arrange a venue pick up for your tickets. Our customer service team will stay in touch with you and to ensure safe delivery of your tickets.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">How do I get my tickets?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>We usually deliver your tickets to your Hotel delivery address, the evening before the event date. The delivery is made by local courier services or by our delivery agents by hand. Please make sure the delivery information provided is correct as we will not be responsible for incorrect addresses.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Should I inform the hotel that I am expecting a delivery?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>Yes, you should always inform the hotel reception or concierge desk that you are expecting a delivery. Some hotels refuse to accept deliveries for unknown guest names, so you need to make sure the name you have provided us is the same to which you have used to reserve your hotel room.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">I am not staying in a hotel or I am staying out of the event city location?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>In some cases we will set a central pick-up spot, for customers who have no hotel reservations or their hotel is located outside of the event city. You will receive the full pick-up details by e-mail, if we have to arrange a venue pick up for your tickets. When we say"pick up at the venue or venue collection", you still need to get the full instructions from us as to the exact location and time which we will communicated to you by email and over the phone.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="season">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">I have received cards and not paper tickets for my event?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>You have received member season cards or electronic cards, which you will have to use to scan at the gate of the stadium to gain entrance. Prior to receiving the electronic card (member’s season card) a member of our staff would have contacted you making you aware of the use and the safe return for the electronic cards. If you require additional help please contact the 1Boxoffice team.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">The cards I have received have different names on them?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>The names that are on the cards are of those of the original owner of the member’s season card. As some events are strictly members only we have provided you with membership cards of members that have decided not to attend. These cards do not belong to you and you will have to return back the cards after the game. Full instructions will be provided in you in the delivery envelope and sent by email for your review prior to delivery.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">How do I find my seat location if I have received members season cards?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>Each card should have printed details of your seat location. If there is nothing printed on the cards then on a separate sheet of paper, which will be included in your delivery envelope will have the seat location for each of the cards received. If you require additional help please contact the 1Boxoffice team.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="refunds">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Can I cancel or exchange my tickets, for any reason, after I have placed an order?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>As per our terms and conditions, we do not offer any refund or exchanges for any reason. You should make sure prior to booking your event tickets that you are able to attend.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item ">
                                        <div class="faq-title">
                                            <h6 class="title">What happens if an event is postponed or cancelled?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>On rare occasions, an event is postponed or cancelled. Although it is not in our hands, we will try to inform you promptly. However it is your responsibility to check with the event venue or local media to ensure that you arrive at the correct time and on the correct date. If an event is rescheduled, tickets will often be valid for the new date and you will not in any circumstances be entitled to a refund for a re-scheduled event. In case the event is cancelled altogether – we'll request a refund from the event's organizers. Excluding football matches which cannot be refunded in all cases. If the organizers of the event do offer a refund in the event of a cancellation, to be entitled to a refund you must send to us (via a secure and traceable courier service) the original tickets purchased via the Website and within the time frame communicated to you by us. In that case, only the original face value of the ticket will be refunded as services of obtaining the tickets by 1Boxoffice Services would have been fully filled.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="ticket">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Where exactly will I sit?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>The ticket categories we can offer are specified in each event page. You should use our seating map to help guide you of the area your tickets will be located in. We give as much information as we have. We will always supply the best available tickets, but cannot give any specific indication or guarantee about the exact seat location. Please remember that most of the events we sell tickets to are sold-out or are member only events.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Can you guarantee that we will sit together?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>If not written differently, we are committed to seat you at least in pairs. If there is a listing for more than 2 seats and it says seated together than your tickets will be together. If the ticket option has nothing mentioned and you are three or more, we will do our best to seat you together, but we do not guarantee it unless written on the ticket option you have purchased. If you MUST sit together, kindly check availability with our customer service team, by phone or email. In most cases we will be able to confirm a specific request but prices may differ to that on the website. Please note that in some stadiums (most notably Barcelona's "Camp Nou") seating together includes diagonal or perpendicular adjoined seats.</p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Why are tickets prices higher than their face value (Price printed on ticket)?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>1Boxoffice Services operates within the secondary market in which the availability of the tickets and their pricing are determined and differs by market's supply and demand. Therefore, in high profile or sold out events it is expected that the selling price of the tickets will be much higher than their face value (Original price). In addition, Please note that in most cases we purchase the tickets at a price much higher than their face value while adding just a modest handling fee to reflect the various costs we have in order to process your order, among which: maintaining and updating our multilingual website, keeping a network of representatives and suppliers, purchasing season tickets,not to mention providing unsurpassed customer service. We do our best to keep our prices competitive while offering you a wide range of tickets accompanied by an excellent customer service.</p>
                                        </div>
                                    </div>

                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Can I buy tickets that are personalized with someone else's name on them?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>Yes, 1BoxOffice allows third party sellers, including individuals, to sell tickets on its platform. In some instances the original purchaser's name may be printed on your tickets. The tickets are valid. Your name does not need to match the name printed on the ticket to gain entry to the event.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(Session::get('locale') == "ar")

<section class="faq-section section_50">
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2>أسئلة مكررة</h2>
                </div>
            </div> -->

            <div class="col-md-4">
                <div class="tabs_faq">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#booking" data-toggle="tab"><i class="fas fa-ticket"></i> لحجز والتسليم  </a></li>
                        <li><a href="#season" data-toggle="tab"><i class="fas fa-credit-card"></i> ياسة اإللغاء, التبديل وإسترداد المبلغ. </a></li>
                        <li><a href="#refunds" data-toggle="tab"><i class="fas fa-exchange"></i> ألسعار ورقم المقعد المدون على التذكرة  </a></li>
                        <li><a href="#ticket" data-toggle="tab"><i class="fas fa-tag"></i> ألسعار ورقم المقعد المدون على التذكرة </a></li>
                    </ul>
                </div>
            </div>

            <!-- <div class="col-md-4">
                <div class="sticky-menu">
                    <div class="faq-menu">
                        <ul id="faq-menu">
                            <li class="nav-item">
                                <a class="nav-link active" href="#company"><i class="fas fa-ticket"></i> الحجز والتسليم  </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#freelancer"><i class="fas fa-credit-card"></i>سياسة اإللغاء, التبديل وإسترداد المبلغ. </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account"><i class="fas fa-exchange"></i>األسعار ورقم المقعد المدون على التذكرة  </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pricing"><i class="fas fa-tag"></i>األسعار ورقم المقعد المدون على التذكرة  </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <div class="col-md-8">
                <!-- Tab panes -->
                <div class="tabs_faq_content">
                    <div class="tab-content">
                        <div class="tab-pane active" id="booking">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item open active">
                                        <div class="faq-title">
                                            <h6 class="title">س. لقد اشتريت تذكرة من خالل موقع االنترنت، ما الذي يفترض أن أستلم وما هي الخطوات التالية ؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>ج. ما أن يتم شراء التذاكر من الموقع اإللكتروني حتى تصلك رسالة على بريدك اإللكتروني تأكد أيضاً أننا قد تلقينا تفاصيل طلبك وجاري التحقق من الطلب. إضافة على ذلك سوف تتلقى رسالة اخرى على بريدك اإللكتروني قبل موعد الحدث وذلك للتأكد من صحة تفاصيل وعنوان التوصيل لكي نتمكن من ضمان تسليم التذاكر الخاصة بك . ما أن تأكد لنا تفاصيل وعنوان التسليم حتى تبدأ مرحلة
                                            توصيل التذاكر الخاصة بك وفقا لذلك . يتم معالجة كل طلب على الفور . إذا كان لديك أي أسئلة أو استفسارات قبل أو بعد إصدار الطلب,
                                            تسعدنا مساعدتك ويشرفنا التحدث والتواصل معك.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. هل يتم توصيل التذاكر إلى عنوان الفندق فقط ؟ أو يمكنكم توصيلها  إلى عنوان الشقة السكنية؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>ج. تعتمد عملية التوصيل / التسليم على حسب نوع التذاكر التي قمت بشرائها, مثال: إذا كنت قد اشتريت تذاكر وقد تبين أنها " بطاقة إلكترونية " (غير ورقية) في هذه الحالة يتم توصيل التذاكر إلى عنوان الفندق فقط في مدينة الحدث، ألننا نحتاج إلستعادة البطاقة
                                            اإللكترونية منك بعد المباراة . بدال من ذلك يمكننا أن نحدد نقطة إلتقاء عند الملعب لنسلمك التذاكر وذلك في نفس يوم المباراة.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. ماذا لو أنني لم أحجز الفندق بعد ؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>ج.  إذا لم تقوم بحجز الفندق بعد أو أنك ال تملك تفاصيل الفندق الكاملة أو أنك غير واثق العنوان, في هذه الحالة يمكنك تزويدنا بعنوان
                                            الفندق في وقت الحق, بمدة أقصاها ثالثة أيام عمل قبل تاريخ الحدث, وذلك لكي نضمن ونتمكن من توصيل التذاكر الخاصة بك . وفي حال أنك قمت بتوفيرنا بعنوان الفندق بعد ذلك, فإننا سنقوم بترتيب مكان أو نقطة إلتقاء مع مندوبنا وذلك ليسلمك التذاكر الخاصة بك .كما
                                            سيقوم فريق خدمة العمالء بالتواصل معك لضمان عملية إستالم التذاكر.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. كيف يمكنني الحصول على التذاكر الخاصة بي؟   </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>ج. نقوم عادة بتسليم التذاكر إلى عنوان الفندق الذي توفره لنا, وذلك قبل ليلة من تاريخ الحدث, تتم مرحلة تسليم التذاكر إما من خالل البريد المحلي السريع أو من خالل التسليم باليد عبر مندوبنا, يرجى التأكد من أن معلومات التوصيل التي قمت بتوفيرها لنا صحيحة كما
                                            أننا غير مسؤولين عن أي عناوين غير صحيحة.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س.  .هل يجب إعالم الفندق مسبقاً أنني أتوقع إستالم بريد ؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. نعم، يتوجب عليك دائما إبالغ مكتب اإلستقبال / مكتب خدمة العمالء في الفندق بأنك تتوقع إستالم بريد, كما أن بعض الفنادق قد ترفض قبول أو إستالم أي طرد بإسم شخص غير وارد على قائمتها, أو ألسماء ضيوف غير معروفة، لذلك عليك التأكد من أن اإلسم
                                            الذي قمت بتوفيره لنا مطابق لإلسم الذي إستعملته لحجز الفندق.

                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. أنا ال أقيم في أحد الفنادق أو أنني مقيم في بلدة خارج نطاق مدينة الحدث.  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. في بعض الحاالت التي يقطن فيها العميل في شقق سكنية أو في فندق خارج نطاق مدينة الحدث, عندئذ يتم تحديد نقطة إلتقاء معينة بين العميل ومندوبنا وذلك لتسليم التذاكر باليد, سوف تتلقى التفاصيل كاملة عن طريق البريد اإللكتروني، وفي حال أننا سنقوم بتسليم التذاكر الخاصة بك عند مكان الحدث, يتوجب عليك الحصول على التعليمات الكاملة من قبلنا والتي تحدد مكان وموقع تسليم التذاكر
                                            باإلضافة الى الوقت. كل هذه التعليمات سيتم التواصل معك بها عبر البريد اإللكتروني ومن خالل اإلتصال بك عبر الهاتف.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="season">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. لقد تلقيت بطاقة / بطاقات وليس تذاكر ورقية للحدث الذي قمت بحجزه  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. لقد إستلمت بطاقات موسمية / بطاقة عضوية أو ما يسمى ببطاقات إلكترونية، تستخدم هذه البطاقة / البطاقات عند بوابة الملعب للكشف والحصول على إذن الدخول الى مكان الحدث. سيقوم أحد موظفينا بالتواصل معك وإبالغك بكيفية إستخدام وإسترجاع البطاقة وذلك قبل موعد إستالمها. إذا كنت بحاجة إلى مساعدة إضافية أو لديك أي إستفسار ، يرجى االتصال بمكتب خدمة العمالء بشركة
                                            1بوكس أوفس.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. البطاقات التي تلقيتها تحتوي على أسماء مختلفة؟</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. تنتمي األسماء الموجودة على البطاقات الموسمية / البطاقات اإللكترونية للمالك األصلي للبطاقة الموسمية / العضوية . حيث أن بعض األحداث تتطلب بشكل خاص البطاقة العضوية / الموسمية فقط للدخول إلي الملعب, وبالتالي فقد قمنا بتزويدكم ببطاقة عضوية تنتمي
                                            لعضو في النادي حيث قرر عدم الحضور لمشاهدة المباراة. إن هذه البطاقات ال تنتمي لك، وبالتالي يتوجب عليك إعادتها بعد المباراة . سيتم توفيرك باإلرشادات الكاملة عن كيفية إستخدام وإسترجاع البطاقة الموسمية وذلك في الظرف عند إستالم التذاكر وعن طريق البريد
                                            اإللكتروني قبل موعد إستالم التذاكر.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. كيف يمكنني العثور على موقع المقعد في حال أنني إستلمت بطاقة موسمية / إلكترونية ؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. تحتوي كل البطاقات على تفاصيل موقع ورقم مقعدك . في حال أنك إستلمت بطاقة / تذاكر ال تحتوي على معلومات موقع ورقم المقعد, فستكون التفاصيل مرفقة بورقة منفصلة مع البطاقة في نفس المغلف عند إستالم التذاكر, والتي تحتوي على موقع المقعد لكل من
                                            البطاقات التي إستلمتها . إذا كنت بحاجة إلى مساعدة إضافية، يرجى االتصال بفريق خدمة العمالء في شركة 1بوكس أوفس.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="refunds">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. هل يمكنني إلغاء أو إستبدال التذاكر الخاصة بي، ألي سبب من األسباب، بعد عملية شراء التذاكر؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. وفقا لشروط وأحكام شركة 1بوكس أوفس، ال يتم إسترجاع الرسوم أو تبديلها ألي سبب كان. كما يتوجب عليك التحقق من وقتك
                                            وموعد السفر قبل حجز تذاكر الحدث والتأكد بأنك قادر على الحضور.

                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item ">
                                        <div class="faq-title">
                                            <h6 class="title">س. ماذا يحدث في حال تم تأجيل الحدث أو إلغاؤه؟</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. في بعض الحاالت النادرة يتم تأجيل الحدث أو إلغاؤه . وبما أن هذا الموضوع يعتبر خارج نطاق قدراتنا وال يمكننا أن نفعل شيء إال

                                            سنحاول أن نبلغكم فوراً . ومع ذلك فإنه من مسؤوليتك التامة أن تتحقق مع مكان الحدث ووسائل اإلعالم المحلية لضمان وصولك في

                                            أننا

                                            الوقت المناسب والتاريخ الصحيح . في حال أنه تم تأجيل وتحديد موعد جديد للمباراة, فإنه غالباً ما تكون التذاكر صالحة اإلستعمال
                                            للتاريخ الجديد الذي تم تعيينه من قبل منظمي الحدث / النادي, وبالتالي ال يحق لك إسترداد أي مبلغ ألي حدث تم تأجيله ألي سبب كان. في حالة أنه تم إلغاء الحدث تماما - سنقوم بتقديم طلب استرداد من منظمي الحدث . هذا بإستثناء المباريات التي ال يمكن إسترداد أي مبلغ منها في جميع الحاالت .إذا قام منظمو الحدث بإلغاء المباراة / الحدث وإقترحوا إسترجاع قيمة التذاكر, في هذه الحالة ولكي يكون لك

                                            )التذاكر األصلية التي تم شراؤها عن القيمة االسمية / األصلية للتذكرة كخدمة

                                            الحق في إسترجاع قيمة التذكرة يتعين عليك أن ترسل لنا عن طريق خدمة آمنة للبريد السريع طريق الموقع وضمن اإلطار الزمني الذي تم التواصل فيه بينك وبيننا. وبالتالي سيتم إسترجاع
                                            لشرائك التذاكر عن طريق شركة 1بوكس أوفس. وبهذا تكون الشركة قد أتمت مهمتها بالكامل.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="ticket">
                            <div class="faq--wrapper">
                                <div class="faq--area">
                                    <div class="faq--item">
                                        <div class="faq-title">
                                             <h6 class="title">س.أين يتواجد مكان المقعد الخاص بي؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>
                                            ج. يتم تعيين فئات التذاكر التي نوفرها بنا ًء على نوع الحدث . كما يتوجب عليك إستخدام خريطة كل حدث لكي تتمكن من تحديد المنطقة التي سوف تكون متواجداً فيها. نسعى دائماً لتقديم معلومات كاملة. كما أننا بذل كل ما بوسعنا لتوفير أفضل التذاكر في أفضل الفئات
                                            المتاحة، وبالتالي ال يمكننا أن نعطي أي مؤشرات أو ضمانات بشأن مكان أو تحديد رقم مقعد معين. يرجى مالحظة والتذكير بأن معظم
                                            األحداث التي يتم بيعها من خاللنا هي لتذاكر أحداث تم بيعها أو تذاكر للألعضاء فقط.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. هل يمكن ضمان وتأكيد على أن المقاعد سوف تكون جنباً إلى جنب؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>ج. نلتزم بتوفير مقاعد مزدوجة لكل الحجوزات التي تتألف من شخصين. ولحجوزات التذاكر التي تتكون من ثالثة أشخاص وما فوق
                                            فسيتم عرض مالحظة في خانة التذاكر تفيد بأن المقاعد ستكون كلها بالقرب من بعضها. في حال أن إختيارك للتذاكر يتألف من ثالثة أفراد أو أكثر, ولم يتم تعيين أو تحديد أي مالحظة في خانة التذاكر المطلوبة, بالتالي سوف نبذل قصارى جهدنا بتوفيرك بمقاعد جنب بعضها أو بالقرب من بعضها, لكن وفي نفس الوقت ال يمكننا تأكيد أو توفير أي ضمانة على
                                            </p>
                                            <p>ذلك. يرجى مراجعة فريق خدمة العمالء لدينا للتأكد من إمكانية الحصول على تذاكر بمقاعد مزدوجة أو أكثر, وذلك إما من خالل اإلتصال بنا عبر الهاتف أو برسالة عبر البريد اإللكتروني, غالباً ما يتم تلبية الطلبات الخاصة بكم, ولكن وعلى حسب نوع الطلب قد تختلف األسعار المعلن عنها على الموقع من التي سوف يتم. يرجى مالحظة أنه في بعض المالعب (أبرزها ملعب كامب نو "برشلونة(" تتكون فيها
                                            المقاعد التي هي بجانب بعضها على شكل أفقي أو عمودي.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">س. لماذا تختلف التذاكر وأسعارها أعلى من قيمتها اإلسمية (المطبوعة على التذكرة) ؟  </h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>تعمل شركة 1بوكس أوفس على السوق الثانوي والذي من خالله يتم تحديد مدى توافر التذاكر وأسعارها، كما تختلف أسعار التذاكر  المعروضة بحسب السوق المحلي ومدى الطلب عليها, لذلك، من المتوقع أن سعر بيع التذاكر ستكون أعلى بكثير من قيمتها االسمية (السعر األصلي.) إضافة على ذلك، يرجى مالحظة أنه في معظم الحاالت نقوم بشراء تذاكر بسعر أعلى بكثير من قيمتها االسمية حيث يتم إضافة مجرد رسم متواضع وذلك لتغطية التكاليف المختلفة الموجودة لدينا من أجل متابعة طلبك، ومنها :تحديث وصيانة موقع متعدد
                                            اللغات، الحفاظ على شبكة من ممثلي وموردين األحداث، شراء تذاكر إلكترومية / موسمية، باإلضافة إلى خدمة عمالء مميزة. نقوم دائماً
                                            كل ما بوسعنا للحفاظ على أسعار منافسة في حين نقدم لك مجموعة واسعة من تذاكر األحداث مع خدمة العمالء الممتازة.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- <div class="faq--item">
                                        <div class="faq-title">
                                            <h6 class="title">Can I buy tickets that are personalized with someone else's name on them?</h6>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="faq-content">
                                            <p>Yes, 1BoxOffice allows third party sellers, including individuals, to sell tickets on its platform. In some instances the original purchaser's name may be printed on your tickets. The tickets are valid. Your name does not need to match the name printed on the ticket to gain entry to the event.</p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection