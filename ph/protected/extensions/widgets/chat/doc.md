

declare collection.application
document where "key" : "devParams",

```
"rocketChat" : {
    "rocketchatEnabled" : false,
    "rocketchatURL" : "https://chat.communecter.org",
    "rocketAdmin" : "xxx",
    "rocketAdminPwd" : "xxx",
    "adminLoginToken" : "xxx",
    "adminRocketUserId" : "xxx"
}
```


déposez dans une page de lancement ex : mainSearch
```
<?php 
if( @Yii::app()->params["rocketchatEnabled"] )
    $this->widget( 'ext.widgets.chat.Chat' ,array("host"=>"kiki") );  
?> 
```

il faut etre loggué pour pouvoir ouvrir le panel de chat 
```
<?php if(@Yii::app()->session["userId"] && Yii::app()->params['rocketchatEnabled'] )
```

un btn pointant vers 
```
rcObj.loadChat("","citoyens", true, true)
```
