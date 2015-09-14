<?php 
$cs = Yii::app()->getClientScript();
//$cs->registerCssFile('http://www.google.com/cse/style/look/default.css');
//$cs->registerScriptFile('https://www.google.com/jsapi' , CClientScript::POS_END);
?>
<style>

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">


<?php

function get_url_contents($url) {
    $crl = curl_init();

    curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}
$q = urlencode("saint denis réunion");
echo $q;
$json = get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$q);

$data = json_decode($json);

foreach ($data->responseData->results as $result) {
    $results[] = array('url' => $result->url, 'alt' => $result->title);
    
}

foreach($results as $r)
    echo "<img src='".$r["url"]."'/>";
?>
    
	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){
	google.load('search', '1');
    google.setOnLoadCallback(function(){
      new google.search.CustomSearchControl().draw('cse');
    }, true);
};
</script>