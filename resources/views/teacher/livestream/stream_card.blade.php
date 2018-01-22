@component('mui.card',
['title' => $stream->title,'text'=>$stream->description])

<a href="{{route('teacher.live-streams.edit', $stream->id)}}" class="mui-btn mui-btn--flat mui-btn--accent">Edit</a>

<a href="{{ route('teacher.live-streams.show', $stream->id) }}" class="mui-btn mui-btn--flat mui-btn--accent">Stream Now!</a>

<button class="mui-btn">{{$stream->timeUntilString()}}</button>


@endcomponent