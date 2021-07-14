$(document).ready(function () {
	$('#latest-news-block .latest-news-list').slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		prevArrow: '<div class="slick-prev prev-arrow-button"></div>',
		nextArrow: '<div class="slick-next next-arrow-button"></div>',
	});

	$('.sort-controls-date, .sort-controls-rating').on('click', function () {
		let sortColumn = $(this).data('order-by');
		let sortOrder = $(this).find('.order');

		if (sortOrder.val() === 'DESC') {
			sortOrder.val('ASC');
		} else {
			sortOrder.val('DESC');
		}

		$.ajax({
			url: themeVars.ajaxUrl,
			data: {
				action: 'sort_casino_list',
				sortColumn: sortColumn,
				sortOrder: sortOrder.val(),
			},
			success: (response) => {
				if (response.data.code === 204) {
					$('.sort-controls-message').text(response.data.message);

					return;
				}

				$('#casinos-block .casino-list').empty();
				$('#casinos-block .casino-list').append(response.data.casino_list_items);
			},
		})

	})
})
