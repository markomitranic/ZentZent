<?php

// Single Post template

// if (in_category('8')) { 
// 	include ('hacking_news.php');
// }
// else if (in_category('24')) {
// 	include ('posts_about_voldemort.php');
// }
// else {
// 	include ('page.php');
// }

get_header(); 

the_post();

?>

<div id="body">
	<section id="sidebar">
		<!-- Iskra decided they wont need a sidebar here -->
		<?php //include ('sidebar.php'); ?>
	</section>
	<main role="main" id="main">
		<header class="post-hero">
			<?php if (get_field('hero_slika') && get_field('prikazivanje_hero_slike')) : 
				$slika = get_field('hero_slika');
			?>
				<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'Big_hero'); ?>" alt="<?php echo $slika['alt']; ?>">
			<?php endif; ?>
			<h1><?php the_title(); ?></h1>
			<?php if (get_field('autor_teksta')) : ?>
				<p><?php echo get_field('autor_teksta'); ?></p>
			<?php endif; ?>
		</header>
		<article class="page-content">
			<?php the_content(); ?>
		</article>
	</main>
</div>

<?php get_footer(); ?>
