<p class="breadcrumbs">
	<span><?php _e( 'Poruči', 'zentzent' ); ?></span>
	<span>></span>
	<span><?php _e( 'Podaci Kupca', 'zentzent' ); ?></span>
	<span>></span>
	<span class="active-breadcrumb"><?php _e( 'Potvrda i plaćanje', 'zentzent' ); ?></span>
</p>

<?php 
	// Start session

	// Create a reference number based on timestamp
	$uniqid = uniqid();


	switch ($request["drzava"]) {
		case 'SRB':
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 238;
			$price = priceInRSD($request["paket"]);
			$paypal = false;
			$valuta = 'RSD';
			break;
		case 'HRV' :
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 8;
			$price = priceInEur($request["paket"]);
			$paypal = true;
			$valuta = '€';
			break;
		case 'SVN' :
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 8;
			$price = priceInEur($request["paket"]);
			$paypal = true;
			$valuta = '€';
			break;
		case 'BIH':
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 8;
			$price = priceInEur($request["paket"]);
			$paypal = true;
			$valuta = '€';
			break;
		case 'MNE':
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 8;
			$price = priceInEur($request["paket"]);
			$paypal = true;
			$valuta = '€';
			break;
		case 'MKD' :
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 8;
			$price = priceInEur($request["paket"]);
			$paypal = true;
			$valuta = '€';
			break;			
		default:
			$postarina = ($request["paket"] == 'digitalno') ? 0 : 10;
			$price = priceInEur($request["paket"]);
			$paypal = true;
			$valuta = '€';
			break;
	}


	$fullPrice = 0;
 ?>

<form action="<?php echo get_bloginfo('url'); ?>/poruci/thank-you/" method="POST" id="bigForm">	
	<div id="pregled-porudzbine">
		<h2><?php _e( 'POTVRDA NARUDŽBINE', 'zentzent' ); ?></h2>

		<table>
			<thead>
				<tr>
				<th><?php _e( 'Odabrani broj', 'zentzent' ); ?></th>
				<th><?php _e( 'Količina', 'zentzent' ); ?></th>
				<th><?php _e( 'Poštarina', 'zentzent' ); ?></th>
				<th><?php _e( 'Ukupan iznos', 'zentzent' ); ?></th>
				</tr>
			</thead>
			<tbody>
			<!-- If it is special, shoq one thing. Else, we have a bunch of loops happen. -->
			<?php if ($request["paket"] == "specijal") : ?>
				<tr>
					<td><?php _e( 'Specijal Paket - Oba broja', 'zentzent' ); ?></td>
					<td><span><?php echo $request["specijal-paket"]; ?></span></td>
					<td><span><?php echo $postarina.' '.$valuta; ?></span></td>
					<td><span><?php echo ($price * $request["specijal-paket"]) + $postarina.' '.$valuta; ?></span></td>
				</tr>
			<?php $fullPrice += ($price * $request["specijal-paket"]) + $postarina; ?>
			<?php else : 
				$issuesObject = array();

				// Take all available issues and create an assoc aray.
				$availableIssues = get_field('na_prodaju');
				if( $availableIssues ): 
				foreach( $availableIssues as $post):  setup_postdata($post);
					$issue = $post->post_title;
					$name = (get_field('ime_izdanja', $post->ID)) ? get_field('ime_izdanja', $post->ID) : '#';
					$slug = $post->post_name;
					$issuesObject[] = [
						'issue'=>$issue,
						'name'=>$name,
						'slug'=>$slug
					];
				endforeach; wp_reset_postdata(); endif;

				foreach ($issuesObject as $key => $value) : ?>
					<tr>
						<td><?php echo $value['issue'].' - '.$value['name'] ?></td>
						<td><span><?php echo $request[$value["slug"]]; ?></span></td>
						<td></td>
						<td><span><?php echo ($price * $request[$value["slug"]]).' '.$valuta; ?></span></td>
					</tr>
					<?php $fullPrice += $price * $request[$value["slug"]]; ?>
				<?php endforeach; ?>
					<tr>
						<td><?php _e( 'Poruči', 'zentzent' ); ?>Ukupno:</td>
						<td></td>
						<td><span><?php echo $postarina.' '.$valuta; ?></span></td>
						<td><span><?php echo ($fullPrice + $postarina).' '.$valuta; ?></span></td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	
	<div id="metoda-placanja">
		<h2><?php _e( 'METODA PLAĆANJA', 'zentzent' ); ?></h2>

		<?php if ($paypal) : ?>
			<div id="paypal">
				<h3><?php _e( 'Paypal', 'zentzent' ); ?></h3>
				<p><?php _e( 'Bićete preusmereni na sajt Paypal-a. Ne morate da imate Paypal nalog, plaćanje možete izvršiti vašom kreditnom ili debitnom karticom.', 'zentzent' ); ?></p>
			</div>
		<?php else : ?>

			<?php if ($request["paket"] == "digitalno") : // check if it is digital issue?>
				<div id="srbija">
					<h3><?php _e( 'Uplata na žiro-račun', 'zentzent' ); ?></h3>
					<p><?php _e( 'Broj računa: (imaćemo sutra)<br>Svrha uplate: Donacija časopisu Zent<br>Primalac: Udruženje građana Kulturni Kod, Mirijevski venac 4<br>Šifra plaćanja: 188 za gotovinske donacije i 288 za bezgotovinske donacije<br><br>Po izvršenoj uplati poslaćemo vam link za download.', 'zentzent' ); ?></p>
				</div>
			<?php else : // if serbia and not digital ?>
				<div id="srbija">
					<h3><?php _e( 'Pouzećem (Srbija)', 'zentzent' ); ?></h3>
					<p><?php _e( 'Dostava na adresu. Plaćanje u kešu.', 'zentzent' ); ?></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>




	<!-- Moving the rest of the fields to new page -->
	<input type="hidden" name="ref" value="<?php echo $uniqid; ?>">
	<?php 
		foreach ($request as $key => $value) {
			if ($key == "stage") {
				echo '<input type="hidden" name="stage" id="stage" value="3" required>';
			} else {
				echo '<input type="hidden" name="' . $key . '" value="' . $value . '" required>';
			}
		}
	 ?>

	<?php if (!$paypal) : ?>
		<input type="submit" value="PLAĆANJE">
	<?php endif; ?>
</form>


<?php if ($paypal) : ?>
	<?php echo Paypal_payment_accept(); ?>
<?php endif; ?>



<?php 

	// We need to create a session right now and save all the data from the form as serialized string.
	$request['ref'] = $uniqid;
	$request['stage'] = 3;
	$request['paymentMethod'] = ($paypal) ? 'paypal' : 'pouzece';
	$request['fullPrice'] = $fullPrice;

	$_SESSION['zentOrderData'] = $request;



	function priceInRSD($paket) {
		switch ($paket) {
			case 'stampano':
				$price = 900;
				break;
			case 'digitalno':
				$price = 300;
				break;
			case 'oba':
				$price = 1000;
				break;
			case 'specijal':
				$price = 1800;
				break;
			default:
				die('There was an error, please inform the administrator.');
				// Stop the presses, someone is meddling!
				break;
		}
		return $price;
	}

	function priceInEur($paket) {
		switch ($paket) {
			case 'stampano':
				$price = 10;
				break;
			case 'digitalno':
				$price = 5;
				break;
			case 'oba':
				$price = 12;
				break;
			case 'specijal':
				$price = 20;
				break;
			default:
				die('There was an error, please inform the administrator.');
				// Stop the presses, someone is meddling!
				break;
		}
		return $price;
	}

?>



<script>
	// Autofill values in paypal form
	var $paypalForm = $('form.wp_accept_pp_button_form_classic');
	// create price and ref
	var price = <?php echo $fullPrice; ?>;
	var ref = "<?php echo $uniqid; ?>";
	var transactionName = "Zent Payment from: <?php echo $request["email"]; ?>";
	$paypalForm.find('input[name="other_amount"]').val(price);
	$paypalForm.find('.wp_pp_button_reference').val(ref);
	$paypalForm.find('input[name="item_name"]').val(transactionName);
	// Hide some fields
	$paypalForm.find('#amount').hide();
	$paypalForm.find('.wpapp_payment_subject').hide();
	$paypalForm.find('.wpapp_other_amount_label').hide();
	$paypalForm.find('.wpapp_other_amount_input').hide();
	$paypalForm.find('.wpapp_ref_title_label').hide();
	$paypalForm.find('.wpapp_ref_value').hide();
	$paypalForm.find('.wpapp_payment_button').css('text-align', 'center');
</script>