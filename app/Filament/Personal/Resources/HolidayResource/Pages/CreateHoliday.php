<?php

namespace App\Filament\Personal\Resources\HolidayResource\Pages;

use App\Filament\Personal\Resources\HolidayResource;
use App\Mail\HolidayPending;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateHoliday extends CreateRecord
{
    protected static string $resource = HolidayResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        $data['type'] = 'pending';
        
        $this->sendEmailToAdmin($data);
        $this->sendDatabaseNotification();

        return $data;
    }

    protected function sendEmailToAdmin(array $data): void
    {
        $userAdmin = User::find(1);
        $dataToSend = [
            'day' => $data['day'],
            'name' => User::find($data['user_id'])->name,
            'email' => User::find($data['user_id'])->email,
        ];
        
        try {
            Mail::to($userAdmin)->send(new HolidayPending($dataToSend));
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            report($e);
        }
    }

    protected function sendDatabaseNotification(): void
    {
        $recipient = auth()->user();
        
        Notification::make()
            ->title('📤 Solicitud enviada con éxito')
            ->body('📝 Tu solicitud de vacaciones ha sido registrada y está ⏳ *pendiente de aprobación*. Recibirás una notificación cuando sea revisada.')
            ->success()
            ->send()
            ->sendToDatabase($recipient);
    }
}
