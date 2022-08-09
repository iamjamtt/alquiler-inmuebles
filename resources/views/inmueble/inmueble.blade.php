<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl uppercase text-gray-800 leading-tight">
            {{ __('Inmuebles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container my-12 mx-auto px-4 md:px-12">
                    <div class="text-xl flex justify-center font-bold mb-5">Inmuebles</div>
                    <div class="flex flex-wrap lg:-mx-4">
                        @if ($count == 0)
                        <p class="text-sm mt-10 w-full text-gray-600 flex justify-center">
                            Sin inmuebles
                        </p>
                        @else
                        @foreach ($edificio as $item)
                        <div class="w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                            <article class="overflow-hidden rounded-lg shadow-lg">
                
                                <a href="#">
                                    <img alt="Placeholder" class="block h-72 w-full" src="{{asset('Fotos/'.$item->foto)}}">
                                </a>
                
                                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                    <h1 class="text-lg">
                                        <p class=" text-black font-bold">
                                            {{ $item->nombre }}
                                        </p>
                                    </h1>
                                </header>
                                
                                <p class="text-sm mx-4 text-gray-600">
                                    {{ $item->descripcion }}
                                </p>

                                <p class="text-sm mx-4 mt-2 text-gray-600">
                                    {{ $item->direccion }}
                                </p>
                
                                <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                                    <a href="{{ route('alquilar',$item->id) }}" class="bg-blue-600 w-full text-center hover:bg-blue-700 cursor-pointer py-2 px-5 rounded-lg text-white text-sm font-bold uppercase">
                                        Alquilar
                                    </a>
                                </footer>
                            </article>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-10">
                {{ $edificio->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

