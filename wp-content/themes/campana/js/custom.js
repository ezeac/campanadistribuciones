// update slider counter
$(document).ready(function(){
	$(".carousel-control").click(function(){
		update_counter();
	});
	setInterval(update_counter,500);
});
function update_counter() {	
	$(".top-slider .item").each(function(i,e){
		if ($(e).is(".active") && $(".counter-number.actual").html() != "0"+(i+1)) {
			$(".counter-number.actual").html("0"+(i+1));
		}
	});
}



$(document).ready(function(){ 
	$(document).scroll(function(){
		if ($(document).scrollTop() > 200) {
			$(".primary-navigation").addClass("nav-fixed");
			$(".header-links-cont").addClass("header-links-fixed");
		} else {
			$(".primary-navigation").removeClass("nav-fixed");
			$(".header-links-cont").removeClass("header-links-fixed");
		}
	});
});


$(document).ready(function(){ 
	if (!$(".woocommerce-breadcrumb span:last-child").is(':nth-child(2)')) {
		$(".top-page-title > a").attr('href',$(".woocommerce-breadcrumb span:last-child").prev().attr('href'));
	} else {
		$(".top-page-title > a").attr('href','/index.php/shop');
	}
	if ($(".entry-title").html() != undefined) { $(".top-page-title > span").html($(".entry-title").html()); }
});