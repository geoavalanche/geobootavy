<div class="span6">
	<div class="widget-box">
		<div class="widget-title row-fluid">
			<div class="pull-left">
				<h5><i class="icon-rss"></i> <?php echo Kohana::lang('ui_main.official_news');?></h5>
			</div>
			<div class="pull-right btn-group">
				<a href="javascript:void(0)" class="btn btn-info"><i class="icon-chevron-down"></i></a>
				<a href="javascript:void(0)" class="btn btn-info"><i class="icon-chevron-up"></i></a>
				<a class="btn btn-info tltp" href="<?php echo url::site() . 'feeds' ?>" title="<?php echo Kohana::lang('ui_main.view_more'); ?>">
					<i class="icon-reorder"></i>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table id="table-news">
				<thead>
					<tr>
						<th scope="col"><?php echo Kohana::lang('ui_main.source'); ?></th>
						<th scope="col"><?php echo Kohana::lang('ui_main.date'); ?></th>
						<th scope="col"><?php echo Kohana::lang('ui_main.title'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($feeds->count() != 0){
						foreach ($feeds as $feed){
							$feed_id = $feed->id;
							$feed_title = text::limit_chars($feed->item_title, 40, '...', True);
							$feed_link = $feed->item_link;
							$feed_date = date('M j Y', strtotime($feed->item_date));
							$feed_source = text::limit_chars($feed->feed->feed_name, 15, "...");
						?>
						<tr>
							<td align="center">
								<a href="<?php echo $feed_link; ?>" target="_blank" class="tltp" title="<?php echo $feed_source; ?>">
									<i class="icon-info-sign"></i>
								</a>
							</td>
							<td><i class="icon-calendar"></i> <?php echo $feed_date; ?></td>
							<td><a href="<?php echo $feed_link; ?>" target="_blank"><?php echo $feed_title ?></a></td>
						</tr>
						<?php
						}
					}else{
						?>
						<tr>
							<td colspan="3">
								<div class="alert alert-info">
									<h4>No found!</h4>
									<?php echo Kohana::lang('ui_main.official_news');?>
								</div>
							</td>
						</tr>
						<?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
		
	<script type="text/javascript">
		$("#table-news").tablecloth({ theme: "dark" });
	</script>
</div>
