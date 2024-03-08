 <div class="profile-sidebar">
                            <!-- SIDEBAR USERPIC -->
                            <!-- <div class="profile-userpic">
                                <img src="{{url('public/img/user.png')}}" class="img-responsive" alt="">
                            </div> -->
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    {{Session::get('first_name')}}<br>
                                    {{Session::get('email')}}
                                </div>
                          
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                       
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                               
                           
            <ul class="nav">
                    <li class="active">
                        <a href="{{url(app()->getLocale().'/dashboard')}}">
                      <i class="fas fa-chart-line"></i>
                      {{__('messages.dashboard')}} </a>
                    </li>
                    <li>
                        <a href="{{url(app()->getLocale().'/orders')}}">
                        <i class="fas fa-list"></i>
                        {{__('messages.my orders')}} </a>
                    </li>
                    <li>
                        <a href="{{url(app()->getLocale().'/address')}}">
                        <i class="fas fa-list"></i>
                        {{__('messages.my address')}} </a>
                    </li>

                    <li>
                        <a href="{{url(app()->getLocale().'/change-password')}}">
                        <i class="fas fa-lock"></i>
                        {{__('messages.change password')}} </a>
                    </li>
                    <li>
                        <a href="{{url(app()->getLocale().'/logout')}}">
                        <i class="fas fa-sign-out"></i>
                        {{__('messages.logout')}} </a>
                    </li>
                </ul>
                 </div>
                            <!-- END MENU -->
                        </div>