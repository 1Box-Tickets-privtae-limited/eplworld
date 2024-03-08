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


Route::get('/',function(){
   if(\Session::has('locale'))
    {
        $language = session()->get('locale');
        return redirect($language);
    } else {
        return redirect(app()->getLocale());
    }
 });

Route::post('/payment','App\Http\Controllers\PartnerController@orders');
Route::post('/paymentresp','App\Http\Controllers\PartnerController@paymentresp');
Route::get('/notfound','App\Http\Controllers\Notfound@notfound');
Route::get('/invalid','App\Http\Controllers\Notfound@invalid');
Route::get('/expired','App\Http\Controllers\Notfound@expired');
 /*Route::get('/',function(){
    return redirect(app()->getLocale());
 });*/

Route::group([ 
    'prefix' => '{locale}', 
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware'=> ['language','setlocale']],
    function () {


    Route::get('/en/clear', function() {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('optimize');
        $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('config:cache');
        return '<h1>Cache facade value cleared</h1>';
    });

    Route::get('/','App\Http\Controllers\HomeController@index')->name('homepage');

    Route::get('/home','App\Http\Controllers\HomeController@index')->name('homepage');
    
    //Route::get('/Request-Ticket-Success','App\Http\Controllers\HomeController@request_ticket_google')->name('homepage');

     Route::get('/request-ticket-success/','App\Http\Controllers\HomeController@request_ticket_google')->name('homepage');
     
    Route::post('/search_data','App\Http\Controllers\HomeController@search_data');
    
    Route::post('/get_state','App\Http\Controllers\HomeController@get_state');
    if(@$_GET['redirect'] == 'login'){
        Route::get('/home','App\Http\Controllers\UserController@user_login');
    }
        
    Route::get('/login','App\Http\Controllers\UserController@user_login');
    Route::post('/login-post','App\Http\Controllers\UserController@login');
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

    Route::get('/get-chats','App\Http\Controllers\UserController@get_chats');
    Route::post('/save-chat','App\Http\Controllers\UserController@save_chat');

    Route::get('/orders_test/{booking_no?}','App\Http\Controllers\UserController@orders_test');

    Route::get('/logout','App\Http\Controllers\UserController@logout');

    Route::get('/auth/google','App\Http\Controllers\UserController@auth_google');
    Route::get('/callback/google','App\Http\Controllers\UserController@callback_google');

    Route::get('/auth/facebook','App\Http\Controllers\UserController@auth_facebook');
    Route::get('/callback/facebook','App\Http\Controllers\UserController@callbackFromFacebook');


    Route::get('/top-teams-tickets','App\Http\Controllers\TeamsController@top_teams');
    Route::any('/all-teams','App\Http\Controllers\TeamsController@all_teams');
    Route::get('/tournament','App\Http\Controllers\TeamsController@tournaments');
    Route::get('/tournament/{type}','App\Http\Controllers\TeamsController@tournaments_leagues');
    Route::get('/other-events-tickets','App\Http\Controllers\TeamsController@other_events');
   /* Route::get('/{team_name}-tickets/{type?}', 'App\Http\Controllers\TeamsController@team_ticket')->where('team_name', "[\w'-]+");*/
     //Route::get('/{team_name}-tickets','App\Http\Controllers\TeamsController@team_ticket');

    Route::get('/legal-privacy-policy','App\Http\Controllers\GeneralController@privacy_policy');
    Route::get('/terms-and-conditions','App\Http\Controllers\GeneralController@terms_conditions');

    Route::get('/about-us','App\Http\Controllers\GeneralController@about_us');

   // Route::get('/team-ticket/{team_name}/{type?}','App\Http\Controllers\TeamsController@team_ticket');

   // Route::get('/team-ticket/{team_name}/{type?}','App\Http\Controllers\TeamsController@team_ticket');

    Route::get('/request-ticket/{id?}','App\Http\Controllers\TeamsController@request_ticket');

    Route::post('/request-ticket-post','App\Http\Controllers\TeamsController@request_ticket_post');

    Route::get('/get-settings','App\Http\Controllers\GeneralController@get_settings');

    Route::get('/tournaments/ticket/{team}','App\Http\Controllers\TeamsController@ticket_details');

    Route::post('/category-list','App\Http\Controllers\TeamsController@category_list');

    Route::post('/add-to-cart','App\Http\Controllers\PaymentController@add_to_cart');
    
    Route::get('/go-to-cart','App\Http\Controllers\PaymentController@go_to_cart');
    
    Route::get('/payment_success/{booking_no}','App\Http\Controllers\PaymentController@payment_success');
    Route::any('/webhook','App\Http\Controllers\PaymentController@webhook');
   // Route::post('/updateadyenresp','App\Http\Controllers\PaymentController@updateadyenresp');
    Route::any('/updateadyenresp/{booking_no?}','App\Http\Controllers\PaymentController@updateadyenresp');
    Route::get('/adyenresp/{booking_no}','App\Http\Controllers\PaymentController@adyenresp');
    Route::any('/Paymentfail','App\Http\Controllers\PaymentController@Paymentfail');
    Route::any('/etisalatResp/{booking_no}','App\Http\Controllers\PaymentController@etisalatResp');
    Route::get('/ds3/{acsUrl}/{TermUrl}/{PaReq}/{MD}/{current_res}/{booking_id}','App\Http\Controllers\PaymentController@ds3');
    Route::post('/networkPaRes/{returnres}/{booking_id}','App\Http\Controllers\PaymentController@networkPaRes');
     
     Route::post('/card_process','App\Http\Controllers\PaymentController@card_process');
    Route::get('/checkout','App\Http\Controllers\PaymentController@checkout');
    Route::get('/checkout-url','App\Http\Controllers\CheckoutUrlController@checkout');
    Route::post('/check_coupon','App\Http\Controllers\PaymentController@check_coupon');
    Route::post('/remove_coupon','App\Http\Controllers\PaymentController@remove_coupon');
    Route::get('/get-cart-data','App\Http\Controllers\PaymentController@get_cart_data');
    Route::post('/booking-protect','App\Http\Controllers\PaymentController@booking_protect');
    Route::get('/submit_booking_protect/{booking_no}','App\Http\Controllers\PaymentController@submit_booking_protect');
    Route::get('/submit_booking_protect_manual/{booking_no}','App\Http\Controllers\PaymentController@submit_booking_protect_manual');
    
    Route::post('/checkout-post','App\Http\Controllers\PaymentController@checkout_post');
    Route::post('/attendee-post','App\Http\Controllers\PaymentController@attendee_post');

    Route::post('/subscribe','App\Http\Controllers\HomeController@subscribe');
    Route::any('/unsubscribe','App\Http\Controllers\GeneralController@unsubscribe');

    Route::any('/sell-your-tickets','App\Http\Controllers\HomeController@sell_ticket');
    Route::any('/partnership','App\Http\Controllers\HomeController@partnership');

    Route::get('/top-games','App\Http\Controllers\TeamsController@top_games');
    Route::get('/all-games','App\Http\Controllers\TeamsController@all_games');
    Route::get('/all-match','App\Http\Controllers\TeamsController@all_match');

    Route::post('/ticlet-selection-filter','App\Http\Controllers\TeamsController@ticket_details_filter');

    Route::post('/forgot-password','App\Http\Controllers\UserController@forgot_password');
    
    Route::post('/partnership-enquiry','App\Http\Controllers\GeneralController@partnership_enquiry');

    Route::post('/get_stadium_id','App\Http\Controllers\TeamsController@get_stadium_id');
    //Route::post('/language-set','App\Http\Controllers\GeneralController@language_set');
    Route::get('/download/{booking_no?}','App\Http\Controllers\UserController@download');
    Route::get('/orders/{booking_no?}','App\Http\Controllers\UserController@orders');
    Route::get('/confirmation/{ref_no}','App\Http\Controllers\ConfirmationController@index');
    Route::get('/failed/{ref_no}','App\Http\Controllers\ConfirmationController@failed');
    Route::get('/nominee/{booking_no}','App\Http\Controllers\UserController@nominee');
    Route::get('/applynominee/{booking_no}','App\Http\Controllers\UserController@applynominee');
    Route::post('/update-nominee','App\Http\Controllers\UserController@update_nominee');
     Route::post('/update_applynominee','App\Http\Controllers\UserController@update_applynominee');
    Route::get('/payment', 'App\Http\Controllers\PaymentController@index');
    Route::post('/transaction', 'App\Http\Controllers\PaymentController@makePayment')->name('make-payment');

    Route::post('/delete-cart','App\Http\Controllers\PaymentController@cart_delete');
    Route::post('/update-cart','App\Http\Controllers\PaymentController@update_cart');
    Route::get('/cart/{base_id}','App\Http\Controllers\PaymentController@cart');
    Route::get('/trackorder','App\Http\Controllers\TeamsController@trackorder');
    Route::post('/track-order-details','App\Http\Controllers\TeamsController@track_order_details');

    Route::get('/faq','App\Http\Controllers\GeneralController@faq_help');
    Route::any('/advance-search','App\Http\Controllers\GeneralController@advance_search');

    Route::get('/other-events-ajax','App\Http\Controllers\AjaxController@other_events');
    Route::get('other-events-{event_name}', 'App\Http\Controllers\TeamsController@other_details');

    Route::get('/{teama}-vs-{teamb}', 'App\Http\Controllers\TeamsController@match_details')->where('teama', "[\w'-]+")->where('teamb', "[\w'-]+");

    
    Route::get('test/{teama}-vs-{teamb}', 'App\Http\Controllers\TeamsController@test_match_details')->where('teama', "[\w'-]+")->where('teamb', "[\w'-]+");


    Route::get('/tournament-tickets','App\Http\Controllers\TeamsController@tournaments');
    Route::get('/all-games-tickets','App\Http\Controllers\TeamsController@all_games');
    Route::any('/{team_leagu}-tickets/{type?}', 'App\Http\Controllers\TeamsController@team_leagues')->where('team_leagu', "[\w'-]+");

    Route::any('/{team_leagu}-Tickets/{type?}', 'App\Http\Controllers\TeamsController@team_leagues')->where('team_leagu', "[\w'-]+");


    Route::any('/teams','App\Http\Controllers\TeamsController@all_teams');

    Route::get('/reset-password/{token?}','App\Http\Controllers\UserController@reset_password');
    Route::post('/reset-password-post','App\Http\Controllers\UserController@reset_password_post');
    Route::get('/email-verify/{token?}','App\Http\Controllers\UserController@email_verification');
    
    Route::get('/tournaments-ajax','App\Http\Controllers\AjaxController@tournaments');
    Route::get('/top-teams-ajax','App\Http\Controllers\AjaxController@top_teams');
    
    Route::post('/all-teams-ajax','App\Http\Controllers\AjaxController@all_teams');
    Route::post('/all-games-ajax','App\Http\Controllers\AjaxController@all_games');
    Route::get('/home-ajax','App\Http\Controllers\AjaxController@index');
    Route::get('/hot_tickets','App\Http\Controllers\AjaxController@hottickets');
    Route::post('/tournaments-leagues-ajax','App\Http\Controllers\AjaxController@tournaments_leagues');
    Route::get('/sitemap','App\Http\Controllers\GeneralController@sitemap');

    Route::any('/contact-us','App\Http\Controllers\GeneralController@contact_us');

    Route::get('/countries','App\Http\Controllers\GeneralController@countries');
    Route::get('/events','App\Http\Controllers\GeneralController@events');
    Route::get('/single-events','App\Http\Controllers\GeneralController@single_events');


    Route::get('test/checkout','App\Http\Controllers\TestController@checkout');

     /* SITE MAP */
    Route::get('teams-list','App\Http\Controllers\TeamsController@teams_list');


    Route::get('blog','App\Http\Controllers\BlogController@index')->name('blog');
    Route::post('all-blogs-ajax','App\Http\Controllers\BlogController@all_blogs_ajax')->name('all-blogs-ajax');
    Route::get('blog/all','App\Http\Controllers\BlogController@all_other')->name('blog_all');
    Route::get('blog/{slug}','App\Http\Controllers\BlogController@details')->name('details');
    
});


Route::get('setlocale/{locale}', function($lang) {
    \Session::put('locale', $lang);
    return redirect()->back();
});

Route::get('currency/{code}', function($code) {
    \Session::put('currency', $code);
    return redirect()->back();
});
