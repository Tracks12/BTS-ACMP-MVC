<!-- NAV -->
<nav>
	<div>
		<span class="fa fa-bars"></span>
	</div>
	<ul>
		<li class="title">
			<a href="#map">acmp</a>
		</li>
		<?php
			if(isset($_SESSION['user']))
				echo('<li class="button"><a href="#captors">capteurs</a></li>');
		?>
		<li class="button">
			<a href="#telemetry">
				<span class="ico fa fa-bar-chart"></span>télémetrie
				<span class="row fa fa-sort-desc"></span>
			</a>
			<ul>
				<li>
					<a href="#map"><span class="ico fa fa-map"></span>map</a>
				</li>
				<li>
					<a href="#instant"><span class="ico fa fa-clock-o"></span>temps réel</a>
				</li>
				<li>
					<a href="#story"><span class="ico fa fa-list"></span>historique</a>
				</li>
			</ul>
		</li>
		<li class="button">
			<a href="#about"><span class="ico fa fa-info-circle"></span>à propos</a>
		</li>
		<li class="button">
			<?php
				if(isset($_SESSION['user']))
					echo('<a href="#signout"><span class="ico fa fa-sign-out"></span>déconnexion</a>');

				else
					echo('<a href="#signin"><span class="ico fa fa-sign-in"></span>connexion</a>');
			?>
		</li>
	</ul>
</nav>
