@props(['item'=>null, 'size'=>70, 'float'=>''])
<img src="{{ $item->image ? Storage::url('public/'.$item->image->url) : asset('img/no-image.png') }}"  class="rounded  {{$float}}" width="{{$size}}">
