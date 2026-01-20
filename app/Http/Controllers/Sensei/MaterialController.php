<?php

namespace App\Http\Controllers\Sensei;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::where('sensei_id', Auth::id());

        // Apply filters
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }
        
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $materials = $query->orderBy('created_at', 'desc')->get();
        $kelases = Kelas::all();

        return view('sensei.pengajaran', compact('materials', 'kelases'));
    }

    public function store(Request $request)
    {
        \Log::info('Material Upload Attempt', ['request' => $request->all(), 'user_id' => Auth::guard('sensei')->id()]);

        if (!Auth::guard('sensei')->check()) {
            \Log::error('Material Upload Error: Sensei not authenticated');
            return redirect()->back()->withErrors(['auth' => 'Sesi Anda telah berakhir. Silakan login kembali.']);
        }

        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'subject' => 'required|string',
                'level' => 'required|string',
                'kelas_id' => 'nullable|exists:kelases,id',
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,doc,docx|max:10240', // Added doc/docx
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Material Validation Failed', ['errors' => $e->errors()]);
            throw $e;
        }

        $path = $request->file('file')->store('materials', 'public');

        $material = Material::create([
            'sensei_id' => Auth::guard('sensei')->id(),
            'kelas_id' => $request->kelas_id,
            'subject' => $request->subject,
            'title' => $request->title,
            'level' => $request->level,
            'file_path' => $path,
        ]);

        \Log::info('Material Created Successfully', ['id' => $material->id]);

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function download(Material $material)
    {
        // Check if the sensei owns the material for security
        if ($material->sensei_id !== Auth::id()) {
            abort(403);
        }

        $extension = pathinfo($material->file_path, PATHINFO_EXTENSION);
        $filename = $material->title . '.' . $extension;

        return Storage::disk('public')->download($material->file_path, $filename);
    }
}
