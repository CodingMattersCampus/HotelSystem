<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employees', 'namespace' => "Employee"], function () {
    Route::post('/', 'GetAllEmployeeApi')->name('api.office.employees.all');

    Route::group(['prefix' => 'attendance', 'namespace' => 'Attendance'], function () {
        Route::post('/', 'GetAllAttendanceFileApi')->name('api.office.employee.attendance.files');
        Route::post('{employee}/attendance', 'GetAllEmployeeAttendanceApi')->name('api.office.employee.attendance.all');
    });
});

Route::group(['prefix' => 'rooms', 'namespace' => "Room"], function () {
    Route::post('/', 'GetAllRoomApi')->name('api.office.rooms.all');

    Route::post('{room}/yearchart', 'GetYearRoomListingChart')->name('api.charts.rooms.year');
    Route::post('/chart/listing', 'GetAllRoomListingChart')->name('api.charts.rooms.listing');

    Route::post('{room}/bookings', "GetBookingsApi")->name('api.room.bookings');
});

Route::group(['prefix' => 'bookings', 'namespace' => "Booking"], function () {
    Route::post('/', 'GetAllBookingsApi')->name('api.store.bookings.all');

    Route::post('/charts', 'GetMonthlyBookingReportApi')->name('api.store.bookings.chart');

    Route::post('{booking}/orders', "GetBookingOrders")->name('api.booking.orders');
    Route::post('{booking}/penalties', "GetBookingPenalties")->name('api.booking.penalties');
    Route::post('{booking}/transfers', "GetBookingTransfers")->name('api.booking.transfers');
    Route::post('{booking}/extends', "GetBookingExtensions")->name('api.booking.extends');
});

Route::group(['prefix' => 'cash', 'namespace' => "Cash"], function () {
    Route::group(['prefix' => 'remittance', 'namespace' => "Remittance"], function () {
        Route::post('/', "GetAllRemittancesApi")->name('api.cash.remittances.all');
        Route::post('/analytics', "GetAllRemittanceChart")->name('api.charts.cash.remittances.all');
        Route::post('/chart', "GetCurrentYearRemittancesApi")->name('api.cash.remittances.chart');
    });

    Route::group(['prefix' => 'advance', 'namespace' => 'Advance'], function () {
        Route::post('{employee}', 'GetEmployeeCashAdvanceApi')->name('api.cash.advance.employee');
    });

    Route::post('drawer/{drawer}/transactions', "Transaction\GetCashDrawerTransactions")
        ->name('api.cash.drawer.transactions');
});

Route::group(['prefix' => 'taxi', 'namespace' => "Taxi"], function () {
    Route::post('/', 'GetAllTaxiesApi')->name('api.taxies.all');
    Route::post('{taxi}/bookings', "GetAllTaxiBookingsApi")->name('api.taxi.bookings');

    Route::post('/chart', "GetAllTaxiBookingsChart")->name('api.charts.taxi.all');
});

Route::group(['prefix' => 'penalties', 'namespace' => "Penalty"], function () {
    Route::post('/', "GetAllPenaltiesApi")->name('api.penalties.all');
    Route::post('/chart', "GetBookingPenaltiesChart")->name('api.charts.penalties.all');
});

Route::group(['prefix' => 'inventory', 'namespace' => 'Inventory'], function () {

    Route::group(['prefix' => 'products', 'namespace' => "Product"], function () {
        Route::post('/', 'GetAllProductsApi')->name('api.inventory.products');
        Route::post('/store', 'GetAllStoreProductsApi')->name('api.inventory.products.store');
        Route::post('{product}/transactions', 'GetProductTransactionsApi')->name('api.inventory.products.transactions');
    });

    Route::group(['prefix' => 'linens', 'namespace' => "Linen"], function () {
        Route::post('/', "GetAllLinensApi")->name('api.inventory.linens');
        Route::post('{linen}/transactions', 'GetLinenTransactionsApi')->name('api.inventory.linens.transactions');
    });

    Route::post('{drawer}/remittance', "Remittance")->name('api.cashier.inventory.remittance');
});

Route::group(['prefix' => 'discount', 'namespace' => "Discount"], function () {
    Route::post('sc', "GetAllSeniorCitizenApi")->name('api.discount.seniors.all');
});
