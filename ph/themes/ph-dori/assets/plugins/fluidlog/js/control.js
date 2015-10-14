
$('#home')
  .popup({
    inline: true,
    hoverable: true,
    position: 'bottom left',
    delay: {
      show: 100,
      hide: 300
    }
  });

$('#newGraph')
  .click(function() {
    myGraph.newGraph();
  })
  .popup({
    inline: true,
    hoverable: true,
    position: 'bottom left',
    delay: {
      show: 100,
      hide: 300
    }
  });

$('#openGraph').click(function() {
  myGraph.getContentLocalStorage();
  myGraph.displayContentOpenGraphModal();
  $('#openGraphModal')
    .modal({
          onApprove : function()
            {
              myGraph.openGraph();
            }
          })
    .modal('show');
})
.popup({
  inline: true,
  hoverable: true,
  position: 'bottom left',
  delay: {
    show: 100,
    hide: 300
  }
});

$("#saveGraph").click(function () {
  var graphNameLabel = $('#graphNameLabel').html();
  if (graphNameLabel == myGraph.config.newGraphName)
  {
    $('#graphNameInput').val("");
    $('#saveGraphModal')
      .modal({
            onApprove : function()
              {
                thisGraph.graphName = $('#graphNameInput').val();
                myGraph.saveGraphToLocalStorage();
                //myGraph.saveGraphToSemForms();
              }
            })
      .modal('show');
  }
  else {
    myGraph.saveGraphToLocalStorage();
    //myGraph.saveGraphToSemForms();
  }
})
.popup({
  inline: true,
  hoverable: true,
  position: 'bottom left',
  delay: {
    show: 100,
    hide: 300
  }
});


$("#manageGraph").click(function () {
  myGraph.getContentLocalStorage();
  if (myGraph.listOfLocalGraphs.length > 0)
  {
    myGraph.displayContentManageGraphModal()
    $('#manageGraphModal')
      .modal({
            onApprove : function()
              {
                myGraph.manageGraphs();
              }
            })
      .modal('show');
    }
    else {
      alert ("You don't have any graph in your local store")
    }
})
.popup({
  inline: true,
  hoverable: true,
  position: 'bottom left',
  delay: {
    show: 100,
    hide: 500
  }
});

$('#focusContextNode')
  .click(function() {
    myGraph.focusContextNode(); //On selected node
    $('#focusContextNodeOff').show();
    $('#focusContextNode').hide();
  })
  .popup({
    inline: true,
    hoverable: true,
    position: 'bottom left',
    delay: {
      show: 100,
      hide: 500
    }
  });

$('#focusContextNodeOff')
  .click(function() {
    myGraph.focusContextNodeOff();
    $('#focusContextNodeOff').hide();
    $('#focusContextNode').show();
  })
  .popup({
    inline: true,
    hoverable: true,
    position: 'bottom left',
    delay: {
      show: 100,
      hide: 500
    }
  });

$('#sidebarButton').click(function(){
    $('.right.sidebar').sidebar('toggle');
});

$('#sidebarMenuHelpItem').click(function () {
  $('#helpModal')
    .modal('show');
});

$('#sidebarMenuSettingsItem').click(function () {
  $('#settingsModal')
    .modal('show');
});

$('#sidebarMenuUploadGraphItem').click(function() {
    $('#uploadModal')
      .modal('show')
      .modal({
        onApprove : function()
          {
            var input = $('#uploadInput');
            myGraph.uploadGraph(input);
          }
        })
  })
.popup({
  inline: true,
  hoverable: true,
  position: 'bottom left',
  delay: {
    show: 100,
    hide: 500
  }
});

$('#sidebarMenuDownloadGraphItem')
  .click(function() {
    myGraph.downloadGraph(myGraph);
  })
  .popup({
    inline: true,
    hoverable: true,
    position: 'bottom left',
    delay: {
      show: 100,
      hide: 500
    }
  });

$('#curvesLinksCheckbox').checkbox({
  onChecked:function() {
    myGraph.config.curvesLinks = "On";
    myGraph.refreshGraph();
  },
  onUnchecked: function() {
    myGraph.config.curvesLinks = "Off";
    myGraph.refreshGraph();
  },
});

$('#openNodeOnHoverCheckbox').checkbox({
  onChecked:function() {
    myGraph.config.openNodeOnHover = "On";
    myGraph.refreshGraph();
  },
  onUnchecked: function() {
    myGraph.config.openNodeOnHover = "Off";
    myGraph.refreshGraph();
  }
});

$('#activeForceCheckbox').checkbox({
  onChecked: function() {
    myGraph.config.force = "On";
    myGraph.config.elastic = "On";
    $('#activeElasticCheckbox').checkbox('check');
    $('#activeElasticCheckbox').removeClass('disabled');
    if (checkboxIsInitialized)
      myGraph.refreshGraph();
  },
  onUnchecked: function() {
    if (typeof myGraph.force != "undefined")
      myGraph.force.stop();
    myGraph.config.force = "Off";
    myGraph.config.elastic = "Off";
    $('#activeElasticCheckbox').checkbox('uncheck');
    $('#activeElasticCheckbox').addClass('disabled');
    if (checkboxIsInitialized)
      myGraph.refreshGraph();
  },
});

$('#activeElasticCheckbox').checkbox({
  onChecked: function() {
    myGraph.config.elastic = "On";
    if (checkboxIsInitialized)
      myGraph.refreshGraph();
  },
  onUnchecked: function() {
    if (typeof myGraph.force != "undefined")
      myGraph.force.stop();
    myGraph.config.elastic = "Off";
    if (checkboxIsInitialized)
      myGraph.refreshGraph();
  }
});

$('#displayIdCheckbox').checkbox({
  onChecked: function() {
    myGraph.config.displayId = "On";
    myGraph.refreshGraph();
  },
  onUnchecked: function() {
    myGraph.config.displayId = "Off";
    myGraph.refreshGraph();
  }
});
