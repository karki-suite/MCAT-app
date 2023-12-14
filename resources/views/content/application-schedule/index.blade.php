<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Application Schedule') }}
        </h2>
    </x-slot>
    <div class="py-6">
        @foreach($content as $contentCategories)
            <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($contentCategories['ready'])
                    @foreach($contentCategories['sections'] as $contentSection)
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight pb-1">{{ $contentSection['title'] }}</h3>
                        <div class="block md:grid md:grid-cols-3 md:flex md:flex-wrap md:text-left mb-2">
                            @foreach($contentSection['cards'] as $contentCard)
                                <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <h5 class="font-semibold text-center text-lg text-gray-800 leading-tight pb-1">{{ $contentCard['title'] ?? '' }}</h5>
                                        @if(isset($contentCard['content']))
                                            @foreach($contentCard['content'] as $content)
                                                @if(isset($content['renderer']))
                                                    <div style="clear:both;" class="pt-1">
                                                        @include('content.application-schedule.content.' . $content['renderer'], $content)
                                                    </div>
                                                @else
                                                    <p><pre>{{ print_r($content, true) }}</pre></p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight pb-1">{{ $contentCategories['sections'][0]['title'] }}</h3>
                    <p>This section will become available once you complete the relevant Sample Test.</p>
                @endif
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

            let serializeData = () => {
                let data = {};
                $(document).find('main input').each(function () {
                    let name = $(this).attr('name').match(/\[([^)]+)\]/)[1];

                    if($(this).attr('type') == 'checkbox') {
                        data[name] = $(this).is(':checked');
                    } else {
                        data[name] = $(this).val();
                    }
                });

                return data;
            }

            let saveData = () => {
                let data = serializeData();
                console.log(data);
                $.post('/schedule/application', {'responses': data});
            }

            $('main input').on('change', function () {
                saveData();
            });

            let loadData = (data) => {
                for(let key in data) {

                    if($(document).find('[name="content[' + key + ']"]').attr('type') === 'checkbox') {
                        $(document).find('[name="content[' + key + ']"]').prop('checked', data[key] === "true");
                    } else {
                        $(document).find('[name="content[' + key + ']"]').val(data[key]);
                    }
                }
            }

            let data = {!! $responses !!};
            loadData(data);
        });
    </script>
</x-app-layout>
