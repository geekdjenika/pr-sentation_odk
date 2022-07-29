jQuery(document).ready(function($) {
	/* Move widgets to their respective sections */
	wp.customize.section( 'sidebar-widgets-services' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-services' ).priority( '50' );

    wp.customize.section( 'sidebar-widgets-about' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-about' ).priority( '55' );
    
    wp.customize.section( 'sidebar-widgets-choose-us' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-choose-us' ).priority( '60' );

    wp.customize.section( 'sidebar-widgets-client' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-client' ).priority( '65' );

    wp.customize.section( 'sidebar-widgets-testimonial' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).priority( '70' );

    wp.customize.section( 'sidebar-widgets-stats' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-stats' ).priority( '75' );

    wp.customize.section( 'sidebar-widgets-team' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-team' ).priority( '80' );

    wp.customize.section( 'blog_section' ).panel( 'frontpage_panel' );
    wp.customize.section( 'blog_section' ).priority( '85' );

    wp.customize.section( 'portfolio_section' ).panel( 'frontpage_panel' );
    wp.customize.section( 'portfolio_section' ).priority( '90' );

    wp.customize.section( 'sidebar-widgets-cta' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-cta' ).priority( '95' );

    wp.customize.section( 'sidebar-widgets-faq' ).panel( 'frontpage_panel' );
    wp.customize.section( 'sidebar-widgets-faq' ).priority( '100' );
    
});