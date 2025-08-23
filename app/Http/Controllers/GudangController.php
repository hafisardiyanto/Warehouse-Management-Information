<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Komoditas;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::paginate(10);
        return view('gudang.index', ["gudangs" => $gudangs]);
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $gudang = new Gudang();
        $gudang->name = $request->name;
        $gudang->save();
        return redirect('/gudang')->with("status", "Data Berhasil di Tambahkan");
    }

    public function show(Gudang $gudang)
    {
        $komoditasInWerehouse = Komoditas::where('gudang_id', $gudang->id)->paginate(10);
        return view('gudang.show', ["gudang" => $gudang, "komoditasInWerehouse" => $komoditasInWerehouse]);
    }

    public function sell(Request $request, Komoditas $komoditas)
    {
        $komoditas->quantity = $komoditas->quantity - $request->quantity;
        $komoditas->save();
        return redirect('/gudang/' . $komoditas->gudang_id)->with("status", "Komoditas berhasil dijual");
    }
}
