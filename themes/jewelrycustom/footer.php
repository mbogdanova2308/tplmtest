<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jewelrycustom
 */

?>
	<?php if ( !is_front_page() ) { ?>
	<footer id="footer">
		<?php the_custom_logo(); ?>
		<?php if( has_nav_menu( 'menu-2' ) )
		wp_nav_menu(
			array(
				'theme_location' => 'menu-2',
				'menu_class'     => 'footer-menu',
				'container'      => false,
			)
		);
		?>
		<div class="footer-sidebar"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
	</footer><!-- #footer -->
	<?php } ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
