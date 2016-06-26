<p class="breadcrumbs">
	<span>Poruči</span>
	<span>></span>
	<span>Podaci Kupca</span>
	<span>></span>
	<span class="active-breadcrumb">Potvrda i plaćanje</span>
</p>

<?php 
	// Start session

	// Create a reference number based on timestamp
	$uniqid = uniqid();
	
	switch ($post["paket"]) {
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

	// Check out what payment method to show.
	if ($post["drzava"] == "SRB") {
		$paypal = false;
	} else {
		$paypal = true;
	}

 ?>

<form action="<?php echo get_bloginfo('url'); ?>/poruci/thank-you/" method="POST" id="bigForm">	
	<div id="pregled-porudzbine">
		<h2>POTVRDA NARUDŽBINE</h2>

		<table>
			<thead>
				<tr>
				<th>Odabrani broj</th>
				<th>Količina</th>
				<th>Poštarina</th>
				<th>Ukupan iznos</th>
				</tr>
			</thead>
			<tbody>
			<!-- If it is special, shoq one thing. Else, we have a bunch of loops happen. -->
			<?php if ($post["paket"] == "specijal") : ?>
				<tr>
					<td>Specijal Paket - Oba broja</td>
					<td><span><?php echo $post["specijal-paket"]; ?></span></td>
					<td><span>382.00</span></td>
					<td><span><?php echo $price * $post["specijal-paket"]; ?></span></td>
				</tr>
			<?php $fullPrice += $price * $post["specijal-paket"]; ?>
			<?php else : ?>
				<?php if ($post["zent01"] !== "0") : ?>
					<tr>
						<td>Zent #01 - Prezent</td>
						<td><span><?php echo $post["zent01"]; ?></span></td>
						<td><span>382.00</span></td>
						<td><span><?php echo $price * $post["zent01"]; ?></span></td>
					</tr>
				<?php $fullPrice += $price * $post["zent01"]; ?>
				<?php endif; ?>
				<?php if ($post["zent02"] !== "0") : ?>
					<tr>
						<td>Zent #02 - Rad</td>
						<td><span><?php echo $post["zent02"]; ?></span></td>
						<td><span>382.00</span></td>
						<td><span><?php echo $price * $post["zent02"]; ?></span></td>
					</tr>
				<?php $fullPrice += $price * $post["zent02"]; ?>
				<?php endif; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	
	<div id="metoda-placanja">
		<h2>METODA PLAĆANJA</h2>

		<?php if ($paypal) : ?>
			<div id="paypal">
				<h3>Paypal</h3>
				<p>Bićete preusmereni na sajt Paypal-a. Ne morate da imate Paypal nalog, plaćanje možete izvršiti vašom kreditnom ili debitnom karticom.</p>
			</div>
		<?php else : ?>
		<div id="srbija">
			<h3>Pouzećem (Srbija)</h3>
			<p>Dostava na adresu. Plaćanje u kešu.</p>
		</div>
	<?php endif; ?>

	</div>




	<!-- Moving the rest of the fields to new page -->
	<input type="hidden" name="ref" value="<?php echo $uniqid; ?>">
	<?php 
		foreach ($post as $key => $value) {
			if ($key == "stage") {
				echo '<input type="hidden" name="stage" value="3" required>';
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
	$post['ref'] = $uniqid;
	$post['stage'] = 3;
	$post['paymentMethod'] = ($paypal) ? 'paypal' : 'pouzece';
	$post['fullPrice'] = $fullPrice;

	$_SESSION['zentOrderData'] = $post;

 ?>

<script>
	// Autofill values in paypal form
	var $paypalForm = $('form.wp_accept_pp_button_form_classic');
	// create price and ref
	var price = <?php echo $fullPrice; ?>;
	var ref = "<?php echo $uniqid; ?>";
	var transactionName = "Zent Payment from: <?php echo $post["email"]; ?>";
	$paypalForm.find('input[name="other_amount"]').val(price);
	$paypalForm.find('.wp_pp_button_reference').val(ref);
	$paypalForm.find('input[name="item_name"]').val(transactionName);
</script>