<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jewelrycustom
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_singular() ) : ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	<?php jewelrycustom_post_thumbnail(); ?>

	<?php if ( 'post' === get_post_type() ) :
		?>
		<div class="entry-meta">
			<?php
			jewelrycustom_posted_on();
			jewelrycustom_posted_by();
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php if ( !is_singular() ) 
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jewelrycustom' ),
					'after'  => '</div>',
				)
			);

		else :
			the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="btn"><?php esc_html_e( 'Read Post', 'jewelrycustom' ); ?></a>
		<?php endif; ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php jewelrycustom_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
