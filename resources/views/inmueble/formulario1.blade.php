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
                         <form method="POST" action="{{ route('inmueble.store1') }}" enctype="multipart/form-data" novalidate class="md:w-1/2">
                              @csrf
                              <!-- Validation Errors -->
                              <x-auth-validation-errors class="mb-4" :errors="$errors" />
                              <div class="space-y-3">
                                   <div class="text-xl flex justify-center font-bold">Edificios</div>

                                   <x-label :value="__('Nombre Edificio')" />
                                   <x-input 
                                        class="block mt-1 w-full" 
                                        type="text" 
                                        name="nombre_edificio" 
                                        :value="old('nombre_edificio')" 
                                        required autofocus 
                                   />

                                   <x-label :value="__('Direccion')" />
                                   <x-input 
                                        class="block mt-1 w-full" 
                                        type="text" 
                                        name="direccion" 
                                        :value="old('direccion')" 
                                        required autofocus 
                                   />

                                   <x-label :value="__('Numero Pisos')" />
                                   <x-input 
                                        class="block mt-1 w-full" 
                                        type="number" 
                                        name="numero_pisos" 
                                        :value="old('numero_pisos')" 
                                        required autofocus 
                                   />

                                   <x-label :value="__('Descripcion')" />
                                   <x-input 
                                        class="block mt-1 w-full" 
                                        type="text" 
                                        name="descripcion" 
                                        :value="old('descripcion')" 
                                        required autofocus 
                                   />

                                   <div class="mt-4">
                                        <x-label class="mb-3" :value="__('Tipo de Edificio')" />
                         
                                        <select name="tipo_edificio"  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-full">
                                             <option values="">Seleccione una opcion</option>
                                             @foreach ($tipo_edificio as $item)
                                             <option value="{{$item->id}}">{{$item->tipo_edificio}}</option>
                                             @endforeach
                                        </select>
                                   </div>

                                   <div class="mt-4">
                                        <label class="block font-medium text-sm text-gray-700 mb-3">Imagen</label>
                                        <input 
                                             type="file" 
                                             name="foto" 
                                             class="file:rounded-lg file:border-0 file:px-6 file:py-2 file:font-semibold file:bg-cian-900 block mt-1 w-full text-gray-700">
                                   </div>

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
