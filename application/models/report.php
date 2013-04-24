<?php

class Report extends Eloquent 
{
	public static $table = 'app_report_status';
	public static $rules = array(
			'report_term' 	=> 'required',
			'student_id' 	=> 'required|unique:app_report_status',
			'status_id'		=> 'required'
	);

	public static function validate($input) 
	{
		$messages = array(
			'unique' 		  => 'An application has already been submit, your report is below.',
			'term_required'   => 'A term needs to be selected',
			'status_required' => 'A status is needed to create an application' 
		);
		return Validator::make($input, static::$rules, $messages);
	}

	public static function students() 
	{
		$students = DB::query('SELECT s.id AS id, 
							   	s.first_name AS first_name, 
							   	s.last_name AS last_name,
							   	s.email AS email,
							   	cap.degree AS degree,
							   	cap.major_1 AS major,
							   	cap.gpa AS gpa,
							   	cap.total_credits AS total_credits,
							   	report.report_term AS report_term,
							   	stat.status_type AS status,
							   	report.updated_at AS updated_at
							FROM grad_app.student s
							LEFT JOIN grad_app.capp_report cap ON s.id = cap.student_id
							LEFT JOIN grad_app.app_report_status report ON s.id = report.student_id
							LEFT JOIN grad_app.status stat ON report.status_id = stat.id
							WHERE report.report_term IS NOT NULL');
		return $students;
	}

	public static function status($data)
	{
		$status = DB::query('SELECT s.id AS status_id,
									s.status_type AS status
								FROM grad_app.status s
								WHERE s.id != 0 
								AND s.id != ?', array($data));
		return $status;
	}	

	public static function review($status, $notes, $student_id)
	{
		$report	= DB::query('UPDATE grad_app.app_report_status 
							 SET status_id = ?, notes = ? 
						     WHERE student_id = ?', array($status, $notes, $student_id));
		return $report;
	}

		
}