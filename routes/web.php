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

Route::get('/', function () {

    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [CustomerController::class, 'index'])->name('home');

Auth::routes();
Route::get('/home', [App\Http\Controllers\CustomerController::class, 'index'])->name('home');
Route::get('services', [App\Http\Controllers\CustomerController::class, 'Hospital_services'])->name('services');

Route::middleware('auth')->group(function(){

    Route::get('add_to_cart', [App\Http\Controllers\CustomerController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('cart_list', [App\Http\Controllers\CustomerController::class, 'cart_list'])->name('cart');
    Route::get('delete_cart_item', [App\Http\Controllers\CustomerController::class, 'delete_cart_item'])->name('delete_item');
    Route::get('confirmation', [App\Http\Controllers\CustomerController::class, 'confirmation_form'])->name('confirmation');
    Route::get('orders', [App\Http\Controllers\CustomerController::class, 'orders'])->name('order.list');
    Route::get('order_details', [App\Http\Controllers\CustomerController::class, 'order_details'])->name('order.details');

    Route::get('report_download/{test_id}', [App\Http\Controllers\CustomerController::class, 'report_download'])->name('report.download');

    Route::post('save', [App\Http\Controllers\CustomerController::class, 'save_user_data'])->name('submit_user_confirmation');

    Route::middleware('hospital')->prefix('hospital')->group(function(){
        Route::get('home', [App\Http\Controllers\Hospital::class, 'index'])->name('hospital.home');
        Route::get('test', [App\Http\Controllers\Hospital::class, 'test_create'])->name('hospital.test.create');
        Route::post('test/save', [App\Http\Controllers\Hospital::class, 'test_save'])->name('hospital.test.save');
        Route::get('staff', [App\Http\Controllers\Hospital::class, 'staff_create'])->name('hospital.staff.create');
        Route::post('staff/save', [App\Http\Controllers\Hospital::class, 'staff_save'])->name('hospital.staff.save');
        Route::get('staff/{id}/delete', [App\Http\Controllers\Hospital::class, 'staff_delete'])->name('hospital.staff.delete');


    });
    Route::middleware('lab')->prefix('lab')->group(function(){
        Route::get('home', [App\Http\Controllers\LabController::class, 'index'])->name('lab.home');
        Route::match(['get','post'],'pending', [App\Http\Controllers\LabController::class, 'pending'])->name('lab.pending');
        Route::get('{id}/details/{pid}/{confirm}', [App\Http\Controllers\LabController::class, 'pending_details'])->name('lab.pending_details');
        Route::match(['get','post'],'complete', [App\Http\Controllers\LabController::class, 'completed'])->name('lab.completed');
        Route::post('upload', [App\Http\Controllers\LabController::class, 'upload_report'])->name('lab.upload');
        Route::get('download/{id}', [App\Http\Controllers\LabController::class, 'download_report'])->name('lab.download');
        Route::get('delete/{id}', [App\Http\Controllers\LabController::class, 'delete_report'])->name('lab.delete');
        Route::get('confirm/{id}', [App\Http\Controllers\LabController::class, 'confirm_order'])->name('lab.confirm');

    });

    Route::middleware('oneStop')->prefix('oneStop')->group(function(){
        Route::get('home', [App\Http\Controllers\OneStopController::class, 'index'])->name('onestop.home');
        Route::match(['get','post'],'request', [App\Http\Controllers\OneStopController::class, 'request'])->name('onestop.request');
        Route::match(['get','post'],'pending', [App\Http\Controllers\OneStopController::class, 'pending'])->name('onestop.pending');
        Route::match(['get','post'],'complete', [App\Http\Controllers\OneStopController::class, 'complete'])->name('onestop.complete');
        Route::get('{id}/details/{pid}/{confirm}', [App\Http\Controllers\OneStopController::class, 'details'])->name('onestop.details');


        Route::get('{id}/complete_details/{pid}/{confirm}', [App\Http\Controllers\OneStopController::class, 'c_details'])->name('onestop.complete.details');
        Route::get('{id}/pending_details/{pid}/{confirm}', [App\Http\Controllers\OneStopController::class, 'p_details'])->name('onestop.pending.details');

        Route::get('confirm/{id}', [App\Http\Controllers\OneStopController::class, 'request_confirm'])->name('onestop.request_confirm');
        Route::post('payment', [App\Http\Controllers\OneStopController::class, 'update_payment'])->name('onestop.update_payment');

        Route::get("/order_complete/{order_id}/{due}", [App\Http\Controllers\OneStopController::class, 'order_complete'])->name('onestop.finish');
        Route::get('download/{id}', [App\Http\Controllers\LabController::class, 'download_report'])->name('onestop.download');

    });

});

