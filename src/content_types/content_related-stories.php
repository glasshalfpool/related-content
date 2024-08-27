<?php if (($post_type === 'event') || ($post_type === 'post')) {
    
    $post_id = get_the_ID();
    $stories = get_post_meta( $post_id, 'related_stories', true );

    if( !is_array( $stories ) )
        $stories = [];

    if( !empty( $stories ) ) {
        $stories = get_posts( [ 'post_type' => 'story', 'post__in' => array_map( 'intval', $stories ) ] );
    }

} else if ($post_type === 'contributor') {

    $stories = get_posts(array(
        'post_type' => 'story',
        'meta_query' => array(
            array(
                'key' => 'related_contributors', 
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE'
            )
        )
    ));

}

?>

<?php if( empty( $stories ) ) : ?>
        
<?php else : ?>

    <div id="related-stories" class="related-content-section <?php echo $checkContentType ?>">
        <div class="related-content related-stories-container">
            
            <ul>
                <?php foreach( $stories as $story ) : setup_postdata($story); ?>
                    <?php                     
                        $display_title = get_the_title( $story ); 
                        $display_excerpt = get_the_excerpt( $story );
                        $display_permalink = get_permalink( $story );
                        $display_thumbail = get_the_post_thumbnail( $story, 'full' );// on the second param, you need to specify the size.
                    ?>
                    <li>
                        <?php if( !empty( $display_thumbail ) ) : ?>
                            <figure>
                                 <?php echo $display_thumbail; ?>
                            </figure>
                        <?php endif; ?>
                        <div class="related-story-content">
                            
                            <h2>Related Stories</h5>
                            <h2>
                                <a class="related-story-title-link" href="<?php echo $display_permalink; ?>">
                                    <?php echo $display_title; ?>
                                </a>
                            </h2>
                            <p class="related-post-excerpt"><?php echo $display_excerpt; ?></p>
                            <a class="related-story-read-more-link wp-block-button__link wp-element-button" href="<?php echo $display_permalink; ?>">Read Story &rarr;</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>    

<?php endif; ?>