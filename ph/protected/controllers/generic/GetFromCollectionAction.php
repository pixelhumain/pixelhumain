<?php
/*
- get an element from any collection 
- TODO : secure access to some collections
 */
class GetFromCollectionAction extends CAction
{
    public function run()
    {
        $element = Yii::app()->mongodb->selectCollection($_POST['collection'])->findOne( array("_id" => new MongoId( $_POST['id'] ) ),$_POST['fields']);
        Rest::json( $element );
        Yii::app()->end();
    }
}