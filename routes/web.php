<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Trades\Index as TradeIndex;
use App\Livewire\Trades\Create as TradeCreate;
use App\Livewire\Trades\Edit as TradeEdit;
use App\Livewire\Trades\Show as TradeShow;
use App\Livewire\Trades\Close as TradeClose;
use App\Livewire\Stocks\Index as StockIndex;
use App\Livewire\Stocks\Create as StockCreate;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', DashboardIndex::class)
        ->name('dashboard');

    // STOCKS
    Route::get('/stocks', StockIndex::class)->name('stocks.index');
    Route::get('/stocks/create', StockCreate::class)->name('stocks.create');

    // TRADES
    Route::get('/trades', TradeIndex::class)->name('trades.index');
    Route::get('/trades/create', TradeCreate::class)->name('trades.create');
    Route::get('/trades/{trade}', TradeShow::class)->name('trades.show');
    Route::get('/trades/{trade}/edit', TradeEdit::class)->name('trades.edit');
    Route::get('/trades/{trade}/close', TradeClose::class)->name('trades.close');

    Route::view('/profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
