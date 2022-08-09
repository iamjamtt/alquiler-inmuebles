<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl uppercase text-gray-800 leading-tight">
            {{ __('Mis Inmuebles') }}
        </h2>
    </x-slot>

    @if (Auth::user()->estado == 1)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 px-10 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-xl flex justify-center font-bold">Historial - Mis Alquileres</div>
                @foreach ($contrato as $item)
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center" >
                    <div class="space-y-3">
                        <div class="text-xl font-bold">
                            Alquiler N° {{$item->id}}
                        </div>
                        <p class="text-sm font-bold text-gray-600">
                            Fecha inicio: {{$item->fecha_inicio->format('d/m/Y')}}
                        </p>
                        <p class="text-sm font-bold text-gray-600">
                            Fecha fin: {{$item->fecha_fin->format('d/m/Y')}}
                        </p>
                        <p class="text-sm font-bold text-gray-600">
                        </p>
                        
                        <p class="text-xl">
                            <a target="_blank" href="{{asset('Evidencias/'.Auth::user()->id.'/'.$item->contrato)}}" class="hover:text-gray-600 font-bold text-gray-500 flex items-center">
                                <i class="ri-file-line mr-2"></i> Contrato 
                            </a>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-center md:items-center">
                    <div class="space-y-3">
                        <p class="text-sm w-full text-gray-600 text-center">
                            Falta verificar cuenta con el administrador
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>