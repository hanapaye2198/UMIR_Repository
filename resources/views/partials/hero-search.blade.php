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
