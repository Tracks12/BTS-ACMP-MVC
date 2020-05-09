<!-- ABOUT -->
<aside id="about" style="">
	<header>
		<div class="title">
			<span class="pic"></span>
			<hr />
			<h1>acmp</h1>
		</div>
	</header>
	<article class="btn-link">
		<a class="button" target="_blank" href="/github">
			<span class="ico fa fa-github"></span>
			<span class="label">GitHub</span>
		</a>
	</article>
	<article>
		<p>ACMP est un projet de BTS de conception web permettant d'interfacer des capteurs de pollutions répartis dans l’agglomération toulousaine sur un site web.</p>
		<p>ces capteurs ont pour but de récupérer des données pour avertir l'usager du niveau de pollution d'un secteur pré-défini.</p>
	</article>
</aside>
<?php require_once('./core/views/about/footer.html'); ?>
<script language="javascript" type="text/javascript">
	$('#about').ready(() => {
		$('#about > header > .title > hr').animate({
			width: '75%'
		}, 1000, () => {
			$('#about > header > .title > .pic').animate({
				opacity: 1,
				marginBottom: "40px"
			}, 1000);

			$('#about > header > .title > h1').animate({
				opacity: 1,
				marginTop: "40px"
			}, 1000);
		});
	});
</script>
