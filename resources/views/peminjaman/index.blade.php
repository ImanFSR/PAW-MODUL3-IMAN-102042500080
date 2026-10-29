@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Daftar Peminjaman</h3>
            <p class="text-muted small mb-0">Kelola transaksi peminjaman dan pengembalian buku.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            + Tambah Peminjaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- TODO 10: Looping daftar transaksi peminjaman -->
                        @forelse($peminjaman as $index => $item)
                            <tr>
                                <td class="ps-3">{{ $peminjaman->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $item->anggota->nama }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
                                <td>
                                    {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
                                </td>
                                <td>
                                    @if($item->status === 'Dipinjam')
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                    @else
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    @if($item->status === 'Dipinjam')
                                        <form action="{{ route('peminjaman.kembali', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Apakah buku ini sudah dikembalikan?')">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-light text-muted" disabled>Selesai</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada data peminjaman buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($peminjaman->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $peminjaman->links() }}
            </div>
        @endif
    </div>
</div>
@endsection