 <!-- Mobile Nav -->
 <div class="mobile-menu bg-red-700 md:hidden" id="mobile-menu">
    <div class="px-4 py-3 space-y-2">
      <a href="{{ route('communities.index') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-users mr-2"></i>UMIR Communities
      </a>
      <a href="{{ route('collections.index') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-book mr-2"></i>Collection
      </a>
      <a href="{{ route('papers.index') }}" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-book mr-2"></i>Papers
      </a>
      <a href="#" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-book mr-2"></i>Library Catalog
      </a>
      <a href="#" class="block text-white hover:bg-red-600 px-3 py-2 rounded-md">
        <i class="fas fa-sign-out-alt mr-2"></i>Logout
      </a>
      @auth
      <div class="text-yellow-300 px-3 py-2">
        Welcome back, {{ Auth::user()->first_name  }}
      </div>
      @endauth
    </div>
  </div>
