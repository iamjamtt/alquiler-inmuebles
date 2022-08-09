<x-app-layout>
    @if (Auth::user()->rol == 1)
    <x-slot name="header">
        <h2 class="font-bold text-2xl uppercase text-gray-800 leading-tight">
            {{ __('Nuevos Clientes') }}
        </h2>
    </x-slot>
    @else
    <x-slot name="header">
        <h2 class="font-bold text-2xl uppercase text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    @endif

    @if (Auth::user()->rol == 1)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($users as $item)
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                    <div class="space-y-3">
                        <div class="text-xl font-bold">
                            {{$item->name}} {{$item->apellidos}}
                        </div>
                        <p class="text-sm font-bold text-gray-600">
                            {{$item->email}}
                        </p>
                        <p class="text-sm font-bold text-gray-600">
                            Hora de registro: {{$item->created_at->format('g:i A d/m/Y')}}
                        </p>
                        @php
                            $i=0;
                            $o=0;
                        @endphp
                        @foreach ($evidencias as $item2)
                        @if ($item2->user_id == $item->id)
                        <p class="text-xl">
                            <a target="_blank" href="{{asset('Evidencias/'.$item2->user_id.'/'.$item2->documento_evidencia)}}" class="hover:text-gray-600 font-bold text-gray-500">
                                {{$item2->evidencia->evidencia}}
                            </a>
                        </p>
                        @php
                            $i++;
                        @endphp
                        @else
                        @php
                            $o++;
                        @endphp
                        @endif
                        @endforeach
                        @if ($i == 0 && $o >= 0)
                        <p class="text-xl hover:text-gray-600 font-bold text-gray-500">
                            No subio ninguna evidencia
                        </p>
                        @endif
                    </div>
                    <div class="space-y-3 flex flex-col items-center justify-center">
                        @if ($i != 0 && $o >= 0)
                        <p class="text-sm text-gray-600 mb-2">
                            Estado: <span class="font-bold">Por verificar</span>
                        </p>
                        <form action="{{ route('update.user',$item->id) }}" method="post">
                            {{ method_field('PUT') }}
                            @csrf
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 cursor-pointer py-2 px-5 rounded-lg text-white text-sm font-bold uppercase">
                                Verificar
                            </button>
                        </form>
                        @else
                        <p class="text-sm text-gray-600 mb-2">
                            Estado: <span class="font-bold">No se puede verificar</span>
                        </p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
        @if (Auth::user()->estado == 1)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-gray-200 md:flex md:justify-between md:items-center">
                            <div class="space-y-3">
                                <p class="text-4xl">Bienvenido <br> Alquila<span class="font-bold">Pucallpa</span></p>
                            </div>
                        </div>
                        <div class="p-6 space-y-3 mt-10">
                            <p class="text-sm">AlquilaPucallpa Derechos Reservados 2022</p>
                        </div>
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
    @endif
</x-app-layout>