<div>
    @if($show)
        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => { show = false; @this.call('hideAlert') }, 5000)"
        x-transition
        class="fixed top-5 right-5 text-sm p-4 text-white rounded-lg shadow-lg z-50 {{ $type == 'success' ? 'bg-green-600 text-white'  : 'bg-red-600 text-white'}}">
            {{$message}}
        </div>
    @endif
</div>
