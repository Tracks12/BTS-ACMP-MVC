<!-- NAV -->
<nav>
	<div>
		<span class="fa fa-bars"></span>
	</div>
	<ul>
		<li class="title">
			<a href="#">acmp</a>
		</li>
		<?php
			if(isset($_SESSION['user']))
				echo('<li class="button"><a href="#">capteurs</a></li>');
		?>
		<li class="button">
			<a href="#">
				<span class="ico fa fa-bar-chart"></span>télémetrie
				<span class="row fa fa-sort-desc"></span>
			</a>
			<ul>
				<li>
					<a href="#"><span class="ico fa fa-map"></span>map</a>
				</li>
				<li>
					<a href="#"><span class="ico fa fa-clock-o"></span>temps réel</a>
				</li>
				<li>
					<a href="#"><span class="ico fa fa-list"></span>historique</a>
				</li>
			</ul>
		</li>
		<li class="button">
			<a href="#"><span class="ico fa fa-info-circle"></span>à propos</a>
		</li>
		<li class="button">
			<?php
				if(isset($_SESSION['user']))
					echo('<a href="#"><span class="ico fa fa-sign-out"></span>déconnexion</a>');

				else
					echo('<a href="#"><span class="ico fa fa-sign-in"></span>connexion</a>');
			?>
		</li>
	</ul>
</nav>
