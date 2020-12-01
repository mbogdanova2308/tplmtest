/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	wp.customize('my_home_logo', function (value) {
	    value.bind(function (to) {
	        $('.footer-image').text(to);
	    });
	 });
}( jQuery ) );
