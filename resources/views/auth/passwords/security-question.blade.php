<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('favicons/favicon.ico') }}" alt="Logo" class="w-20 h-20 fill-current text-gray-500">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Ingrese su correo electrónico y haga clic en "Verificar Correo" para verificar su correo y mostrar su pregunta de seguridad.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="GET" action="{{ route('password.security-question') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Correo electrónico') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4" style="background-color: #4CAF50; color: white;">
                    {{ __('Verificar Correo') }}
                </x-button>
            </div>
        </form>

        @if(isset($securityQuestion))
        <div class="mt-4">
            <form method="POST" action="{{ route('password.security.verify') }}">
                @csrf

                <input type="hidden" name="email" value="{{ $email }}">

                <div class="block mt-4">
                    <x-label value="{{ __('Pregunta de Seguridad') }}" />
                    <p>{{ $securityQuestion }}</p>
                </div>

                <div class="block mt-4">
                    <x-label for="security_answer" value="{{ __('Respuesta de Seguridad') }}" />
                    <x-input id="security_answer" class="block mt-1 w-full" type="password" name="security_answer" required autocomplete="security-answer" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ms-4" style="background-color: #4CAF50; color: white;">
                        {{ __('Verificar Respuesta') }}
                    </x-button>
                </div>
            </form>
        </div>
        @endif
    </x-authentication-card>
</x-guest-layout>