<?php

use App\Modules\Invoices\Agregate\Commands\Approve\Infrastructure\Controllers\ApproveInvoiceController;
use App\Modules\Invoices\Agregate\Commands\Reject\Infrastructure\Controllers\RejectInvoiceController;
use App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Controllers\GetInvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/invoices')
    ->group(function () {
        Route::group(['middleware' => ['api']], function () {
            Route::patch('/{id}/approve', [ApproveInvoiceController::class, 'update'])->name('invoices.approve');
            Route::patch('/{id}/reject', [RejectInvoiceController::class, 'update'])->name('invoices.reject');
            Route::get('/{id}', [GetInvoiceController::class, 'index'])->name('invoices.get');
        });
    })
;
