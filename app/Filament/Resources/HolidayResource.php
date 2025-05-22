<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayResource\Pages;
use App\Filament\Resources\HolidayResource\RelationManagers;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';
    protected static ?string $navigationGroup = 'System management';
    protected static ?int $navigationSort = 9;

    public static function getNavigationBadge(): ?string
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id)->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id)->where('type', 'pending')->count() > 0 ? 'warning' : 'primary';
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'The number of pending holidays';
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
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\DatePicker::make('day')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'decline' => 'decline',
                        'approved' => 'approved',
                        'pending' => 'pending',
                    ])
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
                Tables\Columns\TextColumn::make('user.departament.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(Holiday $record): string => match ($record->type) {
                        'approved' => 'success',
                        'decline' => 'danger',
                        'pending' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'decline' => 'danger',
                        'approved' => 'success',
                        'pending' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
                    ->visible(fn(Holiday $record): int => $record->where('user_id', $record->user->id)->count() > 0)
                    ->url(
                        fn(Holiday $record): string => route('download.holidays.pdf', ['user' => $record->user, 'holiday' => $record]),
                        shouldOpenInNewTab: true,

                    ),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('id'),
                            Column::make('calendar.name')->heading('Calendar'),
                            Column::make('user.name')->heading('Name'),
                            Column::make('day')->heading('Day'),
                            Column::make('type')->heading('Type'),
                            Column::make('created_at')->heading('Created at'),
                            Column::make('updated_at')->heading('Updated at'),
                            Column::make('user.email')->heading('Dmail'),
                            Column::make('user.phone')->heading('Phone'),
                            Column::make('user.address')->heading('Address'),
                            Column::make('user.city.name')->heading('City'),
                            Column::make('user.country.name')->heading('Country'),
                            Column::make('user.departament.name')->heading('Department'),
                        ]),
                        ExcelExport::make('form')
                            ->fromForm()
                            ->askForFilename()
                            ->askForWriterType()
                    ]),
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
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
        ];
    }
}
