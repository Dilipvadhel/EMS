<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RoleController;
use  App\Http\Controllers\expenseReportByCategory;
use App\Http\Controllers\DashboardController;



Route::middleware(['auth'])->group(function () {
    Route::get('/expense-report-by-category', [expenseReportByCategory::class, 'expenseReportByCategory'])->name('reports.report');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction-balances', [TransactionController::class, 'getTransactionBalances']);
    Route::get('/transactions-balance/{month}', [TransactionController::class, 'getTransactionsBalance']);

    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role/{role?}', [RoleController::class, 'saveOrUpdate'])->name('role.store');
    Route::get('/role/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::put('/role/{role}', [RoleController::class, 'saveOrUpdate'])->name('role.update');

    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/{user?}', [UserController::class, 'saveOrUpdate'])->name('user.store');
    Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/user/{user}', [UserController::class, 'saveOrUpdate'])->name('user.update');

    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    // Route::get('/user', [UserController::class, 'index'])->name('user.index');
    // Route::post('/user/{user?}', [UserController::class, 'saveOrUpdate'])->name('user.store');
    // Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');
    // Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    // Route::put('/user/{user}', [UserController::class, 'saveOrUpdate'])->name('user.update');

    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/{category?}', [CategoryController::class, 'saveOrUpdate'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'saveOrUpdate'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/vendor/{vendor?}', [VendorController::class, 'saveOrUpdate'])->name('vendor.store');
    Route::get('/vendor/{vendor}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::put('/vendor/{vendor}', [VendorController::class, 'saveOrUpdate'])->name('vendor.update');
    Route::delete('/vendor/{vendor}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    Route::get('/vendor/transactions/{vendorId}', [VendorController::class, 'getVendorTransactions'])->name('vendor.transactions');
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/vendor/pdf/{vendorId}', [VendorController::class, 'generatePDF'])->name('vendor.pdf');
    Route::get('/openModal/{vendor}', [VendorController::class, 'openModal'])->name('openModal');

    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::post('/expense/{expense?}', [ExpenseController::class, 'saveOrUpdate'])->name('expense.store');
    Route::get('/expense/{expense}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('/expense/{expense}', [ExpenseController::class, 'saveOrUpdate'])->name('expense.update');
    Route::delete('/expense/{expense}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
    Route::get('/expense-amount', [ExpenseController::class, 'getExpenseData']);
    Route::get('/expense-amount/{year?}/{month?}', [ExpenseController::class, 'getExpenseData']);

    Route::get('/subcategory/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory/{subcategory?}', [SubcategoryController::class, 'saveorupdate'])->name('subcategory.store');
    Route::get('/subcategory/{subcategory}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/{subcategory}/edit', [SubcategoryController::class, 'saveorupdate'])->name('subcategory.update');
    Route::delete('/subcategory/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::get('expense/getSubcategories/{category}', [ExpenseController::class, 'getSubcategories'])->name('expense.getSubcategories');

    Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/{payment?}', [PaymentController::class, 'saveOrUpdate'])->name('payment.store');
    Route::get('/payment/{payment}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::put('/payment/{payment}', [PaymentController::class, 'saveOrUpdate'])->name('payment.update');
    Route::delete('/payment/{payment}', [PaymentController::class, 'destroy'])->name('payment.destroy');

    Route::get('/vendor/{vendor}/balance', 'VendorController@getBalanceDetails');
    Route::get('/expense-data/{year}', [ExpenseController::class, 'getExpenseData']);

    Route::get('resources/js/app.js', function () {
        return view('app');
    })->name('app');

    Route::get('/expense-data', [ExpenseController::class, 'getExpenseData'])->name('expense.getExpenseData');
});


Route::get('/', [AuthController::class, 'show'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'show'])->name('login.show');
