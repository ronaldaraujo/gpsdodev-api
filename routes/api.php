<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportRequestController;
use App\Http\Controllers\BussolaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/reports/request', [ReportRequestController::class, 'store']);
Route::post('/bussola/submit', [BussolaController::class, 'store']);
