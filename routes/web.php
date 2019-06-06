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
 
// Route::get('/', function () {
//     return view('welcome');
// });

//No middleware
Route::get('/','HomeController@index')->name('index');
Route::get('/rate','HomeController@rate')->name('rate');
Route::get('/track','HomeController@track')->name('track');
Route::get('/track/{tracking_code}','HomeController@track_result')->name('trackResult');

Route::get('/contact_us','HomeController@contact')->name('contact_us');
Route::post('/findrate','HomeController@findRate')->name('findRate');
//=====================
Auth::routes();

//=====MIDDLE WARE======

Route::get('/home', 'HomeController@home')->name('home')->middleware('auth');
//=====register package ========================
Route::get('/register_package', 'EstimateController@index')->name('estimate');
Route::post('/register_package/create','EstimateController@create')->name('createEstimate');
Route::get('/register_package/{estimate_id}','EstimateController@show')->name('showEstimate');
Route::post('/register_package/update','EstimateController@update')->name('updateEstimate');
Route::post('/register_package/delete','EstimateController@delete')->name('deleteEstimate');
Route::get('/register_package/print/{estimate_id}','EstimateController@print')->name('printEstimate');
Route::post('register_package/measurement','EstimateController@findMeasurement')->name('findMeasurement');
Route::post('register_package/preview','EstimateController@preview')->name('previewEstimate');
Route::post('register_package/updateShippingAddress','EstimateController@updateShippingAddress')->name('updateShippingAddress');
//==============Order /Registration History=============
Route::get('/order', 'OrderController@index')->name('order');

//==============Tracking==================
Route::get('/tracking', 'TrackingController@index')->name('tracking');
Route::get('/tracking/{tracking_code}','TrackingController@tracking')->name('trackingPackage');

//============contact==============
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact/create','ContactController@create')->name('createContact');
Route::get('/contact/{contact_id}','ContactController@show')->name('showContact');
Route::post('contact/update','ContactController@update')->name('updateContact');
Route::post('/contact/delete','ContactController@delete')->name('deleteContact');
Route::post('/contact/find','ContactController@findInfo')->name('findContactInfo');

//=====Setting / User Profile================
Route::get('/setting', 'UserController@index')->name('setting');
Route::post('/setting/update','UserController@update')->name('updateUser');
Route::post('/setting/update_password','UserController@updatePassword')->name('updatePassword');

//========= MIDDLEWARE AUTHORIZED ROLE============
//===== Rate Controller==================
Route::get('/control_rate','RateController@index')->name('controlRate')->middleware('super_admin');
Route::post('/control_rate/search','RateController@searchByZone')->name('searchRateByZone')->middleware('super_admin');
Route::post('/control_rate/update','RateController@update')->name('updateRate')->middleware('super_admin');


//==== User Controller ==================
Route::get('/users','UserController@allUsers')->name('allUsers')->middleware('admin');
Route::post('/users/info','UserController@info')->name('customerInfo')->middleware('admin');
Route::post('/users/update_role','UserController@updateRole')->name('updateCustomerRole')->middleware('super_admin');
Route::get('/user/search_by_last_name','UserController@searchByLastName')->name('searchUserByLastName')->middleware('admin');
//==== Customer Controller =================
Route::get('/customers','CustomerController@all')->name('allCustomers')->middleware('admin');

//=== Shipping Controller ==============
Route::get('/shipping','ShippingController@index')->name('shipping')->middleware('admin');
Route::get('/shipping/create','ShippingController@create')->name('createShipping')->middleware('admin');
Route::post('/shipping/save','ShippingController@save')->name('saveShipping')->middleware('admin');
Route::get('/shipping/list','ShippingController@list')->name('listShipping')->middleware('admin');
Route::post('/shipping/payment','ShippingController@updatePayment')->name('updatePayment')->middleware('admin');
Route::post('/shipping/tracking_number','ShippingController@updateTrackingNumber')->name('updateTrackingNumber')->middleware('admin');
Route::post('/shipping/preview','ShippingController@preview')->name('previewShipping')->middleware('admin');
Route::get('shipping/delete','ShippingController@deletePage')->middleware('super_admin');
Route::post('shipping/delete_shipping','ShippingController@delete')->name('deleteShipping')->middleware('super_admin');

//=====Report==================
Route::get('/report','ReportController@index')->name('report')->middleware('admin');
Route::get('/report/registration','ReportController@registration')->name('registrationReport')->middleware('admin');
Route::post('/report/registration_info','ReportController@registrationInfo')->name('registrationInfo')->middleware('admin');
Route::get('/report/shipping','ReportController@shipping')->name('shippingReport')->middleware('admin');
Route::post('/report/shipping_info','ReportController@shippingInfo')->name('shippingInfo')->middleware('admin');
Route::get('/report/shipping_detail','ReportController@shippingDetail')->name('shippingDetailReport')->middleware('admin');
Route::post('/report/shipping_detail_report','ReportController@shippingDetailInfo')->name('shippingDetailInfo')->middleware('admin');
Route::get('/report/sales','ReportController@sales')->name('salesReport')->middleware('admin');
Route::post('/report/sales_info','ReportController@salesInfo')->name('salesInfo')->middleware('admin');

//===========mail
Route::post('/email/shipping','MailController@emailShipping')->name('emailShipping')->middleware('auth');
Route::post('/email/question','MailController@emailQuestion')->name('emailQuestion')->middleware('auth');
Route::post('/email/contact_us','MailController@emailContactUs')->name('emailContactUs');


//===payment=================
Route::post('/charge','PaymentController@charge')->name('charge');
