<?php

$current_post_id = get_the_ID();

// Arguments for WP_Query
$args = array(
    'post_type' => 'story',  // Custom post type 'story'
    'posts_per_page' => -1,  // Retrieve all posts (-1 means no limit)
    'post__not_in'   => array( $current_post_id ),  // Exclude current post
);

// Create a new query
$story_query = new WP_Query( $args );

// Check if there are any posts
if ( $story_query->have_posts() ) {
    // Loop through the posts
    ?>
    <div class="related-content-section <?php echo $checkContentType ?>">
        <div class="swiper-control-arrows">                    
            <div class="custom-swiper-button-prev">&#8592;</div>
            <div class="custom-swiper-button-next">&#8594;</div>                    
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            <?php
            while ( $story_query->have_posts() ) {
                $story_query->the_post();
                ?>        
                <div class="swiper-slide">
                    <div class="swiper-slide-story-container">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('full'); ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                            <a class="read-story-link" href="<?php the_permalink(); ?>">Read story</a>
                        </a>
                    </div>        
                </div>        
            <?php
            } ?>
            </div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 20,
        navigation: {
            nextEl: ".custom-swiper-button-next",
            prevEl: ".custom-swiper-button-prev",
        },
    });
    </script>

<?php    
} else {
    // No posts found
    echo 'No stories found.';
}

// Reset Post Data
wp_reset_postdata();
?>