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

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

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

        $perPage = $request->input('per_page', 20); // Default 20
        $allowedPerPage = [20, 30, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 20;
        }

        $students = $query->orderBy('status', 'desc')
            ->orderBy('name')
            ->paginate($perPage)
            ->appends($request->all()); // Appends all current query params
            
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
        $pendingStudents = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.siswa.create', compact('pendingStudents'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Check if selecting from pending list
        if ($request->filled('pending_id')) {
            $request->validate([
                'pending_id' => 'required|exists:users,id',
                'no_wa_pribadi' => 'nullable|string|max:20',
                'wa_orang_tua' => 'nullable|string|max:20',
            ]);

            $user = User::findOrFail($request->pending_id);
            $user->update([
                'status' => 'approved',
                'no_wa_pribadi' => $request->no_wa_pribadi,
                'wa_orang_tua' => $request->wa_orang_tua,
            ]);

            return redirect()->route('admin.datakelas')->with('success', 'Siswa dari daftar tunggu telah disetujui.');
        }

        // Manual registration
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_wa_pribadi' => 'nullable|string|max:20',
            'wa_orang_tua' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'status' => 'approved',
            'no_wa_pribadi' => $request->no_wa_pribadi,
            'wa_orang_tua' => $request->wa_orang_tua,
        ]);

        return redirect()->route('admin.datakelas')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.siswa.edit', compact('student'));
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
            'no_wa_pribadi' => 'nullable|string|max:20',
            'wa_orang_tua' => 'nullable|string|max:20',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa_pribadi' => $request->no_wa_pribadi,
            'wa_orang_tua' => $request->wa_orang_tua,
        ]);

        return redirect()->route('admin.datakelas')->with('success', 'Data siswa ' . $user->name . ' berhasil diperbarui.');
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
