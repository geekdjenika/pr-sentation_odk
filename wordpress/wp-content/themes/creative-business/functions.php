<?php
/**
 * Theme functions and definitions
 *
 * @package Creative_Business
 */

/**
 * After setup theme hook
 */
function creative_business_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'creative-business', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'creative_business_theme_setup' );

/**
 * Load assets.
 */
function creative_business_enqueue_styles() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];
    
    wp_enqueue_style( 'rara-business-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'creative-business-style', get_stylesheet_directory_uri() . '/style.css', array( 'rara-business-style' ), $version );
    wp_enqueue_style( 'creative-business-google-fonts', creative_business_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'creative_business_enqueue_styles' );

/**
 * Register custom fonts.
 */
function creative_business_fonts_url(){
    $fonts_url = '';

    /* 
     * Translators: If there are characters in your language that are not
     * supported by Open Sans fonts, translate this to 'off'. Do not translate
     * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'creative-business' );
    
    /* 
     * Translators: If there are characters in your language that are not
     * supported by Source Sans Pro fonts, translate this to 'off'. Do not translate
     * into your own language.
    */
    $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'creative-business' );

    if ( 'off' !== $open_sans || 'off' !== $source_sans_pro ) {
        $font_families = array();

        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i';

        }

        if ( 'off' !== $source_sans_pro ) {
            $font_families[] = 'Source Sans Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i';

        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'subset'  => urlencode( 'latin,latin-ext' ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}

/**
 * Customizer Scripts
 */
function creative_business_customizer_script(){
    wp_enqueue_script( 'creative-business-customize-controls', get_stylesheet_directory_uri() . '/inc/js/customize-controls.js', array( 'jquery', 'customize-controls' ), false, true  );
}
add_action( 'customize_controls_enqueue_scripts', 'creative_business_customizer_script', 11 );

/**
 * Creative Business Header Image
 */
function creative_business_custom_header_args_callback(){
    $default_image = array(
        'default-image'    => get_stylesheet_directory_uri().'/images/banner-img.jpg',
    ); 
    return $default_image;
}
add_filter( 'rara_business_custom_header_args', 'creative_business_custom_header_args_callback' );

/**
 * Modifiy customizer control from child theme
 */
function creative_business_customizer_register_controls( $wp_customize ) {

    // Remove controls
    $wp_customize->remove_control('ed_header_contact_details');
    $wp_customize->remove_control('header_phone');
    $wp_customize->remove_control('header_address');
    $wp_customize->remove_control('header_email');
 
}
add_action( 'customize_register', 'creative_business_customizer_register_controls', 15 );

function rara_business_header(){ 
    $default_options   = rara_business_default_theme_options(); // Get default theme options
    $icon              = get_theme_mod( 'custom_link_icon', $default_options['custom_link_icon'] );
    $label             = get_theme_mod( 'custom_link_label', $default_options['custom_link_label'] );
    $ed_header_social  = get_theme_mod( 'ed_header_social_links', $default_options['ed_header_social_links'] );
    $social_links      = get_theme_mod( 'header_social_links', $default_options['header_social_links'] );
    $link              = get_theme_mod( 'custom_link', $default_options['custom_link'] );
    ?>
    
    <header id="masthead" class="site-header" itemscope itemtype="https://schema.org/WPHeader">
        <?php 
            if( ! ( $link && $label ) && ! ( $ed_header_social && ! empty( $social_links ) ) ){ 
                $class = ' hide-header-top';
            } else {
                $class ='';
            }
        ?>
        <div class="header-t<?php echo esc_attr( $class ); ?>">
            <div class="container">
                <?php 
                    rara_business_social_links( $ed_header_social, $social_links );

                    if( $link && $label ){ ?>
                        <div class="inquiry-btn">
                            <?php rara_business_custom_link( $icon, $link, $label ); ?>
                        </div>
                        <?php 
                    } 
                ?>
                <button id="primary-toggle-button" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            
            <div class="responsive-menu-holder">
                <div class="container">
                    <nav id="mobile-site-navigation" class="main-navigation mobile-navigation">        
                        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"><i class = "fas fa-times"> </i></button>
                            <div class= "social-networks-holder">
                                <div class="container">
                                    <?php rara_business_social_links( $ed_header_social, $social_links ); ?>
                                </div>
                            </div>

                            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'creative-business' ); ?>">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'primary',
                                        'menu_id'        => 'mobile-primary-menu',
                                        'menu_class'     => 'nav-menu main-menu-modal',
                                        'container'      => false,
                                        'fallback_cb'    => 'rara_business_primary_menu_fallback',
                                    ) );
                                ?>
                                <?php if( $link && $label ) rara_business_custom_link( $icon, $link, $label ); ?>
                            </div>
                            
                        </div>
                    </nav><!-- #mobile-site-navigation -->
                    
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container">
                <?php 
                    $display_header_text = get_theme_mod( 'header_text', 1 );
                    $site_title          = get_bloginfo( 'name', 'display' );
                    $description         = get_bloginfo( 'description', 'display' );

                    if( ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) && $display_header_text && ( ! empty( $site_title ) || ! empty(  $description  ) ) ){
                       $branding_class = ' logo-with-site-identity';                                                                                                                          
                    } else {
                        $branding_class = '';
                    }
                ?>
                <div class="site-branding<?php echo esc_attr( $branding_class ); ?>" itemscope itemtype="https://schema.org/Organization">
                    <?php 
                        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                            the_custom_logo();
                        } 

                        echo '<div class="text-logo">';
                            if( is_front_page() ){ ?>
                                <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php } else { ?>
                                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                            <?php
                            }

                            if ( $description || is_customize_preview() ){ ?>
                                <p class="site-description" itemprop="description"><?php echo $description; ?></p>
                            <?php
        
                            }
                        echo '</div><!-- .text-logo -->';
                    ?>
                </div>
                <div class="right">
                    <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'fallback_cb'    => 'rara_business_primary_menu_fallback',
                        ) );
                    ?>
                </nav><!-- #site-navigation -->
                </div>
            </div>
        </div>
    </header>
    <?php 
}

/**
 * Creative Business Theme Info
 */
function creative_business_customizer_theme_info( $wp_customize ) {
    
    $wp_customize->add_section( 'theme_info_section', array(
        'title'       => __( 'Demo & Documentation' , 'creative-business' ),
        'priority'    => 6,
    ) );
    
    /** Important Links */
    $wp_customize->add_setting( 'theme_info_setting',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';

    /* translators: 1: string, 2: preview url, 3: string */
    $theme_info .= sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Demo Link : ', 'creative-business' ), esc_url( __( 'https://rarathemes.com/previews/?theme=creative-business', 'creative-business' ) ), esc_html__( 'Click here.', 'creative-business' ) );

    $theme_info .= '</p><p>';

    /* translators: 1: string, 2: documentation url, 3: string */
    $theme_info .= sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Documentation Link : ', 'creative-business' ), esc_url( 'https://docs.rarathemes.com/docs/creative-business/' ), esc_html__( 'Click here.', 'creative-business' ) );

    $theme_info .= '</p>';

    $wp_customize->add_control( new Rara_Business_Note_Control( $wp_customize,
        'theme_info_setting', 
            array(
                'section'     => 'theme_info_section',
                'description' => $theme_info
            )
        )
    );
}
add_action( 'customize_register', 'creative_business_customizer_theme_info', 15 );

/**
 * Add demo content info
 */
function creative_business_customizer_demo_content( $wp_customize ) {
        
    $wp_customize->add_section( 'demo_content_section' , array(
        'title'       => __( 'Demo Content Import' , 'creative-business' ),
        'priority'    => 7,
        ));
        
    $wp_customize->add_setting(
        'demo_content_instruction',
        array(
            'sanitize_callback' => 'wp_kses_post'
        )
    );

    /* translators: 1: string, 2: url, 3: string */
    $demo_content_description = sprintf( '%1$s<a class="documentation" href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Creative Business comes with demo content import feature. You can import the demo content with just one click. For step-by-step video tutorial, ', 'creative-business' ), esc_url( 'https://rarathemes.com/blog/import-demo-content-rara-themes/' ), esc_html__( 'Click here', 'creative-business' ) );


    $wp_customize->add_control(
        new Rara_Business_Note_Control( 
            $wp_customize,
            'demo_content_instruction',
            array(
                'section'       => 'demo_content_section',
                'description'   => $demo_content_description
            )
        )
    );

    $theme_demo_content_desc = '';
    
    $theme_demo_content_desc .= '<span class="sticky_info_row download-link"><label class="row-element">' . __( 'Download Demo Content', 'creative-business' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/creative-business-documentation/theme-installation-activation/how-to-import-demo-content/' ) . '" target="_blank">' . __( 'Click here', 'creative-business' ) . '</a></span><br />';
    
    if( ! class_exists( 'RDDI_init' ) ) {
        $theme_demo_content_desc .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Plugin required', 'creative-business' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/plugins/rara-one-click-demo-import/' ) . '" target="_blank">' . __( 'Rara One Click Demo Import', 'creative-business' ) . '</a></span><br />';
    }

    $wp_customize->add_setting( 'theme_demo_content_info',array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        ));

    // Demo content 
    $wp_customize->add_control( new Rara_Business_Note_Control( $wp_customize ,'theme_demo_content_info',array(
        'section'     => 'demo_content_section',
        'description' => $theme_demo_content_desc
        )));

}
add_action( 'customize_register', 'creative_business_customizer_demo_content', 15 );

/**
 * Footer Bottom
*/
function rara_business_footer_bottom(){ ?>
    <div class="footer-b">      
        <?php
            rara_business_get_footer_copyright();
            echo '<span class="by">';
            echo esc_html__( 'Creative Business | Developed By ', 'creative-business' ); 
            echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'creative-business' ) . '</a>.';
            echo '</span>';
            
            /* translators: 1: poweredby, 2: link, 3: span tag closed  */
            printf( esc_html__( ' %1$sPowered by %2$s%3$s', 'creative-business' ), '<span class="powered-by">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'creative-business' ) ) .'" target="_blank">WordPress</a>.', '</span>' );

            if ( function_exists( 'the_privacy_policy_link' ) ) {
                the_privacy_policy_link( '<span class="policy_link">', '</span>');
            }
        ?>      
    </div>
    <?php
}
/**
 * Creative Business Sorting
*/
function creative_business_frontpage_sections_sorting(){
    $sections = array( 
        'services'    => array( 'sidebar' => 'services' ), 
        'about'       => array( 'sidebar' => 'about' ), 
        'choose-us'   => array( 'sidebar' => 'choose-us' ), 
        'client'      => array( 'sidebar' => 'client' ),
        'testimonial' => array( 'sidebar' => 'testimonial' ), 
        'stats'       => array( 'sidebar' => 'stats' ), 
        'team'        => array( 'sidebar' => 'team' ), 
        'blog'        => array( 'section' => 'blog' ), 
        'portfolio'   => array( 'section' => 'portfolio' ), 
        'cta'         => array( 'sidebar' => 'cta' ), 
        'faq'         => array( 'sidebar' => 'faq' )
    );

    $enabled_section = array();
    
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $v['sidebar'] );
        }else{
            if( get_theme_mod( 'ed_' . $v['section'] . '_section', true ) ) array_push( $enabled_section, $v['section'] );
        }
    }  
    return $enabled_section;
}
add_filter( 'rara_business_home_sections','creative_business_frontpage_sections_sorting' );

/**
 * Filter to add bg color of cta section widget
 */    
function creative_business_cta_section_bgcolor_filter(){
    return '#588af0';
}
add_filter( 'rrtc_cta_bg_color', 'creative_business_cta_section_bgcolor_filter', 11 );