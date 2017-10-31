<body>
<div>
	<ul>
		<?php if (!$user) { ?>
			<li>
				<a href="login.php">Login</a>
			</li>
			<li>
				<a href="signup.php">Sign Up</a>
			</li>
		<?php } else { ?>
			<li>
				<a href="add_transaction.php">Add Recurring Transaction</a>
			</li>
			<li>
				<a href="wizard.php">Wizard</a>
			</li>
			<li>
				<a href="display_predicitons.php">Display Predictions</a>
			</li>
			<li>
				<a href="admin.php">Admin</a>
			</li>
			<li>
				<a id="logout">Logout</a>
			</li>
			<li>
				<a href="README.md">Project Documentation</a>
			</li>
		<?php } ?>
	</ul>
</div>
</body>