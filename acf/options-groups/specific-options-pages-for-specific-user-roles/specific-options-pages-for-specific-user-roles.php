<?php
add_action(
	'acf/init',
	function() {
		$roles = tt4c_get_current_user_roles();
		if ( in_array( 'administrator', $roles ) ) {// show if criteria is met
			acf_add_options_page(
				array(
					'page_title' => 'Settings for Specific User Roles',
					'menu_slug'  => 'settings-for-specific-user-roles',
					'position'   => '',
					'redirect'   => false,
				)
			);

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
