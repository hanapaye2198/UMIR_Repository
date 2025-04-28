<div class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-3 px-4 sm:px-6 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm sm:text-base">
      @foreach($links as $link)
        @if(isset($link['url']))
          <a href="{{ $link['url'] }}" class="font-medium hover:text-gray-800 transition-colors duration-200 flex items-center gap-1">
            {{ $link['label'] }}
          </a>
          <span class="text-gray-700">/</span>
        @else
          <span class="text-gray-700">{{ $link['label'] }}</span>
        @endif
      @endforeach
    </div>
  </div>
