<?php 
/*
Template Name: Sadrzaj Casopisa
*/

get_header(); 

the_post(); 

?>

<div id="body">
	<section id="sidebar">
		<?php include ('sidebar-sadrzaj.php'); ?>
	</section>
	<main role="main" id="main">
		<section class="full-magazine-content">
			<div id="donate-left">
				<?php if (get_field('hero_slika') && get_field('prikazivanje_hero_slike')) : 
					$slika = get_field('hero_slika');
				?>
					<header class="post-hero">
						<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'Big_hero'); ?>" alt="<?php echo $slika['alt']; ?>">
					</header>
				<?php endif; ?>
			</div>
			<div id="donate-right">
				<?php the_content(); ?>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
