<?php

class Student_Controller extends Base_Controller 
{
    // Displays application form
	public function get_index()
	{
		return View::make('student.index');
	}
    
    // Create a new application and displays it for the user or Redirects
	public function post_create() 
	{
		$student_id = Input::get('student_id');
		$term = Input::get('term');
		$status = Input::get('status');
        
        // Validate student exists in student table
		$validate_student =  Student::validate(array('id' => $student_id));

		if ($validate_student->passes()) {
			// Validate if user exists in report table
			$validate_report = Report::validate(array(
				'student_id'  => $student_id,
				'report_term' => $term,
				'status_id'   => $status
			));

			if ($validate_report->passes()) {
				$new_report = Report::create(array(
					'student_id'  => $student_id,
					'report_term' => $term,
					'status_id'   => $status
				));
				if ($new_report) {
					$url = HTML::link_to_route('report', 'Graduation Application Report', array($student_id));
					Report::email($student_id, 'Your application was successfully submitted and is waiting to be reviewed. A link has been provided below for you to view the report at anytime. <br/><br/>' . $url);
					return Redirect::to_route('report', $student_id)
					->with('message', 'Your application was successfully submitted and is waiting to be reviewed.');
				}
			} else {
				return Redirect::to_route('report', $student_id)->with_errors($validate_report);
			}

		} else {
			return Redirect::to_route('/')->with_errors($validate_student)->with_input();
		}
	
	}
    // Display a application report for a student
	public function get_report($id)
	{
		$report = Student::report($id);
		if (!$report->status) return Redirect::to_route('/')
			->with('error', 'You must submitted an application before you can review a report');

		$classes = Student::enrolled($id);
		return View::make('student.report')
			->with('student', $report)
			->with('classes', $classes);
	}
}