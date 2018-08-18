
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
	} else if (!$("body").is("[class*='page-template']")) {
		$(".top-page-title > a").attr('href','/index.php/shop');
	} else {
		$(".top-page-title > a").attr('href','/index.php/');
	}
	//if ($(".entry-title").html() != undefined) { $(".top-page-title > span").html($(".entry-title").html()); }

	//animate scrolltop with arrow navigation links 
	$(".scroll-navigation-button").click(function() {
		$('html, body').animate({'scrollTop':$(this).parent().parent().offset().top-50},500);
	});

	$(".scroll-navigation-button-bottom").click(function() {
		$('html, body').animate({'scrollTop':$(this).parent().parent().offset().top-50+$(this).parent().parent().outerHeight()},500);
	});

	//fix checkout
	if ($("body").is(".woocommerce-checkout:not(.woocommerce-order-received)")) {
		$("#billing_country_field").after("<h3 class='tit'>Dirección de Envío</h3>");
		$("#billing_first_name_field").after("<h3 class='tit'>Datos Personales</h3>");
		var total = $(".checkout .order-total .amount").html();
		var subtotal = $(".checkout .cart-subtotal .amount").html();
		$('#place_order').html("Finalizar Compra");
		$(".checkout div#order_review").prepend("<div class='order-totals-checkout'><div class='details'><div class='item'>Subtotal: "+subtotal+"</div></div><div class='tot'><div class='item total'>Total: "+total+"</div><div class='item submit'>"+$('#place_order')[0].outerHTML+"</div></div></div>");
	}
	//success
	$(".woocommerce-order-received h2.woocommerce-column__title").each(function(){
		if($(this).html() == "Dirección de facturación"){
			$(this).html("Dirección");
			return false;
		}
	});
	$(".woocommerce-order-received tfoot tr th").each(function(){
		if($(this).html() == "Método de pago:"){
			$(this).parent().remove();
			return false;
		}
	});

	//catalog
	$("li.cat-item.cat-item-15 a").html("Sin Categoría");

	//mobile menu
	$(".primary-navigation .menu.nav-menu").prepend($(".header-links-cont > ul > li").clone().addClass("visible-xs"));

});