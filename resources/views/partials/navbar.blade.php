@auth
<nav class="bg-gradient-to-r from-red-700 to-red-600 text-white shadow-md hidden md:block">
  <div class="max-w-7xl mx-auto px-6 py-3 flex flex-wrap justify-between items-center">
    <div class="flex gap-4 sm:gap-6">

      <a href="{{ route('repository.dashboard') }}" class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('communities.index') }}" class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
        <i class="fas fa-users"></i>
        <span>UMIR Communities</span>
      </a>

      <a href="{{ route('collections.index') }}" class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
        <i class="fas fa-layer-group"></i>
        <span>Collection</span>
      </a>

      @if(auth()->user()->role === 'faculty' || auth()->user()->role === 'librarian')
        <a href="{{ route('papers.index') }}" class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
          <i class="fas fa-file-alt"></i>
          <span>Papers</span>
        </a>
      @endif

      <a href="#" class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
        <i class="fas fa-book-open"></i>
        <span>Library Catalog</span>
      </a>

      @if(auth()->user()->role === 'librarian')
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-white hover:text-yellow-300 flex items-center gap-1">
          <i class="fas fa-user-cog"></i>
          <span>Manage Users</span>
        </a>

        <a href="{{ route('admin.downloadRequests') }}" class="text-sm text-white hover:text-yellow-300 flex items-center gap-1">
          <i class="fas fa-download"></i>
          <span>Download Requests</span>
        </a>
      @endif

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"
           class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
          <i class="fas fa-right-from-bracket"></i>
          <span>Logout</span>
        </a>
      </form>
    </div>

    <div class="hidden md:flex items-center gap-2 text-sm">
      <span class="text-yellow-300">Welcome back,</span>
      <span class="font-medium">{{ auth()->user()->first_name }}</span>
    </div>
  </div>
</nav>
@endauth
