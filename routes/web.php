<?php

use App\Models\Downtime;
use App\Livewire\Dashboard;
use App\Models\QualityAssurance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\AccountsEdit;
use App\Livewire\Settings\AccountsHome;
use App\Services\GenericServices as GS;
use App\Http\Controllers\LoginController;
use App\Livewire\Settings\AccountsCreate;
use App\Livewire\Settings\PermissionEdit;
use App\Livewire\Settings\PermissionHome;
use App\Utilities\GenericUtilities as GU;
use App\Livewire\FarmInformation\FarmEdit;
use App\Livewire\FarmInformation\FarmHome;
use App\Livewire\Reports\ElectricCostHome;
use App\Livewire\Settings\ActivitylogHome;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FarmInfoController;
use App\Livewire\FarmInformation\FarmCreate;
use App\Http\Controllers\DashboardController;
use App\Livewire\RecordManagement\DowntimeHome;
use App\Livewire\RecordManagement\FeedTypeHome;
use App\Livewire\DeliveryManagement\ScheduleHome;
use App\Http\Controllers\AuthenticationController;
use App\Livewire\FarmInformation\FarmLocationHome;
use App\Livewire\RawMaterials\MaterialStorageHome;
use App\Livewire\Requisition\WeeklyRequisitionHome;
use App\Livewire\RawMaterials\IngredientsStorageEdit;
use App\Livewire\RawMaterials\IngredientsStorageHome;
use App\Livewire\RecordManagement\QualityAssuranceHome;
use App\Livewire\Requisition\WeeklyRequisitionEdit;

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

	// Farm Information
	Route::prefix('/farm-information')->name('farm.information.')->group(function(){
		Route::get('/farm', FarmHome::class)->name('farm');
		Route::get('/farm-location', FarmLocationHome::class)->name('location');
	});
	Route::prefix('/settings')->name('settings.')->group(function(){
		//Accounts
		Route::get('/', [AccountController::class, 'index'])->name('home');
		Route::get('/accounts', AccountsHome::class)->name('accounts.home');
		Route::get('/accounts/create', AccountsCreate::class)->name('accounts.create');
		Route::get('/accounts/{id}/edit', AccountsEdit::class)->name('accounts.edit');
		//Activity Log
		Route::get('/activity-log', ActivitylogHome::class)->name('activitylog.home');
		// Permission
		Route::get('/permission', PermissionHome::class)->name('permission.home');
		Route::get('/permission/{id}', PermissionEdit::class)->name('permission.edit');
	
	});
	Route::prefix('/raw-materials')->name('raw-materials.')->group(function(){
		// Raw-Materials
		// Route for Ingredients Storage
		Route::prefix('/ingredients-storage')->name('ingredients-storage.')->group(function (){
			Route::get('/', IngredientsStorageHome::class)->name('home');
			Route::get('/{id}/edit', IngredientsStorageEdit::class)->name('edit');
		});
		// For Material Storage
		Route::get('material-storage', MaterialStorageHome::class)->name('material-storage-home');

	});
	Route::prefix('/record-management')->name('record-management.')->group(function(){
		// Record-Management
		// For Feed Type
		Route::get('/feed-type', FeedTypeHome::class)->name('feed-type-home');
		Route::get('quality-assurance', QualityAssuranceHome::class)->name('quality-assurance-home');
		Route::get('downtime', DowntimeHome::class)->name('downtime-home');
	});
	Route::prefix('/reports')->name('reports.')->group(function(){
		// Reports
		Route::prefix('/electric-cost')->name('electric-cost.')->group(function(){
			Route::get('/', ElectricCostHome::class)->name('home');			
		});
	});
	Route::prefix('/delivery-management')->name('delivery-management.')->group(function(){
		// Delivery-Management
		Route::get('schedule', ScheduleHome::class)->name('schedule-home');
	});

	Route::prefix('/requisition')->name('requisition.')->group(function(){
		// Requisition
		Route::get('/weeekly-requisition', WeeklyRequisitionHome::class)->name('weekly-requisition-home');
		Route::get('/weeekly-requisition/{id}/order', WeeklyRequisitionEdit::class)->name('weekly-requisition-order');
	});
	/**
	 * YOUR CODE STARTS HERE
	 * DO NOT ALTER ABOVE CODE
	 */
// });

Route::get('/gs', function () {
	return GS::service1();
});
