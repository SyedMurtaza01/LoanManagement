<?php

use App\Http\Controllers\Admin\{UserController, SettingController, BlogController, BranchController, DocumentsController, InstallmentsController, LoanController as AdminLoanController};
use App\Http\Controllers\LoanController;
use App\Models\Installments;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application.
| Routes will be assigned to the "web" middleware group.
| Make something great!
*/

Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // User Routes
    Route::resource('users', UserController::class);

    // Logout Route
    Route::post('logout', [UserController::class, 'logout'])->name('logout');  // Added logout route

    // Setting Routes
    Route::match(['get', 'post'], 'setting', [SettingController::class, 'index'])->name('setting');

    // Blog Routes
    Route::resource('blogs', BlogController::class);

    // Branch Routes
    Route::resource('branches', BranchController::class);

    // Loan Plans Routes
    Route::resource('loans', AdminLoanController::class);

    // Installments Routes
    Route::resource('installments', InstallmentsController::class);

    // Documents Routes
    Route::resource('documents', DocumentsController::class);
});