<?php if ($post_type === 'story') {

    $events = get_posts(array(
        'post_type' => 'event',
        'meta_query' => array(
            array(
                'key' => 'related_stories', 
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE'
            )
        )
    ));

} else if ($post_type === 'contributor') {

    $events = get_posts(array(
        'post_type' => 'event',
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

<?php if( empty( $events ) ) : ?>
        
<?php else : ?>

    <div id="related-events" class="related-content-section <?php echo $checkContentType ?>">

        <div class="related-content related-events-container">
    
            <h2>Related Events</h2>
            <ul>
                <?php foreach( $events as $event ) : setup_postdata($event); ?>
                    <?php                     
                        $display_title = get_the_title( $event ); 
                        $display_excerpt = get_the_excerpt( $event );
                        $display_permalink = get_permalink( $event );
                        $display_thumbail = get_the_post_thumbnail( $event, 'full' );// on the second param, you need to specify the size.
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
                            <a class="related-event-title-link" href="<?php echo $display_permalink; ?>">
                                <?php echo $display_title; ?>
                            </a>
                        </h3>
                        <p class="related-post-excerpt"><?php echo $display_excerpt; ?></p>
                        <a class="related-event-read-more-link" href="<?php echo $display_permalink; ?>">Read more &rarr;</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
    
<?php endif; ?>