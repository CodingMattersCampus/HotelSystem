<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('login', "store::user.login")->name('store.login');
    Route::post('login', "User\Session\LoginAttempt")->name('store.login.attempt');
});

Route::group(['middleware' => 'auth:store'], function () {
    Route::get('/', function () {
        return redirect()->route('store.user.profile');
    });

    Route::group(['namespace' => "User"], function () {
        Route::post('logout', "Session\Logout")->name('store.logout');

        Route::group(['prefix' => 'profile', 'namespace' => "Profile"], function () {
            Route::get('/', function () {
                return redirect()->route('store.user.profile');
            });
            Route::get('settings', "Settings")->name('store.user.profile');
            Route::patch('password/change', "ChangePassword")->name('store.user.password.change');
        });
    });

    Route::group(['prefix' => 'employees', 'namespace' => 'Employee'], function () {
        Route::get('{employee}/profile', "Profile")->name('store.employee.profile');
        Route::get('settings', "Settings")->name('store.employee.settings');
        Route::post('record/create', "CreateEmployeeRecord")->name('store.employee.record.create');
        Route::post('{employee}/record/edit', "EditEmployeeRecord")->name('store.employee.record.edit');
        Route::post('{employee}/profile/edit', "EditEmployeeProfile")->name('store.employee.profile.edit');
        Route::post('{employee}/profile/upload-pic', "UploadPhoto")->name('store.employee.profile.uploadpic');
    });

    Route::group(['prefix' => 'rooms', 'namespace' => "Room"], function () {
        Route::get('/', function () {
            return redirect(\route('store.rooms.listing'));
        });
        Route::post('/', "CreateRoom")->name('store.room.create');
        Route::get('settings', "RoomListing")->name('store.rooms.listing');
        Route::get('{room}/settings', "RoomSettings")->name('store.room.settings');

        Route::post('{room}/cs', "ChangeRoomStatus")->name('store.room.status');
    });

    Route::group(['prefix' => 'bookings', 'namespace' => "Booking"], function () {
        Route::get('/', function () {
            return redirect(\route('store.booking.report'));
        });
        Route::get('report', "Report")->name('store.booking.report');
        Route::get('{booking}/summary', "Summary")->name('store.booking.summary');
    });

    Route::group(['prefix' => 'cash', 'namespace' => "Cash"], function () {
        Route::group(['prefix' => "remittance", 'namespace' => "Remittance"], function () {
            Route::get('report', "RemittanceReport")->name('store.cash.remittance.report');

            Route::get('{remittance}/summary', "RemittanceSummary")
                ->name('store.cash.remittance.summary');
        });
    });

    Route::group(['prefix' => 'taxis',  'namespace' => "Taxi"], function () {
        Route::get('/', function () {
            return redirect()->route('store.taxis.listing');
        });

        Route::post('create', "CreateTaxiDetail")->name('store.taxis.create');

        Route::get('listing', "Listing")->name('store.taxis.listing');
        Route::get('{taxi}/profile', "Profile")->name('store.taxi.profile');
    });

    Route::group(['prefix' => 'penalty',  'namespace' => "Penalty"], function () {
        Route::get('/', function () {
            return redirect()->route('store.penalties.listing');
        });

        Route::get('listing', "Listing")->name('store.penalties.listing');

        Route::post('create', "CreatePenalty")->name('store.penalties.create');
    });

    Route::group(['prefix' => 'inventories', 'namespace' => 'Inventory'], function () {
        Route::group(['prefix' => 'products', 'namespace' => "Product"], function () {
            Route::get('listing', "Listing")->name('store.inventory.products.listing');
            Route::get('all', "GetAllProducts")->name('store.inventory.products.all');
            Route::get('warehouse', "GetWarehouseProducts")->name('store.inventory.products.warehouse');

            Route::get('{product}/details', "Detail")->name('store.inventory.products.detail');
            Route::post('{product}/details', "EditDetail")->name('store.inventory.products.detail.edit');
            Route::post('{product}/booleans', "EditDetailBooleans")->name('store.inventory.products.boolean.edit');

            Route::post('/restock', 'StoreRestockProducts')->name('store.inventory.products.restock');
        });

        Route::group(['prefix' => 'linens', 'namespace' => "Linen"], function () {
            Route::get('listing', "Listing")->name('store.inventory.linens.listing');
            Route::get('laundries', "GetAllLaundries")->name('store.inventory.linens.laundry');
            Route::post('retrieve', "RetrieveLaundries")->name('store.inventory.linens.retrieve');
            Route::get('{linen}/details', "Detail")->name('store.inventory.linens.detail');
        });
    });

    Route::group(['prefix' => 'purchases', 'namespace' => "Purchase"], function () {
        Route::post('products', "RecordPurchases")->name('store.products.purchases');
    });
});
