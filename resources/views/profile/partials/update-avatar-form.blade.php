<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ __('Avatar') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Chọn avatar đại diện cho tài khoản của bạn.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.avatar') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach(['user1' => 'text-blue-500', 'user2' => 'text-green-500', 'user3' => 'text-purple-500', 'user4' => 'text-red-500'] as $id => $color)
                <div class="relative group">
                    <input type="radio" 
                           name="avatar" 
                           id="avatar_{{ $id }}" 
                           value="{{ $id }}"
                           class="hidden peer"
                           {{ auth()->user()->avatar === $id ? 'checked' : '' }}>
                    
                    <label for="avatar_{{ $id }}" 
                           class="block aspect-square rounded-xl cursor-pointer transition-all duration-300 
                                  bg-gray-50 hover:bg-gray-100 border-2 
                                  peer-checked:border-indigo-500 peer-checked:ring-2 peer-checked:ring-indigo-500 peer-checked:ring-offset-2">
                        <div class="w-full h-full p-3 {{ $color }} transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 
                                    rounded-xl transition-all duration-300 flex items-center justify-center">
                            <span class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 
                                       transition-opacity duration-300 bg-black bg-opacity-50 px-3 py-1.5 rounded-full
                                       transform -translate-y-2 group-hover:translate-y-0">
                                Chọn Avatar
                            </span>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-indigo-500 hover:bg-indigo-600 transition duration-300">
                {{ __('Lưu Avatar') }}
            </x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600">
                    {{ __('Đã lưu thành công.') }}
                </p>
            @endif
        </div>
    </form>
</section>