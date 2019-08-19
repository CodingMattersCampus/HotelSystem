<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('login', "booking::user.login")->name('booking.login');
    Route::post('login', "User\Session\LoginAttempt")->name('booking.login.attempt');
});

Route::group(['middleware' => 'auth:booking'], function () {
    Route::post('discontinue', "User\Session\Logout@discontinue")->name('booking.logout.discontinue');

    Route::get('cashier/confirmation', "User\Session\CashierConfirmation")->name('booking.cashier.confirmation');

    Route::group(['prefix' => "{cashier}/transactions", 'namespace' => "Drawer"], function () {
        Route::post('start', "StartTransaction")->name('booking.drawer.transaction.start');
    });
});

Route::group(['middleware' => ['auth:booking', 'cashierOnDuty']], function () {

    Route::get('/', function () {
        return redirect()->route('booking.dashboard');
    });

    Route::group(['namespace' => "User"], function () {
        Route::post('logout', "Session\Logout")->name('booking.logout');


        Route::group(['prefix' => 'profile', 'namespace' => "Profile"], function () {
            Route::get('/', function () {
                return redirect()->route('booking.user.profile');
            });
            Route::get('settings', "Settings")->name('booking.user.profile');
            Route::patch('password/change', "ChangePassword")->name('booking.user.password.change');
        });
    });

    Route::group(['namespace' => "Booking"], function () {
        Route::get('dashboard', "Dashboard")->name('booking.dashboard');
        Route::get('booking/{room}/detail', "BookingDetail")->name('booking.detail');
        Route::post('booking/{room}/order', "AdditionalOrder")->name('booking.room.order');
    });

    Route::group(['prefix' => 'room', 'namespace' => "Room"], function () {
        Route::post('{room}/booking/transfer', "TransferRoom")->name('booking.room.transfer');
        Route::post('{room}/booking/extend', "ExtendBooking")->name('booking.room.extend');
        Route::post('{room}/booking/checkin', "BookRoom")->name('booking.room.book');
        Route::post('{room}/booking/checkout', "CheckoutRoom")->name('booking.room.checkout');
        Route::post('{room}/booking/cleaned', "CleanedRoom")->name('booking.room.cleaned');
    });

    Route::group(['prefix' => 'cash' ,'namespace' => "Cash"], function () {
        Route::get('transactions', "CashTransactions")->name('booking.cash.transactions');
        Route::get('advance', "CashAdvanceWithdraw")->name('booking.cash.advance');
        Route::get('purchase', "StorePurchase")->name('booking.cash.purchases');
        Route::post('purchase', "StorePurchase@deduct")->name('booking.cash.deduct.purchases');
    });

    Route::group(['prefix' => 'taxis',  'namespace' => "Taxi"], function () {
        Route::get('/', function () {
            return redirect()->route('booking.taxis.listing');
        });

        Route::post('create', "CreateTaxiDetail")->name('booking.taxis.create');

        Route::get('listing', "Listing")->name('booking.taxis.listing');

        Route::get('{taxi}/profile', "Profile")->name('booking.taxis.profile');
    });

    Route::group(['namespace' => 'Drawer'], function () {
        Route::post('remit', "EndTransaction")->name('booking.cash.remit');
        Route::post('withdraw', "CashAdvance")->name('booking.cash.advance.withdraw');
    });
});
