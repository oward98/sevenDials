<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri();?>/icons/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131849568-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-131849568-1');
		</script>


		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
    </script>

	</head>
	<?php
		//declare global variables for hierarchies of building-by-building section
		global $category;
		global $parent;
		global $building_id;
		if(is_category()) {
			$category = get_category( get_query_var( 'cat' ) );
			$parent = get_category($category->parent);
		}

		elseif(is_single()) {

			global $post;
			$category = get_the_category()[0];
			$parent = get_category($category->parent);
			$building_id = $post->ID;

		} else {
			$category = NULL;
		}

	?>
	<body <?php body_class(); ?>>

			<header class="header clear" role="banner">
				<div class="wrapper">
					<i class="nav-button icons8-menu" role="button"></i>
					<div class="logo">
						<div>
							<a href="<?php echo home_url(); ?>">
								<?php the_field('main_title','option');?>
							</a>
						</div>
					</div>
				</div>
			</header>

			<div id="sliding-nav">
				<div id="nav-wrapper">
					<div class="nav-content">
						<div class="nav-header">
							<div class="nav-close icons8-menu"></div>
							<h4><?php the_field('main_title','option');?></h4>
						</div>
						<nav class="nav" role="navigation">
							<?php html5blank_nav(); ?>
						</nav>
						<?php get_search_form(true);?>
						<div class="breadcrumb">
						<a href="<?php echo home_url(); ?>"><h6>Home</h6></a>
						<ul>
							<?php if(is_category()):?>
								<li>
									<?php echo $parent->name; ?>
								</li>
								<li class="bc-current">
									<a href=""><?php echo $category->name; ?></a>
								</li>
							<?php elseif(is_single()):?>
								<li>
									<?php echo $parent->name; ?>
								</li>
								<li>
									<a href="<?php echo get_term_link($category);?>"><?php echo $category->name; ?></a>
								</li>
								<li class="bc-current">
									<?php the_field('title', $value->ID);?>
								</li>
							<?php endif;?>
						</ul>
						</div>
					</div>
					<div class="nav-bottom-image">
						<?php $image = get_field('navigation_image', 'option');?>
						<img src="<?php echo $image['url'];?>">
					</div>
				</div>
			</div>
			<div class="nav-overlay" hidden>
			</div>
	<?php

	if (is_single() || is_category() || get_the_ID()==3770) {
		building_by_building_header();
	}