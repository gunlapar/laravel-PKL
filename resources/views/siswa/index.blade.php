@extends('layouts.app')

@section('title', 'Data Siswa PKL')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <!-- Header: Title + Search + Add Button -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-users me-2"></i>Data Siswa PKL
                </h4>

                <div class="d-flex align-items-center gap-2">
                    <!-- Search form (GET) -->
                    <form action="{{ route('siswa.index') }}" method="GET" class="d-flex" role="search">
                        <input type="text" name="q" class="form-control form-control-sm" placeholder="Cari nama / NIS / email..." value="{{ request('q') }}">
                        <select name="status" class="form-select form-select-sm ms-2">
                            <option value="">Semua Status</option>
                            <option value="Sudah" {{ request('status')=='Sudah' ? 'selected' : '' }}>Sudah</option>
                            <option value="Belum" {{ request('status')=='Belum' ? 'selected' : '' }}>Belum</option>
                        </select>
                        <select name="gender" class="form-select form-select-sm ms-2">
                            <option value="">L/P</option>
                            <option value="L" {{ request('gender')=='L' ? 'selected' : '' }}>L</option>
                            <option value="P" {{ request('gender')=='P' ? 'selected' : '' }}>P</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary ms-2">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-light ms-1" title="Reset">
                            <i class="fas fa-eraser"></i>
                        </a>
                    </form>

                    <!-- Tombol Tambah Siswa -->
                    <a href="{{ route('siswa.create') }}" class="btn btn-light ms-3">
                        <i class="fas fa-plus me-1"></i>Tambah Siswa
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if($siswas->count() > 0)
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users fa-2x me-3"></i>
                                        <div>
                                            <h5>{{ $siswas->total() }}</h5>
                                            <small>Total Siswa</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle fa-2x me-3"></i>
                                        <div>
                                            <h5>{{ App\Models\DataSiswa::where('status_lapor_pkl', 'Sudah')->count() }}</h5>
                                            <small>Sudah Lapor</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock fa-2x me-3"></i>
                                        <div>
                                            <h5>{{ App\Models\DataSiswa::where('status_lapor_pkl', 'Belum')->count() }}</h5>
                                            <small>Belum Lapor</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-venus-mars fa-2x me-3"></i>
                                        <div>
                                            <h5>{{ App\Models\DataSiswa::where('gender', 'L')->count() }}/{{ App\Models\DataSiswa::where('gender', 'P')->count() }}</h5>
                                            <small>L / P</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Show current search/filter (if any) -->
                    @if(request()->filled('q') || request()->filled('status') || request()->filled('gender'))
                        <div class="mb-3">
                            <small class="text-muted">
                                Menampilkan hasil untuk:
                                @if(request('q')) <strong> "{{ request('q') }}"</strong> @endif
                                @if(request('status')) — Status: <strong>{{ request('status') }}</strong> @endif
                                @if(request('gender')) — Gender: <strong>{{ request('gender')=='L' ? 'Laki-laki' : 'Perempuan' }}</strong> @endif
                            </small>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Gender</th>
                                    <th>Kontak</th>
                                    <th>Status PKL</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswas as $index => $siswa)
                                <tr>
                                    <td>{{ $siswas->firstItem() + $index }}</td>
                                    <td>
                                        @if($siswa->foto)
                                            <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama }}" class="profile-img" style="width:56px;height:56px;object-fit:cover;border-radius:6px;">
                                        @else
                                            <div class="profile-img bg-secondary d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:6px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $siswa->nama }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $siswa->email }}</small>
                                    </td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>
                                        <span class="badge bg-{{ $siswa->gender == 'L' ? 'primary' : 'danger' }}">
                                            {{ $siswa->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td>{{ $siswa->kontak }}</td>
                                    <td>
                                        <span class="badge status-badge bg-{{ $siswa->status_lapor_pkl == 'Sudah' ? 'success' : 'warning' }}">
                                            {{ $siswa->status_lapor_pkl }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('siswa.show', $siswa) }}" class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $siswa->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <form id="delete-form-{{ $siswa->id }}" action="{{ route('siswa.destroy', $siswa) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $siswas->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data siswa</h5>
                        <p class="text-muted">Klik tombol "Tambah Siswa" untuk menambahkan data siswa pertama</p>
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Siswa
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- small script for delete confirmation -->
<script>
function confirmDelete(id){
    if(confirm('Yakin ingin menghapus data siswa ini?')){
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
