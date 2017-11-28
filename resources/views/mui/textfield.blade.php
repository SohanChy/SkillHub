<div class="mui-textfield mui-textfield--float-label">
	@if(!isset($type))
	{!! Form::text($name,null,['id' => $name]) !!}
	@elseif($type == "textarea")
	@php if(!isset($size)) $size = '30x5'; @endphp
	{!! Form::textarea($name,null,['id' => $name, 'size' => $size ]) !!}
	@elseif($type == "password")
	{!! Form::password($name,null,['id' => $name]) !!}
	@elseif($type == "email")
	{!! Form::email($name,null,['id' => $name]) !!}
	@else
	{!! Form::text($name,null,['id' => $name]) !!}
	@endif

	<label for="{{ $name  }}">{{ $label or ucwords(str_replace("_", " ", $name)) }}</label>
</div>