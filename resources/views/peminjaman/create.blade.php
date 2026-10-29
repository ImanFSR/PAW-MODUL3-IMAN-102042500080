@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Transaksi Peminjaman Buku</h5>
                </div>
                <div class="card-body p-4">
                    <!-- TODO 9: Formulir Transaksi Peminjaman -->
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Anggota</label>
                            <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Anggota Peminjam --</option>
                                @foreach($anggota as $a)
                                    <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama }} ({{ $a->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Buku</label>
                            <select name="buku_id" class="form-select @error('buku_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Buku yang Dipinjam --</option>
                                @foreach($buku as $b)
                                    <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                        {{ $b->judul }} (Sisa Stok: {{ $b->stok }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text text-muted">Hanya buku dengan stok > 0 yang muncul dalam pilihan. Stok akan otomatis berkurang 1.</div>
                            @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                            @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection