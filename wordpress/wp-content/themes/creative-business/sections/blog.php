<?php
/**
 * Blog Section
 * 
 * @package Rara_Business
*/

/** Load default theme options */
$default_options =  rara_business_default_theme_options();

$show_blog   = get_theme_mod( 'ed_blog_section', $default_options['ed_blog_section'] );
$blogtitle   = get_theme_mod( 'blog_title', $default_options['blog_title'] );
$subtitle    = get_theme_mod( 'blog_description', $default_options['blog_description'] );
$hide_date   = get_theme_mod( 'ed_post_date_meta', $default_options['ed_post_date_meta'] );
$hide_author = get_theme_mod( 'ed_post_author_meta', $default_options['ed_post_author_meta'] );

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query( $args );

if( ( $qry->have_posts() || $blogtitle || $subtitle ) && $show_blog ){ ?>
    <section id="blog-section" class="blog-section wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
    	<div class="container">
    		<?php if( $blogtitle || $subtitle ){ ?>
            <header class="section-header">
    			<section class="widget widget_text">
    				<?php 
                        if( $blogtitle ) echo '<h2 class="widget-title">' . esc_html( $blogtitle )  . '</h2>';
                        if( $subtitle ) echo '<div class="textwidget">' . wpautop( wp_kses_post( $subtitle ) ) . '</div>';
                    ?>
    			</section>
    		</header>
    		<?php } ?>
            
            <?php if( $qry->have_posts() ){?>
            <div class="grid">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <article class="blog-post" itemscope itemtype="https://schema.org/Blog">
                    <div class="text-holder">
                        <div class="holder">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php 
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( 'rara-business-blog', 'itemprop=image' );                        
                                }else{
                                    echo '<img src="'. esc_url( get_template_directory_uri().'/images/rara-business-blog.jpg' ) .'" alt="'. the_title_attribute( 'echo=0' ) .'">';   
                                } 
                                ?>
                            </a>
                            <div class="article-holder">
                                 <div class="entry-meta">
                                    <?php 
                                        if( ! $hide_date ) rara_business_posted_on();
                                        if( ! $hide_author ) rara_business_posted_by();
                                    ?>
                                </div><!-- .entry-meta -->
                                <h3 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
    			</article>
    			<?php } wp_reset_postdata(); ?>
    		</div>
            <div class="blog-more">
                    <?php 
                        $post_page = get_option( 'page_for_posts' ); 
                            if ( $post_page && $post_page > 0 ) {
                                 echo '<a href="'. esc_url( get_permalink( $post_page ) ) .'" class="btn-readmore">'. esc_html__( 'View All Blog', 'creative-business' ) .'</a>';
                            }
                        ?>
            </div>
            <?php } ?>
    	</div>
    </section>
<?php
}