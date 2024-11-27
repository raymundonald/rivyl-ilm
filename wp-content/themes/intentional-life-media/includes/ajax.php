<?php
add_action('wp_ajax_nopriv_post_ajax', 'post_ajax'); // for not logged in users
add_action('wp_ajax_post_ajax', 'post_ajax');
function post_ajax()
{
	$post_type = $_POST['post_type'];
	$posts_per_page = $_POST['posts_per_page'];
	$excludes_ids = $_POST['excludes_ids'];

	$args['post_status'] = 'publish';
	$args['post_type'] = $post_type;
	$args['posts_per_page'] = $posts_per_page;
	$args['post__not_in'] = $excludes_ids;

	$the_query = new WP_Query($args);

	$count = $the_query->found_posts;
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$post_id = get_the_ID();
			if ($post_type == 'team') {
				echo "<div class='col-lg-3 col-md-6 post-item' $count post_id='$post_id'>";
				echo _team_grid(array(
					'id' => $post_id,
					'post_title' => get_the_title(),
					'post_excerpt' => get_the_excerpt()
				));
				echo "</div>";
			}
		}
	}

	if ($count <= $posts_per_page) {
		echo '<style>.ajax-btn{display: none !important}</style>';
	}



	wp_reset_postdata();

	die();
}
