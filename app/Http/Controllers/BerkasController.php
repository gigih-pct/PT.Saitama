<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    /**
     * Display a listing of the user's berkas.
     */
    public function index()
    {
        $berkasPendaftaran = Berkas::where('user_id', Auth::id())
            ->where('jenis_berkas', 'pendaftaran')
            ->get()
            ->keyBy('nama_berkas');

        $berkasSeleksi = Berkas::where('user_id', Auth::id())
            ->where('jenis_berkas', 'seleksi')
            ->get()
            ->keyBy('nama_berkas');

        return view('siswa.berkas', compact('berkasPendaftaran', 'berkasSeleksi'));
    }

    /**
     * Store a newly uploaded berkas.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_berkas' => 'required|in:pendaftaran,seleksi',
            'nama_berkas' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('berkas/' . Auth::id(), $fileName, 'public');

        Berkas::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'jenis_berkas' => $request->jenis_berkas,
                'nama_berkas' => $request->nama_berkas,
            ],
            [
                'file_path' => $filePath,
                'keterangan' => $request->keterangan,
                'status' => 'pending',
                'uploaded_at' => now(),
            ]
        );

        return back()->with('success', 'Berkas berhasil diupload!');
    }

    /**
     * Download a berkas file.
     */
    public function download($id)
    {
        $berkas = Berkas::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return Storage::disk('public')->download($berkas->file_path);
    }
}
