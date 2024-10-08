<?php
add_action('wp_ajax_nopriv_archive_ajax', 'archive_ajax'); // for not logged in users
add_action('wp_ajax_archive_ajax', 'archive_ajax');
function archive_ajax()
{
	$data = $_POST['data'];
	$query = $_POST['query'];
	$s = isset($_POST['s']) ? $_POST['s'] : false;
	$events_type = isset($_POST['events_type']) ? $_POST['events_type'] : false;

	$data_val = json_decode(stripslashes($data), true);
	$query_val = json_decode(stripslashes($query), true);

	$args = $query_val;
	$args['post_status'] = 'publish';

	if ($events_type != false && $events_type != 'false') {
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'events_type',
				'field' => 'term_id',
				'terms' => $events_type,
			),
		);
	}


	if ($s) {
		$args['s'] = $s;
	}

	if ($query_val['post_type'] == 'events') {
		$meta_query[] = [
			'key'     => '_event_start_datetime',
			'value'   => date('Y-m-d'),
			'compare' => '>=',
			'type'    => 'DATETIME'
		];

		$args['meta_query'] = $meta_query;
		$args['orderby'] = 'meta_value';
		$args['order'] = 'ASC';
	}

	$the_query = new WP_Query($args);

	echo '<div class="row g-4 same-image-height">';

	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$data_val['id'] = get_the_ID();
			if (get_post_type() == 'events') {
				$data_val['additional_content'] = _events_additional_content(get_the_ID());
			}
			echo do_shortcode(__post_box($data_val));
		}
	} else {
		echo '<div class="col-12 text-center -margin-top">';
		echo "<h2>No results found for $s</h2>";
		echo '</div>';
	}
	echo '</div>';

	wp_reset_postdata();

	if ($data_val['has_pagination'] == true || $data_val['has_pagination'] == 'true') {
		echo _pagination(true, $the_query, array(
			'url' => $data_val['url'],
			'posts_per_page' => $query_val['posts_per_page'],
			's' => $query_val['s'],
		));
	}

	die();
}


add_action('wp_ajax_nopriv_training_ajax', 'training_ajax'); // for not logged in users
add_action('wp_ajax_training_ajax', 'training_ajax');
function training_ajax()
{
	$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 'online-self-paced';
	$delivery_method = isset($_POST['delivery_method']) ? $_POST['delivery_method'] : 'online-self-paced';
	$location = isset($_POST['location']) ? $_POST['location'] : false;
	custom_product_variation_training($product_id, $delivery_method, $sortby, $location);
	die();
}

add_action('wp_ajax_nopriv_brands_ajax', 'brands_ajax'); // for not logged in users
add_action('wp_ajax_brands_ajax', 'brands_ajax');

function brands_ajax()
{
	$s = $_POST['s'];
	$terms = get_terms(array(
		'taxonomy'   => 'pa_brands',
		'hide_empty' => false,
		'name__like'    => $s
	));
	$html = "<div class='row g-3 same-image-height' style='--object-fit: contain; --image-padding: 20%'>";
	foreach ($terms as $term) {
		$logo = get___term_meta($term->term_id, 'image');
		$link = get_term_link($term->term_id);
		if ($logo) {
			$image_args['image_id'] = $logo;
			$image_args['size'] = 'medium';
			$image_args['class'] = _attribute('class', array('image-box mb-3'));

			$html .= "<div class='col-lg-3'>";
			$html .= "<div class='inner text-center h-100 border-default rounded-corner xs-padding'>";
			$html .= "<a href='$link' class='text-primary'>";

			$html .= __image($image_args);
			$html .= __heading(array(
				'heading' => $term->name,
				'class' => _attribute('class', array('mb-0')),
				'tag' => 'h3',
			));
			$html .= "</a>";
			$html .= "</div>";
			$html .= "</div>";
		}
	}

	echo $html;

	die();
}
