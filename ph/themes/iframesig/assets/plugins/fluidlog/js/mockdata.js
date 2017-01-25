var data = [];

data[0] = {
      nodes: [
        {id:0, label: "new", type: "without", x:200, y:200, identifier:"http://fluidlog.com/0" },
      ],
      edges: []
}

data[1] = {
      nodes: [
              {id:0, label: "A", type:"project", x:100, y:100, identifier:"http://fluidlog.com/0" },
              {id:1, label: "B", type:"idea", x:200, y:200, identifier:"http://fluidlog.com/1" },
              {id:2, label: "C", type:"project", x:300, y:300, identifier:"http://fluidlog.com/2" },
      ],
      edges: [
              { source: 0, target: 1 },
      ]
}

data[2] = {
      nodes: [
              {id:0, label: "A petit texte", size:20, type:"project", x:100, y:100, identifier:"http://fluidlog.com/0" },
              {id:1, label: "B texte sur deux longues lignes", size:20, type:"idea", x:200, y:200, identifier:"http://fluidlog.com/1" },
              {id:2, label: "C", type:"project", x:400, y:200, identifier:"http://fluidlog.com/2" },
              {id:3, label: "D", type:"idea", x:400, y:400, identifier:"http://fluidlog.com/3" },
              {id:4, label: "E", type:"project", x:300, y:400, identifier:"http://fluidlog.com/4" },
              {id:5, label: "F", type:"project", x:500, y:300, identifier:"http://fluidlog.com/5" },
              {id:6, label: "G", type:"project", x:300, y:500, identifier:"http://fluidlog.com/6" },
              {id:7, label: "H", type:"project", x:400, y:500, identifier:"http://fluidlog.com/7" },
      ],
      edges: [
              { source: 0, target: 1 },
              { source: 0, target: 2 },
              { source: 0, target: 3 },
              { source: 3, target: 4 },
              { source: 3, target: 5 },
              { source: 3, target: 6 },
              { source: 3, target: 7 },
      ]
}

$.mockjax({
  url : '/data/d3data',
  dataType : 'json',
  responseTime : 2000,
  responseText : data[1],
});
