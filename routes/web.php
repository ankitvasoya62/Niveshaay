<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SubscriptionDetailsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\OurResearches;
use App\Http\Controllers\ImportExcel;
use App\Http\Controllers\contactUsController;
use App\Http\Controllers\ShareDetailsController;
use App\Http\Controllers\ViewSubscriptionDetailsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ComplaintStatusController;
use App\Http\Controllers\OurClientSayManagementController;
use App\Http\Controllers\FeaturedOnController;
use App\Http\Controllers\TweeterFeedController;
use App\Http\Controllers\ResearchImageController;
use App\Http\Controllers\NewsLetterManagementController;
use App\Http\Controllers\DisclosureController;
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
/* Frontend Routes  */
Route::get('/',[HomeController::class, 'index'])->name('frontend.home');
Route::get('/contact',[HomeController::class, 'contact'])->name('frontend.contact');
Route::get('/about',[HomeController::class, 'about'])->name('frontend.about');
Route::get('/disclosure',[HomeController::class,'disclosure'])->name('frontend.disclosure');
Route::get('/signup',[HomeController::class, 'signUp'])->name('frontend.signup');
Route::get('/our-strategy',[HomeController::class, 'ourStrategy'])->name('frontend.our-strategy');
/* Contact page post request */
Route::post('/contact',[HomeController::class, 'contactForm'])->name('frontend.contactForm');
Route::get('/services/{id?}',[HomeController::class, 'Services'])->name('frontend.services');

Route::get('/generate_pdf',[HomeController::class,'generatePDF'])->name('generate-pdf');
Route::get('/invoice_pdf',[HomeController::class,'invoicePDF'])->name('invoice-pdf');

Route::get('/show-pdf-html',[HomeController::class,'generateMailPDF']);
// Route::view('/subscription-form','frontend.subscription-form')->name('frontend.subscriptionForm');
// Route::view('/advisor-agreement','frontend.advisor-agreement')->name('frontend.advisor-agreement');

// /*Import Excel Route */
// Route::get('/excel',[App\Http\Controllers\ImportExcel::class, 'index']);
// Route::post('/excel',[App\Http\Controllers\ImportExcel::class, 'store'])->name('import');

Route::view('/admin-login', 'backend.adminLogin')->name('admin.loginform')->middleware('guest:admin');
Route::view('/expire', 'frontend.subscription-expired')->name('frontend.subscriptionExpire');
Route::post('/admin-login', [LoginController::class, 'AdminLogin'])->name('admin.login')->middleware('guest:admin');
Route::post('/user/register', [LoginController::class, 'registerUser'])->name('user.register');
Auth::routes([
    'login'=>false
]);
Route::post('/front-login',[LoginController::class,'login'])->name('login');
Route::get('/login', function () {
    return redirect()->route('frontend.home');
});
Route::get('/forgot-password',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password',[ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}',[ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',[ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('admin/forgot-password',[ForgotPasswordController::class, 'showadminRequestForm'])->name('admin.password.request');
Route::get('/researchreport/{id}',[HomeController::class,'viewShare'])->name('frontend.view.share');        
Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->middleware('is_admin')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController ::class, 'index'])->name('admin.home');
        Route::get('/change-password',[App\Http\Controllers\HomeController ::class, 'showchangepasswordform'])->name('admin.showchangepassword');
        Route::post('/change-password',[App\Http\Controllers\HomeController ::class, 'changepassword'])->name('admin.changepassword');
        Route::get('/researches', [OurResearches::class, 'listResearches'])->name('admin.research');
        Route::get('/add-research', [OurResearches::class, 'addResearches'])->name('admin.add-research');
        Route::post('/add-research', [OurResearches::class, 'storeResearches'])->name('admin.store-research');
        Route::get('/edit-research/{id}', [OurResearches::class, 'editResearch'])->name('admin.edit-research');
        Route::post('/edit-research/{id}', [OurResearches::class, 'updateResearch'])->name('admin.update-research');
        Route::get('/delete-research/{id}', [OurResearches::class, 'deleteResearch'])->name('admin.delete-research');
        Route::get('/users',[UserController::class,'index'])->name('admin.users');
        Route::get('/add-user',[UserController::class,'create'])->name('admin.add.users');
        Route::post('/add-user',[UserController::class,'store'])->name('admin.store.users');
        Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('admin.edit-user');
        Route::post('/edit-user/{id}', [UserController::class, 'update'])->name('admin.update-user');
        Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('admin.delete-user');
        Route::get('/admin-users',[UserController::class,'adminUsers'])->name('admin.admin-users');
        Route::get('/add-admin-user',[UserController::class,'createAdminUser'])->name('admin.add.admin-user');
        Route::post('/add-admin-user',[UserController::class,'storeAdminUser'])->name('admin.store.admin-user');
        Route::get('/edit-admin-user/{id}', [UserController::class, 'editAdminUser'])->name('admin.edit.admin-user');
        Route::post('/edit-admin-user/{id}', [UserController::class, 'updateAdminUser'])->name('admin.update.admin-user');
        Route::get('/delete-admin-user/{id}', [UserController::class, 'deleteAdminUser'])->name('admin.delete.admin-user');
        Route::get('/download/excel/user',[UserController::class, 'downloadUserExcel'])->name('admin.download.user-excel');
        Route::get('/contacts',[contactUsController::class,'contactUsList'])->name('admin.contacts');
        Route::get('/showcontact/{id}',[contactUsController::class,'showContact'])->name('admin.showContact');
        Route::get('/contacts/trash',[contactUsController::class,'trash'])->name('admin.contact.trash');
        Route::get('/contact/restore/{id}',[contactUsController::class,'restore'])->name('admin.contact.restore');
        Route::get('/contact/permanentdelete/{id}',[contactUsController::class,'permanentDelete'])->name('admin.contact.permanent-delete');
        Route::get('/deletecontact/{id}',[contactUsController::class,'deleteContact'])->name('admin.deleteContact');
        Route::get('/downloadcontact',[contactUsController::class,'downloadContactExcel'])->name('admin.download.contact-excel');
        /*Share Management Route */
        Route::get('/researchreport',[ShareDetailsController::class,'listShare'])->name('admin.share');
        Route::get('/add/researchreport/{upload_type}',[ShareDetailsController::class,'addShare'])->name('admin.add.share');
        Route::post('/add/researchreport/{upload_type}',[ShareDetailsController::class,'storeShare'])->name('admin.store.share');
        Route::get('/edit/researchreport/{id}',[ShareDetailsController::class,'editShare'])->name('admin.edit.share');
        Route::post('/edit/researchreport/{id}',[ShareDetailsController::class,'updateShare'])->name('admin.update.share');
        Route::get('/delete/researchreport/{id}', [ShareDetailsController::class, 'deleteShare'])->name('admin.delete.share');
        Route::get('/view/researchreport/{id}', [ShareDetailsController::class, 'viewShare'])->name('admin.view.report');
        Route::post('/upload/report',[ShareDetailsController::class,'storeImages'])->name('admin.upload.image');
        Route::get('/researchreport/trash',[ShareDetailsController::class,'trash'])->name('admin.report.trash');
        Route::get('/researchreport/restore/{id}',[ShareDetailsController::class,'restore'])->name('admin.report.restore');
        Route::get('/researchreport/permanentdelete/{id}',[ShareDetailsController::class,'permanentDelete'])->name('admin.report.permanent-delete');
        /*Import Excel Route */
        Route::get('/excel',[ImportExcel::class, 'index'])->name('import-excel');
        Route::post('/excel',[ImportExcel::class, 'store'])->name('import');
        /*Subscription Detail Route */
        Route::get('/subscription-detail',[ViewSubscriptionDetailsController::class,'viewSubscriptionDetails'])->name('admin.subscription-details');
        Route::get('/excel/download',[ViewSubscriptionDetailsController::class,'downloadExcel'])->name('download.excel');
        Route::get('/view-subscription/{id}',[ViewSubscriptionDetailsController::class,'showDetails'])->name('admin.show-details');
        Route::get('/delete-subscription/{id}',[ViewSubscriptionDetailsController::class,'deleteSubscriptionDetails'])->name('admin.delete-subscription');
        Route::get('/edit-subscription/{id}',[ViewSubscriptionDetailsController::class,'editSubscriptionDetails'])->name('admin.edit-subscription');
        Route::post('/update-subscription/{id}',[ViewSubscriptionDetailsController::class,'updateSubscriptionDetails'])->name('admin.update-subscription');
        Route::post('/verify-subscription',[ViewSubscriptionDetailsController::class,'verifySubscriptionDetails'])->name('admin.verify-subscription');
        Route::post('/payment-received/{id}',[ViewSubscriptionDetailsController::class,'paymentReceivedAction'])->name('admin.payment-received');
        Route::get('/subscription-detail/trash',[ViewSubscriptionDetailsController::class,'trash'])->name('admin.subscription-detail.trash');
        Route::get('/subscription-detail/restore/{id}',[ViewSubscriptionDetailsController::class,'restore'])->name('admin.subscription-detail.restore');
        Route::get('/subscription-detail/permanentdelete/{id}',[ViewSubscriptionDetailsController::class,'permanentDelete'])->name('admin.subscription-detail.permanent-delete');

        Route::get('/invoice-details/{id}',[ViewSubscriptionDetailsController::class,'viewinvoicedetails'])->name('admin.view.invoicedetails');
        Route::get('/download/invoice/{id}',[ViewSubscriptionDetailsController::class,'downloadinvoice'])->name('admin.download.invoice');
        Route::get('/edit/invoice/{id}',[ViewSubscriptionDetailsController::class,'editinvoice'])->name('admin.edit.invoice');
        Route::post('/update/invoice/{id}',[ViewSubscriptionDetailsController::class,'updateinvoice'])->name('admin.update.invoice');
        Route::get('/download/pdf/invoice/{id}',[ViewSubscriptionDetailsController::class,'generatePdf'])->name('admin.download.invoicepdf');
        Route::get('/download/pdf/agreement/{id}',[ViewSubscriptionDetailsController::class,'agreementPdf'])->name('admin.download.agreementpdf');
        Route::get('/download/pdf/riskprofile/{id}',[ViewSubscriptionDetailsController::class,'riskProfilePdf'])->name('admin.download.riskprofilingpdf');

        
        
        /*Subscription Detail Route */
        Route::get('/invoice', [InvoiceController::class,'index'])->name('admin.invoice');
        Route::get('/invoice/add', [InvoiceController::class,'add'])->name('admin.invoice.add');
        Route::post('/invoice/store', [InvoiceController::class,'store'])->name('admin.invoice.store');
        Route::get('/invoice/edit/{id}', [InvoiceController::class,'edit'])->name('admin.invoice.edit');
        Route::post('/invoice/update/{id}', [InvoiceController::class,'update'])->name('admin.invoice.update');
        Route::get('/invoice/delete/{id}', [InvoiceController::class,'delete'])->name('admin.invoice.delete');
        Route::get('/invoice/user/{id}',[InvoiceController::class,'userSubscriptionRecord'])->name('admin.invoice.users');
        Route::get('/invoice/download/{id}',[InvoiceController::class,'downloadInvoiceById'])->name('admin.invoice.download');
        Route::get('/invoice/trash',[InvoiceController::class,'trash'])->name('admin.invoice.trash');
        Route::get('/invoice/restore/{id}',[InvoiceController::class,'restore'])->name('admin.invoice.restore');
        Route::get('/invoice/permanentdelete/{id}',[InvoiceController::class,'permanentDelete'])->name('admin.invoice.permanent-delete');

        Route::get('/complaint-status/current-month',[ComplaintStatusController::class,'currentMonth'])->name('admin.currentmonthcomplaint');
        Route::post('/complaint-status/store/current-month',[ComplaintStatusController::class,'storeCurrentMonth'])->name('admin.storecurrentmonthcomplaint');

        Route::get('/complaint-status/monthly',[ComplaintStatusController::class,'Monthly'])->name('admin.monthlycomplaint');
        Route::post('/complaint-status/store/monthly',[ComplaintStatusController::class,'storeMonthly'])->name('admin.storemonthlycomplaint');

        Route::get('/complaint-status/annually',[ComplaintStatusController::class,'Anually'])->name('admin.anuallycomplaint');
        Route::post('/complaint-status/store/annually',[ComplaintStatusController::class,'storeAnnually'])->name('admin.storeannuallycomplaint');

        Route::get('/our-client',[OurClientSayManagementController::class,'index'])->name('admin.our-clients');
        Route::get('/our-client/add',[OurClientSayManagementController::class,'create'])->name('admin.add.our-clients');
        Route::post('/our-client/store',[OurClientSayManagementController::class,'store'])->name('admin.store.our-clients');

        Route::get('/our-client/edit/{id}',[OurClientSayManagementController::class,'edit'])->name('admin.edit.our-clients');
        Route::post('/our-client/update/{id}',[OurClientSayManagementController::class,'update'])->name('admin.update.our-clients');

        Route::get('/our-client/delete/{id}',[OurClientSayManagementController::class,'destroy'])->name('admin.delete.our-clients');
        Route::get('/our-client/move-up/{id}',[OurClientSayManagementController::class,'moveup'])->name('admin.moveup.our-clients');
        Route::get('/our-client/move-down/{id}',[OurClientSayManagementController::class,'movedown'])->name('admin.movedown.our-clients');

        Route::get('/our-client/trash',[OurClientSayManagementController::class,'trash'])->name('admin.our-client.trash');
        Route::get('/our-client/restore/{id}',[OurClientSayManagementController::class,'restore'])->name('admin.our-client.restore');
        Route::get('/our-client/permanentdelete/{id}',[OurClientSayManagementController::class,'permanentDelete'])->name('admin.our-client.permanent-delete');

        Route::get('/featured-on',[FeaturedOnController::class,'index'])->name('admin.featured-on');
        Route::get('/featured-on/add',[FeaturedOnController::class,'create'])->name('admin.add.featured-on');
        Route::post('/featured-on/store',[FeaturedOnController::class,'store'])->name('admin.store.featured-on');

        Route::get('/featured-on/edit/{id}',[FeaturedOnController::class,'edit'])->name('admin.edit.featured-on');
        Route::post('/featured-on/update/{id}',[FeaturedOnController::class,'update'])->name('admin.update.featured-on');
        Route::get('/featured-on/delete/{id}',[FeaturedOnController::class,'destroy'])->name('admin.delete.featured-on');
        Route::get('/featuredon/move-up/{id}',[FeaturedOnController::class,'moveup'])->name('admin.moveup.featured-on');
        Route::get('/featuredon/move-down/{id}',[FeaturedOnController::class,'movedown'])->name('admin.movedown.featured-on');

        Route::get('/featured-on/trash',[FeaturedOnController::class,'trash'])->name('admin.featured-on.trash');
        Route::get('/featured-on/restore/{id}',[FeaturedOnController::class,'restore'])->name('admin.featured-on.restore');
        Route::get('/featured-on/permanentdelete/{id}',[FeaturedOnController::class,'permanentDelete'])->name('admin.featured-on.permanent-delete');

        Route::get('/tweeter-feeds',[TweeterFeedController::class,'index'])->name('admin.tweeter-feeds');
        Route::get('/tweeter-feeds/add',[TweeterFeedController::class,'create'])->name('admin.add.tweeter-feeds');
        Route::post('/tweeter-feeds/store',[TweeterFeedController::class,'store'])->name('admin.store.tweeter-feeds');
        Route::get('/tweeter-feeds/edit/{id}',[TweeterFeedController::class,'edit'])->name('admin.edit.tweeter-feeds');
        Route::post('/tweeter-feeds/update/{id}',[TweeterFeedController::class,'update'])->name('admin.update.tweeter-feeds');
        Route::get('/tweeter-feeds/delete/{id}',[TweeterFeedController::class,'destroy'])->name('admin.delete.tweeter-feeds');
        Route::get('/tweeter-feeds/move-up/{id}',[TweeterFeedController::class,'moveup'])->name('admin.moveup.tweeter-feeds');
        Route::get('/tweeter-feeds/move-down/{id}',[TweeterFeedController::class,'movedown'])->name('admin.movedown.tweeter-feeds');
        Route::get('/tweeter-feeds/trash',[TweeterFeedController::class,'trash'])->name('admin.tweeter-feeds.trash');
        Route::get('/tweeter-feeds/restore/{id}',[TweeterFeedController::class,'restore'])->name('admin.tweeter-feeds.restore');
        Route::get('/tweeter-feeds/permanentdelete/{id}',[TweeterFeedController::class,'permanentDelete'])->name('admin.tweeter-feeds.permanent-delete');

        Route::get('/report-images',[ResearchImageController::class,'index'])->name('admin.report-images');
        Route::get('/report-images/add',[ResearchImageController::class,'create'])->name('admin.add.report-images');
        Route::post('/report-images/store',[ResearchImageController::class,'store'])->name('admin.store.report-images');
        Route::get('/report-images/edit/{id}',[ResearchImageController::class,'edit'])->name('admin.edit.report-images');
        Route::post('/report-images/update/{id}',[ResearchImageController::class,'update'])->name('admin.update.report-images');
        Route::get('/report-images/delete/{id}',[ResearchImageController::class,'destroy'])->name('admin.delete.report-images');
        Route::get('/report-images/show/{id}',[ResearchImageController::class,'show'])->name('admin.show.report-images');
        Route::get('/report-images/delete-image/{id}',[ResearchImageController::class,'deletedByImage'])->name('admin.deleteimages.report-images');

        /* Newsletter users Route */
        Route::get('/newsletter/users',[NewsLetterManagementController::class,'newsletterusers'])->name('admin.newsletter.users');
        Route::get('/newsletter/users/add',[NewsLetterManagementController::class,'addnewsletterusers'])->name('admin.newsletter.add.users');
        Route::post('/newsletter/users/store',[NewsLetterManagementController::class,'storenewsletterusers'])->name('admin.newsletter.store.users');
        Route::get('/newsletter/users/edit/{id}',[NewsLetterManagementController::class,'editnewsletteruser'])->name('admin.newsletter.edit.users');
        Route::post('/newsletter/users/update/{id}',[NewsLetterManagementController::class,'updatenewsletteruser'])->name('admin.newsletter.update.users');
        Route::get('/newsletter/users/delete/{id}',[NewsLetterManagementController::class,'deletenewsletteruser'])->name('admin.newsletter.delete.users');

        /* Newsletter Route */
        Route::get('/newsletter',[NewsLetterManagementController::class,'newsletters'])->name('admin.newsletter');
        Route::get('/newsletter/add',[NewsLetterManagementController::class,'addnewsletters'])->name('admin.newsletter.add');
        Route::post('/newsletter/store',[NewsLetterManagementController::class,'storenewsletters'])->name('admin.newsletter.store');
        Route::get('/newsletter/edit/{id}',[NewsLetterManagementController::class,'editnewsletters'])->name('admin.newsletter.edit');
        Route::post('/newsletter/update/{id}',[NewsLetterManagementController::class,'updatenewsletters'])->name('admin.newsletter.update');
        Route::get('/newsletter/show/{id}',[NewsLetterManagementController::class,'shownewsletter'])->name('admin.newsletter.show');
        Route::get('/newsletter/delete/{id}',[NewsLetterManagementController::class,'deletenewsletter'])->name('admin.newsletter.delete');
        Route::get('/newsletter/trash',[NewsLetterManagementController::class,'trash'])->name('admin.newsletter.trash');
        Route::get('/newsletter/restore/{id}',[NewsLetterManagementController::class,'restore'])->name('admin.newsletter.restore');
        Route::get('/newsletter/permanentdelete/{id}',[NewsLetterManagementController::class,'permanentDelete'])->name('admin.newsletter.permanent-delete');

        Route::get('/newsletter/trashnewsusers',[NewsLetterManagementController::class,'trashnewsusers'])->name('admin.newsletteruser.trashnewsusers');
        Route::get('/newsletter/restorenewsusers/{id}',[NewsLetterManagementController::class,'restorenewsusers'])->name('admin.newsletteruser.restorenewsusers');
        Route::get('/newsletter/permanentdeletenewsusers/{id}',[NewsLetterManagementController::class,'permanentDeletenewsusers'])->name('admin.newsletteruser.permanent-deletenewsusers');

        Route::get('/newsletter/send',[NewsLetterManagementController::class,'sendnewsletter'])->name('admin.newsletter.send');
        Route::post('/newsletter/send/mail',[NewsLetterManagementController::class,'sendnewslettermail'])->name('admin.newsletter.send.mail');
        Route::get('/newsletter/bulk-import',[NewsLetterManagementController::class,'bulknewsletteruser'])->name('admin.newsletter.bulk.user');
        Route::post('/newsletter/bulk-import-post',[NewsLetterManagementController::class,'storebulknewsletteruser'])->name('admin.newsletter.storebulk.user');

        Route::get('/newsletter/user/active/{id}',[NewsLetterManagementController::class,'activenewsletteruser'])->name('admin.newsletter.active.user');
        Route::get('/newsletter/user/deactive/{id}',[NewsLetterManagementController::class,'deactivenewsletteruser'])->name('admin.newsletter.deactive.user');

        Route::get('/disclosure',[DisclosureController::class,'index'])->name('admin.disclosure');
        Route::get('/disclosure/add',[DisclosureController::class,'create'])->name('admin.disclosure.add');
        Route::post('/disclosure/store',[DisclosureController::class,'store'])->name('admin.disclosure.store');
        Route::get('/disclosure/edit/{id}',[DisclosureController::class,'edit'])->name('admin.disclosure.edit');
        Route::post('/disclosure/update/{id}',[DisclosureController::class,'update'])->name('admin.disclosure.update');
        Route::get('/disclosure/delete/{id}',[DisclosureController::class,'destroy'])->name('admin.disclosure.delete');
        Route::get('/disclosure/trash',[DisclosureController::class,'trash'])->name('admin.disclosure.trash');
        Route::get('/disclosure/restore/{id}',[DisclosureController::class,'restore'])->name('admin.disclosure.restore');
        Route::get('/disclosure/permanentdelete/{id}',[DisclosureController::class,'permanentDelete'])->name('admin.disclosure.permanent-delete');
    });
    // Route::middleware(['subscription_expired'])->group(function () {
    //     Route::get('/profile',[HomeController::class, 'userProfile'])->name('frontend.profile');
    //     Route::post('/edit/profile',[HomeController::class, 'editProfile'])->name('frontend.editprofile');
    //     Route::middleware('is_payment_received')->group(function () {
    //         Route::get('/dashboard',[HomeController::class,'shareDetail'])->name('frontend.share-detail');
            
    //     });
        
    // });
    // Route::get('/subscription-form',[SubscriptionDetailsController::class,'subscriptionForm'])->name('frontend.subscriptionForm');
    // Route::post('/store/subscription-detail',[SubscriptionDetailsController::class,'storeDetails'])->name('store.subscription-details');
    // Route::get('/advisor-agreement',[SubscriptionDetailsController::class,'advisorAgreement'])->name('frontend.advisor-agreement');
    // Route::get('/research-dashboard',[HomeController::class, 'researchDashboard'])->name('frontend.research-dashboard');
    // Route::post('/sendOtp',[SubscriptionDetailsController::class,'sendOtp'])->name('frontend.sendotp');
    // Route::post('/verifyOtp',[SubscriptionDetailsController::class,'verifyOtp'])->name('frontend.verifyotp');
    
});
Route::middleware('auth')->group(function () {
    
    Route::middleware(['is_front_user'])->group(function () {
        Route::middleware(['subscription_expired'])->group(function () {
            Route::get('/profile',[HomeController::class, 'userProfile'])->name('frontend.profile');
            Route::post('/edit/profile',[HomeController::class, 'editProfile'])->name('frontend.editprofile');
            Route::middleware('is_payment_received')->group(function () {
                Route::get('/dashboard',[HomeController::class,'shareDetail'])->name('frontend.share-detail');
                Route::get('/pdfreport/{id}',[HomeController::class,'generatewatermarkpdf'])->name('frontend.generate-pdfwatermark');
            });
            
        });
        Route::get('/subscription-form/{id?}',[SubscriptionDetailsController::class,'subscriptionForm'])->name('frontend.subscriptionForm');
        Route::post('/store/subscription-detail',[SubscriptionDetailsController::class,'storeDetails'])->name('store.subscription-details');
        Route::post('/store/compamysubscription-detail',[SubscriptionDetailsController::class,'storeCompanyDetails'])->name('store.companysubscription-details');
        Route::get('/advisor-agreement',[SubscriptionDetailsController::class,'advisorAgreement'])->name('frontend.advisor-agreement');
        Route::get('/research-dashboard',[HomeController::class, 'researchDashboard'])->name('frontend.research-dashboard');
        Route::post('/sendOtp',[SubscriptionDetailsController::class,'sendOtp'])->name('frontend.sendotp');
        Route::post('/verifyOtp',[SubscriptionDetailsController::class,'verifyOtp'])->name('frontend.verifyotp');
        Route::get('/change-password',[HomeController::class,'changePasswordForm'])->name('frontend.changepasswordform');            
        Route::post('/change-password',[HomeController::class,'changePassword'])->name('frontend.changepassword');
    });
    
});
