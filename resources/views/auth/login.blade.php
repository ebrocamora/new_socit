<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:py-6 transition-all">
        <div class="relative w-full sm:max-w-md p-4 sm:rounded-md bg-white border-b-8 border-gray-200">
            <header class="relative sm:text-center py-4 px-4 mb-4">
                <h1 class="font-poppins font-extrabold text-3xl">Login</h1>
            </header>
            <form method="POST" action="{{ route('login') }}" class="px-4">
                @csrf
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="email">{{ __('Email') }}</label>
                    <div class="relative flex items-center">
                        <input type="text" id="email" name="email" class="focus:ring-0 border-0 w-full px-2" value="{{ old('email') }}"/>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="password">{{ __('Password') }}</label>
                    <div class="relative flex items-center">
                        <input type="password" id="password" name="password" class="focus:ring-0 border-0 w-full px-2"/>
                    </div>
                </div>
                <div class="relative mt-4">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="remember" id="remember_me" class="rounded transition-all"/>
                        <label class="text-sm px-2 block font-bold" for="remember_me">{{ __('Remember me') }}</label>
                    </div>
                </div>
                <div class="relative mt-4">
                    <input type="submit" value="Log in" class="font-bold text-white h-12 w-full bg-gradient-to-r from-blue-800 to-gray-800 hover:from-blue-500 hover:to-blue-800 rounded-md cursor-pointer transition-all"/>
                </div>
                @if(Route::has('register'))
                <div class="relative mt-4 text-center">
                    <span class="text-gray-600">{{ __('No account yet?') }}</span>
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">{{ __('Create one.') }}</a>
                </div>
                @endif
                @if(Route::has('password.request'))
                    <div class="relative mt-4 text-center">
                        <a href="{{ route('password.request') }}" class="text-blue-600 font-bold hover:underline">{{ __('Forgot your password?') }}</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    @if($errors->any())
    <script>
        const error = "{{ $errors->first() }}";

        Swal.fire({
            toast: true,
            position: 'top-end',
            title: error,
            // text: error,
            icon: 'error',
            padding: '.5rem 1rem .5rem 1rem',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            customClass: {
                title: 'py-0'
            }
        })
    </script>
    @endif
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password"--}}
{{--                                required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <!-- Remember Me -->--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="inline-flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-button class="ml-3">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
</x-guest-layout>
