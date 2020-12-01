<?php
/*
Template Name: Home
*/
get_header(); the_post(); 
$gallery_title = get_field('gallery_title');
$instagram_url = get_field('instagram_url');
$pinterest_url = get_field('pinterest_url');
$facebook_url = get_field('facebook_url');
$cta = get_field('cta');
?>
		<main id="primary" class="site-home">
			<div class="main-content">
				<?php the_content(); ?>
			</div>
			<?php 
			if( $gallery_title ) {
			    echo '<p class="gallery-title">' . $gallery_title . '</p>';
			}
		    $images = acf_photo_gallery('gallery', $post->ID);
		    if( count($images) ): ?>
		    <div class="slider-gallery">
		        <?php foreach($images as $image):
		            $id = $image['id']; 
				?>
		
			    <div class="thumbnail">
			        <?php echo wp_get_attachment_image( $id, 'slider-gallery' ); ?>
			    </div>
			<?php endforeach; ?>
			</div>
			<?php endif; 
			if( $instagram_url || $pinterest_url || $facebook_url ) {
			    echo '<ul class="socials">';
			    	if ($instagram_url) echo '<li><a href=' . $instagram_url . '><i class="fab fa-instagram"></i></a></li>';
			   		if ($pinterest_url) echo '<li><a href=' . $pinterest_url . '><i class="fab fa-pinterest-p"></i></a></li>';
			    	if ($facebook_url) echo '<li><a href=' . $facebook_url . '><i class="fab fa-facebook-f"></i></a></li>';
			    echo '</ul>';
			}
			if ($cta) echo '<div class="cta">' . $cta . '</div>';
			?>
		</main>
<?php get_footer(); ?>