<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ExpenseController;
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

Route::middleware(['markury'])->group(function(){

    Route::GET('/login',[AuthenticationController::class, 'gotoLogin'])->name('login');
    Route::POST('/login',[AuthenticationController::class, 'attemptLogin'])->name('attempt-login');

    Route::get('/testing', function () {
        
    });

    Route::middleware(['auth'])->group(function () {
        // Main Page Route
        Route::GET('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-store');
        Route::GET('/pos', [PosController::class, 'gotoPos'])->name('point-of-sale');
        Route::GET('/pos/{id}/add', [PosController::class, 'gotoEditSale'])->name('point-of-sale-add');
        Route::POST('/checkout', [PosController::class, 'checkout'])->name('checkout');
        Route::POST('/update-sale', [PosController::class, 'updateSale'])->name('update-sale');
        Route::POST('/hold-sale', [PosController::class, 'holdSale'])->name('hold-sale');
        Route::POST('/get-hold', [PosController::class, 'getHoldList'])->name('hold-list');
        Route::POST('/get-hold-items', [PosController::class, 'getHoldItems'])->name('hold-items');
        Route::POST('/product-search-in-pos',[PosController::class, 'productSearch'])->name('product-search-in-pos');

        Route::GET('/sales', [SalesController::class, 'gotoSales'])->name('sales');
        Route::POST('/sales', [SalesController::class, 'showSales'])->name('show-sales');
        Route::GET('/sale-reciept/{id}', [SalesController::class, 'showReciept'])->name('sale-reciept');
        Route::GET('/sale-items', [SalesController::class, 'gotoSaleItems'])->name('sale-items');
        Route::POST('/sale-items', [SalesController::class, 'showSaleItems'])->name('show-sale-items');
        Route::POST('/sale-status', [SalesController::class, 'updateSaleStatus'])->name('update-sale-status');

        Route::middleware(['permission:purchase'])->group(function () {
            Route::GET('/purchases', [PurchaseController::class, 'gotoPurchases'])->name('purchases');
            // Route::get('/purchase/new', [PurchaseController::class, 'gotoNewPurchase'])->name('new-purchase');
            Route::GET('pos/purchase', [PurchaseController::class, 'gotoNewPurchase'])->name('new-purchase');
            Route::GET('pos/{id}/purchase', [PurchaseController::class, 'gotoEditPurchase'])->name('edit-purchase');
            Route::POST('/purchases', [PurchaseController::class, 'showPurchases'])->name('show-purchases');
            Route::POST('/purchase/store', [PurchaseController::class, 'storePurchase'])->name('store-purchase');
            Route::POST('/purchase-status', [PurchaseController::class, 'updatePurchaseStatus'])->name('update-purchase-status');
        });

        Route::GET('/products',[ProductController::class, 'gotoProduct'])->name('products');
        Route::POST('/products',[ProductController::class, 'showProducts'])->name('show-products');
        Route::POST('/product/image',[ProductController::class, 'imageProduct'])->name('image-product');

        //Find product used in POS also
        Route::POST('/find-product', [ProductController::class, 'findProduct'])->name('find-product');

        Route::GET('/categories',[CategoriesController::class, 'gotoCategories'])->name('categories');
        Route::POST('/categories',[CategoriesController::class, 'showCategories'])->name('show-categories');
        Route::POST('/category/delete',[CategoriesController::class, 'deleteCategory'])->name('delete-category');

        Route::GET('/stores',[StoreController::class, 'gotoStores'])->name('stores');
        Route::GET('/select/store/{id}',[StoreController::class, 'selectStore'])->name('select-store');
        Route::POST('/stores',[StoreController::class, 'showStores'])->name('show-stores');
        Route::POST('/store/delete',[StoreController::class, 'deleteStore'])->name('delete-store');

        Route::GET('/customers',[ContactController::class, 'gotoCustomers'])->name('customers');
        Route::GET('/suppliers',[ContactController::class, 'gotoSuppliers'])->name('suppliers');
        Route::POST('/contacts',[ContactController::class, 'showContacts'])->name('show-contacts');
        Route::POST('/contact/delete',[ContactController::class, 'deleteContact'])->name('delete-contact');
        Route::POST('/contact/api',[ContactController::class, 'contactApi'])->name('api-contact');
        Route::GET('/contact/report/{id}',[ContactController::class, 'gotoContactReport'])->name('contact-report');

        Route::GET('/settings',[SettingController::class, 'gotoSettings'])->name('settings');
        Route::POST('/settings',[SettingController::class, 'storeSettings'])->name('store-settings');

        Route::GET('/users',[UserController::class, 'gotoUsers'])->name('users');
        Route::GET('/user/logs',[UserController::class, 'gotoUserLogs'])->name('user-logs');
        Route::POST('/user/logs',[UserController::class, 'getUserLogs'])->name('get-user-logs');
        Route::GET('/user-roles',[UserController::class, 'gotoUserRoles'])->name('user-roles');
        Route::POST('/users',[UserController::class, 'showUsers'])->name('show-users');

        Route::GET('/transfers',[TransferController::class, 'gotoTransfers'])->name('transfers');
        Route::GET('/transfer/new', [TransferController::class, 'gotoNewTransfer'])->name('new-transfer');
        Route::POST('/transfer/store', [TransferController::class, 'storeTransfer'])->name('store-transfer');
        Route::POST('/transfers', [TransferController::class, 'showTransfers'])->name('show-transfers');
        Route::POST('/transfer/items', [TransferController::class, 'getTransferItems'])->name('transfer-items');
        Route::POST('/transfer/status', [TransferController::class, 'updateTransferStatus'])->name('update-transfer-status');

        Route::POST('/logout',[AuthenticationController::class, 'logout'])->name('logout');

        Route::GET('/transactions',[PaymentController::class, 'gotoTransactions'])->name('transactions');
        Route::GET('/cheques',[PaymentController::class, 'gotoCheques'])->name('cheques');
        Route::POST('/cheques',[PaymentController::class, 'showCheques'])->name('show-cheques');
        Route::POST('/transactions',[PaymentController::class, 'showTransactions'])->name('show-transactions');

        Route::GET('/expenses',[ExpenseController::class, 'gotoExpenses'])->name('expenses');
        Route::POST('/expenses',[ExpenseController::class, 'showExpenses'])->name('show-expenses');
        Route::POST('delete/expense',[ExpenseController::class, 'deleteExpense'])->name('delete-expense');
    });

});


/* Route Page Layouts */
// Route::group(['prefix' => 'page-layouts'], function () {
//     Route::get('collapsed-menu', [PageLayoutController::class, 'layout_collapsed_menu'])->name('layout-collapsed-menu');
//     Route::get('full', [PageLayoutController::class, 'layout_full'])->name('layout-full');
//     Route::get('without-menu', [PageLayoutController::class, 'layout_without_menu'])->name('layout-without-menu');
//     Route::get('empty', [PageLayoutController::class, 'layout_empty'])->name('layout-empty');
//     Route::get('blank', [PageLayoutController::class, 'layout_blank'])->name('layout-blank');
// });
/* Route Page Layouts */

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
    Route::get('account-settings-account', [PagesController::class, 'account_settings_account'])->name('page-account-settings-account');
    Route::get('profile', [PagesController::class, 'profile'])->name('page-profile');

    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});

/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthenticationController::class, 'login_basic'])->name('auth-login-basic');

    Route::get('forgot-password-basic', [AuthenticationController::class, 'forgot_password_basic'])->name('auth-forgot-password-basic');
    Route::get('forgot-password-cover', [AuthenticationController::class, 'forgot_password_cover'])->name('auth-forgot-password-cover');
    Route::get('reset-password-basic', [AuthenticationController::class, 'reset_password_basic'])->name('auth-reset-password-basic');
    Route::get('reset-password-cover', [AuthenticationController::class, 'reset_password_cover'])->name('auth-reset-password-cover');
    Route::get('verify-email-basic', [AuthenticationController::class, 'verify_email_basic'])->name('auth-verify-email-basic');
    Route::get('verify-email-cover', [AuthenticationController::class, 'verify_email_cover'])->name('auth-verify-email-cover');
    Route::get('two-steps-basic', [AuthenticationController::class, 'two_steps_basic'])->name('auth-two-steps-basic');
    Route::get('two-steps-cover', [AuthenticationController::class, 'two_steps_cover'])->name('auth-two-steps-cover');
    Route::get('register-multisteps', [AuthenticationController::class, 'register_multi_steps'])->name('auth-register-multisteps');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
});
/* Route Authentication Pages */
