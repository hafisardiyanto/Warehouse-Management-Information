<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- tambahkan ini
use Illuminate\Support\Facades\DB; 

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
        $petani->role = $request->role;

        // WAJIB: hash password
        $petani->password = Hash::make($request->password);

        $petani->save();

        return redirect('/petani')->with("status", "Data Berhasil di Tambahkan");
    }

  public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $petani = User::findOrFail($id);

            // 1. Hapus semua komoditas milik user ini
            $petani->komoditas()->delete();

            // 2. Baru hapus user-nya
            $petani->delete();
        });

        return redirect('/petani')->with("status", "Data Berhasil di Hapus");
    }
    

    // ...
   public function editPassword($id)
{
    $petani = User::findOrFail($id);
    return view('petani.edit-password', compact('petani'));
}

public function updatePassword(Request $request, $id)
{
    $request->validate([
        'password' => ['required', 'confirmed', 'min:6'],
    ]);

    $petani = User::findOrFail($id);

    // update password dengan hash
    $petani->password = Hash::make($request->password);
    $petani->save();

    return redirect('/petani')->with("status", "Password berhasil diperbarui!");
}

}
    
