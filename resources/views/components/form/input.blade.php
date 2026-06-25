@props([
    'label' => '',
    'name' => '',
    'placeholder' => '',
    'type' => 'text',
    'autofocus' => 'autofocus',
    'mb' => '',
])

<div class="flex flex-col gap-1 mb-{{ $mb }}">

    @if ($label)
        <label for="{{ $name }}" class="text-xs font-medium text-slate-500 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}"
        @if ($name) autofocus="{{ $autofocus }}" wire:model="{{ $name }}" @endif
        placeholder="{{ $placeholder }}"
        class="
            h-10 px-3 rounded-lg border text-sm text-slate-800 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder-slate-300 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition
      
            @error($name) 
                border-red-500 
            @else
                border-slate-200 dark:border-gray-600
            @enderror  
        
        ">

    @error($name)
        <p class="text-red-500 text-sm">
            <i class="fa fa-triangle-exclamation text-xs"></i>
            {{ $message }}
        </p>
    @enderror

</div>
