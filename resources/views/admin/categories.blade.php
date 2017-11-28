@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
  <div class="mui--appbar-height"></div>
  <div class="mui-container-fluid">
    <table class="mui-table">
      <thead>
        <tr>
          <th>Category name</th>
          <th>Parent</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>{{$category->name}}</td>
          <td>{{$category->parent}}</td>
          <td><a class="mui-btn" href="{{URL::to('admin/category/' . $category->id. '/edit')}}">Update</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>
</div>
</div>
@endsection