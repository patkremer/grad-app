<?php

class Create_Course_Table {    

	public function up()
    {
		Schema::create('course', function($table) {
			$table->increments('id');
			$tabke->text('crn_num','45');
			$table->text('course_name');
	});

    }    

	public function down()
    {
		Schema::drop('course');

    }

}