<style type="text/css">
  .page_navigation .title {font-weight: bold;}
</style>
<nav class="page_navigation" style="border-top:1px solid #eee;">

	<ul class="main-navigation-menu moduleMenu">
		<?php 
          foreach( $this->sidebar2 as $item )
          {
              Menu::buildLi2( $item );
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