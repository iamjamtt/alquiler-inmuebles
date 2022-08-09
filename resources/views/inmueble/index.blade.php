<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl uppercase text-gray-800 leading-tight">
            {{ __('Gestion de Edificios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('inmueble') }}" class=" bg-blue-500 hover:bg-blue-700 cursor-pointer py-2 px-5 rounded-lg text-white text-lg font-bold uppercase">
                    Agregar Edificio
                </a>
            </div>
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($edificio as $item)
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                    <div class="space-y-3 flex items-center">
                        <div class="w-64 mr-10">
                            <img src="{{asset('Fotos/'.$item->foto)}}" alt="" class="rounded-lg m-auto">
                        </div>
                        <div class="space-y-3">
                            <div class="text-3xl font-bold">
                                {{ $item->nombre }}
                            </div>
                            <p class="text-lg font-bold text-gray-600">
                                {{ $item->descripcion }}
                            </p>
                            <p class="text-sm font-bold text-gray-600">
                                Direccion: {{ $item->direccion}}
                            </p>
                        </div>
                    </div>
                    <div class="space-x-3 flex items-center justify-center">
                        <a href="{{ route('inmueble2',$item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 cursor-pointer py-2 px-5 rounded-lg text-white text-sm font-bold uppercase">
                            Agregar Locales
                        </a>
                        {{-- <button type="" class="bg-red-400 hover:bg-red-700 cursor-pointer py-2 px-5 rounded-lg text-white text-sm font-bold uppercase">
                            Desactivar publicacion
                        </button> --}}
                    </div>
                </div> 
                @endforeach
            </div>
            <div class="flex justify-center mt-10">
                {{ $edificio->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

