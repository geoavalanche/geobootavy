
<div class="widget-box">
	<div class="widget-title">
		<table class="table" style="margin:0">
			<tr>
				<td class="truncate"><i class="icon-thumbs-up"></i> <?php echo Kohana::lang('ui_main.reports_submit_new');?></td>
				<td width="90">
					<div class="widget-toolbar pull-right btn-group">
						<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-up"></i></a>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="widget-content">
		<h3><?php echo Kohana::lang('ui_main.reports_submitted');?></h3>
		<div class="thanks_msg"><a class="btn btn-danger" href="<?php echo
			url::site().'reports' ?>"><?php echo Kohana::lang('ui_main.reports_return');?></a><br /><br /><br />
			<?php echo Kohana::lang('ui_main.feedback_reports');?><br /><br />
			<?php 
			print form::open('http://feedback.ushahidi.com/fillsurvey.php?sid=2', array('target'=>'_blank'));
			print form::hidden('alert_code', $_SERVER['SERVER_NAME']);
			print "&nbsp;&nbsp;";
			print form::submit('button', Kohana::lang('ui_main.feedback'), ' class=btn btn-danger ');
			print form::close();
			?>
		</div>
	</div>
</div>
