<?php

use App\Livewire\Auth\VerificationView;
use App\Livewire\Reports\SGA\GenerateStoredReportComponent;
use App\Livewire\Reports\SGA\GenerateStoredSummaryReportComponent;
use App\Livewire\Views\SGA\SGAView;
use App\Livewire\Views\User\UserView;
use Illuminate\Support\Facades\Route;
use App\Livewire\Views\SGA\LetterView;
use App\Livewire\Views\Vessel\VesselView;
use App\Livewire\Views\Company\CompanyView;
use App\Livewire\Views\SGA\TrainingFeeView;
use App\Livewire\Views\User\CreateUserView;
use App\Livewire\Views\User\AssignRolesView;
use App\Livewire\Reports\SGA\LetterComponent;
use App\Livewire\Views\Principal\PrincipalView;
use App\Livewire\Views\Recipient\RecipientView;
use App\Livewire\Views\Vessel\CreateVesselView;
use App\Livewire\Views\Company\CreateCompanyView;
use App\Livewire\Views\Department\DepartmentView;
use App\Livewire\Views\VesselType\VesselTypeView;
use App\Livewire\Reports\SGA\TrainingFeeComponent;
use App\Livewire\Views\Dashboard\Fc007DashboardMaintenanceView;
use App\Livewire\Views\Principal\CreatePrincipalView;
use App\Livewire\Views\Recipient\CreateRecipientView;
use App\Livewire\Views\Department\CreateDepartmentView;
use App\Livewire\Views\Logs\Fc007View;
use App\Livewire\Views\Logs\SummaryLogView;
use App\Livewire\Views\SGA\Fc007ProcessModuleView;
use App\Livewire\Views\SGA\SummaryProcessModuleView;
use App\Livewire\Views\SgaDashboard\Fc007DashboardView;
use App\Livewire\Views\SgaDashboard\SgaDashboardMaintenanceView;
use App\Livewire\Views\SgaDashboard\SummaryDashboardMaintenanceView;
use App\Livewire\Views\SgaDashboard\SummaryDashboardView;
use App\Livewire\Views\VesselType\CreateVesselTypeView;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('login/verification', VerificationView::class)->name('login.verification');

    Route::middleware(['VerifyPinMiddleware'])->group(function () {

        Route::prefix('vessel')->as('vessel.')->group(function () {
            Route::get('index', VesselView::class)->name('index');
            Route::get('create', CreateVesselView::class)->name('create');
            Route::get('edit/{hash_id}', CreateVesselView::class)->name('edit');
        });

        Route::prefix('vessel-type')->as('vessel-type.')->group(function () {
            Route::get('index', VesselTypeView::class)->name('index');
            Route::get('create', CreateVesselTypeView::class)->name('create');
            Route::get('edit/{hash_id}', CreateVesselTypeView::class)->name('edit');
        });

        Route::prefix('users')->as('users.')->group(function () {
            Route::get('index', UserView::class)->name('index');
            Route::get('create', CreateUserView::class)->name('create');
            Route::get('edit/{hash_id}', CreateUserView::class)->name('edit');
            Route::get('roles/index/{hash_id}', AssignRolesView::class)->name('roles-index');
            Route::get('edit-password/{hash_id}/{pw_id}', CreateUserView::class)->name('edit-password');
        });

        Route::prefix('company')->as('company.')->group(function () {
            Route::get('index', CompanyView::class)->name('index');
            Route::get('create', CreateCompanyView::class)->name('create');
            Route::get('edit/{hash_id}', CreateCompanyView::class)->name('edit');
        });

        Route::prefix('department')->as('department.')->group(function () {
            Route::get('index', DepartmentView::class)->name('index');
            Route::get('create', CreateDepartmentView::class)->name('create');
            Route::get('edit/{hash_id}', CreateDepartmentView::class)->name('edit');
        });

        // module is removed
        // Route::prefix('principal')->as('principal.')->group(function () {
        //     Route::get('index', PrincipalView::class)->name('index');
        //     Route::get('create', CreatePrincipalView::class)->name('create');
        //     Route::get('edit/{hash_id}', CreatePrincipalView::class)->name('edit');
        // });

        // Route::prefix('recipient')->as('recipient.')->group(function () {
        //     Route::get('index', RecipientView::class)->name('index');
        //     Route::get('create', CreateRecipientView::class)->name('create');
        //     Route::get('edit/{hash_id}', CreateRecipientView::class)->name('edit');
        // });

        //to be added in role, delete if added
        Route::prefix('dashboard')->as('dashboard.')->group(function (){
            Route::get('summary', SummaryDashboardView::class)->name('summary');
            Route::get('summary-maintenance', SummaryDashboardMaintenanceView::class)->name('summary-maintenance');
            Route::get('fc007', Fc007DashboardView::class)->name('fc007');
            Route::get('fc007-maintenance', Fc007DashboardMaintenanceView::class)->name('fc007-maintenance');
        });

        Route::prefix('sga')->as('sga.')->group(function () {
            Route::get('letter-index', LetterView::class)->name('letter-index');
            Route::get('tFee-index', TrainingFeeView::class)->name('tFee-index');
            Route::get('process/fc007/{processId}', Fc007ProcessModuleView::class)->name('process-fc007');
            Route::get('process/summary/{processId}', SummaryProcessModuleView::class)->name('process-summary');
        });

        Route::prefix('generate')->as('generate.')->group(function () {
            Route::get('letter', [LetterComponent::class, 'generate'])->name('letter');
            Route::get('training-fee', [TrainingFeeComponent::class, 'generate'])->name('training-fee');
            Route::get('stored-report', GenerateStoredReportComponent::class)->name('stored-report');
            Route::get('stored-summary-report', GenerateStoredSummaryReportComponent::class)->name('stored-summary-report');
        });

        Route::prefix('report')->as('report.')->group(function () {
            Route::get('summary', SummaryLogView::class)->name('summary');
            Route::get('fc007', Fc007View::class)->name('fc007');
        });

    });

});
