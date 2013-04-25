<?php

class Student extends Eloquent 
{
	public static $table = 'student';
	public static $timestamps = false;
	public static $rules = array(
		'id' => 'required|size:9|exists:student'
	);
	public static $messages = array(
		'required' => 'The Student ID field is required to submit an application',
		'size'	   => 'The Student ID field must be exactly :size digits',
		'exists'   => 'The Student ID given does not exists, please check your input.'		 
	);

	// Validate if student exists
	public static function validate($input) 
	{
		return Validator::make($input, static::$rules, static::$messages);
	}
    
    // Retrieve a report for a single student
	public static function report($id)
	{
		$student = DB::first('SELECT s.id AS id, 
							   	s.first_name AS first_name, 
							   	s.last_name AS last_name,
							   	s.email AS email,
							   	cap.catalog AS catalog,
							   	cap.degree AS degree,
							   	cap.major_1 AS major,
							   	cap.gpa AS gpa,
							   	cap.total_credits AS total_credits,
							   	report.report_term AS report_term,
							   	report.notes AS notes,
							   	report.updated_at AS updated_at,
							   	stat.id AS status_id,
							   	stat.status_type AS status   	
							FROM grad_app.student s
							LEFT JOIN grad_app.capp_report cap ON s.id = cap.student_id
							LEFT JOIN grad_app.app_report_status report ON s.id = report.student_id
							LEFT JOIN grad_app.status stat ON report.status_id = stat.id
							WHERE s.id = ?', array($id));
		return $student;
	}
    
    // Retrieve classes for a single student
	public static function enrolled($id)
	{
		$classes = DB::query('SELECT  e.course_id AS id,
								c.crn_num AS crn,
								c.course_name AS name,
								e.class_grade AS grade
							FROM grad_app.enrolls e
							INNER JOIN grad_app.course c ON e.course_id = c.id
							INNER JOIN grad_app.student s ON e.student_id = s.id
							WHERE e.student_id = ?', array($id));
		return $classes;
	}

}