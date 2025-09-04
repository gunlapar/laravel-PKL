@extends('layouts.app')

@section('title', 'Detail Siswa PKL')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>Detail Siswa
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>

                    <form id="delete-form" action="{{ route('siswa.destroy', $siswa) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data siswa ini?')){ document.getElementById('delete-form').submit(); }">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <!-- Foto & Identitas singkat -->
                    <div class="col-md-4 text-center">
                        @if($siswa->foto)
                            <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama }}" 
                                 class="img-fluid rounded-circle shadow-sm mb-3" style="width:200px;height:200px;object-fit:cover;">
                        @else
                            <div class="rounded-circle bg-secondary mx-auto d-flex align-items-center justify-content-center shadow-sm mb-3" 
                                 style="width:200px;height:200px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        @endif

                        <h5 class="mb-0">{{ $siswa->nama }}</h5>
                        <small class="text-muted">NIS: {{ $siswa->nis }}</small>

                        <div class="mt-3">
                            <span class="badge {{ $siswa->gender == 'L' ? 'bg-primary' : 'bg-pink text-white' }}">
                                <i class="fas fa-{{ $siswa->gender == 'L' ? 'male' : 'female' }} me-1"></i>
                                {{ $siswa->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>

                            <span class="badge {{ $siswa->status_lapor_pkl == 'Sudah' ? 'bg-success' : 'bg-warning text-dark' }} ms-2">
                                <i class="fas fa-{{ $siswa->status_lapor_pkl == 'Sudah' ? 'check-circle' : 'clock' }} me-1"></i>
                                {{ $siswa->status_lapor_pkl }}
                            </span>
                        </div>
                    </div>

                    <!-- Detail informasi -->
                    <div class="col-md-8">
                        <h6 class="text-muted mb-3"><i class="fas fa-info-circle me-2"></i>Informasi Lengkap</h6>

                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Email</strong></div>
                            <div class="col-sm-8">{{ $siswa->email ?? '-' }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Kontak</strong></div>
                            <div class="col-sm-8">{{ $siswa->kontak ?? '-' }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Alamat</strong></div>
                            <div class="col-sm-8">{{ $siswa->alamat ?? '-' }}</div>
                        </div>

                        <hr>

                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Dibuat</strong></div>
                            <div class="col-sm-8">
                                @if($siswa->created_at)
                                    {{ $siswa->created_at->diffForHumans() }} ({{ $siswa->created_at->format('d M Y H:i') }})
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Terakhir diupdate</strong></div>
                            <div class="col-sm-8">
                                @if($siswa->updated_at)
                                    {{ $siswa->updated_at->diffForHumans() }} ({{ $siswa->updated_at->format('d M Y H:i') }})
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <!-- Optional: tambahan informasi singkat -->
                        <div>
                            <small class="text-muted">ID Rekam: {{ $siswa->id }}</small>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>

@endsection
