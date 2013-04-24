<?php

class Create_Cappreport_Table {    

	public function up()
    {
		Schema::create('capp_report', function($table) {
			$table->increments('id');
			$table->string('degree');
			$table->string('catalog');
			$table->string('major_1');
			$table->string('major_2');
			$table->integer('gpa');
			$table->integer('total_credits');
			$table->integer('student_id');
	});

    }    

	public function down()
    {
		Schema::drop('capp_report');

    }

}