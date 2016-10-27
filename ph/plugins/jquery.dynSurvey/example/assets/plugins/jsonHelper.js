var jsonHelper = {
  /*
  
   */
  a : {x : {b : 2} },
  test : function(){
    console.log("init",JSON.stringify(this.a));

    this.getValueByPath( this.a,"x.b");
    console.log("this.a set x.b => 1000");    
    this.setValueByPath( this.a,"x.b",1000);
    this.getValueByPath( this.a,"x.b")
    console.log(JSON.stringify(this.a));

    console.log("this.a.x set b => 2000");
    this.setValueByPath( this.a.x,"b",2000);
    this.getValueByPath( this.a,"x.b");
    console.log(JSON.stringify(this.a));

    console.log("this.a.x set b => {m:1000}");
    this.setValueByPath( this.a.x,"b",{m:1000});
    this.getValueByPath( this.a,"x.b");
    console.log(JSON.stringify(this.a));

    console.log("this.a set x.b.a => 4000");
    this.setValueByPath( this.a,"x.b.a",4000);
    this.getValueByPath( this.a,"x.b");
    console.log(JSON.stringify(this.a));

    console.log("this.a set x.b.a => {m:1000}");
    this.getValueByPath( this.a,"x.b.a");
    this.setValueByPath( this.a,"x.b.a",{m:1000});
    this.getValueByPath( this.a,"x.b.a");
    console.log(JSON.stringify(this.a));

    console.log("this.a set x.b.a.b.c.d => {xx:1000}");
    this.getValueByPath( this.a,"x.b.a.b.c.d");
    this.setValueByPath( this.a,"x.b.a.b.c.d",{xx:1000,yy:25000});
    console.log(JSON.stringify(this.a));

    console.log("this.a reset x.b.a.b.c.d.yy => 100000");
    this.getValueByPath( this.a,"x.b.a.b.c.d.yy");
    this.setValueByPath( this.a,"x.b.a.b.c.d.yy",100000);
    console.log(JSON.stringify(this.a));

    console.log("this.a delete x.b.a.b.c.d.yy");
    this.deleteByPath( this.a,"x.b.a.b.c.d.yy");
    console.log(JSON.stringify(this.a));
  },
  /*
  srcObj = any json OBJCT
  path =  STRING "node1.node2.node3"
   */
  getValueByPath : function(srcObj,path)
  {
    node = srcObj;
    //console.log("path",path);
    if( !path )
      return node;
    else if( typeof path == "object" && path.value )
    {
      return path.value;
    }
    else if( path.indexOf(".") )
    {
      pathArray = path.split(".");
      $.each(pathArray,function(i,v){
        if(node != undefined && node[v] != undefined)
          node = node[v];
        else {
          node = undefined; 
          return;
        }
      });
      return node;
    }  
    else if(node[path])
      return node[path];
    else
      return "";
  },
  setValueByPath : function(srcObj,path,value)
  {
    node = srcObj;
    if( !path ){
      node = value;
    }
    else if( path.indexOf(".") )
    {
      pathArray = path.split(".");
      nodeParent = null;
      lastKey = null;
      $.each(pathArray,function(i,v){
        if(!node[v]){
          //console.log("building node",v);
          node[v] = {};
        }
        nodeParent = node;
        node = node[v]; 
        lastKey = v;
      });
      //console.log(node,nodeParent,lastKey);
      nodeParent[lastKey] = value;
    }  
    else
      node[path] = value;
  },
  
  deleteByPath : function  (srcObj,path) {
    nodeParent = srcObj;
    lastChild = null;
    node = srcObj;
    if( path.indexOf(".") ){
      pathArray = path.split(".");
      if( pathArray.length )
      {
        $.each(pathArray,function(i,v){
          nodeParent = node;
          lastChild = v;
          node = node[v];
        });
      }
      delete nodeParent[lastChild];
    } else
      delete nodeParent[path];
  },
  /*
  convert
  { "clim":75,"informatique": 223 }
  to 
  [{  "label" : "Climatisation",  "value":75},{"label" : "Climatisation", "value":75}]
   */
  Object2GraphArray : function ( srcObj )
  {
    destArray = [];
    //console.dir(srcObj);
    $.each(srcObj,function(k,v){
        if(v.value != 0)
            destArray.push(v);
    });
    //console.dir(destArray);
    return destArray;
  },

  jsonFromToJson : {

  "fromjson" : [
    {"x":1, "y": {"c" : 20, "o" : 30} },
    {"x":2, "y": {"c" : 60, "o" : 50} }
  ],
  "rules" : { 
          "a" : "x" , 
          "b" : function(obj){ return obj.y.c + obj.y.o }
          },
  "outputLine" : {"a":"", "b":""},
  "toJson" : [],
  
  "test" : function(){
    console.log("test");  
    this.convert();
  },
  
  "convert" : function(){
    console.log("convert");     
    this.toJson = [];
    $.each(this.fromJson,function(i, fromObj){

      newLine = this.outputLine;
      /*$.each(this.rules,function(keyTo, convertTo){
        console.log("convert rules ",fromObj,keyTo,convertTo);     
          if(typeof convertTo == "function")
            newLine[ keyTo ] = convertTo( fromObj );
          else
            newLine[ keyTo ] = fromObj[convertTo];
      });*/
        
      this.toJson.push(newLine);
    });
    return this.toJson;
  }

}

};