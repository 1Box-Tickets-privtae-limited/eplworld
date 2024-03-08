@if ($results)
    <?php
    $team = explode('Vs', $results['match_name']);
    $tax_each = ($results['tax_fees'] + $results['partner_fee']) / $results['quantity'];
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="track-order-details">
                <div class="delivery_dates">
                    <div class="cust_name">
                        <h3>{{ __('messages.Hi') }} {{ $results['first_name'] }} {{ $results['last_name'] }}</h3>
                    </div>
                    <div class="estimate_date">
                        <p>{{ __('messages.Your estimated ticket delivery date is') }}</p>
                        <span
                            class="dates">{{ date('j F, Y', strtotime('-1 day', strtotime($results['match_date']))) }}</span>
                    </div>
                </div>
                <div class="details_info">
                    <div class="orders_status">
                        <div class="orders_id">
                            <p>{{ __('messages.order id') }}: <b>{{ $results['booking_no'] }}</b></p>
                        </div>
                        <div class="orders_id_status">
                            @if ($results['delivery_status'] == 4)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.downloaded') }}</span></p>
                            @elseif($results['delivery_status'] == 6)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.delivered') }}</span></p>
                            @elseif($results['booking_status'] == 0)
                                <p>{{ __('messages.order status') }}: <span
                                        class="text-danger">{{ __('messages.failed') }}</span></p>
                            @elseif($results['booking_status'] == 1)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.confirmed') }}</span></p>
                            @elseif($results['booking_status'] == 2)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.pending') }}</span></p>
                            @elseif($results['booking_status'] == 3)
                                <p>{{ __('messages.order status') }}: <span
                                        class="text-danger">{{ __('messages.cancelled') }}</span></p>
                            @elseif($results['booking_status'] == 4)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.shipped') }}</span></p>
                            @elseif($results['booking_status'] == 5)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.delivered') }}</span></p>
                            @elseif($results['booking_status'] == 6)
                                <p>{{ __('messages.order status') }}: <span
                                        class="order_success">{{ __('messages.downloaded') }}</span></p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="place_order-details">
                                <div class="row column_mobile">
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <div class="order-detail-txt">
                                            <h4>{{ @$team[0] }} </h4>
                                            <p>{{ $results['tournament_name'] }}</p>

                                            <div class="popular-date-time">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $results['match_date'] . ' ' . $results['match_time'])->format('d F Y | H:i A') }}
                                            </div>
                                            <div class="stad_time">
                                                <span class="mob-bold">{{ $results['stadium_name'] }}</span>
                                                <ul>
                                                    <li>{{ $results['city_name'] }}, {{ $results['country_name'] }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="e_tickets">
                                                @if ($results['seat_category'])
                                                    <h6>{{ $results['seat_category'] }}</h6>
                                                @else
                                                    <h6>N/A</h6>
                                                @endif
                                                <ul>
                                                    <li><b>{{ __('messages.block') }}:</b>
                                                        @if ($results['ticket_block'])
                                                            <span class="values">{{ $results['ticket_block'] }}</span>
                                                        @else
                                                            <span class="values">Any</span>
                                                        @endif
                                                    </li>
                                                    <li><b>{{ __('messages.row') }}:</b>
                                                        @if ($results['row'])
                                                            <span class="values">{{ $results['row'] }}</span>
                                                        @else
                                                            <span class="values">Any</span>
                                                        @endif
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12 padfive">
                                        <div class="order-img">
                                            @php
                                                $teamString = @$team[0];
                                                $teams_alt = explode('vs', $teamString);
                                            @endphp
                                            <img src="{{ $results['team_image_a'] }}" alt="{{ $teams_alt[0] }}">
                                            <img src="{{ $results['team_image_b'] }}" alt="{{ $teams_alt[1] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="category-info-list">
                                <ul>
                                    <li>
                                        <div class="price_info"><b>{{ __('messages.Ticket price') }}:</b></div>
                                        <div class="price_range">
                                            @if ($results['quantity'] == 1)
                                                {{ $results['quantity'] }} Ticket at
                                            @else
                                                {{ $results['quantity'] }} Tickets at
                                            @endif

                                            @if (strtoupper($results['currency_type']) == 'GBP')
                                                <i class="fas fa-pound-sign"></i>
                                            @endif
                                            @if (strtoupper($results['currency_type']) == 'EUR')
                                                <i class="fas fa-euro-sign"></i>
                                            @endif
                                            @if (strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                                {{ $results['currency_type'] }}
                                            @endif {{ number_format($results['price'], 2) }}
                                            Each
                                        </div>
                                    </li>
                                    <li>
                                        <div class="price_info"><b>{{ __('messages.Service Fee') }}:</b> </div>
                                        <div class="price_range">
                                            @if (strtoupper($results['currency_type']) == 'GBP')
                                                <i class="fas fa-pound-sign"></i>
                                            @endif
                                            @if (strtoupper($results['currency_type']) == 'EUR')
                                                <i class="fas fa-euro-sign"></i>
                                            @endif
                                            @if (strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                                {{ $results['currency_type'] }}
                                            @endif {{ number_format($tax_each, 2) }} Each
                                        </div>
                                    </li>

                                    @if ($results['premium_price'] > 0)
                                        <li>
                                            <div class="price_info"><span>{{ __('messages.Booking protection') }}:
                                                </span></div>
                                            <div class="price_range"><span>
                                                    @if (strtoupper($results['currency_type']) == 'GBP')
                                                        <i class="fas fa-pound-sign"></i>
                                                    @endif
                                                    @if (strtoupper($results['currency_type']) == 'EUR')
                                                        <i class="fas fa-euro-sign"></i>
                                                    @endif
                                                    @if (strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                                        {{ $results['currency_type'] }}
                                                    @endif
                                                    {{ number_format($results['premium_price'], 2) }}
                                                </span></div>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                            <div class="order-detail-price">
                                <h5>{{ __('messages.Total Paid') }} : <span class="span_ltr">
                                        @if (strtoupper($results['currency_type']) == 'GBP')
                                            <i class="fas fa-pound-sign"></i>
                                        @endif
                                        @if (strtoupper($results['currency_type']) == 'EUR')
                                            <i class="fas fa-euro-sign"></i>
                                        @endif
                                        @if (strtoupper($results['currency_type']) != 'GBP' && strtoupper($results['currency_type']) != 'EUR')
                                            {{ $results['currency_type'] }}
                                        @endif {{ number_format($results['total_amount'], 2) }}
                                    </span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if (!$results)
    <div class="row">
        <div class="col-md-12">
            <div class="track-order-details">
                <h4>{{ __('messages.No Order Details found for the given reference') }}</h4>
            </div>
        </div>
    </div>
@endif
