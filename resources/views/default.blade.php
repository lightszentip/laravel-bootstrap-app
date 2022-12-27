<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('Dashboard') }}
            </h1>
        </x-slot>

        <div class="py-12">
            @yield('content')
        </div>
    </div>
</x-app-layout>
