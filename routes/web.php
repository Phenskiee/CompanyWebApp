<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ResponseController;

Route::get('/', function () {
    return view('home');
});

// Route::get('/', [CompanyController::class, 'index'])->name('index');

Route::controller(CompanyController::class)->group(function () {
    Route::get('/', 'index')->name('index-page');
    Route::get('/company', 'companyList')->name('company-page');
    Route::post('company', 'store')->name('store-company');
    Route::delete('company/{company}', 'destroy')->name('delete-data');
    Route::get('/response', 'response')->name('response-page');
    Route::post('response/{applied}/apply', 'apply')->name('apply-company');
    Route::get('show/{details}', 'show')->name('show-page');
    Route::get('edit/{info}', 'edit')->name('edit-page');
    Route::put('update/{info}', 'update')->name('update-company');

    Route::get('/response/search', 'search')->name('search-company');
    Route::get('/response/filter', 'filter')->name('filter-company');
});

// Route::controller(ResponseController::class)->group(function(){
//     Route::post('company/{company}/apply', 'store')->name('apply-company');
// });