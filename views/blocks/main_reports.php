<div class="span6">
	<div class="widget-box">
		<div class="widget-title">
			<table class="table" style="margin:0">
				<tr>
					<td class="truncate"><i class="icon-credit-card"></i> <?php echo Kohana::lang('ui_main.reports_listed');?></td>
					<td width="90">
						<div class="widget-toolbar pull-right btn-group">
							<a class="btn btn-inverse tltp" href="<?php echo url::site() . 'reports/' ?>" title="<?php echo Kohana::lang('ui_main.view_more'); ?>">
								<i class="icon-reorder"></i>
							</a>
							<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-up"></i></a>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="widget-content">
			<table class="table table-dark" id="table-reports">
				<thead>
					<tr>
						<th width="56"><?php echo Kohana::lang('ui_main.location'); ?></th>
						<th width="100"><?php echo Kohana::lang('ui_main.date'); ?></th>
						<th><?php echo Kohana::lang('ui_main.title'); ?></th>
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
							/*$incident_title = text::limit_chars(strip_tags($incident->incident_title), 40, '...', True);*/
							$incident_title = $incident->incident_title;
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
							<td class="truncate">
								<a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>">
									<?php echo html::specialchars($incident_title) ?>
								</a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
