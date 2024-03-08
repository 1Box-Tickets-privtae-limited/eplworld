<!-- Footer Area Start -->
    <footer class="onebox-footer-area">
        <div class="foot-logo">
          <div class="container">
            <div class="foot_logo_area">
                <a href=""><img src="{{$data['logo']}}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="onebox-top-footer-area section_50 footer-desktop">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>{{__('messages.1boxoffice info')}}</h3>
                            <ul class="single-footer-link">
                              
                                 <!-- <li><a href="{{url(app()->getLocale().'/about-us')}}">{{__('messages.about us')}}</a></li> -->
                                <li><a href="https://www.1boxoffice.com/{{app()->getLocale()}}/terms-and-conditions" target="_blank" >{{__('messages.terms & conditions')}}</a></li>
                                <li><a href="https://www.1boxoffice.com/{{app()->getLocale()}}/legal-privacy-policy" target="_blank" >{{__('messages.legal & privacy Policy')}}</a></li>
                                <li><a href="https://www.1boxoffice.com/{{app()->getLocale()}}/contact-us" target="_blank" >{{__('messages.contact us')}}</a></li>
                               
                           
                            

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>{{__('messages.popular items')}}</h3>
                            <ul class="single-footer-link">
                                <li><a href="{{url(app()->getLocale().'/Arsenal-tickets')}}">{{__('messages.arsenal tickets')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/Manchester-City-tickets')}}">{{__('messages.manchester city tickets')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/Liverpool-tickets')}}">{{__('messages.liverpool tickets')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/Barcelona-tickets')}}">{{__('messages.barcelona tickets')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/Manchester-United-tickets')}}">{{__('messages.manchester united tickets')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/Real-madrid-tickets')}}">{{__('messages.real madrid tickets')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>{{__('messages.hot tickets')}}</h3>
                            <ul class="single-footer-link" id="hot_tickets">
                               <!--  <li><a href="{{url(app()->getLocale().'/premier-league-arsenal-vs-manchester-united-tickets')}}"> {{__('messages.arsenal vs manchester united')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/premier-league-liverpool-vs-tottenham-hotspur-tickets')}}"> {{__('messages.liverpool vs tottenham hotspur')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/premier-league-manchester-united-vs-chelsea-tickets-1624458784')}}"> {{__('messages.manchester united vs chelsea')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/champions-league-final-team-1-vs-team-2-tickets')}}"> {{__('messages.liverpool vs realmadrid')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/la-liga-barcelona-vs-cádiz-cf-tickets')}}"> {{__('messages.barcelona vs cádiz cf')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/la-liga-real-madrid-vs-levante-tickets')}}"> {{__('messages.real madrid vs rcd espanyol')}}</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-footer-widget">
                            <h3>{{__('messages.tournaments')}}</h3>
                            <ul class="single-footer-link">
                                <li><a href="{{url(app()->getLocale().'/Premier-League-tickets')}}">{{__('messages.premier league')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/Champions-League-tickets')}}">{{__('messages.champions league')}}</a></li>
                                <li><a href="{{url(app()->getLocale().'/La-Liga-tickets')}}">{{__('messages.la liga')}}</a></li>
                            </ul>
                            <ul class="single-footer-social">
                               <li>
                                    <a target="_blank" href="https://facebook.com/eplworld" class="fb"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/eplworld/?hl=en" class="inst"><i class="fab fa-instagram"></i></a>
                                </li>
                                <!-- <li>
                                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                   <a href="#" class="skype"><i class="fa fa-skype"></i></a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="onebox-top-footer-area section_50 footer-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">

                        <div class="single-footer-widget">
                            <div class="mt-70 mt-lg-0">
                              <div class="faq--wrapper">
                                  <div class="faq--area">

                                      <div class="faq--item">
                                          <div class="faq-title">
                                              <h6 class="title">{{__('messages.company info')}}</h6>
                                              <span class="icon"></span>
                                          </div>
                                          <div class="faq-content">
                                             <ul class="single-footer-link">
                                               <li><a href="https://www.1boxoffice.com/{{app()->getLocale()}}/terms-and-conditions" target="_blank" >{{__('messages.terms & conditions')}}</a></li>
                                                <li><a href="https://www.1boxoffice.com/{{app()->getLocale()}}/legal-privacy-policy" target="_blank" >{{__('messages.legal & privacy Policy')}}</a></li>
                                                <li><a href="https://www.1boxoffice.com/{{app()->getLocale()}}/contact-us" target="_blank" >{{__('messages.contact us')}}</a></li>
                                            </ul>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="single-footer-widget">

                            <div class="mt-70 mt-lg-0">
                              <div class="faq--wrapper">
                                  <div class="faq--area">

                                      <div class="faq--item">
                                          <div class="faq-title">
                                              <h6 class="title">{{__('messages.popular items')}}</h6>
                                              <span class="icon"></span>
                                          </div>
                                          <div class="faq-content">
                                             <ul class="single-footer-link">
                                               <li><a href="{{url(app()->getLocale().'/Arsenal-tickets')}}">{{__('messages.arsenal tickets')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/Manchester-City-tickets')}}">{{__('messages.manchester city tickets')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/Liverpool-tickets')}}">{{__('messages.liverpool tickets')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/Barcelona-tickets')}}">{{__('messages.barcelona tickets')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/Manchester-United-tickets')}}">{{__('messages.manchester united tickets')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/Real-madrid-tickets')}}">{{__('messages.real madrid tickets')}}</a></li>
                                            </ul>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="single-footer-widget">

                            <div class="mt-70 mt-lg-0">
                              <div class="faq--wrapper">
                                  <div class="faq--area">

                                      <div class="faq--item">
                                          <div class="faq-title">
                                              <h6 class="title">{{__('messages.hot tickets')}}</h6>
                                              <span class="icon"></span>
                                          </div>
                                          <div class="faq-content">
                                             <ul class="single-footer-link" id="hot_tickets">
                                               <!--  <li><a href="{{url(app()->getLocale().'/premier-league-arsenal-vs-manchester-united-tickets')}}"> {{__('messages.arsenal vs manchester united')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/premier-league-liverpool-vs-tottenham-hotspur-tickets')}}"> {{__('messages.liverpool vs tottenham hotspur')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/premier-league-manchester-united-vs-chelsea-tickets-1624458784')}}"> {{__('messages.manchester united vs chelsea')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/champions-league-final-team-1-vs-team-2-tickets')}}"> {{__('messages.liverpool vs realmadrid')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/la-liga-barcelona-vs-cádiz-cf-tickets')}}"> {{__('messages.barcelona vs cádiz cf')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/la-liga-real-madrid-vs-levante-tickets')}}"> {{__('messages.real madrid vs rcd espanyol')}}</a></li> -->
                                            </ul>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="single-footer-widget">

                            <div class="mt-70 mt-lg-0">
                              <div class="faq--wrapper">
                                  <div class="faq--area">

                                      <div class="faq--item">
                                          <div class="faq-title">
                                              <h6 class="title">{{__('messages.tournaments')}}</h6>
                                              <span class="icon"></span>
                                          </div>
                                          <div class="faq-content">
                                             <ul class="single-footer-link">
                                                <li><a href="{{url(app()->getLocale().'/Premier-League-tickets')}}">{{__('messages.premier league')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/Champions-League-tickets')}}">{{__('messages.champions league')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/La-Liga-tickets')}}">{{__('messages.la liga')}}</a></li>
                                            </ul>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                            </div>
                            <ul class="single-footer-social">
                                <li>
                                    <a href="https://www.facebook.com/1boxofficeservices/" class="fb"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/1boxoffice/" class="inst"><i class="fab fa-instagram"></i></a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="onebox-footer-bottom section_15">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p class="desktop">
                             &copy; {{date('Y')}}  <a href="https://www.1boxoffice.com/{{app()->getLocale()}}/" target="_blank">EPL World</a>
                                - {{__('messages.all rights reserved')}} 
                            </p>
                            <p class="mobile">
                            &copy; {{date('Y')}}  <a href="https://www.1boxoffice.com/{{app()->getLocale()}}/" target="_blank">EPL World</a>
                            </p>
                        </div>
                    </div>

                    <!-- <div class="icon-bar">
                    <a target="blank" href="https://api.whatsapp.com/send?phone=447498070285" class="whatsapp"><i class="fab fa-whatsapp"></i></a> 
                    </div> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End-->