<?php 
class CookieHelper  {
    
      public static function hasCookie($name)
      {
        return !empty(Yii::app()->request->cookies[$name]->value);
      }
    
      public static function getCookie($name)
      {
        return Yii::app()->request->cookies[$name]->value;
      }
    
      public static function setCookie($name, $value)
      {
        $cookie = new CHttpCookie($name,$value);
        $cookie->expire = time()+60*60*24*180;
        Yii::app()->request->cookies[$name] = $cookie;
      }
    
      public static function removeCookie($name)
      {
        unset(Yii::app()->request->cookies[$name]);
      }
}
?>