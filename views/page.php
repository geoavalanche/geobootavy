<div id="content" class="widget-box">
	<div class="widget-title row-fluid">
		<div class="span12 pull-left">
			<h5><i class="icon-file-alt"></i> <?php echo $page_title ?></h5>
		</div>
	</div>
	<div class="widget-content">	
		<?php 
			echo htmlspecialchars_decode($page_description);
			Event::run('ushahidi_action.page_extra', $page_id);
		?>
	</div>
</div>
