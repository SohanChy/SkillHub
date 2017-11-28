<div class="mui-textfield mui-textfield--float-label">
    <textarea id="{{ $name  }}" name="{{ $name  }}" type="{{$type or "text"}}"></textarea>
    <label for="{{ $name  }}">{{ $label or ucwords(str_replace("_", " ", $name)) }}</label>
</div>