<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MyUserImport implements ToModel, WithHeadingRow
{
    private $importCount = 0;

    /**
     * @param array $row
     */
    public function model(array $row)
    {
        // Verificamos que los datos existan antes de procesarlos
        if (!isset($row['name']) || !isset($row['email'])) {
            return null;
        }

        // Buscamos los IDs correspondientes
        $country_id = null;
        $state_id = null;
        $city_id = null;

        if (isset($row['country'])) {
            $country = Country::where('name', $row['country'])->first();
            $country_id = $country ? $country->id : null;
        }

        if (isset($row['state'])) {
            $state = State::where('name', $row['state'])->first();
            $state_id = $state ? $state->id : null;
        }

        if (isset($row['city'])) {
            $city = City::where('name', $row['city'])->first();
            $city_id = $city ? $city->id : null;
        }

        try {
            $user = new User([
                'name' => trim($row['name']),
                'email' => trim($row['email']),
                'password' => Hash::make($row['password'] ?? '12345678'),
                'country_id' => $country_id,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'address' => $row['address'] ?? '',
                'phone' => $row['phone'] ?? ''
            ]);

            $user->save();
            $this->importCount++;

            $user->assignRole('client');
            // Mostramos la notificación de éxito
            Notification::make()
                ->title('✅ Importación Exitosa')
                ->body("Se han importado {$this->importCount} registros correctamente.")
                ->success()
                ->send();
        } catch (\Exception $e) {
            // Mostramos la notificación de error
            Notification::make()
                ->title('❌ Error en la Importación')
                ->body("Error al importar el registro: {$e->getMessage()}")
                ->danger()
                ->send();
        }

        return $user;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
