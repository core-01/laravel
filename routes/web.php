<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\adminAuthController;
use App\Http\Controllers\FrontViewController;
use App\Http\Controllers\ApplyLoanController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\customerAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DistributeViewController;
use App\Http\Controllers\DistributorAuth;
use App\Http\Controllers\EmiPayController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\AutoLoadController;
use App\Http\Controllers\TextReportActionController;
use App\Http\Controllers\TextReportPDFController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogAdminController;


// =============================
// Admin Authentication
// =============================
Route::get('admin-login', [AdminViewController::class, 'adminLogin'])->name('admin-login');
Route::post('adminLogin', [adminAuthController::class, 'login']);

Route::group(['middleware' => 'adminAuth'], function () {

    // ✅ Dashboard
    Route::get('admin-dashboard', [AdminViewController::class, 'adminDashboard'])->name('admin-dashboard');

    // ✅ Loan & EMI routes
    Route::get('loanrequest', [AdminViewController::class, 'loanrequest'])->name('loanrequest');
    Route::get('loan-approved', [AdminViewController::class, 'loanAproved'])->name('loan-approved');
    Route::get('due-emi', [AdminViewController::class, 'dueEmi'])->name('due-emi');
    Route::get('paid-emi', [AdminViewController::class, 'paidEmi'])->name('paid-emi');
    Route::get('register-distributor', [AdminViewController::class, 'distributor'])->name('distributor');

    // ✅ Admin Management
    Route::get('admin/admin', [AdminViewController::class, 'adminView']);
    Route::get('add-new-admin', [AdminViewController::class, 'admin']);
    Route::get('update-admin/{id}', [AdminViewController::class, 'updateAdmin']);
    Route::post('add-admin', [adminAuthController::class, 'addAdmin']);
    Route::post('updateAdmin', [adminAuthController::class, 'updateAdmin']);
    Route::get('delete-admin/{id}', [adminAuthController::class, 'deleteAdmin']);

    // ✅ Queries
    Route::get('queries', [AdminViewController::class, 'queries']);

    // ✅ Excel Import
    Route::get('excel-file', [AdminViewController::class, 'addExcelFile'])->name('excel-file');
    // Route::get('excel-emi',[AdminViewController::class,'addExcalEmi'])->name('excel-emi'); // ❌ Not used

    // ✅ Change Password / Logout
    Route::get('change-password', [AdminViewController::class, 'changePassword'])->name('change-password');
    Route::get('logout', [adminAuthController::class, 'logout'])->name('logout');

    // ✅ Blog Feature (Fixed Middleware)
    Route::prefix('admin')->group(function () {
        Route::resource('blogs', BlogAdminController::class)->names('admin.blogs');
    });

    // ----------------------------------------
    // ❌ Unused or Deprecated Admin Routes
    // ----------------------------------------
    // Route::match(['get','post'],'emi-transaction-history',[AdminViewController::class,'emiTransactionHistory']);
    // Route::post('upload-term-n-condition',[ApplyLoanController::class ,'uploadTermNCondition']);
    // Route::post('importData',[ExcelController::class , 'importData']);
    // Route::post('importEMI',[ExcelController::class , 'importEMI']);
    // Route::get('excel-Download',[ExcelController::class , 'getDownload']);
    // Route::match(['post','get'],'view-and-Pay',[AdminViewController::class,'viewAndPayEMI']);
    // Route::get('view-file',[AdminViewController::class , 'viewFile']);
    // Route::get('view-adn-pay/{loan_request_number}',[AdminViewController::class , 'viewAndPay']);
    // Route::get('emi-details',[AdminViewController::class , 'emiDetails'])->name('emi-details');
    // Route::put('approvedloan',[ApplyLoanController::class,'approvedloan']);
    // Route::get('active-distributor/{id}',[DistributorController::class,'activeDistributor']);
    // Route::post('adminpaidEmi',[EmiPayController::class,'adminpaidEmi']);
    // Route::post('adminpaidEmi1',[EmiPayController::class,'adminpaidEmi1']);
    // Route::get('Approved-loan/{id}', [AdminViewController::class, 'ApprovedLoan'])->name('Approved-loan');
    // Route::post('updatePassword', [adminAuthController::class, 'updatePassword']);
    // Route::get('filter-data',[ApplyLoanController::class,'filterdata']);
    // Route::post('admin/bank-details-update',[ApplyLoanController::class,'bankDupdate']);
    // Route::get('filter-data-by-date',[ApplyLoanController::class,'filterdatabydate']);
    // Route::post('distributor-register',[DistributorController::class,'distributorRegister']);
    // Route::get('get-statement',[AdminViewController::class,'getStatement']);
});


// =============================
// Blog Routes (Visitor Side)
// =============================
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');


// =============================
// Frontend Routes
// =============================
Route::get('/', [FrontViewController::class, 'index'])->name('index');
Route::get('about-us', [FrontViewController::class, 'aboutUs'])->name('about-us');
Route::get('apply-loan', [FrontViewController::class, 'applyLoan'])->name('apply-loan');
Route::get('apply-loanbackup', [FrontViewController::class, 'applyLoanBackup'])->name('apply-loanbackup');
Route::get('apply-now', [FrontViewController::class, 'applyNow'])->name('apply-now');
Route::get('contact-us', [FrontViewController::class, 'contactUs'])->name('contact-us');
Route::get('eligibility', [FrontViewController::class, 'eligibility'])->name('eligibility');
Route::get('register', [FrontViewController::class, 'register'])->name('register');

Route::post('applyloan', [ApplyLoanController::class, 'applyloan']);
Route::post('contactForm', [ContactController::class, 'contactForm']);

// ✅ Customer Auth
Route::post('customerLogin', [customerAuthController::class, 'customerLogin']);
Route::get('customerLogout', [customerAuthController::class, 'customerLogout']);

// ✅ Distributor login
Route::get('distributor-login', [DistributeViewController::class, 'distLogin'])->name('distributor-login');
Route::post('dist-login', [DistributorAuth::class, 'distLogin']);

// Other routes unchanged...
// =============================
// AutoLoad & EMI-related Cron Routes
// =============================
Route::get('generateEmi',[AutoLoadController::class,'generateEmi']);
Route::get('checkDuedate',[AutoLoadController::class,'checkDuedate1']);
Route::get('sevenDayMessage',[AutoLoadController::class,'sevenDayMessage']);
Route::get('threeDayAgoMessage',[AutoLoadController::class,'threeDayAgoMessage']);
Route::get('sevenDayAfterMessage',[AutoLoadController::class,'sevenDayAfterMessage']);
Route::get('update-emi',[AutoLoadController::class,'updateEmi']);
Route::get('test',[AutoLoadController::class,'test']);

// =============================
// Frontend - Customer Section
// =============================
Route::group(['middleware'=>'customerAuth'],function(){
    Route::get('user-dashboard',[FrontViewController::class,'userDashboard'])->name('user-dashboard');
    Route::get('loan-details',[FrontViewController::class,'loanDetails'])->name('loan-details');
    Route::get('pay-emi',[FrontViewController::class,'payemi'])->name('pay-emi');
    Route::get('my-profile',[FrontViewController::class,'myProfile'])->name('my-profile');
    Route::get('transaction-history',[FrontViewController::class,'transectionHistory'])->name('transaction-history');
    Route::post('apply-now',[ApplyLoanController::class,'applyNow']);
    Route::get('bank-detail',[ApplyLoanController::class,'bankDetail']);
    Route::post('getbankDetail',[ApplyLoanController::class,'getbankDetail']);
    Route::get('emi',[FrontViewController::class,'customerEmi']);
    Route::match(['get','post'],'user-accept-tNc',[ApplyLoanController::class,'userAcceptTNc']);
});

// =============================
// File Upload and Customer EMI Routes
// =============================
Route::post('upload-pdf',[ApplyLoanController::class,'uploadPDF']);
Route::post('upload-image',[ApplyLoanController::class,'uploadImage']);
Route::post('upload-distributor-pdf',[DistributorController::class,'uploadDistributorPDF']);
Route::post('upload-distributor-image',[DistributorController::class,'uploadDistributorImage']);
Route::get('remove-files',[DistributorController::class,'removeFiles']);
Route::post('approved',[ApplyLoanController::class,'approved']);
Route::post('customer-paidEmi',[EmiPayController::class,'customerpaidEmi']);
Route::post('customer-pay-total-due-emi',[EmiPayController::class,'customerPayTotalDueEmi']);

// =============================
// Distributor Section
// =============================
Route::group(['middleware'=>'distibutorAuth'],function(){
    Route::get('view-files',[AdminViewController::class , 'viewFile']);
    Route::get('distributor-dashboard',[DistributeViewController::class,'distDashboard'])->name('distributor-dashboard');
    Route::get('add-user',[DistributeViewController::class,'addUser'])->name('add-user');
    Route::get('distributor-change-password',[DistributeViewController::class,'changePassword'])->name('distributor-change-password');
    Route::get('add-excel-file',[DistributeViewController::class,'addExcelFile'])->name('add-excel-file');
    Route::get('loan-status',[DistributeViewController::class,'loanStatus'])->name('loan-status');
    Route::get('file-view',[AdminViewController::class , 'viewFile']);
    Route::get('dist-logout',[DistributorAuth::class,'logout'])->name('dist-logout');
    Route::post('dist-password-change',[DistributorAuth::class,'updatePassword']);
});

// =============================
// Language and Forgot Password
// =============================
Route::get('language/{lan}',[FrontViewController::class , 'setLanguage']);
Route::get('forgot-password',[FrontViewController::class , 'forgotPassword']);
Route::get('distributor-forgot-password',[FrontViewController::class , 'distributorForgotPassword']);
Route::match(['get','post'],'update-password',[DistributorAuth::class , 'forgetpasswordDestributor']);
Route::match(['get','post'],'customer-forgot-password',[customerAuthController::class , 'customerForgotPassword']);

// =============================
// PDF Reports
// =============================
Route::get('generate-pdf', [TextReportPDFController::class, 'generatePDF']);
Route::get('report', [TextReportActionController::class, 'showReport'])->name('admin.report');
Route::get('populate-report', [TextReportActionController::class,'populateReport'])->name('populate-report');
Route::post('edit-report', [TextReportActionController::class,'editReport'])->name('edit-report');
Route::post('add-report', [TextReportActionController::class,'addReport'])->name('add-report');
Route::delete('/delete/report/{id}', [TextReportActionController::class, 'delete'])->name('delete.report');
