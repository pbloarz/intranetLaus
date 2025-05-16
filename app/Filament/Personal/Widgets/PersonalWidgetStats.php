<?php

namespace App\Filament\Personal\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonalWidgetStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending holidays', $this->getPendingHolidays(Auth::user())),
            Stat::make('Approved holidays', $this->getApprovedHolidays(Auth::user())),
            Stat::make('Total wotk', $this->getTotalWork(Auth::user())),
            Stat::make('Total Pause', $this->getTotalPause(Auth::user())),
        ];
    }
    protected function getPendingHolidays(User $user): int
    {
        $pendingHolidays = Holiday::where('user_id', $user->id)
            ->where('type', 'pending')
            ->get()
            ->count();
        return $pendingHolidays;
    }

    protected function getApprovedHolidays(User $user): int
    {
        $approvedHolidays = Holiday::where('user_id', $user->id)
            ->where('type', 'approved')
            ->get()
            ->count();
        return $approvedHolidays;
    }

    protected function getTotalWork(User $user): string
    {
        $timesheets = Timesheet::where('user_id', $user->id)
            ->where('type', 'work')
            ->whereDate('created_at', Carbon::today())
            ->get();

        $sumSeconds = 0;
        foreach ($timesheets as $timesheet) {
            $startTime = Carbon::parse($timesheet->day_in);
            $finishTime = Carbon::parse($timesheet->day_out);
            $totalDuration = $finishTime->diffInSeconds($startTime);
            $sumSeconds += $totalDuration;
        }

        $hours = floor($sumSeconds / 3600);
        $minutes = floor(($sumSeconds % 3600) / 60);
        $seconds = $sumSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    protected function getTotalPause(User $user): string
    {
        $timesheets = Timesheet::where('user_id', $user->id)
            ->where('type', 'pause')
            ->whereDate('created_at', Carbon::today())
            ->get();

        $sumSeconds = 0;
        foreach ($timesheets as $timesheet) {
            $startTime = Carbon::parse($timesheet->day_in);
            $finishTime = Carbon::parse($timesheet->day_out);
            $totalDuration = $finishTime->diffInSeconds($startTime);
            $sumSeconds += $totalDuration;
        }

        $hours = floor($sumSeconds / 3600);
        $minutes = floor(($sumSeconds % 3600) / 60);
        $seconds = $sumSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
