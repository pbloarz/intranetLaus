<?php

namespace App\Filament\Resources\HolidayResource\Pages;

use App\Filament\Resources\HolidayResource;
use App\Mail\HolidayApproved;
use App\Mail\HolidayDecline;
use App\Mail\HolidayPending;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EditHoliday extends EditRecord
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $user = User::find($record->user_id);

        $dataSendEmail = array(
            'name' => $user->name,
            'email' => $user->email,
            'day' => $record->day,
        );

        $this->sendHolidaydNotification($record, $user, $dataSendEmail);
        return $record;
    }
    protected function sendHolidaydNotification($record, User $user, $data): void
    {

        Mail::to($user)->send(new HolidayApproved($data));
        if ($record->type === 'approved') {
            Notification::make()
                ->title('📤 Solicitud aprobada')
                ->body('📝 Tu solicitud de vacaciones ha sido aprobada.')
                ->success()
                ->send()
                ->sendToDatabase($user);
        } else if ($record->type === 'decline') {
            Mail::to($user)->send(new HolidayDecline($data));
            Notification::make()
                ->title('📤 Solicitud rechasada')
                ->body('📝 Tu solicitud de vacaciones ha sido rechazada.')
                ->success()
                ->send()
                ->sendToDatabase($user);
        } else if ($record->type === 'pending') {
            Mail::to($user)->send(new HolidayPending($data));
            Notification::make()
                ->title('📤 Solicitud pendiente')
                ->body('📝 Tu solicitud de vacaciones ha sido pendiente.')
                ->success()
                ->send()
                ->sendToDatabase($user);
        }
    }
}
