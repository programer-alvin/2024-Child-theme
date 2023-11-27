<?php
add_action(
	'acf/init',
	function() {
		// Get current user roles using a custom function
		$roles = tt4c_get_current_user_roles();

		// Check if the user has the 'administrator' role (show if criteria is met)
		if ( in_array( 'administrator', $roles ) ) {

			// Add options page for specific user roles
			acf_add_options_page(
				array(
					'page_title' => 'Settings for Specific User Roles',
					'menu_slug'  => 'settings-for-specific-user-roles',
					'position'   => '',
					'redirect'   => false,
				)
			);

			// Add sub-page under 'Settings for Specific User Roles'
			acf_add_options_page(
				array(
					'page_title'  => 'Sub Page',
					'menu_slug'   => 'sub-page',
					'parent_slug' => 'settings-for-specific-user-roles',
					'position'    => '',
					'redirect'    => false,
				)
			);
		}
	}
);
