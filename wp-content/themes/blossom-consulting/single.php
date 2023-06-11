<?php
/**
 * The template for displaying all single posts
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
        <div class="wrap-content col-xl-8 col-lg-8 col-md-8">
            <h1><span class="line-heading"><?php the_title(); ?></span></h1>
            <?php the_excerpt(); ?>
        </div>
        <div class="wrap-image col-xl-4 col-lg-4 col-md-4">
            <?php echo get_the_post_thumbnail( $page->ID, 'full' ); ?>
        </div>
    </div>
</div>
<div class="container px-0 content-blog-post">
    <div class="row px-0">
        <div id="primary" class="content-area news-blog col-xl-9 pl-0">
            <main id="main" class="site-main">

            <?php
            while ( have_posts() ) : the_post(); 

                // get_template_part( 'template-parts/content', 'single' ); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php
                        /**
                         * @hooked blossom_coach_entry_header   - 15
                         * @hooked blossom_coach_post_thumbnail - 20
                        */
                        // do_action( 'blossom_coach_before_page_entry_content' );
                    
                        /**
                         * @hooked blossom_coach_entry_content - 15
                         * @hooked blossom_coach_entry_footer  - 20
                        */
                        do_action( 'blossom_coach_page_entry_content' );    
                    ?>
                </article><!-- #post-<?php the_ID(); ?> -->

            <?php endwhile; // End of the loop.
            ?>

            </main><!-- #main -->
            
            <?php
            /**
             * @hooked blossom_coach_author           - 15
             * @hooked blossom_coach_newsletter_block - 20
             * @hooked blossom_coach_navigation       - 25
             * @hooked blossom_coach_related_posts    - 30
             * @hooked blossom_coach_comment          - 35
            */
            do_action( 'blossom_coach_after_post_content' );
            
            ?>
            
        </div><!-- #primary -->
        <div class="col-xl-3">
           <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
