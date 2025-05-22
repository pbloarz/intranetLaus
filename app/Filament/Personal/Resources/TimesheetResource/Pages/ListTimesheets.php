<?php

namespace App\Filament\Personal\Resources\TimesheetResource\Pages;

use App\Filament\Personal\Resources\TimesheetResource;
use App\Models\Timesheet;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Modal\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        $lastTimesheet = $this->getLastTimesheet();

        $this->generatePDF();

        if ($lastTimesheet === null) {
            return [
                $this->getWorkAction(),
                Actions\CreateAction::make(),
            ];
        }

        return [
            Actions\CreateAction::make(),
            $this->getWorkAction()
                ->visible(!$lastTimesheet->day_out == null)
                ->disabled($lastTimesheet->day_out == null),
            $this->getPauseAction($lastTimesheet)
                ->visible($lastTimesheet->day_out == null && $lastTimesheet->type != 'pause')
                ->disabled(!$lastTimesheet->day_out == null),
            $this->getStopPauseAction($lastTimesheet)
                ->visible($lastTimesheet->day_out == null && $lastTimesheet->type == 'pause')
                ->disabled(!$lastTimesheet->day_out == null),
            $this->getStopWorkAction($lastTimesheet)
                ->visible($lastTimesheet->day_out == null && $lastTimesheet->type != 'pause')
                ->disabled(!$lastTimesheet->day_out == null),
            $this->generatePDF(),
        ];
    }
    protected function generatePDF(): Actions\Action
    {
        return Actions\Action::make('generzzatePDF')
            ->label('Generar PDF')
            ->icon('heroicon-o-document-arrow-down')
            ->color('danger')
            ->requiresConfirmation()
            ->url(
                fn(): string => route('download.timesheet.pdf', ['user' => Auth::user()]),
                shouldOpenInNewTab: true,
            );
    }

    protected function getLastTimesheet(): ?Timesheet
    {
        return Timesheet::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    protected function createTimesheet(string $type): Timesheet
    {
        $timesheet = new Timesheet();
        $timesheet->calendar_id = 1;
        $timesheet->user_id = Auth::user()->id;
        $timesheet->day_in = Carbon::now();
        $timesheet->type = $type;
        $timesheet->save();

        return $timesheet;
    }

    protected function sendNotification(string $title, string $body, string $type): void
    {
        $date = Carbon::now()->format('d \d\e F \d\e\l Y \a \l\a\s H:i');

        Notification::make()
            ->title("$title $date")
            ->body($body)
            ->color($type)
            ->{$type}()
            ->send();
    }

    protected function getWorkAction(): Actions\Action
    {
        return Actions\Action::make('inWork')
            ->label('In work')
            ->icon('heroicon-o-play')
            ->color('success')
            ->requiresConfirmation()
            ->action(function () {
                $this->createTimesheet('work');
                $this->sendNotification(
                    '👨‍💻 Ha iniciado su jornada laboral el',
                    '🌞 ¡Vamos con toda! Espero que te concentres y tengas un día productivo.',
                    'success'
                );
            });
    }

    protected function getPauseAction(Timesheet $lastTimesheet): Actions\Action
    {
        return Actions\Action::make('inPause')
            ->label('In Pause')
            ->icon('heroicon-o-pause')
            ->color('warning')
            ->requiresConfirmation()
            ->action(function () use ($lastTimesheet) {
                $lastTimesheet->day_out = Carbon::now();
                $lastTimesheet->save();
                $this->createTimesheet('pause');
                $this->sendNotification(
                    '☕ Ha iniciado una pausa en sus labores el',
                    '☕ Es hora de recargar energías. Disfruta tu descanso.',
                    'warning'
                );
            });
    }

    protected function getStopPauseAction(Timesheet $lastTimesheet): Actions\Action
    {
        return Actions\Action::make('stopPause')
            ->label('Stop Pause')
            ->icon('heroicon-o-stop')
            ->color('info')
            ->requiresConfirmation()
            ->action(function () use ($lastTimesheet) {
                $lastTimesheet->day_out = Carbon::now();
                $lastTimesheet->save();
                $this->createTimesheet('work');
                $this->sendNotification(
                    '🔁 Ha finalizado la pausa el',
                    '🚀 ¡De vuelta al trabajo! Espero que vuelvas con más ánimo.',
                    'info'
                );
            });
    }

    protected function getStopWorkAction(Timesheet $lastTimesheet): Actions\Action
    {
        return Actions\Action::make('stopWork')
            ->label('Stop Work')
            ->icon('heroicon-o-stop')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () use ($lastTimesheet) {
                $lastTimesheet->day_out = Carbon::now();
                $lastTimesheet->save();
                $this->sendNotification(
                    '🏁 Ha finalizado su jornada laboral el',
                    '🌙 ¡Espero verte pronto! Recuerda descansar y disfrutar de tu día.',
                    'danger'
                );
            });
    }
}
