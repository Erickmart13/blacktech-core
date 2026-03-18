@props([
    'type' => 'success', // success, error, warning, info
    'message' => null,
])

@php
    $styles = [
        'success' => 'bg-green-100 border-green-300 text-green-800',
        'error' => 'bg-red-100 border-red-300 text-red-800',
        'warning' => 'bg-yellow-100 border-yellow-300 text-yellow-800',
        'info' => 'bg-blue-100 border-blue-300 text-blue-800',
    ][$type] ?? 'bg-gray-100 border-gray-300 text-gray-800';

    $icons = [
        'success' => '✅',
        'error' => '❌',
        'warning' => '⚠️',
        'info' => 'ℹ️',
    ][$type] ?? '🔔';
@endphp

<div
    x-data="{
        show: @js($message !== null),
        msg: @js($message),
        type: @js($type),
        styles: @js($styles),
        icon: @js($icons)
    }"
    x-init="
        setTimeout(() => show = false, 5000);
        window.addEventListener('success', event => {
            msg = event.detail.message;
            type = 'success';
            styles = '{{ $styles }}'.replace(/green-[^ ]+/g, 'green-100 border-green-300 text-green-800');
            icon = '✅';
            show = true;
            setTimeout(() => show = false, 5000);
        });
        window.addEventListener('error', event => {
            msg = event.detail.message;
            type = 'error';
            styles = '{{ $styles }}'.replace(/green-[^ ]+/g, 'red-100 border-red-300 text-red-800');
            icon = '❌';
            show = true;
            setTimeout(() => show = false, 5000);
        });
        window.addEventListener('warning', event => {
            msg = event.detail.message;
            type = 'warning';
            styles = '{{ $styles }}'.replace(/green-[^ ]+/g, 'yellow-100 border-yellow-300 text-yellow-800');
            icon = '⚠️';
            show = true;
            setTimeout(() => show = false, 5000);
        });
        window.addEventListener('info', event => {
            msg = event.detail.message;
            type = 'info';
            styles = '{{ $styles }}'.replace(/green-[^ ]+/g, 'blue-100 border-blue-300 text-blue-800');
            icon = 'ℹ️';
            show = true;
            setTimeout(() => show = false, 5000);
        });
    "
    x-show="show"
    x-transition
    :class="styles"
    class="p-2 mb-2 text-sm border rounded-lg flex items-center gap-2"
    role="alert"
>
    <span class="text-xl" x-text="icon"></span>
    <span x-text="msg"></span>
    <button type="button" @click="show = false" class="ml-auto font-bold">×</button>
</div>