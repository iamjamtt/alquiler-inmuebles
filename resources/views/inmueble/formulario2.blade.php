<x-app-layout>
     <x-slot name="header">
     <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Crear Inmueble') }}
     </h2>
     </x-slot>

     <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-gray-200 flex justify-center">
                         <form method="POST" action="{{ route('inmueble.store2') }}" novalidate class="md:w-1/2">
                              @csrf
                              <div class="text-xl flex justify-center font-bold">Generar Locales</div>
                              <!-- Validation Errors -->
                              <x-auth-validation-errors class="mb-4" :errors="$errors" />
                              <div class="space-y-3">

                                   <div class="mt-4">
                                        <x-label class="mb-3" :value="__('Pisos')" />
                         
                                        <select name="piso"  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-full">
                                             <option value=" ">Seleccione un piso</option>
                                             @foreach ($pisos as $item)
                                             <option value="{{$item->id}}">Piso {{$item->nombre}}</option>
                                             @endforeach
                                        </select>
                                   </div>

                                   <x-label :value="__('Numero Locales')" />
                                   <x-input 
                                        class="block mt-1 w-full" 
                                        type="number" 
                                        name="numero_locales" 
                                        :value="old('numero_locales')" 
                                        required autofocus 
                                   />

                                   <input type="hidden" name="edificio_id" value="{{$edificio_id}}">

                                   <div>
                                        <x-button class="w-full mt-4 justify-center">
                                             {{ __('Generar') }}
                                        </x-button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</x-app-layout>
