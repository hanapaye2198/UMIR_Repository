<!-- Mobile Nav -->
<div class="mobile-menu bg-red-700 md:hidden hidden" id="mobile-menu-content">
    <div class="px-4 py-3 space-y-2">
      <a href="{{ route('repository.dashboard') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
      </a>
      <a href="{{ route('communities.index') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-users mr-2"></i>UMIR Communities
      </a>
      <a href="{{ route('collections.index') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-layer-group mr-2"></i>Collection
      </a>
      <a href="{{ route('papers.index') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-file-alt mr-2"></i>Papers
      </a>
      <a href="#" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-book-open mr-2"></i>Library Catalog
      </a>
      <a href="#" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-right-from-bracket mr-2"></i>Logout
      </a>
      @auth
      <div class="text-yellow-300 px-3 py-2">
        Welcome back, {{ Auth::user()->first_name }}
      </div>
      @endauth
    </div>
  </div>

  <script>
    // Toggle mobile menu visibility
    document.getElementById('mobile-menu-button')?.addEventListener('click', () => {
      const menu = document.getElementById('mobile-menu-content');
      menu.classList.toggle('hidden');
    });
  </script>
