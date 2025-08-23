<?php

namespace App\Http\Controllers;

use App\Models\Cabai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

class CabaiController extends Controller
{
    public function index()
    {
        $cabais = Cabai::paginate(10);
        return view('cabai.index', ['cabais' => $cabais]);
    }

    public function create()
    {
        return view('cabai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $cabai = new Cabai();
        $cabai->name = $request->input('name');
        $cabai->description = $request->input('description');

        // Menangkap file gambar dan menyimpannya
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Membuat nama file unik
            $image->move(public_path('images/cabais/'), $imageName); // Menyimpan ke folder 'public/images'
            $cabai->image = $imageName; // Menyimpan nama file ke database
        }

        $cabai->save();

        return redirect('/cabai')->with("status", "Data Berhasil di Tambahkan");
    }

    public function destroy($id)
    {
        $cabai = Cabai::find($id);
        $imagePath = public_path('images/cabais/' . $cabai->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath); // Hapus gambar
        }

        // Hapus data dari database
        $cabai->delete();
        return redirect('/cabai')->with("status", "Data Berhasil di Hapus");
    }

    public function edit($id)
    {
        $cabai = Cabai::find($id);
        return view('cabai.edit', ['cabai' => $cabai]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $cabai = Cabai::find($id);
        if ($request->hasFile('image')) {
            $imagePath = public_path('images/cabais/' . $cabai->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Hapus gambar
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Membuat nama file unik
            $image->move(public_path('images/cabais/'), $imageName); // Menyimpan ke folder 'public/images'
            $cabai->image = $imageName; // Menyimpan nama file ke database
        }
        $cabai->name = $request->input('name');
        $cabai->description = $request->input('description');
        $cabai->save();
        return redirect('/cabai')->with("status", "Data Berhasil di Ubah");
    }
}
