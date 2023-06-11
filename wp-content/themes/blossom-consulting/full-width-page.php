<?php /* 
* Template Name: Full Width Page
* Template Post Type: page
*/ 
do_action( 'blossom_coach_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked blossom_coach_head
    */
    do_action( 'blossom_coach_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php

    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked blossom_coach_page_start - 20 
    */
    do_action( 'blossom_coach_before_header' );
    
    /**
     * Header
     * 
     * @hooked blossom_coach_top_bar - 15
     * @hooked blossom_coach_header  - 20     
    */
    do_action( 'blossom_coach_header' );
    
    /**
     * Before Content
     * @hooked blossom_coach_blog_banner
    */
    do_action( 'blossom_coach_after_header' );
    
    /**
     * Content
     * 
     * @hooked blossom_coach_content_start
    */
    // do_action( 'blossom_coach_content' );
    
?>
<div class="banner-custom container-fluid">
    <div class="row">
        <div class="wrap-content col-xl-6 col-lg-6 col-md-6">
            <h1><span class="line-heading"><?php the_title(); ?></span></h1>
            <?php 
            if ( ! has_excerpt() ) {
                echo '';
            } else { 
                the_excerpt();
            }
            ?>
        </div>
        <div class="wrap-image col-xl-6 col-lg-6 col-md-6">
            <?php echo get_the_post_thumbnail( $page->ID, 'full' ); ?>
        </div>
    </div>
</div>
<section id="client_section" class="client-section custom-page">
	<div class="wrapper">

			<?php
			while ( have_posts() ) : the_post();
				
                do_action( 'blossom_coach_posts_entry_content' );
                
			endwhile; // End of the loop.
			?>
        
	</div>
    <section id="" class="widget_blossomtheme_companion_cta_widget style-btn">        
        <div class="blossomtheme-cta-container">
            <div class="button-wrap">
                <a target="_self" href="/contact/" class="btn-cta btn-1">CONTACT US TODAY</a>					</div>
            </div>
        </div> 
    </section>
</section>
<div class="custom-breadcrumb"><?php if ( ! is_front_page() && ! is_home() ) blossom_coach_breadcrumb(); ?></div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
get_footer();