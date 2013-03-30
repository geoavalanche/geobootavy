<div class="span6">
	<div class="widget-box">
		<div class="widget-title row-fluid">
			<div class="pull-left">
				<h5><i class="icon-credit-card"></i> <?php echo Kohana::lang('ui_main.reports_listed');?></h5>
			</div>
			<div class="pull-right btn-group">
				<a href="javascript:void(0)" class="btn btn-info"><i class="icon-chevron-down"></i></a>
				<a href="javascript:void(0)" class="btn btn-info"><i class="icon-chevron-up"></i></a>
				<a class="btn btn-info tltp" href="<?php echo url::site() . 'reports/' ?>" title="<?php echo Kohana::lang('ui_main.view_more'); ?>">
					<i class="icon-reorder"></i>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table id="table-reports">
				<thead>
					<tr>
						<th scope="col" class="location"><?php echo Kohana::lang('ui_main.location'); ?></th>
						<th scope="col" class="date"><?php echo Kohana::lang('ui_main.date'); ?></th>
						<th scope="col" class="title"><?php echo Kohana::lang('ui_main.title'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($incidents->count() == 0){
						?>
						<tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_reports'); ?></td></tr>
						<?php
					}
						foreach ($incidents as $incident){
							$incident_id = $incident->id;
							$incident_title = text::limit_chars(strip_tags($incident->incident_title), 40, '...', True);
							$incident_date = $incident->incident_date;
							$incident_date = date('M j Y', strtotime($incident->incident_date));
							$incident_location = $incident->location->location_name;
						?>
						<tr>
							<td align="center">
								<a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>" class="tltp" title="<?php echo html::specialchars($incident_location) ?>">
									<i class="icon-map-marker"></i>
								</a>
							</td>
							<td><i class="icon-calendar"></i> <?php echo $incident_date; ?></td>
							<td><a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>"> <?php echo html::specialchars($incident_title) ?></a></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		$("#table-reports").tablecloth({ theme: "dark" });
	</script>
</div>
