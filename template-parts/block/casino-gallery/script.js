jQuery(document).ready(() => {
	$('.casino-gallery .casino-gallery-list').slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: '<div class="slick-prev prev-arrow-button"></div>',
		nextArrow: '<div class="slick-next next-arrow-button"></div>',
	});
});
