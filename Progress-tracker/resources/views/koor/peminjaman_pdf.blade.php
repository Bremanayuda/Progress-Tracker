<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Peminjaman Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .value {
            display: inline-block;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            margin-top: 30px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FORM PEMINJAMAN BARANG</h1>
        <p>PT Pertamina EP Cepu Zona 11</p>
        <p style="font-size: 12px; color: #666;">Nomor: {{ $peminjaman->id }}/{{ date('Y') }}</p>
    </div>

    <div class="form-group">
        <span class="label">Nama Peminjam:</span>
        <span class="value">{{ $peminjaman->user->name }}</span>
    </div>

    <div class="form-group">
        <span class="label">Divisi:</span>
        <span class="value">{{ $peminjaman->user->role }}</span>
    </div>

    <div class="form-group">
        <span class="label">Nama barang:</span>
        <span class="value">{{ $peminjaman->barang->nama_barang }}</span>
    </div>

    <div class="form-group">
        <span class="label">Jumlah:</span>
        <span class="value">{{ $peminjaman->jumlah_pinjam }}</span>
    </div>

    <div class="form-group">
        <span class="label">Tanggal Pinjam:</span>
        <span class="value">{{ $peminjaman->tanggal_pinjam }}</span>
    </div>

    <div class="form-group">
        <span class="label">Tanggal Kembali:</span>
        <span class="value">{{ $peminjaman->deadline }}</span>
    </div>

    <div class="form-group">
        <span class="label">Alasan Peminjaman:</span>
        <span class="value">{{ $peminjaman->alasan }}</span>
    </div>

    <div class="form-group">
        <span class="label">Status:</span>
        <span class="value">
            @if($peminjaman->status == 'approved')
                <strong style="color: #0a7c1c;">DISETUJUI</strong>
            @elseif($peminjaman->status == 'rejected')
                <strong style="color: #ed1c24;">DITOLAK</strong>
            @else
                <strong style="color: #e67e22;">PENDING</strong>
            @endif
        </span>
    </div>

    @if($peminjaman->status == 'approved')
    <div class="form-group">
        <span class="label">Tanggal Disetujui:</span>
        <span class="value">{{ $peminjaman->updated_at->format('d F Y') }}</span>
    </div>
    @endif

    <div class="footer">
        <p>Cepu, {{ date('d F Y') }}</p>
        <div class="signature">
            <p>Didin Wahyudin</p>
            <br><br><br>
            <p>_________________________</p>
        </div>
    </div>
</body>
</html> 