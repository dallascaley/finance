<body>
	<form id="transaction-form">
		<label>Name:</label>
		<input type="text" id="name" name="name" placeholder=""/>
		<label>Type:</label>
		<input type="radio" id="debit_type" name="type" value="debit" checked>
		<label for="debit_type">Debit</label>
		<input type="radio" id="credit_type" name="type" value="credit">
		<label for="credit_type">Credit</label>
		<?php 
			$params = [
				'id' => 'transaction',
				'view' => 'reoccurrence',
				'title' => 'Amount',
				'frequency_msg' => 'How often?',
				'next_msg' => 'And the next one happens on?',
			];
			$controller->getPartial($params);
		?>
		<div><button type="submit">Submit</button></div>
	</form>
</body>