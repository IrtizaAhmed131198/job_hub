<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('/admin', url('/admin/login'));

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('login', 'AuthController@showLoginForm')->name('admin.login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout')->name('admin.logout');
});

// Protected Admin Routes
Route::prefix('admin')->namespace('App\Http\Controllers\Admin')
    ->middleware('auth:admin')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('admin.home.index');

        // Admin
        Route::get('/admins/{id}/edit', 'AdminController@edit')->name('admin.edit');
        Route::post('/admins/update/{id}', 'AdminController@update')->name('admin.update');
        Route::get('/getAdmin', 'AdminController@getAdmin')->name('admin.getAdmin');
        Route::get('/admins', 'AdminController@index')->name('admin.index');

        //Users
        Route::get('/getUsers', 'UserController@getUsers')->name('users.getUsers');
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
        Route::post('/users/store', 'UserController@store')->name('users.store');
        Route::post('/users/update', 'UserController@update')->name('users.update');
        Route::post('/users/destroy', 'UserController@destroy')->name('users.destroy');

        //Partners
        Route::get('/getPartners', 'PartnersController@getPartners')->name('partners.getPartners');
        Route::get('/partners', 'PartnersController@index')->name('partners.index');
        Route::get('/partners/create', 'PartnersController@create')->name('partners.create');
        Route::get('/partners/edit/{id}', 'PartnersController@edit')->name('partners.edit');
        Route::post('/partners/store', 'PartnersController@store')->name('partners.store');
        Route::post('/partners/update', 'PartnersController@update')->name('partners.update');
        Route::post('/partners/destroy', 'PartnersController@destroy')->name('partners.destroy');

        //Categories
        Route::get('/getCategories', 'CategoriesController@getCategories')->name('categories.getCategories');
        Route::get('/categories', 'CategoriesController@index')->name('categories.index');
        Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
        Route::get('/categories/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
        Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');
        Route::post('/categories/update', 'CategoriesController@update')->name('categories.update');
        Route::post('/categories/destroy', 'CategoriesController@destroy')->name('categories.destroy');

        //Blog
        Route::get('/getBlogs', 'BlogController@getBlogs')->name('blog.getBlogs');
        Route::get('/blog', 'BlogController@index')->name('blog.index');
        Route::get('/blog/create', 'BlogController@create')->name('blog.create');
        Route::get('/blog/edit/{id}', 'BlogController@edit')->name('blog.edit');
        Route::post('/blog/store', 'BlogController@store')->name('blog.store');
        Route::post('/blog/update', 'BlogController@update')->name('blog.update');
        Route::post('/blog/destroy', 'BlogController@destroy')->name('blog.destroy');

        //Subscribe
        Route::get('/getSubscribe', 'SubscribeController@getSubscribe')->name('subscribe.getSubscribe');
        Route::get('/subscribe', 'SubscribeController@index')->name('subscribe.index');
        Route::post('/subscribe/destroy', 'SubscribeController@destroy')->name('subscribe.destroy');

        //Job
        Route::get('/getJobs', 'JobController@getJobs')->name('job.getJobs');
        Route::get('/job', 'JobController@index')->name('job.index');
        Route::get('/job/create', 'JobController@create')->name('job.create');
        Route::get('/job/edit/{id}', 'JobController@edit')->name('job.edit');
        Route::post('/job/store', 'JobController@store')->name('job.store');
        Route::post('/job/update', 'JobController@update')->name('job.update');
        Route::post('/job/destroy', 'JobController@destroy')->name('job.destroy');

        //JobApplication
        Route::get('/getJobsApplication', 'JobApplicationController@getJobsApplication')->name('jobapp.getJobsApplication');
        Route::get('/job-app', 'JobApplicationController@index')->name('jobapp.index');
        Route::get('/job-app/edit/{id}', 'JobApplicationController@edit')->name('jobapp.edit');
        Route::post('/job-app/update', 'JobApplicationController@update')->name('jobapp.update');
        Route::get('/job-app/refund/{id}', 'JobApplicationController@refund')->name('jobapp.refund');
        Route::post('/job-app/b2c-callback', 'JobApplicationController@mpesaB2CCallback')->name('mpesaB2CCallback');

        //settings
        Route::get('/settings', 'SettingsController@edit')->name('settings.edit');
        Route::post('/settings/update', 'SettingsController@update')->name('settings.update');

        //Page
        Route::resource('pages', 'PagesController');
    });

Route::middleware('prevent.admin.access')->group(function () {
Route::prefix('/')->namespace('App\Http\Controllers\Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/about-us', 'AboutUsController@aboutus')->name('aboutus');
    Route::get('/our-service', 'OurServiceController@ourservice')->name('ourservice');
    Route::get('/faqs', 'FaqsController@faqs')->name('faqs');
    Route::get('/contact-us', 'ContactController@contact')->name('contact');
    Route::post('/contact-us/post', 'ContactController@send')->name('contact.send');
    Route::get('/how-it-work', 'HowItWorkController@howitwork')->name('howitwork');
    Route::post('/subscribe', 'HomeController@subscribe')->name('subscribe');

    Route::get('/blog-inner/{id}', 'BlogController@blog')->name('blog.inner');

    Route::get('/job/{grid?}', 'JobController@job')->name('job');
    Route::match(['get', 'post'], '/fetch-jobs', 'JobController@fetchJobs')->name('job.fetch');
    Route::get('/job-inner/{id}', 'JobController@job_inner')->name('job.inner');
    Route::get('/job/search', 'JobController@job')->name('job.search');

    Route::get('login', 'AuthController@showLoginForm')->name('users.login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('users.login');
    })->name('users.logout');

    Route::get('signup', 'AuthController@showSignupForm')->name('users.signup');
    Route::post('post-signup', 'AuthController@postSignup')->name('users.postSignup');

    Route::get('forgot-password', 'AuthController@showForgotPassword')->name('users.forgotPassword');
    Route::post('post-forgot-password', 'AuthController@forgotPassword')->name('users.postForgotPassword');
    Route::get('reset/{id}', 'AuthController@showResetPasswordForm')->name('users.reset');
    Route::post('post-reset-password', 'AuthController@postResetPasswordForm')->name('users.postResetPassword');

    Route::get('otp', 'AuthController@otp')->name('users.otp');
    Route::get('resend-otp', 'AuthController@resendOtp')->name('users.resendOtp');
    Route::post('verify-otp', 'AuthController@verifyOtp')->name('users.verifyOtp');
    Route::post('post-resend-otp', 'AuthController@postResendOtp')->name('users.postResendOtp');

    Route::post('/mpesa/callback', 'JobApplicationController@mpesaCallback')->name('mpesaCallback');
});

Route::prefix('/')->namespace('App\Http\Controllers\Front')->middleware(['auth', 'user'])->group(function () {
    Route::get('/payment-method/{price}', 'OrderController@payment')->name('order.method');
    Route::post('/place-order', 'OrderController@place_order')->name('order.place');
});

// Company Routes
Route::prefix('dashboard')->namespace('App\Http\Controllers\Front')->middleware(['auth', 'user'])->group(function () {
        Route::get('/', 'ProfileController@dashboard')->name('dashboard');
        Route::get('view-profile', 'ProfileController@viewProfile')->name('viewProfile');
        Route::get('update-profile', 'ProfileController@updateProfile')->name('updateProfile');
        Route::post('post-update-profile', 'ProfileController@postUpdateProfile')->name('postUpdateProfile');
        Route::get('/job-list', 'ProfileController@list')->name('jobs.list');
        Route::get('/get-job-list', 'ProfileController@getList')->name('jobs.getList');

        Route::get('/job-application/{id}', 'JobApplicationController@jobApplication')->name('jobApplication');
        Route::post('/job-application/store/{jobId}', 'JobApplicationController@store')->name('jobs.apply.create');
        Route::get('/job-application-edit/{id}/{appId}', 'JobApplicationController@jobApplicationEdit')->name('jobApplicationEdit');
        Route::post('/job-application/edit/{jobId}', 'JobApplicationController@edit')->name('jobs.apply.edit');

});
Route::get('/home', 'App\Http\Controllers\Front\HomeController@index')->name('home');

});
