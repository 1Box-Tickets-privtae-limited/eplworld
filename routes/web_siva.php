<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'language'], function () {
    Route::get('/','App\Http\Controllers\HomeController@index');
    Route::post('/search_data','App\Http\Controllers\HomeController@search_data');
    
    Route::post('/get_state','App\Http\Controllers\HomeController@get_state');


    Route::post('/login','App\Http\Controllers\UserController@login');
    Route::get('/register','App\Http\Controllers\UserController@register');
    Route::post('/register-post','App\Http\Controllers\UserController@register_post');

    Route::get('/dashboard','App\Http\Controllers\UserController@dashboard');
    Route::get('/profile','App\Http\Controllers\UserController@profile');
    Route::post('/profile-update','App\Http\Controllers\UserController@profile_update');
    //Route::post('/account-update','App\Http\Controllers\UserController@account_update');
    Route::get('/orders','App\Http\Controllers\UserController@orders');
    Route::get('/address','App\Http\Controllers\UserController@address');
    Route::post('/add-address','App\Http\Controllers\UserController@add_address');
    Route::get('/delete-address/{id}','App\Http\Controllers\UserController@delete_address');
    Route::get('/edit-address/{id}','App\Http\Controllers\UserController@edit_address');
    Route::post('/update-address','App\Http\Controllers\UserController@update_address');
    Route::any('/change-password','App\Http\Controllers\UserController@change_password');
    Route::any('/change-password-post','App\Http\Controllers\UserController@change_password_post');

    Route::get('/logout','App\Http\Controllers\UserController@logout');

    Route::get('/auth/google','App\Http\Controllers\UserController@auth_google');
    Route::get('/callback/google','App\Http\Controllers\UserController@callback_google');

    Route::get('/auth/facebook','App\Http\Controllers\UserController@auth_facebook');
    Route::get('/callback/facebook','App\Http\Controllers\UserController@callbackFromFacebook');


    Route::get('/top-teams','App\Http\Controllers\TeamsController@top_teams');
    Route::any('/all-teams','App\Http\Controllers\TeamsController@all_teams');
    Route::get('/tournaments','App\Http\Controllers\TeamsController@tournaments');
    Route::get('/tournaments/{type}','App\Http\Controllers\TeamsController@tournaments_leagues');
    Route::get('/other-events','App\Http\Controllers\TeamsController@other_events');

    Route::get('/privacy-policy','App\Http\Controllers\GeneralController@privacy_policy');

    Route::get('/about-us','App\Http\Controllers\GeneralController@about_us');

    Route::get('/team-ticket/{team_name}/{type?}','App\Http\Controllers\TeamsController@team_ticket');

    Route::get('/request-ticket/{id?}','App\Http\Controllers\TeamsController@request_ticket');

    Route::post('/request-ticket-post','App\Http\Controllers\TeamsController@request_ticket_post');

    Route::get('/get-settings','App\Http\Controllers\GeneralController@get_settings');

    Route::get('/tournaments/ticket/{team}','App\Http\Controllers\TeamsController@ticket_details');

    Route::post('/category-list','App\Http\Controllers\TeamsController@category_list');

    Route::post('/add-to-cart','App\Http\Controllers\PaymentController@add_to_cart');
    
    Route::get('/checkout','App\Http\Controllers\PaymentController@checkout');

    Route::post('/checkout-post','App\Http\Controllers\PaymentController@checkout_post');

    Route::post('/subscribe','App\Http\Controllers\HomeController@subscribe');

    Route::any('/partnership','App\Http\Controllers\HomeController@partnership');

    Route::get('/top-games','App\Http\Controllers\TeamsController@top_games');
    Route::get('/all-games','App\Http\Controllers\TeamsController@all_games');

    Route::post('/ticlet-selection-filter','App\Http\Controllers\TeamsController@ticket_details_filter');

    Route::post('/forgot-password','App\Http\Controllers\UserController@forgot_password');
    
    Route::post('/partnership-enquiry','App\Http\Controllers\GeneralController@partnership_enquiry');

    Route::post('/get_stadium_id','App\Http\Controllers\TeamsController@get_stadium_id');
    //Route::post('/language-set','App\Http\Controllers\GeneralController@language_set');

    Route::get('/orders/{booking_no?}','App\Http\Controllers\UserController@orders');
    Route::get('/confirmation/{ref_no}','App\Http\Controllers\ConfirmationController@index');
    Route::get('/nominee/{booking_no}','App\Http\Controllers\UserController@nominee');
    Route::post('/update-nominee','App\Http\Controllers\UserController@update_nominee');
    Route::get('/payment', 'App\Http\Controllers\PaymentController@index');
    Route::post('/transaction', 'App\Http\Controllers\PaymentController@makePayment')->name('make-payment');

    Route::post('/delete-cart','App\Http\Controllers\PaymentController@cart_delete');
    Route::post('/update-cart','App\Http\Controllers\PaymentController@update_cart');
    Route::get('/faq-help','App\Http\Controllers\GeneralController@faq_help');
    Route::any('/advance-search','App\Http\Controllers\GeneralController@advance_search');
});

Route::get('setlocale/{locale}', function($lang) {
    \Session::put('locale', $lang);
    return redirect()->back();
});

Route::get('currency/{code}', function($code) {
    \Session::put('currency', $code);
    return redirect()->back();
});