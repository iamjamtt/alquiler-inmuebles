<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrato Pdf</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif
        }
    </style>
</head>
<body class="container">
    <div class="d-block text-center justify-content-center">
        <h1 class="fw-bold">Contrato</h1>
    </div>

    <div>
        <div class="fw-bold mt-4">
            Empresa: <span class="fw-normal">Alquila Pucallpa</span> 
        </div>
        @foreach ($usuario as $item)
        <div class="fw-bold mt-3">
            Arrendatario: <span class="fw-normal">{{$item->name}} {{$item->apellidos}}</span> 
        </div>
        @endforeach
        <div class="fw-bold mt-3 mb-2">
            Locales alquilados
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle_contrato as $item)
            <tr>
                <td>{{$item->local->numero}}</td>
                <td>{{$item->local->descripcion}}</td>
                <td>{{$item->local->precio}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        @foreach ($contrato as $item)
        <div class="fw-bold mt-4">
            Tiempo de alquiler:<span class="fw-normal"> {{ $item->tiempo }} meses</span> 
        </div>
        <div class="fw-bold mt-3">
            Fecha inicio: <span class="fw-normal">{{ $item->fecha_inicio->format('d/m/Y') }} </span> 
        </div>
        <div class="fw-bold mt-3">
            Fecha fin: <span class="fw-normal">{{ $item->fecha_fin->format('d/m/Y') }} </span> 
        </div>
        <div class="fw-bold mt-3">
            Monto: <span class="fw-normal">${{ $item->monto }} </span> 
        </div>
        <div class="fw-bold mt-3">
            Penalidad: <span class="fw-normal">${{ $item->penalidad }} </span> 
        </div>
        @endforeach
        @foreach ($usuario as $item)
        <div class="d-flex flex-column bd-highlight mt-5">
            <div class="justify-end">
                <div class="fw-normal mt-4 text-center">
                    _________________
                </div>
                <div class="fw-normal text-center">
                    {{$item->name}} {{$item->apellidos}}
                </div>
                <div class="fw-normal text-center">
                    {{$item->dni}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>