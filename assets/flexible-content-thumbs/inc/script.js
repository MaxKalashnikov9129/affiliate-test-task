(function($){
	function changeImages() {
		$('.acf-tooltip ul li a').hover(function(){
			const imageLayoutSlug = $(this).attr('data-layout');
			if (typeof flexibleContentThumbs.files[imageLayoutSlug] !== 'undefined') {
				$('.acf-tooltip').append('<div class="module-preview"><img src="'+flexibleContentThumbs.files[imageLayoutSlug]+'"></div>');
			}
		}, function(){
			$('.module-preview').remove();
		})
	}
	function checkDOMChange() {
		let toolTips = document.querySelectorAll('.acf-tooltip ul li');
		if (toolTips.length) {
			changeImages(toolTips);
		} else {
			setTimeout( checkDOMChange, 100 );
		}
	}
	function init(){
		$('a[data-name=add-layout]').click( () => {
			checkDOMChange();
		});
	}
	$(document).ready(init);
})(jQuery);
