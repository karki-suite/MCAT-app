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
                        <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h5 class="font-semibold text-center text-lg text-gray-800 leading-tight pb-1">{{ $category->title }}</h5>
                                @if (count($category->contentsOverview) > 0)
                                    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">Overview</h6>
                                @endif
                                @foreach ($category->contentsOverview as $content)
                                    <div>
                                        @if ($content->link_text !== null)
                                            <a class="fa-solid fa-book" title="Read" target="_BLANK" href="{{ $content->link_text }}"></a>
                                        @endif
                                        @if ($content->link_video !== null)
                                            <a class="fa-solid fa-video" title="Video" target="_BLANK" href="{{ $content->link_video }}"></a>
                                        @endif
                                        @if ($content->link_kaplan !== null)
                                            <a class="fa-solid fa-k" title="Kaplan" target="_BLANK" href="{{ $content->link_kaplan }}"></a>
                                        @endif
                                        <span class="pl-2">{{ $content->label }}</span>
                                        @switch($content->tracking)
                                            @case('CHECKBOX')
                                                <input class="float-right" type="checkbox" name="{{ $content->id }}" />
                                                @break
                                            @case('PERCENTAGE')
                                                <input class="float-right w-12 p-0 text-right" type="number" placeholder="00%" min="0" max="100" name="{{ $content->id }}" />
                                                @break
                                        @endswitch
                                    </div>
                                @endforeach
                                @if (count($category->contentsContent) > 0)
                                    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">Content</h6>
                                @endif
                                @foreach ($category->contentsContent as $content)
                                    <div>
                                        @if ($content->link_text !== null)
                                            <a class="fa-solid fa-book" title="Read" target="_BLANK" href="{{ $content->link_text }}"></a>
                                        @endif
                                        @if ($content->link_video !== null)
                                            <a class="fa-solid fa-video" title="Video" target="_BLANK" href="{{ $content->link_video }}"></a>
                                        @endif
                                        @if ($content->link_kaplan !== null)
                                            <a class="fa-solid fa-k" title="Kaplan" target="_BLANK" href="{{ $content->link_kaplan }}"></a>
                                        @endif
                                        <span class="pl-2">{{ $content->label }}</span>
                                        @switch($content->tracking)
                                            @case('CHECKBOX')
                                                <input class="float-right" type="checkbox" name="{{ $content->id }}" />
                                                @break
                                            @case('PERCENTAGE')
                                                <input class="float-right w-12 p-0 text-right" type="number" placeholder="00%" min="0" max="100" name="{{ $content->id }}" />
                                                @break
                                        @endswitch
                                    </div>
                                @endforeach
                                @if (count($category->contentsReview) > 0)
                                    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">Review</h6>
                                @endif
                                @foreach ($category->contentsReview as $content)
                                    <div>
                                        @if ($content->link_text !== null)
                                            <a class="fa-solid fa-book" title="Read" target="_BLANK" href="{{ $content->link_text }}"></a>
                                        @endif
                                        @if ($content->link_video !== null)
                                            <a class="fa-solid fa-video" title="Video" target="_BLANK" href="{{ $content->link_video }}"></a>
                                        @endif
                                        @if ($content->link_kaplan !== null)
                                            <a class="fa-solid fa-k" title="Kaplan" target="_BLANK" href="{{ $content->link_kaplan }}"></a>
                                        @endif
                                        <span class="pl-2">{{ $content->label }}</span>
                                        @switch($content->tracking)
                                            @case('CHECKBOX')
                                                <input class="float-right" type="checkbox" name="{{ $content->id }}" />
                                                @break
                                            @case('PERCENTAGE')
                                                <input class="float-right w-12 p-0 text-right" type="number" placeholder="00%" min="0" max="100" name="{{ $content->id }}" />
                                                @break
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('.fa-video').click(function (e) {
                if($(this).attr('href').includes('youtube')) {
                    var searchString = new URL($(this).attr('href')).search;
                    var searchParts = parseUrlParams(searchString);
                    if(searchParts['v']) {
                        e.preventDefault();
                        $('<div style="max-width:620px;"><iframe width="560" height="315" src="https://www.youtube.com/embed/' + searchParts['v'] + '" title="YouTube Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>').modal();
                    }
                }
            });
            $('.fa-k').click(function (e) {
                e.preventDefault();
                $('<div><b>Kaplan Reference:</b> ' + $(this).attr('href') + '<br />Kaplan is an optional paid resource.</div>').modal();
            });
        });
        function parseUrlParams(url) {
            var query = url.substr(1);
            var result = {};
            query.split("&").forEach(function(part) {
                var item = part.split("=");
                result[item[0]] = decodeURIComponent(item[1]);
            });
            return result;
        }
    </script>
</x-app-layout>
