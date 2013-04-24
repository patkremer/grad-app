<?php

class Create_Status_Table {    

	public function up()
    {
		Schema::create('status', function($table) {
			$table->increments('id');
			$table->string('status_type');
			$table->string('notes');
	});

    }    

	public function down()
    {
		Schema::drop('status');

    }

}