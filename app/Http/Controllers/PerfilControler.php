<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

       $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3','max:20', 'not_in:twiter,editar-perfil'],
            'email' => ['required','unique:users,email,'.auth()->user()->id, 'email', 'max:70']
       ]);

       if($request->imagen){
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid().".".$imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            $imagenPath = public_path('perfiles')."/".$nombreImagen;
            $imagenServidor->save($imagenPath);  
       }

       $usuario = User::find(auth()->user()->id);   
       $usuario->username = $request->username;
       $usuario->email = $request->email;
       $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
       $usuario->save(); 

       if($request->oldpassword || $request->password) {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->oldpassword, auth()->user()->password)) {
            $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
            $usuario->save();
        } else {
            return back()->with('mensaje', 'La Contraseña Actual no Coincide');
        }
    }

       //redireccionar usuario
       return redirect()->route('post.index', $usuario->username);
    }
}
