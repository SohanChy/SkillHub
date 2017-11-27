@if($errors->any())
    <div class="mui-panel mui--text-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif