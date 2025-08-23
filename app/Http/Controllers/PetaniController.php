<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rules\Password;

class PetaniController extends Controller
{
    public function index()
    {
        $petanis = User::paginate(10);
        return view('petani.index', ['petanis' => $petanis]);
    }

    public function create()
    {
        return view('petani.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'role' => 'required',
            'password' => ['required', 'confirmed'],
        ]);

        $petani = new User();
        $petani->name = $request->name;
        $petani->email = $request->email;
        $petani->password = $request->password;
        $petani->role = $request->role;
        $petani->save();
        return redirect('/petani')->with("status", "Data Berhasil di Tambahkan");
    }

    public function destroy($id)
    {
        $petani = User::find($id);
        $petani->delete();
        return redirect('/petani')->with("status", "Data Berhasil di Hapus");
    }
}
