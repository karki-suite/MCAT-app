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
                <div class="block md:grid md:grid-cols-3 md:flex md:flex-wrap md:text-left">
                    @foreach ($group->categories as $category)
                        @include('content.schedule.category', ['category' => $category])
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('.fa-video').click(function (e) {
                if ($(this).attr('href').includes('youtube')) {
                    var searchString = new URL($(this).attr('href')).search;
                    var searchParts = parseUrlParams(searchString);
                    if (searchParts['v']) {
                        e.preventDefault();
                        $('<div style="max-width:620px;"><iframe width="560" height="315" src="https://www.youtube.com/embed/' + searchParts['v'] + '" title="YouTube Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>').modal();
                    }
                }
            });
        });

        function parseUrlParams(url) {
            var query = url.substr(1);
            var result = {};
            query.split("&").forEach(function (part) {
                var item = part.split("=");
                result[item[0]] = decodeURIComponent(item[1]);
            });
            return result;
        }
    </script>
</x-app-layout>
