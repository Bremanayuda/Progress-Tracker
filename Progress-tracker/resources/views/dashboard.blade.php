<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans:400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/register.css" />
    <style>
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="register-page">
        <header class="header">
            <img src="/image/logo.png" class="logo" alt="Logo Pertamina">
            <div class="title">INFORMATION AND<br>COMMUNICATION TECHNOLOGY</div>
        </header>

        <div class="dashboard-container">
            <div class="welcome-section">
                <h1>Selamat Datang di Dashboard</h1>
                <p>Progress Tracker System</p>
            </div>

            <div class="user-info">
                <h3>Informasi User:</h3>
                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Division:</strong> {{ Auth::user()->role }}</p>
                <p><strong>Bergabung sejak:</strong> {{ Auth::user()->created_at->format('d M Y H:i') }}</p>
            </div>

            <div style="text-align: center;">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 