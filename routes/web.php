<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeManageController;
use App\Http\Controllers\GeneralSettings;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SupplierController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:super-admin']], function () {
    Route::get('/add-user',[AdminController::class,'add_user'])->name('add.user');
    Route::post('/add-user',[AdminController::class,'add_user_store'])->name('store.user');
    Route::get('/user-list',[AdminController::class,'user_list'])->name('user.list');
});

Route::get('product/bulk', [ProductController::class,'bulk_product'])->name('product.add.bulk');
Route::post('product/bulk/post', [ProductController::class,'bulk_product_store'])->name('product.post.bulk');
Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);
Route::resource('brand', BrandController::class);
Route::get('barcode/print', [BarCodeController::class,'print'])->name('barcode.print');
Route::resource('barcode', BarCodeController::class);
Route::resource('sale', SaleController::class);
Route::get('/tax',[GeneralSettings::class,'tax'])->name('tax');
Route::match(['get','post'],'/site/setting',[GeneralSettings::class,'site_setting'])->name('site.setting');
Route::get('invoice/setting',[GeneralSettings::class,'invoice_setting'])->name('invoice.setting');
Route::post('/tax-store',[GeneralSettings::class,'tax_store'])->name('tax.store');

Route::group(['middleware' => ['role:store manager|super-admin']], function () {
    Route::post('/sale/post', [ProductController::class,'sale'])->name('sale');
    Route::get('/sale/invoice/print/{id}', [PosController::class,'invoicePrint'])->name('invoice.print');
    Route::get('/sale/invoice/export/{id}', [PosController::class,'export'])->name('invoice.export');
    Route::get('/sale/invoice/{id}', [PosController::class,'print'])->name('invoice');
    Route::post('/sale/invoice/update/{id}', [PosController::class,'invoice_update'])->name('invoice.update');
    Route::get('/sale/invoice/view/{id}', [PosController::class,'invoice_view'])->name('invoice.view');
    Route::get('/sale/invoice/delete/{id}', [PosController::class,'invoice_delete'])->name('invoice.delete');
    // Route::get('/sale/invoice/export', [PosController::class,'export'])->name('invoice.export');
    Route::get('product-report',[ReportController::class,'productReport'])->name('product.report');
    Route::get('sale-report',[ReportController::class,'saleReport'])->name('sale.report');
    Route::get('salary-report',[ReportController::class,'salaryReport'])->name('salary.report');
    Route::resource('employe', EmployeManageController::class);
    Route::resource('salary', SalaryController::class);
    Route::resource('supplier', SupplierController::class);
    Route::get('email/send',[SocialController::class,'email_send'])->name('email.send');
    Route::get('email/tempalte/create',[SocialController::class,'email_template_create'])->name('email.create');

});

require __DIR__.'/auth.php';
