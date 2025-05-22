<?php

namespace App\Filament\Resources\TimesheetResource\Pages;

use App\Filament\Resources\TimesheetResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('generatePDF')
                ->label('Generar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->form([
                    Select::make('user_id')
                        ->label('Seleccionar Usuario')
                        ->options(User::pluck('name', 'id'))
                        ->preload()
                        ->searchable()
                        ->required(),
                ])
                ->action(function (array $data) {
                    return redirect()->route('download.timesheetRecordsToUserAll.pdf', ['user' => $data['user_id']]);
                }),
        ];
    }
}
