<?php if ($post_type === 'story') {

$posts = get_posts(array(
    'post_type' => 'post',
    'meta_query' => array(
        array(
            'key' => 'related_stories', 
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE'
        )
    )
));

} else if ($post_type === 'contributor') {

$posts = get_posts(array(
    'post_type' => 'post',
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

<?php if( empty( $posts ) ) : ?>
    
<?php else : ?>

<div id="related-posts" class="related-content-section <?php echo $checkContentType ?>">

    <div class="related-content related-posts-container">

        <h2>Related News</h2>
        <ul>
            <?php foreach( $posts as $post ) : setup_postdata($post); ?>
                <?php                     
                    $display_title = get_the_title( $post ); 
                    $display_excerpt = get_the_excerpt( $post );
                    $display_permalink = get_permalink( $post );
                    $display_thumbail = get_the_post_thumbnail( $post, 'full' );// on the second param, you need to specify the size.
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
                        <a class="related-posts-title-link" href="<?php echo $display_permalink; ?>">
                            <?php echo $display_title; ?>
                        </a>
                    </h3>                    
                    <p class="related-post-excerpt"><?php echo $display_excerpt; ?></p>
                    <a class="related-post-read-more-link" href="<?php echo $display_permalink; ?>">Read more &rarr;</a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>

<?php endif; ?>