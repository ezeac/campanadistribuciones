<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Contacto
 *
 * @package storefront
 */




get_header(); ?>

	<div id="primary" class="content-area" style="width: 100%">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );

			endwhile; // End of the loop. ?>
			
			<div class="formularioContendor">
				<form id="formularioContenedorForm" type="submit" action="javascript:void(0)">
					<div class="inputForm fadeInUpOffsetNormalFormTexto"><input type="text" placeholder="Nombre*" name="nombre" id="nombre" required></div>
					<div class="inputForm fadeInUpOffsetNormalFormTexto"><input type="text" placeholder="Email*" name="email" id="email" required></div>
					<div class="inputForm fadeInUpOffsetNormalFormTexto"><input type="text" placeholder="Tel*" name="tel" id="tel" required></div>
					<div class="inputForm fadeInUpOffsetNormalFormTexto"><textarea placeholder="Consulta" name="mensaje" id="mensaje"></textarea></div>
					<div class="inputForm fadeInUpOffsetNormalFormTexto"><input type="submit" name="Enviar" value="Enviar"></div>
				</form>
				<div class="contactoMensaje"></div>
			</div>


			<script>
				$(document).ready(function(){
					$("#formularioContenedorForm").submit(function(e){
						e.stopPropagation();
						var nombre = $("#nombre").val();
					    var email = $("#email").val();
					    var tel = $("#tel").val();
					    var mensaje = $("#mensaje").val();
						if (nombre == ""){
							alert("Debe completar su nombre.");
							$("#nombre").focus();
						} else if (email == ""){
							alert("Debe completar su email.");
							$("#email").focus();
						} else {
							mostrarMensajeSalida(nombre, email, tel, mensaje);
						}

					});




					function mostrarMensajeSalida(nombre, email, tel, mensaje) {
					    var xmlhttp = new XMLHttpRequest();
					    xmlhttp.onreadystatechange = function() {
					        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					            $(".contactoMensaje").html(xmlhttp.responseText);
					        }
					    };
					    xmlhttp.open("GET", "<?php bloginfo("template_url"); ?>/enviarContacto.php?nombre=".concat(nombre, "&email=", email, "&tel=", tel, "&mensaje=", mensaje), true);
					    if (nombre != "" && email != ""){
					    	xmlhttp.send();
					    	$(".contactoMensaje").fadeIn();
					    	$("html,body").animate({"scrollTop":$(".contactoMensaje").offset().top-100});
					    }
					}													
				});
			</script>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
