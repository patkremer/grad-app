<?php

class Report extends Eloquent 
{
	public static $table = 'app_report_status';
	public static $rules = array(
			'report_term' 	=> 'required',
			'student_id' 	=> 'required|unique:app_report_status',
			'status_id'		=> 'required'
	);

	public static $messages = array(
			'unique' 		  => 'An application has already been submit, your report is below.',
			'term_required'   => 'A term needs to be selected',
			'status_required' => 'A status is needed to create an application' 
	);

	public static function validate($input) 
	{
		return Validator::make($input, static::$rules, static::$messages);
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
							FROM kremerp2_grad_app.student s
							LEFT JOIN kremerp2_grad_app.capp_report cap ON s.id = cap.student_id
							LEFT JOIN kremerp2_grad_app.app_report_status report ON s.id = report.student_id
							LEFT JOIN kremerp2_grad_app.status stat ON report.status_id = stat.id
							WHERE report.report_term IS NOT NULL');
		return $students;
	}

	public static function status($data)
	{
		$status = DB::query('SELECT s.id AS status_id,
									s.status_type AS status
								FROM kremerp2_grad_app.status s
								WHERE s.id != 0 
								AND s.id != ?', array($data));
		return $status;
	}	

	public static function review($status, $notes, $student_id)
	{
		$report	= DB::query('UPDATE kremerp2_grad_app.app_report_status 
							 SET status_id = ?, notes = ? 
						     WHERE student_id = ?', array($status, $notes, $student_id));

		$url = HTML::link_to_route('report', 'Final Graduation Application Report', array($student_id));

		if ($status == 2 || $status == '2') {
			// Send email student has been accepted
			Report::email($student_id, 'Your graduation request has been reviewed and accepted, congratulations! <br/><br/>Graduation will be in August. To view your any notes an administrator may have left please view your final report. <br/><br/> ' . $url);
		} elseif ($status == 3 || $status == '3') {
			// Send email student has been rejected 
			Report::email($student_id, 'Unfortunately, your graduation request has been rejected because you have not met all the standards. <br/><br/>To find out what you need to do the meet the requirements check see what the reviewer noted in your final report or contact the registrars office. <br/><br/>' . $url);
		}
		return $report;
	}

	public static function email($id, $body) 
	{
		$student = DB::first('SELECT s.email, s.first_name, s.last_name
							FROM kremerp2_grad_app.student s
							WHERE s.id = ?', array($id));

		Message::to('grad@patrickkremer.me')
		->from('kremerp2@gmail.com')
		->subject('Graduation Application Status')
		->body('Hello ' . $student->first_name .' '.$student->last_name .', <br/><br/>'. $body)
		->html(true)
		->send();	

	}
		
}