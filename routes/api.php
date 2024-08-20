<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\CheckInOutController;
use App\Http\Controllers\Front\CompanyController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiAuthenticate;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware([ApiAuthenticate::class])->prefix('user')->group(function () {

    Route::get('/', function (Request $request) {
        return response()->json(['data' => Auth::guard('sanctum')->user()], 200);
    });

    Route::post('change-status',[CompanyController::class , 'changeStatus2'])->name('changeStatus');

    Route::controller(ProfileController::class)->group(function () {
        Route::middleware('checkrole:3')->group(function () {
            // Worker routes
            Route::post('/worker-profile', 'workerProfileUpdate');
            Route::get('/get-worker-profile', 'getWorkerProfile');
            Route::get('/worker-view-profile', 'workerViewProfile');
            Route::post('/upload-worker-image', 'uploadWorkerImage');
            Route::get('/get-work-history', 'getWorkHistoryID');
            Route::post('/my-work-service', 'getMyWork');
            Route::post('/post-favourite', 'postFavourite');
            Route::get('/get-favourite', 'getFavourite');
            Route::post('/get-past-shift', 'getPastShift');
            Route::post('/get-future-shift', 'getFutureShift');
        });

        Route::middleware('checkrole:2')->group(function () {
            Route::post('/company-profile', 'companyProfileUpdate');
            Route::get('/get-company-profile', 'getCompanyEditProfile');
            Route::post('/change-password', 'changePassword');
            Route::post('/security-question', 'securityQuestion');
            Route::post('/get-shift-history', 'getShiftHistory');
            Route::post('/two-step-verification', 'twoStepVerification');
            Route::get('/view-worker-by-company/{id}', 'getViewWorkerByCompany');
        });


        Route::get('/get-notifications', 'getNotifications');
        Route::post('/mark-as-read', 'markAsRead');
    });

    Route::controller(ServicesController::class)->group(function () {
        Route::middleware('checkrole:2')->group(function () {
            Route::post('/add-service-1', 'addService1');
            Route::post('/add-service-2/{id}', 'addService2');
            Route::post('/add-service-3/{id}', 'addService3');
            Route::post('/add-service-4/{id}', 'addService4');
            Route::post('/edit-service', 'editService');
            Route::get('/delete-service/{id}', 'deleteService');
            Route::get('/get-service-user', 'getServiceByUserID');
            Route::get('/applicant-requests', 'getApplicantRequests');
            Route::post('/search-applicants', 'searchApplicants');
        });
        // Route::get('/get-service/{id}', 'getServiceByID');
        // Route::get('/get-all-service', 'getAllService');
        Route::middleware('checkrole:3')->group(function () {
            Route::post('/post-offer-letter', 'postOfferLetter');
            Route::post('/apply-service', 'applyService');
        });

        Route::post('/get-offer-letter', 'getOfferLetter');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::post('/stripe/charge', 'createCharge');
        Route::post('/stripe/payment-intent', 'createPaymentIntent');
        Route::post('/stripe/payment', 'createPaymentIntent');
        Route::post('/withdraw-amount', 'withdrawAmount');
        Route::post('/add-card', 'addCard');
        Route::post('/edit-card', 'editCard');
        Route::get('/delete-card/{id}', 'deleteCard');
        Route::get('/get-card-details/{id?}', 'getCardDetails');
        Route::get('/get-offer', 'getOffer');
        Route::get('/withdraw-detail/{id}', 'getWithdrawDetail');
        Route::get('/get-balance', 'getBalance');
    });
    
    Route::controller(ContractController::class)->group(function () {
        Route::middleware('checkrole:2')->group(function () {
            Route::post('/contract-terms', 'getContractTerms');
            Route::post('/post-contract-terms', 'postContractTerms');
        });
    });

    Route::controller(CheckInOutController::class)->group(function () {
        Route::middleware('checkrole:3')->group(function () {
            Route::get('/shifts', 'index');
            Route::post('/checkin', 'checkIn');
            Route::post('/checkout/{id}', 'checkOut');
            Route::post('/cancel-shift', 'check_in_cancel');
        });
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::post('/post-rate', 'postRate');
        Route::get('/get-workers', 'getWorkers');
    });

    Route::controller(MessageController::class)->group(function () {
        Route::post('/send-message', 'sendMessage');
        Route::get('/get-message-history/{userId}', 'getChatHistory');
        Route::get('/get-chat-users', 'getChatUsers');
        Route::post('/invite-job', 'inviteJob');
    });

    Route::controller(BlockController::class)->group(function () {
        Route::post('/block-user', 'blockUser');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::post('/post-transaction', 'postTransaction');
        Route::get('/get-transaction', 'getTransaction');
    });
});

//Auth
Route::post('/user/login', [AuthenticateController::class , 'login']);
Route::post('/user/login-without-password', [AuthenticateController::class , 'loginWithoutPassword']);
Route::post('/user/signup', [AuthenticateController::class , 'signup']);
Route::get('/user/verify-user/{id}', [AuthenticateController::class , 'verifyUser']);
Route::post('/user/forgot-password', [AuthenticateController::class , 'forgotPassword']);
Route::post('/user/reset-password', [AuthenticateController::class , 'resetPassword']);

//Home
Route::get('/get-home-content', [HomeController::class , 'getHomeContent']);
Route::post('/search-shifts', [HomeController::class , 'searchShifts']);
Route::get('/get-categories', [HomeController::class , 'getCategories']);

//About us
Route::get('/get-about-us', [PagesController::class , 'getAboutUsContent']);

//Contact
Route::get('/get-contact', [PagesController::class , 'getContactContent']);
Route::post('/post-contact', [PagesController::class , 'postContact']);

// Privacy Policy
Route::get('/get-privacy-policy', [PagesController::class , 'getPrivacyContent']);

//FAQ
Route::get('/get-faq', [PagesController::class , 'getFAQContent']);

//Term of use
Route::get('/get-terms', [PagesController::class , 'getTermsContent']);

//Service
Route::post('/get-all-service', [ServicesController::class , 'getAllService']);
Route::get('/get-service/{id}', [ServicesController::class , 'getServiceByID']);
Route::post('/search-shifts', [ServicesController::class , 'searchShifts']);
Route::get('/get-service-dropdown', [ServicesController::class , 'getServiceAll']);

Route::post('/notify', [NotificationController::class , 'sendNotify']);

Route::post('/get-countries', [HomeController::class , 'getCountries']);
