<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer class="site-footer" role="contentinfo">
		<div class="grid">

			<div class="logo" style="background: url(<?php echo get_stylesheet_directory_uri() ?>/imagenes/logos/logo_campana_footer.jpg) no-repeat center center / contain"></div>
			<div class="tel">Llámenos: 488 6745 / 487 6928</div>
			<div class="text">Córdoba, Argentina<br>Horarios de atención: Lunes a Viernes de 8:00 a 18:00 hs. y Sábados de 9:00 a 12:00 hs.</div>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
