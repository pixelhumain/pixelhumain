/* ===========================================================
 * jQuery script for Twitter API v1.1 (requires PHP)
 * =========================================================== */
var fetcher = 'assets/php/twitter.php',
    defaultIconClass = 'icon-twitter icon-large';
// allows the script to be used in more than an area in the same page
$('.tweet').each(function() {

    $.ajax({
        dataType: 'json',
        url: fetcher,
        context: this,
        success: function (data) {
            var $container = $(this),
                iconClass =  $container.data('icon') || defaultIconClass,
                html;
            // begin custom generated markup
            html = '<ul class="tweetList">'
                $.each(data, function (i, item) {
                    var text = item.text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
                      return '<a href="'+url+'">'+url+'</a>';
                    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
                      return  '<a href="http://twitter.com/'+reply.substring(1)+'">'+reply+'</a>';
                    });                
                    html += '<li class="tweet"><em class="'+iconClass+'"></em><p class="tweetText">' + text + '<br><small class="tweetTime">'+ relative_time(item.created_at)+'</small></p></li>'
                })
            html += "</ul>"
            $container.append(html)
            // end custom generated markup
        }
    });

})
// convert the tweet time a nice string
function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) { return 'less than a minute ago';
  } else if(delta < 120) {return 'about a minute ago';
  } else if(delta < (60*60)) { return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {return 'about an hour ago';
  } else if(delta < (24*60*60)) { return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) { return '1 day ago';
  } else {return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}