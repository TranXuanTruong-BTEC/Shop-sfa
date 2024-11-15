<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Fashion Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Simplified Header without cursor effects -->
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" 
            x-data="{ isScrolled: false, isMobileMenuOpen: false }"
            @scroll.window="isScrolled = (window.pageYOffset > 20)"
            :class="{ 'backdrop-blur-lg bg-white/90 shadow-lg': isScrolled, 'bg-transparent': !isScrolled }">
        
        <!-- Announcement Bar -->
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 py-2"
             x-show="!isScrolled"
             x-transition:leave="transition ease-in duration-200">
            <p class="text-center text-white text-sm">
                🎉 Free Shipping on Orders Over $100 | Shop Now
            </p>
        </div>

        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <div class="relative w-10 h-10">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg"></div>
                        <svg class="relative z-10 w-full h-full p-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold" :class="{ 'text-gray-900': isScrolled, 'text-white': !isScrolled }">
                        FASHION
                    </span>
                </a>

                <!-- Main Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    @foreach(['New Arrivals', 'Women', 'Men', 'Accessories', 'Sale'] as $item)
                    <a href="#" 
                       class="relative font-medium transition-colors"
                       :class="{ 'text-gray-900 hover:text-purple-600': isScrolled, 'text-white hover:text-purple-200': !isScrolled }">
                        {{ $item }}
                    </a>
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="hidden lg:flex items-center space-x-6">
                    <!-- Search -->
                    <button class="p-2" @click="$dispatch('open-search')">
                        <svg class="w-6 h-6" :class="{ 'text-gray-900': isScrolled, 'text-white': !isScrolled }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <!-- Account -->
                    <a href="/account" class="p-2">
                        <svg class="w-6 h-6" :class="{ 'text-gray-900': isScrolled, 'text-white': !isScrolled }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </a>

                    <!-- Cart -->
                    <button class="p-2 relative" @click="$dispatch('toggle-cart')">
                        <svg class="w-6 h-6" :class="{ 'text-gray-900': isScrolled, 'text-white': !isScrolled }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-purple-600 rounded-full flex items-center justify-center text-xs text-white">
                            {{ \Cart::getTotalQuantity() }}
                        </span>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="lg:hidden relative z-10">
                    <div class="flex flex-col space-y-1.5 w-6">
                        <div class="w-full h-0.5 bg-current transition-all"
                             :class="{ 'rotate-45 translate-y-2': isMobileMenuOpen, 'bg-gray-900': isScrolled, 'bg-white': !isScrolled }"></div>
                        <div class="w-full h-0.5 bg-current transition-all"
                             :class="{ 'opacity-0': isMobileMenuOpen, 'bg-gray-900': isScrolled, 'bg-white': !isScrolled }"></div>
                        <div class="w-full h-0.5 bg-current transition-all"
                             :class="{ '-rotate-45 -translate-y-2': isMobileMenuOpen, 'bg-gray-900': isScrolled, 'bg-white': !isScrolled }"></div>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div x-show="isMobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-white border-t">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col space-y-4">
                    @foreach(['New Arrivals', 'Women', 'Men', 'Accessories', 'Sale'] as $item)
                    <a href="#" class="text-gray-900 hover:text-purple-600 transition-colors py-2">
                        {{ $item }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section with Background Slider -->
        <div class="relative min-h-screen">
            <!-- Background Slider -->
            <div class="absolute inset-0 z-0">
                <div class="relative h-full overflow-hidden">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/40 z-10"></div>
                </div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-20 container mx-auto px-4 pt-32">
                <div class="max-w-4xl">
                    <h1 class="text-7xl font-bold text-white leading-tight mb-6">
                        Discover Your <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">
                            Perfect Style
                        </span>
                    </h1>
                    <p class="text-xl text-gray-300 mb-12 max-w-2xl">
                        Explore our curated collection of premium fashion pieces designed to elevate your everyday style.
                    </p>
                    <div class="flex flex-wrap gap-6">
                        <a href="#collection" class="btn-primary">
                            Shop Collection
                        </a>
                        <a href="#about" class="btn-secondary">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Categories -->
        <section class="py-24 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-center mb-16">Shop by Category</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(['Women', 'Men', 'Accessories'] as $category)
                    <a href="#" class="group relative overflow-hidden rounded-2xl aspect-[4/5]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-10"></div>
                        <img src="/images/categories/{{ strtolower($category) }}.jpg" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                             alt="{{ $category }}">
                        <div class="absolute bottom-0 left-0 right-0 p-8 z-20">
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $category }}</h3>
                            <p class="text-gray-200 mb-4">Explore Collection</p>
                            <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-purple-600 transition-colors">
                                <svg class="w-6 h-6 text-white transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- Modern Footer -->
    <footer class="bg-gray-900 pt-16 pb-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Logo & About Section -->
                <div>
                    <!-- Updated Logo to match header -->
                    <a href="/" class="flex items-center space-x-2 mb-6">
                        <div class="relative w-10 h-10">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg"></div>
                            <svg class="relative z-10 w-full h-full p-2 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white">
                            FASHION
                        </span>
                    </a>
                    <p class="text-gray-400 mb-8">
                        Discover the latest trends and express your unique style with our curated collection of fashion essentials.
                    </p>
                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-purple-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-purple-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-purple-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.897 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.897-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Rest of the footer content remains the same -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-6">Quick Links</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Size Guide</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Shipping Info</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-6">Categories</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Women</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Men</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Accessories</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">New Arrivals</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Sale</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-6">Newsletter</h3>
                    <p class="text-gray-400 mb-6">Subscribe to get special offers, free giveaways, and new arrivals.</p>
                    <form class="relative">
                        <input type="email" 
                               required
                               placeholder="Enter your email"
                               class="w-full px-4 py-3 bg-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <button type="submit" 
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-400">
                        © 2024 Fashion Store. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>