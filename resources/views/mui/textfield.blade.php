<div class="mui-textfield mui-textfield--float-label">
    <input id="{{ $name  }}" name="{{ $name  }}" type="{{$type or "text"}}">
    <label for="{{ $name  }}">{{ $label or ucwords(str_replace("_", " ", $name)) }}</label>
</div>