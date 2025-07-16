<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans:400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Sansation:400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/register.css" />
</head>
<body>
  <div class="register-page">
    <header class="header">
      <img src="/image/logo.png" class="logo" alt="Logo Pertamina">
      <div class="title">INFORMATION AND<br>COMMUNICATION TECHNOLOGY</div>
      <button class="login-button" onclick="window.location.href='{{ route('login') }}'">Login</button>
    </header>

    <div class="register-container">
      <div class="form-section">
        <h2 class="form-title">Create your <br>account</h2>
        
        @if ($errors->any())
          <div class="alert alert-danger" id="alert-message">
            <div class="alert-content">
              <span class="alert-icon">⚠️</span>
              <div class="alert-text">
                @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
                @endforeach
              </div>
              <button class="alert-close" onclick="closeAlert()">×</button>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
          @csrf
          <label for="name"><center>Username</center></label>
          <input type="text" id="name" name="name" required>

          <label for="email"><center>Email</center></label>
          <input type="email" id="email" name="email" required>

          <label for="role"><center>Division</center></label>
          <select id="role" name="role" required>
            <option value="role0"></option>
            <option value="role1">ICT</option>
            <option value="role2">SCM</option>
            <option value="role3">HSSE</option>
          </select>

          <label for="password"><center>Password</center></label>
          <input type="password" id="password" name="password" required>

          <button type="submit" class="submit-btn">Register</button>
        </form>
      </div>

      <div class="image-section">
        <img src="/image/background.jpg" alt="Background Image">
      </div>
    </div>
  </div>

  <script>
    // Auto-hide alert after 5 seconds
    setTimeout(function() {
      const alert = document.getElementById('alert-message');
      if (alert) {
        alert.style.opacity = '0';
        setTimeout(function() {
          alert.style.display = 'none';
        }, 300);
      }
    }, 5000);

    // Manual close function
    function closeAlert() {
      const alert = document.getElementById('alert-message');
      if (alert) {
        alert.style.opacity = '0';
        setTimeout(function() {
          alert.style.display = 'none';
        }, 300);
      }
    }
  </script>
</body>
</html>
