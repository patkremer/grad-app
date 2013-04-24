<?php

class Student_Controller extends Base_Controller 
{
	public function get_index()
	{
		return View::make('student.index');
	}

	public function post_create() 
	{
		// Validate student exists in student table
		// Validate if user exists in report table		
		$student_id = Input::get('student_id');
		$term = Input::get('term');
		$status = Input::get('status');

		$validate_student =  Student::validate(array('id' => $student_id));

		if ($validate_student->passes()) {
			
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
				if ($new_report) return Redirect::to_route('report', $student_id)
					->with('message', 'Your application was successfully submitted and is waiting to be reviewed');
			} else {
				return Redirect::to_route('report', $student_id)->with_errors($validate_report);
			}

		} else {
			return Redirect::to_route('/')->with_errors($validate_student)->with_input();
		}
		

		// if ($new_report) {
		// 	return Redirect::to_route('report', $new_report->student_id);
		// }

	}

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