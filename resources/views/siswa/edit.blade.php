@extends('layouts.app')

@section('title', 'Edit Siswa PKL')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Edit Data Siswa PKL
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" 
                                   id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender', $siswa->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $siswa->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="kontak" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('kontak') is-invalid @enderror" 
                                   id="kontak" name="kontak" value="{{ old('kontak', $siswa->kontak) }}" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $siswa->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                  id="alamat" name="alamat" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                            @if($siswa->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto saat ini" class="img-thumbnail" style="max-width: 100px;">
                                    <small class="text-muted d-block">Foto saat ini</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/jpeg,image/png,image/jpg">
                            <div class="form-text">Format: JPEG, PNG, JPG. Maksimal 2MB. Kosongkan jika tidak ingin mengganti foto.</div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status_lapor_pkl" class="form-label">Status Laporan PKL <span class="text-danger">*</span></label>
                            <select class="form-select @error('status_lapor_pkl') is-invalid @enderror" 
                                    id="status_lapor_pkl" name="status_lapor_pkl" required>
                                <option value="">Pilih Status</option>
                                <option value="Belum" {{ old('status_lapor_pkl', $siswa->status_lapor_pkl) == 'Belum' ? 'selected' : '' }}>Belum Lapor</option>
                                <option value="Sudah" {{ old('status_lapor_pkl', $siswa->status_lapor_pkl) == 'Sudah' ? 'selected' : '' }}>Sudah Lapor</option>
                            </select>
                            @error('status_lapor_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <div>
                            <a href="{{ route('siswa.show', $siswa) }}" class="btn btn-info me-2">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection