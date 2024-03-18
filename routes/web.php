<?php

use App\Livewire\Views\Vessel\CreateVesselView;
use App\Livewire\Views\Vessel\VesselView;
use App\Livewire\Views\VesselType\CreateVesselTypeView;
use App\Livewire\Views\VesselType\VesselTypeView;
use Illuminate\Support\Facades\Route;

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

    Route::prefix('vessel-type')->as('vessel-type.')->group(function (){
        Route::get('index', VesselTypeView::class)->name('index');
        Route::get('create', CreateVesselTypeView::class)->name('create');
        Route::get('edit/{hash_id}', CreateVesselTypeView::class)->name('edit');
    });

    Route::prefix('vessel')->as('vessel.')->group(function (){
        Route::get('index', VesselView::class)->name('index');
        Route::get('create', CreateVesselView::class)->name('create');
    });

});
