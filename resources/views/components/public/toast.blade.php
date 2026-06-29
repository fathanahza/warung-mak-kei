@if(session('success') || session('error') || session('info'))
<div x-data="{
        show: true,
        type: '{{ session('success') ? 'success' : (session('error') ? 'error' : 'info') }}',
        message: '{{ session('success') ?? session('error') ?? session('info') }}'
     }"
     x-show="show"
     x-init="setTimeout(() => show = false, 4000)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak
     class="fixed top-20 right-4 z-[100] max-w-sm w-full">
    <div :class="{
            'bg-green-50 border-green-500 text-green-800': type === 'success',
            'bg-red-50 border-red-500 text-red-800': type === 'error',
            'bg-blue-50 border-blue-500 text-blue-800': type === 'info'
         }"
         class="flex items-start gap-3 px-4 py-3 rounded-2xl border-l-4 shadow-xl dark:bg-gray-800 dark:text-gray-100">
        {{-- Icon --}}
        <div class="flex-shrink-0 mt-0.5">
            <svg x-show="type === 'success'" class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <svg x-show="type === 'error'" x-cloak class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <p class="text-sm font-medium flex-1" x-text="message"></p>
        <button @click="show = false" class="flex-shrink-0 text-gray-400 hover:text-gray-600 ml-2">×</button>
    </div>
</div>
@endif
