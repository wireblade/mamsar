@props([
    'label' => '',
    'model' => '',
    'placeholder' => '',
    'type' => 'text',
    'autofocus' => 'autofocus',
    'mb' => '',
])

<div class="mb-{{ $mb }} flex flex-col gap-1">
    @if ($label)
        <label for="{{ $model }}" class="text-xs font-medium text-slate-500 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    @php
        $capitalize = "\$wire.$model = event.target.value.replace(/(^|\\s)\\S/g, function(m) { return m.toUpperCase(); })";
    @endphp

    <input type="{{ $type }}" @input="{{ $capitalize }}"
        @if ($model) autofocus="{{ $autofocus }}" wire:model="{{ $model }}" @endif
        placeholder="{{ $placeholder }}"
        class="@if ($type == 'file') file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border file:border-slate-200 dark:file:border-gray-600 file:text-xs file:font-medium file:text-slate-600 dark:file:text-gray-300 file:bg-slate-50 dark:file:bg-gray-700 hover:file:bg-slate-100 dark:hover:file:bg-gray-600 file:cursor-pointer cursor-pointer
    @else
    h-10 px-3 rounded-lg border text-sm
                text-slate-800 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-slate-300 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @endif @error($model)
    border-red-500
    @else
    border-slate-200 dark:border-gray-600
    @enderror transition duration-200" />

    @error($model)
        <p class="text-sm text-red-500">
            <i class="fa fa-triangle-exclamation text-xs"></i>
            {{ $message }}
        </p>
    @enderror
</div>
