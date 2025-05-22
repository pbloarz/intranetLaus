<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimesheetResource\Pages;
use App\Filament\Resources\TimesheetResource\RelationManagers;
use App\Models\Timesheet;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TimesheetResource extends Resource
{
    protected static ?string $model = Timesheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Employee management';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return parent::getEloquentQuery()->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return parent::getEloquentQuery()->count() > 0 ? 'warning' : 'primary';
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'The number of timessheet';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('calendar_id')
                    ->relationship('calendar', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'work' => 'Working',
                        'pause' => 'In Pause',
                    ])
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\DateTimePicker::make('day_in')
                    ->required(),
                Forms\Components\DateTimePicker::make('day_out')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calendar.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'work' => 'success',
                        'pause' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('user.departament.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_in')
                    ->searchable()
                    ->dateTime()
                    ->sortable()
                    ->badge()
                    ->color(fn(Timesheet $record): string => match($record->type) {
                        'work' =>'success',
                        'pause' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('day_out')
                    ->searchable()
                    ->dateTime()
                    ->sortable()
                    ->badge()
                    ->color(fn(Timesheet $record): string => match($record->type) {
                        'work' =>'success',
                        'pause' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'work' => 'Working',
                        'wrk' => 'In Pause',
                    ]),
                SelectFilter::make('user.name')->relationship('user', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('report')
                    ->label('PDF')
                    ->toolTip('Generate report the timesheet of the employee')
                    ->icon('heroicon-o-printer')
                    ->color('danger')
                    ->visible(fn(Timesheet $record): int => $record->where('user_id', $record->user->id)->count() > 0)
                    ->url(
                        fn(Timesheet $record): string => route('download.timesheet.pdf', ['user' => $record->user_id]),
                        shouldOpenInNewTab: true,

                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make('table')->fromTable()
                            ->askForFilename()
                            ->askForWriterType()
                            ->withFilename('Timesheet_' . date('Y-m-d') . ' _ export')
                            ->withColumns([
                                Column::make('user.name')->heading('Name')->width(20),
                                Column::make('user.email')->heading('Email')->width(20),
                                Column::make('user.phone')->heading('Phone'),
                                Column::make('user.city.name')->heading('City'),
                                Column::make('user.address')->heading('Address'),
                                Column::make('user.city.name')->heading('City'),
                                Column::make('user.country.name')->heading('Country'),
                                Column::make('user.departament.name')->heading('Department'),

                            ]),
                        ExcelExport::make('form')->fromForm()
                            ->askForFilename()
                            ->askForWriterType(),
                    ])
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimesheets::route('/'),
            'create' => Pages\CreateTimesheet::route('/create'),
            'edit' => Pages\EditTimesheet::route('/{record}/edit'),
        ];
    }
}
