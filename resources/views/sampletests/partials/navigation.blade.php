<div class="bg-orange-100">
    <div class="py-2 px-6 mx-auto lg:px-8 max-w-7xl lg:grid lg:grid-cols-6 text-center lg:text-left">
        @foreach($tests as $testId => $testLabel)
            <div><a href="{{ route('sampletests.show', ['id' => $testId]) }}" class="text-blue-800 {{ (isset($current) && $testId == $current) ? 'font-bold' : '' }}">{{ $testLabel }}</a></div>
        @endforeach
    </div>
</div>
