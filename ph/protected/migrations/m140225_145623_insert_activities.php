<?php

class m140225_145623_insert_activities extends EMongoMigration
{
	public function up()
	{
		$this->setCollectionName("activities");
		$this->insert(array
				(
					"list" => array("camping", "climbing", "fishing", "swimming")
				)
		);
	}

	public function down()
	{
		$this->setCollectionName("activities");
		$this->remove(array());
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