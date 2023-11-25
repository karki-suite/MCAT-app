<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Sample Tests') }}
        </h2>
    </x-slot>
    <div class="bg-orange-100">
        <div class="py-2 px-6 mx-auto lg:px-8 max-w-7xl lg:grid lg:grid-cols-6 text-center lg:text-left">
            @foreach($tests as $testId => $testLabel)
                <div><a href="{{ route('sampletests.show', ['id' => $testId]) }}" class="text-blue-800">{{ $testLabel }}</a></div>
            @endforeach
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <p>Select a sample test above.</p>
            </div>
        </div>
    </div>
</x-app-layout>
