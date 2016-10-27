// Additional Function
var Additional = function() {"use strict";

	// function to handle SlideBar Toggle
	var runCustomSideBarToggle = function() {
		$(".sb_custom_toggle").click(function(e) {
			e.preventDefault();
			var sb_toggle = $(this);

			if(sb_toggle.data('target')) {
				
				var slidingbar = $(sb_toggle.data('target'));

				if(slidingbar.length) {
					$(slidingbar).slideToggle("fast", function() {
						if(sb_toggle.hasClass('open')) {
							sb_toggle.removeClass('open');
						} else {
							sb_toggle.addClass('open');
						}
					});
				}
			}
		});

		$(".sb_close").click(function(e) {
			e.preventDefault();

			var sb_close = $(this);
			sb_close.closest('.slidingbar').slideToggle("fast", function() {
				sb_close.removeClass('open');
			});
		});
	};


	//function to adapt the Main Content height to the Main Navigation height
	var runCustomContainerHeight = function() {
		$('.slidingbar-area').css({
			'max-height': $windowHeight
		});
	};

	var runCollapseList = function() {
		$('.collapse_list .collapse_trigger').on('click', function() {
			
			var open = true;
			if($(this).closest('.collapse_wrap').hasClass('open')) {
				open = false;
			}

			var $collapse_list = $(this).closest('.collapse_list');
			$('.collapse_wrap', $collapse_list).removeClass('active').removeClass('open');

			if(open) {
				$(this).closest('.collapse_wrap').addClass('active').addClass('open');
			}
		});
	};

	return {
		//main function to initiate template pages
		init: function() {
			runCustomSideBarToggle();
			runCustomContainerHeight();
			runCollapseList();
		}
	};
}();
