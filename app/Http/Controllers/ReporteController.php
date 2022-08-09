<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\DetalleContrato;
use App\Models\User;
use App\Models\Local;
use App\Models\TipoEdificio;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function reporteFecha()
    {
        $contrato = Contrato::whereDate('fecha_registro',today())->paginate(10);
        return view('reporte.fecha', compact('contrato'));
    }

    public function filtrar(Request $request)
    {
        $request->validate([
            'fecha' => ['required', 'date']
        ]);
        $contrato = Contrato::where('fecha_registro',$request->fecha)->paginate(10);
        return view('reporte.fecha', compact('contrato'));
    }

    public function reporteFecha2()
    {
        $tipo = TipoEdificio::all();
        foreach($tipo as $item){
            $count = DetalleContrato::join('contrato','contrato.id','=','detalle_contrato.contrato_id')->where('detalle_contrato.tipo_edificio',$item->id)->whereDate('contrato.fecha_registro','<=',today())->whereDate('contrato.fecha_registro','>=',now()->subDays(30))->count();
            $nombre = $item->tipo_edificio;
            $count2[] = ['y' => $count, 'name' => $nombre];
        }
        
        return view('reporte.fecha2',['data' => json_encode($count2)]);
    }

    public function filtrar2(Request $request)
    {
        // dd($request);
        $request->validate([
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date']
        ]);
        $tipo = TipoEdificio::all();
        foreach($tipo as $item){
            $count = DetalleContrato::join('contrato','contrato.id','=','detalle_contrato.contrato_id')->where('detalle_contrato.tipo_edificio',$item->id)->whereDate('contrato.fecha_registro','<=',$request->fecha_fin)->whereDate('contrato.fecha_registro','>=',$request->fecha_inicio)->count();
            $nombre = $item->tipo_edificio;
            $count2[] = ['y' => $count, 'name' => $nombre];
        }
        
        return view('reporte.fecha2',['data' => json_encode($count2)]);
    }

    public function reporteFecha3()
    {
        $local = Local::whereDate('fecha_registro','<=',today())->whereDate('fecha_registro','>=',now()->subDays(30))->paginate(10);
        return view('reporte.fecha3', compact('local'));
    }

    public function filtrar3(Request $request)
    {
        $request->validate([
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date']
        ]);
        $local = Local::whereDate('fecha_registro','<=',$request->fecha_fin)->whereDate('fecha_registro','>=',$request->fecha_inicio)->paginate(10);
        return view('reporte.fecha3', compact('local'));
    }

    public function reporteFecha4()
    {
        $user = User::whereDate('created_at','<=',today())->whereDate('created_at','>=',now()->subDays(30))->where('estado',1)->where('rol',2)->paginate(10);
        return view('reporte.fecha4', compact('user'));
    }

    public function filtrar4(Request $request)
    {
        $request->validate([
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date']
        ]);
        $user = User::whereDate('created_at','<=',$request->fecha_fin)->whereDate('created_at','>=',$request->fecha_inicio)->where('estado',1)->where('rol',2)->paginate(10);
        return view('reporte.fecha4', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
