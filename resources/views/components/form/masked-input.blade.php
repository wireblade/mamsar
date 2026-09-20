@props([
    'label' => '',
    'model' => '',
    'placeholder' => '',
    'type' => 'text',
    'autofocus' => 'autofocus',
    'mb' => '',
    'mask' => [],
    'maxdigits' => 8,
    'disabled' => '',
])

@php
    $maskArray = is_array($mask) ? $mask : json_decode($mask, true);
    $maxlength = $maxdigits + count($maskArray) - 1;
@endphp

<div class="mb-{{ $mb }} flex flex-col gap-1">

    @if ($label)
        <label for="{{ $model }}" class="text-xs font-medium text-slate-500 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <input @if ($disabled == 'edit') disabled @endif type="{{ $type }}"
        @if ($model) autofocus="{{ $autofocus }}" wire:model.blur="{{ $model }}" @endif
        placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}"
        x-on:input="
            let raw = $event.target.value.replace(/\D/g, '').substring(0, {{ $maxdigits }});
            let parts = {{ json_encode($maskArray) }};
            let result = '';
            let pos = 0;
            for (let i = 0; i < parts.length; i++) {
                if (pos >= raw.length) break;
                if (i > 0) result += '-';
                result += raw.substring(pos, pos + parts[i]);
                pos += parts[i];
            }
            $event.target.value = result;
        "
        class="{{ $disabled == 'edit' ? 'bg-gray-100 text-slate-500' : 'bg-white text-slate-800' }} @error($model) @else @enderror h-10 rounded-lg border border-red-500 border-slate-200 px-3 text-sm placeholder-slate-300 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500">

    @error($model)
        <p class="text-sm text-red-500">
            <i class="fa fa-triangle-exclamation text-xs"></i>
            {{ $message }}
        </p>
    @enderror

</div>
