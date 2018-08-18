<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
	wp_dequeue_style( 'storefront-style' );
	wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */


function my_custom_login_redirect(){
  //Pasamos a la función home_url() el slug de nuestra página de Área Privada
  wp_redirect(home_url("/"));
  exit();
}
add_action('wp_login','my_custom_login_redirect');


//----------------------------------------
//HOOKS
//----------------------------------------


add_action('homepage2', 'storefront_featured_products_custom', 40);
add_action('homepage2', 'storefront_product_brands', 50);


add_action('storefront_header2', 'header_left_extra_logo', 5);
add_action('storefront_header2', 'storefront_site_branding', 10);
add_action('storefront_header2', 'storefront_header_cart_custom', 20);
add_action('storefront_header2', 'storefront_primary_navigation', 30);

// add_action('woocommerce_before_main_content', 'page_title_content', 10);
// add_action('woocommerce_before_cart', 'page_title_content', 20);
// add_action('woocommerce_before_checkout_form', 'page_title_content', 1);
add_action('storefront_content_top', 'page_title_content', 1);

add_action('woocommerce_login_form_end', 'info_login', 1);

//----------------------------------------
//FUNCTIONS
//----------------------------------------

function info_login() {
	?>
	<div class="login-form-info">Si usted aún no es cliente, utilice nuestro <a href="/index.php/contacto">formulario de contacto</a> para comunicarse con nosotros. Le brindaremos los datos necesarios para ingresar y poder acceder a nuestra tienda y lista de precios.</div>
	<?php
}


function woocommerce_checkout_payment() {
	if ( WC()->cart->needs_payment() ) {
		$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
		WC()->payment_gateways()->set_current_gateway( $available_gateways );
	} else {
		$available_gateways = array();
	}

	wc_get_template( 'checkout/payment.php', array(
		'checkout'           => WC()->checkout(),
		'available_gateways' => $available_gateways,
		'order_button_text'  => apply_filters( 'woocommerce_order_button_text', __( 'Finalizar Compra', 'woocommerce' ) ),
	) );
}

function header_left_extra_logo() {
	?>
	<div class="header-extra-logo"><img src="<?php echo get_stylesheet_directory_uri() ?>/imagenes/logos/logo_30_an.png" alt="" style="width: 100%;"></div>
	<?php
}

function woocommerce_template_single_excerpt() {
	?>
	<div class="qv-desc"><?php the_excerpt(); ?></div>
	<?php
}


function woocommerce_template_single_meta_qv() {
	global $product;
	?>
	<div class="product_meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

			<div class="sku_wrapper meta-info"><div class="product-info-tit"><?php esc_html_e( 'Código de producto:', 'woocommerce' ); ?></div> <div class="sku item-text"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></div></div>

		<?php endif; ?>

		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in meta-info"> <div class="product-info-tit">Categorías:</div><div class="item-text">', '</div></div>' ); ?>

		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as meta-info">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>
	<?php
}


function woocommerce_template_single_meta() {
	global $product;
	?>
	<div class="product_meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>


		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in meta-info meta-infov2"> <div class="product-info-tit2">Categorías:</div><div class="item-text2">', '</div></div>' ); ?>

		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as meta-info">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<div class="sku-and-price">
				<div class="sku_wrapper meta-info">
					<div class="product-info-tit"><?php esc_html_e( 'Código de producto:', 'woocommerce' ); ?></div> 
					<div class="sku item-text"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></div>
				</div>
				
				<div class="price-cont">
					<div class="product-info-tit">Precio por unidad:</div>
					<p class="price"><?php echo $product->get_price_html(); ?></p>
				</div>
			</div>
		
		<?php endif; ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>
	<?php
}

function storefront_product_search() {
	if ( storefront_is_woocommerce_activated() ) { ?>
		<div class="site-search">
			<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			<div class="close-mobile visible-xs visible-sm" onclick="javascript:$('.site-search').fadeToggle()"><i class="material-icons">arrow_back</i></div>
		</div>
	<?php
	}
}

function storefront_primary_navigation() {
	?>
	<div class="site-search-btn" onclick="javascript:$('.site-search').fadeToggle()"><i class="material-icons">search</i></div>
	<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
	<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
					)
			);

			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
					)
			);
			?>
	</nav><!-- #site-navigation -->
	<?php
}

function page_title_content() {
	if (is_shop() || is_product_category()) {
		?>
		<div class="top-page-title">
			<a href="" title="Ir atrás"><i class="material-icons">arrow_back</i></a>
			<span><?php woocommerce_page_title(); ?></span>
			<?php storefront_product_search(); ?>
		</div>
		<script>
			$(document).ready(function(){
				//shop filters
				$(".top-page-title").after("<div class='filters'><div class='tit'><i class='material-icons'>tune</i><span>FILTROS</span><i class='material-icons icon-arrow'>arrow_drop_down</i></div><div class='cont'>"+$('#secondary')[0].outerHTML+"</div></div>");
				$(".filters .tit").click(function(){
					$(".filters .cont").slideToggle();
					if ($(".filters .icon-arrow").html() != "arrow_drop_up") {
						$(".filters .icon-arrow").html("arrow_drop_up");
					} else {
						$(".filters .icon-arrow").html("arrow_drop_down");
					}
				});
			});
		</script>
		<?php
	} else {
		?>
		<div class="top-page-title">
			<a href="" title="Ir atrás"><i class="material-icons">arrow_back</i></a>
			<span><?php echo (get_the_title() == "Checkout") ? "Datos de Facturación" : get_the_title(); ?></span>
		</div>
		<?php
	}
}

function storefront_header_cart_custom() {
	?>
	<div class="header-links-cont">
		<?php
		if ( storefront_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
			<?php
			if (is_user_logged_in()) { 
				?>
				<ul id="site-header-cart" class="header-links site-header-cart menu">
					<li class="link-item <?php echo esc_attr( $class ); ?>">
						<?php //storefront_cart_link(); ?>
						<a href="/index.php/cart/"><i class="material-icons">shopping_cart</i><span>CARRITO</span></a>
					</li>
					<li>
						<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</li>
				</ul>
				<ul class="header-links">
					<li class="link-item account-link">
						<a href="/index.php/mi-cuenta"><i class="material-icons">person</i><span>MI CUENTA</span></a>
					</li>
				</ul>
				<?php
			} else {
				?>
				<ul class="header-links">
					<li class="link-item account-link">
						<a href="/index.php/mi-cuenta"><i class="material-icons">person</i><span>INICIAR SESIÓN</span></a>
					</li>
				</ul>
				<?php
			}
		}
		?>
	</div>
	<?php
}

function storefront_featured_products_custom( $args ) {

	if ( storefront_is_woocommerce_activated() ) {

		$args = apply_filters( 'storefront_featured_products_args', array(
			'limit'      => 8,
			'columns'    => 4,
			'orderby'    => 'date',
			'order'      => 'desc',
			'visibility' => 'featured',
			'title'      => __( 'Productos destacados', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'products', apply_filters( 'storefront_featured_products_shortcode_args', array(
			'per_page'   => intval( $args['limit'] ),
			'columns'    => intval( $args['columns'] ),
			'orderby'    => esc_attr( $args['orderby'] ),
			'order'      => esc_attr( $args['order'] ),
			'visibility' => esc_attr( $args['visibility'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section class="storefront-product-section storefront-featured-products" aria-label="' . esc_attr__( 'Featured Products', 'storefront' ) . '">';

			do_action( 'storefront_homepage_before_featured_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			storefront_product_search();

			do_action( 'storefront_homepage_after_featured_products_title' );

			echo $shortcode_content;

			do_action( 'storefront_homepage_after_featured_products' );

			echo '</section>';

		}
		?>
		<script>
			jQuery(document).ready(function(){
				if ($(window).outerWidth()>768) {
					jQuery('.home .storefront-featured-products ul.products').owlCarousel({
						loop:true,
						margin:10,
						nav:true,
						autoplay:true,
						autoplayTimeout:5000,
						autoplayHoverPause:true,
						responsive:{
							0:{
								items:1
							},
							600:{
								items:3
							},
							1000:{
								items:4
							}
						}
					});
				}
			});
		</script>
		<?php
	}
}

function storefront_product_brands () {
	?>
	<section class="marca_home">
		<div class="bg">
			<span class="before scroll-navigation-button">arrow_drop_down</span>
			<span class="after scroll-navigation-button-bottom">arrow_drop_down</span>
		</div>
		<div class="tit"><h2>Nuestras marcas</h2></div>
		<div class="cont">
		<?php
		query_posts('post_type=marca_home&posts_per_page=-1');
		if(have_posts()) : while (have_posts()) : the_post();?>
			<div class="item">
				<a href="/index.php/shop/?filter_marca=<?php echo get_post_meta(get_the_ID(), 'marca_slug', true); ?>">
					<div style="background: url(<?php echo get_post_meta(get_the_ID(), 'imagen', true)["guid"]; ?>) no-repeat center center / cover" alt="<?php the_title(); ?>"></div>
				</a>
			</div>
		<?php $f++; endwhile; else:?>
			<h3>No se encontrararon marcas.</h3>
		<?php endif; ?>
		</div>
	</section>
	<?php
}


//ocultar sidebar
add_action('wp_head', 'hide_sidebar' );
add_action('wp_head', 'hide_prices' );

function hide_sidebar(){
	if((!is_shop() && !is_product_category()) || is_product()){
		?>
		<style type="text/css">
			#secondary, .comentarios {
				display: none;
			}
			#primary {
				width: 100%;
			}
		</style>
		<?php
	}
}

function hide_prices() {
	if (!is_user_logged_in()) {
		?>
		<style>
		.woocommerce .product .price.price, .woocommerce .product .onsale.onsale {
			display: none !important;
		}
		.add_to_cart_button {
			display: none;
		}
		</style>
		<?php
	} else {
		?>
		<style>
		section.parallax-home {
		    display: none;
		}
		</style>
		<?php
	}
}



function add_query_vars_filter( $vars ){
	$vars[] = "iddelpost";
	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

//para usar la variable escribir $camp=get_query_var("iddelpost", "0")


register_nav_menus( array(
	'menu' => 'Menu superior',
));


add_theme_support('post-thumbnails');
add_image_size('imagenTamaño1', 470, 300, true);
add_image_size('imagenTamaño2', 450, 370, true);



register_sidebar(array('name'=>'Sidebar', 'before_widget'=>'<section class="sidebarWidget">', 'after_widget'=>'</section>', 'before_title'=>'<h3>', 'after_title'=>'</h3>'));




function echoThemeUrl() {
	return str_replace("\\", "/", substr(getcwd(), strpos(getcwd(),"wordpress")+10));
}

function generar_imagenes_carpeta($ruta){ 
	 // crear archivo css a escribir 
	$text = "";
	 // abrir un directorio y listarlo recursivo 
	if (is_dir($ruta)) { 
		if ($dh = opendir($ruta)) { 
			while (($file = readdir($dh)) !== false) { 
			//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
			//mostraría tanto archivos como directorios 
			//echo "<br>Nombre de archivo: $ruta$file : Es un: " . filetype($ruta . $file); 
				if (is_dir($ruta . $file) == FALSE && $file!="." && $file!=".."){  
					echo "<a href='$ruta$file' data-lightbox='$ruta' data-title='$file'><img src='$ruta$file' width='300px' height='250px'></a>";
				}
			} 
		} 
		closedir($dh); 
	} 

	else 
		echo "<br>No es ruta valida"; 
}


//función para buscar en la base de datos y cargarlos para la página
//código en comenario para ejecutar esta función
//$result = mysqli_query($db, "SELECT * FROM $post ORDER BY id DESC");
//				while ($fila = mysqli_fetch_array($result)){ 
//				mostrarDatos($fila); 
function mostrarDatos ($resultados) {
	if ($resultados !=NULL) {
		$text .= "<div class='tituloMensajeTelefono'>" .ucfirst($resultados[2]). " " .ucfirst($resultados[3]). "</div>";
		$text .= "<div class='mensajeTelefono'>Email: " .$resultados[4]. "</br>";
		$text .= "Area: " .$resultados[5]. "</br>";
		$text .= "Tel: " .$resultados[8]. "</div>";
		$i ++;
	}
	else {$text .= "<br/>No hay más datos. <br/>";}
	return $text;
}
