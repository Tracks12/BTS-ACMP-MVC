<!-- ABOUT -->
<aside id="about" style="">
	<header>
		<div class="title">
			<span class="pic"></span>
			<hr />
			<h1>acmp</h1>
		</div>
	</header>
	<article>
		
	</article>
</aside>
<?php require_once('./core/views/footer.html'); ?>
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
