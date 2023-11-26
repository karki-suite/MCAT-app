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
                <select name="entry-section" class="w-24">
                    <option value="-1" disabled="disabled" selected="selected">Select...</option>
                    <option>CP</option>
                    <option>CARS</option>
                    <option>BB</option>
                    <option>PS</option>
                </select>
            </td>
            <td>
                <input name="entry-question" type="number" class="w-24" />
            </td>
            <td>
                <input name="entry-content-category" type="text" class="w-40" />
            </td>
            <td>
                <input name="entry-thought-process" type="text" class="w-80" />
            </td>
            <td>
                <input name="entry-corrected-thought-process" type="text" class="w-80" />
            </td>
            <td>
                <select name="entry-error-type" class="w-40">
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
            let addRow = () => {
                let $newRow = $('<tr>' + $('#placeholder-entry tr').html() + '</tr>');
                $('#test-table > tbody').append($newRow);
            };
            addRow();
            $('#add-row').click(function (e) {
                e.preventDefault();
                addRow();
            });
        });
    </script>
</x-app-layout>
