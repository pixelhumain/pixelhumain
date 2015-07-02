<style type="text/css">
  .page_navigation .title {font-weight: bold;}
</style>
<nav class="page_navigation" style="border-top:1px solid #eee;">

	<ul class="main-navigation-menu moduleMenu">
		<?php 

          foreach( $this->sidebar2 as $item )
          {
              buildLi2( $item );
          }

          function buildLi2( $item )
          {
            $modal = ( @$item["isModal"]) ? 'role="button" data-toggle="modal"' : "";
            $onclick = ( @$item["onclick"]) ? 'onclick="'.$item["onclick"].'"' 
                                                 : ( ( @$item["key"] && false) ? 'onclick="scrollTo(\'#block'.$item["key"].'\')"' 
                                                                            : "" );
            $href = ( @$item["href"]) ? (stripos($item["href"], "http") === false) ? Yii::app()->createUrl($item["href"]) : $item["href"] : "javascript:;";
            $class = ( @$item["class"]) ? 'class="'.$item["class"].'"' : "";
            $icon = ( @$item["iconClass"]) ? '<i class="'.$item["iconClass"].'"></i>' : '';
            $isActive = ( isset( Menu::$sectionMenu[ @$item["key"] ] ) && in_array( Yii::app()->controller->action->id, Menu::$sectionMenu[ $item["key"] ] ) ) ? true : false;
            
            $active = ( $isActive || ( @$item["active"] && $item["active"] ) ) ? "open active" : "";
            

            //This menu can have 2 levels
            if( isset($item["children"]) ){
                  echo '<li><a href="javascript:;">'.
                        '<span class="status">'.
                          '<i class="fa fa-caret-down"></i>'.
                          '<span class="badge">'.count($item["children"]).'</span>'.
                        '</span>'.
                        $item["label"].
                        '</a>';
                  echo "<ul class='sub-menu'>";
                    foreach( $item["children"] as $item2 )
                    {
                        buildLi2($item2);
                    }
                  echo "</ul></li>";
                }
            else
              echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.@$item["label"].'</a></li>';
          }

          ?>
	</ul>

</nav>
<script type="text/javascript">
  function loadPage (url) { 
    $(".moduleMenu li.active").removeClass('active');
    console.log("loadPage",baseUrl+url);
    getAjax("#pageContent", baseUrl+url,null,"html",true);
  }
</script>

<?php /* ?>
<!-- start: PAGE MENU -->
<div class="col-md-3">

  <nav class="page_navigation">

    <h1 class="page_navigation-title">Filtres d'affichage :</h1>

    <ul class="main-navigation-menu">
      <li class="title">
        Types d’actu
      </li>
      <li>
        <a href="#">
          Lorem ipsum 0
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <span class="status">
            <i class="fa fa-caret-down"></i>
            <span class="badge">4</span>
          </span>
          Lorem ipsum 1
        </a>
        <ul class="sub-menu">
          <li>
            <a href="#">
              sub lorem ipsum 1
            </a>
          </li>
          <li>
            <a href="#">
              sub lorem ipsum 2
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;">
          <span class="status">
            <i class="fa fa-caret-down"></i>
            <span class="badge">44</span>
          </span>
          Lorem ipsum 2
        </a>
        <ul class="sub-menu">
          <li>
            <a href="#">
              sub lorem ipsum 1
            </a>
          </li>
          <li>
            <a href="#">
              sub lorem ipsum 2
            </a>
          </li>
        </ul>
      </li>

      <li class="title">
        second menu
      </li>

      <li>
        <a href="#">
          Lorem ipsum 0
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <span class="status">
            <i class="fa fa-caret-down"></i>
            <span class="badge">4</span>
          </span>
          Lorem ipsum 1
        </a>
        <ul class="sub-menu">
          <li>
            <a href="#">
              sub lorem ipsum 1
            </a>
          </li>
          <li>
            <a href="#">
              sub lorem ipsum 2
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;">
          <span class="status">
            <i class="fa fa-caret-down"></i>
            <span class="badge">44</span>
          </span>
          Lorem ipsum 2
        </a>
        <ul class="sub-menu">
          <li>
            <a href="#">
              sub lorem ipsum 1
            </a>
          </li>
          <li>
            <a href="#">
              sub lorem ipsum 2
            </a>
          </li>
        </ul>
      </li>
    </ul>

  </nav>

</div>
<!-- end: PAGE MENU -->

*/?> 