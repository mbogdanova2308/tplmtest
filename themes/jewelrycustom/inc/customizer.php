<?php
/**
 * jewelrycustom Theme Customizer
 *
 * @package jewelrycustom
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jewelrycustom_customize_register( $wp_customize ) {
	 $wp_customize->add_setting('home_logo', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'my_customize_sanitize_home_logo',
    ));
 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'my_home_logo', array(
                'label'    => 'Home Logo',
                'settings' => 'home_logo',
                'section'  => 'title_tagline',
                'priority' => 50,
            )
        )
    );
}
add_action( 'customize_register', 'jewelrycustom_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jewelrycustom_customize_preview_js() {
	wp_enqueue_script( 'jewelrycustom-customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'jewelrycustom_customize_preview_js' );

/**
 * Sanitize home logo
 *
 * @param $input
 *
 * @return string
 */
function my_customize_sanitize_home_logo($input)
{
    error_log(attachment_url_to_postid($input));//debug
    return attachment_url_to_postid($input);
}

/**
 * Returns a custom footer image set in the WordPress Customizer
 *
 * @see get_custom_logo()   based on core function for the custom logo
 *
 * @param int $blog_id Optional. ID of the blog in question. Default is the ID of the current blog.
 *
 * @return string Custom logo markup.
 */
function get_home_logo($blog_id = 0)
{
    $html = '';
    $switched_blog = false;
 

    if ( is_multisite() && ! empty( $blog_id ) && get_current_blog_id() !== (int) $blog_id ) {
        switch_to_blog( $blog_id );
        $switched_blog = true;
    }
 
    $custom_logo_id = get_theme_mod('home_logo');

   




 
    if ($custom_logo_id) {
        $custom_logo_attr = array(
            'class' => 'home_logo',
            'loading' => false,
        );
 
        /*
         * If the image alt attribute is empty, get the site title and explicitly
         * pass it to the attributes used by wp_get_attachment_image().
         */
        $image_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
        if (empty($image_alt)) {
            $custom_logo_attr['alt'] = get_bloginfo('name', 'display');
        }

        /**
         * Filters the list of custom logo image attributes.
         *
         * @since 5.5.0
         *
         * @param array $custom_logo_attr Custom logo image attributes.
         * @param int   $custom_logo_id   Custom logo attachment ID.
         * @param int   $blog_id          ID of the blog to get the custom logo for.
         */
        $custom_logo_attr = apply_filters( 'get_custom_logo_image_attributes', $custom_logo_attr, $custom_logo_id, $blog_id );
 
 
        /*
         * If the alt attribute is not empty, there's no need to explicitly pass
         * it because wp_get_attachment_image() already adds the alt attribute.
         */
        $image = wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr );
        $html = sprintf(
            '<span class="custom-logo-link">%1$s</span>',
            $image
        );
    } elseif (is_customize_preview()) {
        // If no image is set but we're in the Customizer, leave a placeholder (needed for the live preview).
        $html = sprintf(
            '<span class="custom-logo-link" style="display:none;"><img class="custom-logo"/></span>',
            esc_url( home_url( '/' ) )
        );
    }
 
    if ($switched_blog) {
        restore_current_blog();
    }
 
    /**
     * Filters the custom footer image output
     *
     * @param string $html    Custom footer image HTML output
     * @param int    $blog_id ID of the blog to get the custom footer image for
     */
    return apply_filters('get_home_logo', $html, $blog_id);
}
