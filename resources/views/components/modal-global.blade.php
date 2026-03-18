{{-- resources/views/components/modal-global.blade.php --}}
@props([
    'id',
    'title' => 'Título',
    'message' => '¿Seguro que deseas continuar?',
    'buttonText' => 'SI',
    'buttonColor' => 'bg-sky-500 hover:bg-sky-600',
    'route',
    'method' => 'POST',     // Por defecto POST
    'hasFile' => false,     // Si el formulario tendrá file upload
])

<div x-data="{ show: false, action: '{{ $route }}', method: '{{ strtoupper($method) }}' }"
     x-show="show"
     x-on:open-modal.window="
        if ($event.detail.id === '{{ $id }}') {
            action = '{{ $route }}'.replace('__ID__', $event.detail.recordId);
            method = '{{ strtoupper($method) }}';
            show = true;
        }
     "
     x-on:keydown.escape.window="show = false"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
     style="display: none;">

    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">{{ $title }}</h2>
        <p class="mb-6 text-gray-600">{{ $message }}</p>

        <div class="flex justify-end gap-4">
            <button @click="show = false" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Regresar</button>

            <form :action="action" method="POST" :enctype="hasFile ? 'multipart/form-data' : 'application/x-www-form-urlencoded'">
                @csrf
                <template x-if="method !== 'POST'">
                    <input type="hidden" name="_method" :value="method">
                </template>

                <button type="submit" class="{{ $buttonColor }} text-white px-4 py-2 rounded">
                    {{ $buttonText }}
                </button>
            </form>
        </div>
    </div>
</div>