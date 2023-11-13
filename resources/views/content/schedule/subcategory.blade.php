@if (count($content) > 0)
    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1">{{ $title }}</h6>
@endif
@foreach ($content as $contentItem)
    <div>
        @if ($contentItem->link_text !== null)
            <a class="fa-solid fa-book" title="Read" target="_BLANK" href="{{ $contentItem->link_text }}"></a>
        @endif
        @if ($contentItem->link_video !== null)
            <a class="fa-solid fa-video" title="Video" target="_BLANK" href="{{ $contentItem->link_video }}"></a>
        @endif
        @if ($contentItem->link_kaplan !== null)
            <a class="fa-solid fa-k" title="Kaplan" target="_BLANK" href="{{ $contentItem->link_kaplan }}"></a>
        @endif
        <span class="pl-2">{{ $contentItem->label }}</span>
        @switch($contentItem->tracking)
            @case('CHECKBOX')
                <input class="float-right" type="checkbox" name="{{ $contentItem->id }}" />
                @break
            @case('PERCENTAGE')
                <input class="float-right w-12 p-0 text-right" type="number" placeholder="0%" min="0" max="100" name="{{ $contentItem->id }}" />
                @break
        @endswitch
    </div>
@endforeach
