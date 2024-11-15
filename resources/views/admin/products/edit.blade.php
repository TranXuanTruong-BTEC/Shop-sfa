<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sửa sản phẩm') }}
            </h2>
            <a href="{{ route('admin.products.index') }}" 
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
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tên sản phẩm -->
                            <div class="col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name', $product->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Giá -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Giá (VNĐ)</label>
                                <input type="text" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price', number_format($product->price, 0, ',', '')) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       required
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                       onblur="formatPrice(this)">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Số lượng -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Số lượng</label>
                                <input type="number" 
                                       name="quantity" 
                                       id="quantity"
                                       value="{{ old('quantity', $product->quantity) }}"
                                       min="0"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       required>
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Danh mục -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
                                <select name="category_id" 
                                        id="category_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                        required>
                                    <option value="">Chọn danh mục</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Trạng thái -->
                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                                <select name="is_active" 
                                        id="is_active"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="1" {{ old('is_active', $product->is_active) ? 'selected' : '' }}>Đang bán</option>
                                    <option value="0" {{ old('is_active', $product->is_active) ? '' : 'selected' }}>Ngừng bán</option>
                                </select>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hình ảnh -->
                            <div class="col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                                <input type="file" 
                                       name="image" 
                                       id="image"
                                       accept="image/*"
                                       onchange="previewImage(this)"
                                       class="mt-1 block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-indigo-50 file:text-indigo-700
                                              hover:file:bg-indigo-100">
                                
                                <!-- Hiển thị ảnh hiện tại -->
                                <div class="mt-2 flex items-center space-x-4">
                                    <div id="currentImage" class="{{ $product->image ? '' : 'hidden' }}">
                                        <p class="text-sm text-gray-500 mb-1">Ảnh hiện tại:</p>
                                        <img src="{{ $product->image ? asset('uploads/products/' . $product->image) : '' }}" 
                                             alt="Current image"
                                             class="max-h-48 rounded-lg">
                                    </div>
                                    
                                    <div id="imagePreview" class="hidden">
                                        <p class="text-sm text-gray-500 mb-1">Ảnh mới:</p>
                                        <img src="" alt="Preview" class="max-h-48 rounded-lg">
                                    </div>
                                </div>
                                
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Mô tả -->
                            <div class="col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                                <textarea name="description" 
                                          id="description"
                                          rows="4"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nút submit -->
                            <div class="col-span-2 flex justify-end space-x-3">
                                <a href="{{ route('admin.products.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-150 ease-in-out">
                                    Hủy
                                </a>
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

        function formatPrice(input) {
            // Xóa tất cả dấu phẩy và chấm hiện có
            let value = input.value.replace(/[.,]/g, '');
            
            // Format số với dấu chấm phân cách hàng nghìn
            if (value !== '') {
                value = parseInt(value).toLocaleString('vi-VN');
                input.value = value.replace(/\./g, ''); // Xóa dấu chấm khi submit
            }
        }

        // Format giá ban đầu khi load trang
        window.addEventListener('load', function() {
            const priceInput = document.getElementById('price');
            formatPrice(priceInput);
        });

        // Format giá khi submit form
        document.querySelector('form').addEventListener('submit', function(e) {
            const priceInput = document.getElementById('price');
            priceInput.value = priceInput.value.replace(/[.,]/g, '');
        });
    </script>
</x-app-layout>