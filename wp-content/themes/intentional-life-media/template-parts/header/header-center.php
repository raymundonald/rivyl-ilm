<div class="col-auto d-none d-lg-block">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'container' => false,
        'menu_class' => 'header-menu',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
        'depth' => 2,
    ));
    ?>
</div>