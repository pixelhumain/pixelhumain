<?php

class m140528_101623_insert_lists extends EMongoMigration
{
	public function up()
	{
		try {
			$file_name = "C:/Users/DEVPH/git/pixelhumain/ph/data/lists.json";
			$this->setCollectionName("lists");

			$handle = fopen($file_name, "r");
			$line_number = 0;

			if ($handle) {
			    while (($line = fgets($handle)) !== false) {
			        $line_number++;
			        printf("vla la ligne #".$line_number." : ".$line);
			        $json_a = json_decode($line,true);
			        if (count($json_a) == 0) {
						throw new Exception("Et ho c'est pas du bon format json ton fichier !");
					} else {
						$this->insert($json_a);
					}
			    }
			} else {
				throw new Exception("Pooom ! Impossible d'ouvrir le fichier : ".$file_name);
			} 
		} 
		finally {
			fclose($handle);
		}
	}

	public function down()
	{
		$this->setCollectionName("lists");
		$this->remove();
	}
}