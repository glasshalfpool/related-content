<?php 
    $post_id = get_the_ID();
    $contributors = get_post_meta( $post_id, 'related_contributors', true );

    if( !is_array( $contributors ) )
        $contributors = [];

    if( !empty( $contributors ) ) {
        $contributors = get_posts( [ 
            'post_type' => 'contributor', 
            'post__in' => array_map( 'intval', $contributors ),
            'numberposts' => -1
        ] );

        // Filter contributors to only include those with role 'photographer'
        $photographers = [];
        foreach( $contributors as $contributor ) {
            $terms = get_the_terms($contributor->ID, 'contributor-type');
            if( $terms && !is_wp_error($terms) ) {
                foreach( $terms as $term ) {
                    if( $term->slug === 'photographers' ) {
                        $photographers[] = $contributor;
                        break; // No need to check other terms for this contributor
                    }
                }
            }
        }
        $contributors = $photographers; // Update contributors to only photographers
    }
?>

<?php if( empty( $contributors ) ) : ?>
    
<?php else : ?>

    <div class="related-content-section <?php echo $checkContentType ?>">

        <div class="related-content photgrapher-gallery-container">

            <h2>Collaborators</h2>
            <?php foreach( $contributors as $contributor ) : setup_postdata($contributor); ?>
                <?php                     
                    $display_title = get_the_title( $contributor ); 
                    $display_excerpt = get_the_excerpt( $contributor );
                    $display_permalink = get_permalink( $contributor );
                    $display_thumbail = get_the_post_thumbnail( $contributor, 'full' );// on the second param, you need to specify the size.
                    $contributor_role = get_field('contributor_role', $contributor);
                    $images = get_field('photographer_gallery', $contributor);
                ?>
                <ul>
                    <li>
                        <?php if( !empty( $display_thumbail ) ) : ?>
                            <figure>
                                <a href="<?php echo $display_permalink; ?>">
                                    <?php echo $display_thumbail; ?>
                                </a>
                            </figure>
                        <?php endif; ?>
                        <h3>
                            <a class="contributor-title-link" href="<?php echo $display_permalink; ?>">
                                <?php echo $display_title; ?>
                            </a>
                        </h3>
                        <p class="contributor-role"><?php echo $contributor_role; ?></p>
                        <p class="related-post-excerpt"><?php echo $display_excerpt; ?></p>
                        <a class="contributor-read-more-link" href="<?php echo $display_permalink; ?>">Read more &rarr;</a>
                    </li>
                </ul>
                <div class="photographer-swiper-container">
                    <div class="swiper-control-arrows">                    
                        <div class="custom-swiper-button-prev">&#8592;</div>
                        <div class="custom-swiper-button-next">&#8594;</div>                    
                    </div>
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach( $images as $image ): ?>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-image-container">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>  
                                    <p><?php echo esc_html($image['caption']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    </div>
                </div>  
                            
            <?php endforeach; ?>

        </div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    spaceBetween: 30,
    navigation: {
        nextEl: ".custom-swiper-button-next",
        prevEl: ".custom-swiper-button-prev",
      },
  });
</script>

</div>

<?php endif; ?>
