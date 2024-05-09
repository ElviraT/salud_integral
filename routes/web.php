<?php

use App\Http\Controllers\Admin\BanksController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ConsultingRoomController;
use App\Http\Controllers\Admin\MedicalController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientFamilyController;
use App\Http\Controllers\Admin\SheduleController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/set_language/{lang}', [Controller::class, 'set_language'])->name('set_language');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // CRUD PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // CRUD ROLES
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/update/{role}', [RoleController::class, 'update'])->name('roles.update');
    // CRUD PERMISOS
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    // CRUD USERS
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    //SETTINGS
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/settings/companies', [SettingController::class, 'company'])->name('settings.company');
    Route::get('/settings/banks', [SettingController::class, 'banks'])->name('settings.banks');
    Route::post('/settings-companies', [SettingController::class, 'store_companies'])->name('settings.company.store');
    // CRUD BANKS
    Route::get('/banks', [BanksController::class, 'index'])->name('banks');
    Route::post('/banks/store', [BanksController::class, 'store'])->name('banks.store');
    Route::get('/banks/{bank}/edit', [BanksController::class, 'edit'])->name('banks.edit');
    Route::put('/banks/update/{bank}', [BanksController::class, 'update'])->name('banks.update');
    Route::delete('/banks/destroy/{bank}', [BanksController::class, 'destroy'])->name('banks.destroy');
    // CRUD TICKETS
    Route::get('/tickets/{id}', [TicketsController::class, 'index'])->name('tickets');
    Route::post('/tickets/store', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/update/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/destroy/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');
    // COMENTARIOS
    Route::post('/tickets/comment', [CommentController::class, 'store'])->name('tickets.comment');
    Route::get('/tickets/{ticket}/img', [CommentController::class, 'img'])->name('tickets.img');
    Route::delete('/tickets/{images}/destroy_img', [CommentController::class, 'destroy_img'])->name('ticket.destroy_img');
    // USUARIOS MEDICOS
    Route::get('/medicals', [MedicalController::class, 'index'])->name('medicals');
    Route::post('/medicals/store', [MedicalController::class, 'store'])->name('medicals.store');
    Route::get('/medicals/{medical}/edit', [MedicalController::class, 'edit'])->name('medicals.edit');
    Route::put('/medicals/update/{medical}', [MedicalController::class, 'update'])->name('medicals.update');
    Route::delete('/medicals/destroy/{medical}', [MedicalController::class, 'destroy'])->name('medicals.destroy');
    // USUARIOS PACIENTES
    Route::get('/patients', [PatientController::class, 'index'])->name('patients');
    Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/update/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/destroy/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    // USUARIOS FAMILIARES PACIENTES
    Route::get('/patients/family', [PatientFamilyController::class, 'index'])->name('patients.family');
    Route::post('/patients/family/store', [PatientFamilyController::class, 'store'])->name('patients.family.store');
    Route::get('/patients/family/{patient}/edit', [PatientFamilyController::class, 'edit'])->name('patients.family.edit');
    Route::put('/patients/family/update/{patient}', [PatientFamilyController::class, 'update'])->name('patients.family.update');
    Route::delete('/patients/family/destroy/{patient}', [PatientFamilyController::class, 'destroy'])->name('patients.family.destroy');
    //CONSULTORIOS
    Route::get('/consultings', [ConsultingRoomController::class, 'index'])->name('consultings');
    Route::post('/consultings/store', [ConsultingRoomController::class, 'store'])->name('consultings.store');
    Route::get('/consultings/{consulting}/edit', [ConsultingRoomController::class, 'edit'])->name('consultings.edit');
    Route::put('/consultings/update/{consulting}', [ConsultingRoomController::class, 'update'])->name('consultings.update');
    Route::delete('/consultings/destroy/{consulting}', [ConsultingRoomController::class, 'destroy'])->name('consultings.destroy');
    //HORARIOS
    Route::get('/schedules', [SheduleController::class, 'index'])->name('schedules');
    Route::post('/schedules/store', [SheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedules}/edit', [SheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/update/{schedules}', [SheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/destroy/{schedules}', [SheduleController::class, 'destroy'])->name('schedules.destroy');
    // COMBOS
    Route::controller(ComboController::class)->prefix('combo')->group(function () {
        Route::match(['get', 'post'], '/{country}/state', 'state');
        Route::match(['get', 'post'], '/{state}/city', 'city');
        Route::match(['get', 'post'], '/{idUser}/user', 'user');
    });
});

require __DIR__ . '/auth.php';
