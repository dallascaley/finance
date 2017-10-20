<body>
<div id="intro">
	<h3>So what the heck is this thing?</h3>
	<p>Do you sometimes have trouble making it to payday?</p>
	<p>Do you find yourself going over last months bank statements 
		to see what bills are coming in the next week to know if you're 
		gonna have a few dollars to spend tonight?</p>
	<p>Well, my friend, your troubles are over!</p>
	<p>Finance Buddy will be your best friend.  All you have to do is tell us what your repeating expenses are
		every month and we'll keep track of it all for you.</p>
	<p>I know, I know,  This sounds like a chore right?  You're probably thinking, crap, now I have to go in and 
		figure out every little thing that I spend money on and log it, or this app won't be very usefull right?</p>
	<p><b>Wrong!</b> You see Finance Buddy knows that you've got a busy life so all we ask is for the big ticket things
		like rent, car payments, that sort of stuff.  Then what we do is, from time to time, we will ask you to tell us 
		your current bank balance is, that's all.  We then use the difference in what you told us you would spend and
		what you actually spent to give you a good guess as to how much you will spend in the future. It's that simple!</p>
	<button class="go_to_step" id="wiz-step1">Give it a Try!</button>
</div>
<div class="wizard step1">
	<form id="step1-form">
		<?php 
			$params = [
				'id' => 'rent',
				'view' => 'reoccurrence',
				'title' => 'Rent is usually most people\'s biggest expense every month. Tell us about yours.',
				'frequency_msg' => 'And when is this due?',
				'next_msg' => 'And the next time you have to pay rent is?',
			];
			$controller->getPartial($params);
		?>
		<div><button type="submit" class="go_to_step" id="step1-step2">next</button></div>
	</form>
</div>
<div class="wizard step2">
	<?php //$controller->getPartial('job') ?>
	<form id="step2-form">
		<?php 
			$params = [
				'id' => 'income',
				'view' => 'reoccurrence',
				'title' => 'Next we\'ll look at your income.  How much do you make?',
				'frequency_msg' => 'How Often?',
				'next_msg' => 'And your next payday is?',
			];
			$controller->getPartial($params);
		?>
		<div><button type="submit" class="go_to_step" id="step2-step3">next</button></div>
	</form>
</div>
</body>