<div class="mui-select">
    @php
    if(!isset($label))
        $label = ucwords(str_replace(["_id","_"], " ", $name));
    @endphp
    {!!
    Form::select($name,
    $list,
    null,
    ['placeholder' => "Pick a {$label}..."])
    !!}
    <label>{{$label}}</label>
</div>