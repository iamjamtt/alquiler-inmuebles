
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
                        <div class="text-xl flex justify-center font-bold">Reporte de locales mas alquilados</div>
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <div class="space-y-3 mt-6">
                            <form method="POST" action="{{ route('reporte.fecha2') }}">
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
                                <div id="container">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</x-app-layout>

<script>
    // Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Reporte'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total de locales alquilados por tipo de edificio'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: <?= $data ?>
        }
    ]
});
</script>