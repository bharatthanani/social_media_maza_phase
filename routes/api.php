<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VariantController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\UserDashboardController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\ContactController;
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

Route::get('getAttributeVariants', [VariantController::class, 'getAttributeVariants']);
Route::post('searchProducts', [ProductController::class, 'searchProducts']);
Route::get('sliderProducts', [ProductController::class, 'sliderProducts']);
Route::get('artistProducts', [ProductController::class, 'artistProducts']);
Route::post('particularArtistProducts', [ProductController::class, 'particularArtistProducts']);
Route::post('productDetails', [ProductController::class, 'productDetails']);
Route::post('registration', [LoginController::class, 'registration']);
Route::post('login', [LoginController::class, 'login']);
Route::post('forgotPassword', [LoginController::class, 'forgotPassword']);
Route::post('updatePassword', [LoginController::class, 'updatePassword']);
Route::get('soldProducts', [ProductController::class, 'soldProducts']);
Route::post('createOrder', [OrderController::class, 'createOrder']);
Route::post('createUserCards', [OrderController::class, 'createUserCards']);
Route::post('getUserCards', [OrderController::class, 'getUserCards']);

Route::post('userProfile', [UserDashboardController::class, 'userProfile']);
Route::post('userOrders', [UserDashboardController::class, 'userOrders']);
Route::post('orderDetails', [UserDashboardController::class, 'orderDetails']);
Route::post('changePassword', [UserDashboardController::class, 'changePassword']);
Route::post('createSubscriber', [UserDashboardController::class, 'createSubscriber']);
Route::post('getSubscribers', [UserDashboardController::class, 'getSubscribers']);
Route::post('unfollowSubscriber', [UserDashboardController::class, 'unfollowSubscriber']);

Route::get('aboutContent', [AboutController::class, 'aboutContent']);
Route::post('createContactUs', [ContactController::class, 'createContactUs']);
Route::get('adminContact', [ContactController::class, 'adminContact']);
Route::get('aboutZastContent', [AboutController::class, 'aboutZastContent']);