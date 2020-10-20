jQuery(function($){

	$(document).ready(function() {
        // for burger menu
        $('.mobile-menu-toggle').on('click', function(){
            $(this).toggleClass('active');
            $('.mobile-menu-wrap').toggleClass('showing');
            // $(document.body).toggleClass('overflow');
        });


        //for tabs
		$('.tab-name-list li').on('click', function () {
			var tabId = $(this).data('tabName'),
				nameBox = $(this).parent(),
				nameList = nameBox.find('li'),
                contentBox =  nameBox.next(),
				contentList =contentBox.find('li'),
				currentContent = contentBox.find("[data-tab-content="+tabId+"]");

			nameList.removeClass('active');
			contentList.removeClass('show');
			$(this).addClass('active');
			currentContent.addClass('show');
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
