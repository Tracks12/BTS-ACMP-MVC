<!-- ABOUT -->
<?php $captors = ACMPModel::getLastDataByCaptor(); ?>
<div id="map"></div>
<script language="javascript" type="text/javascript">
	var captors = <?php echo(json_encode($captors)); ?>;

	mapInit($('#map'), captors);
</script>
