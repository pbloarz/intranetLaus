<?php

use App\Http\Controllers\PdfController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect('/personal');
})->name('personal');
Route::middleware(['auth'])->group(function () {
    Route::get('/personal/pruebas/{user}', [PdfController::class, 'timesheetRecords'])->name('download.timesheet.pdf');
    Route::get('/download/holidays/pdf/{user}/{holiday}', [PdfController::class, 'holidayRecords'])->name('download.holidays.pdf');
    Route::get('/download/holidays/pdf', [PdfController::class, 'holidayAllRecords'])->name('download.holidays.all.pdf');
    Route::get('/download/timesheetRecordsToUserAll/{user}', [PdfController::class, 'timesheetRecordsToUserAll'])->name('download.timesheetRecordsToUserAll.pdf');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/',[PostController::class,'getPublishedPosts'])->name('post.view');