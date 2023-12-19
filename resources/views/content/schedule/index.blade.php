<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Content Schedule') }}
        </h2>
    </x-slot>

    <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-1 text-lg text-center font-medium dark:text-white">Completion Status</div>
        <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="h-6 rounded-full text-center text-white font-semibold" style="width: {{ $completionPercent }}%;background-color: #003e79;">{{ $completionPercent }}%</div>
        </div>
    </div>

    <div class="py-6">
        @foreach ($groups as $group)
            <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $('.fa-video').click(function (e) {
                if ($(this).attr('href').includes('youtube')) {
                    let searchString = new URL($(this).attr('href')).search;
                    let searchParts = parseUrlParams(searchString);
                    if (searchParts['v']) {
                        e.preventDefault();
                        $('<div style="max-width:620px;"><iframe width="560" height="315" src="https://www.youtube.com/embed/' + searchParts['v'] + '" title="YouTube Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>').modal();
                    }
                }
            });

            function saveContentResponses() {
                let response = {};
                $('textarea,input').each(function () {
                    if($(this).attr('name').startsWith('content[')) {
                        let contentId = $(this).attr('name').split('[')[1].split(']')[0];
                        if($(this).attr('type') == 'checkbox') {
                            response[contentId] = $(this).is(':checked');
                        } else {
                            response[contentId] = $(this).val();
                        }
                    }
                });

                $.post('/schedule', {responses: response});
            }

            $('textarea,input').change(function () {
                saveContentResponses();
            });


            function loadContentResponses(contentResponses) {
                for (let contentId in contentResponses) {
                    let $targetEle = $('[name="content[' + contentId + ']"]');
                    if($targetEle.attr('type') == 'checkbox') {
                        $targetEle.prop('checked', (contentResponses[contentId] == "true"));
                    } else {
                        $targetEle.val(contentResponses[contentId]);
                    }
                }
            }

            let contentResponses = {!! $contentResponses !!};
            loadContentResponses(contentResponses);
            if($('input:checkbox:checked').length > 0) {
                $('input:checkbox:not(:checked):first').get(0).scrollIntoView({behavior: 'smooth'});
            }
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
