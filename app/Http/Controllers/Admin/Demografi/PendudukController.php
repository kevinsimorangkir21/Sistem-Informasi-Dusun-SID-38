<?php

namespace App\Http\Controllers\Admin\Demografi;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penduduk::all();
        $total = Penduduk::sum('jumlah');
        return view('admin.demografi.penduduk.index', compact('data', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:penduduks,title',
            'jumlah' => 'required|numeric'
        ]);

        Penduduk::create($request->only('title', 'jumlah'));

        return redirect()->route('demografi.penduduk.index')->with('success', 'Data penduduk Telah disipan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Penduduk::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Data penduduk Kosong');
        }

        $data->delete();
        return redirect()->route('demografi.penduduk.index')->with('success', 'Data penduduk Telah dhapus');
    }
}
