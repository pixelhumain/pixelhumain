<!-- start: LEFT NAVIGATION MENU -->

<nav class="left-navbar">
  <div class="navbar-content">
    <div class="navbar-content-inner">

      <ul class="navbar-menu"> 
      <?php /* ?>
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
        */
        	$id = Yii::app()->session["userId"];
        	if(isset($_GET["id"]))
        		$id= $_GET["id"];

		    $menuLeft = array();
            array_push($menuLeft, array('label' => "MY DASHBOARD", "key"=>"myDashboard","iconClass"=>"fa fa-th-large ","href"=> Yii::app()->createUrl($this->moduleId."/person/dashboard")) );
            array_push($menuLeft, array('label' => "MY WALL" , "key"=>"myAccount","iconClass"=>"fa fa-home","href"=> Yii::app()->createUrl($this->moduleId."/news/index/type/".Person::COLLECTION."/id/".Yii::app()->session["userId"] ) ) );
            if( Yii::app()->controller->id != "admin" )
            {
              array_push($menuLeft, array('label' => "MY PEOPLE", "key"=>"myPeoplePage","iconClass"=>"fa ".Person::ICON,"href"=> Yii::app()->createUrl($this->moduleId."/person/directory/type/persons")) );
              array_push($menuLeft, array('label' => "MY ORGANIZATIONS", "key"=>"myOrganizationsPage","iconClass"=>"fa ".Organization::ICON,"href"=> Yii::app()->createUrl($this->moduleId."/person/directory/type/organizations")) );
              array_push($menuLeft, array('label' => "MY PROJECTS", "key"=>"myProjectsPage","iconClass"=>"fa ".Project::ICON,"href"=> Yii::app()->createUrl($this->moduleId."/person/directory/type/persons")) );
              array_push($menuLeft, array('label' => "MY CALENDAR", "key"=>"myCalendarPage","iconClass"=>"fa fa-calendar","href"=> Yii::app()->createUrl($this->moduleId."/event/calendarview/id/".$id."/type/person")) );

              if( isset( Yii::app()->session["user"]["codeInsee"] ) )
                array_push($menuLeft, array('label' => "MY CITY ", "key"=>"myCityPage","iconClass"=>"fa fa-university","href"=> Yii::app()->createUrl($this->moduleId."/city/index/insee/".Yii::app()->session["user"]["codeInsee"])) );
              //array_push($menuLeft, array('label' => "MY DIRECTORY", "key"=>"myDirectoryPage","iconClass"=>"fa fa-globe","href"=> Yii::app()->createUrl($this->moduleId."/person/directory")) );
              //array_push($menuLeft, array('label' => "MY NEWS", "key"=>"myNewsPage","iconClass"=>"fa fa-rss","href"=> Yii::app()->createUrl($this->moduleId."/news/index/type/".Person::COLLECTION."/id/".Yii::app()->session["userId"] ) ) );
              //array_push($menuLeft, array('label' => "MY ACTIONS", "key"=>"myVotesPage","iconClass"=>"fa fa-thumbs-up","href"=> Yii::app()->createUrl($this->moduleId."/rooms/index/type/".Person::COLLECTION."/id/".Yii::app()->session["userId"] ) ) );
            }
            
            if( @Yii::app()->session[ "userIsAdmin"] )
              array_push($menuLeft, array('label' => "ADMIN ", "key"=>"adminPage","iconClass"=>"fa fa-logo text-red","href"=>Yii::app()->createUrl($this->moduleId."/admin/directory")) );
              
            //array_push($menuLeft, array('label' => "LOGOUT ".Yii::app()->session["user"]["name"], "key"=>"logoutPage","iconClass"=>"fa fa-power-off text-red text-bold","href"=>Yii::app()->createUrl($this->moduleId."/person/logout")) );
            

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
            echo '<li class=" moduleMenu menu_'.$item["key"].' '.$item["key"].' '.$active.'"><a href="'.$coco.'" '.$modal.' '.$class.' '.$onclick.' >'.$icon.'<span class="inner">'.$item["label"].'</span></a></li>';
          }

          function buildChildren( $children )
          {
            foreach( $children as $item )
            {
                if(isset($item["key"]))
                  buildLi($item);
            }
          }?>

        <!-- END TWO LEVEL MENU -->     
        <?php /*if(YII_DEBUG){ ?>
        <li class="moduleMenu menu_debug debug ">
          <a href="javascript:showDebugMap();"><i class="fa fa-bug"></i><span class="inner">Show Debug Map</span></a>
        </li>
        <?php }*/ ?>
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
