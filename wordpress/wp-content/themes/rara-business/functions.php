<?php
/**
 * Rara Business functions 
 * 
 * @package Rara_Business
 */

$rara_business_theme_data = wp_get_theme();
if( ! defined( 'RARA_BUSINESS_THEME_VERSION' ) ) define( 'RARA_BUSINESS_THEME_VERSION', $rara_business_theme_data->get( 'Version' ) );
if( ! defined( 'RARA_BUSINESS_THEME_NAME' ) ) define( 'RARA_BUSINESS_THEME_NAME', $rara_business_theme_data->get( 'Name' ) );
if( ! defined( 'RARA_BUSINESS_THEME_TEXTDOMAIN' ) ) define( 'RARA_BUSINESS_THEME_TEXTDOMAIN', $rara_business_theme_data->get( 'TextDomain' ) );

/**
 * Implement the Custom Functions
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Custom independent extra functions for this theme.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

if(  rara_business_is_rara_theme_companion_activated() ) :
	/**
	 * Modify filter hooks of RTC plugin.
	 */
	require get_template_directory() . '/inc/rtc-filters.php';
endif;

/**
 * Fontawesome
 */
require get_template_directory() . '/inc/fontawesome.php';

/**
 * Customizer Custom controls.
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Load Sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Customizer default theme options.
 */
require get_template_directory() . '/inc/customizer/default-theme-options.php';

/**
 * Customizer selective refresh.
 */
require get_template_directory() . '/inc/customizer/selective-refresh.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Metabox additions.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Widgets addition.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * TGMPA Plugin Recommendation
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';


if ( rara_business_is_woocommerce_activated() ) :
	/**
	 * Load woocommerce
	 */
	require get_template_directory() . '/inc/woocommerce-functions.php';
endif;