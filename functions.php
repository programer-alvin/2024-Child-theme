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

// Function to require all PHP files recursively in a given directory
function tt4c_require_all_PHP_files_recursively($directory) {
    // Create a RecursiveIteratorIterator for the given directory
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    // Use a RegexIterator to filter out only PHP files
    $phpFiles = new RegexIterator($iterator, '/\.php$/');

    // Loop through each PHP file and require_once to include it
    foreach ($phpFiles as $phpFile) {
        require_once $phpFile->getPathname();
    }
}

// Function to get the roles of the currently logged-in user
function tt4c_get_current_user_roles() {
    // Check if the user is logged in
    if (is_user_logged_in()) {

        // Get the current user object
        $user = wp_get_current_user();

        // Get the roles assigned to the user as an array
        $roles = (array) $user->roles;

        // Return the array of user roles
        return $roles; // This will return an array

    } else {
        // If the user is not logged in, return an empty array
        return array();
    }
}

// Set the current directory path
$current_dir_path = __DIR__;

// Require PHP files in first-level directories automatically
tt4c_require_first_level_directory_named_like_files_automatically( $current_dir_path );
