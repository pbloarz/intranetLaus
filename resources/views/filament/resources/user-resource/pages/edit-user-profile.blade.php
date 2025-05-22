<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit="submit" class="space-y-6">
            {{ $this->form }}

            <div class="flex items-center justify-end mt-6 gap-x-3">
                <x-filament::button
                    type="submit"
                    color="primary"
                    icon="heroicon-o-check"
                >
                    {{ __('Guardar Cambios') }}
                </x-filament::button>
            </div>
        </form>
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>
