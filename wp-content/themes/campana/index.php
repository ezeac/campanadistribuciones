<html>
<head>
<?php get_header(); ?>
<?php wp_head() ?>
</head>
<body>


<div class="central">
CENTRAL


<section class="landing seccion col-xs-12></section>


<!-- para tipo personalizado -->
	<div class="contendorItemsLotes">
		<?php
		query_posts('post_type=lotes&posts_per_page=99');
		if(have_posts()) : while (have_posts()) : the_post();
		?>
			<a href="<?php echo types_render_field("imagen", array("url"=>true)); ?>" data-lightbox="<?php the_title(); ?>" style="background: url('<?php echo types_render_field("imagen", array("url"=>true)); ?>')"><i class="material-icons">search</i></a>
			<div class="tituloLote animacionLote"><h3><?php the_title(); ?></h3></div>
			<div class="textoLote animacionLote"><?php the_content(); ?></div>
			<div class="precioLote animacionLote">VALOR: €<?php echo types_render_field("precio", array("row"=>true)); ?>.</div>
			<div class="tituloLote animacionLote botonNegro linkAFormulario" onclick="$('#campo').val('<?php the_title(); ?>');">CONSULTAR</div>
		<?php $f++; endwhile; else: ?>
			<h1>
				No se encontraron lotes.
			</h1>
		<?php endif; ?>
		<div class="pagination">
			<?php next_posts_link('Post Siguientes') ?>
			<?php previous_posts_link('Post Anteriores') ?>
		</div>
	</div>
<!-- fin tipo personalizado -->


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



</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>