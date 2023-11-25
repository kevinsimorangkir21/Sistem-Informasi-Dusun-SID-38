<?php

namespace App\Http\Controllers\Admin\Demografi;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // agama 
        $agama = Agama::all();
        $total_agama = Agama::sum('jumlah');

        // pekerjaan
        $pekerjaan = Pekerjaan::all();
        $total_pekerjaan = Pekerjaan::sum('jumlah');

        // pendidikan
        $pendidikan = Pendidikan::all();
        $total_pendidikan = Pendidikan::sum('jumlah');

        // penduduk
        $penduduk = Penduduk::all();
        $total_penduduk = Penduduk::sum('jumlah');

        return view('admin.demografi.index', compact('agama', 'total_agama', 'penduduk', 'total_penduduk', 'pendidikan', 'total_pendidikan', 'pekerjaan', 'total_pekerjaan'));
    }
}
