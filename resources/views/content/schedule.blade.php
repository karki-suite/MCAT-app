<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Content Schedule') }}
        </h2>
    </x-slot>

    <div class="py-6">
        @foreach ($groups as $group)
            <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight pb-1">{{ $group->title }}</h3>
                <h4 class="font-semibold text-lg text-gray-800 leading-tight pb-1">{{ $group->subtitle }}</h4>
                <div class="block md:grid md:grid-cols-3 md:flex md:flex-wrap md:text-left text-center">
                    @foreach ($group->categories as $category)
                        <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h5 class="font-semibold text-center text-lg text-gray-800 leading-tight pb-1">{{ $category->title }}</h5>
                                @if (count($category->contentsOverview) > 0)
                                    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">Overview</h6>
                                @endif
                                @foreach ($category->contentsOverview as $content)
                                    <div>{{ $content->label }}</div>
                                @endforeach
                                @if (count($category->contentsContent) > 0)
                                    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">Content</h6>
                                @endif
                                @foreach ($category->contentsContent as $content)
                                    <div>{{ $content->label }}</div>
                                @endforeach
                                @if (count($category->contentsReview) > 0)
                                    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">Review</h6>
                                @endif
                                @foreach ($category->contentsReview as $content)
                                    <div>{{ $content->label }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
