<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

// ========All Routes for Store Management System============ //

Route::get('/',[StoreController::class,'homepage'])->name('home');
Route::get('/addproduct',[StoreController::class,'addproductView'])->name('addproduct');
Route::post('/addproduct',[StoreController::class,'addproduct'])->name('addproduct');
Route::get('/products',[StoreController::class,'getproducts'])->name('getproduct');
Route::get('/sellportal',[StoreController::class,'sellportal'])->name('sellportal');
Route::get('/sellproduct/{id}',[StoreController::class,'sellproduct'])->name('sellproduct');
Route::post('/sell',[StoreController::class,'confirmsell'])->name('confirmsell');
Route::get('/editproduct',[StoreController::class,'editproduct'])->name('editproduct');
Route::post('/updateproduct',[StoreController::class,'updateproduct'])->name('updateproduct');
Route::get('/deleteproductView',[StoreController::class,'deleteproductView'])->name('deleteproductview');
Route::post('/deleteproduct',[StoreController::class,'deleteproduct'])->name('deleteproduct');
Route::get('/addcategoryview',[StoreController::class,'addcategoryview'])->name('addcategoryview');
Route::get('/allcategories',[StoreController::class,'allcategories'])->name('allcategories');
Route::get('/removecategoriesview',[StoreController::class,'deletecategoryview'])->name('deletecategoryview');
Route::post('/removecategory',[StoreController::class,'deletecategory'])->name('deletecategory');
Route::post('/addcategory',[StoreController::class,'addcategory'])->name('addcategory');
Route::get('/sellhistory',[StoreController::class,'sellhistory'])->name('sellhistory');
Route::get('/totalrevenue',[StoreController::class,'totalrevenue'])->name('totalrevenue');
