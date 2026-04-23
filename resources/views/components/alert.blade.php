@if (session('success'))
    <div class="auto-dismiss-alert transition-opacity duration-500 ease-in-out bg-[#e8f5e9] border border-[#c8e6c9]/30 text-[#2e7d32] px-4 py-3 rounded-xl flex items-center gap-3 mb-6 shadow-sm">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="auto-dismiss-alert transition-opacity duration-500 ease-in-out bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3 mb-6 shadow-sm">
        <span class="font-medium">{{ session('error') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="auto-dismiss-alert transition-opacity duration-500 ease-in-out bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-1">
                <p class="font-bold mb-2">Please correct the following errors:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.auto-dismiss-alert');
            alerts.forEach(alert => {
                alert.classList.add('opacity-0');
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
