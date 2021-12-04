<?php get_header(); ?>

	<main role="main">
		<div class="wrapper">
			<!-- section -->
			<section>

				<h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

				<?php get_template_part('loop'); ?>

				<?php get_template_part('pagination'); ?>

			</section>
			<!-- /section -->
		</div>
	</main>

<?php get_footer(); ?>
