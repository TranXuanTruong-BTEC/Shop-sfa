<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Quản lý danh mục</h5>
                        </a>

                        <a href="{{ route('admin.products.index') }}" 
                           class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Quản lý sản phẩm</h5>
                        </a>

                        <a href="{{ route('admin.orders.index') }}" 
                           class="block p-6 bg-white border rounded-lg shadow hover:bg-gray-100">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Quản lý đơn hàng</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>