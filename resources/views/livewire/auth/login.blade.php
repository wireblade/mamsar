<x-layouts::auth :title="__('MAMSAR | Sign in')" :description="__('Mamsar Construction and Industrial Corporation')">
    <div class="mx-auto w-full max-w-md">

        {{-- Header --}}
        <div class="mb-8">
            <div class="mb-5 h-1 w-10 rounded-full bg-orange-500"></div>

            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                MAMSAR
            </p>

            <h1 class="mt-3 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                Sign in to your account
            </h1>

            <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                Mamsar Construction and Industrial Corporation
            </p>
        </div>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-5 text-sm" :status="session('status')" />

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf

            <flux:input name="username" :label="__('Username')" :value="old('username')" type="text" required
                autofocus autocomplete="username" placeholder="Enter your username" />

            <flux:input name="password" :label="__('Password')" type="password" required autocomplete="current-password"
                :placeholder="__('Enter your password')" viewable />

            <div class="pt-2">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Sign in') }}
                </flux:button>
            </div>
        </form>

        {{-- Footer --}}
        <div class="mt-8 border-t border-zinc-200 pt-5 dark:border-zinc-800">
            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                &copy; {{ date('Y') }} MAMSAR Construction & Industrial Corporation
            </p>
        </div>

    </div>
</x-layouts::auth>
