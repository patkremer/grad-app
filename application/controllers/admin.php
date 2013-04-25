<?php

class Admin_Controller extends Base_Controller 
{
    // Display list of applicants
	public function get_index()
	{
		$students = Report::students();
		if ($students) {
			return View::make('admin.index')->with('students', $students);
		} else {
			return View::make('admin.index')->with('message', 'There are currently no applications to review.');
		}
		
	}
    
    // Get selected report and display it
	public function get_review($id) 
	{
		$report = Student::report($id);
		if ($report) {
			$classes 	= Student::enrolled($id);
			$statuses 	= Report::status($report->status_id);
			return View::make('admin.review')->with('student', $report)
			->with('classes', $classes)->with('statuses', $statuses);
		} else {
			return Redirect::to_route('admin')->with('error', 'The Student that you choose does not exist, please try again.');
		}	
	}

	// Update the status of a current report
	public function put_update() 
	{	
		$id = Input::get('id');
		$status = (int) Input::get('status');
		$report = Report::review($status, Input::get('notes'), $id);
		
		// Send email to student on update
		if ($report) {
			
			return Redirect::to_route('admin')->with('message', 'You have successfully updated the report status, an email notification has been sent to the student to inform them of the change.');
		} else {
			return Redirect::to_route('admin_review', $id)->with('error', 'You must update the status on the report before submitting.');
		}
	}
}