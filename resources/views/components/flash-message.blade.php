@if (session()->has('success'))
    <div id="flash-message" class="fixed top-4 right-4 z-50 rounded-lg bg-green-100 px-6 py-4 text-base text-green-700 shadow-md" role="alert">
        <div class="flex items-center">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
            <button type="button" class="ml-4" onclick="closeFlashMessage()">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div id="flash-message" class="fixed top-4 right-4 z-50 rounded-lg bg-red-100 px-6 py-4 text-base text-red-700 shadow-md" role="alert">
        <div class="flex items-center">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('error') }}</span>
            <button type="button" class="ml-4" onclick="closeFlashMessage()">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session()->has('warning'))
    <div id="flash-message" class="fixed top-4 right-4 z-50 rounded-lg bg-yellow-100 px-6 py-4 text-base text-yellow-700 shadow-md" role="alert">
        <div class="flex items-center">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('warning') }}</span>
            <button type="button" class="ml-4" onclick="closeFlashMessage()">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

<script>
    function closeFlashMessage() {
        document.getElementById('flash-message').remove();
    }

    // Tự động ẩn sau 3 giây
    setTimeout(() => {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.remove();
        }
    }, 3000);
</script>