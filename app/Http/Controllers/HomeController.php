<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Geolocation;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Penduduk;
use App\Models\Profile;
use App\Models\Struktur;
use App\Models\Tanah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataTanah = Tanah::with('geolocation')->get();
        // dd($dataTanah);
        $sejarah = Profile::where('title', 'sejarah')->pluck('body')->first();
        $struktur = Struktur::all();

        $tanahJson = [];
        foreach ($dataTanah as $no => $tanah) {
            $dataarray = [];
            # code..
            $geo = Geolocation::where('tanah_id', $tanah->id)->get();
            foreach ($geo as $key => $item) {
                # code...
                $dataarray[$key] = [
                    floatval($item->longtitude), floatval($item->latitude)
                ];
            }
            $tanahJson[$no] = [
                "type" => "Feature",
                "id" => $no,
                "properties" => [
                    "nama_terbaru" => $tanah->nama_terbaru,
                    "nama_sebelumnya" => $tanah->nama_sebelumnya,
                    "keterangan" => $tanah->keterangan,
                    "perubahan" => $tanah->perubahan,
                    "luas_tanah" => $tanah->luas_tanah,
                    "luas_bangunan" => $tanah->luas_bangunan,
                    // "nomor" => $tanah->nomor,
                    "alamat" => $tanah->alamat,
                ],
                "geometry" => [
                    "type" => "Polygon",
                    "coordinates" => [
                        $dataarray
                    ]
                ]
            ];
        }

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

        return view('welcome', compact('tanahJson', 'sejarah', 'struktur', 'agama', 'total_agama', 'penduduk', 'total_penduduk', 'pendidikan', 'total_pendidikan', 'pekerjaan', 'total_pekerjaan'));
    }
}
