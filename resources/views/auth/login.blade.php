<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMIR - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
  .login-bg {
  background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                    url('/images/library.jpg');
  background-size: cover;
  background-position: center;
}

    .login-card {
      max-width: 450px;
      margin: 2rem auto;
      backdrop-filter: blur(5px);
    }
    .input-icon {
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
  <!-- Header (Consistent with main site) -->
  <header class="bg-gradient-to-r from-red-800 to-red-600 text-white shadow-lg">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-4 sm:px-6">
      <div class="flex items-center gap-3">
        <div class="bg-white p-1 rounded-lg shadow-md">
          <img src="{{ asset('images/UMIR.jpeg') }}" alt="UMIR Logo" class="h-10">
        </div>
        <div>
          <h1 class="text-xl sm:text-2xl font-bold tracking-tight">UMIR</h1>
          <p class="text-xs text-red-100">Institutional Repository</p>
        </div>
      </div>
      <a href="/" class="text-sm text-white hover:text-yellow-300 transition-colors duration-200">
        <i class="fas fa-home mr-1"></i> Back to Home
      </a>
    </div>
  </header>

  <!-- Main Login Content -->
  <main class="login-bg min-h-screen flex items-center justify-center p-4">
    <div class="login-card bg-white/90 rounded-xl shadow-xl overflow-hidden w-full">
      <!-- Card Header -->
      <div class="bg-gradient-to-r from-red-700 to-red-600 text-white py-6 px-6 text-center">
        <h2 class="text-2xl font-bold flex items-center justify-center gap-3">
          <i class="fas fa-sign-in-alt"></i>
          <span>UMIR Login</span>
        </h2>
        <p class="text-red-100 mt-2">Access your research repository account</p>
      </div>
      @if ($errors->any())
      <div class="text-red-600 text-sm mt-2">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

      <!-- Login Form -->
      <div class="p-6 sm:p-8">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">University Email</label>
            <div class="relative">
              <div class="absolute input-icon text-gray-400">
                <i class="fas fa-envelope"></i>
              </div>
              <input type="email" id="email" name="email"
                     class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                     placeholder="username@umindanao.edu.ph" required>
            </div>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
              <div class="absolute input-icon text-gray-400">
                <i class="fas fa-lock"></i>
              </div>
              <input type="password" id="password" name="password"
                     class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                     placeholder="••••••••" required>
            </div>
            <div class="flex justify-between items-center mt-2">
              <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
              </div>
              <a href="#" class="text-sm font-medium text-red-600 hover:text-red-500">Forgot password?</a>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit"
                  class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition-colors duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-sign-in-alt"></i>
            <span>Sign In</span>
          </button>

          <!-- Social Login Options -->
          <div class="relative mt-6">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white/90 text-gray-500">Or continue with</span>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3 mt-6">
            <a href="#" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm flex items-center justify-center gap-2 transition-colors duration-200">
              <i class="fab fa-facebook-f"></i>
              <span>Facebook</span>
            </a>
            <a href="#" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-medium py-2 px-4 rounded-lg shadow-sm flex items-center justify-center gap-2 transition-colors duration-200">
              <i class="fab fa-google"></i>
              <span>Google</span>
            </a>
          </div>

          <!-- Registration Link -->
          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              Don't have an account?
              <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-500 transition-colors duration-200">
                Request access
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer (Consistent with main site) -->
  <footer class="bg-gray-800 text-gray-300 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="text-center">
        <p class="text-sm">
          &copy; 2025 University of Mindanao. All rights reserved.
        </p>
        <div class="mt-4 flex justify-center gap-4">
          <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Simple form validation script -->
  <script>
    document.querySelector('form').addEventListener('submit', function(e) {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      if (!email || !password) {
        e.preventDefault();
        alert('Please fill in all required fields');
      }

      // You would add more validation and actual login logic here
    });
  </script>
</body>
</html>
