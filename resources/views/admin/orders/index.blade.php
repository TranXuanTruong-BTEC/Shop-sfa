<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quản lý đơn hàng') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Quay về Dashboard
                </a>
                <!-- Các nút khác nếu có -->
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Tìm kiếm -->
                        <div class="col-span-1">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Tìm kiếm..."
                                   class="w-full rounded-md border-gray-300">
                        </div>

                        <!-- Lọc theo ngày -->
                        <div class="col-span-2 flex gap-2">
                            <input type="date" 
                                   name="date_from" 
                                   value="{{ request('date_from') }}"
                                   class="rounded-md border-gray-300">
                            <span class="self-center">đến</span>
                            <input type="date" 
                                   name="date_to" 
                                   value="{{ request('date_to') }}"
                                   class="rounded-md border-gray-300">
                        </div>

                        <!-- Export -->
                        <div class="col-span-1 flex justify-end">
                            <a href="{{ route('admin.orders.export', request()->query()) }}" 
                               class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                <i class="fas fa-file-excel mr-2"></i> Xuất Excel
                            </a>
                        </div>
                    </div>

                    <!-- Thêm thống kê -->
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <div class="text-blue-800 text-lg font-semibold">Tổng đơn hàng</div>
                            <div class="text-2xl font-bold">{{ $totalOrders }}</div>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <div class="text-green-800 text-lg font-semibold">Tổng doanh thu</div>
                            <div class="text-2xl font-bold">{{ number_format($totalAmount, 0, ',', '.') }}đ</div>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <div class="text-yellow-800 text-lg font-semibold">Đơn chờ xử lý</div>
                            <div class="text-2xl font-bold">{{ $orders->where('status', 'pending')->count() }}</div>
                        </div>
                    </div>

                    <!-- Bảng đơn hàng -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mã đơn
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Khách hàng
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tổng tiền
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Trạng thái
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <a href="{{ route('admin.orders.index', array_merge(request()->query(), [
                                            'sort' => 'created_at',
                                            'direction' => request('sort') === 'created_at' && request('direction') === 'asc' ? 'desc' : 'asc'
                                        ])) }}" class="group inline-flex">
                                            Ngày đặt
                                            @if(request('sort') === 'created_at')
                                                @if(request('direction') === 'asc')
                                                    <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L10 13.586l3.293-3.293a1 1 0 011.414 0z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L10 6.414l-3.293 3.293a1 1 0 01-1.414 0z"/>
                                                    </svg>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $order->order_number }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order->customer_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ number_format($order->total_amount, 0, ',', '.') }}đ
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                @switch($order->status)
                                                    @case('pending')
                                                        Chờ xử lý
                                                        @break
                                                    @case('processing')
                                                        Đang xử lý
                                                        @break
                                                    @case('completed')
                                                        Hoàn thành
                                                        @break
                                                    @case('cancelled')
                                                        Đã hủy
                                                        @break
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $order->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.orders.show', $order) }}" 
                                               class="text-indigo-600 hover:text-indigo-900">Chi tiết</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Không có đơn hàng nào
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Phân trang -->
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>