<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('auth.xacthuc') }}">
            @csrf

            <div>
                <x-jet-label for="TenDangNhap" value="{{ __('Tên đăng nhập') }}" />
                <x-jet-input id="TenDangNhap" class="block mt-1 w-full" type="text" name="TenDangNhap" :value="old('TenDangNhap')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="MatKhau" value="{{ __('Mật khẩu') }}" />
                <x-jet-input id="MatKhau" class="block mt-1 w-full" type="password" name="MatKhau" required autocomplete="current-password" />
            </div> 

            <div class="flex items-center justify-end mt-4">  
                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
