<?php

class m140528_101303_lists_table extends EMongoMigration
{
	public function up()
	{
		$this->createCollection('lists');
	}

	public function down()
	{
		$this->dropCollection('lists');
	}
}