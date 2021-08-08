<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:py-6 transition-all">
        <div class="relative w-full sm:max-w-md p-4 sm:rounded-md bg-white border-b-8 border-gray-200">
            <header class="relative sm:text-center py-4 px-4 mb-4">
                <h1 class="font-poppins font-extrabold text-3xl">Register</h1>
            </header>
            <form method="POST" action="{{ route('register') }}" class="px-4">
                @csrf
                <div class="flex w-full gap-4">
                    <div class="relative flex-1 mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                        <label class="text-sm pt-2 px-2 block font-bold" for="name">{{ __('First Name') }}</label>
                        <div class="relative flex items-center">
                            <input type="text" id="fname" name="first_name" class="focus:ring-0 border-0 w-full px-2" value="{{ old('first_name') }}"/>
                        </div>
                    </div>
                    <div class="relative flex-1 mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                        <label class="text-sm pt-2 px-2 block font-bold" for="name">{{ __('Middle Name') }}</label>
                        <div class="relative flex items-center">
                            <input type="text" id="mname" name="middle_name" class="focus:ring-0 border-0 w-full px-2" value="{{ old('middle_name') }}"/>
                        </div>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="name">{{ __('Last Name') }}</label>
                    <div class="relative flex items-center">
                        <input type="text" id="lname" name="last_name" class="focus:ring-0 border-0 w-full px-2" value="{{ old('last_name') }}"/>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="email">{{ __('Email') }}</label>
                    <div class="relative flex items-center">
                        <input type="text" id="email" name="email" class="focus:ring-0 border-0 w-full px-2" value="{{ old('email') }}"/>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="username">{{ __('Username') }}</label>
                    <div class="relative flex items-center">
                        <input type="text" id="username" name="username" class="focus:ring-0 border-0 w-full px-2" value="{{ old('username') }}"/>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="password">{{ __('Password') }}</label>
                    <div class="relative flex items-center">
                        <input type="password" id="password" name="password" class="focus:ring-0 border-0 w-full px-2"/>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <div class="relative flex items-center">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="focus:ring-0 border-0 w-full px-2"/>
                    </div>
                </div>
                <div class="relative mt-4 border-2 focus-within:border-blue-500 rounded-md overflow-hidden transition">
                    <label class="text-sm pt-2 px-2 block font-bold" for="referrer">{{ __('Referrer') }}</label>
                    <div class="relative flex items-center">
                        <input type="text" id="referrer" name="referrer" class="focus:ring-0 border-0 w-full px-2"/>
                    </div>
                </div>
                <div class="relative mt-4">
                    <input type="submit" value="Register" class="font-bold text-white h-12 w-full bg-gradient-to-r from-blue-800 to-gray-800 hover:from-blue-500 hover:to-blue-800 rounded-md cursor-pointer transition-all"/>
                </div>
                @if(Route::has('login'))
                    <div class="relative mt-4 text-center">
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">{{ __('Already registered?') }}</a>
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

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('register') }}">--}}
{{--            @csrf--}}

{{--            <!-- Name -->--}}
{{--            <div>--}}
{{--                <x-label for="name" :value="__('Name')" />--}}

{{--                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Email Address -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password"--}}
{{--                                required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <!-- Confirm Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--                <x-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password_confirmation" required />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
{{--                    {{ __('Already registered?') }}--}}
{{--                </a>--}}

{{--                <x-button class="ml-4">--}}
{{--                    {{ __('Register') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
</x-guest-layout>
