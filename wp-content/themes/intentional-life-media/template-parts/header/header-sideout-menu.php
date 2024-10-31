<div class="offcanvas offcanvas-end bg-light-gray" tabindex="-1" id="sideOutMenu" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-body">
        <nav class="navbar">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'sideout-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 w-100 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </nav>
    </div>
</div>