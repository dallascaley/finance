<?php
	require_once(__DIR__ . '/../orm/orm.php');
	$orm = ormFactory::getInstance();

	require_once(__DIR__ . '/../controller/viewController.php');
	$controller = new viewController();
?>
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
	<?php $controller->getPartial('rent') ?>
	<button class="go_to_step" id="wiz-step2">next</button>
</div>
</body>