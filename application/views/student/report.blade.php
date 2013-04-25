@layout('layouts.master')

@section('content')
    {{ render('inc.success') }}
    <div class="row-fluid">
        <div class="span12">
            <div class="span8"><h4>Graduation Application Report </h4>
                @if($student->status_id == 1)
                <div class="label label-info">{{ $student->status }}</div>
                @elseif($student->status_id == 2)
                   <div class="label label-success">{{ $student->status }}</div>
                @elseif($student->status_id == 3)
                    <div class="label label-important">{{ $student->status }}</div>
                @endif
            </div>
            <div class="span4 pull-right"><h5>{{ $student->id . ' | ' . $student->first_name . ' ' . $student->last_name}}</h5>
                <div class="label label-inverse">Updated: {{ Str::limit($student->updated_at, 10, '')  }}</div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row-fluid">
        <div class="span10">
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
    
@endsection