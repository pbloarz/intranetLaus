<?php

use App\Http\Controllers\PdfController;
use Barryvdh\DomPDF\Facade\Pdf;
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

Route::get('/', function () {
    return redirect('/personal');
});
Route::get('/personal/pruebas/{user}',[PdfController::class, 'timesheetRecords'])->name('download.timesheet.pdf');
Route::get('/download/holidays/pdf/{user}/{holiday}',[PdfController::class, 'holidayRecords'])->name('download.holidays.pdf');
Route::get('/download/holidays/pdf',[PdfController::class, 'holidayAllRecords'])->name('download.holidays.all.pdf');