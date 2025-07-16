<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans:400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Sansation:400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/register.css" />
</head>
<body>
  <div class="register-page">
    <header class="header">
      <img src="/image/logo.png" class="logo" alt="Logo Pertamina">
      <div class="title">INFORMATION AND<br>COMMUNICATION TECHNOLOGY</div>
      <button class="login-button" onclick="slideToRegister()">Register</button>
    </header>

    <div class="register-container">
      <div class="form-section">
        <h2 class="form-title">Welcome</h2>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <label for="email"><center>Email</center></label>
          <input type="email" id="email" name="email" required autofocus>

          <label for="password"><center>Password</center></label>
          <input type="password" id="password" name="password" required>

          <button type="submit" class="submit-btn">Login</button>
        </form>
        
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
      </div>

      <div class="image-section">
        <img src="/image/background.jpg" alt="Background Image">
      </div>
    </div>
  </div>

  <script>
    // Add fade-in animation when page loads
    window.addEventListener('load', function() {
      const page = document.querySelector('.register-page');
      page.classList.add('fade-in');
    });

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

    // Fade animation function
    function slideToRegister() {
      const page = document.querySelector('.register-page');
      page.classList.add('fade-out');
      
      setTimeout(function() {
        window.location.href = '{{ route('register') }}';
      }, 300);
    }
  </script>
</body>
</html> 