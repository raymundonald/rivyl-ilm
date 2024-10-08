<?php
if (is_single()) {
    $id = _get_layout_id(get_post_type());
    if ($id) {
        echo do_shortcode(__sections($id));
    }
}
?>

</main>

<footer class="footer md-padding-top md-padding-bottom bg-forest-gray">
    <div class="container">
        <div class="accordion accordionFooter" id="accordionFooter">
            <div class="footer-top xs-margin-bottom">
                <div class="row g-4">
                    <div class="col-12 col-lg">
                        <?php dynamic_sidebar('footer_column_1') ?>
                    </div>
                    <div class="col-12 col-md">
                        <?php dynamic_sidebar('footer_column_2') ?>
                    </div>
                    <div class="col-12 col-md">
                        <?php dynamic_sidebar('footer_column_3') ?>
                    </div>
                    <div class="col-12 col-md">
                        <?php dynamic_sidebar('footer_column_4') ?>
                    </div>
                    <div class="col-12 col-md">
                        <?php dynamic_sidebar('footer_column_5') ?>
                    </div>
                </div>
            </div>
            <div class="footer-middle md-margin-bottom">
                <div class="row g-4 ">
                    <div class="col">
                        <?php dynamic_sidebar('footer_middle') ?>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row g-4 justify-content-between">
                    <div class="col-auto  left-column">
                        <div class="row g-4 align-items-center">
                            <?php dynamic_sidebar('footer_bottom_left') ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="row g-4 align-items-center">
                            <?php dynamic_sidebar('footer_bottom_right') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>