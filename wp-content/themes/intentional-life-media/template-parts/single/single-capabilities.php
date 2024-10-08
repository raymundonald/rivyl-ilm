<?php
echo ___hero_modules();
echo do_shortcode(get_post_meta(get_the_ID(), '_sections_html', true));
$related_products_heading = get__post_meta('related_products_heading');
$related_products = get__post_meta('related_products');
$related_casestudies_heading = get__post_meta('related_casestudies_heading');
$related_casestudies = get__post_meta('related_casestudies');
if ($related_products) {
  $related_products_array = array();
  foreach ($related_products as $related_product) {
    $related_products_array[] = $related_product['id'];
  }
  $html .= __linked_products($related_products_array, false, false, false, $related_products_heading, false, true, false, 'Related-Products');
}

if ($related_casestudies) {
  $data = array(
    'col'      => false,
    'featured' => false,
    'taxonomy' => 'casestudies_category',
    'style'    => 'style-1',
    'elements' => array('image', 'category', 'title', 'excerpt', 'button'),
  );
  $html .= do_shortcode(__related_posts($related_casestudies, $data, $related_casestudies_heading, 'Case-Studies'));
}
echo do_shortcode(get_post_meta(get_the_ID(), '_sections_after_main_html', true));