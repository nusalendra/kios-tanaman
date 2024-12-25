<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\TanamanController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/fetch-all-data-tanaman', [IndexController::class, 'fetchAllDataTanaman'])->name('fetch-all-data-tanaman');
    Route::get('/perhitungan-saw', [IndexController::class, 'perhitunganSAW'])->name('perhitungan-saw');
    Route::get('/login', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::post('/login', [LoginBasic::class, 'store'])->name('auth-login-basic');
    // Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    // Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/tanaman', [TanamanController::class, 'index'])->name('tanaman.index');
    Route::get('/tanaman/create', [TanamanController::class, 'create'])->name('tanaman.create');
    Route::post('/tanaman', [TanamanController::class, 'store'])->name('tanaman.store');
    Route::get('/tanaman/{id}/edit', [TanamanController::class, 'edit'])->name('tanaman.edit');
    Route::put('/tanaman/{id}', [TanamanController::class, 'update'])->name('tanaman.update');
    Route::delete('/tanaman/{id}', [TanamanController::class, 'destroy'])->name('tanaman.destroy');
    Route::get('/tanaman/perhitungan-saw', [TanamanController::class, 'perhitunganSAW'])->name('tanaman.perhitungan-saw');

    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    Route::get('/subkriteria', [SubkriteriaController::class, 'index'])->name('subkriteria.index');
    Route::get('/subkriteria/create', [SubkriteriaController::class, 'create'])->name('subkriteria.create');
    Route::post('/subkriteria', [SubkriteriaController::class, 'store'])->name('subkriteria.store');
    Route::get('/subkriteria/{id}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');
    Route::put('/subkriteria/{id}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');
    Route::delete('/subkriteria/{id}', [SubkriteriaController::class, 'destroy'])->name('subkriteria.destroy');

    Route::post('/logout', [LoginBasic::class, 'destroy']);
});
