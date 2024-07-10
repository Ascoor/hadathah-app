<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleRepController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\EmployeeUserController;
use App\Http\Controllers\MultiEmployeeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SocialRepController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/password/user-reset', [AuthController::class, 'sendUserResetLinkEmail']);
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);


Route::group(['middleware' => ['cors']], function () {

// DashBoard Counts
Route::get('/dashboard', [DashboardController::class, 'index']);


Route::apiResource('users', UserController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('sale-reps', SaleRepController::class);
Route::apiResource('social-reps', SocialRepController::class);
Route::apiResource('multi-employees', MultiEmployeeController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('designers', DesignerController::class);
Route::apiResource('offers', OfferController::class);
Route::apiResource('orders', OrderController::class);
// Route::apiResource('permissions', PermissionController::class);
Route::apiResource('employee-users', EmployeeUserController::class);


Route::get('employees-data', [EmployeeUserController::class, 'getEmployeesData']);
// Convert Offer To Order Route
Route::post('/offers/convert-offer/{offer}', [OfferController::class, 'convertToOrder']);

//  Order Routes
Route::get('/orders/by-offer/{offerId}', [OrderController::class, 'getByOffer']);
Route::get('/orders/order-details/{orderId}', [OrderController::class, 'getOrderDetails']);

//Roles Rutes
Route::get('/roles', [RoleController::class, 'index']);
Route::post('/roles', [RoleController::class, 'store']);
Route::get('/roles/{roleId}/permissions', [RoleController::class, 'getRolePermissions']);


//Permission Rutes
Route::get('/permissions', [PermissionController::class, 'index']);
Route::get('/user-permissions/{userId}', [PermissionController::class, 'getUserPermissions']);
Route::post('/permissions/{userId}', [PermissionController::class, 'updateUserPermissions']);
Route::get('/permissions/{userId}', [PermissionController::class, 'getPermissions']);
Route::get('/permissions/stream/{userId}', [PermissionController::class, 'streamPermissions']);

// users routes
Route::get('/user-image/{userId}', [UserController::class, 'getUserImage']);
// user email
Route::post('/user-email/{userId}', [UserController::class, 'updateUserEmail']);


// Sale Rep routes
Route::get('/sale-rep/offers/{saleRepId}', [SaleRepController::class, 'getOffersBySaleRep']);


//employee-users CRUD

Route::post('/employee-users/{userId}', [EmployeeUserController::class, 'updateUserEmail']);


});
