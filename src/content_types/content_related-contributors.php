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
    }
?>

<?php if( empty( $contributors ) ) : ?>
    
<?php else : ?>

    <div id="related-contributors" class="related-content-section <?php echo $checkContentType ?>">

        <div class="related-content related-contributors-container">

            <h2>Collaborators</h2>
            <ul>
                <?php foreach( $contributors as $contributor ) : setup_postdata($contributor); ?>
                    <?php                     
                        $display_title = get_the_title( $contributor ); 
                        $display_excerpt = get_the_excerpt( $contributor );
                        $display_permalink = get_permalink( $contributor );
                        $display_thumbail = get_the_post_thumbnail( $contributor, 'full' );// on the second param, you need to specify the size.
                        $contributor_role = get_field('contributor_role', $contributor);
                    ?>
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
                        <p class="related-post-excerpt">
                            <?php
                                $max_length = 80; // Set your desired character limit here
                                if (strlen($display_excerpt) > $max_length) {
                                    $display_excerpt = substr($display_excerpt, 0, $max_length) . '...';
                                }
                                echo $display_excerpt;
                            ?>
                        </p>
                        <a class="contributor-read-more-link" href="<?php echo $display_permalink; ?>">Read more &rarr;</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

<?php endif; ?>