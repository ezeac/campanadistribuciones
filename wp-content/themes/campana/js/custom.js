
function update_counter() {	
	$(".top-slider .item").each(function(i,e){
		if ($(e).is(".active") && $(".counter-number.actual").html() != "0"+(i+1)) {
			$(".counter-number.actual").html("0"+(i+1));
		}
	});
}


$(document).ready(function(){ 
	// update slider counter
	$(".carousel-control").click(function(){
		update_counter();
	});
	setInterval(update_counter,500);

	//header fixed update with scrolltop
	$(document).scroll(function(){
		if ($(document).scrollTop() > 200) {
			$(".primary-navigation").addClass("nav-fixed");
			$(".header-links-cont").addClass("header-links-fixed");
		} else {
			$(".primary-navigation").removeClass("nav-fixed");
			$(".header-links-cont").removeClass("header-links-fixed");
		}
	});

	//header back button link (use hidden breadcumb)
	if (!$(".woocommerce-breadcrumb span:last-child").is(':nth-child(2)')) {
		$(".top-page-title > a").attr('href',$(".woocommerce-breadcrumb span:last-child").prev().attr('href'));
	} else {
		$(".top-page-title > a").attr('href','/index.php/shop');
	}
	//if ($(".entry-title").html() != undefined) { $(".top-page-title > span").html($(".entry-title").html()); }

	//animate scrolltop with arrow navigation links 
	$(".scroll-navigation-button").click(function() {
		$('html, body').animate({'scrollTop':$(this).parent().parent().offset().top-50},500);
	});

	$(".scroll-navigation-button-bottom").click(function() {
		$('html, body').animate({'scrollTop':$(this).parent().parent().offset().top-50+$(this).parent().parent().outerHeight()},500);
	});
});