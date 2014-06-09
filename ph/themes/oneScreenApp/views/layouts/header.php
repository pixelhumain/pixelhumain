  <nav class="menu-opener">
    <div class="menu-opener-inner"></div>
  </nav>
  <nav class="menu">
    <ul class="menu-inner">
      <?php 
        foreach( $this->sidebar1 as $item )
        {
            $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
            $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' : "";
            $href = (isset($item["href"])) ? $item["href"] : "#";
            $class = (isset($item["class"])) ? $item["class"] : "";
            echo '<a href="'.$href.'" '.$modal.' class="menu-link '.$class.'" '.$onclick.' ><li>'.$item["label"].'</li></a>';
        }
        ?>
    </ul>
  </nav>