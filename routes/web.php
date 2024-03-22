<?php

use App\Livewire\Views\User\UserView;
use Illuminate\Support\Facades\Route;
use App\Livewire\Views\Vessel\VesselView;
use App\Livewire\Views\Company\CompanyView;
use App\Livewire\Views\Company\CreateCompanyView;
use App\Livewire\Views\Department\CreateDepartmentView;
use App\Livewire\Views\Department\DepartmentView;
use App\Livewire\Views\Principal\CreatePrincipalView;
use App\Livewire\Views\Principal\PrincipalView;
use App\Livewire\Views\User\CreateUserView;
use App\Livewire\Views\User\AssignRolesView;
use App\Livewire\Views\Vessel\CreateVesselView;
use App\Livewire\Views\VesselType\VesselTypeView;
use App\Livewire\Views\VesselType\CreateVesselTypeView;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('vessel')->as('vessel.')->group(function (){
        Route::get('index', VesselView::class)->name('index');
        Route::get('create', CreateVesselView::class)->name('create');
        Route::get('edit/{hash_id}', CreateVesselView::class)->name('edit');
    });

    Route::prefix('vessel-type')->as('vessel-type.')->group(function (){
        Route::get('index', VesselTypeView::class)->name('index');
        Route::get('create', CreateVesselTypeView::class)->name('create');
        Route::get('edit/{hash_id}', CreateVesselTypeView::class)->name('edit');
    });
    
    Route::prefix('users')->as('users.')->group(function (){
        Route::get('index', UserView::class)->name('index');
        Route::get('create', CreateUserView::class)->name('create');
        Route::get('edit/{hash_id}', CreateUserView::class)->name('edit');
        Route::get('roles/index/{hash_id}', AssignRolesView::class)->name('roles-index');
        Route::get('edit-password/{hash_id}/{pw_id}', CreateUserView::class)->name('edit-password');
    });

    Route::prefix('company')->as('company.')->group(function (){
        Route::get('index', CompanyView::class)->name('index');
        Route::get('create', CreateCompanyView::class)->name('create');
        Route::get('edit/{hash_id}', CreateCompanyView::class)->name('edit');
    });

    Route::prefix('department')->as('department.')->group(function (){
        Route::get('index', DepartmentView::class)->name('index');
        Route::get('create', CreateDepartmentView::class)->name('create');
        Route::get('edit/{hash_id}', CreateDepartmentView::class)->name('edit');
    });

    Route::prefix('principal')->as('principal.')->group(function (){
        Route::get('index', PrincipalView::class)->name('index');
        Route::get('create', CreatePrincipalView::class)->name('create');
        Route::get('edit/{hash_id}', CreatePrincipalView::class)->name('edit');
    });

});
