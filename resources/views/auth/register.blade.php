<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="apellidos" :value="__('Apellidos')" />

                <x-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" :value="old('apellidos')" required autofocus />
            </div>

            
            <!-- Name -->
            <div class="mt-4">
                <x-label for="dni" :value="__('DNI')" />

                <x-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required autofocus />
            </div>

            
            <!-- Name -->
            <div class="mt-4">
                <x-label for="edad" :value="__('Edad')" />

                <x-input id="edad" class="block mt-1 w-full" type="number" name="edad" :value="old('edad')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="rol" :value="__('Rol')" />

                <select name="rol" id="rol" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-full">
                    <option>Seleccione una opcion</option>
                    {{-- <option value="1">Vendedor</option> --}}
                    <option value="2">Cliente</option>
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Repetir Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            @foreach ($evidencias as $item)
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700">{{ $item->evidencia }}</label>

                <input type="file" name="evidencias{{ $item->id }}" class="file:rounded-lg file:border-0 file:font-semibold file:bg-cian-800 p-2 block mt-1 w-full">
            </div>
            @endforeach

            <div class="flex items-center justify-end mt-4">
                <a class="font-bold text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya estas registrado?') }}
                </a>
            </div> 

            <div>
                <x-button class="w-full mt-4 justify-center">
                    {{ __('Crear Cuenta') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
