@extends('layouts.app')
@section('content')
<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> home</a></li>
                        <li>/</li>
                        <li>FAQ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<section class="faq-section section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading">
                    <h2>Frequently asked questions</h2>
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
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">What if I have not booked a hotel yet?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">I am not staying in a hotel or I am staying out of the event city location?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Can I buy tickets that are personalized with someone else's name on them?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Should I inform the hotel that I am expecting a delivery?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq--wrapper" id="freelancer">
                        <h3 class="main-title"><i class="fas fa-credit-card"></i>Season cards / Electronic cards</h3>
                        <div class="faq--area">
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">I have received cards and not paper tickets for my event</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">The cards I have received have different names on them?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">How do I find my seat location if I have received members season cards?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
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
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item open active">
                                <div class="faq-title">
                                    <h6 class="title">What happens if an event is postponed or cancelled?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
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
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Can you guarantee that we will sit together?</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                            <div class="faq--item">
                                <div class="faq-title">
                                    <h6 class="title">Why are tickets prices higher than their face value (Price printed on ticket)</h6>
                                    <span class="icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>A successful marketing plan relies heavily on the pulling-power of advertising copy. Writing result-oriented ad copy is difficult, as it must appeal to, entice, and convince consumers to take action. There is no magic formula to write perfect ad copy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection