@php
$defaultAvatars = [
    [
        'id' => 'user1',
        'svg' => '<svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                 </svg>',
        'color' => 'text-blue-500'
    ],
    [
        'id' => 'user2',
        'svg' => '<svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                 </svg>',
        'color' => 'text-green-500'
    ],
    [
        'id' => 'cat',
        'svg' => '<svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                 </svg>',
        'color' => 'text-purple-500'
    ],
    [
        'id' => 'dog',
        'svg' => '<svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                 </svg>',
        'color' => 'text-yellow-500'
    ],
    [
        'id' => 'robot',
        'svg' => '<svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                 </svg>',
        'color' => 'text-red-500'
    ],
    [
        'id' => 'alien',
        'svg' => '<svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                 </svg>',
        'color' => 'text-indigo-500'
    ],
    // Thêm nhiều icons khác...
];
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" x-data="{ selectedAvatar: '{{ $currentAvatar ?? '' }}' }">
    @foreach($defaultAvatars as $avatar)
        <div class="relative group">
            <input type="radio" 
                   name="avatar" 
                   id="avatar_{{ $avatar['id'] }}" 
                   value="{{ $avatar['id'] }}"
                   class="hidden peer"
                   x-model="selectedAvatar">
            
            <label for="avatar_{{ $avatar['id'] }}" 
                   class="block w-24 h-24 rounded-full cursor-pointer transition-all duration-200 
                          bg-gray-100 hover:bg-gray-200 border-4 
                          peer-checked:border-blue-500 peer-checked:{{ $avatar['color'] }}">
                <div class="w-full h-full p-2 {{ $avatar['color'] }}">
                    {!! $avatar['svg'] !!}
                </div>
                
                <!-- Overlay khi hover -->
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 
                            rounded-full transition-all duration-200 flex items-center justify-center">
                    <span class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 
                               transition-opacity duration-200 bg-black bg-opacity-50 px-2 py-1 rounded-full">
                        Chọn
                    </span>
                </div>
            </label>
        </div>
    @endforeach
</div>