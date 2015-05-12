		</div><!-- container -->

		<footer>
		</footer>

		<div class="modal-wrapper hide">
			<div class="modal">
				<div class="cerrar">
					<span class="fa-stack">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-times fa-stack-1x fa-inverse"></i>
					</span>
				</div>
				<div class="modal-content">
				</div>
			</div>
		</div>

	</body>

	<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins.js"></script>
	<script src="<?php echo base_url() ?>assets/js/functions.js"></script>

	<?php if(isset($area_atencion)) { ?>
		<script>
			$(document).ready(function(){
				//getCoordenadas(1);
			});
		</script>
	<?php } else {?>
		<p>NEL</p>
	<?php } ?>


</html>