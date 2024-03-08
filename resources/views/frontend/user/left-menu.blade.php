<div class="col-md-4">
            <div class="tabs_faq">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="{{@$active ==1  || @$active=='' ? 'active' : '' }}">
                        <a href="{{url(app()->getLocale().'/profile')}}" ><i class="fas fa-user"></i>{{__('messages.profile')}}</a>
                    </li>
                    <li class="{{@$active ==2  ? 'active' : '' }}">
                        <a href="{{url(app()->getLocale().'/orders')}}"><i class="fas fa-shopping-cart"></i>{{__('messages.my orders')}}</a>
                    </li>
                    <li class="{{@$active ==3  ? 'active' : '' }}">
                        <a href="{{url(app()->getLocale().'/address')}}"><i class="fas fa-map-marker-alt"></i>{{__('messages.my address')}}</a>
                    </li>
                    <li class="{{@$active ==4  ? 'active' : '' }}">
                        <a href="{{url(app()->getLocale().'/change-password')}}" ><i class="fas fa-lock"></i>{{__('messages.change password')}}</a>
                    </li>
                    <li>
                        <a href="{{url(app()->getLocale().'/logout')}}"><i class="fas fa-sign-out-alt"></i>{{__('messages.logout')}}</a>
                    </li>
                </ul>
            </div>
        </div>