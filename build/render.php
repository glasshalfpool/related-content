<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
	
	<?php
		$post_type = get_post_type();
		$checkContentType = $attributes['contentType'];
	?>	
		
	<?php
		if ($checkContentType == 'content-type-contributors') {
			include("content_types/content_related-contributors.php");
		} else if ($checkContentType == 'content-type-events') {
			include("content_types/content_related-events.php");
		} else if ($checkContentType == 'content-type-stories') {
			include("content_types/content_related-stories.php");
		} else if ($checkContentType == 'content-type-gallery') {
			include("content_types/content_photographer-gallery.php");
		}
	?>
	
</div>