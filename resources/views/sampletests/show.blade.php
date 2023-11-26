<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Sample Test') . ': ' . $testName }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-auto">
            <div class="mb-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 min-w-max">
                <table class="w-full" id="test-table">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Question #</th>
                            <th>Content Category</th>
                            <th>My Thought Process</th>
                            <th>Corrected Thought Process</th>
                            <th>Error Type</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="text-right">
                    <a href="#" id="add-row" class="text-blue-800">Add Row</a>
                </div>
            </div>
        </div>
    </div>
    <table class="hidden" id="placeholder-entry">
        <tr>
            <td>
                <select name="section" class="w-24">
                    <option value="-1" disabled="disabled" selected="selected">Select...</option>
                    <option>CP</option>
                    <option>CARS</option>
                    <option>BB</option>
                    <option>PS</option>
                </select>
            </td>
            <td>
                <input name="question" type="number" class="w-24" />
            </td>
            <td>
                <select name="content-category" class="w-40">
                    <option value="-1" disabled="disabled" selected="selected">Select...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input name="thought-process" type="text" class="w-80" />
            </td>
            <td>
                <input name="corrected-thought-process" type="text" class="w-80" />
            </td>
            <td>
                <select name="error-type" class="w-40">
                    <option value="-1" disabled="disabled" selected="selected">Select...</option>
                    <option>Content</option>
                    <option>Reading</option>
                    <option>Data Interpretation</option>
                    <option>Math</option>
                    <option>Timing</option>
                    <option>Second Guessing</option>
                    <option>Equation</option>
                    <option>Dumb Mistake</option>
                </select>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const COLUMNS = ['section', 'question', 'content-category', 'thought-process', 'corrected-thought-process', 'error-type'];
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
                $('#test-table > tbody').append($newRow);
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
                $('#test-table > tbody > tr').each(function () {
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
                $.post('/sample-tests', {'test_id': '{{ $testId }}', 'sample_test': data});
            }

            $('#test-table').on('change', 'select,input', function () {
                saveData();
            });

            // On Ready...
            let testResponse = {!! $testResponse !!};
            if(testResponse.length == 0) {
                addRow();
            } else {
                for(let rowIdx in testResponse) {
                    addRow(testResponse[rowIdx]);
                }
            }
        });
    </script>
</x-app-layout>
