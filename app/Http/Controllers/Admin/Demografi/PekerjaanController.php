<?php

namespace App\Http\Controllers\Admin\Demografi;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pekerjaan::all();
        $total = Pekerjaan::sum('jumlah');
        return view('admin.demografi.pekerjaan.index', compact('data', 'total'));
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
            'title' => 'required|unique:Pekerjaans,title',
            'jumlah' => 'required|numeric'
        ]);

        Pekerjaan::create($request->only('title', 'jumlah'));

        return redirect()->route('demografi.pekerjaan.index')->with('success', 'Data Pekerjaan Telah disipan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pekerjaan::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Data Pekerjaan Kosong');
        }

        $data->delete();
        return redirect()->route('demografi.pekerjaan.index')->with('success', 'Data Pekerjaan Telah dhapus');
    }
}
