<?php

namespace App\Http\Controllers\Admin\Demografi;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Agama::all();
        $total = Agama::sum('jumlah');
        return view('admin.demografi.agama.index', compact('data', 'total'));
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
            'title' => 'required|unique:agamas,title',
            'jumlah' => 'required|numeric'
        ]);

        Agama::create($request->only('title', 'jumlah'));

        return redirect()->route('demografi.agama.index')->with('success', 'Data agama Telah disipan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Agama::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Data agama Kosong');
        }

        $data->delete();
        return redirect()->route('demografi.agama.index')->with('success', 'Data agama Telah dhapus');
    }
}
