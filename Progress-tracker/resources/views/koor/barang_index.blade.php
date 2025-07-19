@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="/css/koor-barang.css">

@if(session('success'))
    <div style="position: fixed; top: 20px; right: 20px; background: #28a745; color: white; padding: 15px 20px; border-radius: 8px; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="position: fixed; top: 20px; right: 20px; background: #dc3545; color: white; padding: 15px 20px; border-radius: 8px; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
        {{ session('error') }}
    </div>
@endif
<div class="container-barang-utama">
    <div class="retangle-putih">
        <div class="judul-barang">Daftar Barang</div>
        <div class="rect-barang">
            <div class="header-row">
                <span class="col-nama">Nama Barang</span>
                <span class="col-jumlah">Jumlah</span>
                <span class="col-status">Status</span>
                <span class="col-detail"></span>
            </div>
            @forelse($barangs as $barang)
            <div class="barang-row">
                <span class="col-nama">{{ $barang->nama_barang }}</span>
                <span class="col-jumlah">
                    @php
                        $totalDipinjam = $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->sum('jumlah_pinjam');
                        $jumlahTersedia = $barang->jumlah - $totalDipinjam;
                    @endphp
                    {{ $barang->jumlah }} 
                </span>
                <span class="col-status">
                    @php
                        $peminjamanAktif = $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->count();
                        $totalDipinjam = $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->sum('jumlah_pinjam');
                        $jumlahTersedia = $barang->jumlah - $totalDipinjam;
                    @endphp
                    @if($peminjamanAktif > 0)
                        @if($jumlahTersedia > 0)
                            <span style="background:#ffc107; color:#000; padding:2px 8px; border-radius:4px; font-size:12px; font-weight:bold;">DIPINJAM ({{ $totalDipinjam }})</span>
                        @else
                            <span style="background:#dc3545; color:#fff; padding:2px 8px; border-radius:4px; font-size:12px; font-weight:bold;">HABIS</span>
                        @endif
                    @else
                        <span style="background:#28a745; color:#fff; padding:2px 8px; border-radius:4px; font-size:12px; font-weight:bold;">TIDAK DIPINJAM</span>
                    @endif
                </span>
                <span class="col-detail">
                    <div class="btn-group">
                        <button class="btn-detail-barang" 
                            data-nama="{{ $barang->nama_barang }}" 
                            data-deskripsi="{{ $barang->deskripsi }}" 
                            data-jumlah="{{ $barang->jumlah }}"
                            data-peminjaman-aktif="{{ $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->count() }}"
                            data-total-dipinjam="{{ $barang->peminjamans()->whereIn('status', ['pending', 'approved'])->sum('jumlah_pinjam') }}">
                            Detail
                        </button>
                        <form method="POST" action="{{ route('koor.barang.destroy', $barang->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus-barang" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"
                                @if($barang->peminjamans()->whereIn('status', ['pending', 'approved'])->exists()) 
                                    disabled 
                                    title="Barang tidak dapat dihapus karena sedang dipinjam"
                                @endif>
                                Hapus
                            </button>
                        </form>
                    </div>
                </span>
            </div>
            @empty
            <div class="barang-row" style="text-align:center; color:#888;">
                <span style="width:100%">Belum ada barang.</span>
            </div>
            @endforelse
        </div>
        <div style="text-align:center; margin-top:24px; display: flex; justify-content: center; gap: 16px;">
            <a href="{{ route('koor.barang.create') }}" class="btn-tambah-barang">Tambah Barang</a>
            <a href="{{ url()->previous() }}" class="btn-tambah-barang">Kembali</a>
        </div>
    </div>
</div>
<!-- Modal Detail Barang -->
<div class="modal-barang-bg" id="modalBarangBg">
    <div class="modal-barang">
        <button class="close-btn" onclick="closeModalBarang()">&times;</button>
        <h3 id="modalBarangNama"></h3>
        <div class="modal-label">Deskripsi:</div>
        <div id="modalBarangDeskripsi" class="modal-content"></div>
        <div class="modal-info"><b>Jumlah Total:</b> <span id="modalBarangJumlah"></span></div>
        <div class="modal-info"><b>Jumlah Dipinjam:</b> <span id="modalBarangTotalDipinjam"></span></div>
        <div class="modal-info"><b>Jumlah Tersedia:</b> <span id="modalBarangTersedia"></span></div>
        <div class="modal-info"><b>Peminjaman Aktif:</b> <span id="modalBarangPeminjamanAktif"></span></div>
    </div>
</div>
<script>
function closeModalBarang() {
    document.getElementById('modalBarangBg').classList.remove('active');
}
document.querySelectorAll('.btn-detail-barang').forEach(function(btn) {
    btn.onclick = function() {
        var jumlahTotal = parseInt(btn.getAttribute('data-jumlah'));
        var totalDipinjam = parseInt(btn.getAttribute('data-total-dipinjam'));
        var jumlahTersedia = jumlahTotal - totalDipinjam;
        
        document.getElementById('modalBarangNama').textContent = btn.getAttribute('data-nama');
        document.getElementById('modalBarangDeskripsi').textContent = btn.getAttribute('data-deskripsi');
        document.getElementById('modalBarangJumlah').textContent = btn.getAttribute('data-jumlah');
        document.getElementById('modalBarangTotalDipinjam').textContent = btn.getAttribute('data-total-dipinjam');
        document.getElementById('modalBarangTersedia').textContent = jumlahTersedia;
        document.getElementById('modalBarangPeminjamanAktif').textContent = btn.getAttribute('data-peminjaman-aktif');
        document.getElementById('modalBarangBg').classList.add('active');
    };
});
document.getElementById('modalBarangBg').onclick = function(e) {
    if (e.target === this) closeModalBarang();
};
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModalBarang();
});

// Auto hide notifications after 3 seconds
setTimeout(function() {
    var notifications = document.querySelectorAll('[style*="position: fixed"]');
    notifications.forEach(function(notification) {
        notification.style.display = 'none';
    });
}, 3000);
</script>
@endsection 