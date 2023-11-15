<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h4 class="p-6 text-gray-900 text-center text-xl">{{ $title }}</h4>
    <div class="mb-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="block lg:grid lg:grid-cols-3 text-center">
                @foreach($resources as $resource)
                    <div class="mb-1 lg:mr-1">
                        <a href="{{ $resource['link'] }}" class="text-blue-800" target="_BLANK">{{ $resource['title'] }}</a>
                        @if($resource['paid']) (paid) @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
