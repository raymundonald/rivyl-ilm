<!DOCTYPE html>
<html <?php language_attributes(); ?> class="html">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="">
	<meta name="format-detection" content="telephone=no">
	<?php if (!is_404() && !is_search()) { ?>
		<link rel="canonical" href="<?= canonical() ?>" />
	<?php } ?>
	<title>
		<?php wp_title('') ?>
	</title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
	<header class="header bg-forest-gray">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<?php get_template_part('template-parts/header/header-left') ?>
				<?php get_template_part('template-parts/header/header-center') ?>
				<?php get_template_part('template-parts/header/header-right') ?>
			</div>
		</div>
	</header>
	<?php wp_body_open(); ?>
	<main>