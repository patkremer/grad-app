@if($errors->has())
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>{{ $errors->first('student_id', ':message') }}</strong>
	</div>
	
@endif