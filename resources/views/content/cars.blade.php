<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('CARS') }}
        </h2>
    </x-slot>
    <div class="py-6 mx-auto hidden lg:block max-w-7xl max-h-96" id="chart-container"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="p-6 text-gray-900 text-center text-xl">Jack Westin</h4>
            <div class="block md:grid md:grid-cols-2 md:flex md:flex-wrap md:text-left">

                @foreach($jackWestin as $jackWestinColumn)
                    <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-left">
                            <table class="mx-auto">
                                <thead>
                                <tr>
                                    <th>Passage</th>
                                    <th>Score</th>
                                    <th>Time Taken</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($jackWestinColumn as $carsEntry)
                                    <tr>
                                        <td class="w-60 pr-2">
                                            <a href="{{ $carsEntry['link'] }}" target="_BLANK" class="text-blue-800">{{ $carsEntry['label'] }}</a>
                                        </td>
                                        <td class="pr-2">
                                            <input class="w-12 p-0 text-right" type="number" placeholder="0%" min="0" max="100" name="cars[score][{{ $carsEntry['id'] }}]" />
                                        </td>
                                        <td>
                                            <input class="w-20 p-0 text-right" type="number" placeholder="0 mins" min="0" max="300" name="cars[time][{{ $carsEntry['id'] }}]" />
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            const responseTypes = ['score', 'time'];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            function saveCarsResponses() {
                let response = {};
                for(let responseTypeIdx in responseTypes) {
                    response[responseTypes[responseTypeIdx]] = {};
                }
                $('input').each(function () {
                    for(let responseTypeIdx in responseTypes) {
                        let responseType = responseTypes[responseTypeIdx];
                        if($(this).attr('name').startsWith('cars[' + responseType + '][')) {
                            let contentId = $(this).attr('name').split('cars[' + responseType + '][')[1].split(']')[0];
                            response[responseType][contentId] = $(this).val();
                        }
                    }
                });

                $.post('/cars', {cars_responses: response});
            }

            $('input').change(function () {
                updateChart();
                saveCarsResponses();
            });

            function loadCarsResponses(carsResponses) {
                for(let responseTypeIdx in responseTypes) {
                    let responseType = responseTypes[responseTypeIdx];
                    for (let contentId in carsResponses[responseType]) {
                        $('[name="cars[' + responseType + '][' + contentId + ']"]').val(carsResponses[responseType][contentId]);
                    }
                }
                updateChart();
            }

            function getChartData() {
                const graphFields = {!! $jackWestinGraph !!};
                let graphData = [];
                for(let fieldIdx in graphFields) {
                    let field = graphFields[fieldIdx];
                    graphData.push({
                        x: field['label'],
                        y: $('[name="cars[score][' + field['id'] + ']"]').val()
                    })
                }
                return graphData;
            }

            function updateChart() {
                $('#chart-container').html('<canvas id="chart" class="w-full h-auto"></canvas>');
                const ctx = document.getElementById('chart');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Scores',
                            data: getChartData()
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        maintainAspectRatio: false
                    }
                });
            }

            let carsResponses = {!! $carsResponses !!};
            loadCarsResponses(carsResponses);
        });
    </script>
</x-app-layout>
