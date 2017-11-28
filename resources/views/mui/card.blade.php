<br>
<div class="mui-container">
    <div class="card-example mui--z1">

        @if(isset($img))
                <span class="title mui--text-light mui--text-headline">{{$imgCaption}}</span>
                <img src="{{$img}}">
        @endif

        <div class="label">

            <div class="mui--text-title">{{$title}}</div>
            <div>
                {{$text}}
            </div>
        </div>

        {{ $slot }}

           {{-- <a class="mui-btn mui-btn--flat mui-btn--accent">Share</a>
            <a class="mui-btn mui-btn--flat mui-btn--accent">Explore</a>--}}

    </div>
</div>
