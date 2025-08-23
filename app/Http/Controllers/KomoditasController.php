<?php

namespace App\Http\Controllers;

use App\Models\Cabai;
use App\Models\Gudang;
use App\Models\Komoditas;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::all();

        if (auth()->user()->role == 'petani') {
            $komoditasPengajuan = Komoditas::where('status', 'pengajuan')->where('user_id', auth()->user()->id)->paginate(10);
            $komoditasTindakLanjut = Komoditas::whereIn('status', ['diterima', 'ditolak'])->where('user_id', auth()->user()->id)->paginate(10);
        } else {
            $komoditasPengajuan = Komoditas::where('status', 'pengajuan')->paginate(10);
            $komoditasTindakLanjut = Komoditas::whereIn('status', ['diterima', 'ditolak'])->paginate(10);
        }
        return view('komoditas.index', ['komoditasPengajuan' => $komoditasPengajuan, 'komoditasTindakLanjut' => $komoditasTindakLanjut, 'gudangs' => $gudangs]);
    }

    public function create()
    {
        $cabais = Cabai::all();
        return view('komoditas.create', ['cabais' => $cabais]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabai_id' => 'required',
            'quantity' => 'required',
        ]);
        $komoditas = new Komoditas();
        $komoditas->cabai_id = $request->cabai_id;
        $komoditas->quantity = $request->quantity;
        $komoditas->status = "pengajuan";
        $komoditas->user_id = auth()->user()->id;
        $komoditas->save();
        return redirect('/komoditas')->with('success', 'Data Komoditas Berhasil');
    }

    public function accept(Request $request, Komoditas $komoditas)
    {
        $komoditas->status = "diterima";
        $komoditas->gudang_id = $request->gudang_id;
        $komoditas->save();
        return redirect('/komoditas')->with('success', 'Data Komoditas Berhasil Diterima');
    }

    public function refuse(Komoditas $komoditas)
    {
        $komoditas->status = "ditolak";
        $komoditas->save();
        return redirect('/komoditas')->with('success', 'Data Komoditas Berhasil Ditolak');
    }


    public function destroy(Komoditas $komoditas)
{
    $komoditas->delete();

    return redirect()
        ->route('komoditas.index')
        ->with('success', 'Data Komoditas Berhasil Dihapus');
}
}
