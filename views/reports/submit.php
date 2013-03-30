

<div id="content">
	<div class="content-bg">

		<?php if ($site_submit_report_message != ''): ?>
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
				<i class="icon-info-sign"></i> <?php echo $site_submit_report_message; ?>
			</div>
		<?php endif; ?>

		<!-- start report form block -->
		<?php print form::open(NULL, array('enctype' => 'multipart/form-data', 'id' => 'reportForm', 'name' => 'reportForm', 'class' => 'gen_forms')); ?>
		<input type="hidden" name="latitude" id="latitude" value="<?php echo $form['latitude']; ?>">
		<input type="hidden" name="longitude" id="longitude" value="<?php echo $form['longitude']; ?>">
		<input type="hidden" name="country_name" id="country_name" value="<?php echo $form['country_name']; ?>" />
		<input type="hidden" name="incident_zoom" id="incident_zoom" value="<?php echo $form['incident_zoom']; ?>" />
		
		
		<div class="widget-box">
			<div class="widget-title row-fluid">
				<div class="span12 pull-left">
					<h5><i class="icon-credit-card"></i> <?php echo Kohana::lang('ui_main.reports_submit_new'); ?></h5>
				</div>
			</div>
			
			<div class="widget-content">
				
				<?php if ($form_error): ?>
					<!-- error message validation form -->
					<div class="row-fluid">
						<div class="alert alert-error span12" style="margin-bottom:10px">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4>Error!</h4>
							<ul>
								<?php
									foreach ($errors as $error_item => $error_description){
										print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
									}
								?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="row-fluid">	
					<div class="span5">
						 <fieldset>
							<legend>Information</legend>
							<input type="hidden" name="form_id" id="form_id" value="<?php echo $id?>" />
							<?php if(count($forms) > 1): ?>
								<div class="control-group">
									<label class="control-label" for="form_id">
										<?php echo Kohana::lang('ui_main.select_form_type');?>
									</label>
									<div class="controls">
										<span class="sel-holder">
											<?php print form::dropdown('form_id', $forms, $form['form_id'],
										' onchange="formSwitch(this.options[this.selectedIndex].value, \''.$id.'\')"') ?>
										</span>
										<div id="form_loader" style="float:left;"></div>
									</div>
								</div>
							<?php endif; ?>
							<div class="control-group">
								<label class="control-label" for="incident_title">
									<?php echo Kohana::lang('ui_main.reports_title'); ?> <span class="required">*</span>
								</label>
								<div class="controls">
									<?php print form::input('incident_title', $form['incident_title'], ' class="text long"'); ?>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="incident_description">
									<?php echo Kohana::lang('ui_main.reports_description'); ?> <span class="required">*</span>
								</label>
								<div class="controls">
									<?php print form::textarea('incident_description', $form['incident_description'], ' rows="5" class="textarea long" ') ?>
								</div>	
							</div>
							
							
							<!-- CUSTOMIZE -->
							<div class="report_row" id="datetime_default">
								<h4>
									<a href="#" id="date_toggle" class="show-more"><?php echo Kohana::lang('ui_main.modify_date'); ?></a>
									<?php echo Kohana::lang('ui_main.date_time'); ?>: 
									<?php echo Kohana::lang('ui_main.today_at')." "."<span id='current_time'>".$form['incident_hour']
										.":".$form['incident_minute']." ".$form['incident_ampm']."</span>"; ?>
									<?php if($site_timezone): ?>
										<small>(<?php echo $site_timezone; ?>)</small>
									<?php endif; ?>
								</h4>
							</div>
							<div class="report_row hide" id="datetime_edit">
								<div class="date-box">
									<h4><?php echo Kohana::lang('ui_main.reports_date'); ?></h4>
									<?php print form::input('incident_date', $form['incident_date'], ' class="text short"'); ?>
									<script type="text/javascript">
										$().ready(function() {
											$("#incident_date").datepicker({ 
												showOn: "both", 
												buttonImage: "<?php echo url::file_loc('img'); ?>media/img/icon-calendar.gif", 
												buttonImageOnly: true 
											});
										});
									</script>
								</div>
								<div class="time">
									<h4><?php echo Kohana::lang('ui_main.reports_time'); ?></h4>
									<?php
										for ($i=1; $i <= 12 ; $i++)
										{
											// Add Leading Zero
											$hour_array[sprintf("%02d", $i)] = sprintf("%02d", $i);
										}
										for ($j=0; $j <= 59 ; $j++)
										{
											// Add Leading Zero
											$minute_array[sprintf("%02d", $j)] = sprintf("%02d", $j);
										}
										$ampm_array = array('pm'=>'pm','am'=>'am');
										print form::dropdown('incident_hour',$hour_array,$form['incident_hour']);
										print '<span class="dots">:</span>';
										print form::dropdown('incident_minute',$minute_array,$form['incident_minute']);
										print '<span class="dots">:</span>';
										print form::dropdown('incident_ampm',$ampm_array,$form['incident_ampm']);
									?>
									<?php if ($site_timezone != NULL): ?>
										<small>(<?php echo $site_timezone; ?>)</small>
									<?php endif; ?>
								</div>
								<div style="clear:both; display:block;" id="incident_date_time"></div>
							</div>
							<div class="report_row">
								<!-- Adding event for endtime plugin to hook into -->
							<?php Event::run('ushahidi_action.report_form_frontend_after_time'); ?>
							</div>
							<!-- CUSTOMIZE -->
							
							
							<div class="control-group">
								<label class="control-label" for="categories"><?php echo Kohana::lang('ui_main.reports_categories'); ?> <span class="required">*</span></label>
								<div class="report_category" id="categories">
									<?php
										$selected_categories = (!empty($form['incident_category']) AND is_array($form['incident_category']))
											? $selected_categories = $form['incident_category']
											: array();
										echo category::form_tree('incident_category', $selected_categories, 2);
									?>
								</div>
							</div>
						</fieldset>
						
						
						 <fieldset>
							<legend><?php echo Kohana::lang('ui_main.reports_optional'); ?></legend>
							<?php Event::run('ushahidi_action.report_form'); ?>
							<?php echo $custom_forms ?>
							<div class="control-group">
								<label class="control-label" for="person_first"><i class="icon-user"></i> <?php echo Kohana::lang('ui_main.reports_first'); ?></label>
								<?php print form::input('person_first', $form['person_first'], ' class="text long"'); ?>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="person_last"><i class="icon-user"></i> <?php echo Kohana::lang('ui_main.reports_last'); ?></label>
								<?php print form::input('person_last', $form['person_last'], ' class="text long"'); ?>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="person_email"><i class="icon-envelope"></i> <?php echo Kohana::lang('ui_main.reports_email'); ?></label>
								<?php print form::input('person_email', $form['person_email'], ' class="text long"'); ?>
							</div>
							<?php Event::run('ushahidi_action.report_form_optional'); ?>
						</fieldset>
						
						
						
					</div>	
					
					
					
					
					
								
	
					<div class="report_right span7">
						<?php if (count($cities) > 1): ?>
							<div class="control-group">
								<label class="control-label" for="select_city">
									<?php echo Kohana::lang('ui_main.reports_find_location'); ?>
								</label>
								<div class="controls">
									<?php print form::dropdown('select_city',$cities,'', ' class="select" '); ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="report_row">
							<div id="divMap" class="report_map">
								<div id="geometryLabelerHolder" class="olControlNoSelect">
									<div id="geometryLabeler">
										<div id="geometryLabelComment">
											<span id="geometryLabel">
												<label><?php echo Kohana::lang('ui_main.geometry_label');?>:</label> 
												<?php print form::input('geometry_label', '', ' class="lbl_text"'); ?>
											</span>
											<span id="geometryComment">
												<label><?php echo Kohana::lang('ui_main.geometry_comments');?>:</label> 
												<?php print form::input('geometry_comment', '', ' class="lbl_text2"'); ?>
											</span>
										</div>
										<div>
											<span id="geometryColor">
												<label><?php echo Kohana::lang('ui_main.geometry_color');?>:</label> 
												<?php print form::input('geometry_color', '', ' class="lbl_text"'); ?>
											</span>
											<span id="geometryStrokewidth">
												<label><?php echo Kohana::lang('ui_main.geometry_strokewidth');?>:</label> 
												<?php print form::dropdown('geometry_strokewidth', $stroke_width_array, ''); ?>
											</span>
											<span id="geometryLat">
												<label><?php echo Kohana::lang('ui_main.latitude');?>:</label> 
												<?php print form::input('geometry_lat', '', ' class="lbl_text"'); ?>
											</span>
											<span id="geometryLon">
												<label><?php echo Kohana::lang('ui_main.longitude');?>:</label> 
												<?php print form::input('geometry_lon', '', ' class="lbl_text"'); ?>
											</span>
										</div>
									</div>
									<div id="geometryLabelerClose"></div>
								</div>
							</div>
							<div class="report-find-location">
								<div id="panel" class="olControlEditingToolbar"></div>
								<div class="btns" style="float:left;">
									<ul style="padding:4px;">
										<li><a href="#" class="btn_del_last"><?php echo utf8::strtoupper(Kohana::lang('ui_main.delete_last'));?></a></li>
										<li><a href="#" class="btn_del_sel"><?php echo utf8::strtoupper(Kohana::lang('ui_main.delete_selected'));?></a></li>
										<li><a href="#" class="btn_clear"><?php echo utf8::strtoupper(Kohana::lang('ui_main.clear_map'));?></a></li>
									</ul>
								</div>
								<div style="clear:both;"></div>
								<?php print form::input('location_find', '', ' title="'.Kohana::lang('ui_main.location_example').'" class="findtext"'); ?>
								<div style="float:left;margin:9px 0 0 5px;">
									<input type="button" name="button" id="button" value="<?php echo Kohana::lang('ui_main.find_location'); ?>" class="btn_find" />
								</div>
								<div id="find_loading" class="report-find-loading"></div>
								<div style="clear:both;" id="find_text"><?php echo Kohana::lang('ui_main.pinpoint_location'); ?>.</div>
							</div>
						</div>
						<?php Event::run('ushahidi_action.report_form_location', $id); ?>
					
					
						
					<div class="control-group" style="clear:both">
						<label class="control-label" for="location_name">
							<i class="icon-map-marker"></i> <?php echo Kohana::lang('ui_main.reports_location_name'); ?><span class="required">*</span>
						</label>
						<span class="example muted"><?php echo Kohana::lang('ui_main.detailed_location_example'); ?></span>
						<?php print form::input('location_name', $form['location_name'], ' class="text long"'); ?>
					</div>
		
		
		
		
					<!-- News Fields -->
					<div id="divNews" class="control-group" style="clear:both">
						<label class="control-label" for="incident_news"><i class="icon-paper-clip"></i> <?php echo Kohana::lang('ui_main.reports_news'); ?></label>
						<div class="controls">
							<?php $i = (empty($form['incident_news'])) ? 1 : 0;	?>
							<?php if (empty($form['incident_news'])): ?>
								<?php print form::input('incident_news[]', '', ' class="text long2"'); ?>
								<a href="#" class="btn btn-danger" onClick="addFormField('divNews','incident_news','news_id','text'); return false;">
									<i class="icon-plus-sign"></i>
								</a>
							<?php else: ?>
								<?php foreach ($form['incident_news'] as $value): ?>
								<div id="<?php echo $i; ?>">
									<?php echo form::input('incident_news[]', $value, ' class="text long2"'); ?>
									<a href="#" class="btn btn-danger" onClick="addFormField('divNews','incident_news','news_id','text'); return false;">
										<i class="icon-plus-sign"></i>
									</a>
									<?php if ($i != 0): ?>
										<?php $css_id = "#incident_news_".$i; ?>
										<a href="#" class="btn btn-danger"	onClick="removeFormField('<?php echo $css_id; ?>'); return false;">
											<i class="icon-minus-sign"></i>
										</a>
									<?php endif; ?>
								</div>
								<?php $i++; ?>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php print form::input(array('name'=>'news_id', 'type'=>'hidden', 'id'=>'news_id'), $i); ?>
						</div>
					</div>
						
						
						
					<div id="divVideo" class="control-group" style="clear:both">
						<label class="control-label" for="incident_video"><i class="icon-film"></i> <?php print Kohana::lang('ui_main.external_video_link'); ?></label>
						<div class="controls">
							<?php $i = (empty($form['incident_video'])) ? 1 : 0; ?>
							<?php if (empty($form['incident_video'])): ?>
								<?php print form::input('incident_video[]', '', ' class="text"'); ?>
								<a href="#" class="btn btn-danger" onClick="addFormField('divVideo','incident_video','video_id','text'); return false;">
									<i class="icon-plus-sign"></i>
								</a>
							<?php else: ?>
								<?php foreach ($form['incident_video'] as $value): ?>
									<div id="<?php  echo $i; ?>">
										<?php print form::input('incident_video[]', $value, ' class="text"'); ?>
										<a href="#" class="btn btn-danger" onClick="addFormField('divVideo','incident_video','video_id','text'); return false;">
											<i class="icon-plus-sign"></i>
										</a>
										<?php if ($i != 0): ?>
											<?php $css_id = "#incident_video_".$i; ?>
											<a href="#" class="btn btn-danger"	onClick="removeFormField('<?php echo $css_id; ?>'); return false;">
												<i class="icon-minus-sign"></i>
											</a>
										<?php endif; ?>
									</div>
									<?php $i++; ?>
								
								<?php endforeach; ?>
							<?php endif; ?>
							<?php print form::input(array('name'=>'video_id','type'=>'hidden','id'=>'video_id'), $i); ?>
						</div>
					</div>
					<?php Event::run('ushahidi_action.report_form_after_video_link'); ?>


					<!-- Photo Fields -->
					<div id="divPhoto" class="control-group" style="clear:both">
						<label class="control-label" for="incident_photo"><i class="icon-picture"></i> <?php echo Kohana::lang('ui_main.reports_photos'); ?></label>
						<div class="controls">
							<?php $i = (empty($form['incident_photo']['name'][0])) ? 1 : 0;	?>
							<?php if (empty($form['incident_photo']['name'][0])): ?>
							<?php print form::upload('incident_photo[]', '', ' class="file"'); ?>
							<a href="#" class="btn btn-danger" onClick="addFormField('divPhoto', 'incident_photo','photo_id','file'); return false;">
								<i class="icon-plus-sign"></i>
							</a>
							<?php else: ?>
								<?php foreach ($form['incident_photo']['name'] as $value): ?>
									<div id="<?php echo $i; ?>">
										<?php print form::upload('incident_photo[]', $value, ' class="file"'); ?>
										<a href="#" class="btn btn-danger" onClick="addFormField('divPhoto','incident_photo','photo_id','file'); return false;">
											<i class="icon-plus-sign"></i>
										</a>
										<?php if ($i != 0): ?>
											<?php $css_id = "#incident_photo_".$i; ?>
											<a href="#" class="btn btn-danger"	onClick="removeFormField('<?php echo $css_id; ?>'); return false;">
												<i class="icon-minus-sign"></i>
											</a>
										<?php endif; ?>
									</div>
									<?php $i++; ?>
								<?php endforeach; ?>
							<?php endif; ?>	
							<?php print form::input(array('name'=>'photo_id','type'=>'hidden','id'=>'photo_id'), $i); ?>
						</div>	
					</div>


				</div>
			</div>
		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
			</div>





				<!-- Video Fields -->
				
									
				<div class="report_row">
					<input name="submit" type="submit" value="<?php echo Kohana::lang('ui_main.reports_btn_submit'); ?>" class="btn_submit" /> 
				</div>
			</div>
		</div>
		<?php print form::close(); ?>
		<!-- end report form block -->
	</div>
</div>
