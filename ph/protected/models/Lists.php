<?php
class Lists {
  const COLLECTION = "lists";
	/**
   * checks the existence of an entry in a list collection 
   * if doesn't exist create it 
   * else do nothing 
   * @return [json Map] list
   */
  public static function newEntry($listName, $entryKey, $extra = array())
  {
    //check if usage exist otherwise create it 
    $slug = InflectorHelper::slugify( $entryKey );
    $exist = PHDB::findOne( self::COLLECTION, array( "name" => $listName, "list.".$slug => array('$exists'=>1)) );
    
    if(!$exist) 
    {
      $params = array_merge( array( "name"=>$entryKey ) , $extra);
      PHDB::update( self::COLLECTION, 
                    array("name" => $listName), 
                    array('$set' => array( "list.".$slug => $params ) ) );
    }
  }

  public static function get($listNames){
    $lists = PHDB::find ( self::COLLECTION , array( "name" => array('$in' => $listNames) ),array("name","list") );
    $res = array();
    foreach ($lists as $key => $value) {
        $res[ $value["name"] ] = $value["list"] ;    
    }
    return $res;
  }

}
