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
