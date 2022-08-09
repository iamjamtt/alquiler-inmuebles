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
                         <form method="POST" action="{{ route('inmueble.store3') }}" class="md:w-3/4">
                              @csrf
                              <div class="text-xl flex justify-center font-bold">Datos Locales</div>
                              <div class="space-y-3 mt-6">

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
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @foreach ($local as $item)
                                                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                       <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            <input name="numero{{$item->id}}" type="number" value="{{$item->numero}}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-full" required>
                                                            @error('numero{{$item->id}}')
                                                                 <div class="bg-red-100 border-l-4 border-red-600 text-red-600 font-bold p-3 mt-2">{{ $message }}</div>
                                                            @enderror
                                                       </th>
                                                       <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            <input name="descripcion{{$item->id}}" type="text" value="" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-96" required>
                                                            @error('descripcion{{$item->id}}')
                                                                 <div class="bg-red-100 border-l-4 border-red-600 text-red-600 font-bold p-3 mt-2">{{ $message }}</div>
                                                            @enderror
                                                       </th>
                                                       <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            <input name="precio{{$item->id}}" type="number" value="" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-full" required>
                                                            @error('precio{{$item->id}}')
                                                                 <div class="bg-red-100 border-l-4 border-red-600 text-red-600 font-bold p-3 mt-2">{{ $message }}</div>
                                                            @enderror
                                                       </th>
                                                  </tr>
                                                  @endforeach
                                             </tbody>
                                        </table>
                                   </div>
                                   <input type="hidden" name="piso_id" value="{{$piso_id}}">
                                   <div class="flex justify-center">
                                        <x-button class="w-64 mt-4 justify-center">
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
