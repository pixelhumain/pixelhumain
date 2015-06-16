<!-- start: LEFT NAVIGATION MENU -->

<nav class="left-navbar">
  <div class="navbar-content">
    <div class="navbar-content-inner">

      <ul class="navbar-menu"> 
        <li class="mainModuleMenu">
            <a href="#">
              <i class="fa fa-bars"></i>

              <span class="inner">
                <i class="fa fa-caret-down"></i>
                <span>Menu</span>
              </span>
            </a>
          </li> 
        <?php 
			$menuLeft = array(
              array('label' => "MY ACCOUNT", "key"=>"myAccount","iconClass"=>"fa fa-home","href"=> Yii::app()->createUrl($this->module->id."/person/dashboard")),
              array('label' => "MY CITY", "key"=>"myCityPage","iconClass"=>"fa fa-university","href"=> Yii::app()->createUrl($this->module->id."/city/index/insee/97400")),
              array('label' => "MY CALENDAR", "key"=>"myCalendarPage","iconClass"=>"fa fa-calendar","href"=> Yii::app()->createUrl($this->module->id."/person/calendar")),
              array('label' => "MY DIRECTORY", "key"=>"myDirectoryPage","iconClass"=>"fa fa-globe","href"=> Yii::app()->createUrl($this->module->id."/person/directory")),
              array('label' => "MY NEWS", "key"=>"myNewsPage","iconClass"=>"fa fa-rss","href"=> Yii::app()->createUrl($this->module->id."/news/index/type/".Person::COLLECTION."/id/".Yii::app()->session["userId"] ) ),
              array('label' => "HEY !! ", "key"=>"heyPage","iconClass"=>"fa fa-bullhorn", "class"=>"new-news" ,"href"=>"#new-News"),
            );
            $this->sidebar1 = $menuLeft;//array_merge( $menuLeft, $this->sidebar1 );	
          foreach( $this->sidebar1 as $item )
          {
              buildLi($item);
          }

          function buildLi($item)
          {
            $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
            $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' :  "" ;

            $coco = ( isset( $item["href"] ) ) ? $item["href"]  :"#";
            /*if( isset( $item["href"] ) ) 
            {
              $href = $item["href"]."".stripos($item["href"], "http");
              if( stripos($item["href"], "http") === false  )  
                $href = 'xxxxxxxxxx';//Yii::app()->createUrl( $item[ "href" ] ) ;
              if( stripos($item["href"], "#") == 0 )
                $href = Yii::app()->request->getUrl().$item[ "href" ];
            }*/

            $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
            $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].'"></i>' : '';
            $isActive = ( isset( Menu::$sectionMenu[ $item["key"] ] ) && in_array( Yii::app()->controller->action->id, Menu::$sectionMenu[ $item["key"] ] ) ) ? true : false;
            
            $active = ( $isActive || (isset($item["active"]) && $item["active"] ) ) ? "open active" : "";
            echo '<li class="moduleMenu menu_'.$item["key"].' '.$item["key"].' '.$active.'"><a href="'.$coco.'" '.$modal.' '.$class.' '.$onclick.' >'.$icon.'<span class="inner">'.$item["label"].'</span></a></li>';
          }

          function buildChildren( $children )
          {
            foreach( $children as $item )
            {
                if(isset($item["key"]))
                  buildLi($item);
            }
          }
          ?>
        <!-- END TWO LEVEL MENU -->     
        <?php if(YII_DEBUG){ ?>
        <li class="moduleMenu menu_debug debug ">
          <a href="javascript:showDebugMap();"><i class="fa fa-bug"></i><span class="inner">Show Debug Map</span></a>
        </li>
        <?php } ?>
      </ul>

    </div>
  </div>
</nav>
<script type="text/javascript">
  jQuery(document).ready(function() {
      $(".mainModuleMenu").mouseenter(function(){
        $(".moduleMenu").addClass("active");
      }).mouseleave(function(){
        $(".moduleMenu").removeClass("active");
      });
    });

</script>
<!-- end: LEFT NAVIGATION MENU -->
