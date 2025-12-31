<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of approved students.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa')
            ->whereIn('status', ['approved', 'pending'])
            ->with('kelas');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by class
        if ($request->filled('kelas_id')) {
            if ($request->kelas_id === 'unassigned') {
                $query->whereNull('kelas_id');
            } else {
                $query->where('kelas_id', $request->kelas_id);
            }
        }

        $students = $query->orderBy('status', 'desc')
            ->orderBy('name')
            ->paginate(50)
            ->appends($request->except('page'));
            
        $kelases = Kelas::withCount('users')->get();

        return view('admin.datakelas', compact('students', 'kelases'));
    }

    /**
     * Assign a class to a student.
     */
    public function assignClass(Request $request, $id)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelases,id',
        ]);

        $kelas = Kelas::withCount('users')->findOrFail($request->kelas_id);
        
        if ($kelas->users_count >= $kelas->kapasitas) {
            return back()->withErrors(['error' => 'Kelas ' . $kelas->nama_kelas . ' sudah penuh.']);
        }

        $user = User::findOrFail($id);
        $user->update(['kelas_id' => $request->kelas_id]);

        return back()->with('success', 'Kelas siswa ' . $user->name . ' berhasil diperbarui.');
    }

    /**
     * Display a listing of pending student submissions.
     */
    public function submissions()
    {
        $submissions = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('admin.pengajuansiswa', compact('submissions'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'status' => 'approved',
        ]);

        return redirect()->route('admin.datakelas')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Approve a student registrant.
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);

        return back()->with('success', 'Siswa ' . $user->name . ' telah disetujui.');
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Data siswa ' . $user->name . ' berhasil diperbarui.');
    }

    /**
     * Remove a student from their assigned class.
     */
    public function removeFromClass($id)
    {
        $user = User::findOrFail($id);
        $old_kelas = $user->kelas->nama_kelas ?? 'kelas';
        $user->update(['kelas_id' => null]);

        return back()->with('success', 'Siswa ' . $user->name . ' berhasil dikeluarkan dari ' . $old_kelas . '.');
    }

    /**
     * Reject/Delete a student registrant.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Pengajuan siswa ' . $user->name . ' telah ditolak/dihapus.');
    }
}
