<!-- All details of a person participating in a project -->
name : <input type="text" name='name' value="name"></input><br/>
trigram : <input type="text" name='trigram' value="trigram"></input><br/>
email : <input type="text" name='email' value="email"></input><br/>
tel : <input type="text" name='tel' value="tel"></input><br/>
location : <input type="text" name='location' value="location"></input><br/>
<br/>
Existing People :
<div id="peopleList"></div>
<script>
	var microformat = microformats["team"];
	var params = { "db":microformat.db.db ,
                   "collection":microformat.db.collection
                 };
	$.ajax({
        type: "GET",
        url: './mongoDB.php',
        dataType: "json",
        async: false,
        data: params,   
        success: function(data) { 
            dir(data);
            if(microformat.getFromSourceCallback!= null ) //not so good !! but only for rendering purpose
                eval(microformat.getFromSourceCallback+"(data)");
        }
    });
	
</script>
    