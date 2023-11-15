<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="p-6 text-gray-900 text-center text-xl">Getting Started</h4>
            <div class="block lg:grid lg:grid-cols-2 lg:flex lg:flex-wrap">
                <div class="mb-1 lg:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>Thank you for choosing Karki MCAT Suite! We recommend watching the getting started video below for an introduction on how to best use Karki MCAT Suite.</p>
                        <p class="pt-2">For any questions please reach out to support@karkisuite.com.</p>
                    </div>
                </div>
                <div class="mb-1 overflow-hidden shadow-sm sm:rounded-lg mt-4 lg:mt-0">
                    <div class="flex flex-row justify-center items-center">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/X5Bl_Ds3DsM?si=FX7-phW7S0tp8Yuz&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <h4 class="p-6 text-gray-900 text-center text-xl">Content Schedule Completion</h4>
            <div class="block md:grid md:grid-cols-3 md:flex md:flex-wrap">
                @foreach($completion as $group => $groupCompletion)
                    <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <table class="text-left text-sm w-full">
                                <thead class="font-semibold text-lg">
                                <tr>
                                    <td>{{ $group }}</td>
                                    <td class="text-right">{{ $groupCompletion['all'] }}%</td>
                                </tr>
                                </thead>
                                @foreach($groupCompletion as $categoryTitle => $categoryCompletion)
                                    @if($categoryTitle !== 'all')
                                        <tr>
                                            <td>{{ $categoryTitle }}</td>
                                            <td class="text-right">{{ $categoryCompletion }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4 class="p-6 text-gray-900 text-center text-xl">Content Schedule Scores</h4>
            <div class="block md:grid md:grid-cols-5 md:flex md:flex-wrap">
                @foreach($scores as $group => $groupScores)
                    <div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <table class="text-left text-sm w-full">
                                <thead class="font-semibold text-lg">
                                <tr>
                                    <td>{{ $group }}</td>
                                    <td class="text-right">{{ $groupScores['all'] }}%</td>
                                </tr>
                                </thead>
                                @foreach($groupScores as $categoryTitle => $categoryScore)
                                    @if($categoryTitle !== 'all')
                                        <tr>
                                            <td>{{ $categoryTitle }}</td>
                                            <td class="text-right">{{ $categoryScore }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
