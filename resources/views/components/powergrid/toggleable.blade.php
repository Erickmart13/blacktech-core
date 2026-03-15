<label class="relative inline-flex items-center cursor-pointer">
    <input
        type="checkbox"
        class="sr-only peer"
        wire:change="onUpdatedToggleable({{ $rowId }}, '{{ $field }}', $event.target.checked ? 1 : 0)"
        @checked(data_get($row, $field))
    >

    <div class="w-10 h-5 rounded-full border-2 transition
        {{ data_get($row, $field) ? 'bg-none border-emerald-500 ' : 'bg-gray-none border-gray-500' }}
        after:content-['']
        after:absolute
        after:top-[4px]
        after:left-[4px]
        after:bg-emerald-500 
        after:rounded-full
        after:h-3
        after:w-3
        after:transition-all
        {{ data_get($row, $field) ? 'after:translate-x-5' : 'after:bg-gray-600' }}">
    </div>
</label>