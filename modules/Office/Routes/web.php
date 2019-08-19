<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('login', "office::user.login")->name('office.login');
    Route::post('login', "User\Session\LoginAttempt")->name('office.login.attempt');
});

Route::group(['middleware' => 'auth:office'], function () {
    Route::get('/', function () {
        return redirect()->route('office.user.profile');
    });

    Route::group(['namespace' => "User"], function () {
        Route::post('logout', "Session\Logout")->name('office.logout');

        Route::group(['prefix' => 'profile', 'namespace' => "Profile"], function () {
            Route::get('/', function () {
                return redirect()->route('office.user.profile');
            });
            Route::get('settings', "Settings")->name('office.user.profile');
        });
    });

    Route::group(['prefix' => 'bookings', 'namespace' => "Booking"], function () {
        Route::get('/', function () {
            return redirect(\route('office.booking.report'));
        });
        Route::get('report', "Report")->name('office.booking.report');
        Route::get('{booking}/summary', "Summary")->name('office.booking.summary');
    });

    Route::group(['prefix' => 'employees', 'namespace' => "Employee"], function () {
        Route::get('settings', "Settings")->name('office.employee.settings');
        Route::get('{employee}/profile', "Profile")->name('office.employee.profile');
        Route::post('record/create', "CreateEmployeeRecord")->name('office.employee.record.create');
        Route::post('{employee}/record/edit', "EditEmployeeRecord")->name('office.employee.record.edit');
        Route::post('{employee}/profile/edit', "EditEmployeeProfile")->name('office.employee.profile.edit');
        Route::post('{employee}/profile/upload-pic', "UploadPhoto")->name('office.employee.profile.uploadpic');
        Route::post('attendance/record', "AttendanceRecord")->name('office.employee.attendance.record');
        Route::get('attendance', 'Attendance')->name('office.employee.attendance');
    });

    Route::group(['prefix' => 'rooms', 'namespace' => "Room"], function () {
        Route::get('/', function () {
            return redirect(\route('office.rooms.listing'));
        });
        Route::post('/', "CreateRoom")->name('office.room.create');
        Route::get('settings', "RoomListing")->name('office.rooms.listing');
        Route::get('{room}/settings', "RoomSettings")->name('office.room.settings');
        Route::post('{room}/cs', "ChangeRoomStatus")->name('office.room.status');
    });

    Route::group(['prefix' => 'taxis',  'namespace' => "Taxi"], function () {
        Route::get('/', function () {
            return redirect()->route('office.taxis.listing');
        });

        Route::post('create', "CreateTaxiDetail")->name('office.taxis.create');

        Route::get('listing', "Listing")->name('office.taxis.listing');
        Route::get('{taxi}/profile', "Profile")->name('office.taxi.profile');
    });

    Route::group(['prefix' => 'penalty',  'namespace' => "Penalty"], function () {
        Route::get('/', function () {
            return redirect()->route('office.penalties.listing');
        });

        Route::get('listing', "Listing")->name('office.penalties.listing');

        Route::post('create', "CreatePenalty")->name('office.penalties.create');
    });

    Route::group(['prefix' => 'inventories', 'namespace' => 'Inventory'], function () {

        Route::group(['prefix' => 'products', 'namespace' => "Product"], function () {
            Route::get('listing', "Listing")->name('office.inventory.products.listing');
            Route::get('all', "GetAllProducts")->name('office.inventory.products.all');
            Route::get('{product}/details', "Detail")->name('office.inventory.products.detail');
            Route::post('{product}/details', "EditDetail")->name('office.inventory.products.detail.edit');
            Route::post('{product}/booleans', "EditDetailBooleans")->name('office.inventory.products.boolean.edit');
        });

        Route::group(['prefix' => 'linens', 'namespace' => "Linen"], function () {
            Route::get('listing', "Listing")->name('office.inventory.linens.listing');
            Route::get('{linen}/details', "Detail")->name('office.inventory.linens.detail');
            Route::get('laundries', "GetAllLaundries")->name('office.inventory.linens.laundry');
            Route::post('retrieve', "RetrieveLaundries")->name('office.inventory.linens.retrieve');
        });
    });
    Route::group(['prefix' => 'purchases', 'namespace' => "Purchase"], function () {
        Route::post('products', "RecordPurchases")->name('office.products.purchases');
    });

    Route::group(['prefix' => "sales", 'namespace' => "Sales"], function () {
        Route::get('/', function () {
            return redirect(\route('office.sales.report'));
        });
        Route::get('report', "Report")->name('office.sales.report');
        Route::get('{remittance}/summary', "RemittanceSummary")->name('office.sales.summary');
    });

    Route::group(['prefix' => 'discount','namespace' => 'Discount'], function () {
        Route::get('/', function () {
            return redirect()->route('office.discount.listing');
        });
        Route::get('listing', "Listing")->name('office.discount.listing');
    });
});
