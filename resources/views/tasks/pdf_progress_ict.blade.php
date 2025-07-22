<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Progress Pekerjaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
            color: #333;
            position: relative;
        }

        .header {
            text-align: center;
            padding-bottom: 10px;
            margin-bottom: 30px;
            border-bottom: 3px solid #2c3e50;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #7f8c8d;
        }

        .content {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 25px 30px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: row;
        }

        .label {
            font-weight: bold;
            width: 160px;
            color: #34495e;
        }

        .value {
            flex: 1;
            color: #2c3e50;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 50px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>PROGRESS PEKERJAAN</h1>
        <p>PT Pertamina EP Cepu Zona 11</p>
    </div>

    <div class="content">
        <div class="form-group">
            <div class="label">Nama Pekerjaan:</div>
            <div class="value">{{ $task->nama }}</div>
        </div>
        <div class="form-group">
            <div class="label">Deskripsi:</div>
            <div class="value">{{ $task->deskripsi }}</div>
        </div>
        <div class="form-group">
            <div class="label">Tenggat Waktu:</div>
            <div class="value">{{ \Carbon\Carbon::parse($task->tenggat_waktu)->format('d/m/Y') }}</div>
        </div>
    </div>

    <div class="footer">
        PT Pertamina EP Asset 4 Cepu Field | Jl. Gajah Mada  PO.BOX 1 Cepu,  Blora,  Jawa Tengah - 58312
    </div>

</body>
</html>
