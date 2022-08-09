<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Evidencia;
use App\Models\EvidenciaUsuario;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $evidencias = Evidencia::all();
        return view('auth.register', compact('evidencias'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:8', 'unique:users'],
            'edad' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'rol' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'evidencias1' =>  ['mimes:pdf', 'max:20240'],
            'evidencias2' =>  ['mimes:pdf', 'max:20240'],
            'evidencias3' =>  ['mimes:pdf', 'max:20240'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'edad' => $request->edad,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password),
            'estado' => 2,
        ]);

        $user_id = $user->id;

        $count = Evidencia::count();

        for($i = 1; $i <= $count; $i++){
            $evi = Evidencia::where('id',$i)->get();
            foreach($evi as $item){
                $nombreEvidencia = $item->evidencia;
                $evidencia_id = $item->id;
            }

            $name = 'evidencias'.$evidencia_id;

            $data = $request->file('evidencias'.$evidencia_id);
            if($data != null){
                $data = $filename = $nombreEvidencia.".".$data->extension();
                $request->$name->move(public_path('Evidencias/'.$user_id), $filename);
    
                EvidenciaUsuario::create([
                    "user_id" => $user_id,
                    "evidencia_id" => $evidencia_id,
                    "documento_evidencia" => $filename,
                    "estado" => 1,
                ]);
            }
        }
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
