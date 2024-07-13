<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('favicons/favicon.ico') }}" alt="Logo" class="w-20 h-20 fill-current text-gray-500">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Por favor seleccione cómo desea recuperar su contraseña.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.option.handle') }}">
            @csrf

            <div class="block">
                <x-label for="recovery_option" value="{{ __('Opción de recuperación') }}" />
                <select id="recovery_option" name="recovery_option" class="block mt-1 w-full" required>
                    <option value="">{{ __('--Seleccione una opción--') }}</option>
                    <option value="email">{{ __('Vía Correo') }}</option>
                    <option value="security_question">{{ __('Vía Pregunta de Seguridad') }}</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4" style="background-color: #4CAF50; color: white;">
                    {{ __('Siguiente') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>