<?php

use App\DataTransferObjects\FinanceData;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('App', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware([
    'auth'
]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $income = auth()->user()->finances()->where('type', 'income')->get();
        $outgoings = auth()->user()->finances()->where('type', 'outgoing')->get();

        return Inertia::render('Dashboard', [
            'income' => $income->map(fn ($item) => FinanceData::from($item)),
            'outgoings' => $outgoings,
        ]);
    })->name('dashboard');
});
