<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jewelrycustom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'jewelrycustom' ); ?></a>

	<header id="header">
		<div class="logo">
			<?php if ( is_front_page() ) {
				echo get_home_logo();
			} else {
				the_custom_logo();
			} ?>
		
		</div><!-- .logo -->

		<nav class="main-menu" id="main-menu">
			
			<span class="opener"><span></span></span>
			<?php if( has_nav_menu( 'menu-1' ) )
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_class'     => 'primary-menu',
					'container'      => 'div',
					'container_class' => 'panel-header',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #header -->
