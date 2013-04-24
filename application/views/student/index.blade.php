@layout('layouts.master')

@section('content')
	<div class="row-fluid">
		<div class="span12">
	    <h2>Apply for Graduation</h2>
	  	{{ render('inc.errors') }}
	  	<hr />
		    <div class="row-fluid">
			    <div class="span12">
				    {{ Form::open('/', 'POST', array('class' => 'form-inline')) }}
				    	<div class="control-group">
							{{ Form::label('term', 'Term', array('class' => 'control-label')) }}
							<div class="controls">
								<select name="term" id="term">
									<option value="Summer 2013">Summer 2013</option>
									<option value="Fall 2013">Fall 2013</option>
									<option value="Spring 2014">Spring 2014</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							{{ Form::label('student_id', 'Student ID', array('class' => 'control-label')) }}
							<div class="controls">
								{{ Form::text('student_id', Input::old('student_id')) }}
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								{{ Form::hidden('status', '1') }}
								{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
							</div>
						</div>
				    {{ Form::close()}}
				</div>
			</div>
		</div>
	</div>
@endsection