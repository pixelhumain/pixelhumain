<style>

/* ********************* */
/* Menu Fixe LEft */
/* ********************* */


.side-panel {
  padding: 0 30px 0 0;
  position:fixed;
  top:60px;
  left:0px;
  z-index:1000;
}
.side-panel:nth-child(2n) {
  /*background: #2d3e4a;*/
}
.side-panel ul {
  margin: 0;
  padding: 0;
  list-style: none;
  font-family:"Homestead";
}
.side-panel > ul > li:first-child {
  border-top-right-radius: 3px;
}
.side-panel > ul > li:first-child a {
  padding-top: 13px;
}
.side-panel > ul > li:last-child {
  border-bottom-right-radius: 3px;
}
.side-panel > ul > li:last-child a {
  padding-bottom: 13px;
}
.side-panel > ul ul {
  width: 150px;
  padding-left: 10px;
  display: none;
  position: absolute;
  top: 0;
  left: 100%;
}
.side-panel > ul ul li:first-child {
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  border-right-color: #efefef;
}
.side-panel > ul ul li:first-child:before {
  position: absolute;
  content: "";
  width: 0;
  height: 0;
  top: 50%;
  right: 100%;
  margin-top: -5px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-right: 5px solid #efefef;
  border-right-color: inherit;
}
.side-panel > ul ul li:first-child:hover {
  border-right-color: #fff;
}
.side-panel > ul ul li:last-child {
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
}
.side-panel li {
  position: relative;
  background: #507DBD;
}
.side-panel li:hover {
  background: #4A6AAC;
}
.side-panel li:hover > ul {
  display: block;
}
.side-panel a {
  display: inline-block;
  padding: 8px 15px;
  cursor: pointer;
  text-decoration:none;
  color:#fff;
}

.b li [class*="entypo-"],.b li [class*="icon-"],.b li [class*="social-"] {
  display: inline-block;
  position: relative;
  left: 145px;
  transform: translateX(0);
  transition: all .3s ease-in-out;
  transition-delay: .1s;
  font-size: x-large;
  color:#fff;
}
.b .menu-item {
  display: inline-block;
  opacity: 0;
  transition: opacity .3s ease-in-out;
  
}
.b > ul {
  position: relative;
  left: -150px;
  transform: translate(0) translateZ(0);
  width: 200px;
  transition: transform .3s .1s ease-in-out;
}
.b > ul:hover {
  transform: translateX(150px);
  transition: all .3s ease-in-out;
}
.b > ul:hover li [class*="entypo-"],.b > ul:hover li [class*="icon-"],.b > ul:hover li [class*="social-"] {
  transform: translateX(-150px);
  transition-delay: 0;
}
.b > ul:hover .menu-item {
  opacity: 1;
  transition: opacity .3s .2s ease-in-out;
}
.b > ul ul {
  display: block;
  opacity: 0;
  transform: translate(-100%);
  transition: all .3s ease-in-out;
  z-index: -1;
}
.b li:hover ul {
  opacity: 1;
  transform: translate(0);
}
</style>
<div class="side-panel b">
  <ul>
<?php 
foreach( $this->sidebar1 as $item )
{
    $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
    $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' : "";
    $href = (isset($item["href"])) ? $item["href"] : "#";
    $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
    echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' ><span class="'.$item["iconClass"].'"></span><span class="menu-item">'.$item["label"].'</span></a>';
    //This menu can have 2 levels
    if( isset($item["children"]) )
    {
        echo "<ul>";
        foreach( $item["children"] as $item2 )
        {
            $modal2 = (isset($item2["isModal"])) ? 'role="button" data-toggle="modal"' : "";
            $onclick2 = (isset($item2["onclick"])) ? 'onclick="'.$item2["onclick"].'"' : "";
            $href2 = (isset($item2["href"])) ? $item2["href"] : "#";
            echo '<li><a href="'.$href2.'" '.$modal2.' '.$onclick2.'></span>'.$item2["label"].'</a></li>';
        }
        echo "</ul>";
    }
    echo "</li>";
}
?>
</ul>

</div>