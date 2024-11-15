<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 hover:text-indigo-600">
                    Trang chủ
                </a>
                <a href="{{ route('products') }}" 
                   class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 hover:text-indigo-600">
                    Sản phẩm
                </a>
            </nav>

            <!-- Cart -->
            <div class="flex items-center">
                <a href="{{ route('cart') }}" class="group -m-2 p-2 flex items-center">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">
                        {{ Cart::getContent()->count() }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>>
            </div>
        @endif
    </div>
</div>