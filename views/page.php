<div id="content" class="widget-box">
	<div class="widget-title">
		<h5><i class="icon-file-alt"></i> <?php echo $page_title ?></h5>
		<div class="widget-toolbar pull-right btn-group">
			<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-up"></i></a>
		</div>
	</div>
	<div class="widget-content">	
		<?php 
			echo htmlspecialchars_decode($page_description);
			Event::run('ushahidi_action.page_extra', $page_id);
		?>
	</div>
</div>
