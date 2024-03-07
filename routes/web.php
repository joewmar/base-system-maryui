<?php

use App\Models\FeedType;
use App\Livewire\Dashboard;

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\AccountsEdit;
use App\Livewire\Settings\AccountsHome;
use App\Services\GenericServices as GS;
use App\Http\Controllers\LoginController;
use App\Livewire\Settings\AccountsCreate;
use App\Utilities\GenericUtilities as GU;
use App\Livewire\FarmInformation\FarmEdit;
use App\Livewire\FarmInformation\FarmHome;
use App\Livewire\Reports\ElectricCostHome;
use App\Livewire\Settings\ActivitylogHome;
use App\Http\Controllers\AccountController;
use App\Livewire\RawMaterials\FeedTypeHome;
use App\Http\Controllers\FarmInfoController;
use App\Livewire\FarmInformation\FarmCreate;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;

// Fixed Route for all new application that will use Auth
Route::get('/app-login/{id}', [AuthenticationController::class, 'app_login'])->name('app.login');
// Login Route
Route::get('/login', [LoginController::class, 'login'])->name('login');
// Auth Middleware Group
// Route::middleware('auth')->group(function() {
	// Main Session Check for Authetication
	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
	// Dash/Dashboard
	Route::get('/', Dashboard::class)->name('home');

	Route::prefix('/farm-information')->name('farm.information.')->group(function(){
		Route::get('/', [FarmInfoController::class, 'index'])->name('home');
		Route::get('/farm', FarmHome::class)->name('farm');
		Route::get('/farm/create', FarmCreate::class)->name('farm.create');
		// Route::get('/location', FarmLocationHome::class)->name('location');
		// Route::get('/location/create', FarmLocationCreate::class)->name('location.create');

		Route::get('/farm/{id}/edit', FarmEdit::class)->name('farm.edit');
		// Route::get('/farm/location/{id}/edit', FarmLocationEdit::class)->name('location.edit');
	});
	Route::prefix('/settings')->name('settings.')->group(function(){
		//Accounts
		Route::get('/', [AccountController::class, 'index'])->name('home');
		Route::get('/accounts', AccountsHome::class)->name('accounts.home');
		Route::get('/accounts/create', AccountsCreate::class)->name('accounts.create');
		Route::get('/accounts/{id}/edit', AccountsEdit::class)->name('accounts.edit');
		//Activity Log
		Route::get('/activity-log', ActivitylogHome::class)->name('activitylog.home');
	});
	Route::prefix('/raw-materials')->name('raw-materials.')->group(function(){
		// Raw-Materials

		// For Feed Type
		route::get('/feed-type', FeedTypeHome::class)->name('feed-type-home');

	});
	Route::prefix('/reports')->name('reports.')->group(function(){
		// Reports
		Route::prefix('/electric-cost')->name('electric-cost.')->group(function(){
			Route::get('/', ElectricCostHome::class)->name('home');			
		});
	});
	
	/**
	 * YOUR CODE STARTS HERE
	 * DO NOT ALTER ABOVE CODE
	 */
// });

Route::get('/gs', function () {
	return GS::service1();
});
