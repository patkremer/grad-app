<?php

class Create_Student_Table {    

	public function up()
    {
		Schema::create('student', function($table) {
			$table->increments('id');
			$table->integer('num');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('password');
			$table->string('email');
	});

    }    

	public function down()
    {
		Schema::drop('student');

    }

}