<?php
if ( get_field( 'is_example' ) ) {
	/* Render preview screenshot/html on this section*/
	if ( array_key_exists( 'example', $block ) ) {
		$example = $block['example'];
		if ( array_key_exists( 'attributes', $example ) ) {
			$attributes = $example['attributes'];
			if ( array_key_exists( 'cover', $attributes ) ) {
				$cover = $attributes['cover'];
			}
		}
	}

	if ( $cover ) {
		echo '<img src="' . $cover . '" alt="block-preview-screenshot">';
	}
} else {
	// Render live block HTML on this section
	if ( ! $is_preview ) {
		// Restrict block output (front-end only).
	}
	echo 'Auto block 1 content ';
}

