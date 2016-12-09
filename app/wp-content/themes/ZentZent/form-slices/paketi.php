<?php the_content(); ?>


<p class="breadcrumbs">
	<span class="active-breadcrumb"><?php _e( 'Poruči', 'zentzent' ); ?></span>
	<span>></span>
	<span><?php _e( 'Podaci Kupca', 'zentzent' ); ?></span>
	<span>></span>
	<span><?php _e( 'Potvrda i plaćanje', 'zentzent' ); ?></span>
</p>

<div id="odabirizdanja-boxes">
	<div data-name="stampano" class="selected-box">
		<h2><?php _e( 'Štampano izdanje', 'zentzent' ); ?></h2>
		<ul>
			<li>&raquo; RSD <span>900</span></li>
			<li>&raquo; EUR <span>10</span></li>
		</ul>
	</div>
	<div data-name="digitalno">
		<h2><?php _e( 'Digitalno izdanje', 'zentzent' ); ?></h2>
		<ul>
			<li>&raquo; RSD <span>300</span></li>
			<li>&raquo; EUR <span>5</span></li>
		</ul>
	</div>
	<div data-name="oba">
		<h2><?php _e( 'Štampano i digitalno izdanje', 'zentzent' ); ?></h2>
		<ul>
			<li>&raquo; RSD <span>1000</span></li>
			<li>&raquo; EUR <span>12</span></li>
		</ul>
	</div>
	<div data-name="specijal">
		<h2><?php _e( 'Specijal paket (dva broja)', 'zentzent' ); ?></h2>
		<ul>
			<li>&raquo; RSD <span>1800</span></li>
			<li>&raquo; EUR <span>20</span></li>
		</ul>
	</div>
</div>

<form action="." method="POST">

	<div id="odaberibroj">
		<h2><?php _e( 'Izaberi broj', 'zentzent' ); ?></h2>
		<div>


		<?php $availableIssues = get_field('na_prodaju');

			if( $availableIssues ): 
			foreach( $availableIssues as $post):  setup_postdata($post);
			$name = (get_field('ime_izdanja')) ? get_field('ime_izdanja') : '#';
			$slug = $post->post_name;

		?>
			<p>
				<label for="<?php echo $slug; ?>">&raquo; <?php the_title().' - '.$name ?> - Prezent</label>
				<span><?php _e( 'broj komada', 'zentzent' ); ?> <input type="number" name="<?php echo $slug; ?>" id="<?php echo $slug; ?>" value="0" min="0" max="10" required></span>
			</p>
		<?php endforeach; wp_reset_postdata(); endif; ?>

			<p class="specijal-paket" style="display:none;">
				<label for="specijal-paket">&raquo; <?php _e( 'Broj specijal paketa', 'zentzent' ); ?></label>
				<span><?php _e( 'broj komada', 'zentzent' ); ?> <input type="number" name="specijal-paket" id="specijal-paket" value="0" min="0" max="10" required></span>
			</p>
		</div>
		<p class="max-allowed"><?php _e( 'Ukoliko je vaša porudžbina veća od 10 komada po broju, molimo vas da nas <a href="/kontakt">kontaktirate</a>.', 'zentzent' ); ?></p>
	</div>


	<div class="hidden paket">
		<input type="radio" name="paket" value="stampano" checked>
		<input type="radio" name="paket" value="digitalno">
		<input type="radio" name="paket" value="oba">
		<input type="radio" name="paket" value="specijal">
	</div>
	<input type="hidden" name="stage" id="stage" value="1" required>

	<p class="checkoutErrorMessage">Undefined Error!</p>
	<input type="submit" value="Sledeći Korak">

</form>







<script>
	
	var $document = $(document);

	// Select checkboxes based on selection of package
	$document.on('click', '#odabirizdanja-boxes div', function() {
		var $this = $(this);
		$this.addClass('selected-box').siblings().removeClass('selected-box');
		var dataName = '.paket input[value="' + $this.data('name') + '"]';
		if ($this.data('name') == 'specijal') {
			$('.specijal-paket').slideDown().siblings().slideUp();
		} else {
			$('.specijal-paket').slideUp().siblings().slideDown();
		}
		$(dataName).prop( "checked", true );
	});

	// Validate form
	var $checkoutErrorMessage = $('.checkoutErrorMessage');
	$document.on('click', 'form input[type="submit"]', function(event) {
		
		var orderedItems = $('#zent01').val() + $('#zent02').val() + $('#specijal-paket').val();
		if (orderedItems <= 0) {
			
			// If total of 0 magazines are ordered, show an error.
			event.preventDefault();
			var errorMsg = 'Morate poručiti barem jedan primerak.';
			$checkoutErrorMessage.html(errorMsg).slideDown();
		} else if (!($(".paket input:radio:checked").length)) {
			
			// If no checkboxes are selected, present an error
			event.preventDefault();
			var errorMsg = 'Morate odabrati jedan od paketa.';
			$checkoutErrorMessage.html(errorMsg).slideDown();
		}
	});

</script>












