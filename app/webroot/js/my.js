$(document).on('ready', initJQ);

function initJQ(e)
{
	$(".modalink").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		minWidth	: 550,
		fitToView	: false,
		// width		: '550',
		// height		: '70%',
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'fade'
	});

	$("#flashMessage").delay(3000).fadeOut();

}