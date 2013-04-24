<?php

class Create_Application_Table {    

	public function up()
    {
		Schema::create('app_report_status', function($table) {
			$table->increments('id');
			$table->integer('student_id');
			$table->string('report_term');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('app_report_status');

    }

}