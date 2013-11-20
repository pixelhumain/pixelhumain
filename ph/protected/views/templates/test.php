<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
?>
<style>

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">
autocomplete
<input id="assoName" name="assoName" value=""/>

	</div>
</div>


<script type="text/javascript">
initT['animInit'] = function(){
	 var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
	$( "#assoName" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: baseUrl+"/index.php/association/getNames",
            dataType: "json",
            data: {
              typed: request.term,
              style: "full",
              maxRows: 12
            },
            success: function( data ) {
             response( $.map( data.names, function( item ) {
                console.log(item);
                return {
                  label: item.name,
                  value: item.name
                }
              }));
            }
          });
        },
        minLength: 2,
        select: function( event, ui ) {
          console.log( ui.item ?
            "Selected: " + ui.item.label :
            "Nothing selected, input was " + this.value);
        },
        open: function() {
          $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
        },
        close: function() {
          $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
        }
      });

	$.ajax({
        url: baseUrl+"/index.php/association/getNames",
        dataType: "json",
        data: {"typed": "open",style: "full",maxRows: 12},
        success: function( data ) {
        	console.log("coco",data.names);
        }
      });
};
</script>