@extends('layouts.app')
@section('content')
     
<style type="text/css">
        .iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container{
            right: unset !important;
        }
        .iti--separate-dial-code{
            width: 100%;
        }
    </style>
    <!-- Breadcromb Area Start -->

    <section class="onebox-breadcromb-area breadcromb-bg-image">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <ul>
                            <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i>{{__('messages.home')}}</a></li>
                            <li>/</li>
                            <li>{{__('messages.orders')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="onebox-section-heading">
                        <h1>{{__('messages.orders')}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcromb Area End -->


     <section class="onebox-seller-area ">
        <div class="container">
            <div class="row">
                     @include('frontend.user.left-menu')
                     <div class="col-md-8">
                        <div class="all_head">
                            <h3>{{__('messages.orders')}}</h3>
                        </div>
                         @if(@$results)
            
                  
                        @foreach($results as $row)
                            
                            <div class="my_orders">
                                        <div class="my_order_informations">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="my_order_s">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>{{__('messages.order number')}}:</b></td>  
                                                                    <td><span class="clr_grey"><a href="{{url(app()->getLocale())}}/orders/{{md5($row['booking_no'])}}">#{{$row['booking_no']}}</a></span></td>  
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{__('messages.payment method')}}:</b></td>  
                                                                    <td>{{__('messages.Online')}}</td>      
                                                                </tr>
                                                                <tr>
                                                                    <td><b>{{__('messages.number of tickets')}}:</b></td>  
                                                                    <td>{{\Carbon\Carbon::parse($row['updated_at'])->format('d F Y')}}  | {{\Carbon\Carbon::parse($row['updated_at'])->format('H:i:s')}}  </td>      
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="order_s">
                                                        <table>
                                                            <tbody>
                                                            <tr>
                                                                <td><b>{{__('messages.number of tickets')}}</b></td>
                                                                <td>{{$row['quantity']}}</td>           
                                                            </tr>
                                                            <tr>
                                                                <td><b>{{__('messages.status')}}:</b></td>
                                                             @if($row['booking_status'] == 0)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.failed')}}</td>
                                                                  @endif
                                                                  @if($row['booking_status'] == 1)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.confirmed')}}</td>
                                                                  @endif
                                                                  @if($row['booking_status'] == 2)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.pending')}}</td>
                                                                  @endif 
                                                                  @if($row['booking_status'] == 3)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.cancelled')}}</td>
                                                                  @endif
                                                                  @if($row['booking_status'] == 4)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.shipped')}}</td>
                                                                  @endif
                                                                  @if($row['booking_status'] == 5 || $row['delivery_status'] == '6')
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.delivered')}}</td>
                                                                  @endif
                                                                  @if($row['booking_status'] == 6)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.downloaded')}}</td>
                                                                  @endif
                                                                  @if($row['booking_status'] == 7)
                                                                  <td data-label="{{__('messages.status')}}:">{{__('messages.not_initiated')}}</td>
                                                                  @endif 
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my_order-details">
                                            <div class="row">
                                                    <div class="col-md-8 col-sm-8 col-xs-8 full_widd">                          
                                                        <div class="my_order-tickets-content">

                              
                                                            <a href="#"><h2>{{$row['match_name']}}</h2></a>
                                                            <p>{{$row['tournament_name']}}</p>
                                                            <div class="popular-date-time">
                                                                @if($row['tbc_status'])
                                                                        {{$row['tbc_status']}}
                                                                    @else
                                                                    {{\Carbon\Carbon::parse($row['match_date'])->format('d F Y')}} | {{\Carbon\Carbon::parse($row['match_date'])->format('H:i:s')}}  
                                                                @endif 
                                                            </div>
                                                            <p>{{$row['stadium_name']}}, {{$row['country_name']}} , {{$row['city_name']}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4 padfive full_widd">
                                                        <div class="my_order-img">
                                                            <img src="{{$row['team_image_a']}}" alt="">
                                                            <img src="{{$row['team_image_b']}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                            </div>

                           
                        @endforeach

                        @else

                            <div class="my_orders">
                                        <div class="my_order_informations">
                                            <div class="row">
                                                <div class="col-md-7">
                        <h5>No Records Found</h5>
                    </div>
                </div>
            </div>
                         @endif
                     </div>
            </div>
        </div>
    </section>
    

@endsection
@push('scripts')
<script type="text/javascript">

</script>
@endpush('scripts')