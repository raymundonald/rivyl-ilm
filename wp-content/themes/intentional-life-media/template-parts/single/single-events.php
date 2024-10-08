<?php
echo ___hero_modules('text-center', '');
echo do_shortcode(get_post_meta(get_the_ID(), '_sections_html', true));