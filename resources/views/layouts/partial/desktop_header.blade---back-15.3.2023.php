@php $contact_phone =  str_replace(' ', '', $data['contact_phone']);
 $contact_phone  = ltrim($contact_phone,'+');
@endphp
<!-- Header Area Start -->
    <section class="onebox-header-area">
        <div class="header-top-area">
            <!-- <div class="header-top-overlay"></div> -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="header-top-left">
                            <div class="trust-pilot">
                <!--   <a class="ob_trust" href="https://www.trustpilot.com/review/www.1boxoffice.com" target="_blank"> -->
                        <img src="{{asset('/')}}/public/img/trustpilot1.png" alt="trustpilot"><!-- </a> -->
                </div>
                <div class="trust-pilot">
                  <!--<a title="1BoxOffice WhatsApp" href="https://api.whatsapp.com/send?phone={{$contact_phone}}" target="blank_"><i class="fas fa-phone-alt"></i>{{$data['contact_phone']}}</a> -->
                </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="header-top-right">
                            
                            <div class="dropdown">
                                 <button class="btn-dropdown dropdown-toggle" type="button" id="">
                                    @if($data['language'])
                                        @foreach($data['language'] as $list)
                                            @if($list['language_code'] != App::getLocale() )
                                                <a class="nav-link"
                                                    href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'], url()->full())}}">
                                                <li><img alt="" src="{{$list['language_flag']}}">{{__('messages.'.strtolower($list['language_name']))}} </li>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                    
                                </button>
                               <!--  <button class="btn-dropdown dropdown-toggle" type="button" id="dropdownlang" data-toggle="dropdown" aria-haspopup="true">
                                    @if($data['language'])
                                        @foreach($data['language'] as $list)
                                            @if($list['language_code'] != App::getLocale() )
                                                <a class="nav-link"
                                                    href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'],Request::url())}}">
                                                <li><img alt="" src="{{$list['language_flag']}}">{{$list['language_name']}} <i class="fas fa-caret-down"></i></li>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                    
                                </button> -->
                               <!--  <ul class="dropdown-menu language" aria-labelledby="dropdownlang">
                                    @if($data['language'])
                                        @foreach($data['language'] as $list)
                                            <a class="nav-link"
                                                    href="{{str_replace('/'.app()->getLocale(),'/'.$list['language_code'],Request::url())}}">
                                            <li><img alt="" src="{{$list['language_flag']}}">{{$list['language_name']}}</li>
                                        </a>
                                        @endforeach
                                    @endif
                                </ul> -->
                            </div>

                            <div class="dropdown">
                                <button class="btn-dropdown dropdown-toggle" type="button" id="dropdowncur" data-toggle="dropdown" aria-haspopup="true">
                                 @if($data)
                                        @foreach($data['currency'] as $list) 
                                        @if(@$currency == $list['currency_code'])
                                             <b>{{$list['symbol']}} </b>{{$list['currency_code']}}
                                            @endif
                                        @endforeach
                                    @endif
                                    <i class="fas fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu currency" aria-labelledby="dropdowncur">
                                    @if($data)
                                        @foreach($data['currency'] as $list) 
                                            <li data-code="{{$list['currency_code']}}"> <b>{{$list['symbol']}} </b>{{$list['currency_code']}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            
                            <!-- <a href="#">
                                <i class="fa fa-sign-in"></i>
                                login
                            </a>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                register
                            </a> -->
                            <!-- <a href=""><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button></a> -->
                             @if(Session::get('cart_quantity'))
                            <a href="{{ url(app()->getLocale().'/checkout')}}" class="header-cart">
                                <i class="fa fa-shopping-cart"></i>
                                {{__('messages.cart')}} <span>{{Session::get('cart_quantity')}}</span>
                            </a>
                            @endif
                            <a href="{{ url(app()->getLocale().'/partnership')}}" class="header-partnership">
                            {{__('messages.partnership')}}
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mainmenu-area">
            <div class="container">
                <div class="onebox-desktop-menu">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="onebox-site-logo">
                                <div class="responsive-menu-2"></div>
                                <div class="logo_area">

                                    <a href="{{url(app()->getLocale())}}" class="onebox-site-logo">
                                        <img src="{{$data['logo']}}" alt="" />
                                    </a>
                                </div>
                                <!-- <div class="responsive-menu-1"></div> -->
                            </div>
                            <div class="mainmenu-left">
                                <nav>
                                    <ul id="navigation_menu">
                                        <!-- <li class="current-page-item">
                                            <a href="#">Home</a>
                                        </li> -->
                                        <li>

                                            <div class="dropdown">
                                                  <button class="dropbtn"><a href="{{url(app()->getLocale().'/tournament-tickets')}}">{{__('messages.tournaments')}} <i class="fa fa-caret-down"></i></a></button>
                                                   <div class="dropdown-content" >
                                                    <ul>
                                                        <li class="nav-item tournaments_menu">
                                                    <a class=""  href="{{ url(App::getLocale().'/tournament-tickets')}}">{{__('messages.view all')}}</a>
                                                </li></ul>
                                                </div>
                                            </div>


                                            
                                        </li>
                                        <li>

                                             <div class="dropdown">
                                                  <button class="dropbtn"><a href="{{url(app()->getLocale().'/top-teams-tickets')}}">{{__('messages.top teams')}} <i class="fa fa-caret-down"></i></a></button>
                                                   <div class="dropdown-content" >
                                                   
                                                    <a  class="nav-item team_menu" href="{{ url(App::getLocale().'/top-teams-tickets')}}">{{__('messages.view all')}}</a>
                                                </div>
                                            </div>
                                           <!--  <a href="{{url(app()->getLocale().'/top-teams-tickets')}}">{{__('messages.top teams')}}</a> -->
                                        </li>
                                        <li>
                                            <a href="{{url(app()->getLocale().'/other-events-tickets')}}">{{__('messages.other events')}}</a>
                                        </li>
                                         @if(@$homepage == "homepage")
                                             <li class="">
                                                <a href="{{url(app()->getLocale().'/advance-search')}}">{{__('messages.search by destination')}}</a>
                                            </li>
                                      
                                            @else
                                            <li class="dropp">
                                                <div class="show_drop">
                                                    <form autocomplete="off" action="{{url(app()->getLocale().'/advance-search')}}"method="get">
                                                        <div class="search-form-group search-result-filter-top">
                                                            <input type="search" name="keywords" id="all_page_events" value="" placeholder="{{__('messages.search bar placeholder')}}">
                                                            <button type="submit" class="search-button">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                       <div class="all-search-page"></div>
                                                    </form>
                                                </div>
                                            </li>
                                             
                                            @endif
                                        <!-- <li>
                                            <a href="{{url(app()->getLocale().'/advance-search')}}">{{__('messages.search by destination')}}</a>
                                        </li> -->
                                       
                                        @if(Session::get('user_token') =="")
                                       
                                         <li>
                                            <a href="{{url(app()->getLocale().'/faq')}}">{{__('messages.faq/help')}}</a>
                                        </li>
                                      
                                        <li>
                                            <a href="#" id="loginModal" data-toggle="modal" data-target="#onebox-login-modal" >{{__('messages.login')}}</a>
                                        </li>
                                        <!-- <li>
                                            <a href="#"  data-toggle="modal" data-target="#onebox-register-modal">{{__('messages.sign up')}}</a>
                                        </li> -->
                                        @else
                                        <li>
                                            <a href="{{url(app()->getLocale().'/profile')}}">{{__('messages.dashboard')}}</a>
                                        </li>
                                        <li class="log_orders">
                                            <a href="{{url(app()->getLocale().'/orders')}}">{{__('messages.orders')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{url(app()->getLocale().'/logout')}}">{{__('messages.logout')}}</a>
                                        </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header Area End -->