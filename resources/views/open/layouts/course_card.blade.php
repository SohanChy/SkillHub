<div class="mui-container mui-col-md-4">
    <div class="card-example mui--z1">

        @if(isset($img))
            <span class="title mui--text-light mui--text-headline">{{$imgCaption}}</span>
            <img src="{{$img}}">
        @endif

        <div class="label">

            <div class="mui--text-title">{{$course->title}}</div>
            <div>
                {{$course->small_description}}
            </div>
        </div>

        <div class="card-bottom-divider" style=""></div>

            <a href="#"
               class="mui-btn mui-btn--flat mui-btn--primary">Details</a>
            <a href="##" class="mui-btn mui-btn--flat mui-btn--primary">Lessons</a>
            <a href="##" class="mui-btn mui-btn--flat mui--text-title">{{mt_rand(2,4)}}.5<span class="mui--text-caption">/5</span> <span>★</span></a>


    </div>
</div>
