<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sửa danh mục') }}
            </h2>
            <a href="{{ route('admin.categories.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Trở về
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1">
                                <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                                <textarea name="description" 
                                          id="description"
                                          rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1">
                                <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                                @if($category->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/categories/' . $category->image) }}" 
                                             alt="{{ $category->name }}" 
                                             class="w-32 h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                                <input type="file" 
                                       name="image" 
                                       id="image"
                                       class="mt-1 block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-indigo-50 file:text-indigo-700
                                              hover:file:bg-indigo-100"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <div id="imagePreview" class="mt-2 hidden">
                                    <img src="" alt="Preview" class="max-h-48 rounded-lg">
                                </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end space-x-3">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const previewImg = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>