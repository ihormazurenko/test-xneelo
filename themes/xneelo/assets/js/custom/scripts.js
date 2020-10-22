jQuery(function($){

	$(document).ready(function() {
        // for burger menu
        $('.mobile-menu-toggle').on('click', function(){
            $(this).toggleClass('active');
            $('.mobile-menu-wrap').toggleClass('showing');
        });


        //for Courses filtering
		var filterItems = $('#course-filter').find('a');
		filterItems.on('click', function (e) {
			e.preventDefault();

			var status = this.hash.substr(1),
				courseItems = $("#course-list > *");

			filterItems.parent('li').removeClass('active');
			$(this).parent('li').addClass('active');

			courseItems.removeClass('show').filter('[data-status~="'+status+'"]').addClass('show');

			if (history.pushState) {
				var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?status=' + status;
				window.history.pushState({path:newurl},'', newurl);
			}
        });


		// for cut out course excerpt
		var excerpts = $('#course-list').find(".course-excerpt");
		if ( $.isFunction($.fn.dotdotdot) ) {
			function cut_excerpt() {
				excerpts.each(function() {
					$(this).dotdotdot({
						truncate: 'letter',
						keep: '.more',
						watch: true
					}).addClass('visible');
				});
			}
			cut_excerpt();
		} else {
			excerpts.addClass('visible');
		}

	});

});
