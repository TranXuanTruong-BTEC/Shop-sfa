<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hồ sơ của tôi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Profile Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                    <!-- Left Column - Avatar & Basic Info -->
                    <div class="md:col-span-1 space-y-6">
                        <!-- Avatar Section -->
                        <div class="text-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                            <div class="relative inline-block">
                                <div class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-500 overflow-hidden hover:shadow-lg transition duration-300">
                                    @if(auth()->user()->avatar_svg)
                                        {!! auth()->user()->avatar_svg !!}
                                    @else
                                        <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                        </svg>
                                    @endif
                                </div>
                                <button type="button" 
                                        class="absolute bottom-0 right-0 bg-indigo-500 text-white p-2 rounded-full hover:bg-indigo-600 transition duration-300 shadow-lg"
                                        onclick="document.getElementById('avatarSection').scrollIntoView({behavior: 'smooth'})">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-gray-500">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- Quick Stats -->
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition duration-300">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Thông tin tài khoản</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Ngày tham gia</span>
                                    <span class="text-gray-900">{{ auth()->user()->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Trạng thái</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Hoạt động
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Forms -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Avatar Selection -->
                        <div id="avatarSection" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition duration-300">
                            @include('profile.partials.update-avatar-form')
                        </div>

                        <!-- Profile Information -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition duration-300">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <!-- Password Update -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition duration-300">
                            @include('profile.partials.update-password-form')
                        </div>

                        <!-- Delete Account -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition duration-300">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add hover effects
        const cards = document.querySelectorAll('.hover\\:shadow-md');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('transform', 'scale-[1.01]');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('transform', 'scale-[1.01]');
            });
        });
    </script>
    @endpush
</x-app-layout>
