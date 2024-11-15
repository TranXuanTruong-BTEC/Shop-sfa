<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-8">
                <img class="h-10" src="{{ asset('images/logo.png') }}" alt="Logo">
                <p class="text-gray-500 text-base">
                    Chúng tôi cung cấp những sản phẩm chất lượng cao với giá cả hợp lý.
                </p>
            </div>
            
            <div>
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                    Sản phẩm
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                            Sản phẩm mới
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                            Bán chạy nhất
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                    Công ty
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                            Về chúng tôi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                            Liên hệ
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                    Pháp lý
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                            Chính sách bảo mật
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                            Điều khoản sử dụng
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="mt-12 border-t border-gray-200 pt-8">
            <p class="text-base text-gray-400 text-center">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Tất cả các quyền được bảo lưu.
            </p>
        </div>
    </div>
</footer>