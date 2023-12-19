<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Application Schedule') }}
        </h2>
    </x-slot>
    <div class="py-6 mx-auto hidden lg:block max-w-7xl max-h-96" id="chart-container"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            let updateScoreContainer = ($ele) => {
                let scoreSum = 0;
                let validScore = true;
                $ele.find('.score-input').each(function () {
                    if($(this).val() == '') {
                        validScore = false;
                    }
                    scoreSum = scoreSum + parseInt($(this).val());
                });
                if(validScore) {
                    $ele.find('.score-summary').text(scoreSum);
                } else {
                    $ele.find('.score-summary').text('-');
                }

                let newScores = [];
                $('.score-summary').each(function() {
                    if($(this).text() !== '-') {
                        newScores.push({
                            x: $(this).parent().parent().parent().parent().parent().children('h3').text(),
                            y: $(this).text()
                        });
                    }
                });
                updateChart(newScores);
            };

            $('.score-input').change(function () {
                updateScoreContainer($(this).parent().parent());
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
                $('.score-summary').each(function () {
                    updateScoreContainer($(this).parent().parent());
                });
            }

            let data = {!! $responses !!};
            loadData(data);


            function updateChart(scores) {
                $('#chart-container').html('<canvas id="chart" class="w-full h-auto"></canvas>');
                const ctx = document.getElementById('chart');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        datasets: [
                            {
                                label: 'Scores',
                                data: scores,
                                backgroundColor: '#003e79',
                                borderColor: '#003e79'
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                min: 472,
                                max: 528
                            },
                            x: {
                                ticks: {
                                    display: true
                                }
                            }
                        },
                        maintainAspectRatio: false
                    }
                });
            }

        });
    </script>
</x-app-layout>
