<?php
use WHMCS\Database\Capsule as DB;

class Table{
	
	public static function create()
        {
             if (!DB::schema()->hasTable('customtable'))
            {
                DB::schema()->create('customtable',
                function ($table) 
                {
                $table->increments('id');
                $table->integer('serviceid');
                $table->text('var1');
                $table->text('var2');
                $table->text('var3');
                $table->text('var4');
		}
            );
            }
	}
}