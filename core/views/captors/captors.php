<!-- CAPTORS -->
<aside id="telemetry">
	<div class="global-menu">
		<a class="item" href="#map">
			<span class="ico fa fa-map"></span>
			<span class="label">map</span>
		</a>
		<a class="item" href="#instant">
			<span class="ico fa fa-clock-o"></span>
			<span class="label">temps réel</span>
		</a>
		<a class="item" href="#story">
			<span class="ico fa fa-list"></span>
			<span class="label">historique</span>
		</a>
	</div>
</aside>
<script language="javascript" type="text/javascript">
	$('#telemetry a').click(function() {
		let href = $(this).attr('href').split('#')[1];
		$('section').load(`/${href}`);
	});
</script>
