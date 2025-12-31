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
    public function index(Request $request)
    {
        $query = Berkas::with(['user'])
            ->where('jenis_berkas', 'pendaftaran');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by student
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by document type
        if ($request->filled('nama_berkas')) {
            $query->where('nama_berkas', $request->nama_berkas);
        }

        $berkas = $query->orderBy('uploaded_at', 'desc')
            ->paginate(20)
            ->appends($request->except('page'));

        $users = \App\Models\User::where('role', 'siswa')->get();

        return view('admin.berkaspendaftaran', compact('berkas', 'users'));
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
