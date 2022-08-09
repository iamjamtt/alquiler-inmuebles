
<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Reporte') }}
</h2>
</x-slot>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-gray-200 flex justify-center">
                    <div class="md:w-3/4">
                        @csrf
                        <div class="text-xl flex justify-center font-bold">Reporte de clientes verificados</div>
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <div class="space-y-3 mt-6">
                            <form method="POST" action="{{ route('reporte.fecha4') }}">
                            @csrf
                            <div class="flex flex-wrap mb-6 justify-center">
                                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0 ">
                                    <label class="block font-medium text-sm text-gray-700">
                                        Fecha Inicio
                                    </label>
                                    <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="date" name="fecha_inicio" value="{{old('fecha_inicio')}}">
                                </div> 
                                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0 ">
                                    <label class="block font-medium text-sm text-gray-700">
                                        Fecha Fin
                                    </label>
                                    <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="date" name="fecha_fin" value="{{old('fecha_fin')}}">
                                </div> 
                            </div>
                            <div class="flex justify-center">
                                <x-button class="w-64 mb-3 justify-center">
                                    {{ __('filtrar') }}
                                </x-button>
                            </div>
                            </form>
                            <div class="overflow-x-auto relative">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="text-sm text-center py-3 px-6">
                                                    ID
                                                </th>
                                                <th scope="col" class="text-sm text-center py-3 px-6">
                                                    Nombre
                                                </th>
                                                <th scope="col" class="text-sm text-center py-3 px-6">
                                                    Apellidos
                                                </th>
                                                <th scope="col" class="text-sm text-center py-3 px-6">
                                                    DNI
                                                </th>
                                                <th scope="col" class="text-sm text-center py-3 px-6">
                                                    Edad
                                                </th>
                                                <th scope="col" class="text-sm text-center py-3 px-6">
                                                    Correo
                                                </th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->id}}
                                                </th>
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->name}}
                                                </th>
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->apellidos}}
                                                </th>
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->dni}}
                                                </th>
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->edad}}
                                                </th>
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->email}}
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-10">
                    {{ $user->links() }}
                </div>
            </div>
        </div>
</div>
</x-app-layout>