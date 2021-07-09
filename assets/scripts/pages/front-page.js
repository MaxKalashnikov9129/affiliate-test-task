$(document).ready(function(){
	$('#latest-news-block .latest-news-list').slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		prevArrow: '<div class="slick-prev prev-arrow-button"></div>',
		nextArrow: '<div class="slick-next next-arrow-button"></div>',
	});
})
