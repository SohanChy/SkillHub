@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
		
		@if($category->exists)
		<h2>Edit Category</h2>
		{!! Form::model($category, ['route' => ['admin.category.update', $category->id]]) !!}
		@else
		<h2>Create Category</h2>
		{!! Form::model($category, ['route' => ['admin.category.store']]) !!}
		@endif

		<div class="mui-panel">
			@component('mui.errors',
			['errors' => $errors])
			@endcomponent

			@component('mui.textfield',
			['name' => 'title'])
			@endcomponent

			<div class="mui-select">
				{!!
				Form::select('category_id',
				$categoriesList,
				null,
				['placeholder' => 'Pick a category...'])
				!!}
				<label>Course Category</label>
			</div>

			<div class="mui--text-right">
				<button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
			</div>
		</div>
	</div>
</div>
@endsection