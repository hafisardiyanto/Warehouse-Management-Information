<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetaniController extends Controller
{
    public function index()
    {
        // hanya user dengan role 'petani' (kalau mau filter). 
        // Kalau mau semua user, ganti jadi: User::paginate(10);
        $petanis = User::paginate(10);

        return view('petani.index', compact('petanis'));
    }

    public function create()
    {
        return view('petani.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => ['required', 'email', 'unique:users'],
            'role'     => 'required',
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $petani = new User();
        $petani->name  = $request->name;
        $petani->email = $request->email;
        $petani->role  = $request->role;

        // WAJIB: simpan password dalam bentuk hash (bcrypt)
        $petani->password = Hash::make($request->password);

        $petani->save();

        return redirect()->route('petani.index')
            ->with("status", "Data Petani berhasil ditambahkan");
    }

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
    $petani->password = \Illuminate\Support\Facades\Hash::make($request->password);
    $petani->save();

    return redirect()->route('petani.index')->with('status', 'Password petani berhasil diperbarui');
}

    public function destroy($id)
    {
        $petani = User::findOrFail($id);
        $petani->delete();

        return redirect()->route('petani.index')
            ->with("status", "Data Petani berhasil dihapus");
    }
}
