<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

// Redirigir a la página de login cuando se acceda a la raíz del sitio
Route::get('/', function () {
    return redirect()->route('login');
});

// Registro
Route::get('groups/pdf', [GroupController::class, 'pdf'])->name('groups.pdf');
Route::get('albums/pdf', [AlbumController::class, 'pdf'])->name('albums.pdf');
Route::get('members/pdf', [MemberController::class, 'pdf'])->name('members.pdf');
Route::get('songs/pdf', [SongController::class, 'pdf'])->name('songs.pdf');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/groups/statistics', [GroupController::class, 'statistics'])->name('groups.statistics');
Route::get('/members/statistics', [MemberController::class, 'statistics'])->name('members.statistics');
Route::get('/albums/statistics', [AlbumController::class, 'statistics'])->name('albums.statistics');
Route::get('/songs/statistics', [SongController::class, 'statistics'])->name('songs.statistics');
Route::get('/groups/export-csv', [GroupController::class, 'exportToCSV'])->name('groups.export.csv');
Route::get('/members/export-csv', [MemberController::class, 'exportToCSV'])->name('members.export.csv');
Route::get('/albums/export-csv', [AlbumController::class, 'exportToCSV'])->name('albums.export.csv');
Route::get('/songs/export-csv', [SongController::class, 'exportToCSV'])->name('songs.export.csv');

// Inicio de Sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Cerrar Sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas Protegidas
Route::middleware('auth')->group(function () {
    Route::resource('groups', GroupController::class);
    Route::resource('members', MemberController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
    
});



