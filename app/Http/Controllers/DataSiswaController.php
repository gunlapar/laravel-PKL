<?php
namespace App\Http\Controllers;

use App\Models\DataSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
    $q = $request->query('q'); // kata pencarian
    $status = $request->query('status'); // optional filter status
    $gender = $request->query('gender'); // optional filter gender

    $query = DataSiswa::query();

    // search di kolom nama, nis, email, kontak
    if (!empty($q)) {
        $query->where(function($sub) use ($q) {
            $sub->where('nama', 'like', "%{$q}%")
                ->orWhere('nis', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->orWhere('kontak', 'like', "%{$q}%");
        });
    }

    // optional filter by status_lapor_pkl
    if (!empty($status) && in_array($status, ['Belum','Sudah'])) {
        $query->where('status_lapor_pkl', $status);
    }

    // optional filter by gender
    if (!empty($gender) && in_array($gender, ['L','P'])) {
        $query->where('gender', $gender);
    }

    // order latest dan paginate, withQueryString supaya query tetap saat pagination
    $siswas = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

    return view('siswa.index', compact('siswas'));
    }
    public function create()
    {
        return view('siswa.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:data_siswas_pkl,nis',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:data_siswas_pkl,email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_lapor_pkl' => 'required|in:Belum,Sudah'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('photos', 'public');
        }

        DataSiswa::create($data);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(DataSiswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(DataSiswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, DataSiswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:data_siswas_pkl,nis,' . $siswa->id,
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:data_siswas_pkl,email,' . $siswa->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_lapor_pkl' => 'required|in:Belum,Sudah'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $data['foto'] = $request->file('foto')->store('photos', 'public');
        }

        $siswa->update($data);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(DataSiswa $siswa)
    {
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }
        
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}