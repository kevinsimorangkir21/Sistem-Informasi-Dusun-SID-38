<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        $data = Struktur::paginate(5);
        return view('admin.profile.struktur.index', compact('data'));
    }

    public function create()
    {
        return view('admin.profile.struktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg'
        ]);

        $file = $request->file('image');
        $filename = time() . '.' . $file->extension();

        Struktur::create([
            'jabatan' => $request->jabatan,
            'name' => $request->name,
            'image' => $filename,
        ]);

        $file->storeAs('public/image', $filename);

        return redirect()->route('admin.struktur.index')->with('success', 'Struktur berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Struktur::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Struktur Desa Kosong');
        }

        return view('admin.profile.struktur.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:png,jpg'
        ]);

        $data = Struktur::find($id);
        if (empty($data)) {
            # code...
            return redirect()->route('admin.struktur.index')->with('galat', 'Strutur Desa Kosong');
        }

        if ($request->image) {
            # code...

            unlink(public_path('storage/image/' . $data->image));
            $file = $request->file('image');
            $filename = time() . '.' . $file->extension();

            $data->update([
                'jabatan' => $request->jabatan,
                'name' => $request->name,
                'image' => $filename,
            ]);

            $file->storeAs('public/image', $filename);
        } else {
            $data->update([
                'jabatan' => $request->jabatan,
                'name' => $request->name,
            ]);
        }

        return redirect()->route('admin.struktur.index')->with('success', 'Struktur berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $data = Struktur::find($id);
        if (empty($data)) {
            # code...
            return redirect()->route('admin.struktur.index')->with('galat', 'Strutur Desa Kosong');
        }

        unlink(public_path('storage/image/' . $data->image));
        $data->delete();
        return redirect()->route('admin.struktur.index')->with('success', 'Struktur berhasil dihapus');
    }
}


// - Logo 
// - Print Excell
// - Paginate Struktur
// - gambar profile admin