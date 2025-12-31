<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the classes.
     */
    public function index()
    {
        $kelases = Kelas::with(['users' => function($q) {
            $q->orderBy('name');
        }])->withCount('users')->orderBy('nama_kelas')->get();
        // Fetch students who are approved and don't have a class assigned
        $unassignedStudents = \App\Models\User::where('status', 'approved')
            ->whereNull('kelas_id')
            ->orderBy('name')
            ->get();
            
        return view('admin.kelas.index', compact('kelases', 'unassignedStudents'));
    }

    /**
     * Assign a student to a class.
     */
    public function assignStudent(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $kelas = Kelas::withCount('users')->findOrFail($id);
        $user = \App\Models\User::findOrFail($request->user_id);

        if ($kelas->users_count >= $kelas->kapasitas) {
            return back()->withErrors(['error' => 'Kelas ' . $kelas->nama_kelas . ' sudah penuh.']);
        }

        $user->update(['kelas_id' => $kelas->id]);

        return back()->with('success', $user->name . ' berhasil ditambahkan ke kelas ' . $kelas->nama_kelas . '.');
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelases',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Kelas::create($request->all());

        return back()->with('success', 'Kelas berhasil dibuat.');
    }

    /**
     * Update the specified class in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelases,nama_kelas,' . $id,
            'kapasitas' => 'required|integer|min:1',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return back()->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        
        if ($kelas->users()->count() > 0) {
            return back()->withErrors(['error' => 'Kelas tidak bisa dihapus karena masih memiliki siswa.']);
        }

        $kelas->delete();

        return back()->with('success', 'Kelas berhasil dihapus.');
    }
}
