<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    /**
     * Display a listing of submitted berkas.
     */
    /**
     * Display pendaftaran documents.
     */
    public function pendaftaran(Request $request)
    {
        return $this->getBerkas($request, 'pendaftaran', 'admin.berkaspendaftaran');
    }

    /**
     * Display seleksi documents.
     */
    public function seleksi(Request $request)
    {
        return $this->getBerkas($request, 'seleksi', 'admin.berkasseleksi');
    }

    /**
     * Common logic for fetching berkas.
     */
    private function getBerkas(Request $request, $type, $view)
    {
        $query = Berkas::with(['user'])
            ->where('jenis_berkas', $type);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by student
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by document name (optional extra filter)
        if ($request->filled('nama_berkas')) {
            $query->where('nama_berkas', 'like', '%' . $request->nama_berkas . '%');
        }

        $berkas = $query->orderBy('uploaded_at', 'desc')
            ->paginate(20)
            ->appends($request->except('page'));

        $users = \App\Models\User::where('role', 'siswa')->get();

        return view($view, compact('berkas', 'users'));
    }

    /**
     * Display a listing (Generic fallback or redirect).
     */
    public function index(Request $request)
    {
        return redirect()->route('admin.berkaspendaftaran');
    }

    /**
     * Approve a berkas.
     */
    public function approve($id)
    {
        $berkas = Berkas::findOrFail($id);
        $berkas->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'reviewed_by' => Auth::guard('admin')->id(),
        ]);

        return back()->with('success', 'Berkas berhasil disetujui!');
    }

    /**
     * Reject a berkas.
     */
    public function reject($id)
    {
        $berkas = Berkas::findOrFail($id);
        $berkas->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => Auth::guard('admin')->id(),
        ]);

        return back()->with('success', 'Berkas ditolak.');
    }

    /**
     * Download a berkas file.
     */
    public function download($id)
    {
        $berkas = Berkas::findOrFail($id);
        return Storage::disk('public')->download($berkas->file_path);
    }
}
