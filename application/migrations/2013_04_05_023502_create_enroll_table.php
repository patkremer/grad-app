<?php

class Create_Enroll_Table {    

	public function up()
    {
		Schema::create('enroll', function($table) {
			$table->increments('id');
			$table->integer('crn_num');
			$table->integer('student_id');
			$table->string('class_grade');
			$table->integer('capp_id');
	});

    }    

	public function down()
    {
		Schema::drop('enroll');

    }

}