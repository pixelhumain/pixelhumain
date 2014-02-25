<?php

class m140225_143902_create_activities_table extends EMongoMigration
{
	public function up()
	{
		$this->createCollection('activities');
	}

	public function down()
	{
		$this->dropCollection('activities');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}