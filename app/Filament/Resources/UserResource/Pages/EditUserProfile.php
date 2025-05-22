<?php

namespace App\Filament\Resources\UserResource\Pages;


use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Filament\Forms\Components\FileUpload;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;

class EditUserProfile extends Page
{
    protected static string $resource = UserResource::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?string $title = 'Mi Perfil';
    protected static ?string $slug = 'profile';
    protected static string $view = 'filament.resources.user-resource.pages.edit-user-profile';
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'address' => auth()->user()->address,
            'country_id' => auth()->user()->country_id,
            'state_id' => auth()->user()->state_id,
            'city_id' => auth()->user()->city_id,
            // 'current_password' => $data['current_password'] ?? null,

        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información Personal')
                    ->description('Actualiza tu información personal')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->required(),
                        TextInput::make('address')
                            ->label('Dirección')
                            ->required(),
                    ]),

                Section::make('Ubicación')
                    ->description('Información de tu ubicación')
                    ->icon('heroicon-o-map-pin')
                    ->columns(3)
                    ->schema([
                        Select::make('country_id')
                            ->label('País')
                            ->options(Country::pluck('name', 'id'))
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (callable $set) => $set('state_id', null)),
                        
                        Select::make('state_id')
                            ->label('Estado/Provincia')
                            ->options(fn (callable $get) => 
                                State::where('country_id', $get('country_id'))->pluck('name', 'id')
                            )
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (callable $set) => $set('city_id', null)),
                        
                        Select::make('city_id')
                            ->label('Ciudad')
                            ->options(fn (callable $get) => 
                                City::where('state_id', $get('state_id'))->pluck('name', 'id')
                            )
                            ->required(),
                    ]),

                Section::make('Seguridad')
                    ->description('Actualiza tu contraseña')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Contraseña Actual')
                            ->revealable()
                            ->password(),
                        TextInput::make('new_password')
                            ->label('Nueva Contraseña')
                            ->revealable()
                            ->password()
                            ->confirmed(),
                        TextInput::make('new_password_confirmation')
                            ->label('Confirmar Nueva Contraseña')
                            ->revealable()
                            ->password(),
                    ]),
            ])
            ->statePath('data');
    }
    public function submit(): void
    {
        $data = $this->form->getState();
        
      
        $user = auth()->user();
        
        // Actualizar información básica
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
        ]);


        // Actualizar contraseña si se proporciona
        $currentPassword = $data['current_password'] ?? null;
        $newPassword = $data['new_password'] ?? null;
        
        if ($currentPassword && $newPassword) {
            if (!Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Error')
                    ->body('La contraseña actual es incorrecta')
                    ->danger()
                    ->send();
                return;
            }


            $user->update([
                'password' => Hash::make($data['new_password']),
            ]);
        }

        Notification::make()
            ->title('¡Perfil Actualizado!')
            ->body('Tu perfil ha sido actualizado exitosamente.')
            ->success()
            ->send();
    }
    public function getFormActions(): array
    {
        return [
            \Filament\Forms\Components\Actions\Action::make('save')
                ->label('Guardar Cambios')
                ->submit('save')
                ->color('primary')
                ->icon('heroicon-o-check'),
        ];
    }

}
