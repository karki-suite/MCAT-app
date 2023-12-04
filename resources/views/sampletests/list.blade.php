<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Sample Tests') }}
        </h2>
    </x-slot>
    @include('sampletests/partials/navigation', ['tests' => $tests])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <p>Select a sample test above.</p>
            </div>
        </div>
    </div>
</x-app-layout>
