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
	</main>
</div>


<?php
get_footer();
?>