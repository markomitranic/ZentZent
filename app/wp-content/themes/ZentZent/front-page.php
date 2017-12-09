<?php
// Front Page

get_header();
the_post();
?>

<div id="body">
	<section id="sidebar">
		<?php include ('sidebar.php'); ?>
	</section>
	<main role="main" id="main">
		<article class="page-content">
			<?php the_content(); ?>
		</article>

		<?php
		$the_query = new WP_Query([
			'posts_per_page'   => -1,
			'post_type'        => 'zent',
			'post_status'      => 'publish'
		]);

		if ( $the_query->have_posts() ) : ?>
        <section id="blogroll">
            <?php while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>

                <article>
                    <h2>
                        <a href="<?=get_the_permalink()?>" title="<?=get_the_title()?>" class>
                            <?=get_the_title()?>
                        </a>
                    </h2>
                    <p class="author"><?=get_field('autor_teksta')?> ~ <?=get_the_date('d. m. Y');?></p>
                    <div>
	                    <?php if (get_field('hero_slika')) : $slika = get_field('hero_slika'); ?>
                            <img src="<?php echo $slika['sizes']['casopis']; ?>" alt="<?php echo $slika['alt']; ?>">
	                    <?php endif; ?>
                        <p><?=excerpt(get_the_content(), 280)?></p>
                    </div>
                    <a href="<?=get_the_permalink()?>" title="<?=get_the_title()?>">More ...</a>

                </article>

            <?php endwhile; ?>
        </section>
		<?php
		endif;
		wp_reset_postdata();
		?>

	</main>
</div>


<?php
get_footer();
?>