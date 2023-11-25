<?php

namespace App\Http\Controllers\Admin\Demografi;

use App\Http\Controllers\Controller;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pendidikan::all();
        $total = Pendidikan::sum('jumlah');
        return view('admin.demografi.pendidikan.index', compact('data', 'total'));
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
            'title' => 'required|unique:pendidikans,title',
            'jumlah' => 'required|numeric'
        ]);

        Pendidikan::create($request->only('title', 'jumlah'));

        return redirect()->route('demografi.pendidikan.index')->with('success', 'Data Pendidikan Telah disipan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pendidikan::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Data Pendidikan Kosong');
        }

        $data->delete();
        return redirect()->route('demografi.pendidikan.index')->with('success', 'Data Pendidikan Telah dhapus');
    }
}
