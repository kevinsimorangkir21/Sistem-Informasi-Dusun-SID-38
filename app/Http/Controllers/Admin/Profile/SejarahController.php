<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $data = Profile::where('title', 'sejarah')->first();
        return view('admin.profile.sejarah', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $check = Profile::where('title', 'sejarah')->first();
        if (empty($check)) {
            # code...
            Profile::create([
                'title' => $request->title,
                'body' => $request->body
            ]);
        } else {
            # code...
            $check->update([
                'body' => $request->body
            ]);
        }

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah Desa Berhasil disimpan');
    }
}
