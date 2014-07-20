<?php
/*
Plugin Name: Cookie Consent
Plugin URI: http://wordpress.org/extend/plugins/cookie-consent
Description: Displays an unobtrusive cookie information bar when a user first visits the site.
Version: 1.1.1
Author: Stefan Senk, Draekko
Author URI: http://www.senktec.com
License: GPL2


Copyright 2014  Stefan Senk  (email : info@senktec.com)
                Draekko (draekko.software@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the  warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once plugin_dir_path(__FILE__) . 'cc-admin.php';
register_activation_hook(__FILE__, 'cc_activation');

add_action('wp_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery' );

	wp_register_script('jquery_cookie_js', plugins_url('jquery.cookie.js', __FILE__ ));
	wp_enqueue_script('jquery_cookie_js');

	wp_register_script('_cookie_consent_js', plugins_url('cookie-consent.js', __FILE__ ));
	wp_enqueue_script('_cookie_consent_js');

	wp_register_style('_cookie_consent_css', plugins_url('cookie-consent.css', __FILE__ ));
	wp_enqueue_style('_cookie_consent_css');
});

add_action('wp_footer', function(){
	$options = get_option( '_cookie_consent' );
	$html = '<div id="cc_message" style="background-color: ' . $options['bgcolor'] . ';">' . do_shortcode( $options['message'] ) . '</div>';
	echo apply_filters('cc_message_html', $html);
});

add_shortcode('cc_dismiss', function() {
	$html = '<span class="cc_dismiss_button">&#9746;</span>';
	return apply_filters('cc_dismiss_button', $html);
});

add_shortcode('cc_delete', function() {
	$html = '<span class="cc_delete_button">' . __('Delete cookies and leave', 'cookie-consent' ) . '</span>';
	return apply_filters('cc_delete_button', $html);
});

