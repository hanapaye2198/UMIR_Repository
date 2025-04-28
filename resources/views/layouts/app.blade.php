<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | UMIR Repository</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
  @include('partials.header')
  @include('partials.navbar')
  @include('partials.mobile-nav')

  @hasSection('hero-search')
    @yield('hero-search')
  @endif

  @hasSection('breadcrumb')
    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 py-3 px-6 shadow-sm">
      <div class="max-w-7xl mx-auto flex items-center gap-2">
        @yield('breadcrumb')
      </div>
    </div>
  @endif

  <main class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div class="@hasSection('sidebar') md:col-span-3 @else md:col-span-4 @endif space-y-8">
      @yield('content')
    </div>

    @hasSection('sidebar')
      <aside class="space-y-6">
        @yield('sidebar')
      </aside>
    @endif
  </main>

  @include('partials.footer')

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('active');
    });
  </script>
  @stack('scripts')
</body>
</html>
