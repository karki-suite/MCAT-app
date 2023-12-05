<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Application Schedule') }}
        </h2>
    </x-slot>
    <div class="py-6">
        @foreach($content as $contentSection)
            <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight pb-1">{{ $contentSection['title'] }}</h3>
                <div class="block md:grid md:grid-cols-3 md:flex md:flex-wrap md:text-left">
                    <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h5 class="font-semibold text-center text-lg text-gray-800 leading-tight pb-1">Most Common Errors</h5>
                            @foreach($contentSection['commonErrorTypes'] as $errorType)
                                <p>{{ $errorType }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h5 class="font-semibold text-center text-lg text-gray-800 leading-tight pb-1">Weakest Content Areas</h5>
                            @foreach($contentSection['weakestCategories'] as $category)
                                <p>{{ $category }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>
