<!-- ABOUT -->
<?php $captors = ACMPModel::getDataByCaptor(); ?>
<div id="map"></div>
<script language="javascript" type="text/javascript">
	var captors = <?php echo(json_encode($captors)); ?>;

	mapInit(captors);
</script>
