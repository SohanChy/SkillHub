@extends('open.layouts.base')

@section('content')



<div class="mui-container-fluid" style="margin: 0 15%">
	
	<div class="mui-row">
		<h1>Checkout!</h1>
	</div>
	<div class="mui-row">
		<div class="mui-col-md-8 nopadding">
			<form class="mui-form" action="/courses/enroll" method="post">
				{{ csrf_field() }}

				<div class="mui-textfield">
					<input type="text" placeholder="BKash number" name="bkash_token">
				</div>
				<input type="text" hidden="true" value="{{$id}}" name="id">

				<button type="submit" class="mui-btn mui-btn--raised">Submit</button>
			</form>
		</div>
	</div>
	<div class="mui-row">
	</div>
	<br />


</div>




@endsection()