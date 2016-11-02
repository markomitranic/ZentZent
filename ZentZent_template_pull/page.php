<?php 
/*
Template Name: Obicna stranica Template
*/

get_header(); 

the_post();

?>

<div id="body">
	<section id="sidebar">
		<?php include ('sidebar.php'); ?>
	</section>
	<main role="main" id="main">
		<header class="post-hero">
			<?php if (get_field('hero_slika') && get_field('prikazivanje_hero_slike')) : 
				$slika = get_field('hero_slika');
			?>
				<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'Big_hero'); ?>" alt="<?php echo $slika['alt']; ?>">
			<?php endif; ?>
			<h1><?php if (get_field('title')) {
					the_title();
				} ?></h1>
			<p><?php echo get_field('autor_teksta'); ?></p>
		</header>
		<article class="page-content">
			<?php the_content(); ?>
		</article>
	</main>
</div>

<?php get_footer(); ?>
