<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Contacto
 *
 * @package storefront
 */




get_header(); ?>

    <script>
		// Initialize and add the map
		function initMap() {
			var uluru = {lat: -31.389075, lng: -64.207393};
			var map = new google.maps.Map(document.getElementById('mapa-contacto'), {zoom: 15, center: uluru});
			var marker = new google.maps.Marker({position: uluru, map: map});
		}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6DvJqMWhHs4Rx4czZUs3Iw8-AW5U4iUo&callback=initMap"></script>


	<div id="primary" class="content-area" style="width: 100%">
		<main id="main" class="site-main" role="main">

			<div class="mapa-contacto" id="mapa-contacto"></div>

			<div class="content-cont">
				<?php while ( have_posts() ) : the_post();
					the_content();
				endwhile; ?>
			</div>

			<div class="form-cont">
				<div class="bg">
					<span class="before scroll-navigation-button">arrow_drop_down</span>
					<!-- <span class="after scroll-navigation-button-bottom">arrow_drop_down</span> -->
				</div>
				<form id="form-contacto" type="submit" action="javascript:void(0)">
					<div class="tit">Escríbenos ante cualquier consulta:</div>
					<?php if(!is_user_logged_in()) { ?>
						<div class="text">Si usted aún no es cliente, utilice el siguiente formulario para comunicarse con nosotros. Le brindaremos los datos necesarios para ingresar y poder acceder a nuestra tienda y lista de precios.</div>
					<?php } ?>
					<div class="inputForm"><label for="nombre">Nombre:</label><input type="text" placeholder="" name="nombre" id="nombre" required></div>
					<div class="inputForm"><label for="apellido">Apellido:</label><input type="text" placeholder="" name="apellido" id="apellido" required></div>
					<?php if(!is_user_logged_in()) { ?>
						<div class="inputForm"><label for="localidad">Localidad:</label><input type="text" placeholder="" name="localidad" id="localidad" required></div>
						<div class="inputForm"><label for="tel">Tel:</label><input type="text" placeholder="" name="tel" id="tel" required></div>
						<div class="inputForm"><label for="rubro">Rubro:</label><input type="text" placeholder="" name="rubro" id="rubro" required></div>
						<div class="inputForm"><label for="email">Email:</label><input type="text" placeholder="" name="email" id="email" required></div>
					<?php } ?>
					<div class="inputForm textarea-input"><label for="mensaje">Mensaje:</label><textarea placeholder="" name="mensaje" id="mensaje"></textarea></div>
					<div class="inputForm submit-btn"><input class="button" type="submit" name="Enviar" value="Enviar"></div>
				</form>
				<div class="contactoMensaje" style="display: none"></div>
			</div>


			<script>
				$(document).ready(function(){
					$("#form-contacto").submit(function(e){
						e.stopPropagation();
						e.preventDefault();
						$.ajax({
							url: "<?php echo get_stylesheet_directory_uri(); ?>/enviarForm.php", 
							data: $("#form-contacto").serialize(),
							error: function(xhr){
								console.log("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
							},
							success: function(result){
								var respuesta = result;
								$(".contactoMensaje").html(respuesta.message);
								$(".contactoMensaje").fadeIn();
								setTimeout(function(){
									$(".contactoMensaje").fadeOut();
								},3000);
							},
							dataType: "json"
						});
					});												
				});
			</script>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
