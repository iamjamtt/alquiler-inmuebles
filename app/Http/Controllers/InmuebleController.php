<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\DetalleContrato;
use App\Models\Edificio;
use App\Models\Local;
use App\Models\Pisos;
use App\Models\TipoEdificio;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edificio = Edificio::orderBy('id','DESC')->paginate(5);
        return view('inmueble.index', compact('edificio'));
    }

    public function userIndex()
    {
        $count = Edificio::count();
        $edificio = Edificio::where('estado',1)->orderBy('id','DESC')->paginate(6);
        return view('inmueble.inmueble', compact('edificio', 'count'));
    }
    public function alquilar($edicio_id)
    {
        $edificio = Edificio::where('id',$edicio_id)->get();
        
        $local = Local::where('edificio',$edicio_id)->where('estado',1)->orderBy('numero','ASC')->get();

        $actual = date('Y-m-d');
        $final = date('Y-m-d',strtotime($actual."+ 1 week"));
            
        return view('inmueble.alquilar', compact('edificio', 'edicio_id', 'local', 'actual', 'final'));
    }

    public function misInmuebles($user_id)
    {
        $contrato = Contrato::where('user_id', $user_id)->where('estado',1)->orderBy('id','DESC')->paginate(5);
        return view('inmueble.misInmuebles', compact('contrato'));
    }

    public function misInmueblesHistorial($user_id)
    {
        $contrato = Contrato::where('user_id', $user_id)->where('estado',2)->orderBy('id','DESC')->paginate(5);
        return view('inmueble.historialAlquiler', compact('contrato'));
    }

    public function detalleAlquiler($contrato_id)
    {
        $detalle_contrato = DetalleContrato::where('contrato_id', $contrato_id)->where('estado',1)->get();
        return view('inmueble.detalle-alquiler', compact('detalle_contrato'));
    }

    public function updateContrato(Request $request, $id)
    {
        $detalle = DetalleContrato::find($id);
        $detalle->estado = 2;
        $detalle->save();

        $detalle_contrato = DetalleContrato::where('id',$id)->get();
        foreach($detalle_contrato as $item){
            $local_id = $item->local_id;
            $contrato_id = $item->contrato_id;
            $subtotal = $item->subtotal;
        }
        $det_con = DetalleContrato::where('contrato_id',$contrato_id)->get();

        $local = Local::find($local_id);
        $local->estado = 1;
        $local->save();

        $lo = Local::where('id',$local_id)->get();
        foreach($lo as $item){
            $edificio = $item->edificio;
        }

        $countLocales = Local::where('estado',1)->where('edificio',$edificio)->count();
        if($countLocales == 0){
            $edi = Edificio::find($edificio);
            $edi->estado = 2;
            $edi->save();
        }else if($countLocales > 0){
            $edi = Edificio::find($edificio);
            $edi->estado = 1;
            $edi->save();
        }

        $count = DetalleContrato::where('estado',1)->where('contrato_id',$contrato_id)->count();
        if($count == 0){
            $cont = Contrato::find($contrato_id);
            $cont->estado = 2;
            $cont->save();
        }else if($count > 0){
            $cont = Contrato::find($contrato_id);
            $cont->estado = 1;
            $cont->save();
        }

        $con = Contrato::where('id',$contrato_id)->get();
        foreach($con as $item){
            $montoAnt = $item->penalidad;
        }
        
        $contrato = Contrato::find($contrato_id);
        $nuevoMonto = $montoAnt + $request->penalidad;

        $contrato->penalidad = $nuevoMonto;
        $contrato->save();

        $contrato2 = Contrato::find($contrato_id);
        $con2 = Contrato::where('id',$contrato_id)->get();
        $usuario = User::where('id',$request->user_id)->get();
        $data = [
            'contrato' => $con2,
            'detalle_contrato' => $det_con,
            'usuario' => $usuario
        ]; 
        $nombre_contrato = time().'_contrato.pdf';
        $pdf = \PDF::loadView('inmueble.contrato', $data)->save(public_path('Evidencias/'.$request->user_id.'/'). $nombre_contrato);
        $contrato2->contrato = $nombre_contrato;
        $contrato2->save();
        
        return redirect()->route('misInmuebles',[$request->user_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_edificio = TipoEdificio::all();
        return view('inmueble.formulario1', compact('tipo_edificio'));
    }

    public function create2($edificio_id)
    {
        $pisos = Pisos::where('edificio_id',$edificio_id)->where('estado',1)->get();
        return view('inmueble.formulario2', compact('pisos', 'edificio_id'));
    }

    public function create3($piso_id)
    {
        $local = Local::where('piso_id',$piso_id)->get();
        return view('inmueble.formulario3', compact('local', 'piso_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoEdificio = TipoEdificio::where('id',$request->tipo_edificio)->get();
        foreach($tipoEdificio as $item){
            $limite = $item->limite_pisos;
        }

        if($request->numero_pisos > $limite){
            $request->validate([
                'numero_pisos' => ['required', 'numeric', 'max:'.$limite],
            ]);
        }

        $request->validate([
            'nombre_edificio' => ['required', 'string', 'max:200'],
            'direccion' => ['required', 'string', 'max:200'],
            'numero_pisos' => ['required', 'numeric'],
            'descripcion' => ['required', 'string', 'max:200'],
            'tipo_edificio' => ['required', 'numeric'],
            'foto' =>  ['required', 'mimes:jpg,png,jpeg', 'max:10240'],
        ]);

        $nombre = $request->nombre_edificio;
        $data = $request->file('foto');
        $data = $filename = time().'_'.$nombre.'.'.$data->extension();
        $request->foto->move(public_path('Fotos/'), $filename);

        $edificio = Edificio::create([
            'nombre' => $request->nombre_edificio,
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'foto' => $filename,
            'pisos' => $request->numero_pisos,
            'estado' => 1,
            'tipo_edificio_id' => $request->tipo_edificio,
        ]);

        for($i=1; $i<=$request->numero_pisos; $i++) {
            Pisos::create([
                'nombre' => $i,
                'estado' => 1,
                'edificio_id' => $edificio->id,
            ]);
        }

        return redirect()->route('inmueble2', [$edificio->id]);
    }

    public function store2(Request $request)
    {
        //validar numero de locales
        $edicio = Edificio::where('id',$request->edificio_id)->get();
        foreach($edicio as $item){
            $tipo_edificio_id = $item->tipo_edificio_id;
        }

        $tipoEdificio = TipoEdificio::where('id',$tipo_edificio_id)->get();
        foreach($tipoEdificio as $item){
            $limite = $item->limite_locales;
        }

        $request->validate([
            'piso' => ['required', 'numeric'],
            'numero_locales' => ['required', 'numeric'],
        ]);

        if($request->numero_locales > $limite){
            $request->validate([
                'numero_locales' => ['required', 'numeric', 'max:'.$limite],
            ]);
        }

        $piso = Pisos::find($request->piso);
        $piso->numero_locales = $request->numero_locales;
        $piso->save();

        $pisos = Pisos::where('id',$request->piso)->get();
        foreach($pisos as $item){
            $nombre = $item->nombre;
        }

        for($i=1; $i<=$request->numero_locales; $i++) {
            $numero = $nombre.'0'.$i;
            $local = Local::create([
                'numero' => $numero,
                'edificio' => $request->edificio_id,
                'piso_id' => $request->piso,
            ]);
        }

        return redirect()->route('inmueble3', [$request->piso]);
    }

    public function store3(Request $request)
    {
        $local = Local::where('piso_id',$request->piso_id)->get();
        foreach($local as $item){
            $numero = 'numero'.$item->id;
            $descripcion = 'descripcion'.$item->id;
            $precio = 'precio'.$item->id;
            $request->validate([
                $numero => ['required','numeric'],
                $descripcion => ['required','string'],
                $precio => ['required'],
            ]);
        }

        foreach($local as $item){
            $descripcion2 = 'descripcion'.$item->id;
            $precio2 = 'precio'.$item->id;
            $local_id = $item->id;
            $local = Local::find($local_id);
            $local->descripcion = $request->$descripcion2;
            $local->precio = $request->$precio2;
            $local->estado = 1;
            $local->save();
        }

        $piso = Pisos::find($request->piso_id);
        $piso->estado = 2;
        $piso->save();

        return redirect()->route('inmueble.index');
    }

    public function alquilarInmueble(Request $request)
    {
        $suma = 0;

        $request->validate([
            'fecha_inicio' => ['required', 'date'],
            'tiempo' => ['required', 'numeric'],
        ]);

        foreach($request->seleccionar as $key=>$name){
            $ingresar = [
                'local_id' => $request->seleccionar[$key],
            ];
            $precio = Local::where('id',$request->seleccionar[$key])->get();
            foreach($precio as $item){
                $pre = $item->precio;
            }
            $suma += $pre;
        }
        
        $tiempo = $request->tiempo;
        $valor = '+ '.intval($tiempo).' month';
        $final = date('Y-m-d',strtotime($request->fecha_inicio.$valor));
        
        $contrato = Contrato::create([
            'user_id' => $request->user_id,
            'monto' => $suma,
            'tiempo' => $request->tiempo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $final,
            'estado' => 1,
            'penalidad' => 0,
        ]);

        foreach($request->seleccionar as $key=>$name){
            $precioo = Local::where('id',$request->seleccionar[$key])->get();
            foreach($precioo as $item){
                $pree = $item->precio;
                $edificioo = $item->edificio;
            }
            $edifi = Edificio::where('id',$edificioo)->get();
            foreach($edifi as $item){
                $tipo_id = $item->tipo_edificio_id;
            }
            $detalle_contrato = DetalleContrato::create([
                'contrato_id' => $contrato->id,
                'local_id' => $request->seleccionar[$key],
                'edificio' => $edificioo,
                'tipo_edificio' => $tipo_id,
                'subtotal' => $pree,
                'estado' => 1,
            ]);

            $locales = Local::find($request->seleccionar[$key]);
            $locales->estado = 2;
            $locales->save();
        }

        $countLocales = Local::where('estado',1)->where('edificio',$request->edificio_id)->count();
        if($countLocales == 0){
            $edi = Edificio::find($request->edificio_id);
            $edi->estado = 2;
            $edi->save();
        }

        return redirect()->route('contrato', [$contrato->id]);
    }

    public function contratoPDF($contrato_id)
    {
        $contrato = Contrato::where('id',$contrato_id)->get();
        foreach($contrato as $item){
            $usuario_id = $item->user_id;
        }
        $usuario = User::where('id',$usuario_id)->get();
        $detalle_contrato = DetalleContrato::where('contrato_id',$contrato_id)->get();

        $data = [
            'contrato' => $contrato,
            'detalle_contrato' => $detalle_contrato,
            'usuario' => $usuario
        ]; 

        $nombre_contrato = time().'_contrato.pdf';
        $pdf = \PDF::loadView('inmueble.contrato', $data)->save(public_path('Evidencias/'.$usuario_id.'/'). $nombre_contrato);
        
        $con = Contrato::find($contrato_id);
        $con->contrato = $nombre_contrato;
        $con->save();

        return redirect()->route('dashboard');
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
