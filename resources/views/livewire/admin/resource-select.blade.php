<div class="md:flex gap-6">
    <!-- 🔹 Select módulo -->
    <div class="md:w-3/6 mb-2 md:mb-0">
        <label class="block text-gray-700 text-sm font-bold mb-2">Módulo</label>
        <select wire:model.live="module_id" class="border rounded p-2 w-full" name="module_id">
            <option value="">-- Selecciona módulo --</option>
            @foreach ($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
            @endforeach
        </select>
        @error('module_id')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <!-- 🔹 Select padre -->
    <div class="md:w-3/6">
        <label class="block text-gray-700 text-sm font-bold mb-2">Padre (opcional)</label>
        <select wire:model="parent_id" name="parent_id"
            class="border rounded p-2 w-full {{ empty($parents) ? 'disabled' : '' }}">
            <option value="">-- Menú principal --</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}">
                    {{ str_repeat('— ', $parent->level) }} {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
