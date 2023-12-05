<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('CARS') }}
        </h2>
    </x-slot>
    @include('content/cars/partials/navigation')
    <div class="py-6 mx-auto hidden lg:block max-w-7xl max-h-96" id="chart-container"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-auto">
            <div class="mb-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 min-w-max">
                <table class="mx-auto" id="aamc-table">
                    <thead>
                    <tr>
                        <th>Passage</th>
                        <th>Score</th>
                        <th>Time Taken</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="text-center">
                    <a href="#" id="add-row" class="text-blue-800">Add Row</a>
                </div>
            </div>
        </div>
    </div>
    <table class="hidden" id="placeholder-entry">
        <tr>
            <td>
                <input name="passage" type="text" class="w-60 p-0" />
            </td>
            <td>
                <input class="w-12 p-0 text-right" type="number" placeholder="0%" min="0" max="100" name="score" />
            </td>
            <td>
                <input class="w-20 p-0 text-right" type="number" placeholder="0 mins" min="0" max="30" name="time" />
            </td>
        </tr>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const COLUMNS = ['passage', 'score', 'time'];
            /**
             * Add a row to table/form...
             * @param data
             */
            let addRow = (data = null) => {
                let $newRow = $('<tr>' + $('#placeholder-entry tr').html() + '</tr>');
                if(data !== null) {
                    for(let columnKey in COLUMNS) {
                        let column = COLUMNS[columnKey];
                        if(data[column]) {
                            $newRow.find('[name="' + column + '"]').val(data[column]);
                        }
                    }
                }
                $('#aamc-table > tbody').append($newRow);
            };

            /**
             * Add row on click...
             */
            $('#add-row').click(function (e) {
                e.preventDefault();
                addRow();
            });

            /**
             * Serialize data from table/form.
             * @returns [{}]
             */
            let serializeTestData = () => {
                let data = [];
                $('#aamc-table > tbody > tr').each(function () {
                    let dataRow = {};
                    $(this).find('input,select').each(function () {
                        dataRow[$(this).attr('name')] = $(this).val();
                    });
                    data.push(dataRow);
                });
                return data;
            }

            let saveData = () => {
                let data = serializeTestData();
                $.post('/cars/aamc', {aamc_responses: data});
            }

            $('#aamc-table').on('change', 'select,input', function () {
                saveData();
                updateChart();
            });

            function getChartData(type) {
                let aamcData = serializeTestData();
                let graphData = [];
                for(let idx in aamcData) {
                    graphData.push({
                        x: aamcData[idx]['passage'],
                        y: aamcData[idx][type]
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
                        datasets: [
                            {
                                label: 'Score',
                                data: getChartData('score'),
                                backgroundColor: '#003e79',
                                borderColor: '#003e79'
                            },
                            {
                                label: 'Time Taken',
                                data: getChartData('time'),
                                backgroundColor: '#F28500',
                                borderColor: '#F28500'
                            }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                ticks: {
                                    display: false
                                }
                            }
                        },
                        maintainAspectRatio: false
                    }
                });
            }



            // On Ready...
            let aamcResponse = {!! $aamcResponses !!};
            if(aamcResponse.length == 0) {
                addRow();
            } else {
                for(let rowIdx in aamcResponse) {
                    addRow(aamcResponse[rowIdx]);
                }
                updateChart();
            }
        });
    </script>
</x-app-layout>
