<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMIR - Register</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .auth-container {
      min-height: calc(100vh - 200px);
    }
    .auth-card {
      max-width: 500px;
      margin: 0 auto;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
  <!-- Header -->
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
    </div>
  </header>

  <!-- Main Content -->
  <main class="auth-container flex items-center justify-center py-12 px-4 sm:px-6">
    <div class="auth-card bg-white rounded-xl shadow-md overflow-hidden w-full">
      <!-- Auth Header -->
      <div class="bg-gradient-to-r from-red-700 to-red-600 text-white py-6 px-6 text-center">
        <h2 class="text-2xl font-bold flex items-center justify-center gap-2">
          <i class="fas fa-user-plus"></i>
          <span>Create UMIR Account</span>
        </h2>
        <p class="text-red-100 mt-2">Join the institutional repository community</p>
      </div>

      <!-- Auth Form -->
      <div class="p-6 sm:p-8">
        @if ($errors->any())
    <div class="mb-4">
        <div class="text-red-600 font-bold">Whoops! Something went wrong:</div>
        <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-user text-gray-400"></i>
                </div>
                <input type="text" id="first-name" name="first-name"
                       class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                       placeholder="John" required>
              </div>
            </div>
            <div>
              <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-user text-gray-400"></i>
                </div>
                <input type="text" id="last-name" name="last-name"
                       class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                       placeholder="Doe" required>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
              </div>
              <input type="email" id="email" name="email"
                     class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                     placeholder="your@email.com" required>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" id="password" name="password"
                       class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                       placeholder="••••••••" required>
              </div>
            </div>
            <div>
              <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                    placeholder="••••••••" required>

              </div>
            </div>
          </div>

          <div class="mb-6">
            <label for="institution" class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-university text-gray-400"></i>
              </div>
              <select id="institution" name="institution"
                      class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                <option value="">Select your institution</option>
                <option value="um_main">University of Mindanao - Main</option>
                <option value="um_digos">University of Mindanao - Digos</option>
                <option value="um_tagum">University of Mindanao - Tagum</option>
                <option value="um_peñaplata">University of Mindanao - Peñaplata</option>
                <option value="um_bansalan">University of Mindanao - Bansalan</option>
              </select>
            </div>
          </div>

          <div class="mb-6">
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded" required>
              </div>
              <div class="ml-3 text-sm">
                <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-red-600 hover:text-red-500">terms and conditions</a></label>
              </div>
            </div>
          </div>

          <button type="submit"
                  class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-user-plus"></i>
            <span>Create Account</span>
          </button>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              Already have an account?
              <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-500">Login here</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
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
</body>
</html>
