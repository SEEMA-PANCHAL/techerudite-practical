<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Customer\CustomerAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register/customer', [CustomerAuthController::class, 'showCustomerRegisterForm'])->name('show.customer.register.form');
Route::post('/register/customer', [CustomerAuthController::class, 'registerCustomer'])->name('customer.register');
Route::get('/customer/verify', [CustomerAuthController::class, 'showCustomerVerify'])->name('show.customer.verify.form');
Route::post('/customer/verify', [CustomerAuthController::class, 'verifyCustomer'])->name('customer.verify');

Route::get('/register/admin', [AuthController::class, 'showAdminRegisterForm'])->name('show.admin.register.form');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('admin.register');
Route::get('/admin/verify', [AuthController::class, 'showVerify'])->name('show.admin.verify.form');
Route::post('/admin/verify', [AuthController::class, 'verifyAdmin'])->name('admin.verify');
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('show.admin.login.form');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

