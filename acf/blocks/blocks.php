<?php
/**
 * Registers blocks automatically
 *
 * @return void
 */
function tt4c_register_blocks_automatically() {

	$directories = tt4c_get_first_level_directories( __DIR__ );

	foreach ( $directories as $dir ) {
		register_block_type( __DIR__ . '/' . $dir . '/block.json' );
	}
}
add_action( 'init', 'tt4c_register_blocks_automatically' );

//working on field groups.

/**
 * Checks if block name is contained in field group location rules.
 *
 * @param string $block_name The name of the block.
 * @param array  $post An array representing a post.
 * @return bool True if block name is contained in field group location rules, false otherwise.
 */
function tt4c_has_block_name_contained_field_group_locations( string $block_name, array $post ) {
	$or_locations = $post['location'];
	foreach ( $or_locations as $and_locations ) {
		foreach ( $and_locations as $location ) {
			if ( 'block' === $location['param'] && $block_name === $location['value'] ) {
				return true;
			}
		}
	}
	return false;
}

/**
 * Adjusts ACF JSON save paths based on block names.
 *
 * @param array $paths An array of ACF JSON save paths.
 * @param array $post An array representing a post.
 * @return array Modified array of ACF JSON save paths.
 */
function tt4c_auto_block_acf_json_save_paths( $paths, $post ) {
	$directories = tt4c_get_first_level_directories( __DIR__ );
	foreach ( $directories as $dir ) {
		$block_name = 'acf/' . $dir; // Assuming block names are postfixed with dir names.
		if ( tt4c_has_block_name_contained_field_group_locations( $block_name, $post ) ) {
			$paths = array( __DIR__ . '/' . $dir );
			break;
		}
	}
	return $paths;
}
add_filter( 'acf/json/save_paths', 'tt4c_auto_block_acf_json_save_paths', 10, 2 );

/**
 * Adjusts ACF JSON load points based on block names.
 *
 * @param array $paths An array of ACF JSON load points.
 * @return array Modified array of ACF JSON load points.
 */
function tt4c_auto_block_acf_json_load_point( $paths ) {
	// Append the new path and return it.
	$directories = tt4c_get_first_level_directories( __DIR__ );
	foreach ( $directories as $dir ) {
		$paths[] = __DIR__ . '/' . $dir;
	}
	return $paths;
}
add_filter( 'acf/settings/load_json', 'tt4c_auto_block_acf_json_load_point' );
