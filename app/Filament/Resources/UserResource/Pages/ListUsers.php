<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Imports\MyUserImport;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
                ->color("success")
                ->use(MyUserImport::class)
                ->slideOver()
        ];
    }

    protected function createTimesheetPdfFromUsers(): Actions\Action
    {
        return Actions\Action::make('createTimesheetPdfFromUsers')
            ->label('Create Timesheet Pdf From Users')
            ->icon('heroicon-o-play')
            ->color('danger');
    }
}
