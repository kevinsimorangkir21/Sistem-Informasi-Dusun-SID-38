<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Geolocation;
use App\Models\Tanah;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $dataTanah = Tanah::with('geolocation')->get();
        // dd($dataTanah);

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

        // return $tanahJson;
        return view('admin.index', compact('dataTanah', 'tanahJson'));
    }
}
