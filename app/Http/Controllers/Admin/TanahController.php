<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Geolocation;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class TanahController extends Controller
{
    public function index(Request $request)
    {
        $pemilik = $request->pemilik;
        $nomor = $request->nomor;
        $data = Tanah::query()
            ->where('nomor', "like", "%" . $nomor . "%")
            ->where('nama_terbaru', 'like', '%' . $pemilik . '%')
            ->orWhere('nama_sebelumnya', "like", "%" . $pemilik . "%")
            ->paginate(5);

        // dd($data);
        return view('admin.tanah.index', compact('data'));
    }

    public function export()
    {
        $file = time() . '-Data Excell.xlsx';
        return (new FastExcel(Tanah::all()))->download($file, function ($tanah) {
            return [
                'Nomor' => $tanah->nomor,
                'Pemilik Terbaru' => $tanah->nama_terbaru,
                'Pemilik Sebelumnya' => $tanah->nama_sebelumnya,
                'Luas Tanah' => $tanah->luas_tanah,
                'Luas Bangunan' => $tanah->luas_bangunan,
                'Keterangan' => $tanah->keterangan,
                'Perubahan' => $tanah->perubahan,
                'Alamat' => $tanah->alamat,
            ];
        });
    }

    public function create()
    {
        return view('admin.tanah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required',
            'alamat' => 'required',
            'luas_tanah' => 'required|integer',
            'luas_bangunan' => 'required|integer',
            'pemilik_terbaru' => 'required',
            'pemilik_lama' => 'required',
            'keterangan' => 'required',
            'perubahan' => 'required',
            // 'geolokasi' => 'required',
        ]);

        if ($request->longtitude[0] == null || $request->latitude[0] == null) {
            # code...
            return redirect()->route('admin.tanah.create')->with('galat', 'Harap isi Geolokasi tanah');
        }

        $tanah = Tanah::create([
            'nomor' => $request->nomor,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'alamat' => $request->alamat,
            'nama_terbaru' => $request->pemilik_terbaru,
            'nama_sebelumnya' => $request->pemilik_lama,
            'keterangan' => $request->keterangan,
            'perubahan' => $request->perubahan,
            // 'geolocation' => json_encode($request->geolokasi),
        ]);

        foreach ($request->longtitude as $key => $value) {
            # code...
            Geolocation::create([
                'tanah_id' => $tanah->id,
                'longtitude' => $value,
                'latitude' => $request->latitude[$key]
            ]);
        }

        return redirect()->route('admin.tanah.index')->with('success', 'Data Barhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Tanah::find($id);
        $geo = Geolocation::where('tanah_id', $data->id)->get();

        $dataarray = [];
        foreach ($geo as $key => $item) {
            # code...
            $dataarray[$key] = [
                floatval($item->longtitude), floatval($item->latitude)
            ];
        }

        $json = [
            "type" => "FeatureCollection",
            "features" => [
                [
                    "type" => "Feature",
                    "id" => "03",
                    "properties" => [
                        "name" => "Daerah 3",
                        "density" => 500
                    ],
                    "geometry" => [
                        "type" => "Polygon",
                        "coordinates" => [
                            $dataarray
                        ]
                    ]
                ]
            ]
        ];
        // $json = json_encode($json);
        return view('admin.tanah.edit', compact('data', 'json', 'geo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'nomor' => 'required',
            'alamat' => 'required',
            'luas_tanah' => 'required|integer',
            'luas_bangunan' => 'required|integer',
            'pemilik_terbaru' => 'required',
            'pemilik_lama' => 'required',
            'keterangan' => 'required',
            'perubahan' => 'required',
        ]);

        $data = Tanah::find($id);
        if (empty($data)) {
            # code...
            return redirect()->route('admin.tanah.index')->with('galat', 'Data Tidak ada');
        }

        $data->update([
            // 'nomor' => $request->nomor,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'alamat' => $request->alamat,
            'nama_terbaru' => $request->pemilik_terbaru,
            'nama_sebelumnya' => $request->pemilik_lama,
            'keterangan' => $request->keterangan,
            'perubahan' => $request->perubahan,
        ]);

        Geolocation::where('tanah_id', $data->id)->delete();
        foreach ($request->longtitude as $key => $value) {
            # code...
            Geolocation::create([
                'tanah_id' => $data->id,
                'longtitude' => $value,
                'latitude' => $request->latitude[$key]
            ]);
        }
        return redirect()->route('admin.tanah.index')->with('success', 'Data Berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Tanah::find($id);
        if (empty($data)) {
            # code...
            return redirect()->route('admin.tanah.index')->with('galat', 'Data Tidak ada');
        }
        $data->delete();
        return redirect()->route('admin.tanah.index')->with('success', 'Data Berhasil dihapus');
    }
}
