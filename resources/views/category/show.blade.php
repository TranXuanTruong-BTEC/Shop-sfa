@extends('layouts.frontend')

@section('title', $category->name)

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">
                {{ $category->name }}
            </h1>
            @if($category->description)
                <p class="mt-4 text-gray-500">{{ $category->description }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($products as $product)
                <div class="group relative">
                    <div class="relative w-full h-80 rounded-lg overflow-hidden bg-white shadow-md group-hover:shadow-xl transition-shadow duration-300 ease-in-out">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300 ease-in-out">
                        <!-- Quick view button -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="{{ route('product.show', $product->slug) }}" 
                               class="relative inline-flex items-center px-6 py-2 bg-white text-black text-sm font-medium rounded-md hover:bg-gray-100 transition-colors duration-150 ease-in-out">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            <a href="{{ route('product.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <div class="mt-2 flex items-center justify-between">
                            <p class="text-xl font-bold text-indigo-600">
                                {{ number_format($product->price) }}đ
                            </p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Thêm vào giỏ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Không có sản phẩm nào trong danh mục này.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection