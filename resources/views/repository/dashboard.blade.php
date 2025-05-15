<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMIR Repository</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Mobile menu styles */
    .mobile-menu {
      display: none;
    }
    .mobile-menu.active {
      display: block;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero-search select, .hero-search input {
        width: 100%;
      }

      .paper-card {
        flex-direction: column;
      }

      .paper-card img {
        width: 100%;
        height: auto;
        margin-bottom: 1rem;
      }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    @if (session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <strong class="font-bold">Success! </strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if(alert) {
                alert.style.display = 'none';
            }
        }, 5000); // 5 seconds mawala ang alert
    </script>
@endif

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
      <div class="text-sm hidden md:flex items-center gap-2 bg-red-700/30 px-3 py-2 rounded-lg">
        <i class="far fa-calendar-alt"></i>
        <span>{{ \Carbon\Carbon::now()->format('l, F d, Y') }}</span>
    </div>

      <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
  </header>

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
    <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"
               class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
                <i class="fas fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </form>
      @auth
      <div class="text-yellow-300 px-3 py-2">
        Welcome back, {{ Auth::user()->first_name  }}
      </div>
      @endauth
    </div>
  </div>

  <!-- Desktop Navbar -->
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


  <!-- Hero Search -->
<!-- Hero Search -->
<div class="bg-gradient-to-r from-gray-900 to-gray-800 text-white px-4 sm:px-6 py-6 shadow-inner">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 flex items-center gap-2">
        <i class="fas fa-search"></i>
        <span>Discover Research & Scholarship</span>
      </h2>

      <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center">
        <select name="field" class="text-gray-800 px-4 py-2 rounded-lg border-0 shadow-sm w-full sm:w-auto focus:ring-2 focus:ring-yellow-400">
          <option value="all">All Fields</option>
          <option value="title">Title</option>
          <option value="author">Author</option>
          <option value="subject">Subject</option>
          <option value="abstract">Abstract</option>
        </select>

        <input type="text" name="query" placeholder="Search for publications, theses, articles..."
               class="flex-1 px-4 py-2 text-gray-800 rounded-lg border-0 shadow-sm w-full focus:ring-2 focus:ring-yellow-400" required />

        <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 sm:px-6 rounded-lg shadow-md transition-colors duration-200 w-full sm:w-auto flex items-center justify-center gap-2">
          <i class="fas fa-search"></i>
          <span class="hidden sm:inline">Search</span>
        </button>
      </form>

      <div class="mt-4 text-sm text-gray-300">
        <a href="#" class="hover:text-yellow-300 transition-colors duration-200 flex items-center gap-1">
          <i class="fas fa-filter"></i>
          <span>Advanced Search</span>
        </a>
      </div>
    </div>
  </div>


  <!-- Breadcrumb -->
  <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 py-3 px-4 sm:px-6 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm sm:text-base">
      <a href="#" class="font-medium hover:text-gray-800 transition-colors duration-200 flex items-center gap-1">
        <i class="fas fa-home"></i>
        <span class="hidden sm:inline">UMIR Home</span>
      </a>
      <span class="text-gray-700">/</span>
      <span class="text-gray-700">Dashboard</span>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6 grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Main Body -->
    <div class="md:col-span-3 space-y-6">
      <!-- Welcome Section -->
      <section class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <h2 class="text-2xl sm:text-3xl font-bold mb-4 text-red-800 flex items-center gap-2">
          <i class="fas fa-university"></i>
          <span>Welcome to UMIR!</span>
        </h2>
        <p class="text-gray-700 mb-6 leading-relaxed">
          <strong class="text-red-700">UMIR</strong> is the institutional repository of University of Mindanao. It digitally captures, stores, preserves and redistributes the intellectual and research outputs of the University of Mindanao Main and Campuses.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
          <a href="{{ route('admin.analytics') }}" class="block bg-red-50 rounded-lg p-3 sm:p-4 border-l-4 border-red-600 hover:bg-red-100 transition duration-200">
    <h3 class="font-bold text-red-800 mb-2 flex items-center gap-2">
        <i class="fas fa-chart-line"></i>
        <span>Statistics</span>
    </h3>
    <p class="text-sm text-gray-600">1,228 items available</p>
</a>

          <div class="bg-blue-50 rounded-lg p-3 sm:p-4 border-l-4 border-blue-600">
            <h3 class="font-bold text-blue-800 mb-2 flex items-center gap-2">
              <i class="fas fa-calendar-check"></i>
              <span>Recent Additions</span>
            </h3>
            <p class="text-sm text-gray-600">24 new items this week</p>
          </div>
          <div class="bg-green-50 rounded-lg p-3 sm:p-4 border-l-4 border-green-600">
            <h3 class="font-bold text-green-800 mb-2 flex items-center gap-2">
              <i class="fas fa-download"></i>
              <span>Downloads</span>
            </h3>
            <p class="text-sm text-gray-600">5,421 downloads this month</p>
          </div>
        </div>
      </section>

      <!-- Communities Section -->
      <section class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800 border-b pb-2 flex items-center gap-2">
          <i class="fas fa-layer-group"></i>
          <span>Communities in UMIR</span>
        </h3>
        <p class="mb-6 text-gray-600">Select a community to browse its collections.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
          @foreach($communities as $community)
          <div class="border rounded-lg p-3 sm:p-4 hover:shadow-md transition-shadow duration-200">
            <h4 class="font-bold text-lg text-red-700 mb-2 flex items-center gap-2">
              <i class="fas fa-building"></i>
              <span>{{ $community->name }}</span>
            </h4>
            <p class="text-sm text-gray-600">{{ $community->description }}</p>
            <div class="mt-3 text-xs text-gray-500">
              <span class="bg-gray-100 px-2 py-1 rounded">1,024 items</span>
              <span class="bg-gray-100 px-2 py-1 rounded ml-2">12 collections</span>
            </div>
          </div>
          @endforeach
        </div>
      </section>

      <!-- Recently Added Section -->
      <section class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-clock"></i>
            <span>Recently Added</span>
          </h3>
          <div class="flex gap-2">
            <button class="text-sm bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-1 rounded-md transition-colors duration-200">
              <i class="fas fa-list"></i> <span class="hidden sm:inline">List</span>
            </button>
            <button class="text-sm bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-1 rounded-md transition-colors duration-200">
              <i class="fas fa-th-large"></i> <span class="hidden sm:inline">Grid</span>
            </button>
          </div>
        </div>
        @foreach($recentPapers as $paper)
        <div class="space-y-6">
          <!-- Paper Card -->
          <div class="flex flex-col sm:flex-row gap-4 border-b pb-6 group hover:bg-gray-50 p-2 rounded-lg transition-colors duration-200 paper-card">
            <div class="flex-shrink-0">
              <img src="{{ $paper->thumbnail ? asset('storage/' . $paper->thumbnail) : asset('images/sample-thumb.png') }}" class="w-full sm:w-24 h-auto sm:h-32 object-cover border rounded-md shadow-sm group-hover:shadow-md transition-shadow duration-200" alt="thumbnail">
            </div>
            <div>
              <div class="flex justify-between items-start">
                <h4 class="text-base sm:text-lg font-semibold text-gray-800 group-hover:text-red-700 transition-colors duration-200">
                  {{ $paper->title }}
                </h4>
                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">New</span>
              </div>
              <p class="text-sm text-gray-600 mt-1">
                <span class="font-medium">
                  @foreach($paper->authors as $author)
                    {{ $author->name }}@if(!$loop->last), @endif
                  @endforeach
                </span>
                <span class="text-gray-500">
                  ({{ $paper->course ?? 'N/A' }}, {{ $paper->publication_date ? \Carbon\Carbon::parse($paper->publication_date)->format('Y-m') : 'N/A' }})
                </span>
              </p>
              <p class="text-sm mt-2 text-gray-700 line-clamp-2">
                {{ Str::limit($paper->abstract, 200) }}
              </p>
              <div class="mt-3 flex flex-wrap gap-2 sm:gap-3">
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full flex items-center gap-1">
                  <i class="fas fa-eye text-gray-500"></i>
                  <span>{{ $paper->views ?? 0 }} views</span>
                </span>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full flex items-center gap-1">
                  <i class="fas fa-download text-gray-500"></i>
                  <span>{{ $paper->downloads ?? 0 }} downloads</span>
                </span>
                <a href="{{ route('papers.show', $paper->id) }}" class="text-xs text-blue-600 hover:underline ml-auto flex items-center gap-1">
                  <i class="fas fa-external-link-alt"></i>
                  <span>View details</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </section>
    </div>

    <!-- Sidebar -->
    <aside class="space-y-4 sm:space-y-6">
        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-5">
            <h4 class="font-semibold text-base sm:text-lg border-b pb-2 text-gray-800 flex items-center gap-2">
                <i class="fas fa-link"></i>
                <span>Quick Links</span>
            </h4>
            <ul class="mt-3 space-y-2">
                @foreach ($quickLinks as $link)
                    <li>
                        <a href="{{ $link['url'] }}" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200 flex items-center gap-2 py-1">
                            <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                            <span>{{ $link['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- My Account -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-5">
            <h4 class="font-semibold text-base sm:text-lg border-b pb-2 text-gray-800 flex items-center gap-2">
                <i class="fas fa-user-circle"></i>
                <span>My Account</span>
            </h4>
            <ul class="mt-3 space-y-2">
                @foreach ($accountLinks as $link)
                    <li>
                        <a href="{{ $link['url'] }}" class="text-gray-700 hover:text-red-700 hover:underline transition-colors duration-200 flex items-center gap-2 py-1">
                            <i class="fas fa-{{ $link['icon'] }} text-gray-500"></i>
                            <span>{{ $link['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Statistics -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-5">
            <h4 class="font-semibold text-base sm:text-lg border-b pb-2 text-gray-800 flex items-center gap-2">
                <i class="fas fa-chart-pie"></i>
                <span>Repository Statistics</span>
            </h4>
            <div class="mt-3">
                <div class="flex justify-between items-center py-2 border-b">
                    <span class="text-gray-600">Total Items</span>
                    <span class="font-medium">{{ $stats['total_items'] }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b">
                    <span class="text-gray-600">This Month</span>
                    <span class="font-medium">{{ $stats['this_month'] }} new</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b">
                    <span class="text-gray-600">Downloads</span>
                    <span class="font-medium">{{ $stats['downloads'] }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Active Users</span>
                    <span class="font-medium">{{ $stats['active_users'] }}</span>
                </div>
            </div>
        </div>

        <!-- Discover -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-5">
            <h4 class="font-semibold text-base sm:text-lg border-b pb-2 text-gray-800 flex items-center gap-2">
                <i class="fas fa-compass"></i>
                <span>Discover</span>
            </h4>
            <div class="mt-3 space-y-4">
                <div>
                    <p class="font-bold text-sm text-gray-700 flex items-center gap-1">
                        <i class="fas fa-user-graduate"></i>
                        <span>Author</span>
                    </p>
                    <ul class="mt-1 space-y-1 pl-5">
                        @foreach ($topAuthors as $author)
                            <li class="text-sm text-gray-600 hover:text-red-700">
                                <a href="#" class="flex justify-between">
                                    <span>{{ $author->full_name }}</span>
                                    <span class="text-gray-500">({{ $author->papers_count }})</span>
                                </a>
                            </li>
                        @endforeach
                        <li class="text-sm text-gray-600 hover:text-red-700">
                            <a href="#" class="flex justify-between">
                                <span>View all authors...</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-bold text-sm text-gray-700 flex items-center gap-1">
                        <i class="fas fa-tag"></i>
                        <span>Subject</span>
                    </p>
                    <ul class="mt-1 space-y-1 pl-5">
                        @foreach ($topKeywords as $keyword)
                            <li class="text-sm text-gray-600 hover:text-red-700">
                                <a href="#" class="flex justify-between">
                                    <span>{{ $keyword->name }}</span>
                                    <span class="text-gray-500">({{ $keyword->papers_count }})</span>
                                </a>
                            </li>
                        @endforeach
                        <li class="text-sm text-gray-600 hover:text-red-700">
                            <a href="#" class="flex justify-between">
                                <span>View all subjects...</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-bold text-sm text-gray-700 flex items-center gap-1">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Date Issued</span>
                    </p>
                    <ul class="mt-1 space-y-1 pl-5">
                        @foreach ($dateIssued as $range)
                            <li class="text-sm text-gray-600 hover:text-red-700">
                                <a href="#" class="flex justify-between">
                                    <span>{{ $range['label'] }}</span>
                                    <span class="text-gray-500">({{ $range['count'] }})</span>
                                </a>
                            </li>
                        @endforeach
                        <li class="text-sm text-gray-600 hover:text-red-700">
                            <a href="#" class="flex justify-between">
                                <span>View timeline...</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-bold text-sm text-red-700 flex items-center gap-1">
                        <i class="fas fa-file-alt"></i>
                        <span>Has File(s)</span>
                    </p>
                    <ul class="mt-1 space-y-1 pl-5">
                        <li class="text-sm text-gray-600 hover:text-red-700">
                            <a href="#" class="flex justify-between">
                                <span>Yes</span>
                                <span class="text-gray-500">({{ $fileCounts['yes'] }})</span>
                            </a>
                        </li>
                        <li class="text-sm text-gray-600 hover:text-red-700">
                            <a href="#" class="flex justify-between">
                                <span>No</span>
                                <span class="text-gray-500">({{ $fileCounts['no'] }})</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>


  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
        <div>
          <h4 class="text-white font-bold text-lg mb-4">About UMIR</h4>
          <p class="text-sm">
            UMIR is the institutional repository of University of Mindanao, capturing and preserving the intellectual outputs of the university community.
          </p>
        </div>
        <div>
          <h4 class="text-white font-bold text-lg mb-4">Quick Links</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:text-yellow-300 transition-colors duration-200">University Website</a></li>
            <li><a href="#" class="hover:text-yellow-300 transition-colors duration-200">Library Services</a></li>
            <li><a href="#" class="hover:text-yellow-300 transition-colors duration-200">Research Office</a></li>
            <li><a href="#" class="hover:text-yellow-300 transition-colors duration-200">Academic Departments</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-white font-bold text-lg mb-4">Contact Us</h4>
          <address class="text-sm not-italic">
            <p class="mb-2">University of Mindanao</p>
            <p class="mb-2">Bolton Street, Davao City</p>
            <p class="mb-2">Philippines 8000</p>
            <p class="mb-2">Email: umir@umindanao.edu.ph</p>
            <p>Phone: +63 82 221 5991</p>
          </address>
        </div>
        <div>
          <h4 class="text-white font-bold text-lg mb-4">Connect</h4>
          <div class="flex gap-4">
            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 text-xl">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
          <div class="mt-4">
            <p class="text-xs text-gray-500">
              &copy; 2025 University of Mindanao. All rights reserved.
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Mobile Menu Toggle Script -->
  <script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('active');
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if(session('success'))
  <script>
      Swal.fire({
          title: 'Success!',
          text: '{{ session('success') }}',
          icon: 'success',
          confirmButtonText: 'OK'
      })
  </script>
  @endif

</body>
</html>
