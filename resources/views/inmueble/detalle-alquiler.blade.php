<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
<body>
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
                    <div class="md:w-3/4">
                            @csrf
                            <div class="text-xl flex justify-center font-bold">Locales Alquilados</div>
                            <div class="space-y-3 mt-6">

                                <div class="overflow-x-auto relative">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="text-sm text-center py-3 px-6">
                                                        Local
                                                    </th>
                                                    <th scope="col" class="text-sm text-center py-3 px-6">
                                                        Piso
                                                    </th>
                                                    <th scope="col" class="text-sm text-center py-3 px-6">
                                                        Descripcion
                                                    </th>
                                                    <th scope="col" class="text-sm text-center py-3 px-6">
                                                        Precio
                                                    </th>
                                                    <th scope="col" class="text-sm text-center py-3 px-6">
                                                        Acciones
                                                    </th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($detalle_contrato as $item)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{$item->local->numero;}}
                                                    </th>
                                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        Piso {{$item->local->pisos->nombre;}}
                                                    </th>
                                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{$item->local->descripcion;}}
                                                    </th>
                                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{$item->local->precio;}}
                                                    </th>
                                                    <th scope="row" class="py-4 px-6 flex justify-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded">Cancelar Contrato</button> 
                                                        <form action="{{ route('update.contrato',$item->id) }}" method="post">
                                                            {{ method_field('PUT') }}
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">¿Desea cancelar su contrato?</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Al cancelar su contrato antes que termine la fecha<br>estimada, usted tendrá una penalidad del 20%. <br><br>
                                                                        Monto de contrato: ${{$item->subtotal}}
                                                                        <br><br>
                                                                        Penalidad (20%): $
                                                                        @php 
                                                                        $penalidad = $item->subtotal*0.20;
                                                                        @endphp
                                                                        {{$penalidad}}
                                                                        </div>
                                                                        <input type="hidden" name="penalidad" value="{{$penalidad}}">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="px-3 py-1 bg-slate-800 text-gray-200 hover:bg-slate-600 rounded" data-bs-dismiss="modal">Cerrar</button>
                                                                            <button type="submit"  class="px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded">Cancelar Contrato</button>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </form>
                                                    </th>
                                                </tr>
                                                
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>
</x-app-layout>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>