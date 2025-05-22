<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Timesheet;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function timesheetRecords(User $user)
    {
        $timesheets = Timesheet::where('user_id', $user->id)->get();
    
        $pdf = Pdf::loadView('pdfs.timesheet', ['timesheets' => $timesheets, 'user' => $user]);
        return $pdf->download('timesheet_'.Carbon::now(). '.pdf');
    }

    public function holidayRecords(User $user, Holiday $holiday)
    {
        $pdf = Pdf::loadView('pdfs.holidayIndividual', ['holiday' => $holiday, 'user' => $user]);
        return $pdf->download('holiday_'.Carbon::now(). '.pdf');
    }
    public function holidayAllRecords()
    {
        $holidays = Holiday::all();
        $users = auth()->user();
        $pdf = Pdf::loadView('pdfs.holidaysAll', ['holidays' => $holidays, 'users' => $users]);
        return $pdf->download('holidays_all_'.Carbon::now(). '.pdf');
    }

    public function timesheetRecordsToUserAll(User $user)
    {
    
        $timesheetsToUser = $user->timessheets;
        $timesheets = $user->timesheets; // Obtén todas las timesheets del usuario

        $pdf = Pdf::loadView('pdfs.timesheet', ['users' => $timesheetsToUser, 'user' => $user, 'timesheets' => $timesheets]);
        return $pdf->download('timesheet_all_'.Carbon::now(). '.pdf');
    }
}
