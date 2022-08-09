<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Editar Perfil') }}
    </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-gray-200 flex justify-center">
                    <form method="POST" action="{{ route('editar.perfil2') }}" novalidate class="md:w-1/2">
                    @csrf
                    <div class="text-xl flex justify-center font-bold mb-7">Editar Perfil</div>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="flex flex-wrap mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block font-medium text-sm text-gray-700 mb-3">
                                    Nombre
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block font-medium text-sm text-gray-700 mb-3">
                                    Apellidos
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" name="apellidos" value="{{ Auth::user()->apellidos }}">
                            </div> 
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block font-medium text-sm text-gray-700 mb-3">
                                    DNI
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" name="dni" value="{{ Auth::user()->dni }}">
                            </div> 
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block font-medium text-sm text-gray-700 mb-3">
                                    Edad
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="number" name="edad" value="{{ Auth::user()->edad }}">
                            </div>
                        </div>
                        <div>
                            <x-button class="w-full mt-4 justify-center">
                                {{ __('Guardar') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
