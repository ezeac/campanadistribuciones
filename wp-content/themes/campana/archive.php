<html>
<head>
<?php get_header(); ?>
<?php wp_head() ?>
</head>
<body>


<div class="central">
CENTRAL




<section class="landing seccion w3-col s12"></section>


<!-- MOSTRAR LISTADO DE ENTRADAS -->
<section class="seccion entradas">
	<!-- para mostrar los pos de una sola categoría -->
	<?php //query_posts('category_name=Sin Categoria'); ?>
	<?php single_cat_title($prefix = '', $display = true); ?>
	<?php if(have_posts()) : while (have_posts()) : the_post();?>
		<article>
			<a href="<?php the_permalink(); ?>">
			<?php 
				if (has_post_thumbnail()) {
					the_post_thumbnail('imagenTamaño1');
				} 
			?>	
			</a>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<div><?php the_date(); ?> <?php the_category(); ?></div>
			<div><?php the_excerpt(); ?></div>
		</article>
	<?php endwhile; else: ?>
		<h1>
			No se encontraron artículos
		</h1>
	<?php endif; ?>

	<div class="pagination">
		<?php next_posts_link('Post Siguientes') ?>
		<?php previous_posts_link('Post Anteriores') ?>
	</div>
</section>




</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".landing").css({"height":screen.availHeight-80});
		if(screen.availHeight+300>$(window).width()) {
			$(".landing").css({"height":screen.availHeight-80,"width":"auto"});
		} else {
			$(".landing").css({"height":"auto","width":$(window).width()});
		}
		$(window).resize(function(){
			$(".landing").css({"height":screen.availHeight-80});
			if(screen.availHeight+300>$(window).width()) {
				$(".landing").css({"height":screen.availHeight-80,"width":"auto"});
			} else {
				$(".landing").css({"height":"auto","width":$(window).width()});
			}
		})
	});
</script>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>