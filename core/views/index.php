<!DOCTYPE html>
<!-- INDEX -->
<html lang="fr">
	<head>
		<?php require_once("./core/views/head.html"); ?>
	</head>
	<body>
		<div id="splash">
			<h1>acmp</h1>
		</div>
		<?php require_once('./core/views/nav.php'); ?>
		<a class="scrolly" id="upper" href="#me">
			<span class="fa fa-chevron-up"></span>
		</a>
		<section>
			<?php
				$frames = [ // Composants du site web

				];

				foreach($frames as $frame)
					require_once($frame);
			?>
		</section>
		<?php require_once('./core/views/footer.html'); ?>
	</body>
</html>
<!-- END -->
