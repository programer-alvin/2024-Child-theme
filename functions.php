<?php
/**
 * Retrieves first level directories
 *
 * @param string $dir_path The path to the directory.
 * @param array  $exclude_dir_items An array of items to exclude from the result.
 * @return array An array of directories.
 */
function tt4c_get_first_level_directories( string $dir_path, array $exclude_dir_items = array( '.', '..' ) ) {
	return array_filter(
		scandir( $dir_path ),
		function ( $item ) use ( $dir_path, $exclude_dir_items ) {
			return is_dir( $dir_path . '/' . $item ) && ! in_array( $item, $exclude_dir_items );
		}
	);
}

/**
 * Requires PHP files in first-level directories automatically.
 *
 * @param string $current_dir_path The path to the current directory.
 */
function tt4c_require_first_level_directory_named_like_files_automatically( string $current_dir_path ) {
	// Directories to exclude from the automatic file inclusion
	$exclude_directories = array( '.', '..', '.vscode', 'templates', '.git' );

	// Get first-level directories
	$directories = tt4c_get_first_level_directories( $current_dir_path, $exclude_directories );

	// Require PHP files in each directory
	foreach ( $directories as $dir ) {
		require_once $current_dir_path . '/' . $dir . '/' . $dir . '.php';
	}
}

// Set the current directory path
$current_dir_path = __DIR__;

// Require PHP files in first-level directories automatically
tt4c_require_first_level_directory_named_like_files_automatically( $current_dir_path );
