<input class="float-right w-12 p-0 ml-1 text-right" type="number" placeholder="0%" min="0" max="100" name="content[]" />
@if(isset($link))
    <a href="{{ $link }}" class="text-blue-800" target="_blank">{{ $text }}</a>
@else
    {{ $text }}
@endif
