<?php
/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
function menu_locations()
{
	register_nav_menus(
		array(
			'header-menu'	=>	__('Header Menu'),
			'sideout-menu'	=>	__('Sideout Menu'),
		)
	);
}

add_action('init', 'menu_locations');


function header_menu()
{
	$menuLocations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php)
	// This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);

	$menuID = $menuLocations['header-menu']; // Get the *primary* menu ID


	$header_menu = wp_get_nav_menu_items($menuID); // Get the array


	$html = '<nav class="navbar position-static p-0">';
	$html .= '<ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0">';
	$menus_array = array();
	foreach ($header_menu as $menu) {
		$title = $menu->title;
		$ID = $menu->ID;
		$url = $menu->url;
		$menu_item_parent = $menu->menu_item_parent;
		$menus_array[] = array(
			'menu_item_parent' => $menu_item_parent,
			'title' => $title,
			'ID' => $ID,
			'url' => $url,
		);
	}

	foreach ($menus_array as $menu) {
		$ID = $menu['ID'];
		$menu_item_parent = $menu['menu_item_parent'];
		if ($menu_item_parent == 0) {
			$is_mega_menu = carbon_get_nav_menu_item_meta($ID, 'is_mega_menu');
			$is_two_column = carbon_get_nav_menu_item_meta($ID, 'is_two_column');
			$class = $is_mega_menu ? 'is-mega-menu' : 'is-not-mega-menu';
			$class_col = $is_two_column ? 'is-two-column' : '';
			if (!$is_mega_menu) {
				$ul_class = $is_two_column  ? 'flex-wrap' : 'flex-column';
			} else {
				$ul_class = '';
			}
			$url = $menu['url'];
			$submenus1 = array_filter($menus_array, function ($var) use ($ID) {
				return ($var['menu_item_parent'] == $ID);
			});
			$class_parent = '';
			$anchor_class = '';
			if ($submenus1) {
				$class_parent = 'has-submenu';
				$anchor_class = 'has-children';
			}
			$html .= "<li class='nav-item position-relative parent $class_parent $class $class_col'>";
			$html .= "<a class='nav-link text-white main-nav $anchor_class' href='$url'>";
			$html .= $menu['title'];
			if ($submenus1) {
				$html .= '<span class="icon"></span>';
			}
			$html .= '</a>';

			if ($submenus1) {

				$html .= '<div class="submenu">'; //submenu 1
				$html .= '<div class="submenu-inner">';
				$html .= "<ul class='list-inline d-flex p-0 $ul_class'>";

				$html .= '<li class="close-submenu close-submenu-1 has-submenu d-block d-lg-none">';
				$html .= '<a class="nav-link text-black">';
				$html .= $menu['title'];
				$html .= '<span class="icon"></span>';
				$html .= "</a>";
				$html .= '</li>';

				foreach ($submenus1 as $submenu1) {
					$submenu1_id = $submenu1['ID'];

					$submenus2 = array_filter($menus_array, function ($var) use ($submenu1_id) {
						return ($var['menu_item_parent'] == $submenu1_id);
					});
					if ($submenus2) {
						$class_parent = 'has-submenu';
					}
					$html .= "<li class='$class_parent'>";
					$html .= '<a class="nav-link text-black sub-nav ' . ($submenus2 ? 'has-children' : '') . '"  href="' . $submenu1['url'] . '">';
					$html .= $submenu1['title'];
					if ($submenus2) {
						$html .= '<span class="icon"></span>';
					}
					$html .= '</a>';

					if ($submenus2) {
						$html .= '<div class="submenu2">';
						$html .= '<div class="row">';
						$html .= '<div class="col-lg-5">';
						$html .= '<ul class="list-inline left-menu d-flex flex-column p-0">';

						$html .= '<li class="close-submenu close-submenu-2 has-submenu d-block d-lg-none">';
						$html .= '<a class="nav-link text-black">';
						$html .= $submenu1['title'];
						$html .= '<span class="icon"></span>';
						$html .= "</a>";
						$html .= '</li>';

						foreach ($submenus2 as $submenu2) {
							$submenu2_id = $submenu2['ID'];
							$submenus3 = array_filter($menus_array, function ($var) use ($submenu2_id) {
								return ($var['menu_item_parent'] == $submenu2_id);
							});



							$html .= '<li>';
							$html .= '<a id="anchor-submenu-' . $submenu2_id . '" class="nav-link text-black  ' . ($submenus3 ? 'has-children-tab' : '') . '"  url_target="#submenu-' . $submenu2_id . '" href="' . $submenu2['url'] . '">';
							$html .= $submenu2['title'];

							if ($submenus3) {
								$html .= '<span class="icon"></span>';
							}
							$html .= '</a>';

							$html .= '</li>';
						}
						$html .= '</ul>';

						$html .= '</div>';

						$html .= '<div class="col-lg-7">';

						foreach ($submenus2 as $submenu2) {
							$submenu2_id = $submenu2['ID'];
							$submenus3 = array_filter($menus_array, function ($var) use ($submenu2_id) {
								return ($var['menu_item_parent'] == $submenu2_id);
							});
							if ($submenus3) {

								$html .= '<ul class="submenu3 list-inline left-menu d-flex flex-column p-0 d-none tab-links" id="submenu-' . $submenu2_id . '">';
								$html .= '<li class="close-submenu close-submenu-3 has-submenu d-block d-lg-none">';
								$html .= '<a class="nav-link text-black">';
								$html .= $submenu2['title'];
								$html .= '<span class="icon"></span>';
								$html .= "</a>";
								$html .= '</li>';
								foreach ($submenus3 as $submenu3) {
									$html .= '<li>';
									$html .= '<a class="nav-link text-black"  href="' . $submenu3['url'] . '">' . $submenu3['title'] . '</a>';
									$html .= '</li>';
								}
								$html .= '</ul>';
							}
						}
						$html .= '</div>';


						$html .= '</div>';
						$html .= '</div>';
					}

					$html .= '</li>';
				}
				$html .= '</ul>';



				$html .= '</div>';
				$html .= '</div>'; //submenu-1
			}

			$html .= '</li>';
		}
	}

	$html .= '</ul>';
	$html .= '</nav>';
	return $html;
}
