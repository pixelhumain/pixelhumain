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

  /**
   * Retrieve a lists of list by name
   * @param array $listNames List of 
   * @return array List of list
   */
  public static function get($listNames){
    $lists = PHDB::find ( self::COLLECTION , array( "name" => array('$in' => $listNames) ),array("name","list") );
    $res = array();
    foreach ($lists as $key => $value) {
        $res[ $value["name"] ] = $value["list"] ;    
    }
    return $res;
  }

  /**
   * Retieve a list by name and return values 
   * @param String $name of the list
   * @return array of list value
   */
  public static function getListByName($name){
    $res = array();
    //The tags are found in the list collection, key tags
    $list = PHDB::findOne( DataList::COLLECTION,array("name"=>$name), array('list'));

    if (!empty($list['list']))
      $res = $list['list'];
    else 
      throw new CTKException("Impossible to find the list name ".$name);

    return $res;
    }
}
