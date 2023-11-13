@if (count($content) > 0)
    <h6 class="text-center underline text-lg text-gray-800 leading-tight pb-1 pt-2">{{ $title }}</h6>
@endif
@foreach ($content as $contentItem)
    <div style="clear:both;" class="pt-1">
        @switch($contentItem->tracking)
            @case('CHECKBOX')
                <input class="float-right ml-1" type="checkbox" name="{{ $contentItem->id }}" />
                @break
            @case('PERCENTAGE')
                <input class="float-right w-12 p-0 ml-1 text-right" type="number" placeholder="0%" min="0" max="100" name="{{ $contentItem->id }}" />
                @break
        @endswitch
        @if ($contentItem->link_text)
            <a class="fa-solid fa-book" title="Read" target="_BLANK" href="{{ $contentItem->link_text }}"></a>
        @endif
        @if ($contentItem->ref_text)
            <a class="fa-solid fa-book read-ref" title="Read" rel="modal:open" href="#ref-text-{{ $contentItem->id }}"></a>
            <div class="hidden" id="ref-text-{{ $contentItem->id }}"><b>Reference:</b> {{ $contentItem->ref_text }}</div>
            @endif
        @if ($contentItem->link_video)
            <a class="fa-solid fa-video" title="Video" target="_BLANK" href="{{ $contentItem->link_video }}"></a>
        @endif
        @if ($contentItem->ref_kaplan)
            <a class="fa-solid fa-k" title="Kaplan" rel="modal:open" href="#ref-kaplan-{{ $contentItem->id }}"></a>
            <div class="hidden" id="ref-kaplan-{{ $contentItem->id }}"><b>Kaplan Reference:</b> {{ $contentItem->ref_kaplan }}<br />Kaplan is an optional paid resource.</div>
        @endif
        <span class="pl-2">{{ $contentItem->label }}</span>
        @if ($contentItem->tracking == 'TEXTAREA')
            <textarea class="border-1 w-full h-24"></textarea>
        @endif
    </div>
@endforeach
