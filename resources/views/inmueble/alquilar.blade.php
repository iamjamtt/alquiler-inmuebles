<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Alquiler') }}
    </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-gray-200 flex justify-center">
                    <form method="POST" action="{{ route('alquilarInmueble') }}" enctype="multipart/form-data" novalidate class="md:w-1/2">
                    @csrf
                    <div class="text-xl flex justify-center font-bold mb-7">Alquiler</div>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="edificio_id" value="{{ $edicio_id }}">
                        <div class="flex flex-wrap mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block font-medium text-sm text-gray-700">
                                    DNI
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" value="{{ Auth::user()->dni }}">
                            </div> 
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block font-medium text-sm text-gray-700">
                                    Nombre
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" value="{{ Auth::user()->name }} {{ Auth::user()->apellidos }}">
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="w-full px-3">
                                <label class="block font-medium text-sm text-gray-700">
                                    Inmueble
                                </label>
                                @foreach ($edificio as $item)
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" value="{{$item->nombre}}">
                                @endforeach
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block font-medium text-sm text-gray-700">
                                    Tiempo Meses
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" name="tiempo" value="{{ old('tiempo') }}">
                                </div> 
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block font-medium text-sm text-gray-700">
                                    Fecha Inicio
                                </label>
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="date" name="fecha_inicio" min="{{ $actual }}" max="{{ $final }}" value="{{ old('fecha_inicio') }}">
                            </div>
                        </div>
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="text-sm text-center py-3 px-6">
                                            Numero Local
                                        </th>
                                        <th scope="col" class="text-sm text-center py-3 px-6">
                                            Descripcion
                                        </th>
                                        <th scope="col" class="text-sm text-center py-3 px-6">
                                            Precio
                                        </th>
                                        <th scope="col" class="text-sm text-center py-3 px-6">
                                            Elegir
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($local as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->numero }}
                                        </th>
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->descripcion }}
                                        </th>
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->precio }}
                                        </th>
                                        <th scope="row" class="py-4 px-6 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="seleccionar[]" value="{{ $item->id }}">
                                            <input type="hidden" name="precio[]" value="{{ $item->precio }}">
                                        </th>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <x-button class="w-full mt-4 justify-center">
                                {{ __('Alquilar') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
