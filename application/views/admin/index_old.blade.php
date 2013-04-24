@layout('layouts.master')

@section('content')

    <h2>Admin Index</h2>
    <table class="table table-condensed table-striped table-hover">
	  	<thead>
      		<tr>
	          	<th>First Name</th>
	          	<th>Last Name</th>
	          	<th>Email</th>
	         	<th>Degree</th> 
	         	<th>Major</th>
	         	<th>Date Modified</th>  
	         	<th>Application Status</th>
      		</tr>
 		</thead>   
  		<tbody>
  		@foreach($students as $student)
		    <tr>
		        <td>{{ $student->first_name }}</td>
		        <td>{{ $student->last_name }}</td>
		        <td>{{ $student->email }}</td>
		        <td>{{ $student->degree }}</td>
		        <td>{{ $student->major }}</td>
		        <td>{{ Str::limit($student->updated_at, 10, '')  }}</td>
		        <td><span class="label label-warning">{{ $student->status }}</span></td>
		        <td>{{ HTML::link_to_route('admin_review','Review', $student->id, array('class' => 'btn btn-primary')) }}</td>                                       
		    </tr>
		@endforeach	
		</tbody>
	</table>
   	
@endsection