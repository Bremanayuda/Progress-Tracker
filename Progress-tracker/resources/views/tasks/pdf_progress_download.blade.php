<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Progress Pekerjaan</title>
    <style>
        @page {
            margin: 50px 40px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 100%;
        }

        .container {
            padding: 20px 0 100px; 
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

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .signature {
            margin-top: 30px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }

        .footer-2 {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PROGRESS PEKERJAAN</h1>
            <p>PT Pertamina EP Cepu Zona 11</p>
            <p style="font-size: 12px; color: #666;">Nomor: {{ $task->id }}/{{ date('Y') }}</p>
        </div>

        <div class="form-group">
            <span class="label">Nama Pekerjaan:</span>
            <span class="value">{{ $task->nama }}</span>
        </div>
        <div class="form-group">
            <span class="label">Deskripsi:</span>
            <span class="value">{{ $task->deskripsi }}</span>
        </div>
        <div class="form-group">
            <span class="label">Tenggat Waktu:</span>
            <span class="value">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</span>
        </div>
        <div class="form-group">
            <span class="label">PIC:</span>
            <span class="value">{{ $task->pic }}</span>
        </div>
        <div class="form-group">
            <span class="label">Lampiran:</span>
            <span class="value">{{ $task->file ?? '-' }}</span>
        </div>

        <div class="footer">
            <p>Cepu, {{ date('d F Y') }}</p>
            <div class="signature">
                <p>Didin Wahyudin</p>
                <br><br><br>
                <p>_________________________</p>
            </div>
        </div>
    </div>

    <div class="footer-2">
        PT Pertamina EP Asset 4 Cepu Field | Jl. Gajah Mada  PO.BOX 1 Cepu,  Blora,  Jawa Tengah - 58312
    </div>
</body>
</html>
