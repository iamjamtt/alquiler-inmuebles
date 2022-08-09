<?php

namespace App\Http\Controllers;

use App\Models\Evidencia;
use App\Models\EvidenciaUsuario;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('estado',2)->orderBy('id','DESC')->paginate(5);
        $evidencias = EvidenciaUsuario::all();
        return view('dashboard', compact('users','evidencias'));
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

    public function editPersona($id)
    {
        $user = User::find($id);
        return view('user.perfil', compact('user'));
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
        $user = User::find($id);
        $user->estado = 1;
        $user->save();
        return redirect()->route('dashboard');
    }

    public function updatePersona(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'apellidos' => ['required', 'string', 'max:200'],
            'dni' => ['required', 'string', 'max:8', 'min:8'],
            'edad' => ['required', 'numeric', 'min:0'],
        ]);

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->dni = $request->dni;
        $user->edad = $request->edad;
        $user->save();
        return redirect()->route('dashboard');

        dd($request);
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
