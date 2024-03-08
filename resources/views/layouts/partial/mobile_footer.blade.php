<!-- Footer Area Start -->
    <footer class="onebox-footer-area">
        <div class="foot-logo">
          <div class="container">
            <div class="foot_logo_area">
                <a href=""><img src="{{$data['logo']}}" alt="1boxoffice"></a>
            </div>
          </div>
        </div>
        @if(@$footer_disable ==  "")
        <div class="onebox-top-footer-area section_50">
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
                                               <li><a href="{{url(app()->getLocale().'/terms-and-conditions')}}">{{__('messages.terms & conditions')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/legal-privacy-policy')}}">{{__('messages.legal & privacy Policy')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/contact-us')}}">{{__('messages.contact us')}}</a></li>
                                                <li style="display: none"><a href="{{url(app()->getLocale().'/teams-list')}}">Team List</a></li>

                                                 <li style="display: none"><a href="{{url(app()->getLocale().'/all-match')}}">All Games</a></li>
                                                <li><a href="{{url(app()->getLocale().'/blog')}}">{{__('messages.blog')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/partnership')}}">{{__('messages.partnership')}}</a></li>
                                                <li><a href="{{url(app()->getLocale().'/sell-your-tickets')}}">{{__('messages.sell tickets')}}</a></li>
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
                                Copyright &copy; {{date('Y')}} <a href="#">1BOXOFFICE</a>
                                - All rights reserved 
                            </p>
                            <p class="mobile">
                                Copyright &copy; {{date('Y')}}  <a href="#">1BOXOFFICE</a>
                            </p>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div> @endif
    </footer>
    <!-- Footer Area End -->

      <!--  <div class="icon-bar">
                     <a target="blank" href="https://api.whatsapp.com/send?phone=447498070285" class="whatsapp"><i class="fab fa-whatsapp"></i></a> 
                    </div>