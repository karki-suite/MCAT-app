<input class="float-right ml-1" type="checkbox" name="content[{{ $key }}]" />
@if(isset($link))
    <a href="{{ $link }}" class="text-blue-800" target="_blank">{{ $text }}</a>
@else
    {{ $text }}
@endif
