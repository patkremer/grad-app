@layout('layouts.master')

@section('content')
	<div class="row-fluid">
		<div class="span12">
			<h2>Graduation Applicants</h2>
			<hr />
			<div class="row-fluid">
			 	<div class="span12">
				    <table class="table table-condensed table-striped table-hover">
					  	<thead>
				      		<tr>
				      			<th>ID</th>
					          	<th>Name</th>
					          	<th>Email</th>
					         	<th>Major</th>
					         	<th>Modified</th>  
					         	<th>Status</th>
				      		</tr>
				 		</thead>   
				  		<tbody>
				  		@foreach($students as $student)
						    <tr>
						        <td>{{ $student->id }}</td>
						        <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
						        <td>{{ $student->email }}</td>
						        <td>{{ $student->major }}</td>
						        <td>{{ Str::limit($student->updated_at, 10, '') }}</td>
						        <td><span class="label label-warning">{{ $student->status }}</span></td>
						        <td>{{ HTML::link_to_route('admin_review','Review', $student->id, array('class' => 'btn btn-primary')) }}</td>                                       
						    </tr>
						@endforeach	
						</tbody>
					</table>
			 	</div>
			</div>
		</div>
	</div>
   
   	
@endsection