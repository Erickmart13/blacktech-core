@props([
    'message' => null,
])

<div class="p-2 mx-0 md:mx-3 mb-1.5 text-sm border rounded-lg flex items-center gap-2 
            bg-red-100 border-red-300 text-red-800" role="alert">
    <span class="text-xl">❌</span>
    <span>{{ $message }}</span>
</div>
