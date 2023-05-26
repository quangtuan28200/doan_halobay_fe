<?php

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

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [
    'uses' => 'Frontend\HomeController@index'
])->name('home');
Route::get('/lien-he', [
    'uses' => 'Frontend\HomeController@contact'
])->name('contact');
Route::get('/dang-nhap', [
    'uses' => 'Frontend\AccountController@login'
])->name('login');
Route::get('/dang-ky', [
    'uses' => 'Frontend\AccountController@signup'
])->name('signup');
Route::get('/dang-ky-dai-ly', [
    'uses' => 'Frontend\AccountController@signup_agency'
])->name('signup_agency');
Route::get('/quen-mat-khau', [
    'uses' => 'Frontend\AccountController@forgot_password'
])->name('forgot_password');
Route::post('/post_forgot_pass', [
    'uses' => 'Frontend\AccountController@post_forgot_pass'
])->name('post_forgot_pass');
Route::get('/dang-ky-cong-tac-vien', [
    'uses' => 'Frontend\AccountController@signup_collaborators'
])->name('signup_collaborators');
Route::get('/dang-ky-nguoi-dung-thuong', [
    'uses' => 'Frontend\AccountController@signup_user_normal'
])->name('signup_user_normal');
Route::post('/post_signup_user_normal', [
    'uses' => 'Frontend\AccountController@post_signup_user_normal'
])->name('post_signup_user_normal');
Route::post('/post_signup_collaborators', [
    'uses' => 'Frontend\AccountController@post_signup_collaborators'
])->name('post_signup_collaborators');
Route::post('/post_signup_agency', [
    'uses' => 'Frontend\AccountController@post_signup_agency'
])->name('post_signup_agency');
Route::post('/post_login', [
    'uses' => 'Frontend\AccountController@post_login'
])->name('post_login');
Route::post('sign_up_notify', [
    'uses' => 'Frontend\HomeController@sign_up_notify'
])->name('sign_up_notify');
Route::get('/gioi-thieu', [
    'uses' => 'Frontend\HomeController@about_us'
])->name('about-us');
Route::get('/tin-tuc/{cate_id?}', [
    'uses' => 'Frontend\HomeController@news'
])->name('news');

//search hotel
Route::post('search-hotel', [
    'uses' => 'Frontend\HotelController@searchHotel'
])->name('search-hotel');
Route::get('searchHotel', [
    'uses' => 'Frontend\HotelController@searchHotel'
])->name('searchHotel');
Route::get('load-data-hotel', [
    'uses' => 'Frontend\HotelController@ajax_hotel'
])->name('ajax_hotel');
Route::get('hotel/{slug}.html', [
    'uses' => 'Frontend\HotelController@detailHotel'
])->name('detailHotel');
Route::post('hotel/{slug}.html', [
    'uses' => 'Frontend\HotelController@detailHotel'
])->name('post_detailHotel');
Route::get('load-data-room-in-hotel/{page}', [
    'uses' => 'Frontend\HotelController@ajax_hotel_room'
])->name('ajax_hotel_room');
Route::get('hotel/book-room-hotel', [
    'uses' => 'Frontend\HotelController@get_book_room'
])->name('get_book_room');
Route::post('hotel/post_book_room', [
    'uses' => 'Frontend\HotelController@post_book_room'
])->name('post_book_room');
Route::post('book_room_in_hotel', [
    'uses' => 'Frontend\HotelController@book_room_in_hotel'
])->name('book_room_in_hotel');
Route::get('book_room_in_hotel', [
    'uses' => 'Frontend\HotelController@book_room_in_hotel'
])->name('book_room_in_hotel_online_payment');
Route::post('create-rate-hotel', [
    'uses' => 'Frontend\HotelController@create_rate_hotel'
])->name('create_rate_hotel');
Route::post('update-rate-hotel', [
    'uses' => 'Frontend\HotelController@update_rate_hotel'
])->name('update_rate_hotel');
Route::post('create-question-hotel', [
    'uses' => 'Frontend\HotelController@create_question_hotel'
])->name('create_question_hotel');
Route::post('update-question-hotel', [
    'uses' => 'Frontend\HotelController@update_question_hotel'
])->name('update_question_hotel');

//search yacht
Route::post('search-Yacht', [
    'uses' => 'Frontend\YachtController@post_search_Yacht'
])->name('post_search_Yacht');
Route::get('load-data-yacht', [
    'uses' => 'Frontend\YachtController@ajax_yacht'
])->name('ajax_yacht');
Route::get('yacht/{slug}.html', [
    'uses' => 'Frontend\YachtController@detaiYacht'
])->name('detaiYacht');
Route::get('load-data-room-in-yacht/{page}', [
    'uses' => 'Frontend\YachtController@ajax_yacht_room'
])->name('ajax_yacht_room');
Route::post('yacht/post_book_room_in_yacht', [
    'uses' => 'Frontend\YachtController@post_book_room_in_yacht'
])->name('post_book_room_in_yacht');
Route::get('yacht/book-room-yacht', [
    'uses' => 'Frontend\YachtController@get_book_room_yacht'
])->name('get_book_room_yacht');
Route::post('yacht/book_room_in_yacht', [
    'uses' => 'Frontend\YachtController@book_room_in_yacht'
])->name('book_room_in_yacht');

// seaplane
Route::post('search-seaplane', [
    'uses' => 'Frontend\SeaPlaneController@post_search_seaplane'
])->name('post_search_seaplane');
Route::get('load-data-seaplane', [
    'uses' => 'Frontend\SeaPlaneController@ajax_seaPlane'
])->name('ajax_seaPlane');
Route::get('book-seaplane/{slug}', [
    'uses' => 'Frontend\SeaPlaneController@book_seaplane'
])->name('book_seaplane');
Route::post('post_book_seaplane', [
    'uses' => 'Frontend\SeaPlaneController@post_book_seaplane'
])->name('post_book_seaplane');

// combo
Route::post('search-combo', [
    'uses' => 'Frontend\ComboController@post_search_combo'
])->name('post_search_combo');
Route::get('combo/{slug}.html', [
    'uses' => 'Frontend\ComboController@detailCombo'
])->name('detailCombo');
Route::get('combo-bookking/{slug}.html', [
    'uses' => 'Frontend\ComboController@book_combo'
])->name('book_combo');
Route::post('book-combo', [
    'uses' => 'Frontend\ComboController@post_book_combo'
])->name('post_book_combo');
Route::get('load-data-combo', [
    'uses' => 'Frontend\ComboController@ajax_combo'
])->name('ajax_combo');

// news
Route::get('load-data-news', [
    'uses' => 'Frontend\HomeController@ajax_news'
])->name('ajax_news');
Route::get('tin-tuc-chi-tiet/{slug}.html', [
    'uses' => 'Frontend\HomeController@detail_news'
])->name('detail_news');

//search tour
Route::post('search-tour', [
    'uses' => 'Frontend\TourController@post_search_tour'
])->name('post_search_tour');
Route::get('load-data-tour', [
    'uses' => 'Frontend\TourController@ajax_tour'
])->name('ajax_tour');
Route::get('tour/{slug}.html', [
    'uses' => 'Frontend\TourController@detail_tour'
])->name('detail_tour');
Route::get('tour-booking/{slug}.html', [
    'uses' => 'Frontend\TourController@tour_booking'
])->name('tour_booking');
Route::post('book-tour', [
    'uses' => 'Frontend\TourController@post_book_tour'
])->name('post_book_tour');

//search flight
Route::post('search-2-way-flight', [
    'uses' => 'Frontend\FlightController@post_search_2_way_flight'
])->name('post_search_2_way_flight');
Route::get('flight/{slug}.html', [
    'uses' => 'Frontend\FlightController@detail_flight'
])->name('detail_flight');
Route::get('flight-booking', [
    'uses' => 'Frontend\FlightController@get_flight_two_booking'
])->name('flight_booking');
Route::post('book-flight', [
    'uses' => 'Frontend\FlightController@book_flight_two'
])->name('book_flight_two');
Route::get('load-data-flight', [
    'uses' => 'Frontend\FlightController@ajax_data_flight'
])->name('ajax_data_flight');
Route::post('search-flight', [
    'uses' => 'Frontend\FlightController@post_search_flight'
])->name('post_search_flight');
Route::get('load-data-one-way-flight', [
    'uses' => 'Frontend\FlightController@ajax_data_one_way_flight'
])->name('ajax_data_one_way_flight');
Route::get('flight-one-booking', [
    'uses' => 'Frontend\FlightController@get_flight_one_booking'
])->name('flight_one_booking');
Route::post('book-flight-one', [
    'uses' => 'Frontend\FlightController@book_flight_one'
])->name('book_flight_one');
// Account
Route::get('/tai-khoan', [
    'uses' => 'Frontend\AccountController@account_detail'
])->name('account_detail');
Route::post('cap-nhat-tai-khoan', [
    'uses' => 'Frontend\AccountController@updateInfoUser'
])->name('updateInfoUser');
Route::post('cap-nhat-mat-khau', [
    'uses' => 'Frontend\AccountController@updatePassUser'
])->name('updatePassUser');
Route::get('/tai-khoan/logout', [
    'uses' => 'Frontend\AccountController@logout'
])->name('logout');

// vnpay_payment
Route::get('/vnpay-return.php', [
    'uses' => 'Frontend\VNPayController@vnpay_return'
])->name('vnpay_return');
Route::post('init_vnpay_payment', [
    'uses' => 'Frontend\VNPayController@init_vnpay_payment'
])->name('init_vnpay_payment');
Route::get('vnpay_payment', [
    'uses' => 'Frontend\VNPayController@vnpay_payment'
])->name('vnpay_payment');

Route::get('{slug?}', [
    'uses' => 'Frontend\HomeController@web_content'
])->name('web_content');
