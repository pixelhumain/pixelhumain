<!-- start: LEFT NAVIGATION MENU -->

<nav class="left-navbar">
  <div class="navbar-content">
    <div class="navbar-content-inner">

      <ul class="navbar-menu">  
        <?php 
          
          foreach( $this->sidebar1 as $item )
          {
              buildLi($item);
          }

          function buildLi($item)
          {
            $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
            $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' 
                                                 : ( (isset($item["key"]) && false) ? 'onclick="scrollTo(\'#block'.$item["key"].'\')"' 
                                                                            : "" );
            $href = (isset($item["href"])) ? (stripos($item["href"], "http") === false) ? Yii::app()->createUrl($item["href"]) : $item["href"] : "#";
            $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
            $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].'"></i>' : '';
            $isActive = ( isset( Menu::$sectionMenu[ $item["key"] ] ) && in_array( Yii::app()->controller->action->id, Menu::$sectionMenu[ $item["key"] ] ) ) ? true : false;
            
            $active = ( $isActive || (isset($item["active"]) && $item["active"] ) ) ? "open active" : "";
            echo '<li class="menu_'.$item["key"].' '.$item["key"].' '.$active.'"><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.$icon.'<span class="inner"><i class="fa fa-caret-right"></i>'.$item["label"].'</span></a></li>';
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
      </ul>

    </div>
  </div>
</nav>

<!-- end: LEFT NAVIGATION MENU -->
