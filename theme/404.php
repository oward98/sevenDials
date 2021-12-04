<?php get_header(); ?>

<main role="main">
	<div class="wrapper">
		<section>
			<h1><?php the_field('404_title', 'option');?></h1>
			<?php the_field('404_content', 'option');?>
		</section>
	</div>
</main>

<?php get_footer(); ?>
