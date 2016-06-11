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
		<section class="full-magazine-content">
			<div id="donate-left">
				<?php the_content(); ?>
			</div>
			<div id="donate-right">
				<p style="margin-bottom:20px;">Iz Srbije donaciju možete uplatiti uplatnicom na:</p>
				<p>Br. računa</p>
				<p>Primalac:</p>
				<p>Udruženje građana Kulturni Kod</p>
				<p>Mirijevski venac 4</p>
				<p>Svrha uplate:</p>
				<p>Donacija za časopis Zent</p>
				<p style="margin-bottom:20px;">Poziv na broj:</p> 
				<p style="margin-bottom:20px;">Iz inostranstva donaciju možete uplatiti putem PayPal-a.</p>

				<form style="margin-bottom:20px;" action="" method="post">
					<input type="number" name="amount">
				</form>

				<p>Listu dosadašnjih donatora kao i iznose donacija možete pogledati <a href="#">ovde</a>.</p>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
