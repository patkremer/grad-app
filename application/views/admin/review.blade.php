@layout('layouts.master')

@section('content')
	
	<div class="row-fluid">
		<div class="span8"><h4>Graduation Application Report</h4>
			<div class="label label-important">Status: {{ $student->status }}</div>
		</div>
		<div class="span4"><h5>{{ $student->id . ' | ' . $student->first_name . ' ' . $student->last_name}}</h5>
			<div class="label label-info">Updated: {{ $student->updated_at }}</div>
		</div>
	</div>
    <hr />
    <div class="row-fluid">
    	<div class="span8">
    		<h4><i>Program Summary</i></h4>
    		<div class="row-fluid">
    			<div class="span4"><b>Graduation Term: </b></div>
    			<div class="span4">{{ $student->report_term }}</div> 
    		</div>
    		<div class="row-fluid">
    			<div class="span4"><b>Catalog Term: </b></div>
    			<div class="span4">{{ $student->catalog }}</div> 
    		</div>
    		<div class="row-fluid">
    			<div class="span4"><b>Degree: </b></div>
    			<div class="span4">{{ $student->degree }}</div> 
    		</div>
    		<div class="row-fluid">
    			<div class="span4"><b>Major: </b></div>
    			<div class="span4">{{ $student->major }}</div> 
    		</div>
    		<div class="row-fluid">
    			<div class="span4"><b>GPA: </b></div>
    			<div class="span4">{{ $student->gpa }}</div> 
    		</div>
    		<div class="row-fluid">
    			<div class="span4"><b>Total Credit Hours: </b></div>
    			<div class="span4">{{ $student->total_credits }}</div> 
    		</div>
    	</div>
    </div>
    <hr />

    <div class="row-fluid">
    	<div class="span12">
    		<h4><i>Courses</i></h4>
 			<div class="row-fluid">
 				<div class="span12">
	 				<table class="table table-condensed table-striped table-hover">
		  				<thead>
	      					<tr>
					          	<th>Class Name</th>
					          	<th>CRN</th>
					          	<th>Grade</th>
	      					</tr>
	 					</thead>   
	  					<tbody>
	  			@foreach($classes as $class)
						    <tr>
						        <td>{{ $class->name }}</td>
						        <td>{{ $class->crn }}</td>
						        <td>{{ $class->grade }}</td>
						    </tr>
				@endforeach	
						</tbody>
					</table>
				</div>
 			</div>
    		
    	</div>    	
    </div>

    <div class="row-fluid">
    	<div class="span12">
		    {{ Form::open('admin/reports/update', 'PUT') }}
				<div class="control-group">
					{{ Form::label('notes', 'Notes', array('class' => 'control-label'))}}
					<div class="controls">
						{{ Form::textarea('notes', $student->notes) }}
					</div>
				</div>
				<div class="control-group">
					{{ Form::label('status', 'Review Status', array('class' => 'control-label'))}}
					<div class="controls">
						<select name="status" id="status">
							<option value="{{ $student->status_id }}"> {{ $student->status }}</option>

							@foreach($statuses as $status)	
						
							<option value="{{ $status->status_id }}"> {{ $status->status  }} </option>  
						    
							@endforeach
						</select>
					</div>
				</div>
				{{ Form::hidden('id', $student->id) }}
				{{ Form::submit('Submit Status Update', array('class' => 'btn btn-primary'))}}
				{{ HTML::link_to_route('admin', 'Cancel', '', array('class' => 'btn')) }}
		    {{ Form::close() }}
	    </div>
    </div>
@endsection

@section('scripts')
<script>
	$('#notes').width('80%'); 
</script>

@endsection