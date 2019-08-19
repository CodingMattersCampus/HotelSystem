<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'taxis', 'namespace' => "Taxi"], function () {
    Route::get('/', "GetAllTaxisApi")->name('booking.api.taxis.all');
});

Route::group(['prefix' => 'employees', 'namespace' => "Employee"], function () {
    Route::get('/', "GetAllEmployees")->name('booking.api.employees.all');
});

Route::group(['prefix' => 'inventory', 'namespace' => "Inventory"], function () {
    Route::group(['prefix' => 'products', 'namespace' => "Product"], function () {
        Route::get('orderables', 'GetAllOrderableProducts')->name('booking.products.orderable');
    });
});

Route::group(['prefix' => 'inventory', 'namespace' => "Inventory"], function () {
    Route::group(['prefix' => 'products', 'namespace' => "Product"], function () {
        Route::get('inventory/orderables', 'GetOrderableProducts')->name('booking.products.inventory.orderable');
    });
});

Route::group(['prefix' => 'penalties', 'namespace' => 'Penalty'], function () {
    Route::get('/', "GetAllPenalties")->name('booking.api.penalties.all');
});

Route::group(['prefix' => 'cash', 'namespace' => "Cash"], function () {
    Route::get('/advance', "GetApprovedCashAdvanceApi")->name('booking.api.cash.advance.approved');
});
