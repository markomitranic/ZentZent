<?php 
/*
Template Name: Podrzi nas Casopis
*/

get_header(); 

the_post(); 

?>

<div id="body">
	<section id="sidebar">
		
	</section>
	<main role="main" id="main">
		<?php if (get_field('hero_slika') && get_field('prikazivanje_hero_slike')) : 
				$slika = get_field('hero_slika');
			?>
			<header class="post-hero">
				<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'Big_hero'); ?>" alt="<?php echo $slika['alt']; ?>">
			</header>
		<?php endif; ?>
		<section class="page-content full-magazine-content">
			<div id="donate-left">
				<?php the_content(); ?>
			</div>
			<div id="donate-right">
				<?php echo get_field('treca_kolona'); ?>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
