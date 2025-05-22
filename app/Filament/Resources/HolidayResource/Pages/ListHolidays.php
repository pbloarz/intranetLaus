<?php

namespace App\Filament\Resources\HolidayResource\Pages;

use App\Filament\Resources\HolidayResource;
use App\Models\Holiday;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\Exceptions\Hold;
use Filament\Resources\Pages\ListRecords;

class ListHolidays extends ListRecords
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('generatePDF')
                ->label('Generar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->requiresConfirmation()
                ->url(
                    fn(): string => route('download.holidays.all.pdf'),
                    shouldOpenInNewTab: true,
                ),


        ];
    }
}
