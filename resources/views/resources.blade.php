<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Resources') }}
        </h2>
    </x-slot>

    <div class="py-6">
        @include('resources.block', ['resources' => $resources, 'title' => 'Resources'])
        @include('resources.block', ['resources' => $services, 'title' => 'Services'])
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="p-6 text-gray-900 text-center text-xl">Contact</h4>
            <div class="mb-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <a href="mailto:keepingupwiththekarkis@gmail.com" class="text-blue-800">keepingupwiththekarkis@gmail.com</a>
                </div>
            </div>
        </div>
</x-app-layout>
