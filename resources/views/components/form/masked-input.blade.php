@props([
    'label' => '',
    'model' => '',
    'placeholder' => '',
    'type' => 'text',
    'autofocus' => 'autofocus',
    'mb' => '',
    'mask' => [],
    'maxdigits' => 8,
])

@php
    $maskArray = is_array($mask) ? $mask : json_decode($mask, true);
    $maxlength = $maxdigits + count($maskArray) - 1;
@endphp

<div class="flex flex-col gap-1 mb-{{ $mb }}">

    @if ($label)
        <label for="{{ $model }}" class="text-xs font-medium text-slate-500 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}"
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
        class="
            h-10 px-3 rounded-lg border text-sm text-slate-800 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-slate-300 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition
      
@error($model)
border-red-500
@else
border-slate-200 dark:border-gray-600
@enderror  
        
        ">

    @error($model)
        <p class="text-red-500 text-sm">
            <i class="fa fa-triangle-exclamation text-xs"></i>
            {{ $message }}
        </p>
    @enderror

</div>
