<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('products',[\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::post('products',[ProductController::class, 'store']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/{id}/edit',[ProductController::class,'update']);
Route::delete('products/{id}/delete',[ProductController::class,'destory']);
